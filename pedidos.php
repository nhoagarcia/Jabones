<?php
session_start();
if (isset($_SESSION['autentificado']) && ($_SESSION['autentificado']==true) && (isset($_SESSION['rol'])) && ($_SESSION['rol']=='admin')) {

include 'funcion.php';
include 'header.php';
$query = "SELECT * FROM pedidos";
$pedidos = mysql("mysql:host=127.0.0.1;dbname=jabones", "root", "", $query);
echo '<div class="box">';
foreach($pedidos as $pedido){
    echo '
    <table class="pedidos">
    <tr>
        <td class="id" id="'.$pedido['pedidoID'].'">
        <td class="">'.$pedido['email'].'</td>
        <td class="description">'.$pedido['fechaPedido'].'</td>
        <td class="description">'.$pedido['fechaEntrega'].'</td>
        <td class="description">'.$pedido['totalPedido'].' €</td>
        <td class="description">'.$pedido['entregado'].'</td>
    </tr>
    </table>
    <div class="buttons">
    <button><a href="./pedidos.php?delete='.$pedido['pedidoID'].'" class="borrar">Borrar Pedido</a></button>
    </div>';
}
echo '</div>';


if(isset($_GET['delete'])) {
    $cantidad="SELECT pedidoID FROM pedidos WHERE email LIKE '".$_SESSION['mail']."'";
    $cant=mysql('mysql:host=localhost;dbname=jabones', 'root', '', $cantidad);
    //var_dump($cestaID);
    $borrarproducts="DELETE FROM pedidos WHERE email LIKE '".$_SESSION['mail']."' ";
    mysql('mysql:host=localhost;dbname=jabones', 'root', '', $borrarproducts);
  }
}else{
    header("Location: ./jabonescarlatti.php");
}
?>