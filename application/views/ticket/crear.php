<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);


echo form_open_multipart("ticket/insertar", ["class"=>"w3-form"]);

echo form_label("Su nombre: ","ticket-nombre");
echo form_input(["type"=>"name", "name"=>"nombre", "id"=>"ticket-nombre", "class"=>"w3-input"]);
echo "<br/>";

echo form_label("Su correo: ", "ticket-email");
echo form_input(["type"=>"email","name"=>"email", "placeholder"=>"Correo corporativo (ejemplo@lagobo.com.co)", "class"=>"w3-input"]);
echo "<br/>";

echo form_label("Su sucursal: ","ticket-id_sucursal");
echo form_dropdown("id_sucursal", $id_sucursal,null,"id='ticket-id_sucursal' class='w3-select w3-border'");
echo "<br/>";

echo form_label("Categoría: ", "ticket-id_sucursal");
echo form_dropdown("categoria", ["Opotudata", "Aurora", "Redes", "Soluciones de hardware", "Otro"], "0", "id='ticket-id_sucursal' class='w3-select w3-border'");
echo "<br/>";

echo form_label("Serial del equipo: ", "observacion-id_equipo");
echo form_input(["type"=>"text", "name"=>"id_equipo", "id"=>"observacion-id_equipo", "class"=>"w3-input"]);
echo "<br/>";

echo form_label("Tema: ", "observacion-tema");
echo form_input(["type"=>"text", "name"=>"tema", "id"=>"observacion-tema", "class"=>"w3-input" ]);
echo "<br/>";

echo form_label("Descripción", "observacion-mensaje");
echo form_textarea(["rows"=>"10", "cols"=>"50", "name"=>"descripcion", "class"=>"w3-input w3-border"]);
echo "<br/>";

echo form_label("Adjuntos: ", "observacion-fotografias");
echo "<input type='file' name='fotografias' id='observacion-fotografias' accept='image/*' class='w3-input'/>";
echo "<br/>";

echo $captcha['image'];

echo form_input(["type"=>"text",
                 "name"=>"captcha_usuario",
                 "placeholder"=>"Ingrese el texto de la imagen",
                 "value"=>!empty($captcha_usuario)? $captcha_usuario : null,
                 "class"=>"w3-input"]
                );
echo "<br/>";

echo form_error('captcha-usuario','<p style="color:#F83A18">','</p>');
echo form_submit("envio", "Crear");
echo form_close();
echo validation_errors();

?>

