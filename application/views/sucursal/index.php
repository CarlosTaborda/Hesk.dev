<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo validation_errors();
echo form_open('sucursal/insertar');

echo form_label("Código númerico de sucursal: <br/>", "sucursal-id_sucursal", [
                                                                              "class"=>"w3-label"
                                                                              ]);
echo form_input([
                  "type"=>"number",
                  "name"=>"id_sucursal",
                  "id"=>"sucursal-id_sucursal",
                  "class"=>"w3-input w3-border"
               ]);

echo form_label("Código alfabético de sucursal: <br/>", "sucursal-codigo", [
                                                                           "class"=>"w3-label"
                                                                           ]);
echo form_input([
                  "type"=>"text",
                  "name"=>"codigo",
                  "id"=>"sucursal-codigo",
                  "class"=>"w3-input w3-border"
               ]);
echo "<br/>";
echo "<div class='w3-center'>";
echo form_submit("crear", "Crear", "class='w3-btn w3-indigo'");
echo "<div>";
form_close();
?>

