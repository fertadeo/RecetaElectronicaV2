<?php

// Create a cURL handle
$ch = curl_init();


$body = '{
"idReceta": 4922,
"renglon": 1,
"ip": "162.158.1.253",
"codigo_dispensado": 2546589,
"cantidad_dispensada": 2,
"farmacia": "23654789878",
"sucursal": "5"
}';



curl_setopt($ch, CURLOPT_URL, "https://3.224.240.107:4000/api/receta");
//curl_setopt($ch, CURLOPT_POST, TRUE);
//curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
//curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);


// Execute
$respuesta = curl_exec($ch);
echo curl_getinfo($ch, CURLINFO_HTTP_CODE);
// Check HTTP status code
if (!curl_errno($ch)) {
  switch ($http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE)) {
    case 200:  # OK
      break;
    default:
      echo 'Unexpected HTTP code: ', $http_code, "\n";
  }
}
print_r("respuesta: ".$respuesta);
// Close handle
curl_close($ch);

/*
$ch = curl_init(); // Ini
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "Content-Type:application/json"
));

$body = '{
  "idReceta": 25,
  "renglon": 1,
  "ip": "162.158.1.253",
  "codigo_dispensado": 2546589,
  "cantidad_dispensada": 2,
  "farmacia": "23654789878",
  "sucursal": "5"
}';



curl_setopt($ch, CURLOPT_URL, "https://3.224.240.107:4000/api/receta");
curl_setopt($ch, CURLOPT_POST, TRUE);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$respuesta = curl_exec($ch); // Respuesta
echo curl_getinfo($ch, CURLINFO_HTTP_CODE);

//$statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

curl_close($ch); // Cierro el CURL
$row=json_decode($respuesta);

print_r("respuesta: ".$respuesta);
*/
?>