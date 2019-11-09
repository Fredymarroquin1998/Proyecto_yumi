<?php
    require("conexion.php");
    if (isset($_POST['submit']) && !empty($_POST['submit'])) {
        if (isset($_POST['usuario']) && !empty($_POST['usuario']) && isset($_POST['nombre']) && !empty($_POST['nombre']) && isset($_POST['apellido']) && !empty($_POST['apellido']) && isset($_POST['correo']) && !empty($_POST['correo']) && isset($_POST['contrasena']) && !empty($_POST['contrasena']) && isset($_POST['contrasena2']) && !empty($_POST['contrasena2'])) {
            $usuario=$_POST['usuario'];
            $nombre=$_POST['nombre'];
            $apellido= $_POST['apellido'];
            $correo=$_POST['correo'];
            $contrasena=$_POST['contrasena'];
            $contrasena2=$_POST['contrasena2'];
            $img = "css/imagenes/perfil.jpg";
            $dat = base64_encode(file_get_contents($img));
            $src = 'data:'.mime_content_type($img).';base64,'.$dat;
            $perfil=addslashes(file_get_contents($src));
            $img0 = "css/imagenes/portada.png";
            $dat0 = base64_encode(file_get_contents($img0));
            $src0 = 'data:'.mime_content_type($img0).';base64,'.$dat0;
            $portada=addslashes(file_get_contents($src0));


            if ($contrasena!=$contrasena2) {
                echo '<script language="javascript">alert("Contraseñas con coinciden o no cumplen el formato");</script>';
                echo '<script language="javascript">location.href="registro.php"</script>';
            } else {
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
                        $query=mysqli_query($mysqli,"INSERT INTO usuarios (id_usuario,correo,nombre_usuario,apellido_usuario,contrasena,foto_perfil,foto_portada) VALUES('$usuario','$correo','$nombre','$apellido','$contrasena','$perfil','$portada')") or die(mysqli_error());
                        $row=@mysqli_fetch_array($query);
                        session_start();
                        $_SESSION['id_usuario']=$usuario;
                        $_SESSION['correo']=$correo;
                        
                        
                        echo '<script language="javascript">alert("Usuario registrado con éxito");</script>';
                        
                        echo '<script language="javascript">location.href="feed.php"</script>';      
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
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
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
                        <div class="label">Nombre</div>
                        <input type="text" name="nombre" class="confondo" value="" style="text-transform: capitalize;" maxlength="20" required >
                    </div>
                    <div class="row">
                        <div class="label">Apellido</div>
                        <input type="text" name="apellido" class="confondo" value="" style="text-transform: capitalize;" maxlength="20" required >
                    </div>
                    <div class="row">
                        <div class="label">Usuario</div>
                        <div class="verificar_u">
                            <input type="text" name="usuario" class="confondo" value="" maxlength="15" id="usuario" onkeyup="comprueba_usuario();" required>
                            <div id="result_usuario"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="label">Correo electronico</div>
                        <div class="verificar_c">
                            <input type="text" name="correo" class="confondo" value="" pattern="^[a-zA-Z0-9]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$" maxlength="50" id="correo" onkeyup="comprueba_email();" required >
                            <div id="result"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="label">Contraseña</div>
                        <input type="password" name="contrasena" class="confondo" value="" maxlength="25" required >
                    </div>
                    <div class="row">
                        <div class="label">Confirma tu contraseña</div>
                        <input type="password" name="contrasena2" class="confondo" value="" maxlength="25" required >
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

<script type="text/javascript">
    function comprueba_email(){
        var correo = document.getElementById("correo").value;
        $.ajax({
            type : 'POST',
            url : 'verificar_correo.php',
            data : "correo="+correo,
            success: function(r){
                $('#result').html(r); 
            }
        });
    }
</script>

<script type="text/javascript">
    function comprueba_usuario(){
        var usuario = document.getElementById("usuario").value;
        $.ajax({
            type : 'POST',
            url : 'verificar_usuario.php',
            data : "usuario="+usuario,
            success: function(r){
                $('#result_usuario').html(r); 
            }
        });
    }
</script>
