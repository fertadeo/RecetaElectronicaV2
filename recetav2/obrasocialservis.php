<?php
header('Access-Control-Allow-Origin: *');
include('conexion.php'); 
$sentenciaSQLos = $conexionre->prepare("SELECT * FROM rec_obrasoc ORDER BY sigla ASC");
$sentenciaSQLos->execute();
$listaObraSociales=$sentenciaSQLos->fetchAll(PDO::FETCH_ASSOC);
$array = "";
foreach($listaObraSociales as $obraSocial){ 
    //echo $obraSocial["id"]. strtoupper($obraSocial["sigla"]);
    
    $array.= '{"id":'.$obraSocial["id"].',"sigla":"'.strtoupper($obraSocial["sigla"]).'","descri":"'.utf8_encode($obraSocial["descripcion"]).'"},';

    
    
}
$arrayf = trim($array, ',');
$jason = "[".$arrayf."]";
echo $jason;
    exit();
//echo json_encode($listaObraSociales, JSON_UNESCAPED_UNICODE), "\n";
?>