<?php

echo "<div class='w3-center w3-margin-12 w3-animate-opacity'>";
echo "<img src='".base_url('assets/img/login-icon.png')."'></img>";
echo "</div>";

echo validation_errors();
echo form_open('usuario/ingresar', [
   "class"=>"w3-form w3-card-8 w3-border w3-content",
   "style"=>"width:80%"
]);

echo "<h2 class='w3-indigo w3-center'>Ingreso</h2>";
echo form_label('Correo: <br/>', 'usuario-correo', ['class'=>'w3-label']);
echo form_input([
   "type"=>"email",
   "name"=>"correo",
   "id"=>"usuario-correo",
   "class"=>"w3-input w3-border",
   "required"=>"true"
]);

echo form_label('Contraseña: <br/>', 'usuario-contrasena', ['class'=>'w3-label']);
echo form_input([
   "type"=>"password",
   "name"=>"contrasena",
   "id"=>"usuario-contrasena",
   "class"=>"w3-input w3-border",
   "required"=>"true"
]);

echo "<div class='w3-center'>";
echo form_submit('ingresar', "Ingresar", "class='w3-btn w3-indigo w3-margin-12'");
echo "</div>";


echo form_close();


/* FORMULARIO DE REGISTRO  */

echo "<div class='w3-center w3-margin-12 w3-animate-opacity'>";
echo "<img src='".base_url('assets/img/register-icon.png')."'></img>";
echo "</div>";

echo validation_errors();

echo form_open('usuario/registar', [
   "class"=>"w3-form w3-card-8 w3-border w3-content ",
   "style"=>"width: 80%;",
]);

echo "<h2 class='w3-indigo w3-center'>Registro</h2>";

echo form_label('Nombre: <br/>', 'usuario-nombre', ['class'=>'w3-label']);
echo form_input([
   "type"=>"name",
   "name"=>"nombre",
   "id"=>"usuario-nombre",
   "required"=>"true",
   "class"=>"w3-input w3-border"
]);

echo form_label('Correo: <br/>', 'usuariob-correo', ["class"=>"w3-label"]);
echo form_input([
   "type"=>"email",
   "name"=>"correo",
   "id"=>"usuariob-correo",
   "class"=>"w3-input w3-border",
   "required"=>"true",
]);

echo form_label("Contraseña: <br/>", "usuariob-contrasena", ["class"=>"w3-label"]);
echo form_input([
   "type"=>"password",
   "required"=>"true",
   "name"=>"contrasena",
   "id"=>"usuariob-contrasena",
   "class"=>"w3-input w3-border"
]);


echo form_label("Rol: <br/>", "usuario-rol", ["class"=>"w3-label"]);
echo form_dropdown('rol',[
   ""=>"-seleccione-",
   "adm"=>"Administrador",
   "aud"=>"Auditor",
   "usu"=>"Usuario"
], "", "class='w3-select w3-border' required='true' id='usuario-rol'");


echo form_label('Categorías: <br/>', "", ["class"=>"w3-label"]);
?>

<div class='w3-row'>
   <article class='w3-half'>
         <input type='checkbox' value='hardware' class='w3-check' id="usuario-hardware" name="categoria[]" checked />
         <label class='w3-validate' for="usuario-hardware">Hardware</label><br/>

         <input type='checkbox' value='oportudata' class='w3-check' id="usuario-oportudata" name="categoria[]" />
         <label class='w3-validate' for="usuario-oportudata">Oportudata</label><br/>

         <input type='checkbox' value='redes' class='w3-check' id="usuario-redes" name="categoria[]" />
         <label class='w3-validate' for="usuario-redes">Redes</label>
   </article>

   <article class='w3-half'>
      <input type='checkbox' value='aurora' class='w3-check' id="usuario-aurora" name="categoria[]" />
      <label class='w3-validate' for="usuario-aurora" >Aurora</label><br/>

      <input type='checkbox' value="otro" class='w3-check' id="usuario-otro" name="categoria[]" />
      <label class='w3-validate' for="usuario-otro">Otro</label>
   </article>
</div>
<?php
   echo "<div class='w3-center'>";
   echo form_submit('registro', "Registrar", "class='w3-btn w3-indigo'");
   echo "</div>";
   echo form_close();
?>

