<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
class Observacion_model extends CI_Model
{

   public $id_ticket;
   public $id_equipo;
   public $tema;
   public $mensaje;
   public $fecha;
   public $fotografias;

    function __construct(){
      parent::__construct();
      $this->load->database();
    }

    public function cargar($datos){

       if(!empty($datos["id_ticket"])){
          $this->id_ticket=$datos['id_ticket'];
       }
       else{
          $this->id_ticket=0;
       }
       if(!empty($datos['id_equipo'])){
          $this->id_equipo=strtoupper($datos['id_equipo']);
       }
       else{
          $this->id_equipo=0;
       }
       $this->tema=$datos['tema'];
       $this->mensaje="<div class='w3-border w3-margin-4 w3-light-grey'>" . $datos['mensaje'] . "</div>";
       $this->fecha=date("Y-m-d H:i:s");
       $this->fotografias="";

       if(!empty($datos['fotografias'])){
         foreach($datos['fotografias'] as $value){
            $this->fotografias.="<a href='". $value . "'>". $value . "</a><br/>";
         }
       }
       return $this;
    }

    public function insertar(){
       $this->db->insert('observacion', $this);
    }
}

