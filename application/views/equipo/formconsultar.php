<?php
$usuarios_permitidos=['adm'];
if(!$this->Usuario_model->permitirVistaUsuario($usuarios_permitidos, $this->session->all_userdata())){
   header("Location: " . site_url('usuario/index'));
}

$this->load->view("layouts/header");
?>

<div class='w3-center w3-margin-12 w3-animate-opacity'>
  <img src="<?php echo base_url('assets/img/search2-icon.png'); ?>"></img>
</div>

<form class="w3-card-4 w3-border w3-padding animated rollIn" style="width: 70%; margin: auto" action="<?php echo site_url('equipo/traerEquipo'); ?>" method="post">
  <h2 class="w3-center w3-indigo">Consultar Equipo</h2>
  <label class="w3-label">Serial:</label>
  <input type="text" name="id_equipo" placeholder="Ingrese el serial del equipo" pattern="[A-z0-9*+-.&]{2,30}" class="w3-input w3-border" style="width:95%" autocomplete="off" list="seriales" required />
  <datalist id="seriales">
    <?php
     foreach($seriales as $valor){
       echo "<option value='" . $valor ."'/>";
      }
     ?>
  </datalist>

  <div class="w3-center w3-margin-8">
      <button class="w3-btn w3-indigo" type="submit">Consultar</button>
  </div>
</form>
<?php
  $this->load->view("layouts/footer");
?>
