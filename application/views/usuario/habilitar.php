<?php
$this->load->view("layouts/header");
echo '<div style="width: 80%; margin: auto">';
print($respuesta);
echo "</div>";
$this->load->view("layouts/footer");
 ?>
<script>
function habilitar(elemento){
  var correo=$(elemento.childNodes[2]).html();
  var rol=$(elemento.childNodes[3]).html();
  if(confirm("¿Desea habilitar este usuario?")){
    var ajax=new XMLHttpRequest();
    ajax.onreadystatechange=function(){
      if(ajax.readyState==4 && ajax.status==200){
          alert("Usuario habilitado.");
          location.reload();
      }
    };
    ajax.open("POST", window.location.origin+"/index.php/usuario/habilitar", true);
    ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    ajax.send("correo="+correo+"&rol="+rol+"&accion=habilitar");
  }
}
</script>
