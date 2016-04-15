<?php

$usuarios_permitidos=['adm'];
if(!$this->Usuario_model->permitirVistaUsuario($usuarios_permitidos, $this->session->all_userdata())){
   header("Location: " . site_url('usuario/index'));
}


error_reporting(E_ALL);
ini_set('display_errors', 1);

echo validation_errors();
echo form_open('sucursal/insertar',[
   "class"=>"w3-form w3-card-4 w3-border w3-content animated fadeInDown",
   "style"=>"width:80%"
]);

echo "<h2 class='w3-indigo w3-center'>Crear una Sucursal</h2>";
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
echo "</div>";
echo form_close();
?>
