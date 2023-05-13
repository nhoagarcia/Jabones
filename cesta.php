<?php
session_start();
if (isset($_SESSION['autentificado']) && $_SESSION['autentificado'] === true) {
include 'funcion.php';
include 'header.php';


if(isset($_GET['add'])) {
    $comprobar="SELECT * FROM cesta WHERE email LIKE '".$_SESSION['mail']."'";
    $resul=mysql('mysql:host=localhost;dbname=jabones', 'root', '', $comprobar);
    if(!$resul){
      $insertar="INSERT INTO cesta VALUES ('', '".$_SESSION['mail']."', '')";
      mysql('mysql:host=localhost;dbname=jabones', 'root', '', $insertar);
    }
    $comprobar="SELECT cestaID FROM cesta WHERE email LIKE '".$_SESSION['mail']."'";
    $insert=mysql('mysql:host=localhost;dbname=jabones', 'root', '', $comprobar);
    $cestaID=$insert[0]['cestaID'];
    $cantidad="SELECT cantidad FROM itemcesta WHERE productoID LIKE '".$_GET['add']."'";
    $cant=mysql('mysql:host=localhost;dbname=jabones', 'root', '', $cantidad);
    if(!$cant){
        $cant=1;
      }else{
    $cant=$cant[0]['cantidad']+1;
      }
    if($cant>2){
        echo "<div class='error'>No puedes pedir más de dos productos </div>";
    }else{
        $insertaritems="UPDATE itemcesta SET cantidad=$cant WHERE cestaID LIKE '".$cestaID."' AND productoID LIKE '".$_GET['add']."'";
        $update=mysql('mysql:host=localhost;dbname=jabones', 'root', '', $insertaritems);
    }

  }



  // Eliminar un producto del carrito
  if(isset($_GET['remove'])) {
    $comprobar="SELECT * FROM cesta WHERE email LIKE '".$_SESSION['mail']."'";
    $resul=mysql('mysql:host=localhost;dbname=jabones', 'root', '', $comprobar);
    if(!$resul){
      $borrar="DELETE FROM cesta WHERE email LIKE '".$_SESSION['mail']."' ";
      mysql('mysql:host=localhost;dbname=jabones', 'root', '', $borrar);
    }
    $comprobar="SELECT cestaID FROM cesta WHERE email LIKE '".$_SESSION['mail']."'";
    $del=mysql('mysql:host=localhost;dbname=jabones', 'root', '', $comprobar);
    $cestaID=$del[0]['cestaID'];
    $cantidad="SELECT cantidad FROM itemcesta WHERE productoID LIKE '".$_GET['remove']."'";
    $cant=mysql('mysql:host=localhost;dbname=jabones', 'root', '', $cantidad);
    if(!$cant){
      $cant=0;
    }else{
      $cant=$cant[0]['cantidad']-1;
    }
    //var_dump($cestaID);
    if($cant==0){
        $borrar="DELETE FROM itemcesta WHERE cestaID LIKE '".$cestaID."' AND productoID LIKE '".$_GET['remove']."' ";
        mysql('mysql:host=localhost;dbname=jabones', 'root', '', $borrar);
    }else{
    $borraritems="UPDATE itemcesta SET cantidad=$cant WHERE cestaID LIKE '".$cestaID."' AND productoID LIKE '".$_GET['remove']."'";
    $update=mysql('mysql:host=localhost;dbname=jabones', 'root', '', $borraritems);
    }
  }


  if(isset($_GET['pedido'])) {
    $comprobar="SELECT * FROM cesta WHERE email LIKE '".$_SESSION['mail']."'";
    $resul=mysql('mysql:host=localhost;dbname=jabones', 'root', '', $comprobar);

    $comprobar="SELECT cestaID FROM cesta WHERE email LIKE '".$_SESSION['mail']."'";
    $insert=mysql('mysql:host=localhost;dbname=jabones', 'root', '', $comprobar);
    $cestaID=$insert[0]['cestaID'];

    $cantidad="SELECT SUM(precio) FROM productos WHERE productoID IN (SELECT productoID FROM itemcesta WHERE cestaID IN (SELECT cestaID from cesta WHERE email LIKE '".$_SESSION['mail']."'))";
    $cant=mysql('mysql:host=localhost;dbname=jabones', 'root', '', $cantidad);
    $precio=$cant[0]['SUM(precio)'];
/*
    $today = new DateTime('now');
    $month_ago = new DateTime('now');
    $month_ago->modify('-30 days');
    $today_formatted = $today->format('Y-m-d');
    $month = $month_ago->format('Y-m-d');*/


    $comprobacion="SELECT count(email) FROM pedidos WHERE email LIKE '".$_SESSION['mail']."'";
    $comp=mysql('mysql:host=localhost;dbname=jabones', 'root', '', $comprobacion);
    if($comp[0]['count(email)']>2){
      echo'no puedes hacer más pedidos este mes';
    }else{
      $insertarpedido="INSERT INTO pedidos VALUES ('', '".$_SESSION['mail']."', DATE_FORMAT(CURDATE(),'%Y-%m-%d'), DATE_FORMAT(DATE_ADD(CURDATE(), INTERVAL 5 DAY), '%Y-%m-%d'), '".$precio."', 'no entregado')";
      $pedido=mysql('mysql:host=localhost;dbname=jabones', 'root', '', $insertarpedido);
      echo'pedido realizado';
    }
    }


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