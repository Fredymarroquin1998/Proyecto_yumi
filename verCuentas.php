<?php
    session_start();
    if (@!$_SESSION['id_usuario'] || @!$_SESSION['correo']) {
        header("location:index.php");
    }
    $variable1=($_GET['variable1']);
    if($_SESSION['id_usuario'] == $variable1){ 
        header("location:cuenta.php");
    }
?>
<!DOCTYPE html>
<html>
    <link rel="stylesheet" href="css/cuenta.css">
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
                    <li class="menu__group"><a href="cuenta.php" class="menu__link"><img src="css/imagenes/account.png" width="75%"></a><div class="numbre"><?php echo $_SESSION['id_usuario']?></div></li>
                    <li class="menu__group"><a href="cerrar_sesion.php" class="menu__link"><img src="css/imagenes/logout.png" width="72%"><br>Salir</a></li>
                </ul>
            </div>
        </div>
    </head>
    <body bgcolor="#B6F8F7">
        <?php
            require("conexion.php");

            $usuario_actual=$variable1;
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
        <?php
                        $query="SELECT * FROM likes WHERE id_usuario='$usuario_actual' ORDER BY id_receta DESC";
                        $resultado=mysqli_query($mysqli,$query);
                        $estrellasT = 0;
                        while ($row=$resultado->fetch_assoc()) {
                            $estrellasT = $row['calificacion'] + $estrellasT ;
                        }
        ?>
        <div class="estrellas">
            <input type="hidden" name="estrellas"><font size="5"><b><?php echo $estrellasT; ?><br> Estrellas</b></font>
        </div>
        <div class="descripcion">
            <input type="hidden" name="descripcion" maxlength="200"><font size="4"><?php echo $description; ?></font>
        </div>
        <div class="opciones">
            <div class="publicado">
                <button type="button" id="misrecetas" onclick="misrecetas();">SUS RECETAS</button>
                <center><div class="grid-container" id="publicado" style="display: none;">
                    <?php
                        $query="SELECT * FROM recetas WHERE id_usuario='$usuario_actual' ORDER BY id_receta DESC";
                        $resultado=mysqli_query($mysqli,$query);
                        while ($row=$resultado->fetch_assoc()) {
                            $name=$row['nombre_receta'];
                            $user=$row['id_usuario'];
                            $type=$row['tipo'];
                            $calor=$row['calorias'];
                            $persona=$row['persona'];
                            $cal=$row['calificacion'];
                            if($persona == 0){
                                $cal = 0;
                            }else{
                                $cal = $cal / $persona;
                            }
                            
                            $id_receta=$row['id_receta'];
                            if ($row['tipo']==1) {
                                $type='Bebida';
                            } else if ($row['tipo']==2) {
                                $type='Ensalda';
                            } else if ($row['tipo']==3) {
                                $type='Desayuno';
                            } else if ($row['tipo']==4) {
                                $type='Sandwich';
                            } else if ($row['tipo']==5) {
                                $type='Postre';
                            } else if ($row['tipo']==6) {
                                $type='Sopa';
                            } else if ($row['tipo']==7) {
                                $type='Crema';
                            } else if ($row['tipo']==8) {
                                $type='Carne';
                            } else if ($row['tipo']==9) {
                                $type='Pasta';
                            } else if ($row['tipo']==10) {
                                $type='Salsa';
                            } else if ($row['tipo']==11) {
                                $type='Bocadillo';
                            } else if ($row['tipo']==12) {
                                $type='Platillo principal';
                            } else if ($row['tipo']==13) {
                                $type='Acompañante';
                            } else if ($row['tipo']==14) {
                                $type='Mariscos';
                            }
                            echo "<a href='receta.php?receta=$id_receta' target='_blank'>";

                    ?>
                                <div class="grid-item">
                                    <div class="receta_imagen"><img height="100%" width="100%" src="data:image/jpg;base64,<?php echo base64_encode($row['imagen']); ?>"></div>

                                    <div class="receta_titulo" style="color:#000;"><?php echo $name; ?></div>
                                    <?php if(strlen($name) <= 18){
                                            echo '<br>-';
                                            }
                                        ?>
                                    <div class="receta_usuario"><img height="20" width="20" src="css/imagenes/user"><?php echo $user ?></div>
                                    <div class="receta_tipo"><?php echo $type ?></div>
                                    <div class="receta_calorias"><?php echo $calor ?> calorias</div>
                                    <div class="receta_calificacion">Calificacion: <?php echo round($cal, 1) ?></div>
                                    <br>
                                </div>
                            </a>
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
                            $persona=$row1['persona'];
                            if($persona == 0){
                                $cal1 = 0;
                            }else{
                                $cal1 = $cal1 / $persona;
                            }
                            if ($row1['tipo']==1) {
                                $type1='Bebida';
                            } else if ($row1['tipo']==2) {
                                $type1='Ensalda';
                            } else if ($row1['tipo']==3) {
                                $type1='Desayuno';
                            } else if ($row1['tipo']==4) {
                                $type1='Sandwich';
                            } else if ($row1['tipo']==5) {
                                $type1='Postre';
                            } else if ($row1['tipo']==6) {
                                $type1='Sopa';
                            } else if ($row1['tipo']==7) {
                                $type1='Crema';
                            } else if ($row1['tipo']==8) {
                                $type1='Carne';
                            } else if ($row1['tipo']==9) {
                                $type1='Pasta';
                            } else if ($row1['tipo']==10) {
                                $type1='Salsa';
                            } else if ($row1['tipo']==11) {
                                $type1='Bocadillo';
                            } else if ($row1['tipo']==12) {
                                $type1='Platillo principal';
                            } else if ($row1['tipo']==13) {
                                $type1='Acompañante';
                            } else if ($row1['tipo']==14) {
                                $type1='Mariscos';
                            }
                            echo "<a href='receta.php?receta=$id_receta0' target='_blank'>";
                    ?>
                                <div class="grid-item">
                                    <div class="receta_imagen"><img height="100%" width="100%" src="data:image/jpg;base64,<?php echo base64_encode($row1['imagen']); ?>"></div>
                                    <div class="receta_titulo" style="color:#000;"><?php echo $name1; ?></div>
                                    <?php if(strlen($name1) <= 18){
                                            echo '<br>-';
                                            }
                                        ?>
                                    <div class="receta_usuario"><img height="20" width="20" src="css/imagenes/user"><?php echo $user1 ?></div>
                                    <div class="receta_tipo"><?php echo $type1 ?></div>
                                    <div class="receta_calorias"><?php echo $calor1 ?> calorias</div>
                                    <div class="receta_calificacion">Calificacion: <?php echo round($cal1, 1) ?></div>
                                    <br>
                                </div>
                            </a>
                    <?php
                        }
                    ?>
                </div></center>
            </div>
            
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
