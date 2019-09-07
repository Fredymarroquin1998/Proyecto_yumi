<?php
    session_start();
    if (@!$_SESSION['id_usuario']) {
        header("location:index.php");
    }
?>

<!DOCTYPE html>
<html>
    <link rel="stylesheet" href="css/editar_perfil.css"/>
    <link rel="shortcut icon" href="css/imagenes/yumi_icono.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Yumi</title>
    <head>
        <div class="barra" >
            <div class="logo"> 
                <a href="inicio.php"><img src="css/imagenes/inicio" height="80" width="250"></a>
            </div>
            <input class="buscar" type="search" style="width:37%; height: 30%" size=32 placeholder="Search...">
            <div class="textG">
                <a href="buscar.php"><input type=image src="css/imagenes/search.png" width="30" height="30" class="boton"></a>
            </div> 
            <div class="menuG">
                <ul class="menu__list">
                    <li class="menu__group"><a href="inicio.php" class="menu__link"><img src="css/imagenes/home.png" style="width:75%; height: 75%"><br>Inicio</a></li>
                    <li class="menu__group"><a href="cuenta.php" class="menu__link"><img src="css/imagenes/account.png" width="40" height="40"><br>Perfil</a></li>
                    <li class="menu__group"><a href="cerrar_sesion.php" class="menu__link"><img src="css/imagenes/logout.png" width="40" height="40"><br>Salir</a></li>
                </ul>
            </div>
        </div>
    </head>
    <body bgcolor="#B6F8F7">
        <form method="post" action="" >
            <div class="login">
                <div class="form">
                    <div class="arriba_izquierda">
                        <script class="jsbin" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
                        <div class="file-upload">
                            <div class="image-upload-wrap">
                                <input class="file-upload-input" type='file' onchange="readURL(this);" accept="image/*" />
                                <div class="drag-text">
                                    <h3>Presione para cambiar imagen de perfil</h3>
                                </div>
                            </div>
                            <div class="file-upload-content">
                                <img class="file-upload-image" src="#" alt="your image" />
                                <div class="image-title-wrap">
                                    <button type="button" onclick="removeUpload()" class="remove-image">Eliminar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="arriba_derecha">
                        <script class="jsbin" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
                        <div class="file-upload">
                            <div class="image-upload-wrap">
                                <input class="file-upload-input" type='file' onchange="readURL(this);" accept="image/*" />
                                <div class="drag-text">
                                    <h3>Presione para cambiar imagen de portada</h3>
                                </div>
                            </div>
                            <div class="file-upload-content">
                                <img class="file-upload-image" src="#" alt="your image" />
                                <div class="image-title-wrap">
                                    <button type="button" onclick="removeUpload()" class="remove-image">Eliminar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="abajo_izquierda">
                        <div class="row">
                            <div class="label">Nombre</div>
                            <input type="text" name="nombre" class="confondo" required>
                        </div>
                        <div class="row">
                            <div class="label">Apellido</div>
                            <input type="text" name="apellido" class="confondo" required>
                        </div>
                        <div class="row">
                            <div class="label">Usuario</div>
                            <input type="text" name="usuario" class="confondo" required>
                        </div>
                    </div>
                    <div class="abajo_derecha">
                        <div class="row">
                            <div class="label">Correo Electronico</div>
                            <input type="text" name="correo" class="confondo" required>
                        </div>
                        <div class="row">
                            <div class="label">Contraseña</div>
                            <input type="text" name="contrasena" class="confondo" required>
                        </div>
                        <div class="row">
                            <br><a href="cuenta.php"><button type="submit" name="submit">Guardar</button></a>
                        </div> 
                    </div>
                </div>
            </div>
        </form>
    </body>
</html>
