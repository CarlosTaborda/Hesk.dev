<?php
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

       $this->id_ticket=$datos['id_ticket'];
       if(!empty($datos['id_equipo'])){
          $this->id_equipo=$datos['id_equipo'];
       }
       else{
          $this->id_equipo=0;
       }
       $this->tema=$datos['tema'];
       $this->mensaje=$datos['mensaje'];
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

