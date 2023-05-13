<?php
session_start();
include './funcion.php';
include './header.php';
if (isset($_SESSION['autentificado']) && ($_SESSION['autentificado']==true) && (isset($_SESSION['rol'])) && ($_SESSION['rol']=='admin')) {

    if(isset($_POST['name']) && isset($_POST['precio'])){
        $validoname=false;
        $validoprecio=false;
        $validodescripcion=false;
        $validopeso=false;
    
        if(!empty($_POST['name'])){
            $name=$_POST['name'];
            $validoname=true;
        }
        if(!empty($_POST['precio'])){
            $precio=$_POST['precio'];
            $validoprecio=true;
        }
        if(!empty($_POST['descripcion'])){
            $descripcion=$_POST['descripcion'];
            $validodescripcion=true;
        }
        if(!empty($_POST['peso'])){
            $peso=$_POST['peso'];
            $validopeso=true;
        }
        
            if($validoname==true && $validoprecio==true && $validodescripcion==true && $validopeso==true){
                if (is_uploaded_file ($_FILES['imagen']['tmp_name'] )){
                    $nombreDirectorio = "./imagenes/";
                    $nombreFichero = $_FILES['imagen']['name'];
                    $nombreCompleto = $nombreDirectorio.$nombreFichero;
                    if (is_dir($nombreDirectorio)){ // es un directorio existente
                        $idUnico = time();
                        $nombreFichero = $idUnico."-".$nombreFichero;
                        $nombreCompleto = $nombreDirectorio.$nombreFichero;
                        move_uploaded_file ($_FILES['imagen']['tmp_name'],$nombreCompleto);
                        echo "Fichero subido con el nombre: $nombreFichero<br>";
                    }
                    else {
                        echo "Directorio definitivo inválido";
                    }
        
        
                } else {
                    print ("No se ha podido subir el fichero\n");
                }
                $query = "INSERT INTO productos VALUES('','".$name."', '".$descripcion."', '".$peso."', '".$precio."', '".$nombreFichero."')";
                mysql("mysql:host=127.0.0.1;dbname=jabones", "root", "", $query);
                echo '<div class="box">';
                    echo 'producto subido';
                echo '</div>';

            }else{
                echo'
                <!DOCTYPE html>
                <html>
                <head>
                <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400;1,500&family=Poppins:ital,wght@0,100;0,200;0,400;0,500;1,300;1,600&display=swap" rel="stylesheet">
                <link rel="stylesheet" href="./styles.css">
                </head>
                <body>
                <div class="contenido">
                <form action="subirproducto.php" method="POST" enctype="multipart/form-data">
                <h3>Registro</h3>
                    <label>Nombre: </label>
                    <input type="text" name="name"> 
                    </br></br>
                    <label>Descripcion: </label>
                    <input type="text" name="descripcion"> 
                    </br></br>
                    <label>Peso: </label>
                    <input type="text" name="peso"> 
                    </br></br>
                    <label>Precio: </label>
                    <input type="text" name="precio"> 
                    </br></br>
                    <label>Imagen: </label>
                    <input type="file" name="imagen">
                    <p class="error"> Rellena todos los campos</p>
                    </br></br>
                    <button type="submit">Subir producto</button>
                    <a href="./jabonescarlatti.php">Volver al Login</a>
                </form>
                <br><br>
                </body>
                </html>';
            }


    }else{
        echo'
        <!DOCTYPE html>
        <html>
        <head>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400;1,500&family=Poppins:ital,wght@0,100;0,200;0,400;0,500;1,300;1,600&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="./styles.css">
        </head>
        <body>
        <div class="contenido">
        <form action="subirproducto.php" method="POST" enctype="multipart/form-data">
        <h3>Registro</h3>
            <label>Nombre: </label>
            <input type="text" name="name"> 
            </br></br>
            <label>Descripcion: </label>
            <input type="text" name="descripcion"> 
            </br></br>
            <label>Peso: </label>
            <input type="text" name="peso"> 
            </br></br>
            <label>Precio: </label>
            <input type="text" name="precio"> 
            </br></br>
            <label>Imagen: </label>
            <input type="file" name="imagen">
            </br></br>
            <button type="submit">Subir producto</button>
            <a href="./jabonescarlatti.php">Volver al Login</a>
        </form>
        <br><br>
        </body>
        </html>';
    }
}else{
    header('Location: ./productos.php');
}

?>