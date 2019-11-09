<?php
    session_start();
    if (@!$_SESSION['id_usuario'] || @!$_SESSION['correo']) {
        header("location:index.php");
    }
?>

<!DOCTYPE html>
<html>
    <link rel="stylesheet" href="css/receta.css">
    <script src="jquery-3.3.1.min.js"></script>
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
    <body bgcolor="B6F8F7">
        <?php
            require("conexion.php");
            $id_us="";
            $id_receta=$_GET["receta"];
            $query="SELECT * FROM recetas WHERE id_receta=$id_receta";
            $resultado=mysqli_query($mysqli,$query);
            $row=mysqli_fetch_assoc($resultado);
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

                    if ($row["complejidad"]==1) {
                        $row["complejidad"]="Facil";
                    } else if ($row["complejidad"]==2) {
                        $row["complejidad"]="Baja";
                    } else if ($row["complejidad"]==3) {
                        $row["complejidad"]="Media";
                    } else if ($row["complejidad"]==4) {
                        $row["complejidad"]="Alta";
                    } else if ($row["complejidad"]==5) {
                        $row["complejidad"]="Complicada";
                    }
                    $horas=0;
                    $minutos=0;
                    if ($row["tiempo"]<60) {
                        $tiempo=$row["tiempo"].' minutos';
                    } else {
                        while ($row["tiempo"]>60) {
                            $row["tiempo"]=$row["tiempo"]-60;
                            $horas++;
                        }
                        $minutos=$row["tiempo"];
                        if ($horas==1) {
                            $tiempo=$horas.' hora '.$minutos.' minutos';
                        } else {
                            $tiempo=$horas.' horas '.$minutos.' minutos';
                        }
                    }
                    
            echo '<div class="receta">';
                echo '<div class="arriba">';
                    echo '<div class="izquierda"> ';

                        $cuenta = $_SESSION['id_usuario'];
                        $query="SELECT * FROM recetas WHERE id_receta=$id_receta";
                        $res=mysqli_query($mysqli,$query) or die(mysqli_error());
                        $check=mysqli_num_rows($res);
                        if($check>0){
                            
                        }else{
                            header("location:index.php");
                        }

                        $query="SELECT * FROM preferencias WHERE id_receta=$id_receta and id_usuario='$cuenta'";
                        $res=mysqli_query($mysqli,$query) or die(mysqli_error());
                        $check=mysqli_num_rows($res);
                        if($check>0){
                            echo '<div class="save"><img src="css/imagenes/save" id="ss" onclick="changeImage2()"></div>';
                        }else{
                            echo '<div class="save"><img src="css/imagenes/save0" id="ss" onclick="changeImage2()"></div>';
                        }                
                        echo '<div class="imagen"><div class="imagen"><img height="100%" width="100%" src="data:image/jpg;base64,'.base64_encode($row["imagen"]).'"></div></div>';                        
                        $query="SELECT * FROM likes WHERE id_receta='$id_receta' and id_usuario='$cuenta'";
                        $res=mysqli_query($mysqli,$query) or die(mysqli_error($mysqli));
                        $check=mysqli_num_rows($res);
                        $query=mysqli_query($mysqli,$query) or die(mysqli_error($mysqli));
                        echo '<div class="estrellas">';
                        if($check>0){
                            $numeros =0;
                            while ($rowi=mysqli_fetch_assoc($query)) {
                                $numeros = $rowi['calificacion'];
                            }
                            if($numeros == 1){
                                echo '<img src="css/imagenes/star" height="40" width="40" id="s1" onclick="changeImage(1)">';
                                echo '<img src="css/imagenes/star0" height="40" width="40" id="s2" onclick="changeImage(2)">';
                                echo '<img src="css/imagenes/star0" height="40" width="40" id="s3" onclick="changeImage(3)">';
                                echo '<img src="css/imagenes/star0" height="40" width="40" id="s4" onclick="changeImage(4)">';
                                echo '<img src="css/imagenes/star0" height="40" width="40" id="s5" onclick="changeImage(5)">';
                            }else if($numeros == 2){
                                echo '<img src="css/imagenes/star" height="40" width="40" id="s1" onclick="changeImage(1)">';
                                echo '<img src="css/imagenes/star" height="40" width="40" id="s2" onclick="changeImage(2)">';
                                echo '<img src="css/imagenes/star0" height="40" width="40" id="s3" onclick="changeImage(3)">';
                                echo '<img src="css/imagenes/star0" height="40" width="40" id="s4" onclick="changeImage(4)">';
                                echo '<img src="css/imagenes/star0" height="40" width="40" id="s5" onclick="changeImage(5)">';
                            }else if($numeros == 3){
                                echo '<img src="css/imagenes/star" height="40" width="40" id="s1" onclick="changeImage(1)">';
                                echo '<img src="css/imagenes/star" height="40" width="40" id="s2" onclick="changeImage(2)">';
                                echo '<img src="css/imagenes/star" height="40" width="40" id="s3" onclick="changeImage(3)">';
                                echo '<img src="css/imagenes/star0" height="40" width="40" id="s4" onclick="changeImage(4)">';
                                echo '<img src="css/imagenes/star0" height="40" width="40" id="s5" onclick="changeImage(5)">';
                            }else if($numeros == 4){
                                echo '<img src="css/imagenes/star" height="40" width="40" id="s1" onclick="changeImage(1)">';
                                echo '<img src="css/imagenes/star" height="40" width="40" id="s2" onclick="changeImage(2)">';
                                echo '<img src="css/imagenes/star" height="40" width="40" id="s3" onclick="changeImage(3)">';
                                echo '<img src="css/imagenes/star" height="40" width="40" id="s4" onclick="changeImage(4)">';
                                echo '<img src="css/imagenes/star0" height="40" width="40" id="s5" onclick="changeImage(5)">';
                            }else{
                                echo '<img src="css/imagenes/star" height="40" width="40" id="s1" onclick="changeImage(1)">';
                                echo '<img src="css/imagenes/star" height="40" width="40" id="s2" onclick="changeImage(2)">';
                                echo '<img src="css/imagenes/star" height="40" width="40" id="s3" onclick="changeImage(3)">';
                                echo '<img src="css/imagenes/star" height="40" width="40" id="s4" onclick="changeImage(4)">';
                                echo '<img src="css/imagenes/star" height="40" width="40" id="s5" onclick="changeImage(5)">';
                            }   
                        
                        }else{
                            echo '<img src="css/imagenes/star0" height="40" width="40" id="s1" onclick="changeImage(1)">';
                            echo '<img src="css/imagenes/star0" height="40" width="40" id="s2" onclick="changeImage(2)">';
                            echo '<img src="css/imagenes/star0" height="40" width="40" id="s3" onclick="changeImage(3)">';
                            echo '<img src="css/imagenes/star0" height="40" width="40" id="s4" onclick="changeImage(4)">';
                            echo '<img src="css/imagenes/star0" height="40" width="40" id="s5" onclick="changeImage(5)">';
                        }
                        echo '</div>';

                        
                        
                        


                        $user = $row["id_usuario"];

                    echo '</div>';
                    echo '<div class="derecha">';
                        echo '<a style="text-decoration:none" href ="verCuentas.php?variable1='.$user.'"><div class="label0"><img src="css/imagenes/user" width="25" height="25">'.' '.$user.'</a><form method="POST" action="editarReceta.php"><br></div>';
                        $id_us = $row["id_usuario"];
                        $persona = $row["persona"];
                        $calificacion = 0;
                        if($persona != 0){
                            $calificacion = $row["calificacion"] / $persona;
                        }
                        echo '<div class="label1">'.$row["nombre_receta"].'</div>';
                        echo '<div class="label2">'.$row["descripcion"].'</div>';
                        echo '<div class="linea"></div>';
                        echo '<div class="label3"><b>Tipo:</b>'.' '.$type.'</div>';
                        echo '<div class="label4"><b>Tiempo:</b>'.' '.$tiempo.'</div>';
                        echo '<div class="label5"><b>Costo($):</b>'.' '.$row["costo"].'</div>';
                        echo '<div class="label6"><b>Porciones:</b>'.' '.$row["cantidad_personas"].'</div><br>';
                        echo '<div class="label7"><b>Complejidad:</b>'.' '.$row["complejidad"].'</div>';
                        echo '<div class="label8"><b>Calorias:</b>'.' '.$row["calorias"].'</div>';
                        echo '<div class="label9"><b>Calificacion:</b>'.' '.$calificacion.'</div>';
                    echo '</div>';
                    echo '<div class="linea1"></div>';
                echo '</div>';
                echo '<div class="abajo">';
                    echo '<div class="ingredientes"><b>Ingredientes: </b><br>';
                        echo '<ol>';
                        
                        $ingredientes=explode("\n", $row["ingredientes"]);  
                        for ($i=0; $i < count($ingredientes)-1; $i++) { 
                            echo '<li>'.$ingredientes[$i].'</li>';
                        }
                        echo '<br>';
                        echo '</ol>';
                    echo '</div>';
                    echo '<div class="preparacion"><b>Preparacion: </b><br>
                        <ol>';
                         
                        $elaboracion=explode("\n", $row["elaboracion"]);  
                        for ($i=0; $i < count($elaboracion)-1; $i++) { 
                            echo '<li>'.$elaboracion[$i].'</li>';
                        }
                    
                        echo '<br>
                        
                        </ol>
                        ';
                        if($cuenta == $row["id_usuario"]){
                            echo ' 
                            
                                <div class="row">
                                    
                                    <input type="hidden" id="id_receta" name="id_receta" value="'.$id_receta.'">
                                    <button type="submit" name="submit">EDITAR</button>
                                    </form>
                                    <button onclick="eliminar()">ELIMINAR</button>
                                    
                                <div class="centrar">
                                
                                </div>
                            </div>
                            ';
                        }
                        

                        echo '
                    </div>
                </div>
            </div>';
            echo '<input id="prodId" name="prodId" type="hidden" value="'.$id_receta.'" >';
            echo '<input id="perid" name="perid" type="hidden" value="'.$_SESSION['id_usuario'].'" >';
        ?>
        <div id="select2lista"></div>
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

<script type="text/javascript">
$(document).ready(function () {
    var x = 0;
    x = $(window).width();
    x = (x / screen.width ) * 100;

    if (x > 50) {
        document.body.style.zoom = x + "%";
    }else{
        document.body.style.zoom = 50 + "%";
    }

    $(window).resize(function (event) {
        x = $(window).width();
        x = (x / screen.width ) * 100;
        document.body.style.zoom = x + "%";
    });
});
</script>
<script language="javascript">
        function eliminar() {
        $.ajax({
            type:"POST",  
            url:"eliminarReceta.php",
            data: {prodId: $('#prodId').val()},
            success:function(r){
                $('#select2lista').html(r);
                location.href="inicio.php";

                }
            });
        }

        function changeImage2() {

        var imgClickAndChange = document.getElementById("ss");
        if (imgClickAndChange.src.indexOf("css/imagenes/save0") !== -1){
         imgClickAndChange.src="css/imagenes/save";

         recargarLista(1);
        }else{
         imgClickAndChange.src="css/imagenes/save0";
         recargarLista(2);
        }
    }
        function recargarLista(a){

            if(a == 1){
            $.ajax({
            type:"POST",  
            url:"recetaAuxiliar.php",
            data: {prodId: $('#prodId').val(),val: "1",perid: $('#perid').val()},
            success:function(r){
                $('#select2lista').html(r);
                }
            });
            }else{
                  $.ajax({
            type:"POST",  
            url:"recetaAuxiliar.php",
            data: {prodId: $('#prodId').val(),val: "2",perid: $('#perid').val()},
            success:function(r){
                $('#select2lista').html(r);
                }
            });
            }
        
        }

    function changeImage(numero) {
            var imgClickAndChange1 = document.getElementById("s1");
            var imgClickAndChange2 = document.getElementById("s2");
            var imgClickAndChange3 = document.getElementById("s3");
            var imgClickAndChange4 = document.getElementById("s4");
            var imgClickAndChange5 = document.getElementById("s5");
            if (numero == 1){
                imgClickAndChange5.src="css/imagenes/star0";
                imgClickAndChange1.src="css/imagenes/star";
                imgClickAndChange2.src="css/imagenes/star0";
                imgClickAndChange3.src="css/imagenes/star0";
                imgClickAndChange4.src="css/imagenes/star0";
            
            }else if (numero == 2){
                imgClickAndChange5.src="css/imagenes/star0";
                imgClickAndChange1.src="css/imagenes/star";
                imgClickAndChange2.src="css/imagenes/star";
                imgClickAndChange3.src="css/imagenes/star0";
                imgClickAndChange4.src="css/imagenes/star0";

            }else if (numero == 3){
                imgClickAndChange5.src="css/imagenes/star0";
                imgClickAndChange1.src="css/imagenes/star";
                imgClickAndChange2.src="css/imagenes/star";
                imgClickAndChange3.src="css/imagenes/star";
                imgClickAndChange4.src="css/imagenes/star0";

            }else if (numero == 4){
                imgClickAndChange5.src="css/imagenes/star0";
                imgClickAndChange1.src="css/imagenes/star";
                imgClickAndChange2.src="css/imagenes/star";
                imgClickAndChange3.src="css/imagenes/star";
                imgClickAndChange4.src="css/imagenes/star";

            }else{
                imgClickAndChange5.src="css/imagenes/star";
                imgClickAndChange1.src="css/imagenes/star";
                imgClickAndChange2.src="css/imagenes/star";
                imgClickAndChange3.src="css/imagenes/star";
                imgClickAndChange4.src="css/imagenes/star";

            }
            $.ajax({
                type:"POST",  
                url:"estrellas.php",
                data: {prodId: $('#prodId').val(),val: numero,perid: $('#perid').val()},
                success:function(r){
                    $('#select2lista').html(r);
                    }
                });
    }


</script>
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