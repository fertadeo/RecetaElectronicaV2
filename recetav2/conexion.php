<?php
/*
$host="localhost";
$db="recetav2";
$usuario="testcmpc";
$contrasenia="AWDpassword";


$host="localhost";
$db="rxcmpcorg_test";
$usuario="rxcmpcorg_test";
$contrasenia="5(^N5xR{Pyc7";
*/
$host="localhost";
$db="receta";
$usuario="root";
$contrasenia="";

try {
    $conexionre=new PDO("mysql:host=$host;dbname=$db",$usuario,$contrasenia);
    if($conexionre){// echo "conectado...";
    }
} catch (exception $ex) {
    echo $ex->getMessage();
}

?>