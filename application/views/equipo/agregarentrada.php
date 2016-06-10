<?php
//Permitir usuarios o denegarlos dependiendo del rol
$usuarios_permitidos=['adm'];
if(!$this->Usuario_model->permitirVistaUsuario($usuarios_permitidos, $this->session->all_userdata())){
   header("Location: " . site_url('usuario/index'));
}

$head_files=[
  '<script src="http://code.jquery.com/jquery-migrate-1.0.0.js"></script>'
];
$this->load->view('layouts/header', ["head_files"=>$head_files]);
?>

<div class='w3-center w3-margin-12 w3-animate-opacity'>
   <img src='<?php echo base_url('assets/img/entrada-icon.png'); ?>'></img>
</div>

<form class="w3-boder w3-card-4 w3-padding animated slideInUp" style="width: 76%; margin: auto" method="post" action="<?php echo site_url('equipo/insertarEntrada'); ?>">
   <h2 class="w3-center w3-indigo">Agregar Entrada</h2>
   <label class="w3-label">Serial:</label>
   <input type="text" name="id_equipo" id="observacion-id_equipo" required class="w3-input w3-border" style="width: 95%" list="seriales" autocomplete="off" />
   <datalist id="seriales">
            <?php
               foreach($seriales as $valor){
                  echo "<option value='" . $valor ."'/>";
               }
            ?>
   </datalist>

   <label class="w3-label">Tema:</label>
   <input type="text" name="tema" id="observacion-tema" required class="w3-input w3-border" style="width: 95%"/>

   <label class="w3-label">Mensaje:</label>
   <textarea name="mensaje" id="observacion-mensaje" required class="w3-input w3-border" style="width: 95%"></textarea>
   <div class="w3-center">
      <button class="w3-btn w3-indigo w3-margin-8">Guardar</button>
   </div>
</form>
<?php
   $this->load->view("layouts/footer");
?>
