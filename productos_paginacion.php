<?php

include './funcion.php';
include './header.php';
session_start();
/*$query = "SELECT * FROM productos";
$productos = mysql("mysql:host=127.0.0.1;dbname=jabones", "root", "", $query);
echo '<div class="box">';
foreach($productos as $jabon){
    echo '
    <div class="jabon">
        <p class="id" id="'.$jabon['productoID'].'">
        <h2 class="title">'.$jabon['nombre'].'</h2>
        <p class="description">'.$jabon['descripcion'].' '.$jabon['peso'].'Gr <span class="precio">'.$jabon['precio'].'€</span></p>
        <img src="./imagenes/'.$jabon['imagen'].'" alt="">';
        if (isset($_SESSION['autentificado']) && $_SESSION['autentificado']==true){
            echo'<div class="buttons">';
            if(isset($_SESSION['rol']) && $_SESSION['rol']=='admin') {
                echo'<button><a href="./tienda.php?remove='.$jabon['productoID'].'" class="borrar">Borrar Producto</a></button>';
            }
            echo'<button><a href="./tienda.php?add='.$jabon['productoID'].'" class="carrito">Añadir al Carrito</a></button>
        </div>';
        }
    echo'</div>';
}
echo '</div>';

*/
// Conexión a la base de datos

$pdo = new PDO("mysql:host=127.0.0.1;dbname=jabones", "root", "");

// Consulta para obtener el total de resultados
$stmt = $pdo->prepare("SELECT * FROM productos");
$stmt->execute();
$total_results = $stmt->rowCount();

// Cálculo del número de páginas necesarias
$tamano_paginas=3;
$total_paginas=ceil($total_results/$tamano_paginas);

// Página actual
        if(isset($_GET["pagina"])){
            if($_GET["pagina"]==1){
                header("Location:productos.php");
            }else{
                $pagina=$_GET["pagina"];
            }
        }else{
            $pagina=1;
        }

// Límites para la consulta
$start_limit = ($pagina-1)*$tamano_paginas;;

// Consulta para seleccionar los resultados actuales
$stmt = $pdo->prepare("SELECT * FROM productos LIMIT :start, :results");
$stmt->bindParam(":start", $start_limit, PDO::PARAM_INT);
$stmt->bindParam(":results", $tamano_paginas, PDO::PARAM_INT);
$stmt->execute();
$results = $stmt->fetchAll();
echo '<div class="box">';
// Mostrar resultados
foreach($results as $jabon){
    echo '

    <div class="jabon">
        <p class="id" id="'.$jabon['productoID'].'">
        <h2 class="title">'.$jabon['nombre'].'</h2>
        <p class="description">'.$jabon['descripcion'].' '.$jabon['peso'].'Gr <span class="precio">'.$jabon['precio'].'€</span></p>
        <img src="./imagenes/'.$jabon['imagen'].'" alt="">
        <div class="buttons">
            <button><a href="./tienda.php?delete='.$jabon['productoID'].'" class="borrar">Borrar Producto</a></button>
            <button><a href="./tienda.php?anadir='.$jabon['productoID'].'" class="carrito">Añadir al Carrito</a></button>
        </div>
    </div>';
}
echo '</div>';
echo '</div>';

// Mostrar barra de navegación
echo "<div class='buttons'>";
for($i=1; $i<=$total_paginas; $i++){
    echo"<button><a href='?pagina=".$i."'>" .$i. "</a></button>";
}
echo "</div>";
?>


