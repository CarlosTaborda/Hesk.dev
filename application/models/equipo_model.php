<?php
class Equipo_model extends CI_Model
{
  public $id_equipo;
  public $activo_fijo;
  public $marca;
  public $modelo;
  public $fecha_compra;
  public $asignado_a;
  public $sucursal;


  public function __contruct(){
    parent::__construct();
    $this->load->database();
  }
}

