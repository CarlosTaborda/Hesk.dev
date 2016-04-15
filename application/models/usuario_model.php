<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

class Usuario_model extends CI_Model
{
    public $id_usuario;
    public $nombre;
    public $correo;
    public $contrasena;
    public $rol;
    public $categoria;
    public $activo;

    function __construct(){
      parent::__construct();
      $this->load->database();
      $this->load->library('table');
    }

    public function comprobarUsuario($data){
       $usuario = $data['correo'];
       $contrasena = sha1($data['contrasena']);

       $where = ['correo'=>$usuario, 'contrasena'=>$contrasena, 'activo'=>1];

       $this->db->select('nombre,correo,rol,sucursales_encargadas');
       $this->db->where($where);
       $_infoUsuario=$this->db->get('usuario')->row_array();

       if(!empty($_infoUsuario)){
         $_infoUsuario['logueado']=true;
         $this->session->set_userdata($_infoUsuario);
         return $_infoUsuario;
       }
       else{
          return false;
       }
    }

    public function cargar($datos){
       $this->nombre=$datos['nombre'];
       $this->correo=$datos['correo'];
       $this->contrasena= sha1($datos['contrasena']);
       $this->rol=$datos['rol'];
       $this->categoria="";

       foreach($datos['categoria'] as $categoria){
         $this->categoria.=$categoria . " ";
       }

       if(!empty($datos['activo'])){
         $this->activo=$datos['activo'];
       }
       else{
          $this->activo=0;
       }

       return $this;
    }

   public function insertar(){
      $this->db->insert('usuario', $this);
   }

   public function permitirVistaUsuario($rol, $session){
      if($session['logueado']){
         foreach($rol as $valor){
            if($valor == $session['rol']){
               return true;
            }
         }
         return false;
      }
      else{
         return false;
      }
   }

   public function obtenerTodosCorreos(){
      $this->db->select('nombre,correo');
      $_resultado=$this->db->get('usuario')->result_array();
      if($this->convertirArray($_resultado)){
          $_filas=$this->convertirArray($_resultado);
          for($x=0; $x<count($_filas['correo']); $x++){
            $_correos[$_filas['correo'][$x]]=$_filas['nombre'][$x];
          }
          return $_correos;
      }
      else{
         return false;
      }

   }

   public function traerCorreos($rol){
     $this->db->select("correo");
     $this->db->distinct();
     $this->db->where("rol", $rol);
     return $this->convertirArray($this->db->get('usuario')->result_array());
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

   public function consultarUsuariosInactivos(){
     $this->db->select("nombre,correo,rol,categoria");
     $this->db->where("activo",0);
     $this->table->set_template(['table_open'=>'<table class="w3-bordered w3-table w3-border w3-hoverable">',
                                 'heading_cell_start'=>'<th class="w3-indigo">',
                                 'row_start' => '<tr onclick="habilitar(this)">'
                                ]);
     return $this->table->generate($this->db->get("usuario"));
   }

   public function consultarTodosUsuarios(){
     $this->db->select("nombre,correo,rol,categoria");
     $this->table->set_template(['table_open'=>'<table class="w3-bordered w3-table w3-border w3-hoverable w3-striped">',
                                 'heading_cell_start'=>'<th class="w3-indigo">',
                                 'row_start' => '<tr onclick="habilitar(this)">',
                                 'row_alt_start' => '<tr onclick="habilitar(this)">'
                                ]);
     return $this->table->generate($this->db->get("usuario"));
   }

   public function habilitar($correo, $rol){
     $this->db->where("correo", $correo);
     $this->db->where("rol", $rol);
     $this->db->update("usuario",["activo"=>"1"]);
   }

   public function eliminar($correo, $rol){
     $this->db->where("correo", $correo);
     $this->db->where("rol", $rol);
     $this->db->delete('usuario');
   }

}
