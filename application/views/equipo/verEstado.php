<?php $this->load->view("layouts/header"); ?>
<form class="w3-card-4 w3-border" style="width: 75%; margin: auto" method="post" action="<?php echo(site_url('equipo/verEstado')); ?>">
  <h2 class="w3-indigo w3-center">Consultar por Estado</h2>
  <blockquote>
    <label class="w3-label">Estado: </label>
    <select class="w3-select w3-border" id="estado_equipo" name="estado" required>
      <option>--estado--</option>
      <option value="por llegar">Por Llegar</option>
      <option value="por despachar">Por Despachar</option>
      <option value="en reparación pedir">En Reparación</option>
      <option value="ninguno">Ninguno</option>
    </select>
    <div class="w3-center">
        <button class="w3-btn w3-indigo w3-margin" id="btn_consultar">Consultar</button>
    </div>
  </blockquote>
</form>

  <div>
      <?php
         if(!empty($tabla)){
            echo $tabla;
         }
      ?>
  </div>

  <label>
      <?php echo $this->pagination->create_links(); ?>
  </label>

<?php
$this->load->view("layouts/footer");
?>

