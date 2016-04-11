<?php
$this->load->view("layouts/header");
?>

<div class='w3-center w3-margin-12 w3-animate-opacity'>
  <img src="<?php echo base_url('assets/img/computer-icon.png'); ?>"></img>
</div>

<div class="w3-card-2 w3-padding w3-border-blue" style="border-left: 4px solid; width: 70%; margin: auto">
  <h2 class="w3-center w3-indigo">Equipo</h2>
  <?php
    echo "<label class='w3-label'>Serial: </label>" . $respuesta["id_equipo"][0] . "<br/>";
    echo "<label class='w3-label'>Activo Fijo: </label>" . $respuesta["activo_fijo"][0] . "<br/>";
    echo "<label class='w3-label'>Marca: </label>" . $respuesta["marca"][0] . "<br/>";
    echo "<label class='w3-label'>Modelo: </label>" . $respuesta["modelo"][0] . "<br/>";
    echo "<label class='w3-label'>Fecha de compra: </label>" . $respuesta["fecha_compra"][0] . "<br/>";
    echo "<label class='w3-label'>Asignado a: </label>" . $respuesta["asignado_a"][0] . "<br/>";
    echo "<label class='w3-label'>Sucursal: </label>" . $respuesta["sucursal"][0] . "<br/>";

  ?>
</div>
<?php
  $this->load->view("layouts/footer");
?>
