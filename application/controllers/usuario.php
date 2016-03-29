<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

class Usuario extends CI_Controller
{
   public function __construct() {
      parent::__construct();
      $this->load->helper('form');
      $this->load->library('form_validation');
      $this->form_validation->set_error_delimiters('<div class="w3-container w3-content"><div class="w3-half w3-display-middle   w3-card-8 w3-animate-top w3-red w3-margin-8">', '</div></div>');
      $this->load->model("Usuario_model");
      $this->load->library('../controllers/ticket');
      $this->load->library('session');
   }

   public function index($mostrar=false){
      $this->load->view('layouts/header');
      $this->load->view('usuario/index');
      $this->load->view('layouts/footer');
   }

   public function ingresar(){
      $_config = [
         [
            "field"=>"correo",
            "label"=>"Correo",
            "rules"=>"required|valid_email|xss_clean"
         ],
         [
            "field"=>"contrasena",
            "label"=>"Contraseña",
            "rules"=>"required|xss_clean"
         ]
      ];

      $this->form_validation->set_rules($_config);
      if ($this->form_validation->run() == false && !empty($this->session->userdata('logueado'))){
         $this->index();
      }
      else{
         if($this->Usuario_model->comprobarUsuario($this->input->post()) || $this->session->userdata('logueado')==true ){
            $this->session->set_userdata($this->Usuario_model->comprobarUsuario($this->input->post()));
            $this->ticket->verTickets();
         }
         else{
            $this->load->view('layouts/mensaje', [
               "url"=>current_url(),
               "tiempo"=>6,
               "titulo"=>"Error",
               "mensaje"=>"El usuario no esta registrado<br/>o no esta activo aún."
            ]);
         }
      }
   }

   public function registar(){
      $_config=[
         [
            "field"=>"nombre",
            "label"=>"Nombre",
            "rules"=>"required"
         ],
         [
            "field"=>"correo",
            "label"=>"Correo",
            "rules"=>"required|valid_email"
         ],
         [
            "field"=>"contrasena",
            "label"=>"Contraseña",
            "rules"=>"required"
         ],
         [
            "field"=>"rol",
            "label"=>"Rol",
            "rules"=>"required"
         ],
         [
            "field"=>"categoria",
            "label"=>"Categoría",
            "rules"=>"required"
         ]
      ];

      $this->form_validation->set_rules($_config);
      if($this->form_validation->run() == false){
         $this->index();
      }
      else{
         $this->Usuario_model->cargar($this->input->post())->insertar();
         $this->load->view('layouts/mensaje',[
            "url"=>current_url(),
            "tiempo"=>3,
            "mensaje"=>"Usuario registrado, esperando validación."
         ]);
      }
   }

}

