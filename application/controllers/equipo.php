<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

class Equipo extends CI_Controller
{
  public function __construct(){
     parent::__construct();
     $this->load->helper('form');
     $this->load->library('form_validation');

     /*Cargar sucursal */
     $this->load->model( [
      "Sucursal_model",
      "Equipo_model",
      "Observacion_model"
     ]);
  }

  public function index(){
    $this->load->view('equipo/index', ["sucursales"=>$this->Sucursal_model->obtenerSucursales()]);
  }

  public function insertar(){
     $this->Equipo_model->cargar($this->input->post())->insertar();
     $this->load->view("layouts/mensaje",[
                                          "url"=>site_url("equipo"),
                                          "tiempo"=>4,
                                          "mensaje"=>"El equipo ha sido creado exitosamente",
                                          ]);
  }

  public function modificar(){
     $_seriales=$this->Equipo_model->obtenerSeriales();
     $this->load->view("equipo/modificar", ["seriales"=>$_seriales,
                                            "sucursales"=>$this->Sucursal_model->obtenerSucursales()
                                           ]);
  }

  public function actualizar(){
   $this->Equipo_model->cargar($this->input->post())->actualizar();
   $this->load->view("layouts/mensaje",[
                                          "url"=>site_url("equipo/modificar"),
                                          "tiempo"=>4,
                                          "mensaje"=>"El equipo ha sido actualizado exitosamente",
                                          ]);
  }

   public function addEntrada(){
      $this->load->view("equipo/agregarentrada",[
         "seriales"=>$this->Equipo_model->obtenerSeriales()
      ]);
   }

   public function insertarEntrada(){
      $_post=$this->input->post();
      $_post["mensaje"]= $this->session->userdata("correo")."<br/>" . $this->session->userdata("nombre"). "<br/><br/>". $_post["mensaje"];
      $this->Observacion_model->cargar($_post)->insertar();
      $this->load->view("layouts/mensaje",[
                                          "url"=>site_url("equipo/addEntrada"),
                                          "tiempo"=>4,
                                          "mensaje"=>"Se ha añadido una nueva entrada satisfactoriamente.",
                                          ]);
   }


   public function consultarHojaVida(){
      $this->load->view("equipo/consultarhv", ["seriales"=>$this->Equipo_model->obtenerSeriales()]);
   }

   public function verHojaVida(){
      $id_equipo= strtoupper($this->input->post("id_equipo"));
      $_resultado=$this->Equipo_model->consultarTodasEntradas($id_equipo);
      if(empty($_resultado)){
         $this->load->view("layouts/mensaje",[
            "url"=>site_url("equipo/consultarHojaVida"),
            "mensaje"=>"El equipo no esta registrado o no tiene entradas que mostrar",
            "titulo"=>"Error"
         ]);
      }else{
         $_nombre=uniqid();
         $pdfFilePath = FCPATH."/downloads/".$_nombre.".pdf";

         if (file_exists($pdfFilePath) == FALSE)
         {
             ini_set('memory_limit','32M'); // boost the memory limit if it's low <img src="https://s.w.org/images/core/emoji/72x72/1f609.png" alt="😉" draggable="false" class="emoji">
             $html = $this->load->view("equipo/hojavida", ["resultado"=>$_resultado], true); // render the view into HTML

             $this->load->library('pdf');
             $pdf = $this->pdf->load();
             $pdf->SetFooter($_SERVER['HTTP_HOST'].'|{PAGENO}|'.date(DATE_RFC822)); // Add a footer for good measure <img src="https://s.w.org/images/core/emoji/72x72/1f609.png" alt="😉" draggable="false" class="emoji">
             $pdf->WriteHTML($html); // write the HTML into the PDF
             $pdf->Output($pdfFilePath, 'F'); // save to file because we can
         }

         header("Location:". base_url()."/downloads/".$_nombre.".pdf");
     }
   }

   public function formularioConsultarEquipo(){
     $this->load->view("equipo/formconsultar", ["seriales"=>$this->Equipo_model->obtenerSeriales()]);
   }

   public function traerEquipo($id_equipo=""){
     if(!empty($id_equipo)){
       $_respuesta=$this->Equipo_model->consultarEquipo($id_equipo);
     }
     else{
       $id_equipo=$this->input->post("id_equipo");
       $_respuesta=$this->Equipo_model->consultarEquipo($id_equipo);
     }
     if(empty($_respuesta)){
       $this->load->view("layouts/mensaje",[
         "url"=>site_url("equipo/formularioConsultarEquipo"),
         "mensaje"=>"Error el equipo no se ha encontrado en<br/>la base de datos.",
         "tiempo"=>"3",
         "titulo"=>"Error"
       ]);
     }
     else{

       $this->load->view("equipo/mostrarEquipo", ["respuesta"=>$_respuesta]);
     }
   }


   public function cambiarEstado(){
      if(empty($this->input->post("estado"))){
        $this->load->view("equipo/estado", ["activos"=>$this->Equipo_model->obtenerActivosFijos()]);
      }
      else{
         var_dump($this->input->post("estado"));
         $this->Equipo_model->cambiarEstado($this->input->post("estado"));
      }
   }

   public function verEstado(){
     if(empty($this->input->post("estado"))){
       $this->load->view("equipo/verEstado");
     }
     else{
       $_respuesta= $this->Equipo_model->consultarPorEstado($this->input->post("estado", $this->uri->segment(3)));
       $config['base_url'] = site_url('equipo/verEstado');
       $config['total_rows'] = $_respuesta[1];
       $config['per_page'] = 10;
       $this->pagination->initialize($config);

       $this->load->view("equipo/verEstado", ["tabla"=>$_respuesta[0]]);
     }
   }

   public function exportarExcel(){
      $this->load->dbutil();
      $this->load->helper("download");
      $_resultado=$this->db->query("select * from equipo");
      force_download("Equipos_" . date("Y-m-d") . ".csv", $this->dbutil->csv_from_result($_resultado));
   }

   public function verConsultarSerial(){
     $this->load->view("equipo/verConsultarSerial");
   }

   public function consultarActivoFijo(){
     $activoFijo = $this->input->post("activoFijo");
     echo $this->Equipo_model->consultarActivoFijo($activoFijo);
   }
}
