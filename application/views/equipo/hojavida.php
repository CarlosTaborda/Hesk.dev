<!DOCTYPE HTML>
<html lang="es">
   <head>
      <link rel="stylesheet" href="<?php echo base_url('assets/css/w3.css'); ?>" />
      <meta charset="utf-8"/>
      <title>Mesa de Ayuda - Hoja de Vida</title>
   </head>
   <body>
      <h1 class="w3-center w3-indigo" style="margin-top: 0px">Mesa de Ayuda</h1>
      <div class="w3-center">
         <img src="<?php echo base_url('assets/img/logo_lagobo.png'); ?>"/>
      </div>
      <h2 class="w3-center w3-text-indigo">Hoja de Vida</h2>
      <div>
      <?php

         for($i=0; $i<count($resultado['id_observacion']); $i++){
            echo "<div class='w3-padding-large w3-border-left w3-border-blue' style='width: 85%; margin:auto'>";
            echo "<label class='w3-label'>ID de Entrada: </label>".$resultado['id_observacion'][$i]."<br/>";
            echo "<label class='w3-label'>Serial del equipo: </label>".$resultado['id_equipo'][$i]."<br/>";
            echo "<label class='w3-label'>Tema:</label><b>".$resultado['tema'][$i]."</b><br/>";
            echo "<label class='w3-label'>Fecha:</label><b class='w3-text-red'>".$resultado['fecha'][$i]."</b><br/>";
            echo "<label class='w3-label'>Contenido:</label><br/><p class='w3-padding-medium'>".$resultado['mensaje'][$i]."</p><br/>";
            echo "</div>";
            echo "<div style='height:1em'></div>";
         }
      ?>
      </div>

<?php
$this->load->view('layouts/footer');
?>

