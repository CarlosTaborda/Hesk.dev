<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
echo "<div class='w3-center w3-margin-12 w3-animate-opacity'>";
echo "<img src='".base_url('assets/img/ticket-icon.png')."'></img>";
echo "</div>";
echo !empty($errors)? $errors : "";
echo validation_errors();

echo form_open_multipart("ticket/obtener", [
   "class"=>"w3-form w3-card-4 w3-border w3-content",
   "style"=>"width: 80%"]
);

echo "<h2 class='w3-indigo w3-center'>Crear Ticket</h2>";

echo form_label("Su nombre: ","ticket-nombre", ["class"=>"w3-label"]);
echo form_input(["type"=>"name",
                 "name"=>"nombre", "id"=>"ticket-nombre",
                 "class"=>"w3-input w3-border"]);
echo "<br/>";

echo form_label("Su correo: ", "ticket-email" , ["class"=>"w3-label"]);
echo form_input(["type"=>"email",
                 "name"=>"correo",
                 "placeholder"=>"Correo corporativo (ejemplo@lagobo.com.co)",
                 "class"=>"w3-input w3-border"]);
echo "<br/>";

echo form_label("Su sucursal: ","ticket-id_sucursal", ["class"=>"w3-label"]);
echo form_dropdown("id_sucursal", $id_sucursal,null,"id='ticket-id_sucursal' class='w3-select w3-border'");
echo "<br/>";

echo form_label("Categoría: ", "ticket-categoria",["class"=>"w3-label"]);
echo form_dropdown("categoria", [
                                 "oportudata"=>"Opotudata",
                                 "aurora"=>"Aurora",
                                 "redes"=>"Redes",
                                 "hardware"=>"Soluciones de hardware",
                                 "otro"=>"Otro"]
                  , "0", "id='ticket-categoria' class='w3-select w3-border'");
echo "<br/>";

echo form_label("Serial del equipo: ", "observacion-id_equipo", ["class"=>"w3-label"]);
echo form_input(["type"=>"text",
                 "name"=>"id_equipo",
                 "id"=>"observacion-id_equipo",
                 "class"=>"w3-input w3-border"]);
echo "<br/>";

echo form_label("Tema: ", "observacion-tema", ["class"=>"w3-label"]);
echo form_input(["type"=>"text", "name"=>"tema", "id"=>"observacion-tema", "class"=>"w3-input w3-border" ]);
echo "<br/>";

echo form_label("Descripción: ", "observacion-mensaje", ["class"=>"w3-label"]);
echo form_textarea(["rows"=>"10", "cols"=>"50", "name"=>"mensaje", "class"=>"w3-input w3-border"]);
echo "<br/>";

echo form_label("Adjuntos: ", "observacion-fotografias", ["class"=>"w3-label"]);
echo "<input type='file' name='fotografia1' id='observacion-fotografias' accept='image/*' class='w3-input'/>";
echo "<input type='file' name='fotografia2' id='observacion-fotografias' accept='image/*' class='w3-input'/>";
echo "<br/>";

echo "<div class='w3-center'>";
echo $captcha['image'];
echo "</div>";
echo form_input(["type"=>"text",
                 "name"=>"captcha_usuario",
                 "placeholder"=>"Ingrese el texto de la imagen",
                 "value"=>!empty($captcha_usuario)? $captcha_usuario : null,
                 "class"=>"w3-input  w3-border w3-animate-input",
                 "style"=>"width: 70%",
                 ]
                );
echo "<br/>";

echo "<div class='w3-center'>";
echo form_submit("envio", "Crear", "class='w3-btn w3-indigo'");
echo "</div>";
echo form_close();

?>
<script type="text/javascript">
$(document).ready(
   function(){
      $('label[for=observacion-id_equipo], #observacion-id_equipo').hide();
      $('#ticket-categoria').on('change',
         function(){
            var valor = $('#ticket-categoria').val();
            if(valor=="hardware"){
               $('label[for=observacion-id_equipo], #observacion-id_equipo').show('2500');
            }
            else{
               $('label[for=observacion-id_equipo], #observacion-id_equipo').hide('2500');
            }
         }
      );
   }
);
</script>
