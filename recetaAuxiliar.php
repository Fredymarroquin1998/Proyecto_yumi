<?php 
require("conexion.php");
$prodId=$_POST['prodId'];
$valor=$_POST['val'];
$perid=$_POST['perid'];
if($valor == 1){
  $sql = "SELECT * FROM preferencias where id_usuario = '$perid' and id_receta = $prodId ";
  $check=mysqli_query($mysqli,$sql) or die(mysqli_error());
  $check=mysqli_num_rows($check);
  if($check>0){
  }else{
    $sql = "INSERT into preferencias (id_receta, id_usuario)values ($prodId, '$perid')";
  mysqli_query($mysqli,$sql) or die(mysqli_error());
  }
  
}else{
  $sql = "DELETE FROM preferencias WHERE id_usuario = '$perid' and id_receta = $prodId";
  mysqli_query($mysqli,$sql) or die(mysqli_error());
}

?>
