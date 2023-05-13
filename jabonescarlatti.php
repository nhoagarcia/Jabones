<?php
session_start();
if (isset($_SESSION['autentificado']) && $_SESSION['autentificado'] === true) {
    header("Location: ./productos.php");
}
include 'funcion.php';
include 'header.php';
if(isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['contrasena']) && !empty($_POST['contrasena'])){
    $email = $_POST['email'];
    $contrasena = $_POST['contrasena'];
    $query = "SELECT * FROM clientes WHERE email LIKE '$email' AND contrasena LIKE '$contrasena'";
    $clientes = mysql("mysql:host=127.0.0.1;dbname=jabones", "root", "", $query);
    if($clientes){
        $_SESSION['autentificado']=true;
        if($clientes[0]['rol']=='admin'){
            $_SESSION['rol']='admin';
        }else{
            $_SESSION['rol']='usuario';
        }
        $_SESSION['mail']=$email;
        header('Location: ./productos.php');
    }else{
        echo'
        <html>
        <head>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400;1,500&family=Poppins:ital,wght@0,100;0,200;0,400;0,500;1,300;1,600&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="./styles.css">
        </head>
        <body>
        <div class="contenido">
            <form action="jabonescarlatti.php" method="post">
            <h3>Inicio de Sesión</h3>
            <label>Correo</label>
            <input type="text" name="email"></input><br>
            <label>Contraseña</label>
            <input type="password" name="contrasena"></input><br>
            <button type="submit">Enviar</button>
            <p>¿Aún no tienes cuenta? <a href="registro.php">Registrarse</a>
            <p class="error"> Datos incorrectos </p>
            </form>
        </div>
        </body>
    </html>
';
    }

}else{
    echo'
    <html>
        <head>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400;1,500&family=Poppins:ital,wght@0,100;0,200;0,400;0,500;1,300;1,600&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="./styles.css">
        </head>
        <body>
        <div class="contenido">
            <form action="jabonescarlatti.php" method="post">
            <h3>Inicio de Sesión</h3>
            <label>Correo</label>
            <input type="text" name="email"></input><br>
            <label>Contraseña</label>
            <input type="password" name="contrasena"></input><br>
            <button type="submit">Enviar</button>
            <p>¿Aún no tienes cuenta? <a href="registro.php">Registrarse</a>
            </form>
        </div>
        </body>
    </html>
';
}




?>