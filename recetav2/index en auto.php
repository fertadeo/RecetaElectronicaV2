<?php
session_start();
if($_SESSION["logueado"]=='1'){}else{ 
header("Location:index.php");
}
//$cliente=$_SESSION["cliente"];
include('../conexion2.php'); //Incluye el archivo de conexion 
include('conexion3.php'); //server ovh
$valorerror = 0;

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <meta name="keywords" content="">
  <meta name="description" content="">
  <meta name="author" content="tracking">
  <link rel="shortcut icon" href="#" type="image/png">
  <title>CMPC - Autogestion</title>
  <!--icheck-->
  <link href="../js/iCheck/skins/minimal/minimal.css" rel="stylesheet">
  <link href="../js/iCheck/skins/square/square.css" rel="stylesheet">
  <link href="../js/iCheck/skins/square/red.css" rel="stylesheet">
  <link href="../js/iCheck/skins/square/blue.css" rel="stylesheet">
  <!--dashboard calendar-->
  <link href="../css/clndr.css" rel="stylesheet">
  <!--Morris Chart CSS -->
  <link rel="stylesheet" href="../js/morris-chart/morris.css">
  <!--common-->
  <link href="../css/style.css" rel="stylesheet">
  <link href="../css/style-responsive.css" rel="stylesheet">
   
  <link href="https://unpkg.com/vanilla-datatables@latest/dist/vanilla-dataTables.min.css" rel="stylesheet" type="text/css">
  <script src="https://unpkg.com/vanilla-datatables@latest/dist/vanilla-dataTables.min.js" type="text/javascript"></script>
</head>

<body class="sticky-header">
<?PHP
include('menu.php'); //Incluye el archivo del menu
?>
<div class="main-content" >
    <div class="header-section">
        <a class="toggle-btn"><i class="fa fa-bars"></i></a>
        <?php
        include('menu-notificaciones.php');
        ?>
    </div>

    <div class="page-heading"><h3>Receta Electrónica</h3></div>
<div class="wrapper">
    <div clas="row">
           <!-- <div class="col-md-12">  -->
  
 <!-- ESPECIALIDAD ---> 
 <div clas="row">
    <div class="col-md-12">  
        <section class="panel">
            <header class="panel-heading"> Seleccione el tipo de especialidad: </header>
            <div class="panel-body">
            <div class="mb-3">
            <div class="col-md-4">
            <?PHP
                        $matricula=$_SESSION['matricula'];
                        echo '<form method="get" action="" ><select class="form-control" name="especialidad" id="especialidad" required >';
                        $lista =("SELECT c.apellido, c.nombre, c.matricula, b.denominacion, a.matricula_especialista, a.fecha_especialista ,a.fecha_vencimiento,a.libro_tomo, a.libro_folio, a.cantidad_renovacion FROM tmp_especialistas as a, tmp_especialidades as b, tmp_person as c WHERE a.especialidad=b.especialidad AND a.matricula=c.matricula AND a.matricula='$matricula' AND a.tipo_especialidad=1 AND STR_TO_DATE(a.fecha_vencimiento, '%d/%m/%Y') > CURDATE()");
                        //$lista =("SELECT * FROM(SELECT c.apellido, c.nombre, c.matricula, a.especialidad, b.denominacion, a.matricula_especialista, a.fecha_especialista ,a.fecha_vencimiento,a.libro_tomo, a.libro_folio, a.cantidad_renovacion FROM tmp_especialistas as a, tmp_especialidades as b, tmp_person as c WHERE a.especialidad=b.especialidad AND a.matricula=c.matricula AND a.matricula=$matricula AND a.tipo_especialidad=1 AND STR_TO_DATE(a.fecha_vencimiento, '%d/%m/%Y') > CURDATE()) AS aa WHERE aa.especialidad=69 OR aa.especialidad=30");
                        $rs = mysqli_query($conexion,$lista);
                        echo '<option value="0">Seleccionar especialidad</option>';
                        echo '<option value="99999">Sin especialidad</option>';
                        while ($row = mysqli_fetch_array($rs)) {
                        echo '<option value="'.$row['matricula_especialista'].'">'.$row['denominacion'].'</option>';
                        }
                        echo '</select>';
                        echo '<input id="apelnom" type="hidden" value="'.$row['nombre'].'- -'.$row['apellido'].'">';
                        echo '</form>';
                        ?>  
            </div>
            <div class="col-md-4"></div>
            <div class="col-md-4"></div>  
          </div>
            </div>
        </section>
    </div>
 </div>
<!-- End especialidad -->    
<?php
$sentenciaSQLos = $conexionre->prepare("SELECT * FROM rec_obrasoc ORDER BY sigla ASC");
$sentenciaSQLos->execute();
$listaObraSociales=$sentenciaSQLos->fetchAll(PDO::FETCH_ASSOC);

$obrasoH = '<br><select class="form-control" name="inputObraSocial" aria-label=".form-select-lg example"><option selected>Selecionar Obra Social</option> ';
$obraso = "";
$obrasoF = '</selectd>';
  foreach($listaObraSociales as $obraSocial){ 
      $obraso.= '<option value="'. $obraSocial["id"].'">'. strtoupper($obraSocial["sigla"]).'</option>';
 }
$todo = $obrasoH.$obraso.$obrasoF;
?>
<!-- ***** --->
<!-- PACIENTE star -->
<div clas="row">
      <div class="col-md-12">  
          <section class="panel">
              <header class="panel-heading"> Paciente: </header>
              <div class="panel-body">
              <div class="mb-3">
                <form action="" data-toggle="validator" id="frm_paciente">  
                                       
                    <!--<div class="col-md-4" form-group><input class="form-control" maxlength="8" type="text" value="" id="buscardni" name="buscardni" placeholder="Buscar DNI" aria-label="Buscar por DNI paciente" required>-->
                    <div class="col-md-4" form-group><input class="form-control" maxlength="8" type="number" inputmode="numeric" value="" id="buscardni" name="buscardni" placeholder="Buscar DNI" aria-label="Buscar por DNI paciente" required oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                    </div>          
                    <div class="col-md-4">
                    <button type="button" type="button" onclick="buscarDni();" class="btn btn-light btn-sm" >Buscar</button>
                    </div>
                    <div class="col-md-4">
                    <div id="mostrarNoexiste"> </div>
                    </div>
                </form>
              <!--</div> -->

              <!--<div class="mb-3">               
                <div class="row">-->
                  <div id="mostrarPaciente"></div>
<!-- -->
                    <div class="row" id="cargapaciente" style="display:none">
                      <div class="row"> 
                        <div class="col-md-6"><p></p></div>
                        <div class="col-md-6"><p></p></div>
                      </div>
                      <div class="row"> 
                        <div class="col-md-6"></div>
                        <div class="col-md-6"></div>
                      </div>
                      <div class="row"> 
                        <div class="col-md-6"></div>
                        <div class="col-md-6"></div>
                      </div>  
                      <div class="row" style="padding:20px;"> 
                          <input id="id_Pac" type="hidden" value="0">
                          <div class="col-md-3"><label>Apellido:</label> <input type="text" class="form-control" id="inputApellido" placeholder="En caso de mujer Apellido de soltera" required></div>
                          <div class="col-md-3"><b>Nombre:</b> <input type="text" class="form-control" id="inputNombre" placeholder="Nombre" required></div>
                          <div class="col-md-3"><b>Sexo:</b>
                            <div class="radio">
                              <label>
                                <input type="radio" name="inputSexo" value="F" required>
                                Femenino
                              </label>
                            </div>
                            <div class="radio">
                              <label>
                                <input type="radio" name="inputSexo" value="M" required>
                                Masculino
                              </label>
                            </div>
                            <div class="radio">
                              <label>
                                <input type="radio" name="inputSexo" value="O" required>
                                Otro
                              </label>
                            </div>
                          </div>
                      </div>
                      <div class="row" style="padding:20px;">
                        <div class="col-md-3"><b>Talla:</b> <input type="number" class="form-control" id="inputTalla" placeholder="Medida en centimetros" required></div>
                        <div class="col-md-3"><b>Peso:</b> <input type="number" class="form-control" id="inputPeso" placeholder="Medida en kg" required></div>
                        <div class="col-md-3"><b>Teléfono:</b> <input type="number" class="form-control" id="inputTelefono" placeholder="nro."></div>
                        <div class="col-md-3"></div>
                      </div>
  <div class="row" style="padding:20px;">
    <div class="col-md-3"><b>Email:</b> <input type="email" class="form-control" id="inputEmail" placeholder="Email" data-error="Bruh, that email address is invalid" required></div>
    <div class="col-md-3"><b>Obra Social:</b> 
      <?php
    $sentenciaSQLos = $conexionre->prepare("SELECT * FROM rec_obrasoc ORDER BY sigla ASC");
    $sentenciaSQLos->execute();
    $listaObraSociales=$sentenciaSQLos->fetchAll(PDO::FETCH_ASSOC);
    ?>
    <select class="form-control" name="inputObraSocial" aria-label=".form-select-lg example">
      <option selected>Selecionar Obra Social</option>
      <?php foreach($listaObraSociales as $obraSocial){  ?>
      <option value="<?php echo $obraSocial["id"]; ?>"><?php echo strtoupper($obraSocial["sigla"]); ?></option>
      <?php } ?>
    </select>
    </div>
      <div class="col-md-3"><b>Nro Afiliado:</b> <input type="text" class="form-control" id="inputNroAfi" placeholder="Nro. Afiliado" required></div>
      <div class="col-md-3"><br><button type="button" onclick="agregarPaciente()" class="btn btn-default">Guardar</button>  </div>
      </div>
      </div>
</div>
<!-- 
</div>
</div>-->
                        </div>
                        </div>
                    </section>
                </div>
</div>
<!-- Paciente end -->            
<!-- *** -->        
<!-- DIAGNOSTICO Star -->
<div clas="row">
    <div class="col-md-12">  
        <section class="panel">
            <header class="panel-heading"> Diagnóstico: </header>
            <div class="panel-body">
              <div class="mb-3">
                <div class="col-md-12"><textarea class="form-control" id="texDiagnostico" rows="3"></textarea></div>  
                
              </div>
            </div>
        </section>
    </div>
</div>
<!-- Diagnostico end -->

<!-- PRESCRIPCION Star --->   
<?php
$SQLprescripcion = $conexionre->prepare("SELECT * FROM rec_vademecum");
$SQLprescripcion->execute();
$listaRemedios=$SQLprescripcion->fetchAll(PDO::FETCH_ASSOC);
?>          
 <div clas="row">
                <div class="col-md-12">  
                    <section class="panel">
                    <header class="panel-heading"> Prescripción: </header>
                    <div class="panel-body">
                    <div class="mb-3">
                      <div class="col-md-12">
                      <button class="btn btn-outline-success" id="bto_vademecum" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                      Vademécum
                      </button>                  
                      </div>
                    <br>
                      <div class="collapse" id="collapseExample">
                    <div class="panel-body">
                    <div class="table-responsive">
                        <table cclass="table" id="tablaPaciente" class="display" style="width:100%">
                        <thead>
                            <tr>
                            <th scope="col">Monodroga</th>
                            <th scope="col">Sugerido</th>
                            <th scope="col">Presentación</th>
                            <th scope="col">Laboratorio</th>
                            <th scope="col">Selecionar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($listaRemedios as $remedio){  ?>
                            <tr>
                            <th scope="row" id="monodroga_<?php echo $remedio["id"]; ?>"><?php echo $remedio["monodroga"]; ?></th>
                            <td id="sugerido_<?php echo $remedio["id"]; ?>"><?php echo $remedio["nombre_comercial"]; ?></td>
                            <td id="presentacion_<?php echo $remedio["id"]; ?>"><?php echo $remedio["presentacion"]; ?></td>
                            <td id="laboratorio_<?php echo $remedio["id"]; ?>"><?php echo $remedio["laboratorio"]; ?></td>
                            <td><button id="agrega" onclick="agregaRemedio(<?php echo $remedio['id'];?>,<?php echo $remedio['codigo'];?>)">Agregar</button></td>
                            
                            </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                        
                      </div>
                    </div> <!-- cierra collapse-->
                     <div>
                     <div class="table-responsive"> 
                       <table style="width:100%" id="listaMedicamentos" cellpadding="2">
                        <thead>
                            <tr>
                            <th width="20%" >Monodroga</th>
                            <th width="25%" >Sugerido</th>
                            <th width="20%" >Presentación</th>
                            <th width="15%" >Laboratorio</th>
                            <th width="10%" align="right">   Dosis por día</th>
                            <th width="3%" >Cant</th>
                            <th width="7%" >Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                        
                        </tbody>
                        </table>
                     </div>
                     </div>
                    </div>        
                </section>    
            </div>
 </div>                    
<!-- Prescripcion end --> 

<div clas="row">
  <div class="col-md-12">  
      <section class="panel">
          <header id="error" class="panel-heading">
          
          </header>
          <div class="panel-body">
            <div id="pieapp" class="mb-3">
            
            <!--<div class="col-md-12"><button type="button" onclick="window.location.href='receta_modelo.php'" class="">Generar Receta</button></div>-->
              <div class="col-md-12 text-center"><button type="button" onclick="generarRec();" class="">Generar Receta</button></div>
            
            </div>
          </div>
      </section>
  </div>
</div>




    </div>  <!-- wrapper --> 
</div>  <!--content --> 
           
<script type='text/javascript' src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<!-- Placed js at the end of the document so the pages load faster -->
<script src="../js/jquery-1.10.2.min.js"></script>
<script src="../js/jquery-ui-1.9.2.custom.min.js"></script>
<script src="../js/jquery-migrate-1.2.1.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/modernizr.min.js"></script>
<script src="../js/jquery.nicescroll.js"></script>
<!--easy pie chart-->
<script src="../js/easypiechart/jquery.easypiechart.js"></script>
<script src="../js/easypiechart/easypiechart-init.js"></script>
<!--Sparkline Chart-->
<script src="../js/sparkline/jquery.sparkline.js"></script>
<script src="../js/sparkline/sparkline-init.js"></script>
<!--icheck -->
<script src="../js/iCheck/jquery.icheck.js"></script>
<script src="../js/icheck-init.js"></script>
<!-- jQuery Flot Chart-->
<script src="../js/flot-chart/jquery.flot.js"></script>
<script src="../js/flot-chart/jquery.flot.tooltip.js"></script>
<script src="../js/flot-chart/jquery.flot.resize.js"></script>
<!--Morris Chart-->
<script src="../js/morris-chart/morris.js"></script>
<script src="../js/morris-chart/raphael-min.js"></script>
<!--Calendar-->
<script src="../js/calendar/clndr.js"></script>
<script src="../js/calendar/evnt.calendar.init.js"></script>
<script src="../js/calendar/moment-2.2.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.5.2/underscore-min.js"></script>
<!--common scripts for all pages-->
<script src="../js/scripts.js"></script>
<!--Dashboard Charts-->
<script src="../js/dashboard-chart-init.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>  
<script src="https://cdn.jsdelivr.net/npm/underscore@1.11.0/underscore-min.js"></script>
<script>
function agregaRemedio(srt,codreme){
    var id = srt;
    var codRemedio = codreme;
    
    var mono = $("#monodroga_" + id).text();
    var sugerido = $("#sugerido_" + id).text();
    var presentacion = $("#presentacion_" + id).text();
    var laboratorio = $("#laboratorio_" + id).text();
    
    var item = `
    <tr id="tr`+id+`">
      	<td>`+ mono +`</td>
        <td>`+ sugerido +`</td>
        <td>`+ presentacion +`</td>
        <td>`+ laboratorio +`</td>
        <td align="center"alin><input type="text" id="Posologia" size="7"/></td>
        <td align="center"><input type="text" id="Cantidad" size="2" /></td>
        <td><button class="borrar"> Quitar</button></td>
        <input type="hidden" id="Remedio" value="`+codRemedio+`">
    </tr>
    `;
    $("#listaMedicamentos").append(item)
  }

  $(function () {
    $(document).on('click', '.borrar', function (event) {
        event.preventDefault();
        $(this).closest('tr').remove();
    });
});

</script>
<script>
 var tabla = document.querySelector("#tablaPaciente");
 var dataTable = new DataTable("#tablaPaciente", {
    perPageSelect: [1, 5, 10],
	perPage: 5,
 labels: {
    placeholder: "Buscar: Droga/Comercial",
    perPage: "{select} Mostrar por página",
    noRows: "No hay entradas para encontrar",
    info: "Resultado {start} en {end} de {rows} registros",
}
});
</script>
<script>
function buscarDni(){
  $("#mostrarNoexiste").html(' ');
      //document.querySelector("#mostrarPaciente").innerHTML = ' ';
      var numdni = $("#buscardni").val();
      var http = new XMLHttpRequest();
      if(numdni.length === 0){
        //vacio
        document.getElementById("cargapaciente").style.display = "none";
        $("#mostrarPaciente").html(' ');
        $( "#mostrarNoexiste" ).html('<p class="text-danger">Por Favor introducir un nro de DNI !</p>');
      }else{
        //con nro
        http.onreadystatechange = function () {
        if (this.readyState == 4) {
            var datos=JSON.parse(this.response);
            if(_.isEmpty(datos) === true){//NO encontro nro de dni muestra formulario de carga
              $("#mostrarPaciente").html(' ');
              
              document.getElementById("cargapaciente").style.display = "block";
              // mostrar el valor de dni


            }else{
                    
                    var itemHtmlSi = `
                        <div class="row"> 
                    <div class="col-md-6"><p></p></div>
                    <div class="col-md-6"><p></p></div>
                    </div>
                    <div class="row"> 
                    <div class="col-md-6"></div>
                    <div class="col-md-6"></div>
                    </div>
                    <div class="row"> 
                    <div class="col-md-6"></div>
                    <div class="col-md-6"></div>
                    </div>
                    
                    <div class="row" style="padding:20px;"> 
                    <input id="id_Pac" type="hidden" value="`+datos[0].id+`">
                    <div class="col-md-6"><label>Apellido Nombre:</label> <span class="text-primary">`+datos[0].apellido+' '+datos[0].nombre+`</span></div>
                    <div class="col-md-3"><b>Sexo:</b> <span class="text-primary">`+datos[0].sexo+`</span></div>
                    <input id="dni_Pac" type="hidden" value="`+datos[0].dni+`">
                    <div class="col-md-3"><b>DNI:</b> <span class="text-primary">`+datos[0].dni+`</span></div>
                    </div>

                    <div class="row" style="padding:20px;">
                    <input id="talla_Pac" type="hidden" value="`+datos[0].talla+`">
                    <div class="col-md-3" id="tallaM"><b>Talla:</b> <span class="text-primary">`+datos[0].talla+`cm</span></div>
                    <input id="peso_Pac" type="hidden" value="`+datos[0].peso+`">
                    <div class="col-md-3" id=pesoM><b>Peso:</b> <span class="text-primary">`+datos[0].peso+`kg</span></div>
                    <input id="telefono_Pac" type="hidden" value="`+datos[0].telefono+`">
                    <div class="col-md-3" id=telefonoM><b>Teléfono:</b> <span class="text-primary">`+datos[0].telefono+`</span></div>
                    <div class="col-md-3"></div>
                    </div>

                    <div class="row" style="padding:20px;">
                    <input id="email_Pac" type="hidden" value="`+datos[0].email+`">
                    <div class="col-md-3" id="emailM"><b>Email:</b> <span class="text-primary">`+datos[0].email+`</span></div>
                    <input id="obrasocial_Pac" type="hidden" value="`+datos[0].idobrasocial+`">
                    
                    <div class="col-md-3" id="obraM"><b>Obra Social:</b> <span class="text-primary">`+(datos[0].sigla).toUpperCase()+`</span></div>
                    <input  id="numafiliado_Pac" type="hidden" value="`+datos[0].nromatriculadoc+`">
                    <div class="col-md-3" id="nroafilM"><b>Nro Afiliado:</b> <span class="text-primary">`+datos[0].nromatriculadoc+`</span></div>
                    <div class="col-md-3" id="botones"><button type="button" onclick="modificarPaciente();" class="btn btn-default">
                    Modificar 
                    </button> </div>
                    </div>
                    </div>
                    `
                    document.getElementById("cargapaciente").style.display = "none";
                    document.querySelector("#mostrarPaciente").innerHTML = itemHtmlSi;
            }
        }
    };
    http.open('POST', 'webservis', true);
    http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    http.send('nrodni='+numdni);
        
      }

}

</script>
<script>
//$(document).ready(function() {});
function agregarPaciente(){ 
       
  var aApellido    = $("#inputApellido").val();
  var aNombre      = $("#inputNombre").val();
  var aDni         = $("#buscardni").val();
  var aTalla       = $("#inputTalla").val();
  var aPeso        = $("#inputPeso").val();
  var aTelefono    = $("#inputTelefono").val();
  var aEmail       = $("#inputEmail").val();
  var aSexo        = $('input:radio[name=inputSexo]:checked').val(); 
  var aIdObraSocial  = $('select[name=inputObraSocial]').val(); 
  var texObra = $('select[name="inputObraSocial"] option:selected').text();
  var aNroAfiliado = $("#inputNroAfi").val();
  //console.log(aObraSocial);
  var http = new XMLHttpRequest();

  http.onreadystatechange = function () {
      if (this.readyState == 4) {
          //cargapaciente display:none
          document.getElementById("cargapaciente").style.display = "none";
          var resp = this.response;
          console.log(resp);
          if(resp == "N"){
            //ver error
          }else{
          var HtmlRespSi = `
                        <div class="row"> 
                    <div class="col-md-6"><p></p></div>
                    <div class="col-md-6"><p></p></div>
                    </div>
                    <div class="row"> 
                    <div class="col-md-6"></div>
                    <div class="col-md-6"></div>
                    </div>
                    <div class="row"> 
                    <div class="col-md-6"></div>
                    <div class="col-md-6"></div>
                    </div>
                    <div class="row" style="padding:20px;"> 
                    <input id="id_Pac" type="hidden" value="`+resp+`">
                    <div class="col-md-6" id="apelNom_Pac"><b>Apellido Nombre:</b> <span class="text-primary">`+aApellido+' '+aNombre+`</span></div>
                    <div class="col-md-3"><b>Sexo:</b> <span class="text-primary">`+aSexo+`</span></div>
                    <div class="col-md-3" id="dni_Pac"><b>DNI:</b> <span class="text-primary">`+aDni+`</span></div>
                    </div>

                    <div class="row" style="padding:20px;">
                    <div class="col-md-3"><b>Talla:</b> <span class="text-primary">`+aTalla+`cm</span></div>
                    <div class="col-md-3"><b>Peso:</b> <span class="text-primary">`+aPeso+`kg</span></div>
                    <div class="col-md-6"><b>Teléfono:</b> <span class="text-primary">`+aTelefono+`</span></div>
                    </div>
                    <div class="row" style="padding:20px;">
                    <div class="col-md-3"><b>Email:</b> <span class="text-primary">`+aEmail+`</span></div>
                    <div class="col-md-3"><b>Obra Social:</b> <span class="text-primary">`+texObra+`</span></div>
                    <input id="obrasocial_Pac" type="hidden" value="`+aIdObraSocial+`">
                    <div class="col-md-3" id="numafiliado_Pac"><b>Nro Afiliado:</b> <span class="text-primary">`+aNroAfiliado+`</span></div>
                    <div class="col-md-3"><!--<button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#flipUpPaciente">
                    Modificar
                    </button>--> </div>
                    </div>
                    </div>
                    `
                    document.querySelector("#mostrarPaciente").innerHTML = HtmlRespSi;
          }          
      }
  };
  http.open('POST', 'pacienteservis.php', true);
  http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

  http.send('accion=addpaciente&apel='+aApellido+'&nom='+aNombre+'&dni='+aDni+'&talla='+aTalla+'&peso='+aPeso+'&tel='+aTelefono+'&mail='+aEmail+'&sex='+aSexo+'&obra='+aIdObraSocial+'&nroafi='+aNroAfiliado);
}
</script>


<script>
function modificarPaciente(){
  console.log("viene de modificarr");
  var tallam = $("#talla_Pac").val();
  var pesom = $("#peso_Pac").val();
  var telefonom = $("#telefono_Pac").val();
  var emailm = $("#email_Pac").val();

  var obraSocialm = $("#obrasocial_Pac").val();
  var numAfiliadoOSm = $("#numafiliado_Pac").val();

  document.querySelector("#tallaM").innerHTML = '<b>Talla:</b> <input type="number" class="form-control" id="inputTalla" value="'+ tallam +'" required>';
  document.querySelector("#pesoM").innerHTML = '<b>Peso:</b> <input type="number" class="form-control" id="inputPeso" value="'+ pesom +'" required>';
  document.querySelector("#telefonoM").innerHTML = '<b>Teléfono:</b> <input type="number" class="form-control" id="inputTelefono" value="'+telefonom +'" required>';
  document.querySelector("#emailM").innerHTML = '<b>Email:</b> <input type="email" class="form-control" id="inputEmail" placeholder="Email" value="'+emailm+'" required>';
  
  document.querySelector("#obraM").innerHTML ='<?php echo $todo; ?>';


  document.querySelector("#nroafilM").innerHTML = '<b>Nro Afiliado:</b> <input type="text" class="form-control" id="inputNroAfi" value="'+numAfiliadoOSm +'" required>';

  
  document.querySelector("#botones").innerHTML = `<div class="btn-group" role="group"><br>
  <button type="button" onclick="buscarDni();" class="btn btn-default">Cancel</button>
  <button type="button" onclick="GuardarModificadoPaciente();" class="btn btn-default">Guardar</button>
  </div>`;
}
</script>

<script>
function GuardarModificadoPaciente(){
  //console.log("viene de gurdar modificar paciente");
  var talla = $("#inputTalla").val();
  var peso = $("#inputPeso").val();
  var telefono = $("#inputTelefono").val();
  var email = $("#inputEmail").val();
  var aIdObraSocial  = $('select[name=inputObraSocial]').val();
  var numAfiliadoOS = $("#inputNroAfi").val();
  var idpaciente = $("#id_Pac").val();
  var http = new XMLHttpRequest();
  http.onreadystatechange = function () {
      if (this.readyState == 4) {
        
        console.log(this.response);
        var resp = this.response;
        if(resp == "N"){
          //error manejo del mismo
          //console.log(this.response);
        }else{
          console.log("entro S");
          buscarDni();
        };
      } 
    
 
    }; 
    http.open('POST', 'pacienteservis.php', true);
    http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    http.send('accion=Uppaciente&talla='+talla+'&peso='+peso+'&tel='+telefono+'&mail='+email+'&obra='+aIdObraSocial+'&nroafi='+numAfiliadoOS+'&idpac='+idpaciente); 
}
</script>

<script>
function generarRec(){
  var error = "";
  var errorEspecialidad = 0;
  var errorPaciente = 0;
  var errorDiagnostico = 0;
  var errorVademecum = 0;
  //especialidad
  var numMatEspec = $('select[name=especialidad]').val();
  //console.log(numMatEspec);
  if(numMatEspec == 0 ){
    error = `<div class="alert alert-danger text-center" role="alert">
            Por favor seleccione una especialidad.
            </div> `;
    document.querySelector("#error").innerHTML = error;         
  }else{
    errorEspecialidad = 1;
  }

  //var nomEspec = $("#especialidad option:selected").text();
  var numMatDoc = <?php echo $_SESSION['matricula']?>;
  //paciente
  var idPac = $("#id_Pac").val();
  console.log("NRO id PAC"+idPac);
  var NroDni = "";
  NroDni = $("#buscardni").val();
  if(errorEspecialidad == 1){
      if(NroDni == "" ){
        error = `<div class="alert alert-danger text-center" role="alert">
                Por favor introducir NRO de DNI paciente.
                </div> `;
        document.querySelector("#error").innerHTML = error;         
      }else{
         if(idPac == 0){
          error = `<div class="alert alert-danger text-center" role="alert">
                Por favor completar busqueda de paciente.
                </div> `;
        document.querySelector("#error").innerHTML = error; 
         }else{
          errorPaciente = 1;
         } 

      }
  }
  
  var obraSocialPac = $("#obrasocial_Pac").val();
  var numAfiliadoOSPac = $("#numafiliado_Pac").val();
  // Diagnostico
  var diag = ""; 
  diag = $("#texDiagnostico").val();
  if(errorEspecialidad == 1 && errorPaciente == 1 ){
      if(diag == "" ){
        error = `<div class="alert alert-danger text-center" role="alert">
                Por favor introducir diagnostico.
                </div> `;
        document.querySelector("#error").innerHTML = error;         
      }else{
        errorDiagnostico = 1;
      }
  }
  var errorEPD = errorEspecialidad + errorPaciente + errorDiagnostico;
  //console.log("entro");
  console.log("e= "+errorEPD);
   //prescripcion
  var nFilas = $("#listaMedicamentos tr").length;
  //console.log("Number of rows : " + nFilas);
 //if(errorEPD == 3){
   if(nFilas == 1){
        error = `<div class="alert alert-danger text-center" role="alert">
                Por favor abrir vademécum.
                </div> `;
        document.querySelector("#error").innerHTML = error; 
        $("#bto_vademecum").focus(function(){
    		$(this).css("background-color", "#FFFFCC");
	      });
   }else{
     errorVademecum = 1;
   }
 //} 

// Json de medicamento con .each y .find 
var myRows = [];
var $rows = $("#listaMedicamentos tr").each(function(index) {
  $cells = $(this).find("input");
  myRows[index - 1] = {};
  $cells.each(function(cellIndex) {
    myRows[index - 1][("pcr"[cellIndex])] = $(this).val();
  });    
});
var PcrObj = myRows;
console.log(PcrObj);
//console.log(JSON.stringify(PcrObj));
remedios = JSON.stringify(PcrObj);
//console.log(remedios);

//console.log(numMatDoc);
//console.log(numMatEspec);
//console.log(idPac);
//console.log(obraSocialPac);
//console.log(diag);
 
 
 //document.querySelector("#error").innerHTML = ""; 
 
 
  var http = new XMLHttpRequest();
  http.onreadystatechange = function () {
      if (this.readyState == 4) {
        var resp = this.response;
        console.log("resp =" + resp);
        if(resp === "N"){
          //error manejo del mismo
        }else{
          var idreceta = resp;
          $( "#pieapp" ).html(' ');
          var HtmlRespPie = `
          En proceso...          
          `;
          document.querySelector("#pieapp").innerHTML = HtmlRespPie;
          //var idreceta = id;
          var nomEspec = $("#especialidad option:selected").text();
          //location.href="receta_modelo.php?id="+idreceta+"&especial="+nomEspec;
          window.open('receta_modelo.php?id='+idreceta+'&especial='+nomEspec, '_blank');
          location.reload();
        };
       
       
      }

    
  }
  http.open('POST', 'recetaservis.php', true);
  http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

  http.send('matricprescr='+numMatDoc+'&matricespec_prescr='+numMatEspec+'&idpaciente='+idPac+'&idobrasocafiliado='+obraSocialPac+'&diagnostico='+diag+'&remedios='+remedios+'&cantremedios='+nFilas);
  

}; 
</script>

<script>
function imprimirReceta(id){
  var idreceta = id;
  var nomEspec = $("#especialidad option:selected").text();
 location.href="receta_modelo.php?id="+idreceta+"&especial="+nomEspec;
  
  /*
  var http = new XMLHttpRequest();
  http.onreadystatechange = function () {
      if (this.readyState == 4) {
        var resp = this.response;
        console.log(resp);
            
      
      }

    };
  http.open('POST', 'receta_modelo.php', true);
  http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

  http.send('idreceta='+idreceta);
*/
}

</script>
</body>
</html>

 

