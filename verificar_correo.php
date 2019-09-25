<?php
	require("conexion.php");
	if (isset($_POST)) {
	    $correo = $_POST['correo'];
	    $result = $mysqli->query("SELECT * FROM usuarios WHERE correo='$correo'");
	    if ($result->num_rows > 0) {
	    	echo '<link rel="stylesheet" href="css/incorrecto_c.css">';
	    } else {
	        echo '<link rel="stylesheet" href="css/correcto_c.css">';
	    }
	}
?>
