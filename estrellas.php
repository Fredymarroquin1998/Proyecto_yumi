<?php 
require("conexion.php");
$prodId=$_POST['prodId'];
$valor=$_POST['val'];
$perid=$_POST['perid'];

$sql = "SELECT * FROM likes where id_usuario = '$perid' and id_receta = $prodId ";
  $check=mysqli_query($mysqli,$sql) or die(mysqli_error());
  $check=mysqli_num_rows($check);
  $resultado=mysqli_query($mysqli,$sql);
  $row=mysqli_fetch_assoc($resultado);
if($valor == 1){
  $cal = 1;
}else if($valor == 2){
  $cal = 2;
}else if($valor == 3){
  $cal = 3;
}else if($valor == 4){
  $cal = 4;
}else{
  $cal = 5;
}

if($check>0){
    $sql = "UPDATE likes SET calificacion = $cal WHERE id_usuario = '$perid' and id_receta = $prodId ";
    $check=mysqli_query($mysqli,$sql) or die(mysqli_error());
  }else{
    $sql = "INSERT into likes (calificacion, id_receta, id_usuario)values ($cal, $prodId, '$perid')";
    mysqli_query($mysqli,$sql) or die(mysqli_error());
    $valor = $valor - $row['calificacion'];
    $sql = "UPDATE recetas SET persona = (persona + 1) WHERE id_receta = $prodId ";
    $check=mysqli_query($mysqli,$sql) or die(mysqli_error());
  }
$valor = $valor - $row['calificacion'];
$sql = "UPDATE recetas SET calificacion = (calificacion + $valor ) WHERE id_receta = $prodId ";
$check=mysqli_query($mysqli,$sql) or die(mysqli_error());
?>