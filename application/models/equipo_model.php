<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
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

  public function cargar($_data){
   $this->id_equipo=$_data["id_equipo"];
   $this->activo_fijo=!empty($_data["activo_fijo"])? $_data["activo_fijo"] : "";
   $this->marca=!empty($_data["marca"])? $_data["marca"] : "";
   $this->modelo=!empty($_data["modelo"])? $_data["modelo"] : "";
   $this->fecha_compra=!empty($_data["fecha_compra"])?:$_data["fecha_compra"];
   $this->asignado_a=!empty($_data["asignado_a"])? $_data["asignado_a"] : "";
   $this->sucursal=$_data['sucursal'];
   return $this;
  }

  public function insertar(){
     $this->db->insert("equipo",$this);
  }
}

