<!DOCTYPE HTML>
<html lang="es">
  <head>
      <meta charset="utf-8"/>
      <link rel="stylesheet" href="<?php echo base_url("assets/css/w3.css"); ?>">
  </head>

  <body style="min-height: 100vh;">
      <div style="width: 80%; margin: 11% 10%;" class="w3-border w3-padding">
        <h1 class="w3-indigo w3-center">Plataforma de Mesa de Ayuda</h1>
        <article class="w3-center"><img src="<?php echo base_url("assets/img/email-icon.png"); ?>" /></article>
        <p class="w3-text-dark-grey w3-justify">
          Hola, se ha generado un nuevo ticket en la plataforma de Mesa de Ayuda pronto estaremos revisando tu caso,
          el código para hacer seguimiento a tu requerimiento, problema o solicitud es: <b class="w3-large w3-border-blue w3-border w3-text-blue"><?php echo $id_ticket; ?></b>.
          <br/><br/>
          Puedes consultar el estado de tu ticket <a href="<?php echo site_url("ticket/consultar"); ?>" class="w3-text-cyan">AQUÍ</a>
        </p>
        <?php $this->load->view("layouts/footer"); ?>
      </div>
  </body>
</html>
