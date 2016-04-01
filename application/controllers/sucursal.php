<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

class Sucursal extends CI_Controller
{
       public function __construct(){
            parent::__construct();
            $this->load->helper('form');
            $this->load->library('form_validation');
       }

    public function index(){
      $this->load->view('layouts/header');
      $this->load->view('sucursal/index');
      $this->load->view('layouts/footer');
    }

    public function insertar(){
      $_reglas = [
         [
            'field'=>'id_sucursal',
            'label'=>'Código númerico',
            'rules'=>'required|regex_match[/\b[0-9]{3}\b/]',
         ],
         [
            'field'=>'codigo',
            'label'=>'Código alfabético',
            'rules'=>'required|regex_match[/\b[a-z]{3,10}\b/]',
         ]
      ];

      $this->form_validation->set_rules($_reglas);

      if ($this->form_validation->run() == FALSE){
			$this->index();
		}
		else{
		   $this->load->model('Sucursal_model');
		   $this->Sucursal_model->cargar($this->input->post());
		   $this->Sucursal_model->insertar();
			$this->load->view('layouts/mensaje', ['url'=>current_url(),
			                                      'titulo'=>'Sucursal',
			                                      'tiempo'=>11,
			                                      "mensaje"=>'La sucursal ha sido creada']);
		}
    }
}

