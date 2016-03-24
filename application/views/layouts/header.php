<!DOCTYPE HTML>
<HTML lang="es">
    <head>
        <?php
            if(!empty($head_files)){
                foreach($head_files as $file){
                    print($file . "\n");
                }
            }
        ?>
        <link rel='stylesheet' href='<?php echo base_url("assets/css/w3.css"); ?>' />
        <script type='text/javascript' src='<?php echo base_url("assets/js/jquery.js"); ?>'></script>
    </head>

    <body>
       <h1 class='w3-center w3-blue ' style='margin: 0px;'>Mesa de ayuda</h1>
      <div class='w3-center'>
         <img src="<?php echo base_url('assets/img/logo_lagobo.png') ?>" />
      </div>

      <nav>
         <a href='<?php echo site_url("sucursal"); ?>'>sucursal</a>
         <a href='<?php echo site_url("ticket/crearTicket"); ?>'>Crear ticket</a>
      </nav>

