<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$usuarios_permitidos=['adm'];
if(!$this->Usuario_model->permitirVistaUsuario($usuarios_permitidos, $this->session->all_userdata())){
   $this->index();
}

$this->load->view('layouts/header');

echo form_open('ticket/verTickets', [
   "class"=>"w3-form w3-card-4 w3-border w3-content"
]);
?>

<h2 class='w3-center w3-indigo'>Consultar Tickets</h2>
<div class='w3-row'>
   <article class='w3-half'>
      <label class='w3-label'>Filtrar:</label><br/>
      <select name="estado" class="w3-select w3-border">
         <option value="">Todo</option>
         <option value="Nuevo">Nuevo</option>
         <option value="En espera">En espera</option>
         <option value="En proceso">En proceso</option>
         <option value="Resuelto">Resuelto</option>
      </select>
   </article>

   <article class='w3-third' style="margin-left:1em;">
      <label class="w3-label">Ordenar por:</label>
      <select name="fecha" class="w3-select w3-border">
         <option value="DESC">Más nuevo</option>
         <option value="ASC">Más antiguo</option>
      </select>
   </article>
</div>


<?php
echo "<div class='w3-center'>";
echo form_submit('consulta', 'Consultar', "class='w3-btn w3-indigo w3-margin-8'");
echo "</div>";
echo form_close();
echo "<div style='height:3em'></div>";
echo "<div class='w3-center w3-margin-12 w3-animate-opacity'>";
echo "<img src='".base_url('assets/img/ticket1-icon.png')."'></img>";
echo "</div>";

for($i=0; $i<count($resultado['id_ticket']); $i++){
   echo "<div class='w3-card-2 w3-border w3-padding-medium w3-content' style='width:95%'>";
   echo "<h2 class='w3-indigo w3-center'>Tickets</h2>";
   echo "<button class='w3-btn w3-blue'onclick='borrarTicket(this)' value='".$resultado['id_ticket'][$i]."'>Eliminar</button><br/>";
   echo "<b class='w3-text-black'>Código de seguimiento: </b>". $resultado['id_ticket'][$i] . "<br/>";
   echo "<b class='w3-text-black'>Nombre: </b>" . $resultado['nombre'][$i] . "<br/>";
   echo "<b class='w3-text-black'>Fecha: </b><b class='w3-text-indigo'>" . $resultado['fecha'][$i] . "</b><br/>";
   echo "<b class='w3-text-black'>Correo: </b>" . $resultado['correo'][$i] . "<br/>";
   echo "<b class='w3-text-black'>Estado: </b><b class='w3-text-red'>" . $resultado['estado'][$i] . "</b><br/>";
   echo "<b class='w3-text-black'>Categoría: </b>" . $resultado['categoria'][$i] . "<br/>";
   echo "<b class='w3-text-black'>Código de sucursal: </b>" . $resultado['id_sucursal'][$i] . "<br/>";
   echo "<b class='w3-text-black'>Responsable: </b>" . $resultado['email_responsable'][$i] . "<br/>";
   echo "<b class='w3-text-black'>Tema: </b>" . $resultado['tema'][$i] . "<br/>";
   echo "<b class='w3-text-black'>Adjuntos: </b><br/>" . $resultado['fotografias'][$i] . "<br/>";
   echo "<br/><b class='w3-text-black'>Contenido: </b><br/>" . $resultado['mensaje'][$i] . "<br/>";
   echo "</div>";
   echo "<div style='height:1em'></div>";
}

echo $this->pagination->create_links();
$this->load->view('layouts/footer');
?>

<script type="text/javascript">
   function borrarTicket(boton){
      if(confirm("¿Desea borra este ticket?\n"+boton.value)){
         $.post(
            window.location.origin+"/index.php/ticket/borrarTicket",
            {id_ticket: boton.value},
            function(){
               boton.parentElement.classList.add('fadeInRight animated');
            }
         );
      }
   }
</script>

