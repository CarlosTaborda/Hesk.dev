<?php
$usuarios_permitidos=['adm'];
if(!$this->Usuario_model->permitirVistaUsuario($usuarios_permitidos, $this->session->all_userdata())){
   header("Location: " . site_url('usuario/index'));
}

$this->load->view('layouts/header');
?>
<div class='w3-center w3-margin-12 w3-animate-opacity'>
   <img src='<?php echo base_url('assets/img/hv-icon.png'); ?>'></img>
</div>

<form class="w3-card-4 w3-border w3-padding animated lightSpeedIn" style="width: 72%; margin:auto" method="post" action="<?php echo site_url('equipo/verHojaVida'); ?>">
   <h2 class="w3-center w3-indigo">Consultar la Hoja de Vida</h2>
   <label class="w3-label" for="observacion-id_equipo">Ingrese el serial:</label>
   <input type="text" name="id_equipo" id="observacion-id_equipo" class="w3-input w3-border" style="width: 95%" list="seriales" autocomplete="off" required/>
   <datalist id="seriales">
     <?php
      foreach($seriales as $valor){
        echo "<option value='" . $valor ."'/>";
       }
      ?>
   </datalist>
   <div class="w3-center">
      <button class="w3-btn w3-indigo w3-margin-8">Consultar</button>
   </div>
</form>

<?php
$this->load->view("layouts/footer");
?>
