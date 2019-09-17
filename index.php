<?php
    if(isset($_SESSION['id_usuario'])){
        header("Location: inicio.php");
    }
    if (isset($_POST['submit']) && !empty($_POST['submit'])) {
        if (isset($_POST['usuario']) && !empty($_POST['usuario']) && isset($_POST['contrasena']) && !empty($_POST['contrasena'])) {
            $usuario=$_POST['usuario'];
            $contrasena= $_POST['contrasena'];
            
            require("conexion.php");

            $query=mysqli_query($mysqli,"SELECT * FROM usuarios WHERE id_usuario='$usuario'");
            if (mysqli_num_rows($query)>0) {
                while ($row=mysqli_fetch_assoc($query)) {
                    if ($contrasena==$row['contrasena'] && $usuario==$row['id_usuario']) {
                        session_start();
                        $_SESSION['id_usuario']=$row['id_usuario'];
                        header("Location:inicio.php");
                    }else{
                        echo '<script language="javascript">alert("CONTRASEÑA INCORRECTA");</script>';
                    }
                } 
            }
            else {
                echo '<script language="javascript">alert("USUARIO NO EXISTE, POR FAVOR REGISTRESE");</script>';
            }
        }else{
            echo '<script language="javascript">alert("Por favor completar los campos");</script>';
            echo '<script language="javascript">location.href="index.php"</script>';
        }
    }  
?>

<!DOCTYPE html>
<html>
    <link rel="stylesheet" href="css/index.css"/>
    <link rel="shortcut icon" href="css/imagenes/yumi_icono.ico" />
	<head>
	   <title>Yumi</title>
	</head>
	<body>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>">
            <div class="login">
                <div class="banner"></div>
                <div class="form">
                    <div class="wrapper">
                        <div class="row">
                            <div class="label">Usuario</div>
                            <input type="text" name="usuario" class="confondo" value="" required>
                        </div>
                        <div class="row">
                            <div class="label">Contraseña</div>
                            <input type="password" name="contrasena" class="confondo" value="" required>
                        </div>
                        <div class="row">
                            <a href="inicio.php"><button type="submit" name="submit" value="Registrarse">iniciar sesion</button></a>
                        </div>  
                    </div>
                    <div class="signup">
                        No tienes cuenta? <a href="registro.php">Unete</a>
                    </div>    
                </div>
            </div>
        </form>
	</body>
</html>
