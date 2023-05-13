<?php

include './header.php';
if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['contrasena'])){
    $validoname=false;
    $validoemail=false;
    $validocontrasena=false;

    if(!empty($_POST['name'])){
        $name=$_POST['name'];
        $validoname=true;
    }
    if(!empty($_POST['email'])){
        $email=$_POST['email'];
        $validoemail=true;
    }
    if(!empty($_POST['contrasena'])){
        $contrasena=$_POST['contrasena'];
        $validocontrasena=true;
    }
        if($validoname==true && $validoemail==true && $validocontrasena==true){
            try {
                $pdo = new PDO("mysql:host=localhost; dbname=jabones", "root", "");
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
                $stmt = $pdo->prepare("INSERT INTO clientes(nombre, email, contrasena) VALUES('$name', '$email', '$contrasena')");
                $stmt->execute();
            
                echo "Registro creado exitosamente";
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
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
                <form action="registro.php" method="POST">
                <h3>Registro</h3>
                    <label for="name">Nombre: </label>
                    <input type="text" name="name"> 
                    </br></br>
                    <label for="email">Correo: </label>
                    <input type="mail" name="email"> 
                    </br></br>
                    <label for="contrasena">Contraseña: </label>
                    <input type="password" name="contrasena"> 
                    </br></br>
                    <button type=submit>Registrar</button>
                    <a href="./jabonescarlatti.php">Volver al Login</a>
                    <p class="error">Rellene el formulario</p>
                </form>
                </div>
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
    <form action="registro.php" method="POST">
    <h3>Registro</h3>
        <label>Nombre: </label>
        <input type="text" name="name"> 
        </br></br>
        <label for="email">Correo: </label>
        <input type="mail" name="email"> 
        </br></br>
        <label>Contraseña: </label>
        <input type="password" name="contrasena"> 
        </br></br>
        <button type=submit>Registrar</button>
        <a href="./jabonescarlatti.php">Volver al Login</a>
    </form>
    <br><br>

    
    </body>
    </html>';
}


?>