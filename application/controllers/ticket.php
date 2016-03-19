<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

class Ticket extends CI_Controller
{
   public function __construct() {
      parent::__construct();
      $this->load->helper('url');
      $this->load->helper('form');
      $this->load->database();
      $this->load->helper('captcha');
      /*  config de subidas  */
      $config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size']	= '2048';
      $this->load->library('upload', $config);
      $this->load->library('session');
      $this->load->library('form_validation');
   }

   public function crearTicket(){
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

   public function insertar(){

      //*validacion del formulario*//
      $this->form_validation->set_rules("nombre", "Nombre", "min_length[5]|max_length[50]|required");
      $this->form_validation->set_rules("email", "Correo", "valid_email|required");
      $this->form_validation->set_rules("id_sucursal", "Sucursal", "required");
      $this->form_validation->set_rules("id_equipo", "Serial", ["regex_match[/([0-9A-z*\-]|[-\S])+/]"]);
      $this->form_validation->set_rules("tema", "Tema", "required");
      $this->form_validation->set_rules("descripcion", "Descripción", "required|min_length[20]|max_length[500]");
      $this->form_validation->set_rules('captcha_usuario', 'Captcha', 'required|callback_check_captcha');

      // validacion con captcha //
      $captcha_usuario = $this->input->post('captcha_usuario');



      if ($this->form_validation->run() == false){

         $data["id_sucursal"]=$this->crearOpciones($this->db->get("sucursal")->result_array());
         $data["header_files"]=[
            "<link rel='stylesheet' href='" . base_url('assets/css/Ticket-crear.css') . "'/>\n"
         ];

         // numeric random number for captcha
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

         if(!$this->upload->do_upload('fotografias')){
            $error = array('error' => $this->upload->display_errors());
            $data["error"]=$error;
         }

         $this->session->set_userdata('captchaWord',$data['captcha']['word']);
         $this->load->view('layouts/header', $data);
         $this->load->view('ticket/crear', $data);
         $this->load->view('layouts/footer');
     }else{
        echo "has pasado los filtros";
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
}

