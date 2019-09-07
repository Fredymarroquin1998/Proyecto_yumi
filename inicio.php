<?php
    session_start();
    if (@!$_SESSION['id_usuario']) {
        header("location:index.php");
    }
?>

<!DOCTYPE html>
<html>
    <link rel = "stylesheet" href="css/inicio.css">
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

    <body bgcolor="B6F8F7">
        <form action="subir_receta.php" method="post" enctype="multipart/form-data">
            <div class="container">
                <input type="checkbox" id="toggle">
                <label for="toggle" class="button"></label>
                <nav class="nav">
                    <div class="izquierda">
                        <script class="jsbin" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
                        <div class="file-upload">
                            <div class="image-upload-wrap">
                                <input class="file-upload-input" type='file' name="imagen" onchange="readURL(this);" accept="image/*" required/>
                                <div class="drag-text">
                                    <h3>Presione para agregar imagen</h3>
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
                            <div class="label1">Ingredientes:<br>
                                <table id="tabla_ingredientes">  
                                    <tr>  
                                        <td><input type="text" name="ingredientes[]" placeholder="Agregar ingrediente..."></td>  
                                        <td><button type="button" name="add_ingrediente" id="add_ingrediente" class="mas" onclick="ing()">+</button></td>  
                                    </tr>  
                                </table>  
                            </div>
                        </div>
                        <div class="row">
                            <div class="label1"><br>Preparacion:<br>
                                <table id="tabla_preparacion">  
                                    <tr>  
                                        <td><input type="text" name="preparacion[]" placeholder="Primer paso..."></td>  
                                        <td><button type="button" name="add_preparacion" id="add_preparacion" class="mas" onclick="pre()">+</button></td>  
                                    </tr>  
                                </table>  
                            </div>
                        </div>                
                    </div>
                    <div class="derecha">
                        <div class="row">
                            <div class="label">Nombre Receta: <br>
                                <input type="text" name="nombre" class="confondo" maxlength="30" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="label">Descripcion: <br>
                                <input type="text" name="descripcion" class="confondo" maxlength="200" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="label">Tipo: 
                                <select class="seleccion" name="tipo" required>
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
                        </div>
                        <div class="row">
                            <div class="label">Complejidad: 
                                <input type="range" min="1" max="5" class="slider" required id="myRange" name="complejidad"><span id="demo"></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="label">Cantidad de porciones: 
                                <input type="number" class="numeros" min="1" required pattern="[0-9]+" value="1" name="cantidad"> Persona(s)
                            </div>
                        </div>
                        <div class="row">
                            <div class="label">Costo: $ 
                                <input type="number" min="0.00" step="0.01" class="numeros" required pattern="[0-9]+\\.[0-9]{2}" value="0.00" name="costo">
                            </div>
                        </div>
                        <div class="row">
                            <div class="label">Tiempo de preparacion: <input type="number" value="0" name="horas" min="0" step="1" class="numeros" required pattern="[0-9]+"> Hora(s) <input type="number" value="0" name="minutos" min="0" step="1" max="59" class="numeros" required pattern="[0-9]+"> Minutos.
                            </div>
                        </div>
                        <div class="row">
                            <div class="label">Calorias: 
                                <input type="number" name="calorias" min="0" class="numeros" required pattern="[0-9]+" value="0">
                            </div>
                        </div>                    
                    </div>
                    <div class="row">
                        <button type="submit" name="submit">PUBLICAR</button>
                    </div>  
                </nav>
            </div>
        </form>


        <center><div class="grid-container">
            <?php
                require("conexion.php");

                $query="SELECT * FROM recetas";
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

        <script type="text/javascript">
            var item = $(".grid-item");
            item.hover(function() {
            item.not($(this)).addClass('blur');
            // al perder el foco, retiro la clase a todos los 'item'
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
                    $('#tabla_ingredientes').append('<tr id="linea'+i+'"><td><input type="text" name="ingredientes[]" placeholder="Agregar ingrediente..." class="name_list"></td><td><button type="button" name="remove ingrediente" id="'+i+'" class="btn_remove"> x </button></td></tr>');  
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
                    $('#tabla_preparacion').append('<tr id="lineas'+j+'"><td><input type="text" name="preparacion[]" placeholder="Siguiente paso..." class="name_list"></td><td><button type="button" name="remove preparacion" id="'+j+'" class="btns_remove"> x </button></td></tr>');  
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