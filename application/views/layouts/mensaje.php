<?php
$tiempo= !empty($tiempo)? $tiempo : 5 ;
$this->load->view('layouts/header',["head_files"=>[
                                                   '<meta http-equiv="Refresh" content="' . $tiempo. ';url='.$url.'" />'
                                                   ]]) ?>


<div id="id01" class="w3-modal">
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

