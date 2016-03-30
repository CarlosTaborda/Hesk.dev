<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

class Ticket extends CI_Controller
{
   public function __construct() {
      parent::__construct();
      $this->load->helper('form');
      $this->load->database();
      $this->load->helper('captcha');
      /*  config de subidas  */
      $config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size']	= '2048';
		$config['overwrite'] = TRUE;
      $this->load->library('upload', $config);
      /*************************/
      $this->load->library('session');
      $this->load->library('form_validation');
      $this->form_validation->set_error_delimiters('<div class="w3-container w3-content"><div class="w3-half w3-display-middle   w3-card-8 w3-animate-top w3-red w3-margin-8">', '</div></div>');
      /* CARGAR MODELOS*/
      $this->load->model('Ticket_model');
      $this->load->model('Observacion_model');

   }



   public function crearTicket($data= null){
         $data["id_sucursal"]=$this->crearOpciones($this->db->get("sucursal")->result_array());
         $data["header_files"]=[
            "<link rel='stylesheet' href='" . base_url('assets/css/Ticket-crear.css') . "'/>\n"
         ];

         $random_number = substr(number_format(time() * rand(),0,'',''),0,6);
         // setting up captcha config
         $vals = array(
                'word' => $random_number,
                'img_path' => './captcha/',
                'img_url' => base_url().'captcha/',
                'img_width' => 280,
                'img_height' => 64,
                'expiration' => 7200
               );
         $data['captcha'] = create_captcha($vals);
         $error = array('error' => $this->upload->display_errors());
         $data["error"]=$error;

         $this->session->set_userdata('captchaWord',$data['captcha']['word']);
         $this->load->view('layouts/header', $data);
         $this->load->view('ticket/crear', $data);
         $this->load->view('layouts/footer');

     }



   public function obtener(){
      $_reglas=[
         [
            'field'=>'nombre',
            'label'=>'Nombre',
            'rules'=>'min_length[5]|max_length[50]|required'
         ],
         [
            'field'=>'correo',
            'label'=>'Correo',
            'rules'=>'valid_email|required'
         ],
         [
            'field'=>'id_sucursal',
            'label'=>'Sucursal',
            'rules'=>'required'
         ],
         [
            'field'=>'id_equipo',
            'label'=>'Serial',
            'rules'=>["regex_match[/([0-9A-z*\-]|[-\S])+/]"]
         ],
         [
            'field'=>'tema',
            'label'=>'Tema',
            'rules'=>'required'
         ],
         [
            'field'=>'mensaje',
            'label'=>'Descripción',
            'rules'=>'required|min_length[20]|max_length[500]'
         ],
         [
            'field'=>'captcha_usuario',
            'label'=>'Captcha',
            'rules'=>'callback_check_captcha'
         ]
      ];

      $this->form_validation->set_rules($_reglas);

      // validacion con captcha //
      $captcha_usuario = $this->input->post('captcha_usuario');




     if ($this->form_validation->run() == false){
         $this->crearTicket();
     }
     else{
         /* sube varios archivos */
         foreach ($_FILES as $fieldname => $fileObject){
            if (!empty($fileObject['name'])){

               if (!$this->upload->do_upload($fieldname)){
                  $errors = $this->upload->display_errors();
                  $data['errors']=$errors;
                  $this->crearTicket($data);
                  exit(0);
               }

               $_infoArchivo= $this->upload->data();
               $_linkImagenes[]= base_url('uploads') . '/' . $_infoArchivo['file_name'];
            }
         }

         $id_ticket=abs(crc32(uniqid()));

         $_datos= $this->input->post();

         $_datos['id_ticket']=$id_ticket;
         $_datos['fotografias']= !empty($_linkImagenes)? $_linkImagenes : null;

         $this->sql($_datos, 'ticket', 'insertar');
         $this->sql($_datos, 'observacion', 'insertar');

         $this->load->view('layouts/mensaje', [
                        "url"=>current_url(),
                        'tiempo'=>"7",
                        "mensaje"=>"Su ticket ha sido creado satisfactoriamente<br/>su id de rastreo es :" . $id_ticket,
                     ]);


     }
   }



   public function sql($datos, $tabla, $accion){
      switch($tabla){
         case 'ticket':
            switch($accion){
               case 'insertar':
                  $this->Ticket_model->cargar($datos)->insertar();
               break;
            }
         break;


         case "observacion":
            switch($accion){
               case 'insertar':
                  $this->Observacion_model->cargar($datos)->insertar();
               break;
            }
         break;
      }
   }



    public function check_captcha($str){
      $word = $this->session->userdata('captchaWord');
      if(strcmp(strtoupper($str),strtoupper($word)) == 0){
         return true;
      }
      else{
        $this->form_validation->set_message('check_captcha', 'Por favor ingrese correctamente el codigo de seguridad');
        return false;
      }
   }



   private function crearOpciones($resultado){
      for($i=0; $i<count($resultado); $i++){
         $respuesta[$resultado[$i]["id_sucursal"]]=$resultado[$i]["codigo"];
      }
      $_llaves= array_keys($respuesta);

      for($i=0; $i<count($respuesta); $i++){
         $respuesta[$_llaves[$i]]= $_llaves[$i] . " " . $respuesta[$_llaves[$i]];
      }


      return $respuesta;
   }

   public function consultar(){

      $id_ticket = $this->input->post('id_ticket');

      if(!empty($id_ticket)){
         $_respuesta = $this->Ticket_model->consultar($id_ticket);
         if(is_array($_respuesta)){
            $this->load->view('layouts/header');
            $this->load->view('ticket/unicaconsulta', ["ticket"=>$_respuesta]);
            $this->load->view('layouts/footer');

         }
         else{
            $this->load->view('layouts/mensaje',[
                                                   "url"=>current_url(),
                                                   "tiempo"=>5,
                                                   "mensaje"=>$_respuesta
            ]);
         }
      }
      else{
         $this->load->view('layouts/header');
         $this->load->view('ticket/consulta');
         $this->load->view('layouts/footer');
      }
   }


   public function consultarTickets(){
      $this->load->view('layouts/header');
      $this->load->view('ticket/formularioconsultar');
      $this->load->view('layouts/footer');
   }

   public function verTickets(){
      $_correos=$this->Usuario_model->obtenerTodosCorreos();

      if(!empty($this->input->post('fecha')) && $this->Ticket_model->verTickets($this->input->post())){
         $_respuesta = $this->Ticket_model->verTickets($this->input->post());
         $config['base_url'] = site_url('ticket/verTickets');
         $config['total_rows'] = $_respuesta[1];
         $config['per_page'] = 10;
         $this->pagination->initialize($config);
         $this->load->view('ticket/verticket', ["resultado"=>$_respuesta[0], "correos"=>$_correos]);
      }
      else{
         $_respuesta = $this->Ticket_model->verTickets(["fecha"=>"DESC"]);
         $config['base_url'] = site_url('ticket/verTickets');
         $config['total_rows'] = $_respuesta[1];
         $config['per_page'] = 10;
         $this->pagination->initialize($config);
         $this->load->view('ticket/verticket', ["resultado"=>$_respuesta[0], "correos"=>$_correos]);
      }

   }

   public function borrarTicket(){
      $this->Ticket_model->borrarTicket($this->input->post('id_ticket'));
   }

   public function responderTicket(){
   var_dump($this->input->post());
      $this->Ticket_model->responderTicket($this->input->post());
   }
}

