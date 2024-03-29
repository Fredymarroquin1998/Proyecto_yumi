<?php
    session_start();
    if (@!$_SESSION['id_usuario'] || @!$_SESSION['correo']) {
        header("location:index.php");
    }
    
    require("conexion.php");
   
    if (isset($_POST['submit'])) {
    
        $id_usuario=$_SESSION['id_usuario'];
        $imagen=addslashes(file_get_contents($_FILES['imagen']['tmp_name']));
        $nombre=$_POST['nombre'];
        $descripcion=$_POST['descripcion'];
        $tipo=$_POST['tipo'];
        $complejidad=$_POST['complejidad'];
        $cantidad=$_POST['cantidad'];
        $costo=$_POST['costo'];
        $horas=$_POST['horas']; 
        $minutos=$_POST['minutos'];
        $tiempo=(60*$horas)+$minutos;
        $calorias=$_POST['calorias'];
        $ingredientes='';
        $preparacion='';

        for ($i=0; $i < count($_POST['ingredientes']); $i++) { 
            if (trim($_POST['ingredientes'][$i]!='')) {
                $ingredientes.=$_POST['ingredientes'][$i].'\n';
            }
        }

        for ($j=0; $j < count($_POST['preparacion']); $j++) { 
            if (trim($_POST['preparacion'][$j]!='')) {
                $preparacion.=$_POST['preparacion'][$j].'\n';
            }
        }

        mysqli_query($mysqli, "BEGIN");
        $sql_receta="SELECT id FROM correlativo";
        $id_r=mysqli_query($mysqli,$sql_receta);
        $row=mysqli_fetch_array($id_r);
        $id_receta0=$row[0];
        $id_receta=$id_receta0+1;

        $sql="INSERT INTO recetas 
              VALUES($id_receta,'$id_usuario','$nombre','$descripcion',$tipo,'$ingredientes',0,$complejidad,$cantidad,'$imagen','$preparacion',$costo,$tiempo,$calorias,0)";
        $resultado=mysqli_query($mysqli,$sql);
        $sql2="UPDATE correlativo SET id=$id_receta WHERE id=$id_receta0";
        $resultado2=mysqli_query($mysqli,$sql2);
        if (@$resultado) {
            echo '<script type="text/javascript">alert("Publicado!");</script>';
            echo '<script language="javascript">location.href="inicio.php"</script>';
            mysql_query($mysqli,"COMMIT");
        } else {
            die("Error".mysqli_error($mysqli));
            mysqli_query($mysqli,"ROLLBACK");
        }  
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
                <select style="width:6%; height:30%;" name="opcion" id="opcion">
                    <option value="nombre" onclick="tipos('nombre');">Nombre</option>
                    <option value="tipo" onclick="tipos('tipo');">Tipo</option>
                    <option value="calorias" onclick="tipos('calorias');">Calorias</option>
                </select>
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
</html>
<script type="text/javascript">
    function tipos(a){
        if (a=="tipo") {
            document.getElementById('busqueda_tipo').style.display = 'block';
            document.getElementById('busqueda').style.display = 'none';
        } else {
            document.getElementById('busqueda_tipo').style.display = 'none';
            document.getElementById('busqueda').style.display = 'block';
        }
    }

    
</script>