<?php
    session_start();
    if (@!$_SESSION['id_usuario'] || @!$_SESSION['correo']) {
        header("location:index.php");
    }

    if (isset($_POST['submit'])) {
        $id_usuario=$_SESSION['id_usuario'];
        $correo_sesion=$_SESSION['correo'];
        $nombre=$_POST['nombre'];
        $apellido=$_POST['apellido'];
        $usuario=$_POST['usuario'];
        $correo=$_POST['correo'];
        $contrasena=$_POST['contrasena'];
        $descripcion=$_POST['descripcion'];
        
        require("conexion.php");

        $checkuser=mysqli_query($mysqli,"SELECT COUNT(*) FROM usuarios WHERE id_usuario='$usuario'");
        $checkemail=mysqli_query($mysqli,"SELECT COUNT(*) FROM usuarios WHERE correo='$correo'");
   
        if ($id_usuario!=$usuario) {
            $row=mysqli_fetch_array($checkuser);
            if ($row[0]>0) {
                echo '<script language="javascript">alert("Atencion, ya existe este usuario, verifique sus datos");</script>';
                echo '<script language="javascript">location.href="cuenta.php"</script>';
            }
        }
        if ($correo!=$correo_sesion) {
            if(mysqli_num_rows($checkemail)>0){
                echo '<script language="javascript">alert("Atencion, ya existe el mail designado para un usuario, verifique sus datos");</script>';
                echo '<script language="javascript">location.href="cuenta.php"</script>';
            }
        }
        
        if (!empty($_FILES['perfil']['name']) && empty($_FILES['portada']['name'])) {
            if($_FILES['perfil']['size'] > 16000000) {
                echo '<script type="text/javascript">alert("Archivos muy pesados, no fue posible actualizar perfil");</script>';
                echo '<script language="javascript">location.href="cuenta.php"</script>';
            } else {
                @$perfil=addslashes(file_get_contents($_FILES['perfil']['tmp_name']));
                
                $sql="UPDATE usuarios SET id_usuario='$usuario', correo='$correo', nombre_usuario='$nombre', apellido_usuario='$apellido', contrasena='$contrasena', descripcion='$descripcion', foto_perfil='$perfil' WHERE id_usuario='$id_usuario'";
                $resultado=mysqli_query($mysqli,$sql);
                if (@$resultado) {
                    if ($id_usuario!=$usuario) {
                        $sql1="UPDATE recetas SET id_usuario='$usuario' WHERE id_usuario='$id_usuario'";
                        mysqli_query($mysqli,$sql1);
                        $sql1="UPDATE preferencias SET id_usuario='$usuario' WHERE id_usuario='$id_usuario'";
                        mysqli_query($mysqli,$sql1);
                        session_write_close();
                        session_id($usuario);
                        session_start();
                    }
                    echo '<script type="text/javascript">alert("Informacion actualizada!");</script>';
                    echo '<script language="javascript">location.href="cuenta.php"</script>';
                } else {
                    die("Error".mysqli_error($mysqli));
                }
            } 
        } else if (!empty($_FILES['portada']['name']) && empty($_FILES['perfil']['name'])) {
            if($_FILES['portada']['size'] > 16000000) {
                echo '<script type="text/javascript">alert("Archivos muy pesados, no fue posible actualizar perfil");</script>';
                echo '<script language="javascript">location.href="cuenta.php"</script>';
            } else {
                @$portada=addslashes(file_get_contents($_FILES['portada']['tmp_name']));

                $sql="UPDATE usuarios SET id_usuario='$usuario', correo='$correo', nombre_usuario='$nombre', apellido_usuario='$apellido', contrasena='$contrasena', descripcion='$descripcion', foto_portada='$portada' WHERE id_usuario='$id_usuario'";
                $resultado=mysqli_query($mysqli,$sql);
                if (@$resultado) {
                    if ($id_usuario!=$usuario) {
                        $sql1="UPDATE recetas SET id_usuario='$usuario' WHERE id_usuario='$id_usuario'";
                        mysqli_query($mysqli,$sql1);
                        $sql1="UPDATE preferencias SET id_usuario='$usuario' WHERE id_usuario='$id_usuario'";
                        mysqli_query($mysqli,$sql1);
                        session_write_close();
                        session_id($usuario);
                        session_start();
                    }
                    echo '<script type="text/javascript">alert("Informacion actualizada!");</script>';
                    echo '<script language="javascript">location.href="cuenta.php"</script>';
                } else {
                    die("Error".mysqli_error($mysqli));
                }
            } 
        } else if (!empty($_FILES['perfil']['name']) && !empty($_FILES['portada']['name'])) {
            if($_FILES['perfil']['size'] > 16000000 || $_FILES['portada']['size'] > 16000000) {
                echo '<script type="text/javascript">alert("Archivos muy pesados, no fue posible actualizar perfil");</script>';
                echo '<script language="javascript">location.href="cuenta.php"</script>';
            } else {
                @$perfil=addslashes(file_get_contents($_FILES['perfil']['tmp_name']));
                @$portada=addslashes(file_get_contents($_FILES['portada']['tmp_name']));

                $sql="UPDATE usuarios SET id_usuario='$usuario', correo='$correo', nombre_usuario='$nombre', apellido_usuario='$apellido', contrasena='$contrasena', descripcion='$descripcion', foto_perfil='$perfil', foto_portada='$portada' WHERE id_usuario='$id_usuario'";
                $resultado=mysqli_query($mysqli,$sql);
                if (@$resultado) {
                    if ($id_usuario!=$usuario) {
                        $sql1="UPDATE recetas SET id_usuario='$usuario' WHERE id_usuario='$id_usuario'";
                        mysqli_query($mysqli,$sql1);
                        $sql1="UPDATE preferencias SET id_usuario='$usuario' WHERE id_usuario='$id_usuario'";
                        mysqli_query($mysqli,$sql1);
                        session_write_close();
                        session_id($usuario);
                        session_start();
                    }
                    echo '<script type="text/javascript">alert("Informacion actualizada!");</script>';
                    echo '<script language="javascript">location.href="cuenta.php"</script>';
                } else {
                    die("Error".mysqli_error($mysqli));
                }
            } 
        } else if (empty($_FILES['perfil']['name']) && empty($_FILES['portada']['name'])) {
            $sql="UPDATE usuarios SET id_usuario='$usuario', correo='$correo', nombre_usuario='$nombre', apellido_usuario='$apellido', contrasena='$contrasena', descripcion='$descripcion' WHERE id_usuario='$id_usuario'";
            $resultado=mysqli_query($mysqli,$sql);
            if (@$resultado) {
                if ($id_usuario!=$usuario) {
                    $sql1="UPDATE recetas SET id_usuario='$usuario' WHERE id_usuario='$id_usuario'";
                    mysqli_query($mysqli,$sql1);
                    $sql1="UPDATE preferencias SET id_usuario='$usuario' WHERE id_usuario='$id_usuario'";
                    mysqli_query($mysqli,$sql1);
                    session_write_close();
                    session_id($usuario);
                    session_start();
                }
                echo '<script type="text/javascript">alert("Informacion actualizada!");</script>';
                echo '<script language="javascript">location.href="cuenta.php"</script>';
            } else {
                die("Error".mysqli_error($mysqli));
            }
        }
    }
?>

<!DOCTYPE html>
<html>
    <link rel="stylesheet" href="css/editar_perfil.css">
    <link rel="shortcut icon" href="css/imagenes/yumi_icono.ico">       
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Yumi</title>
    <head>
        <div class="barra" >
            <div class="logo"> 
                <a href="inicio.php"><img src="css/imagenes/inicio" width="85%"></a>
            </div>
            <form method="GET" action="buscar.php">
                <div class="buscar_tipo">
                    <select name="busqueda_tipo" id="busqueda_tipo" style="width:425px; height:24px; display: none;">
                        <option value="1">Bebida</option>
                        <option value="2">Ensalada</option>
                        <option value="3">Desayuno</option>
                        <option value="4">Sandwich</option>
                        <option value="5">Postre</option>
                        <option value="6">Sopa</option>
                        <option value="7">Crema</option>
                        <option value="8">Carne</option>
                        <option value="9">Pasta</option>
                        <option value="10">Salsa</option>
                        <option value="11">Bocadillo</option>
                        <option value="12">Platillo principal</option>
                        <option value="13">Acompañante</option>
                        <option value="14">Mariscos</option>
                    </select>                
                </div>
                <input class="buscar" type="search" name="busqueda" id="busqueda" style="width:31%; height: 30%;" size=32 placeholder="Search...">
                <select style="width:6%; height:30%;" name="opcion" id="opcion" onchange="tipos()">
                    <option value="nombre">Nombre</option>
                    <option value="tipo">Tipo</option>
                    <option value="calorias">Calorias</option>
                </select>
                <div class="textG">
                    <a href="buscar.php?opciones=opcion&buscar=busqueda|busqueda_tipo"><input type=image src="css/imagenes/search.png" width="30" height="30" class="boton"></a>
                </div> 
            </form>
            <div class="menuG">
                <ul class="menu__list">
                    <li class="menu__group"><a href="inicio.php" class="menu__link"><img src="css/imagenes/home.png" width="65%"><br>Inicio</a></li>
                    <li class="menu__group"><a href="cuenta.php" class="menu__link"><img src="css/imagenes/account.png" width="75%"></a><div class="nombre"><?php echo $_SESSION['id_usuario']?></div></li>
                    <li class="menu__group"><a href="cerrar_sesion.php" class="menu__link"><img src="css/imagenes/logout.png" width="72%"><br>Salir</a></li>
                </ul>
            </div>
        </div>
    </head>
    <body bgcolor="#B6F8F7">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" enctype="multipart/form-data">
            <?php 
                require('conexion.php');
                $usuario_actual=$_SESSION['id_usuario'];
                $resultado=mysqli_query($mysqli,"SELECT * FROM usuarios WHERE id_usuario='$usuario_actual'");
                $row=mysqli_fetch_array($resultado);
            ?>
            <div class="login">
                <div class="cancelar"><a href="cuenta.php"><img src="css/imagenes/cancel"></a></div>
                <div class="form">
                    <div class="arriba_izquierda">
                        <script class="jsbin" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
                        <div class="file-upload0">
                            <div class="image-upload-wrap0">
                                <?php
                                    echo "<img height='100%' width='100%' src='data:image/jpg;base64,";
                                    echo base64_encode($row['foto_perfil']); 
                                    echo "'>";
                                ?>
                                <div class="drag-text0">
                                <input class="file-upload-input0" type='file' name="perfil" onchange="readURL0(this);" accept="image/*"/>
                                    <h3>Presione para cambiar imagen de perfil</h3>
                                </div>
                            </div>
                            <div class="file-upload-content0">  
                                <img class="file-upload-image0" src="#" height="100" width="100" />
                                <div class="image-title-wrap0"> 
                                    <button type="button" onclick="removeUpload0()" class="remove-image0">Cambiar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="arriba_derecha">
                        <script class="jsbin" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
                        <div class="file-upload">
                            <div class="image-upload-wrap">
                                 <?php
                                    echo "<img height='100%' width='100%' src='data:image/jpg;base64,";
                                    echo base64_encode($row['foto_portada']); 
                                    echo "'>";
                                ?>                            
                                <div class="drag-text">
                                    <input class="file-upload-input" type='file' name="portada" onchange="readURL(this);" accept="image/*" />
                                    <h3>Presione para cambiar imagen de portada</h3>
                                </div>
                            </div>
                            <div class="file-upload-content">
                                <img class="file-upload-image" src="#" height="100" width="100"/>
                                <div class="image-title-wrap">
                                    <button type="button" onclick="removeUpload()" class="remove-image">Cambiar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="abajo_izquierda">
                        <div class="row">
                            <div class="label">Usuario</div>
                            <div class="verificar_u">
                                <input type="text" name="usuario" class="confondo" value="<?php echo $row[0] ?>" maxlength="20" id="usuario" onkeyup="comprueba_usuario();" required>
                                <div id="result_usuario"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="label0">Nombre</div>
                            <input type="text" name="nombre" class="confondo" value="<?php echo $row[2] ?>"  maxlength="50" required>
                        </div>
                        <div class="row">
                            <div class="label0">Apellido</div>
                            <input type="text" name="apellido" class="confondo" value="<?php echo $row[3] ?>"  maxlength="50" required>
                        </div>
                    </div>
                    <div class="abajo_derecha">
                        <div class="row">
                            <div class="label">Correo Electronico</div>
                            <div class="verificar_c">
                                <input type="text" name="correo" class="confondo" value="<?php echo $row[1] ?>" pattern="^[a-zA-Z0-9]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$" maxlength="50" id="correo" onkeyup="comprueba_email();" required >
                                <div id="result"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="label">Contraseña</div>
                            <input type="text" name="contrasena" class="confondo" value="<?php echo $row[4] ?>" maxlength="25" required>
                        </div>
                        <div class="row">
                            <div class="label">Descripcion</div>
                            <input type="text" name="descripcion" class="confondo" value="<?php echo $row[5] ?>" maxlength="200" required>
                        </div>
                    </div>
                    <div class="guardar">
                        <br><button type="submit" name="submit">Guardar</button>
                    </div> 
                </div>
            </div>
        </form>
        <script type="text/javascript">
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                      $('.image-upload-wrap').hide();
                      $('.file-upload-image').attr('src', e.target.result);
                      $('.file-upload-content').show();
                      $('.image-title').html(input.files[0].name);
                    };
                    reader.readAsDataURL(input.files[0]);
                } else {
                    removeUpload();
                }
            }

            function removeUpload() {
              $('.file-upload-input').replaceWith($('.file-upload-input').clone());
              $('.file-upload-content').hide();
              $('.image-upload-wrap').show();
            }

            $('.image-upload-wrap').bind('dragover', function () {
                $('.image-upload-wrap').addClass('image-dropping');
            });
            $('.image-upload-wrap').bind('dragleave', function () {
                $('.image-upload-wrap').removeClass('image-dropping');
            });
        </script>
         <script type="text/javascript">
            function readURL0(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                      $('.image-upload-wrap0').hide();
                      $('.file-upload-image0').attr('src', e.target.result);
                      $('.file-upload-content0').show();
                      $('.image-title0').html(input.files[0].name);
                    };
                    reader.readAsDataURL(input.files[0]);
                } else {
                    removeUpload0();
                }
            }

            function removeUpload0() {
              $('.file-upload-input0').replaceWith($('.file-upload-input0').clone());
              $('.file-upload-content0').hide();
              $('.image-upload-wrap0').show();
            }

            $('.image-upload-wrap0').bind('dragover0', function () {
                $('.image-upload-wrap0').addClass('image-dropping0');
            });
            $('.image-upload-wrap0').bind('dragleave0', function () {
                $('.image-upload-wrap0').removeClass('image-dropping0');
            });
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

    </body>
</html>
<script>
    function tipos(){
        var opcion=document.getElementById("opcion").value;
        if (opcion=="tipo") {
            document.getElementById('busqueda_tipo').style.display = 'block';
            document.getElementById('busqueda').style.display = 'none';
        } else {
            document.getElementById('busqueda_tipo').style.display = 'none';
            document.getElementById('busqueda').style.display = 'block';
        }
    }
</script>