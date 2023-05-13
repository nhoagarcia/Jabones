<?php

session_start();
if (isset($_SESSION['sesion']) && $_SESSION['sesion'] === true) {
    header("Location: ./productos.php");
}


if(isset($_POST['usuario']) && isset($_POST['contrasena'])){
    $validousuario=false;
    $validopassword=false;

    if(!empty($_POST['usuario'] && !empty($_POST['contrasena']))){
        $usuario = $_POST['usuario'];
        $password = $_POST['contrasena'];
        
        $config = parse_ini_file("sesiones.ini");
        $con = new mysqli($config['host'], $config['username'], $config['password'], $config['dbname']);

        // COMPROBAMOS QUE NO SE DEVUELVE NINGÚN ERROR
        if($con->connect_error){
            echo "No se ha podido conectar con la base de datos... $con->connect_errno";
            die();
        }

        $query = "SELECT usuario, password FROM usuarios WHERE usuario LIKE '$usuario'";

        if($resu=$con->query($query)){
            if($fila=$resu->fetch_row()){
                $userDB = $fila[0];
                $passDB = $fila[1];

                if($usuario === $userDB && password_verify($password,$passDB)){
                    $_SESSION['sesion'] = true;    
                    $_SESSION['usuario'] = $usuario;                  // guardo ID recuperarlo después  
                    header("Location: ./bien.php");
                } else {
                    header("Location: ./error.php?mensaje=Usuario/Contraseña Incorrecta");
                }
            } else {
                header("Location: ./error.php?mensaje=Usuario/Contraseña Incorrecta");
            }
        } 

        $resu->close();
        $con->close();
    }
}
?>