<?PHP

//$conexion= mysqli_connect("181.10.152.66","4utogestion","3NJYDsZ78aJdqSys","bd_cmpc");
$conexion= mysqli_connect("181.13.90.212","consejomedico","1234","bd_cmpc");
/* verificar la conexión */
if (mysqli_connect_errno()) {
		echo '<!DOCTYPE html>
<html>
<head><meta charset="gb18030">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
	<title>Autogestion CMPC</title>
</head>
<body style="background-color:#579bcc;color:#579bcc;">
	<br>
	<center><img src="mantenimiento2019.jpg" width="300px"></center>
</body>
</html>';
    die('Error de conexion: ' . mysqli_connect_error());
    exit();
}



?>