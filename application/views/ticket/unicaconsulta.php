
<div class='w3-animate-opacity w3-card-8  w3-border w3-padding-medium animated shake' style="width: 75%; margin: auto;">
   <h2 class="w3-indigo w3-center">Su ticket</h2>
<?php
   echo "<b class='w3-text-black'>Código de seguimiento: </b>". $ticket['id_ticket'] . "<br/>";
   echo "<input type='hidden' value='" . $ticket['id_observacion'] . "' id='observacion-id_observacion' />";
   echo "<b class='w3-text-black'>Nombre: </b>" . $ticket['nombre'] . "<br/>";
   echo "<b class='w3-text-black'>Correo: </b>" . $ticket['correo'] . "<br/>";
   echo "<b class='w3-text-black'>Estado: </b>" . $ticket['estado'] . "<br/>";
   echo "<b class='w3-text-black'>Categoría: </b>" . $ticket['categoria'] . "<br/>";
   echo "<b class='w3-text-black'>Código de sucursal: </b>" . $ticket['id_sucursal'] . "<br/>";
   echo "<b class='w3-text-black'>Responsable: </b>" . $ticket['email_responsable'] . "<br/>";
   echo "<b class='w3-text-black'>Tema: </b>" . $ticket['tema'] . "<br/>";
   echo "<b class='w3-text-black'>Adjuntos: </b><br/>" . $ticket['fotografias'] . "<br/>";
   echo "<br/><b class='w3-text-black'>Contenido: </b><br/><article id='contenido-ant' style='max-height: 16em; overflow-y: scroll;'>" . $ticket['mensaje'] . "</article>";
?>
  <div style="margin-top: 2em;">
      <label class="w3-label">Responde:</label>
      <textarea style="width: 99%;" class="w3-border w3-input" id="observacion-respuesta"></textarea>
      <section class="w3-center w3-margin-8">
        <button class="w3-btn w3-indigo" onclick="responder()">Responder</button>
      </section>
  </div>
</div>
<script type="text/javascript">
function responder(){
  if($("#observacion-respuesta").val()!=""  && $("#observacion-respuesta").val()!=null){
     var mensaje =$("#contenido-ant").html();
     mensaje += "<div class='w3-light-grey w3-border w3-margin-4'>";
     mensaje += "<b>Fecha: </b>"+new Date().toLocaleString()+"<br/>"+htmlEntities($("#observacion-respuesta").val());
     mensaje+="</div>";

     var id_observacion= $("#observacion-id_observacion").val();
     $.post(
         window.location.origin+"/index.php/ticket/responderTicket",
         {
            mensaje: mensaje,
            id_observacion: id_observacion
         }
         ,
         function(data, status){
            $("#observacion-respuesta").val("");
            location.reload();
         }
     );
  }
  else{
     alert("No hay nada para responder");
  }
}
</script>

