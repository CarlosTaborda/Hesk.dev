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


    public function obtenerSucursales(){
      return $this->crearOpciones($this->db->get("sucursal")->result_array());
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
