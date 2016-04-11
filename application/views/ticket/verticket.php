<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$usuarios_permitidos=['adm',"con"];
if(!$this->Usuario_model->permitirVistaUsuario($usuarios_permitidos, $this->session->all_userdata())){
    header("Location: " . site_url('usuario/index'));
}

//archivos de la cabecera
$head_files[]="<script type='text/javascript' src='" . base_url("assets/js/jqueryupload.js") . "'></script>";

$this->load->view('layouts/header', ["head_files"=>$head_files]);

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
?>

<div name='info' style="display:none">
   <button value="<?php echo $this->session->userdata('correo'); ?>" id="update_correo">Correo</button>
   <button value="<?php echo $this->session->userdata('nombre'); ?>" id="update_nombre" >Nombre</button>
   <button value="<?php echo $this->session->userdata('rol'); ?>" id="update_nombre" >Rol</button>
</div>

<?php
echo "<div class='w3-center w3-margin-12 w3-animate-opacity'>";
echo "<img src='".base_url('assets/img/ticket1-icon.png')."'></img>";
echo "</div>";

for($i=0; $i<count($resultado['id_ticket']); $i++){
   echo "<div class='w3-card-2 w3-border w3-padding-medium w3-content' style='width:95%'>";
   echo "<h2 class='w3-indigo w3-center'>Tickets</h2>";
   echo "<button class='w3-btn w3-blue w3-margin-2 tickets'onclick='borrarTicket(this)' value='".$resultado['id_ticket'][$i]."'>Eliminar</button>";
   echo "<button class='w3-btn w3-blue w3-margin-2'onclick='mostrarResponder()' >Responder</button><br/>";
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
   echo "<br/><b class='w3-text-black'>Contenido: </b><br/><article style='max-height:14em; overflow-y:scroll' id='mensaje_anterior".$resultado['id_ticket'][$i]."'>" . $resultado['mensaje'][$i] . "</article><br/>";
   echo "<div id='form_responder' style='display:none'>";
   echo "<label class='w3-label'>Cambiar Estado:</label><br/>";
   echo "<select name='estado_update' id='estado_update' class='w3-select w3-border'>";
   echo "<option value='Nuevo'>Nuevo</option>";
   echo "<option value='En espera'>En espera</option>";
   echo "<option value='En proceso'>En proceso</option>";
   echo "<option value='Resuelto'>Resuelto</option>";
   echo "</select>";
   echo "<input type='hidden' id='id_observacion' value='".$resultado['id_observacion'][$i]."' />";
   if($this->session->userdata('rol')!="con"){
      echo "<label class='w3-label'>Asignar a:</label><br/>";
      echo form_dropdown('correos', $correos, null, "class='w3-select w3-border' id='update_correo'");
   }
   echo "<label class='w3-label'>Mensaje:</label><br/>";
   echo "<textarea id='mensaje-adm".$resultado['id_ticket'][$i]."' class='w3-input w3-border w3-margin-4' style='width:95%'></textarea>";
   //echo "<label class='w3-label'>Adjuntos: </label>";
   //echo "<input type='file' name='fotografias'  class='w3-input w3-border' style='width:95%' accept='image/*' id='update-fotografias' class='fileUpload'/>";
   echo "<button class='w3-btn w3-indigo w3-margin-8' value='". $resultado['id_ticket'][$i] ."' onclick='actualizarTicket(this.value)' >Responder</button>";
   echo "<button class='w3-btn w3-indigo w3-margin-8' onclick='ocultarResponder()' >Ocultar</button>";
   echo "</div>";
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
               boton.parentElement.classList.add('animated');
               boton.parentElement.classList.add('fadeOutRightBig');
               window.setTimeout(function(){boton.parentElement.remove();}, 2000);
            }
         );
      }
   }

   function actualizarTicket(id){
      var mensaje= $('#mensaje-adm'+id);
      var nombre=$('#update_nombre').val();
      var correo=$('#update_correo').val();
      var antMensajes= $('#mensaje_anterior'+id);
      var asignado=$('#update_correo').val();
      var estado_ticket=$('#estado_update').val();
      var id_observacion=$('#id_observacion').val();


      if(mensaje.val()!="" && mensaje.val()!=null){
         var nuevoMensaje=antMensajes.html();
         nuevoMensaje+="<div class='w3-light-blue w3-padding-small w3-border'>";
         nuevoMensaje+="Fecha: <b>"+new Date().toLocaleString()+"</b><br/>";
         nuevoMensaje+="Nombre: <b>"+nombre+"</b><br/>";
         nuevoMensaje+="Correo: <b>"+correo+"</b><br/>";
         nuevoMensaje+="<b>Comentario: </b><br/><p>"+mensaje.val()+"</p>";
         nuevoMensaje+="</div>";

         $.post(
            window.location.origin+"/index.php/ticket/responderTicket",
            {
             id_observacion: id_observacion,
             id_ticket: id,
             mensaje: nuevoMensaje,
             asignadoA: asignado,
             estado:estado_ticket
            }
         );
       }
       else{
          $.post(
            window.location.origin+"/index.php/ticket/responderTicket",
            {
             id_observacion: id_observacion,
             id_ticket: id,
             asignadoA: asignado,
             estado:estado_ticket
            }
         );
       }
       location.reload();
   }

   function mostrarResponder(){
      $('#form_responder').show('1500');
   }

   function ocultarResponder(){
      $('#form_responder').hide('1500');
   }

   $(document).ready(
     function(){
       var botones=document.getElementsByClassName('tickets');
       for(var i=0; i<botones.length; i++){
         if(botones.item(i).value==0 || botones.item(i).value=="0" ){
           botones.item(i).parentElement.style.display="none";
         }
       }
     }
   );
</script>
