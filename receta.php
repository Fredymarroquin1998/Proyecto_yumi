<<?php
    session_start();
    if (@!$_SESSION['id_usuario'] || @!$_SESSION['correo']) {
        header("location:index.php");
    }
?>

<!DOCTYPE html>
<html>
    <link rel="stylesheet" href="css/receta.css">
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
        <div class="receta">
            <div class="arriba">
                <div class="izquierda">
                    <div class="save"><img src="css/imagenes/save0"></div>
                    <div class="imagen"></div>
                    <div class="estrellas"><img src="css/imagenes/star0" height="40" width="40" id="s1"><img src="css/imagenes/star0" height="40" width="40" id="s2"><img src="css/imagenes/star0" height="40" width="40" id="s3"><img src="css/imagenes/star0" height="40" width="40" id="s4"><img src="css/imagenes/star0" height="40" width="40" id="s5"></div>
                </div>
                <div class="derecha">
                    <div class="cancelar"><img src="css/imagenes/cancel"></div>
                    <div class="label0"><img src="css/imagenes/user" width="25" height="25"> Usuario<br></div>
                    <div class="label1">Nombre Receta</div>
                    <div class="label2">Descripcion</div>
                    <div class="linea"></div>
                    <div class="label3"><b>Tipo:</b> Tipo</div>
                    <div class="label4"><b>Tiempo:</b> tiempo</div>
                    <div class="label5"><b>Costo:</b> costo</div>
                    <div class="label6"><b>Porciones:</b> porciones</div>
                    <div class="label7"><b>Complejidad:</b> muy alta</div>
                    <div class="label8"><b>Calorias:</b> calorias</div>
                    <div class="label9"><b>Calificacion:</b> calificacion</div>
                </div>
                <div class="linea1"></div>
            </div>
            <div class="abajo">
                <div class="ingredientes"><b>Ingredientes: </b><br>
                    <ol>
                    <?php 
                        $arreglo1=['uno','dos','tres','cuatro'];
                        for ($i=0; $i < count($arreglo1); $i++) { 
                            echo '<li>'.$arreglo1[$i].'</li>';
                        }
                    ?>
                    <br>
                    </ol>
                </div>
                <div class="preparacion"><b>Preparacion: </b><br>
                    <ol>
                    <?php 
                        $arreglo2=['cinco','seis','siete'];
                        for ($i=0; $i < count($arreglo2); $i++) { 
                            echo '<li>'.$arreglo2[$i].'</li>';
                        }
                    ?>
                    <br>
                    </ol>
                </div>
            </div>
        </div>
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