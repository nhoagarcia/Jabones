<?php
/*** PDO ***/
//$cadenaDSN = "gestorDB:host=descrip_host;dbname=nombreDB";
//$cadenaDSN = "mysql:host=127.0.0.1;dbname=jabones";
//$usuario = "web";
//$password = "Clave2DAW";

/*
$con->errorInfo()
$con->errorCode()
$con->setAttribute()
*/

function mysql($cadenaDSN,$usuario,$password,$query){
    try{
        $con = new PDO($cadenaDSN,$usuario,$password);
        $con -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $con->prepare($query);
        $stmt -> execute();
        $resul = array();

        while($fila = $stmt -> fetch(PDO::FETCH_ASSOC)){
            array_push($resul, $fila);
        }

        return $resul;
    } catch(PDOException $e) {
        echo $e -> getMessage();
    }
}

?>