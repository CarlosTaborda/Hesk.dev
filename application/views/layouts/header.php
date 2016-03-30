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

    <style>
      body > nav{
         display: flex;
         flex-wrap: wrap;
         justify-content: center;
         margin-bottom: 2em;
      }

      body > nav a{
         display: block;
         text-decoration: none !important;
         margin: 4px;
         border: 0.5px solid ;
         min-width: 8.5em;
         text-align: center;
         color: white;
         background-color: #2196F3;
      }
    </style>

    <body>
       <h1 class='w3-center w3-blue ' style='margin: 0px;'>Mesa de ayuda</h1>
      <div class='w3-center'>
         <img src="<?php echo base_url('assets/img/logo_lagobo.png') ?>" />
      </div>

      <nav>
         <a href='<?php echo site_url("sucursal"); ?>'>Sucursal</a>
         <a href='<?php echo site_url("ticket/crearTicket"); ?>'>Crear Ticket</a>
         <a href='<?php echo site_url("ticket/consultar"); ?>'>Consultar Ticket</a>
         <a href='<?php echo site_url("usuario/index"); ?>'>Ingresar</a>
      </nav>

