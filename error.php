<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error</title>
    <link rel="stylesheet" href="./estilos.css">
</head>
<body>

    
<?php 
    if(isset($_GET["mensaje"])){
        echo "<p>".$_GET["mensaje"]."</p>";
    } else {
        echo "<p>Ha ocurrido un error, por favor. Vuelva al Login.</p>";
    }
?>
    <a href="./login.php">Volver a Login</a>

</body>
</html>