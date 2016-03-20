<?php
class Sucursal_model extends CI_Model
{
    public $id_sucursal;
    public $codigo;

    function __construct(){
      parent::__construct();
      $this->load->database();
    }

    public function cargar($data){
      $this->id_sucursal=$data['id_sucursal'];
      $this->codigo=strtoupper($data['codigo']);
    }

    public function insertar(){
      $this->db->insert('sucursal',['id_sucursal'=>$this->id_sucursal, 'codigo'=>$this->codigo]);
    }
}

