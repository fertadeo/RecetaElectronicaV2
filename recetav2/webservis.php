<?php
$donde=$_POST['donde'];
include('conexion.php'); 

switch ($donde) {
    case 1:
        $dni=$_POST['nrodni'];
        $SQLpaciente = $conexionre->prepare("SELECT p.id,dni,p.apellido,p.nombre,p.sexo,p.talla,p.peso,p.email,p.telefono,p.idobrasocial,p.nromatriculadoc,o.sigla FROM rec_paciente AS p INNER JOIN rec_obrasoc AS o ON o.id = p.idobrasocial WHERE p.dni = $dni ");
        $SQLpaciente->execute();
        $listaPacientes=$SQLpaciente->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($listaPacientes,JSON_UNESCAPED_UNICODE).' ';
    break;
    case 2:
        $dni=$_POST['nrodni'];
        $SQLpaciente = $conexionre->prepare("SELECT r.idreceta, r.fechaemision, tp.apellido, tp.nombre, r.diagnostico FROM `rec_receta` AS r INNER JOIN rec_paciente AS p ON p.id = r.idpaciente INNER JOIN tmp_person AS tp ON tp.matricula = r.matricprescr WHERE p.dni = $dni ORDER BY r.fechaemision DESC;");
        $SQLpaciente->execute();
        $listaPacientes=$SQLpaciente->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($listaPacientes,JSON_UNESCAPED_UNICODE).' ';
    break;
    case 3:
        $receta=$_POST['nroreceta'];
        //echo "rec ".$receta;
        //exit;
        $SQLpaciente = $conexionre->prepare("SELECT p.cantprescripta, p.posologia, v.monodroga, v.nombre_comercial, v.presentacion, v.laboratorio, p.dispensado FROM `rec_prescrmedicamento` AS p  INNER JOIN vademecum AS v ON v.codigo = p.codigo WHERE idreceta = $receta ORDER BY nro_orden");
        $SQLpaciente->execute();
        $listaPacientes=$SQLpaciente->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($listaPacientes,JSON_UNESCAPED_UNICODE).' ';
    break;
}        


    
?>