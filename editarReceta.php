<?php

    session_start();
    require("conexion.php");
    if (@!$_SESSION['id_usuario'] || @!$_SESSION['correo']) {
        header("location:index.php");
    }
    $id_receta=$_POST["id_receta"];
    
    $query="SELECT * FROM recetas WHERE id_receta=$id_receta";
            $resultado=mysqli_query($mysqli,$query);
            $row=mysqli_fetch_assoc($resultado);
            $nombre_receta = $row['nombre_receta'];
            $descripcion = $row['descripcion'];
            $tipo = $row['tipo'];
            $calificacion = $row['calificacion'];
            $complejidad = $row['complejidad'];
            $costo = $row['costo'];
            $tiempo = $row['tiempo'];
            $calorias = $row['calorias'];
            $cantidad_personas = $row['cantidad_personas'];
            $horas=0;
            $minutos=0;
            echo $tiempo;
            if ($tiempo<60) {
                $minutos=$tiempo;
            }else {
                while ($tiempo>60) {
                    $tiempo=$tiempo-60;
                    $horas++;
                }
                $minutos=$tiempo;
                
            }


?>

<!DOCTYPE html>
<html>
    <link rel="stylesheet" href="css/editarReceta.css">
    <link rel="shortcut icon" href="css/imagenes/yumi_icono.ico">       
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Yumi</title>
    <head>
        <div class="barra" >
            <div class="logo"> 
                <a href="inicio.php"><img src="css/imagenes/inicio" width="85%"></a>
            </div>
            <form method="POST" action="buscar.php">
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
                    <li class="menu__group"><a href="cuenta.php" class="menu__link"><img src="css/imagenes/account.png" width="60%"><br>Perfil</a></li>
                    <li class="menu__group"><a href="cerrar_sesion.php" class="menu__link"><img src="css/imagenes/logout.png" width="72%"><br>Salir</a></li>
                </ul>
            </div>
        </div>
    </head>

    <body bgcolor="B6F8F7">
        <form action="guardarReceta.php" method="post" enctype="multipart/form-data">
            <div class="container">
                
                <nav class="nav">
                    <div class="izquierda">
                    <br>
                        <center>imagen actual</center>
                        <script class="jsbin" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
                        <?php
                   
                        echo '<div class="imagen"><div class="imagen"><img height="50%" width="60%" src="data:image/jpg;base64,'.base64_encode($row["imagen"]).'"></div></div>';
                        ?>
                        <div class="row">       
                            <div class="label1">Ingredientes:<br>
                                <table id="tabla_ingredientes">  
                                <tr>
                                    <?php 
                                        $ingredientes=explode("\n", $row["ingredientes"]);  
                                        for ($i=0; $i < count($ingredientes)-1; $i++) { 
                                            echo '<tr><td><input type="text" id="linea'.$i.'"name="ingredientes[]" value="'.$ingredientes[$i].'" class="name_list"  ></td><td><button type="button" name="remove ingrediente" id="bul'.$i.'" class="btn_remove" onclick="borrar('.$i.' )"> x </button></td></tr>';
                                            
                                        } 
                                    ?>
                                    </tr>
                                    <tr>  
                                        <td><input type="text" name="ingredientes[]" placeholder="Agregar ingrediente..." style="text-transform: capitalize;" ></td>  
                                        <td><button type="button" name="add_ingrediente" id="add_ingrediente" class="mas" onclick="ing()">+</button></td>  
                                        
                                    </tr>  
                                    
                                    
                        
                                    
                                </table>  
                            </div>

                        </div>

                        <div class="row">
                            <div class="label1"><br>Preparacion:<br>
                                <table id="tabla_preparacion">  
                                <tr>
                                    <?php 
                                        $elaboracion=explode("\n", $row["elaboracion"]);  
                                        for ($i=0; $i < count($elaboracion)-1; $i++) { 
                                            echo '<tr><td><input type="text" id="prep'.$i.'"name="preparacion[]" value="'.$elaboracion[$i].'" class="name_list"  required></td><td><button type="button" name="remove ingrediente" id="bor'.$i.'" class="btn_remove" onclick="borrar2('.$i.' )"> x </button></td></tr>';
                                            
                                        } 
                                    ?>
                                    </tr>
                                    <tr>  
                                        <td><input type="text" name="preparacion[]" placeholder="Agregar paso..." style="text-transform: capitalize;" ></td>  
                                        <td><button type="button" name="add_preparacion" id="add_preparacion" class="mas" onclick="pre()">+</button></td>  
                                    </tr>  
                                </table>  
                            </div>
                        </div>  
                        <div class="row">
                        <button type="submit" name="submit">GUARDAR</button>
                    </div>                
                    </div>

                    <div class="derecha">
                    <div class="file-upload">
                        
                            <div class="image-upload-wrap">

                                <input class="file-upload-input" type='file' name="imagen" onchange="readURL(this);" accept="image/*" />
                                <div class="drag-text">
                                    <h3>Presione para cambiar imagen</h3>
                                </div>
                            </div>
                            <div class="file-upload-content">
                                <img class="file-upload-image" src="#" alt="your image" />
                                <div class="image-title-wrap">
                                    <button type="button" onclick="removeUpload()" class="remove-image">Eliminar</button>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="label">Nombre Receta: <br>
                                <input type="text" name="nombre" class="confondo" maxlength="29" style="text-transform: capitalize;"  value="<?php echo $nombre_receta ?>" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="label">Descripcion: <br>
                                <input type="text" name="descripcion" class="confondo" maxlength="200" value="<?php echo $descripcion ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="label">Tipo: 
                                <select class="seleccion" name="tipo"  required>

                                    <?php 
                                        if($tipo == 1){
                                            echo '<option value="1" selected>Bebida</option>';
                                        }else{
                                            echo '<option value="1">Bebida</option>';
                                        }
                                        if($tipo == 2){
                                            echo '<option value="2" selected>Ensalada</option>';
                                        }else{
                                            echo '<option value="2">Ensalada</option>';
                                        }
                                        if($tipo == 3){
                                            echo '<option value="3" selected>Desayuno</option>';
                                        }else{
                                            echo '<option value="3">Desayuno</option>';
                                        }
                                        if($tipo == 4){
                                            echo '<option value="4" selected>Sandwich</option>';
                                        }else{
                                            echo '<option value="4">Sandwich</option>';
                                        }
                                        if($tipo == 5){
                                            echo '<option value="5" selected>Postre</option>';
                                        }else{
                                            echo '<option value="5">Postre</option>';
                                        }
                                        if($tipo == 6){
                                            echo '<option value="6" selected>Sopa</option>';
                                        }else{
                                            echo '<option value="6">Sopa</option>';
                                        }
                                        if($tipo == 7){
                                            echo '<option value="7" selected>Crema</option>';
                                        }else{
                                            echo '<option value="7">Crema</option>';
                                        }
                                        if($tipo == 8){
                                            echo '<option value="8" selected>Carne</option>';
                                        }else{
                                            echo '<option value="8">Carne</option>';
                                        }
                                        if($tipo == 9){
                                            echo '<option value="9" selected>Pasta</option>';
                                        }else{
                                            echo '<option value="9">Pasta</option>';
                                        }
                                        if($tipo == 10){
                                            echo '<option value="10" selected>Salsa</option>';
                                        }else{
                                            echo '<option value="10">Salsa</option>';
                                        }
                                        if($tipo == 11){
                                            echo '<option value="11" selected>Bocadillo</option>';
                                        }else{
                                            echo '<option value="11">Bocadillo</option>';
                                        }
                                        if($tipo == 12){
                                            echo '<option value="12" selected>Platillo principal</option>';
                                        }else{
                                            echo '<option value="12">Platillo principal</option>';
                                        }
                                        if($tipo == 13){
                                            echo '<option value="13" selected>Acompañante</option>';
                                        }else{
                                            echo '<option value="13">Acompañante</option>';
                                        }
                                        if($tipo == 14){
                                            echo '<option value="14" selected>Mariscos</option>';
                                        }else{
                                            echo '<option value="14">Mariscos</option>';
                                        }
                                    ?>                                    
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="label">Complejidad: 
                                <input type="range" min="1" max="5" value="<?php echo $complejidad ?>" class="slider" required id="myRange" name="complejidad"><span id="demo" ></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="label">Cantidad de porciones: 
                                <input type="number" class="numeros" min="1" value="<?php echo $cantidad_personas ?>" required pattern="[0-9]+" value="1" name="cantidad"> Persona(s)
                            </div>
                        </div>
                        <div class="row">
                            <div class="label">Costo: $ 
                                <input type="number" min="0.00" step="1.00" value="<?php echo $costo ?>" class="numeros" required pattern="[0-9]+\\.[0-9]{2}" value="0.00" name="costo">
                            </div>
                        </div>
                        <div class="row">
                            <div class="label">Tiempo de preparacion: <input type="number"  name="horas" min="0" step="1" class="numeros" required pattern="[0-9]+" value="<?php echo $horas ?>"> Hora(s) <input type="number"  name="minutos" min="0" step="1" value="<?php echo $minutos ?>" max="59" class="numeros" required pattern="[0-9]+"> Minutos.
                            </div>
                        </div>
                        <div class="row">
                            <div class="label">Calorias: 
                                <input type="number" name="calorias" min="0" class="numeros" pattern="[0-9]+" value="<?php echo $calorias ?>">
                            </div>
                        </div>                    
                    </div>
                    
                </nav>
            </div>
            <?php
                    echo '<input id="id_receta" name="id_receta" type="hidden" value="'.$id_receta.'" >';
                       
                        ?>

        </form>


        <center><div class="grid-container">
            <?php
                require("conexion.php");
                $query="SELECT * FROM recetas ORDER BY id_receta DESC";
                $resultado=mysqli_query($mysqli,$query);
                while ($row=$resultado->fetch_assoc()) {
                    $name=$row['nombre_receta'];
                    $user=$row['id_usuario'];
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
                    $calor=$row['calorias'];
                    $cal=$row['calificacion'];
                    echo "<a href='receta.php?receta=$id_receta' target='_blank'>";
             
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

        <script type="text/javascript">
            var slider = document.getElementById("myRange");
            var output = document.getElementById("demo");
            output.innerHTML = slider.value;

            slider.oninput = function() {
                if (this.value==1) {
                    output.innerHTML = "Facil";
                } else if (this.value==2) {
                    output.innerHTML = "Baja";
                } else if (this.value==3) {
                    output.innerHTML = "Media";
                } else if (this.value==4) {
                    output.innerHTML = "Alta";
                } else if (this.value==5) {
                    output.innerHTML = "Complicada";
                }  
            }

        </script>

        <script>  
            $(document).ready(function ing(){  
                var i=1;
                $('#add_ingrediente').click(function(){  
                    i++;  
                    $('#tabla_ingredientes').append('<tr id="linea'+i+'"><td><input type="text" name="ingredientes[]" placeholder="Agregar ingrediente..." class="name_list"  required></td><td><button type="button" name="remove ingrediente" id="'+i+'" class="btn_remove"> x </button></td></tr>');  
                });
                $(document).on('click', '.btn_remove', function(){  
                    var button_id = $(this).attr("id");   
                    $('#linea'+button_id+'').remove();  
                });    
            });
            

             $(document).ready(function pre(){  
                var j=1;
                $('#add_preparacion').click(function(){  
                    j++;  
                    $('#tabla_preparacion').append('<tr id="lineas'+j+'"><td><input type="text" name="preparacion[]" placeholder="Siguiente paso..." class="name_list" style="text-transform: capitalize;" required></td><td><button type="button" name="remove preparacion" id="'+j+'" class="btns_remove"> x </button></td></tr>');  
                });  
                $(document).on('click', '.btns_remove', function(){  
                    var buttons_id = $(this).attr("id");   
                    $('#lineas'+buttons_id+'').remove();  
                });    
            });  
        </script>
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
    </body>
</html>

<script>
function borrar(numero) {
      $('#linea'+numero).remove(); 
      $('#bul'+numero).remove(); 
    }

function borrar2(numero) {
      $('#prep'+numero).remove(); 
      $('#bor'+numero).remove(); 
    }

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



