<?php
class Equipo_model extends CI_Model
{
  public $id_equipo;
  public $marca;
  public $modelo;
  public $fecha_compra;
  public $asignado_a;
  public $sucursal;
  public $activo_fijo;


  public function __contruct(){
    parent::__construct();
    $this->load->database();
  }
}
