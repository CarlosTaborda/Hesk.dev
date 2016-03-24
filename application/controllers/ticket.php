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
		$config['overwrite'] = TRUE;
      $this->load->library('upload', $config);
      /*************************/
      $this->load->library('session');
      $this->load->library('form_validation');
      $this->form_validation->set_error_delimiters('<div class="w3-container w3-content"><div class="w3-half w3-display-middle   w3-card-8 w3-animate-top w3-red w3-margin-8">', '</div></div>');
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
            'field'=>'email',
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
            'field'=>'descripcion',
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
         $this->load->view('layouts/mensaje', [
                        "url"=>current_url(),
                        "mensaje"=>"Su ticket ha sido creado satisfactoriamente"
                     ]);

     }
   }

   public function sql($datos){

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

