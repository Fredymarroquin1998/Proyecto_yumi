<?php
    session_start();
    if (@!$_SESSION['id_usuario']) {
        header("location:index.php");
    }
?>

<!DOCTYPE html>
<html>
    <link rel = "stylesheet" href="css/cuenta.css">
    <link rel="shortcut icon" href="css/imagenes/yumi_icono.ico">       
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
                    <li class="menu__group"><a href="inicio.php" class="menu__link"><img src="css/imagenes/home.png" width="40" height="40"><br>Inicio</a></li>
                    <li class="menu__group"><a href="cuenta.php" class="menu__link"><img src="css/imagenes/account.png" width="40" height="40"><br>Perfil</a></li>
                    <li class="menu__group"><a href="cerrar_sesion.php" class="menu__link"><img src="css/imagenes/logout.png" width="40" height="40"><br>Salir</a></li>
                </ul>
            </div>
        </div>
    </head>
    <body bgcolor="#B6F8F7">
        <div class="portada">
            <img src="css/imagenes/portada.png">
        </div>
        <div class="perfil">
            <img src="css/imagenes/perfil.jpg">
        </div>
        <div class="nombre">
            <input type="hidden" name="nombre"><font size="5"><b>Nombre Persona</b></font>
        </div>
        <div class="apellido">
            <input type="hidden" name="nombre"><font size="5"><b>Apellido Persona</b></font>
        </div>
        <div class="usuario">
            <input type="hidden" name="usuario"><font size="3"><b>@usuario</b></font>
        </div>
        <div class="cantidad_recetas">
            <input type="hidden" name="cant_recetas"><font size="5"><b>100<br>Recetas</b></font>
        </div>
        <div class="estrellas">
            <input type="hidden" name="estrellas"><font size="5"><b>1000<br>Estrellas</b></font>
        </div>
        <div class="descripcion">
            <input type="hidden" name="descripcion" maxlength="200"><font size="4"><b>DescripcionDescripcionDescripcionDescripcionDescripcionDescripcionDescripcionDescripcionDescripcionDescripcionDescripcionDescripcionDescripcionDescripcionDescripcionDescripcionDescripcionDescripcionmm</b></font>
        </div>
        <div class="opciones">
            <div class="publicado">
                <button type="button" onclick="misrecetas();">MIS RECETAS</button>
            </div>
            <div class="preferido">
                <button type="button" onclick="mispreferidas();">PREFERIDAS</button>
            </div>
            
        </div>
        <div class="editar">
            <a href="editar_perfil.php"><button type="button">Editar Perfil</button></a>
        </div>

        <div class="misrecetas">
            <center><div class="grid-container">
                <?php
                    require("conexion.php");

                    $usuario_actual=$_SESSION['id_usuario'];
                    $query="SELECT * FROM recetas WHERE id_usuario='$usuario_actual' ORDER BY id_receta ASC";
                    $resultado=mysqli_query($mysqli,$query);
                    while ($row=$resultado->fetch_assoc()) {
                        $name=$row['nombre_receta'];
                        $user=$row['id_usuario'];
                        $type=$row['tipo'];
                        $calor=$row['calorias'];
                        $cal=$row['calificacion'];
                ?>
                        <div class="grid-item">
                            <div class="receta_imagen"><img height="100%" width="100%" src="data:image/jpg;base64,<?php echo base64_encode($row['imagen']); ?>"></div>
                            <div class="receta_titulo"><?php echo $name; ?></div>
                            <div class="receta_usuario"><img height="20" width="20" src="css/imagenes/user"><?php echo $user ?></div>
                            <div class="receta_tipo"><?php echo $type ?></div>
                            <div class="receta_calorias"><?php echo $calor ?> calorias</div>
                            <div class="receta_calificacion">Calificacion: <?php echo $cal ?></div>
                        </div>
                <?php
                    }
                ?>
            </div></center>
        </div>
        <script type="text/javascript">
            var item = $(".grid-item");
            item.hover(function() {
            item.not($(this)).addClass('blur');
            // al perder el foco, retiro la clase a todos los 'item'
            }, function() {
            item.removeClass('blur');
            });
        </script>

    </body>
</html>
