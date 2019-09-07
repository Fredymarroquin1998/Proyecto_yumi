<?php
   if (isset($_POST['submit']) && !empty($_POST['submit'])) {
        if (isset($_POST['usuario']) && !empty($_POST['usuario']) && isset($_POST['nombre']) && !empty($_POST['nombre']) && isset($_POST['apellido']) && !empty($_POST['apellido']) && isset($_POST['correo']) && !empty($_POST['correo']) && isset($_POST['contrasena']) && !empty($_POST['contrasena']) && isset($_POST['contrasena2']) && !empty($_POST['contrasena2'])) {
            
            $usuario=$_POST['usuario'];
            $nombre=$_POST['nombre'];
            $apellido= $_POST['apellido'];
            $correo=$_POST['correo'];
            $contrasena=$_POST['contrasena'];
            $contrasena2=$_POST['contrasena2'];

            if ($contrasena!=$contrasena2) {
                echo '<script language="javascript">alert("Contraseñas con coinciden o no cumplen el formato");</script>';
                echo '<script language="javascript">location.href="registro.php"</script>';
            } else {
                session_start();

                require("conexion.php");
                
                $checkuser=mysqli_query($mysqli,"SELECT * FROM usuarios WHERE id_usuario='$usuario");
                $checkemail=mysqli_query($mysqli,"SELECT * FROM usuarios WHERE correo='$correo'");
                if (@mysqli_num_rows($checkuser)>0) {
                    echo '<script language="javascript">alert("Atencion, ya existe este usuario, verifique sus datos");</script>';
                    echo '<script language="javascript">location.href="registro.php"</script>';
                }else{
                    if(@mysqli_num_rows($checkemail)>0){
                        echo '<script language="javascript">alert("Atencion, ya existe el mail designado para un usuario, verifique sus datos");</script>';
                        echo '<script language="javascript">location.href="registro.php"</script>';
                    }else{
                        mysqli_query($mysqli,"INSERT INTO usuarios (id_usuario,correo,nombre_usuario,apellido_usuario,contrasena) VALUES('$usuario','$correo','$nombre','$apellido','$contrasena')");
                        $_SESSION['id_usuario']=$usuario;
                        header("Location:feed.php");
                        echo ' <script language="javascript">alert("Usuario registrado con éxito");</script> ';
                        exit;       
                    }
                }
            }
        } else {
            echo '<script language="javascript">alert("Por favor completar los campos");</script>';
            echo '<script language="javascript">location.href="registro.php"</script>';
        }
    } 
?>

<!DOCTYPE html>
<html>
    <link rel="stylesheet" href="css/registro.css"/>
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
                        <div class="label">Nombre</div>
                        <input type="text" name="nombre" class="confondo" value="" required >
                    </div>
                    <div class="row">
                        <div class="label">Apellido</div>
                        <input type="text" name="apellido" class="confondo" value="" required >
                    </div>
                    <div class="row">
                        <div class="label">Correo electronico</div>
                        <input type="text" name="correo" class="confondo" value="" required >
                    </div>
                    <div class="row">
                        <div class="label">Contraseña</div>
                        <input type="password" name="contrasena" class="confondo" value="" required >
                    </div>
                    <div class="row">
                        <div class="label">Confirma tu contraseña</div>
                        <input type="password" name="contrasena2" class="confondo" value="" required >
                    </div>
                    <div class="row">
                       <button type="submit" name="submit" value="Registrarse" onclick="Limpiar();">Siguiente</button>
                    </div>
                    <div class="signup">
                        <a href="index.php">Regresar</a>
                    </div>   
                </div>  
            </div>
        </div>
        </form>
    </body>    
</html>

<script type="text/javascript">
    function Limpiar() {
        var n = document.getElementById("name");
        n.value="";
    }
</script>
