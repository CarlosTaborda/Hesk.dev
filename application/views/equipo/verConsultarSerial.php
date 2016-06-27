<?php
$this->load->view("layouts/header");
?>

<div class="w3-card-4 w3-border w3-padding" style="width: 75%; margin: auto">
  <h2 class="w3-indigo w3-center">Consultar serial de un equipo</h2>
  <label class="w3-label">Introduce el código de activo fijo:</label>
  <input type="text" name="activo-fijo" class="w3-border w3-input"/>
  <div class="w3-center w3-margin-8">
    <button id="boton-consultar" class="w3-btn w3-indigo">Consultar</button>
  </div>
</div>

<section id="tabla">
</section>

<script>

$("#boton-consultar").click( function(){
  var activoFijo = $("[name=activo-fijo]").val();
  $.post(
    window.location.origin+"/index.php/equipo/consultarActivoFijo",
    {
      activoFijo: activoFijo
    },
    function(data, status){
      $("#tabla").html(data);
    }
  );
}
);
</script>


<?php
$this->load->view("layouts/footer");
?>
