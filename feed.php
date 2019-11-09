<?php
  session_start();
  if (@!$_SESSION['id_usuario'] || @!$_SESSION['correo']) {
        header("location:index.php");
    }
?>

<!DOCTYPE html>
<html>
    <script class="jsbin" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <link rel="stylesheet" href="css/feed.css"/>
    <link rel="shortcut icon" href="css/imagenes/yumi_icono.ico" />
  <head>
     <title>Yumi</title>
  </head>
  <body bgcolor="#B6F8F7">
    <div class="recuadro">
      <h1><center><label class="rotulo">DE QUE TIENES ANTOJO?</label></center></h1>
      <label class="checkeable">
        <input type="checkbox" name="pasta" id ="pasta" value="pasta" onclick="validar('pasta');" />
        <img src="css/imagenes/pasta.jpg"/>
      </label>
      <label class="checkeable">
        <input type="checkbox" name="pastel" id ="pastel" value="pastel" onclick="validar('pastel');"/>
        <img src="css/imagenes/postre.jpg"/>
      </label>
      <label class="checkeable">
        <input type="checkbox" name="ensalada" id="ensalada" value="ensalada" onclick="validar('ensalada');" />
        <img src="css/imagenes/ensalada.jpg"/>
      </label>
      <label class="checkeable">
        <input type="checkbox" name="comidafrita" id="comidafrita" value="comidafrita" onclick="validar('comidafrita');"/>
        <img src="css/imagenes/comidaFrita.jpg"/>
      </label>
      <label class="checkeable">
        <input type="checkbox" name="sopa" id="sopa" value="sopa" onclick="validar('sopa');"/>
        <img src="css/imagenes/sopa.jpg"/>
      </label>
      <label class="checkeable">
        <input type="checkbox" name="saludable" id="saludable" value="saludable" onclick="validar('saludable');"/>
        <img src="css/imagenes/fit.jpg"/>
      </label>
      <label class="checkeable">
        <input type="checkbox" name="carne" id="carne" value="carne" onclick="validar('carne');"/>
        <img src="css/imagenes/carne.jpg"/>
      </label>
      <label class="checkeable">  
        <input type="checkbox" name="sandwich" id="sandwich" value="sandwich" onclick="validar('sandwich');"/>
        <img src="css/imagenes/sandwich.jpg"/>
      </label>
      <label class="checkeable">  
        <input type="checkbox" name="bebida" id="bebida" value="bebida" onclick="validar('bebida');"/>
        <img src="css/imagenes/bebida.jpg"/>
      </label>
      <label class="checkeable">  
        <input type="checkbox" name="salsa" id="salsa" value="salsa" onclick="validar('salsa');"/>
        <img src="css/imagenes/salsa.jpg"/>
      </label>
      <label class="checkeable">  
        <input type="checkbox" name="crema" id="crema" value="crema" onclick="validar('crema');"/>
        <img src="css/imagenes/crema.jpg"/>
      </label>
      <label class="checkeable">  
        <input type="checkbox" name="helado" id="helado" value="helado" onclick="validar('helado');"/>
        <img src="css/imagenes/helado.jpg"/>
      </label>
    </div>
    <div id ="select2lista" name="select2lista"> </div>
    <center><button onclick="ver();">finalizar</button></center>
  </body>
</html>
<script type="text/javascript">
 var frutas = [];

    function ver(){
      if(frutas.length > 0){
        location.href ="cuenta.php";
      }
      
    }
    function validar(a){
      var pasta = document.getElementById('pasta').checked;
      var pastel = document.getElementById('pastel').checked;
      var ensalada = document.getElementById('ensalada').checked;
      var comidafrita = document.getElementById('comidafrita').checked;
      var sopa = document.getElementById('sopa').checked;
      var saludable = document.getElementById('saludable').checked;
      var carne = document.getElementById('carne').checked;
      var sandwich = document.getElementById('sandwich').checked;
      var bebida = document.getElementById('bebida').checked;
      var salsa = document.getElementById('salsa').checked;
      var crema = document.getElementById('crema').checked;
      var helado = document.getElementById('helado').checked;
      var b = 0;
      var tipo = 0;
      
      if(a == "pasta"){
        tipo=7;
        if(pasta){
          b = 1;
        }else{
          b = 0;
        }
      }else if(a == "pastel"){
        tipo=8;
        if(pastel){
          b = 1;
        }else{
          b = 0;
        }
      }else if(a == "ensalada"){
        tipo=9;
        if(ensalada){
         b = 1;
        }else{
          b = 0;
        }
      }else if(a == "comidafrita"){
        tipo=10;
        if(comidafrita){
           b = 1;
        }else{
          b = 0;
        }
      }else if(a == "sopa"){
        tipo=11;
        if(sopa){
          b = 1;
        }else{
          b=0;
        }
      }else if(a == "saludable"){
        tipo=4;
        if(saludable){
          b = 1;
        }else{
          b = 0;
        }
      }else if(a == "carne"){
        tipo=6;
        if(carne){
          b = 1;
        }else{
          b = 0;
        }
      }else if(a == "sandwich"){
        tipo=4;
        if(sandwich){
          b = 1;
        }else{
          b = 0;
        }
      }else if(a == "bebida"){
        tipo = 4;
        if(bebida){
          b = 1;
        }else{
          b = 0;
        }
      }else if(a == "salsa"){
        tipo = 4;
        if(salsa){
          b = 1;
        }else{
          b = 0;
        }
      }else if(a == "crema"){
        tipo = 4;
        if(crema){
          b = 1;
        }else{
          b = 0;
        }
      }else if(a == "helado"){
        tipo = 4;
        if(helado){
          b = 1;
        }else{
          b = 0;
        }
      }else{
        tipo = 4;
        b = 3;
      }
      if(b == 1){
        frutas.push('1');
      }else{
        frutas.pop();
      }
      $.ajax({
            type:"POST",  
            url:"feedAjax.php",
            data: {tipo: tipo,b: b},
            success:function(r){
                $('#select2lista').html(r);
                }
            });


      }

</script>