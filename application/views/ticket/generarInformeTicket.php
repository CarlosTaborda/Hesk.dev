<?php
$head_files=[
  '<script src="http://code.jquery.com/jquery-migrate-1.0.0.js"></script>',
  '<link rel="stylesheet" href="'. base_url('assets/css/flick/jquery-ui.css') .'" />',
  '<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.min.js"></script>'
];
$this->load->view('layouts/header', ["head_files"=>$head_files]);
?>

<div>
<div class='w3-center w3-margin-12 w3-animate-opacity'>
  <img src='<?php echo base_url('assets/img/report_icon.png'); ?>' ></img>
</div>

<form class="w3-card-4 w3-padding" style="width: 75%; margin:auto" action="<?php echo site_url('ticket/exportarTickets') ?>" method="post">
  <h2 class="w3-indigo w3-center">Exportar informes de tickets a Excel</h2>
  <blockquote class="w3-row">
    <div class="w3-half">
      <label class="w3-label">Fecha de inicio: </label>
      <input type="text" class="w3-input w3-border" style="width:70%" id="id_inicio" name="fecha_inicio" required/>
    </div>
    <div class="w3-half">
      <label class="w3-label">Fecha final: </label>
      <input type="text" class="w3-input w3-border" style="width:70%" id="id_final" name="fecha_fin" required=""/>
    </div>
  </blockquote>


  <div class="w3-center w3-margin">
    <button class="w3-btn w3-indigo">Generar</button>
  </div>
</form>

 <script type="text/javascript">
  $(document).ready(
    function($){
      $.datepicker.regional['es'] = {
        dateFormat: "yy-mm-dd",
        closeText: 'Cerrar',
        prevText: '<Ant',
        nextText: 'Sig>',
        currentText: 'Hoy',
        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
        dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
        dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
        dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
        weekHeader: 'Sm',
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: ''
    };
    $.datepicker.setDefaults($.datepicker.regional['es']);

      $("#id_inicio").datepicker({altFormat: "yy-mm-dd"});
      $("#id_final").datepicker({altFormat: "yy-mm-dd"});
    }
  );
 </script>
<?php
$this->load->view("layouts/footer");
?>
