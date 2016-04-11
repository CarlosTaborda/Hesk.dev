<?php
//Permitir usuarios o denegarlos dependiendo del rol
$usuarios_permitidos=['adm'];
if(!$this->Usuario_model->permitirVistaUsuario($usuarios_permitidos, $this->session->all_userdata())){
   header("Location: " . site_url('usuario/index'));
}

$head_files=[
  '<script src="http://code.jquery.com/jquery-migrate-1.0.0.js"></script>',
  '<link rel="stylesheet" href="'. base_url('assets/css/flick/jquery-ui.css') .'" />',
  '<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.min.js"></script>'
];
$this->load->view('layouts/header', ["head_files"=>$head_files]);
?>

<div class='w3-center w3-margin-12 w3-animate-opacity'>
  <img src="<?php echo base_url('assets/img/computer-icon.png'); ?>"></img>
</div>


  <form class="w3-content w3-border w3-card-4  w3-form" style="width:80%" method="post" action="<?php echo site_url('equipo/actualizar'); ?>">
      <h2 class="w3-indigo w3-center">Actualizar un equipo</h2>
      <label class="w3-label" for="equipo-id_equipo">Serial del equipo:</label><br/>
      <input type="text" class="w3-input w3-border" name="id_equipo" id="equipo-id_equipo" style="width: 97%" list="seriales" autocomplete="off" required />
         <datalist id="seriales">
            <?php
               foreach($seriales as $valor){
                  echo "<option value='" . $valor ."'/>";
               }
            ?>
         </datalist>

      <label class="w3-label" for="equipo-activo_fijo">Acitvo fijo:</label><br/>
      <input type="text" class="w3-input w3-border" name="activo_fijo" id="equipo-activo_fijo" style="width: 97%" />

      <label class="w3-label" for="equipo-marca">Marca:</label><br/>
      <input type="text" class="w3-input w3-border" name="marca" id="equipo-marca" style="width: 97%" />

      <label class="w3-label" for="equipo-modelo">Modelo:</label><br/>
      <input type="text" class="w3-input w3-border" name="modelo" id="equipo-modelo" style="width: 97%" />

      <label class="w3-label" for="equipo-fecha_compra">Fecha de compra:</label><br/>
      <input type="date" class="w3-input w3-border" name="fecha_compra" id="equipo-fecha_compra" readonly="readonly" style="width: 97%" />

      <label class="w3-label" for="equipo-modelo">Asignado a:</label><br/>
      <input type="name" class="w3-input w3-border" name="asignado_a" id="equipo-asignado_a" style="width: 97%" />

      <label class="w3-label" for="equipo-sucursal">Sucursal:</label><br/>
      <?php
        echo form_dropdown("sucursal", $sucursales, null, "name='sucursal' id='equipo-sucursal' class='w3-select w3-border' style='width: 97%' required");
      ?>
      <div class="w3-center">
        <button type="submit" class='w3-btn w3-indigo w3-margin-8'>Actualizar</button>
      </div>
  </form>

  <script type="text/javascript">

    $(document).ready(function() {
      jQuery(function($){
        $.datepicker.regional['es'] = {
          closeText: 'Cerrar',
          prevText: '&#x3c;Ant',
          nextText: 'Sig&#x3e;',
          currentText: 'Hoy',
          monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
          'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
          monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun',
          'Jul','Ago','Sep','Oct','Nov','Dic'],
          dayNames: ['Domingo','Lunes','Martes','Mi&eacute;rcoles','Jueves','Viernes','S&aacute;bado'],
          dayNamesShort: ['Dom','Lun','Mar','Mi&eacute;','Juv','Vie','S&aacute;b'],
          dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','S&aacute;'],
          weekHeader: 'Sm',
          dateFormat: 'yy-mm-dd',
          firstDay: 1,
          isRTL: false,
          showMonthAfterYear: false,
          yearSuffix: ''};

          $.datepicker.setDefaults($.datepicker.regional['es']);
        });

      $("#equipo-fecha_compra").datepicker();
      $("#equipo-sucursal").html("<option value=''>--Seleccione--</option>"+$("#equipo-sucursal").html());

    });
  </script>
<?php
$this->load->view('layouts/footer');
?>
