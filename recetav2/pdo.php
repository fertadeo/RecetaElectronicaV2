<?php
include('conexion.php'); 
//ejemplo una fila

$stmt = $conexionre->query("SELECT * FROM rec_paciente ORDER BY id DESC LIMIT 1");
$user = $stmt->fetch();
print_r($user);
echo "<br>";
echo $user[1];
echo "<br>";
echo $user['dni'];
echo "<br>";
echo "<br>";

//ejemplo varias filas y con condicional
$stmt1 = $conexionre->query("SELECT c.apellido, c.nombre, c.matricula, b.denominacion, a.matricula_especialista, a.fecha_especialista ,a.fecha_vencimiento,a.libro_tomo, a.libro_folio, a.cantidad_renovacion FROM tmp_especialistas as a, tmp_especialidades as b, tmp_person as c WHERE a.especialidad=b.especialidad AND a.matricula=c.matricula AND a.matricula = '181572' AND a.tipo_especialidad=1 AND STR_TO_DATE(a.fecha_vencimiento, '%d/%m/%Y') > CURDATE()");

while ($row = $stmt1->fetch()) {
    echo $row['denominacion']."<br />\n";
}


?>