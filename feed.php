<?php
  session_start();
  if (@!$_SESSION['id_usuario'] || @!$_SESSION['correo']) {
    header("location:index.php");
  }
?>

<!DOCTYPE html>
<html>
    <link rel="stylesheet" href="css/feed.css"/>
    <link rel="shortcut icon" href="css/imagenes/yumi_icono.ico" />
	<head>
	   <title>Yumi</title>
	</head>
	<body bgcolor="#B6F8F7">
    <div class="recuadro">
      <h1><center><label class="rotulo">DE QUE TIENES ANTOJO?</label></center></h1>
      <label class="checkeable">
        <input type="checkbox" name="pasta"/>
        <img src="css/imagenes/pasta.jpg"/>
      </label>
      <label class="checkeable">
        <input type="checkbox" name="pastel"/>
        <img src="css/imagenes/postre.jpg"/>
      </label>
      <label class="checkeable">
        <input type="checkbox" name="ensalada"/>
        <img src="css/imagenes/ensalada.jpg"/>
      </label>
      <label class="checkeable">
        <input type="checkbox" name="comidafrita"/>
        <img src="css/imagenes/comidaFrita.jpg"/>
      </label>
      <label class="checkeable">
        <input type="checkbox" name="sopa"/>
        <img src="css/imagenes/sopa.jpg"/>
      </label>
      <label class="checkeable">
        <input type="checkbox" name="saludable"/>
        <img src="css/imagenes/fit.jpg"/>
      </label>
      <label class="checkeable">
        <input type="checkbox" name="carne"/>
        <img src="css/imagenes/carne.jpg"/>
      </label>
      <label class="checkeable">  
        <input type="checkbox" name="sandwich"/>
        <img src="css/imagenes/sandwich.jpg"/>
      </label>
      <label class="checkeable">  
        <input type="checkbox" name="bebida"/>
        <img src="css/imagenes/bebida.jpg"/>
      </label>
      <label class="checkeable">  
        <input type="checkbox" name="salsa"/>
        <img src="css/imagenes/salsa.jpg"/>
      </label>
      <label class="checkeable">  
        <input type="checkbox" name="crema"/>
        <img src="css/imagenes/crema.jpg"/>
      </label>
      <label class="checkeable">  
        <input type="checkbox" name="helado"/>
        <img src="css/imagenes/helado.jpg"/>
      </label>
    </div>
    <center><a href="cuenta.php"><button>finalizar</button></a></center>
	</body>
</html>