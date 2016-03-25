
<div class='w3-animate-opacity w3-card-8 w3-margin-12 w3-border w3-padding-medium'>
   <h2 class="w3-text-indigo w3-center">Su ticket</h2>
<?php
   echo "<b class='w3-text-black'>Código de seguimiento: </b>". $ticket['id_ticket'] . "<br/>";
   echo "<b class='w3-text-black'>Nombre: </b>" . $ticket['nombre'] . "<br/>";
   echo "<b class='w3-text-black'>Correo: </b>" . $ticket['correo'] . "<br/>";
   echo "<b class='w3-text-black'>Estado: </b>" . $ticket['estado'] . "<br/>";
   echo "<b class='w3-text-black'>Categoría: </b>" . $ticket['categoria'] . "<br/>";
   echo "<b class='w3-text-black'>Código de sucursal: </b>" . $ticket['id_sucursal'] . "<br/>";
   echo "<b class='w3-text-black'>Responsable: </b>" . $ticket['email_responsable'] . "<br/>";
   echo "<b class='w3-text-black'>Tema: </b>" . $ticket['tema'] . "<br/>";
   echo "<b class='w3-text-black'>Adjuntos: </b><br/>" . $ticket['fotografias'] . "<br/>";
   echo "<br/><b class='w3-text-black'>Contenido: </b><br/>" . $ticket['mensaje'] . "<br/>";
?>
</div>

