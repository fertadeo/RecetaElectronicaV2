<?php
include('conexion.php');
if($_POST["accion"] === 'addpaciente'){
  $apellido    = $_POST["apel"];
  $nombre      = $_POST["nom"];
  $dni         = $_POST["dni"];
  $talla       = $_POST["talla"];
  $peso        = $_POST["peso"];
  $telefono    = $_POST["tel"];
  $email       = $_POST["mail"];
  $sexo        = $_POST["sex"];
  $idobra      = $_POST["obra"];
  $nroafiliado = $_POST["nroafi"];

  $sql="insert into rec_paciente(dni,apellido,nombre,sexo,talla,peso,email,telefono,idobrasocial,nromatriculadoc) 
  values(:dni,:apellido,:nombre,:sexo,:talla,:peso,:email,:telefono,:idobrasocial,:nromatriculadoc)";
  
  $sql = $conexionre->prepare($sql);

  $sql->bindParam(':apellido',$apellido,PDO::PARAM_STR);
  $sql->bindParam(':nombre',$nombre,PDO::PARAM_STR);
  $sql->bindParam(':dni',$dni,PDO::PARAM_STR);
  $sql->bindParam(':talla',$talla,PDO::PARAM_STR);
  $sql->bindParam(':peso',$peso,PDO::PARAM_STR);
  $sql->bindParam(':telefono',$telefono,PDO::PARAM_STR);
  $sql->bindParam(':email',$email,PDO::PARAM_STR);
  $sql->bindParam(':sexo',$sexo,PDO::PARAM_STR);
  $sql->bindParam(':idobrasocial',$idobra,PDO::PARAM_STR);
  $sql->bindParam(':nromatriculadoc',$nroafiliado,PDO::PARAM_STR);

  $sql->execute();
  
  $lastInsertId = $conexionre->lastInsertId("id");
   if($lastInsertId>0){
        $idpaciente = $lastInsertId; 
        guardarPacObra($idpaciente);
        echo $idpaciente;
        //echo "S";
    }else{
        echo "N";
        //print_r($sql->errorInfo()); 
    }
}

function guardarPacObra($idpaciente){
    include('conexion.php');
    $idpaciente    = $idpaciente;
    $idobrasoc     = $_POST["obra"];
    $nroafiliado   = $_POST["nroafi"];
    $fecharegistro = date("Y-m-d H:i:s");
    $ipregistro    = $_SERVER['REMOTE_ADDR'];
    
    
    $sqlO="insert into rec_pacienteobrasoc(idpaciente,idobrasoc,nroafiliado,fecharegistro,ipregistro) 
    values(:idpaciente,:idobrasoc,:nroafiliado,:fecharegistro,:ipregistro)";
    
    $sqlO = $conexionre->prepare($sqlO);
  
    $sqlO->bindParam(':idpaciente',$idpaciente,PDO::PARAM_STR);
    $sqlO->bindParam(':idobrasoc',$idobrasoc,PDO::PARAM_STR);
    $sqlO->bindParam(':nroafiliado',$nroafiliado,PDO::PARAM_STR);
    $sqlO->bindParam(':fecharegistro',$fecharegistro,PDO::PARAM_STR);
    $sqlO->bindParam(':ipregistro',$ipregistro,PDO::PARAM_STR);
    
    $sqlO->execute();
    
    $lastInsertIdO = $conexionre->lastInsertId();
     if($lastInsertIdO>0){
           //echo "S";
      }else{
          echo "N";
          //print_r($sql->errorInfo()); 
      }

      return;
      exit;  
 }

 if($_POST["accion"] == 'Uppaciente'){
    $etiqueta = trim($_POST["etiqueta"]);
    $data     = trim($_POST["data"]);
    $id       = trim($_POST["id"]);
    switch ($etiqueta) {
        case "talla":
            $consulta = "UPDATE rec_paciente SET talla = :talla  WHERE id = :id";  
            $sql = $conexionre->prepare($consulta);
            $sql->bindParam(':talla',$data,PDO::PARAM_INT);  
            $sql->bindParam(':id',$id,PDO::PARAM_INT);            
            break;
        case "peso":
            $consulta = "UPDATE rec_paciente SET peso = :peso  WHERE id = :id";  
            $sql = $conexionre->prepare($consulta);
            $sql->bindParam(':peso',$data,PDO::PARAM_INT);  
            $sql->bindParam(':id',$id,PDO::PARAM_INT); 
            break;
        case "obrasocial":
            $consulta = "UPDATE rec_paciente SET idobrasocial = :idobrasocial  WHERE id = :id";  
            $sql = $conexionre->prepare($consulta);
            $sql->bindParam(':idobrasocial',$data,PDO::PARAM_INT);  
            $sql->bindParam(':id',$id,PDO::PARAM_INT);
            break;
        case "nroobrasocial":
            $consulta = "UPDATE rec_paciente SET nromatriculadoc = :nromatriculadoc  WHERE id = :id";  
            $sql = $conexionre->prepare($consulta);
            $sql->bindParam(':nromatriculadoc',$data,PDO::PARAM_STR);  
            $sql->bindParam(':id',$id,PDO::PARAM_INT);
            break;    
        case "bono":
            $consulta = "UPDATE rec_paciente SET peso = :peso  WHERE id = :id";  //a implementar v2.1
            $sql = $conexionre->prepare($consulta);
            $sql->bindParam(':peso',$data,PDO::PARAM_INT);  
            $sql->bindParam(':id',$id,PDO::PARAM_INT);
            break;    
        case "nrobono":
            $consulta = "UPDATE rec_paciente SET peso = :peso  WHERE id = :id"; //a implementar v2.1  
            $sql = $conexionre->prepare($consulta);
            $sql->bindParam(':peso',$data,PDO::PARAM_INT);  
            $sql->bindParam(':id',$id,PDO::PARAM_INT);
            break;     
        case "nrocelular":
            $consulta = "UPDATE rec_paciente SET telefono = :telefono  WHERE id = :id";  
            $sql = $conexionre->prepare($consulta);
            $sql->bindParam(':telefono',$data,PDO::PARAM_INT);  
            $sql->bindParam(':id',$id,PDO::PARAM_INT);
            break;           
        case "email":
            $consulta = "UPDATE rec_paciente SET email = :email  WHERE id = :id";  
            $sql = $conexionre->prepare($consulta);
            $sql->bindParam(':email',$data,PDO::PARAM_STR);  
            $sql->bindParam(':id',$id,PDO::PARAM_INT);
            break;               
    }
    $sql->execute();
    
    if($sql->rowCount() > 0){
    $count = $sql -> rowCount();
        echo "S";
    }
    else{
        echo "N";
        print_r($sql->errorInfo()); 
    }

}   


/* ** dejado en la v2.0 
if($_POST["accion"] == 'Uppaciente'){

$talla       = trim($_POST["talla"]);
$peso        = trim($_POST["peso"]);
$telefono    = trim($_POST["tel"]);
$email       = trim($_POST["mail"]);
$idobra      = trim($_POST["obra"]);
$nroafiliado = trim($_POST["nroafi"]);
$id          = trim($_POST["idpac"]);   

$consulta = "UPDATE rec_paciente SET talla = :talla, peso = :peso, email = :email, telefono = :telefono,  idobrasocial = :idobrasocial, nromatriculadoc = :nromatriculadoc  WHERE id = :id";
    $sql = $conexionre->prepare($consulta);
    
    $sql->bindParam(':talla',$talla,PDO::PARAM_INT);
    $sql->bindParam(':peso',$peso,PDO::PARAM_INT);
    $sql->bindParam(':email',$email,PDO::PARAM_STR);
    $sql->bindParam(':telefono',$telefono,PDO::PARAM_STR);
    $sql->bindParam(':idobrasocial',$idobra,PDO::PARAM_STR);
    $sql->bindParam(':nromatriculadoc',$nroafiliado,PDO::PARAM_STR);
    $sql->bindParam(':id',$id,PDO::PARAM_INT);
    $sql->execute();
    
    if($sql->rowCount() > 0){
    $count = $sql -> rowCount();
        echo "S";
    }
    else{
        echo "N";
        print_r($sql->errorInfo()); 
    }


}
*/
?>

