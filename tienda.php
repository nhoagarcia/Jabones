<?php
session_start();
if (isset($_SESSION['autentificado']) && $_SESSION['autentificado'] === true) {
include 'funcion.php';
include 'header.php';


//////////////////////////////////////////////////////
$db = new PDO('mysql:host=localhost;dbname=jabones', 'root', '');

// Verificar si el carrito está vacío y crear uno nuevo si es necesario
if(empty($_SESSION['cart'])) {
  $_SESSION['cart'] = array();
}

// Añadir un producto al carrito
if(isset($_GET['add'])) {
  $comprobar="SELECT * FROM cesta WHERE email LIKE '".$_SESSION['mail']."'";
  $resul=mysql('mysql:host=localhost;dbname=jabones', 'root', '', $comprobar);
  if(!$resul){
    $insertar="INSERT INTO cesta VALUES ('', '".$_SESSION['mail']."', '')";
    mysql('mysql:host=localhost;dbname=jabones', 'root', '', $insertar);
  }
  /*$limitacion="SELECT cestaID from itemcesta WHERE cestaID IN (SELECT cestaID from cesta WHERE email IN (SELECT email FROM pedidos WHERE fechaPedido BETWEEN CURDATE() - INTERVAL 30 DAY AND CURDATE()";
  $fecha=mysql('mysql:host=localhost;dbname=jabones', 'root', '', $limitacion);
  if($limitacion){
    echo "<div class='error'>No puedes añadir más de dos productos</div>";
  }*/
  $comprobar="SELECT cestaID FROM cesta WHERE email LIKE '".$_SESSION['mail']."'";
  $insert=mysql('mysql:host=localhost;dbname=jabones', 'root', '', $comprobar);
  $cestaID=$insert[0]['cestaID'];
  $cantidad="SELECT cantidad FROM itemcesta WHERE productoID LIKE '".$_GET['add']."'";
  $cant=mysql('mysql:host=localhost;dbname=jabones', 'root', '', $cantidad);
  if(!$cant){
    $cant=1;
  }else{
    $cant=$cant[0]['cantidad']++;
  }
  //var_dump($cestaID);
  $insertaritems="INSERT INTO itemcesta VALUES ('', '".$cestaID."', '".$_GET['add']."', '".$cant."')";
  mysql('mysql:host=localhost;dbname=jabones', 'root', '', $insertaritems);
}


// Eliminar un producto
if(isset($_GET['remove'])) {
  $cantidad="SELECT cantidad FROM itemcesta WHERE productoID LIKE '".$_GET['remove']."'";
  $cant=mysql('mysql:host=localhost;dbname=jabones', 'root', '', $cantidad);
  if(!$cant){
    $cant=0;
  }else{
    $cant=$cant[0]['cantidad']--;
  }
  //var_dump($cestaID);
  $borrarproducts="DELETE FROM productos WHERE productoID LIKE '".$_GET['remove']."' ";
  mysql('mysql:host=localhost;dbname=jabones', 'root', '', $borrarproducts);
}

// Mostrar los productos en el carrito
//$query = $db->prepare("SELECT * FROM productos WHERE productID IN (".implode(',', $_SESSION['cart']).")");
if(isset($_SESSION['mail'])){
  $mostrar=("SELECT * FROM productos WHERE productoID IN (SELECT productoID FROM itemcesta WHERE cestaID IN (SELECT cestaID FROM cesta WHERE email LIKE '".$_SESSION['mail']."'))");
  $ver=mysql('mysql:host=localhost;dbname=jabones', 'root', '', $mostrar);
  foreach($ver as $prod){
    echo '
    <div class="itemcesta">
      <img src="./imagenes/'.$prod['imagen'].'" alt="">
        <p class="id" id="'.$prod['productoID'].'">
        <p class="">'.$prod['nombre'].'</p>
        <p class="description">'.$prod['precio'].'€</span></p>';
        
        if (isset($_SESSION['autentificado']) && $_SESSION['autentificado']==true){
            echo'<div class="buttons">';
            echo'<button><a href="./cesta.php?remove='.$prod['productoID'].'" class="borrar">Menos</a></button>';
            $cantidad=("SELECT cantidad FROM itemcesta");
            $cant=mysql('mysql:host=localhost;dbname=jabones', 'root', '', $cantidad);
            $cant=$cant[0]['cantidad'];
            echo"$cant";
            echo'<button><a href="./cesta.php?add='.$prod['productoID'].'" class="carrito">Más</a></button>
        </div>';
        }
    echo'</div>';
  }

  
  echo'<button><a href="./cesta.php?pedido='.$prod['productoID'].'" class="carrito">Hacer pedido</a></button></div>';

}


}else{
    header("Location: ./jabonescarlatti.php");
}

?>