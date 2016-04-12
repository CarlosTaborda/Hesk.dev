<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

class Ticket_model extends CI_Model
{
    public $id_ticket;
    public $nombre;
    public $correo;
    public $estado;
    public $categoria;
    public $id_sucursal;
    public $email_responsable;

    function __construct(){
      parent::__construct();
      $this->load->database();
    }

   public function cargar($datos){
      $this->id_ticket = $datos['id_ticket'];
      $this->nombre = $datos['nombre'];
      $this->correo = $datos['correo'];
      if(!empty($datos['estado'])){
         $this->estado = $datos['estado'];
      }
      else{
         $this->estado= "nuevo";
      }
      $this->categoria=$datos['categoria'];
      $this->id_sucursal=$datos['id_sucursal'];

      if(!empty($datos['email_responsable'])){
         $this->email_responsable=$datos['email_responsable'];
      }
      else{
         $this->email_responsable="";
      }

      return $this;
   }



   public function insertar(){
      $this->db->insert('ticket', $this);
   }



   public function consultar($id_ticket){
      $this->db->select("ticket.id_ticket,ticket.nombre,ticket.correo,ticket.estado,ticket.categoria,ticket.id_sucursal,ticket.email_responsable,observacion.id_observacion,observacion.tema,observacion.mensaje,observacion.fotografias");
      $this->db->from('ticket');
      $this->db->join('observacion', 'ticket.id_ticket=observacion.id_ticket WHERE ticket.id_ticket='. $id_ticket , "inner");
      $resultado= $this->db->get();
      $_respuesta=$resultado->row_array();
      if(!empty($_respuesta)){
         return $_respuesta;
      }
      else{
         return "No existe el ticket con el código: " . $id_ticket;
      }
   }

   public function verTickets($data){
     if($this->session->userdata('rol')=="con"){
        $_contador="email_responsable='" . $this->session->userdata('correo') . "'";
     }


      if(!empty($data['estado'])){
         $_respuesta=$this->db->query("SELECT ticket.id_ticket,ticket.nombre,ticket.correo,ticket.estado,ticket.categoria,ticket.id_sucursal,ticket.email_responsable,observacion.fecha,observacion.tema,observacion.id_observacion,observacion.mensaje,observacion.fotografias
                           FROM ticket INNER JOIN observacion
                           ON ticket.id_ticket=observacion.id_ticket
                           WHERE estado='". $data['estado'] . (!empty($_contador)? " AND" . $_contador : "") . " AND observacion.id_ticket<>0 ' ORDER BY observacion.fecha " . $data['fecha']);
      }
      else{
                 $_respuesta=$this->db->query("SELECT ticket.id_ticket,ticket.nombre,ticket.correo,ticket.estado,ticket.categoria,ticket.id_sucursal,ticket.email_responsable,observacion.fecha,observacion.tema,observacion.id_observacion,observacion.mensaje,observacion.fotografias
                           FROM ticket INNER JOIN observacion
                           ON ticket.id_ticket=observacion.id_ticket
                           " . (!empty($_contador)? "WHERE " . $_contador . " AND id_ticket<>0 ": "WHERE observacion.id_ticket<>0 ") . "ORDER BY observacion.fecha " . $data['fecha']);
      }

     if($this->convertirArray($_respuesta->result_array())){
        $_numero=$_respuesta->num_rows();
        $_filas[]=$this->convertirArray($_respuesta->result_array());
        $_filas[]=$_numero;
        return $_filas;
     }
     else{
        return false;
     }

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

   public function borrarTicket($id_ticket){
      $this->db->where('id_ticket',$id_ticket);
      $this->db->delete(['ticket','observacion']);
   }

   public function responderTicket($datos){
      if(empty($datos['mensaje'])){
         unset($datos['mensaje']);
         $_update=[
            "estado"=>$datos["estado"],
            "email_responsable"=>$datos['asignadoA']
         ];

         if(empty($datos['asignadoA'])){
            unset($_update['email_responsable']);
         }

         $this->db->where("id_ticket",$datos['id_ticket']);
         $this->db->update('ticket', $_update);
      }
      else{
         $_update=[
            "mensaje"=>$datos['mensaje']
         ];
         //$this->db->where("id_ticket",$datos['id_ticket']);
         $this->db->where("id_observacion", $datos['id_observacion']);
         $this->db->update('observacion', $_update);

         unset($_update["mensaje"]);
         if(!empty($datos["estado"]) && !empty($datos['asignadoA'])){
            $_update=[
               "estado"=>$datos["estado"],
               "email_responsable"=>$datos['asignadoA']
            ];
            $this->db->where("id_ticket",$datos['id_ticket']);
            $this->db->update('ticket', $_update);
         }
      }
   }


   public function asignarEncargado($id_sucursal){
     $this->db->select("correo");
     $this->db->like("sucursales_encargadas",$id_sucursal);
     $_resultado=$this->db->get('usuario')->row_array();
     return $_resultado['correo'];
   }
}
