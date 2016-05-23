<?php
$this->load->view("layouts/header");
?>


<div class='w3-center w3-margin-12 w3-animate-opacity'>
  <img src="<?php echo base_url('assets/img/computer-icon.png'); ?>"></img>
</div>

<div class="w3-card-4 w3-padding " style="width: 75%; margin: auto">
   <h2 class="w3-indigo w3-center">Cambiar estado del equipo</h2>
   <blockquote>
      <label class="w3-label">Activo Fijo del Equipo:</label><br/>
      <div class="w3-row">
         <div class="w3-col w3-half">
            <input type="text" class="w3-input w3-border" id="equipo-activoFijo" list="activos_fijos"/>
            <datalist id="activos_fijos">
           <?php
               foreach($activos as $valor){
                  echo "<option value='" . $valor ."'/>";
               }
            ?>
            </datalist>
         </div>
         <div class="w3-col w3-third" style="margin-left: 2em">
            <select class="w3-select w3-border" id="equipo-estado">
               <option>--estado--</option>
               <option value="por pedir">Por Pedir</option>
               <option value="por despachar">Por Despachar</option>
               <option value="en reparación pedir">En Reparación</option>
               <option value="ninguno">Ninguno</option>
            </select>
         </div>
      </div>

      <div class="w3-center w3-margin">
            <button class="w3-btn w3-indigo" id="equipo_cambiarEstado">Cambiar</button>
      </div>
   </blockquote>
</div>

<script type="text/javascript">
   $(document).ready(
      function(){
         $("#equipo_cambiarEstado").click(
            function(){
               var activoFijo=$("#equipo-activoFijo").val();
               var estado=$("#equipo-estado").val();

               if(activoFijo!=null && activoFijo!="" && estado!=null && estado!=""){
                  $.post(
                     window.location.origin+"/index.php/equipo/cambiarEstado",
                     {
                        estado: [activoFijo, estado]
                     },
                     function(data, status){
                        console.log(data);
                     }
                  );
               }else{
                  alert("Datos ingresados inválidos.");
               }
            }
         );
      }
   );
</script>
<?php
$this->load->view("layouts/footer");
?>

