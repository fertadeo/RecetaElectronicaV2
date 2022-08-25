<?php
include('conexion.php'); 
$matricula = '181572'; //$_SESSION['matricula'];

$stmt = $conexionre->query("SELECT c.apellido, c.nombre, c.matricula, b.denominacion, a.matricula_especialista, a.fecha_especialista ,a.fecha_vencimiento,a.libro_tomo, a.libro_folio, a.cantidad_renovacion FROM tmp_especialistas as a, tmp_especialidades as b, tmp_person as c WHERE a.especialidad=b.especialidad AND a.matricula=c.matricula AND a.matricula = $matricula AND a.tipo_especialidad=1 AND STR_TO_DATE(a.fecha_vencimiento, '%d/%m/%Y') > CURDATE()");

echo '<form method="get" action="" ><select class="form-select" aria-label="Default select example" name="especialidad" id="especialidad" required >';
   echo '<option value="0">Seleccionar especialidad</option>';
   echo '<option value="99999">SIN ESPECIALIDAD</option>';

while ($row = $stmt->fetch()) {
      //echo '<input id="apelnom" type="hidden" value="'.$row['nombre'].'- -'.$row['apellido'].'">';
      echo '<option value="'.$row['matricula_especialista'].'">'.$row['denominacion'].'</option>';
}
echo '</select>';

//echo '<input id="apelnom" type="hidden" value="'.$row['nombre'].'- -'.$row['apellido'].'">';
echo '</form>';
//exit;
?>