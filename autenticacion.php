<?php //crea la variable de sesión de usuario autentcado para consultarla después
 session_start();
 if (!isset($_SESSION["autentficado"])){

 if (isset($_POST["email"]) && isset($_POST["contrasena"])){
    if ($_POST["email"]=="$email" && $_POST["contrasena"]=="$contrasena"){
        $_SESSION["autentficado"]="SI";
        header("Location: productos.php");
    }
    else // Credenciales erróneas
    echo'
        <html>
            <head>
                <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400;1,500&family=Poppins:ital,wght@0,100;0,200;0,400;0,500;1,300;1,600&display=swap" rel="stylesheet">
                <style>
                *{
                    font-family: "Poppins", sans-serif;
                    font-weight: 400;
                }
                .contenido{
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    flex-direction: column;
                }
                h3{
                    padding: 10px;
                    color: rgb(0, 119, 134);
                    margin:auto;
                }
                form{
                    border-radius: 15px;
                    box-shadow: #32325d40 0px 6px 12px -2px, #0000004d 0px 3px 7px -3px;
                    padding: 30px 50px;
                    width: 30%;
                    font-size: 18px;
                    margin: 20px;
                }
                input{
                    margin: 15px;
                }
                label{
                    margin: 15px;
                }
                button{
                margin: 10px;
                background-color: white;
                color: black;
                padding: 10px 25px;
                border: none;
                border-radius: 15px;
                box-shadow: #32325d40 0px 6px 12px -2px, #0000004d 0px 3px 7px -3px;
                cursor: pointer;
                transition: 300ms;
                }
                button:hover{
                    transition: 300ms;
                    background-color: rgb(0, 119, 134);
                    color: white;
                    transform: scale(1.05);
        
                    }
                p{
                    padding: 10px;
                    color: red;
                    margin:auto;
                }
                </style>
            </head>
            <body>
            <div class="contenido">
                <form action="autenticacion.php" method="post">
                <h3>Inicio de Sesión</h3>
                <label>Nombre</label>
                <input type="text" name="usuario"></input><br>
                <label>Contraseña</label>
                <input type="password" name="contrasena"></input><br>
                <p>Datos Incorrectos</p>
                <button type="submit">Enviar</button>
                </form>
            </div>
            </body>
        </html>
    ';
 }
 else //No ha rellenado el formulario de autentcación
    header("Location: ./jabonescarlatti.php.html");
}
 else // Ya está acreditado y no ha cerrado la sesión aún
    header("Location: ./productos.php");
?>