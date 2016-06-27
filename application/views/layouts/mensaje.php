<?php
$tiempo= !empty($tiempo)? $tiempo : 5 ;
$this->load->view('layouts/header',["head_files"=>[
                                                   '<meta http-equiv="Refresh" content="' . $tiempo. ';url='.$url.'" />'
                                                   ]]) ?>


<h1 class="w3-center w3-text-indigo animated pulse">Mesa de ayuda</h1>
  <div class="w3-container w3-border w3-round" style="width: 85%; margin: auto">
    <p>
      La Mesa de ayuda es una plataforma web desarollada por los integrantes del departamento de sistemas de Lagobo Distribuciones S.A
      con el fin de mantener  un control sobre todos los incidentes relacionados con el área de sistemas de su desarrollo
      y posterior solución.<br/><br/>

      <div class="w3-center animated rubberBand">
       <img title="icono_soporte" src="<?php echo base_url('assets/img/support-banner.png'); ?>"/>
      </div><br/>

      La mesa de ayuda pretende facilitar el manejo y otorgar una herramienta tanto a los empleados de las sucursales a nivel
      nacional para exponer sus incovenientes y problemas asimismo a las personas encargadas de darle solución a esos inconvenientes
      manteniendo un registro completo de todo el proceso de resolución de problemas aumentando así la calidad del servicio y obligando
      a la respuesta más rápida ademas de la mejor posible ya que esta estará sujeta a posterior revisión y verificación por parte
      de quien corresponda.
      </p>
  </div>





<div id="id01" class="w3-modal animated fadeInUp">
  <div class="w3-modal-content w3-card-4">
    <article class="w3-container w3-indigo">
      <span onclick="document.getElementById('id01').style.display='none'" class="w3-closebtn">&times;</span>
      <h1 class='w3-center'><?php echo !empty($titulo)? $titulo : "Mensaje"; ?></h1>
    </article>
    <div class="w3-container">
      <p class='w3-center w3-xlarge'><?php echo !empty($mensaje)? $mensaje : ""; ?></p>
    </div>
    <article class="w3-container w3-indigo">
      <p class='w3-center'>
         Lagobo Distribuciones S.A&#169;<br/>
         Plataforma de Mesa de ayuda
      </p>
    </article>
  </div>
</div>
<script type='text/javascript'>
   $(document).ready(
      function(){
         $('#id01').css("display", "block");
      }
   );
</script>

<?php $this->load->view('layouts/footer'); ?>
