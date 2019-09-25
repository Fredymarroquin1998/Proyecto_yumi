<?php
	session_start();
	if($_SESSION['id_usuario'] || $_SESSION['correo']){
		session_destroy();
		header("location:index.php");
	}else{
		header("location:index.php");
	}
?>