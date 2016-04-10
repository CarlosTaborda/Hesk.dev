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
      "Equipo_model"
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
}

