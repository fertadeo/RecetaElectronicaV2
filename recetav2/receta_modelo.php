<?php
include('conexion.php'); 
require_once 'phpqrcode/qrlib.php';

$idreceta = $_GET["id"];
$nomespecial = $_GET["especial"];

$slpreceta = $conexionre->prepare("SELECT r.fechaemision, r.matricprescr, r.matricespec_prescr, r.diagnostico, p.dni, p.apellido, p.nombre, p.email, o.sigla, p.nromatriculadoc, pp.apellido AS medape, pp.nombre AS mednom FROM rec_receta AS r INNER JOIN rec_paciente AS p ON r.idpaciente = p.id INNER JOIN rec_pacienteobrasoc AS po ON po.idpaciente = p.id INNER JOIN rec_obrasoc AS o ON o.id = po.idobrasoc INNER JOIN tmp_person AS pp ON pp.matricula = r.matricprescr WHERE idreceta = :idreceta");


$slpreceta->bindValue(':idreceta', $idreceta, PDO::PARAM_STR);
$slpreceta->execute();
$receta = $slpreceta->fetch();

$originalDate = $receta["fechaemision"];
//original date is in format YYYY-mm-dd
$DateTime = DateTime::createFromFormat('Y-m-d H:i:s', $originalDate);
$fechadeEmision = $DateTime->format('d-m-Y');
$fechaVence = date("d-m-Y",strtotime($fechadeEmision."+ 30 days"));


//$fechadeEmision = $receta["fechaemision"];
$apellido = $receta["apellido"];
$nombre = $receta["nombre"];
$dni = $receta["dni"];
$obrasocial = $receta["sigla"];
$nromatricula = $receta["nromatriculadoc"];
$diagnostico = $receta["diagnostico"];
$matricula = $receta["matricprescr"];
$matriculaEsp = $receta["matricespec_prescr"];
$email = $receta["email"];
$mednom = trim($receta["mednom"]);
$mednom = ucwords(strtolower($mednom));
$medape = trim($receta["medape"]);
$medape = ucwords(strtolower($medape));

if($matriculaEsp == 0 or $matriculaEsp == 99999){
  $htmlespecialidad = "";
}else{
  $htmlespecialidad = "ME. ".$matriculaEsp." ".$nomespecial;
}

// desde sql $firma = '<img src = "data:image/png;base64,' . base64_encode($receta['firma']) . '" width = "120px" />';


$SQLremedios = $conexionre->prepare("SELECT nro_orden, cantprescripta, posologia, monodroga, nombre_comercial, presentacion FROM rec_prescrmedicamento p INNER JOIN rec_vademecum v ON p.codigo = v.codigo WHERE idreceta = $idreceta");
$SQLremedios->execute();
$listaremedios=$SQLremedios->fetchAll(PDO::FETCH_ASSOC);
$htmlTr = "";
foreach($listaremedios as $remedio){

$htmlTr.= '<tr><td>'.$remedio["nro_orden"].'</td><td>'.$remedio["monodroga"].'</td><td>'.$remedio["nombre_comercial"].'</td><td>'.$remedio["presentacion"].'</td><td>'.$remedio["posologia"].'</td>     <td>'.$remedio["cantprescripta"].'</td></tr>';


};
// ruta guardar pdf
//Donde guardar el documento
$rutaGuardado = "tmp/";
//Nombre del Documento.
$nombreArchivo = $idreceta.".pdf";
// Crear QR y su ruta url

$url= "https://rx.cmpc.org.ar/tmp/".$nombreArchivo;
QRcode::png(
  $url        //Contenido
  ,"example1.png" // Nombre del archivo
  ,QR_ECLEVEL_Q   // Indice de corrección de errores
                  //  L = 7%
                  //  M = 15%
                  //  Q = 25%
                  //  H = 30%
  ,15              // Tamaño en pixeles de cada cuadro que conforma el QR
  ,2              // Margen en unidades "Tamaño".
);

//Recuperar firma oracle ----------------
/*
include('conexion_oracle2.php');
$cadena = substr($matricula, 0, -1);
$sql = "SELECT prf.prf_firma, p.per_numero FROM personas p, afiliados a, personas_registro_firmas prf WHERE a.per_numero = p.per_numero AND p.per_foto IS NOT NULL AND prf.prf_per_numero = p.per_numero AND prf.prf_es_para_credencial = 'S' AND substr(a.afi_codigo, 1, length(a.afi_codigo) - 2) = $cadena";

$campo = oci_parse($conn, $sql);
oci_execute($campo);
//echo "paso"; 
$row = oci_fetch_array($campo, OCI_ASSOC+OCI_RETURN_NULLS);
if (!$row) {
    header('Status: 404 Not Found');
} else {
    $img = $row['PRF_FIRMA']->load();
    header("Content-type: image/jpeg");
    $firma = '<img src="data:image/jpeg;base64,'.base64_encode($img).'" width = "120px"/>';
    
}

// End recuperar firma oracle
//include_once "./vendor/autoload.php";
*/
require_once "dompdf/autoload.inc.php";

use Dompdf\Dompdf;

$dompdf = new Dompdf();
ob_start();
//include "recetabody.php";
//$html = ob_get_clean();
//---------
$html="";
$html.='<table width="100%">
  <thead>
    <tr>
      <th colspan="6"><font size="1.2em">Receta Electrónica</font></th>
    </tr> 
  </thead>
  <tbody>
   <tr>
      <td colspan="6" width="100%"><hr style="border: 1px solid #000;" /></td>
    </tr>  
    <tr>
      <td colspan="2" width="25%"><img src="img/logo_cm.png" width="250px"></td>
      <td colspan="2" width="50%"><h2>Nro: 00000'.$idreceta.'</h2></td>
      <td colspan="2" width="25%"><h2>Fecha:' .$fechadeEmision.'</h2></td>
    </tr>
    <tr>
      <td colspan="6" width="100%"><hr style="border: 1px solid #CCC;" /></td>
    </tr> 
    <tr>
      <td colspan="3" width="40%"><font size="1.2em">Paciente</font></td>
      <td colspan="3" width="60%"><font size="1.2em">Obra Social</font></td>
    </tr>  
    <tr>
      <td colspan="3" width="40%"><font size="1em"><b>'.$apellido.' '.$nombre.'</b> - DNI: '.$dni.'</font></td>
      
      <td colspan="3" width="60%"><font size="1em">'.$obrasocial.' - Nro: '.$nromatricula.'</font></td>
    </tr>
        <tr>
      <td colspan="6" width="100%"><hr style="border: 1px solid #CCC;" /></td>
    </tr> 
    <tr>
      <td colspan="6" width="100%"><font size="1.2em">Prescripción</font></td>
    </tr> 
    </tbody>
    </table>
    <table width="100%" border="1" cellspacing="0" bordercolor="ccc" cellpadding="2">
    <tr>
      <td colspan="1" width="3%"><b>Nro</b></td>
      <td colspan="1" width="20%"><b>Monodroga</b></td>
      <td colspan="1" width="30%"><b>Sugerida</b></td>
      <td colspan="1" width="20%"><b>Presentación</b></td>
      <td colspan="1" width="20%"><b>Dosis por día</b></td>
      <td colspan="1" width="3%"><b>Cant</b></td>
    </tr>'
    .$htmlTr.
    '</table>
    <table width="100%" cellpadding="2">
    <tr>
      <td colspan="6" width="100%"><font size="1.2em">Diagnóstico</font></td>
    </tr>
    <tr>
      <td colspan="2" width="50%" valign="top" style="border: 1px solid #ccc;">'.$diagnostico.'</td>  
      <td colspan="2" width="10%" align="center"><img src="example1.png" width="150px" /></td>
      <td colspan="2" width="40%" align="center"><br>'.$mednom.' '.$medape.'<br>MP. '.$matricula.'<br>'.$htmlespecialidad.'</td>
    </tr>
    <tr>
      <td colspan="6" width="100%"><hr style="border: 1px solid #CCC;" /></td>
    </tr> 
    <tr>
      <td colspan="6" width="100%">Vence el día: '.$fechaVence.'</font></td>
    </tr>
    </table>';
//--
$html = "<h1>hola</h1>";
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'landscape');

$dompdf->render();

$pdf = $dompdf -> output();
$output = $dompdf->output();
file_put_contents( $rutaGuardado.$nombreArchivo, $pdf);
//file_put_contents("tmp/archivo.pdf", $pdf);

header("Content-type: application/pdf");
header("Content-Disposition: inline; filename=documento.pdf");

echo $dompdf->output();

// *************************envio por email
/*
require "phpmailer/class.phpmailer.php";
require "phpmailer/class.smtp.php";

//armado html para Email
$htmlmail="";
$htmlmail.='<table width="100%">
  <thead>
    <tr>
      <th colspan="6"><font size="1.2em">Receta Electrónica</font></th>
    </tr> 
  </thead>
  <tbody>
   <tr>
      <td colspan="6" width="100%"><hr style="border: 1px solid #000;" /></td>
    </tr>  
    <tr>
      <td colspan="2" width="25%"><img src="https://autogestion.cmpc.org.ar/appreceta/img/logo_cm.png" width="250px"></td>
      <td colspan="2" width="50%"><h2>Nro: 00000'.$idreceta.'</h2></td>
      <td colspan="2" width="25%"><h2>Fecha:' .$fechadeEmision.'</h2></td>
    </tr>
    <tr>
      <td colspan="6" width="100%"><hr style="border: 1px solid #CCC;" /></td>
    </tr> 
    <tr>
      <td colspan="3" width="40%"><font size="1.2em">Paciente</font></td>
      <td colspan="3" width="60%"><font size="1.2em">Obra Social</font></td>
    </tr>  
    <tr>
      <td colspan="3" width="40%"><font size="1em"><b>'.$apellido.' '.$nombre.'</b> - DNI: '.$dni.'</font></td>
      
      <td colspan="3" width="60%"><font size="1em">'.$obrasocial.' - Nro: '.$nromatricula.'</font></td>
    </tr>
        <tr>
      <td colspan="6" width="100%"><hr style="border: 1px solid #CCC;" /></td>
    </tr> 
    <tr>
      <td colspan="6" width="100%"><font size="1.2em">Prescripción</font></td>
    </tr> 
    </tbody>
    </table>
    <table width="100%" border="1" cellspacing="0" bordercolor="ccc" cellpadding="2">
    <tr>
      <td colspan="1" width="3%"><b>Nro</b></td>
      <td colspan="1" width="20%"><b>Monodroga</b></td>
      <td colspan="1" width="30%"><b>Sugerida</b></td>
      <td colspan="1" width="20%"><b>Presentación</b></td>
      <td colspan="1" width="20%"><b>Dosis por día</b></td>
      <td colspan="1" width="3%"><b>Cant</b></td>
    </tr>'
    .$htmlTr.
    '</table>
    <table width="100%" cellpadding="2">
    <tr>
      <td colspan="6" width="100%"><font size="1.2em">Diagnóstico</font></td>
    </tr>
    <tr>
      <td colspan="2" width="50%" valign="top" style="border: 1px solid #ccc;">'.$diagnostico.'</td>  
      <td colspan="2" width="10%" align="center"></td>
      <td colspan="2" width="40%" align="center">'.$firma.'<br>'.$mednom.' '.$medape.'<br>MP. '.$matricula.'<br>'.$htmlespecialidad.'</td>
    </tr>
    <tr>
      <td colspan="6" width="100%"><hr style="border: 1px solid #CCC;" /></td>
    </tr> 
    <tr>
      <td colspan="6" width="100%">Vence el día: '.$fechaVence.'</font></td>
    </tr>
    </table>';

$mail = new phpmailer();
$mail->CharSet = 'UTF-8';
$mail->PluginDir = "phpmailer/";
$mail->IsHTML(true);
$mail->Mailer = "smtp";
$mail->Host = "localhost";
$mail->SMTPAuth = true;
$mail->Username = "noresponder@cmpc.org.ar"; 
$mail->Password = "Nicolas2017";
$mail->From = "noresponder@cmpc.org.ar";
$mail->FromName = "Receta electronica";
$mail->Timeout=30;
$mail->AddAddress("$email");
//$mail->AddBCC("cmpc.utnfrvm.congreso.salud@gmail.com");
$mail->Subject = "Receta";
$mail->Body = "<p>$htmlmail</p>";
$mail->AltBody = $body_text;
$mail->Send();
 */     