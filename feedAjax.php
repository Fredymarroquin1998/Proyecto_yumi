<?php 
require("conexion.php");
session_start();
$id_usuario = $_SESSION['id_usuario'];
$tipo=$_POST['tipo'];
$b=$_POST['b'];
$valor = 0;
      	if($b == 1){
      	$query="INSERT INTO preferencias (id_receta, id_usuario) values($tipo,'$id_usuario') ";
      	$query=mysqli_query($mysqli,$query)or die(mysqli_error());
	    }else{
	    	$query="DELETE FROM preferencias WHERE id_receta= $tipo and id_usuario = '$id_usuario' ";
	    	$query=mysqli_query($mysqli,$query)or die(mysqli_error());
	    }
      
      
      
?>