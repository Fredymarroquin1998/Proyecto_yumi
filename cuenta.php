<?php
    session_start();
    if (@!$_SESSION['id_usuario'] || @!$_SESSION['correo']) {
        header("location:index.php");
    }
?>

<!DOCTYPE html>
<html>
    <link rel = "stylesheet" href="css/cuenta.css">
    <link rel="shortcut icon" href="css/imagenes/yumi_icono.ico">       
    <title>Yumi</title>
    <head>
        <div class="barra" >
            <div class="logo"> 
                <a href="inicio.php"><img src="css/imagenes/inicio" height="80" width="250"></a>
            </div>
            <input class="buscar" type="search" style="width:31%; height: 30%" size=32 placeholder="Search...">
            <select style="width:6%; height:30%"><option value="nombre">Nombre</option><option value="tipo">Tipo</option><option value="calorias">Calorias</option></select>
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
        <?php
            require("conexion.php");

            $usuario_actual=$_SESSION['id_usuario'];
            $query0="SELECT * FROM usuarios WHERE id_usuario='$usuario_actual'";
            $resultado0=mysqli_query($mysqli,$query0);
            while ($row0=$resultado0->fetch_assoc()) {
                    echo "<div class='portada'><img height='100%' width='100%' src='data:image/jpg;base64,";
                    echo base64_encode($row0['foto_portada']); 
                    echo "'></div>";
                    echo "<div class='perfil'><img height='100%' width='100%' src='data:image/jpg;base64,";
                    echo base64_encode($row0['foto_perfil']); 
                    echo "'></div>";
                $name=$row0['nombre_usuario'];
                $surname=$row0['apellido_usuario'];
                $description=$row0['descripcion'];
            }
            $query1="SELECT COUNT(*) FROM recetas WHERE id_usuario='$usuario_actual'";
            $resultado1=mysqli_query($mysqli,$query1);
            $row1=mysqli_fetch_array($resultado1);
            $cantidad=$row1[0];
        ?>
        <div class="nombre">
            <input type="hidden" name="nombre"><font size="5"><b><?php echo $name; ?></b></font>
        </div>
        <div class="apellido">
            <input type="hidden" name="nombre"><font size="5"><b><?php echo $surname; ?></b></font>
        </div>
        <div class="usuario">
            <input type="hidden" name="usuario"><font size="3"><b><?php echo $usuario_actual; ?></b></font>
        </div>
        <div class="cantidad_recetas">
            <input type="hidden" name="cant_recetas"><font size="5"><b><?php echo $cantidad; ?><br>Recetas</b></font>
        </div>
        <div class="estrellas">
            <input type="hidden" name="estrellas"><font size="5"><b>1000<br>Estrellas</b></font>
        </div>
        <div class="descripcion">
            <input type="hidden" name="descripcion" maxlength="200"><font size="4"><?php echo $description; ?></font>
        </div>
        <div class="opciones">
            <div class="publicado">
                <button type="button" id="misrecetas" onclick="misrecetas();">MIS RECETAS</button>
                <center><div class="grid-container" id="publicado">
                    <?php
                        $query="SELECT * FROM recetas WHERE id_usuario='$usuario_actual' ORDER BY id_receta DESC";
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
            <div class="preferido">
                <button type="button" id="mispreferidas" onclick="mispreferidas();">PREFERIDAS</button>
                <center><div class="grid-container1" id="preferido" style="display: none;">
                    <?php
                        $query0="SELECT * FROM preferencias WHERE id_usuario='$usuario_actual' ORDER BY id_receta ASC";
                        $resultado0=mysqli_query($mysqli,$query0);
                        while ($row0=$resultado0->fetch_assoc()) {
                            $id_receta0=$row0['id_receta'];
                            $query1="SELECT * FROM recetas WHERE id_receta=$id_receta0 ORDER BY id_receta ASC";
                            $resultado1=mysqli_query($mysqli,$query1);
                            $row1=$resultado1->fetch_assoc();
                            $name1=$row1['nombre_receta'];
                            $user1=$row1['id_usuario'];
                            $type1=$row1['tipo'];
                            $calor1=$row1['calorias'];
                            $cal1=$row1['calificacion'];
                    ?>
                            <div class="grid-item">
                                <div class="receta_imagen"><img height="100%" width="100%" src="data:image/jpg;base64,<?php echo base64_encode($row1['imagen']); ?>"></div>
                                <div class="receta_titulo"><?php echo $name1; ?></div>
                                <div class="receta_usuario"><img height="20" width="20" src="css/imagenes/user"><?php echo $user1 ?></div>
                                <div class="receta_tipo"><?php echo $type1 ?></div>
                                <div class="receta_calorias"><?php echo $calor1 ?> calorias</div>
                                <div class="receta_calificacion">Calificacion: <?php echo $cal1 ?></div>
                            </div>
                    <?php
                        }
                    ?>
                </div></center>
            </div>
            
        </div>
        <div class="editar">
            <a href="editar_perfil.php"><button type="button">Editar Perfil</button></a>
        </div>

        
        <script type="text/javascript">
            function misrecetas(){
                document.getElementById('publicado').style.display = 'block';
                document.getElementById('preferido').style.display = 'none';
            }
            function mispreferidas(){
                document.getElementById('publicado').style.display = 'none';
                document.getElementById('preferido').style.display = 'block';
            }
        </script>   
    </body>
</html>
