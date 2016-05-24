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
   $this->id_equipo=strtoupper($_data["id_equipo"]);
   $this->activo_fijo=!empty($_data["activo_fijo"])? $_data["activo_fijo"] : "";
   $this->marca=!empty($_data["marca"])? strtoupper($_data["marca"]) : "";
   $this->modelo=!empty($_data["modelo"])? strtoupper($_data["modelo"]) : "";
   $this->fecha_compra=!empty($_data["fecha_compra"])?$_data["fecha_compra"]: "";
   $this->asignado_a=!empty($_data["asignado_a"])? strtoupper($_data["asignado_a"]) : "";
   $this->sucursal=$_data['sucursal'];

   return $this;
  }

  public function insertar(){
     $this->db->insert("equipo",$this);
  }

  public function obtenerSeriales(){
    $this->db->select("id_equipo");
    $_seriales=$this->convertirArray($this->db->get("equipo")->result_array());
    return $_seriales['id_equipo'];
  }

  public function obtenerActivosFijos(){
    $this->db->select("activo_fijo");
    $_seriales=$this->convertirArray($this->db->get("equipo")->result_array());
    return $_seriales['activo_fijo'];
  }

  public function actualizar(){
    $_variables=get_object_vars($this);
    foreach($_variables as $key => $valor){
       if(empty($_variables[$key])){
         unset($_variables[$key]);
       }
    }

   $this->db->where("id_equipo", $_variables['id_equipo']);
   $this->db->update("equipo", $_variables);
  }

  private function convertirArray($consulta){
      if(!empty($consulta)){
         $_columnas = array_keys($consulta[0]);
         for($i=0; $i<count($consulta); $i++){
            foreach($_columnas as $valor){
               $_filas[$valor][]=$consulta[$i][$valor];
            }
         }
         return $_filas;
      }
      else{
         return false;
      }
   }

   public function consultarTodasEntradas($id_equipo){
      $this->db->select("id_observacion,id_equipo,tema,mensaje,fecha");
      $this->db->where("id_equipo",$id_equipo);
      $this->db->where("id_ticket",0);
      return $this->convertirArray($this->db->get("observacion")->result_array());
   }

   public function consultarEquipo($id_equipo){
     $this->db->select("id_equipo,activo_fijo,marca,modelo,fecha_compra,asignado_a,sucursal");
     $this->db->where("id_equipo",$id_equipo);
     return $this->convertirArray($this->db->get("equipo")->result_array());
   }


   public function cambiarEstado($data){
      $this->db->where("activo_fijo", $data[0]);
      $this->db->update("equipo", ["estado"=>$data[1]]);
   }

   public function consultarPorEstado($estado, $comienzo=0){
     $this->load->library("table");


      $tmpl = array (
                    'table_open'          => '<table class="w3-table w3-border w3-hoverable" style="max-width: 90%; margin: auto; margin-top: 3em">',

                    'heading_row_start'   => '<tr>',
                    'heading_row_end'     => '</tr>',
                    'heading_cell_start'  => '<th class="w3-cyan">',
                    'heading_cell_end'    => '</th>',

                    'row_start'           => '<tr>',
                    'row_end'             => '</tr>',
                    'cell_start'          => '<td>',
                    'cell_end'            => '</td>',

                    'row_alt_start'       => '<tr>',
                    'row_alt_end'         => '</tr>',
                    'cell_alt_start'      => '<td>',
                    'cell_alt_end'        => '</td>',

                    'table_close'         => '</table>'
              );
     $this->table->set_template($tmpl);


     $this->db->limit(10, $comienzo*10);
     $this->db->like("estado", $estado);
     $this->db->select("id_equipo,activo_fijo,marca,modelo,sucursal,estado");
     $_resultado = $this->db->get("equipo");
     return [$this->table->generate($_resultado), $_resultado->num_rows()];
   }
}

