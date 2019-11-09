<?php
    session_start();
    if (@!$_SESSION['id_usuario'] || @!$_SESSION['correo']) {
        header("location:index.php");
    }
    
    require("conexion.php");

        $arregloF=$_POST['valor'];
        $likes=$_POST['noReceta'];
        $us = $_SESSION['id_usuario'];
        $query="SELECT * FROM recetas where id_usuario = '$us' ";
        $resultado=mysqli_query($mysqli,$query);
        while ($row=$resultado->fetch_assoc()) {
            $id_receta=$row["id_receta"];
            for ($i=0; $i < count($likes); $i++){ 
                if($likes[$i] == $id_receta){
                    $likes[$i] = -2;
                }
            }
        }
        
        for ($i=0; $i < count($likes); $i++){ 
        $query="SELECT * FROM recetas where id_receta = $likes[$i] ";
        $resultado=mysqli_query($mysqli,$query);
        while ($row=$resultado->fetch_assoc()) {
            if($arregloF[$i] == 0){
                $name=$row['nombre_receta'];
            $user=$row['id_usuario'];
            $id_receta=$row["id_receta"];
            $calor=$row['calorias'];
            $cal=$row['calificacion'];
            $persona=$row['persona'];
            if($persona == 0){
                $cal = 0;
            }else{
                $cal = $cal / $persona;
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
                    
                    
                    echo "<a href='receta.php?receta=$id_receta' target='_blank'>";
                    echo '<div class="grid-item">';
                    echo '<div class="receta_imagen"><img height="100%" width="100%" src="data:image/jpg;base64,'.base64_encode($row['imagen']).'"></div>
                            <div class="receta_titulo" style="color:#000;">'.$name.'</div>
                            <div class="receta_usuario"><img height="20" width="20" src="css/imagenes/user">'.$user.'</div>
                            <div class="receta_tipo">'.$type.'</div>
                            <div class="receta_calorias">'.$calor.' calorias</div>
                            <div class="receta_calificacion">Calificacion: '.round($cal, 1).'</div>
                            ';
                    echo "<br>";
                    echo '</div></a>';
            }
            
        }
    }
    

?>