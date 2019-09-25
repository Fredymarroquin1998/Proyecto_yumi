<?php
	require("conexion.php");
	if (isset($_POST)) {
	    $usuario = $_POST['usuario'];
	    $result = $mysqli->query("SELECT * FROM usuarios WHERE id_usuario='$usuario'");
	    if ($result->num_rows > 0) {
	    	echo '<link rel="stylesheet" href="css/incorrecto_u.css">';
	    } else {
	        echo '<link rel="stylesheet" href="css/correcto_u.css">';
	    }
	}
?>