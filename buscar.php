<?php
    session_start();
    if (@!$_SESSION['id_usuario'] || @!$_SESSION['correo']) {
        header("location:index.php");
    }
?>

<!DOCTYPE html>
<html>
    <link rel="stylesheet" href="css/inicio.css">
    <link rel="shortcut icon" href="css/imagenes/yumi_icono.ico">       
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Yumi</title>
    <head>
        <div class="barra" >
            <div class="logo"> 
                <a href="inicio.php"><img src="css/imagenes/inicio" height="80" width="250"></a>
            </div>
            <form method="GET" action="buscar.php">
                <div class="buscar_tipo">
                    <select name="busqueda_tipo" id="busqueda_tipo">
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
                <input class="buscar" type="search" name="busqueda" id="busqueda" style="width:31%; height: 30%" size=32 placeholder="Search...">
                <select style="width:6%; height:30%;" name="opcion" id="opcion" onchange="tipos();"><option value="nombre">Nombre</option><option value="tipo">Tipo</option><option value="calorias">Calorias</option></select>
                <div class="textG">
                    <a href="buscar.php?opciones=opcion&buscar=busqueda|busqueda_tipo"><input type=image src="css/imagenes/search.png" width="30" height="30" class="boton"></a>
                </div> 
            </form>
            <div class="menuG">
                <ul class="menu__list">
                    <li class="menu__group"><a href="inicio.php" class="menu__link"><img src="css/imagenes/home.png" width="40" height="40"><br>Inicio</a></li>
                    <li class="menu__group"><a href="cuenta.php" class="menu__link"><img src="css/imagenes/account.png" width="40" height="40"><br>Perfil</a></li>
                    <li class="menu__group"><a href="cerrar_sesion.php" class="menu__link"><img src="css/imagenes/logout.png" width="40" height="40"><br>Salir</a></li>
                </ul>
            </div>
        </div>
    </head>

    <body bgcolor="B6F8F7">
        <center><div class="grid-container">
            <?php
                require("conexion.php");
                $tipo=$_GET['opcion'];
                if ($tipo=="nombre") {
                    $texto=$_GET['busqueda'];
                    $query="SELECT * FROM recetas WHERE nombre_receta LIKE '%".$texto."%' ORDER BY id_receta DESC";
                } else if ($tipo=="tipo") {
                    $texto=$_GET['busqueda_tipo'];
                    $query="SELECT * FROM recetas WHERE tipo=$texto ORDER BY id_receta DESC";
                } else if ($tipo=="calorias") {
                    $texto=$_GET['busqueda'];
                    $query="SELECT * FROM recetas WHERE calorias=$texto ORDER BY id_receta DESC";
                }
                $resultado=mysqli_query($mysqli,$query);
                if (mysqli_num_rows($resultado)<1) {
                    echo "<script language='javascript'>alert('Lo sentimos, no existen resultados!');</script>";
                    echo '<script language="javascript">location.href="inicio.php"</script>';
                }
                while ($row=$resultado->fetch_assoc()) {
                    $name=$row['nombre_receta'];
                    $user=$row['id_usuario'];
                    $calor=$row['calorias'];
                    $cal=$row['calificacion'];
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

        <script type="text/javascript">
            var item = $(".grid-item");
            item.hover(function() {
            item.not($(this)).addClass('blur');
            }, function() {
            item.removeClass('blur');
            });
        </script>
    </body>
</html>

<script type="text/javascript">
    function tipos(){
        if ($('#opcion').val()=="tipo") {
            document.getElementById('busqueda_tipo').style.display = 'block';
            document.getElementById('busqueda').style.display = 'none';
        } else {
            document.getElementById('busqueda_tipo').style.display = 'none';
            document.getElementById('busqueda').style.display = 'block';
        }
    }
</script>