<?php
    require("conexion.php");

    if (isset($_FILES['img'])) {
        $nombre=$_FILES['img']['name'];
        $imagen=addslashes(file_get_contents($_FILES['img']['tmp_name']));
        $sql="INSERT INTO imagenes VALUES('$nombre','$imagen')";
        $res=mysqli_query($mysqli,$sql);    

        if (@$res) {
            echo '<script type="text/javascript">alert("Agregado!");</script>';
            echo '<script language="javascript">location.href="imagen.php"</script>';
        }else{
            die("Error".mysqli_error($mysqli));
        }
    }  
?>
<!DOCTYPE html>
<html>
<head>
	<title>Insertar imagen</title>
</head>
<body>
	<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post" enctype="multipart/form-data">
		<input type="file" name="img"><input type="submit" name="enviar">
	</form>
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Imagenes</th>
            </tr>
        </thead>
        <tbody>
            <?php
                require("conexion.php");

                $query="SELECT * FROM imagenes ";
                $resultado=mysqli_query($mysqli,$query);
                while ($row=$resultado->fetch_assoc()) {
            ?>
                <tr>
                    <td><?php echo $row['nombre']; ?></td>
                    <td><img height="100" width="100" src="data:image/jpg;base64,<?php echo base64_encode($row['imagen']); ?>"></td>
                </tr>
            <?php
                }
            ?>
        </tbody>
    </table>
</body>
</html>
