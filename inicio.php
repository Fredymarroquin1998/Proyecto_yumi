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
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <script src='https://cdnjs.cloudflare.com/ajax/libs/brain/0.6.3/brain.js'></script>


    <script  src="notify.js"></script>
    <script src="jquery-3.3.1.min.js"></script>
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
                    <li class="menu__group"><a href="cuenta.php" class="menu__link"><img src="css/imagenes/account.png" width="60%"><br>Perfil</a></li>
                    <li class="menu__group"><a href="cerrar_sesion.php" class="menu__link"><img src="css/imagenes/logout.png" width="72%"><br>Salir</a></li>
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
                                        <td><input type="text" name="ingredientes[]" placeholder="Agregar ingrediente..." style="text-transform: capitalize;" required></td>  
                                        <td><button type="button" name="add_ingrediente" id="add_ingrediente" class="mas" onclick="ing()">+</button></td>  
                                    </tr>  
                                </table>  
                            </div>
                        </div>
                        <div class="row">
                            <div class="label1"><br>Preparacion:<br>
                                <table id="tabla_preparacion">  
                                    <tr>  
                                        <td><input type="text" name="preparacion[]" placeholder="Primer paso..." style="text-transform: capitalize;" required></td>  
                                        <td><button type="button" name="add_preparacion" id="add_preparacion" class="mas" onclick="pre()">+</button></td>  
                                    </tr>  
                                </table>  
                            </div>
                        </div>                
                    </div>
                    <div class="derecha">
                        <div class="row">
                            <div class="label">Nombre Receta: <br>
                                <input type="text" name="nombre" class="confondo" maxlength="29" style="text-transform: capitalize;" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="label">Descripcion: <br>
                                <input type="text" name="descripcion" class="confondo" maxlength="200">
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
                                <input type="number" min="0.00" step="1.00" class="numeros" required pattern="[0-9]+\\.[0-9]{2}" value="0.00" name="costo">
                            </div>
                        </div>
                        <div class="row">
                            <div class="label">Tiempo de preparacion: <input type="number" value="0" name="horas" min="0" step="1" class="numeros" required pattern="[0-9]+"> Hora(s) <input type="number" value="0" name="minutos" min="0" step="1" max="59" class="numeros" required pattern="[0-9]+"> Minutos.
                            </div>
                        </div>
                        <div class="row">
                            <div class="label">Calorias: 
                                <input type="number" name="calorias" min="0" class="numeros" pattern="[0-9]+" value="0">
                            </div>
                        </div>                    
                    </div>
                    <div class="row">
                        <button type="submit" name="submit">PUBLICAR</button>
                    </div>  
                </nav>
            </div>
        </form>

            
        
            <?php
                require("conexion.php");
                $persona=$_SESSION['id_usuario'];
                
                $query2="SELECT * FROM likes WHERE id_usuario= '$persona' ORDER BY id_receta DESC ";
                    $resultado2=mysqli_query($mysqli,$query2);
                    $likes = array(-2);
                    $cali = array(-2);
                    while ($row2=$resultado2->fetch_assoc()) {
                        array_push($cali,$row2['calificacion'] );
                        array_push($likes,$row2['id_receta'] );
                    }
                    
                    $query3="SELECT * FROM preferencias WHERE id_usuario = '$persona' ORDER BY id_receta DESC";
                    $resultado3=mysqli_query($mysqli,$query3);
                    $guardadas = array(-1);
                    while ($row3=$resultado3->fetch_assoc()) {
                        array_push($guardadas,$row3['id_receta'] );
                    }
                $query="SELECT * FROM recetas ORDER BY id_receta DESC";
                $resultado=mysqli_query($mysqli,$query);
                $gustar = array();
                $guar = array();
                $arrayM = array();
                while ($row=$resultado->fetch_assoc()) {
                    $name=$row['nombre_receta'];
                    $user=$row['id_usuario'];
                    $id_receta=$row['id_receta'];
                    array_push($arrayM,$id_receta );

                    if(array_search($id_receta, $likes) != null){
                        $clave = array_search($id_receta, $likes);
                        array_push($gustar,$cali[$clave] );
                    }else{
                        array_push($gustar,0);
                    }
                    
                    if(array_search($id_receta, $guardadas) != null){
                        $clave = array_search($id_receta, $guardadas);
                        array_push($guar,1 );          
                    }else{
                        array_push($guar,0);
                    }

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

                    /*echo "<a href='receta.php?receta=$id_receta' target='_blank'>";
                    
                    echo '<div class="grid-item">';
                    echo '<div class="receta_imagen"><img height="100%" width="100%" src="data:image/jpg;base64,'.base64_encode($row['imagen']).'"></div>
                            <div class="receta_titulo" style="color:#000;">'.$name.'</div>
                            <div class="receta_usuario"><img height="20" width="20" src="css/imagenes/user">'.$user.'</div>
                            <div class="receta_tipo">'.$type.'</div>
                            <div class="receta_calorias">'.$calor.'calorias</div>
                            <div class="receta_calificacion">Calificacion:'.$cal.'</div>
                            ';
                    echo "<br>";
                    
                    echo '</div></a>';
                    */
            ?>
                        
                        
                     
            <?php
                }
                //echo "</div>";
            ?>
            
            <div id="select2lista" class="grid-container"> </div>
            
        </center>

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
            if (history.forward(1)) {
                location.replace(history.forward(3));
            }
        </script>

        <script>  
            $(document).ready(function ing(){  
                var i=1;
                $('#add_ingrediente').click(function(){  
                    i++;  
                    $('#tabla_ingredientes').append('<tr id="linea'+i+'"><td><input type="text" name="ingredientes[]" placeholder="Agregar ingrediente..." class="name_list" style="text-transform: capitalize;" required></td><td><button type="button" name="remove ingrediente" id="'+i+'" class="btn_remove"> x </button></td></tr>');  
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

<script type="text/javascript">
$(document).ready(function () {
    var x = 0;
    x = $(window).width();
    x = (x / screen.width ) * 100;

        document.body.style.zoom = x + "%";

    $(window).resize(function (event) {
        x = $(window).width();
        x = (x / screen.width ) * 100;
        document.body.style.zoom = x + "%";
    });
});
</script>
<script>
    var arregloF =[];
    var estrella = <?php echo json_encode($gustar);?>;
    var guardadas = <?php echo json_encode($guar);?>;
    var arrayM = <?php echo json_encode($arrayM);?>;
     
            var train= [
                { input: { estrellas: 1,guardar: 1 }, output: { s: 0.42 } },
                { input: { estrellas: 1,guardar: 0 }, output: { s: 0.32 } },
                { input: { estrellas: 2,guardar: 1 }, output: { s: 0.47 } },
                { input: { estrellas: 2,guardar: 0 }, output: { s: 0.42 } },
                { input: { estrellas: 3,guardar: 1 }, output: { s: 0.62 } },
                { input: { estrellas: 3,guardar: 0 }, output: { s: 0.52 } },
                { input: { estrellas: 4,guardar: 1 }, output: { s: 0.82 } },
                { input: { estrellas: 4,guardar: 0 }, output: { s: 0.72 } },
                { input: { estrellas: 5,guardar: 1 }, output: { s: 1.02 } },
                { input: { estrellas: 5,guardar: 0 }, output: { s: 0.97 } },
                { input: { estrellas: 0,guardar: 1 }, output: { s: 0.22 } },
                { input: { estrellas: 0,guardar: 0 }, output: { s: 0.02 } },
                ];
            var net = new brain.NeuralNetwork();
            net.train( train );
            
            for (var i = 0; i < estrella.length; i+=1) {
        
        
          var t={
            estrellas: guardadas[i],
            guardar: estrella[i]
            };

            var result=net.run( t );
            var aux =JSON.stringify(result.s);
            arregloF.push(aux);
           //alert("recetas: "+arrayM[i]+ "estrellas "+estrella[i] + "guardadas: "+ guardadas[i] + "res"+ aux);
            }
            
            var n = arregloF.length;
            
            var inc = 1;

            while(n < inc ){
                inc = inc * 3 + 1;
            }
            
            while (inc > 0)
            {

                for (var i=inc; i < n; i++)
                {

                      var j = i;

                      var temp = arregloF[i];
                      
                      var temp2 = arrayM[i];
                      //alert(1);
                      while ((j >= inc) && (arregloF[j-inc] <  temp))
                      {
                          arregloF[j] = arregloF[j - inc];
                          arrayM[j] = arrayM[j - inc];
                          j = j - inc;
                      }
                      arregloF[j] = temp;
                      arrayM[j] = temp2;
                }
                inc/= 2;
                
            }

            


        $.ajax({
            type:"POST",  
            url:"inicioH.php",
            data: {valor: arregloF,noReceta: arrayM},
            success:function(r){
                $('#select2lista').html(r);
                }
            });
            

            
        </script>
        <script>
            $("#ejemplo").click(function(){
                $.notify("hola");
            });
        </script>

