<?php

$body = '{
    "idReceta": 2874,
    "renglon": 2,
    "ip": "162.158.1.253",
    "codigo_dispensado": 4887933,
    "cantidad_dispensada": 2,
    "farmacia": "23654789878",
    "sucursal": "7"
  }';

$ch = curl_init(); // Ini
curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:application/json"));
curl_setopt($ch, CURLOPT_URL, "https://3.224.240.107:4000/api/receta");
curl_setopt($ch, CURLOPT_POST, TRUE);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($body));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//
//curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json')); 
$respuesta = curl_exec($ch); // Respuesta
curl_close($ch); // Cierro el CURL
$row=json_decode($respuesta);

print_r($respuesta);


?>