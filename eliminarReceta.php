<?php 
require("conexion.php");
$prodId=$_POST['prodId'];
session_start();
if (@!$_SESSION['id_usuario'] || @!$_SESSION['correo']) {
        header("location:index.php");
    }
$sql = "DELETE FROM preferencias WHERE id_receta = $prodId";
mysqli_query($mysqli,$sql) or die(mysqli_error());
$sql = "DELETE FROM recetas WHERE id_receta = $prodId";
mysqli_query($mysqli,$sql) or die(mysqli_error());

?>
