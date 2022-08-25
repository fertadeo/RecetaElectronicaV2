<?php
//include('conexion.php');
require_once 'conexion.php';
$fechaemision       = date("Y-m-d H:i:s");
$ipprescriptor      = "127.0.0.0"; //$_SERVER['REMOTE_ADDR'];
$matricprescr       = trim($_POST["matricprescr"]);
$matricespec_prescr = trim($_POST["matricespec_prescr"]);
$idpaciente         = trim($_POST["idpaciente"]);
$idobrasocafiliado  = trim($_POST["idobrasocafiliado"]);
$diagnostico	    = trim($_POST["diagnostico"]);

echo $fechaemision;
echo " - ";
echo $ipprescriptor;
echo " - ";
echo $matricprescr;
echo " - ";
echo $matricespec_prescr;
echo " - ";
echo $idpaciente;
echo " - ";
echo $idobrasocafiliado;
echo " - ";
echo $diagnostico;
//exit;

// insert en tabla rec_receta
$sql="INSERT INTO rec_receta(fechaemision,ipprescriptor,matricprescr,matricespec_prescr,idpaciente,idobrasocafiliado,diagnostico) VALUES(:fechaemision,:ipprescriptor,:matricprescr,:matricespec_prescr,:idpaciente,:idobrasocafiliado,:diagnostico)";

 
  $sql = $conexionre->prepare($sql);

  $sql->bindParam(':fechaemision',$fechaemision,PDO::PARAM_STR);
  $sql->bindParam(':ipprescriptor',$ipprescriptor,PDO::PARAM_STR);
  $sql->bindParam(':matricprescr',$matricprescr,PDO::PARAM_INT);
  $sql->bindParam(':matricespec_prescr',$matricespec_prescr,PDO::PARAM_INT);
  $sql->bindParam(':idpaciente',$idpaciente,PDO::PARAM_INT);
  $sql->bindParam(':idobrasocafiliado',$idobrasocafiliado,PDO::PARAM_INT);
  $sql->bindParam(':diagnostico',$diagnostico,PDO::PARAM_STR);
  
  $sql->execute();

  $lastInsertId = $conexionre->lastInsertId("idreceta");
  if($lastInsertId>0){
        //echo $lastInsertId; // es nro y guarda el idreceta
        $idReceta = $lastInsertId;
        //guardar los medicamentos 
        agregarremedios($idReceta);
        echo $idReceta;
    }else{
        echo "N"; // Regresa a Index con mensaje de error
    //print_r($sql->errorInfo()); 
    }

function agregarremedios($id){
    // si ok insert en tabla rec_prescrmedicamento
    include('conexion.php');
    $remedios = $_POST["remedios"]; // Json
    $idreceta = $id;
    $idmedicamento = "0";
    $cant = 1;
    $array = json_decode($remedios, true);
        
    foreach ($array as $value) {
        
        //echo $idreceta;  
        $nro_orden = $cant;
        $codigo = $value["r"]; 
        $cantprescripta = $value["c"];   
        $posologia = $value["p"];  
        $cant++; 
        
        $sql1="insert into rec_prescrmedicamento(idreceta,nro_orden,idmedicamento,codigo,cantprescripta,posologia	) 
        values(:idreceta,:nro_orden,:idmedicamento,:codigo,:cantprescripta,:posologia)";
        
        $sql1 = $conexionre->prepare($sql1);
      
        $sql1->bindParam(':idreceta',$idreceta,PDO::PARAM_STR);
        $sql1->bindParam(':nro_orden',$nro_orden,PDO::PARAM_STR);
        $sql1->bindParam(':idmedicamento',$idmedicamento,PDO::PARAM_STR);
        $sql1->bindParam(':codigo',$codigo,PDO::PARAM_STR);
        $sql1->bindParam(':cantprescripta',$cantprescripta,PDO::PARAM_STR);
        $sql1->bindParam(':posologia',$posologia,PDO::PARAM_STR);
  
        $sql1->execute();
        $lastInsertId = $conexionre->lastInsertId();
        if($lastInsertId>0){
             //echo "S"; //reresa a index para habilitar botones imprimir enviar por email
         }else{
             echo "N";// regresa con error
             print_r($sql1->errorInfo()); 
         } 
   };
 
return;
};


// *!


    
    
/*
    $lastInsertId = $conexionre->lastInsertId();
     if($lastInsertId>0){
          echo "S"; //reresa a index para habilitar botones imprimir enviar por email
      }else{
          echo "N";// regresa con error
          //print_r($sql->errorInfo()); 
      }  */
?>