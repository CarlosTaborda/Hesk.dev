
<div class="w3-center">
   <img src="<?php echo base_url('assets/img/search-icon.png') ?>"></img>
</div>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);


echo form_open("ticket/consultar", ["class"=>"w3-form w3-center"]);

echo form_label("Código de ticket:<br/>", "ticket-id_ticket", ["class"=>"w3-label"]);
echo form_input([
   "type"=>"number",
   "name"=>"id_ticket",
   "class"=>"w3-input w3-animate-input w3-content w3-border",
   "id"=>"ticket-id_ticket",
   "required"=>"true"
]);

echo form_submit("consulta", "consultar", "class='w3-btn w3-indigo w3-margin-8'");

echo form_close();

