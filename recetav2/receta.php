<?php
include('template/head.php');

?>
<!-- start page title y miga de pan -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Prescribir Receta</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Receta Electónica</a></li>
                    <li class="breadcrumb-item active">Prescribir</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- end page title y miga de pan -->
<!-- start contenido de pagina -->
<!-- Star Especialidad -->
<div class="row">
    <div class="col-xl-6">
        <div class="card mh-100" style="height:150px">
            <div class="card-body">
                <h4 class="card-title">SELECCIONE EL TIPO DE ESPECIALIDAD:</h4>
                <p class="card-title-desc">Seleccionar la especialidad o puede dejar sin especialidad.</p>
                <div class="row row-cols-1">
                    <div class="col-sm-12 col-xs-12">
                        <?PHP
                        include_once ('rec_especialidad.php')
                        ?> 
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Especialidad -->
    <!-- Star PACIENTE-->                   
    <div class="col-xl-6">
        <div class="card mh-100" style="height:150px">
            <div class="card-body">
                <h4 class="card-title">PACIENTE:</h4>
                <p class="card-title-desc">Introducir Nro de DNI, luego oprimir botón Buscar.</p>
                <div class="row row-cols-3">
                    <div class="col-sm-3 col-xs-3">
                        <input class="form-control" maxlength="8" type="number" inputmode="numeric" value="" id="buscardni" name="buscardni" placeholder="Nro. de DNI" aria-label="Buscar por DNI paciente" required oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                    </div>
                    <div class="col-sm-3 col-xs-3">
                        <button type="button" class="btn btn-outline-success mb-3" onclick="buscarDni();">Buscar</button>
                    </div> 
                    <div class="col-sm-6 col-xs-6">
                    <div id="mostrarNoexiste"></div>
                    </div> 
                    
                </div>
            </div>
        </div>
    </div>
    <!-- End Paciente -->
</div>
<!-- End row Especialidad y busqueda Paciente -->               

<!-- Star ventana oculta datos paciente -->
<!--id="cargapaciente" -->
<div class="row" id="VentPaciente" style="display:none">
    <div class="col-xl-12">
        <div class="card mh-100">
 <!--- -->          
        <div id="mostrarPaciente" class="row row-cols-1 row-cols-sm-2 row-cols-md-4 card-body"> 
  
          
        </div>         
 <!---  -->          
        </div>   
    </div>     
</div>
<!-- End ventana oculta datos paciente -->

<!---///////////////////////////////////Borrador///////////////////////////////// -->
           

<!---///////////////////////////////////Borrador///////////////////////////////// -->
<!--- Star DIAGNOSTICO  -->          
<div class="row" data-select2-id="16">
    <div class="col-lg-12" data-select2-id="15">
        <div class="card" data-select2-id="14">
            <div class="card-body" data-select2-id="13">
                <h4 class="card-title">DIAGNÓSTICO:</h4>
                <p class="card-title-desc">Indiqué un diagnóstico o su código CIE.</p>
                <div class="row">
                  <div class="col-lg-4 align-items-start">
                  <p>Diagnostico 1: <samp id="dig1" ></samp> </p>
                    <p> CIE: <samp id="cie-dig1" ></samp></p> 
                  </div>
                  <!--
                  <div class="col-lg-4 align-items-start">
                    <p>Diagnostico 2: <samp id="paste-selectedEntityTxt" ></samp> </p>
                    <p> CIE: <samp id="paste-selectedEntity" ></samp></p>  
                  </div>
                  -->
                  <div class="col-lg-4 align-items-start">
                  
                    <button class="btn btn-outline-success" type="button" data-bs-toggle="collapse" data-bs-target="#collapseCie11" aria-expanded="false" aria-controls="collapseCie11">
                     Codificación CIE - 11
                    </button>
                  </div>
                </div>
      <div class="collapse" id="collapseCie11">
        <div class="card card-body">
            Diagnostico: 
            <!-- input element used for typing the search  -->
            <input type="text" class="ctw-input" autocomplete="on" data-ctw-ino="1"> 
        
            <!-- div element used for showing the search results -->
            <div class="ctw-window" data-ctw-ino="1"></div>
        </div>
      </div>
    
    
    
      <script src="https://icdcdn.who.int/embeddedct/icd11ect-1.5.js"></script>
    <script>
        // Embedded Coding Tool settings object
        // please note that only the property "apiServerUrl" is required
        // the other properties are optional
        const mySettings = {
            // The API located at the URL below should be used only for software
            // development and testing. ICD content at this location might not
            //  be up to date or complete. For production, use the API located at
            // id.who.int with proper OAUTH authentication
            apiServerUrl: "https://icd11restapi-developer-test.azurewebsites.net",  
            language: "es",
            //apiServerUrl: "https://id.who.int",   
            //apiSecured: true,
            //simplifiedMode: true,
            wordsAvailable: true,  
            flexisearchAvailable: false
        };

        // example of an Embedded Coding Tool using the callback selectedEntityFunction 
        // for copying the code selected in an <input> element and clear the search results
        const myCallbacks = {
            selectedEntityFunction: (selectedEntity) => { 
                // paste the code into the <input>
                //document.getElementById('paste-selectedEntity').value = selectedEntity.code; 
                document.getElementById('cie-dig1').innerHTML = selectedEntity.code; 
                //document.getElementById('paste-selectedEntityTxt').value = selectedEntity.selectedText;        
                document.getElementById('dig1').innerHTML = selectedEntity.selectedText;        
                // clear the searchbox and delete the search results
                ECT.Handler.clear("1")    
            }
        };

        // configure the ECT Handler with mySettings and myCallbacks
        ECT.Handler.configure(mySettings, myCallbacks);
        
    </script>  
                
                
                 
            </div>
        </div>
    </div>
</div>  
<!--- End Diagnostico -->

<!--- Star PRESCRIPCION ---->
<?php
$SQLprescripcion = $conexionre->prepare("SELECT * FROM rec_vademecum ORDER BY monodroga ASC, laboratorio, presentacion;
");
$SQLprescripcion->execute();
$listaRemedios=$SQLprescripcion->fetchAll(PDO::FETCH_ASSOC);
?>    
<div class="row" data-select2-id="16">
    <div class="col-lg-12" data-select2-id="15">
        <div class="card" data-select2-id="14">
            <div class="card-body" data-select2-id="13">

                <h4 class="card-title">PRESCRIPCIÓN:</h4>
                <p class="card-title-desc">Oprimir botón Vademécum para abrir listado.</p>

                <div class="col-md-12">
                      <button class="btn btn-outline-success" id="bto_vademecum" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                      Vademécum
                      </button>                  
                      </div>
                    <br>
                      <div class="collapse" id="collapseExample">
                    <div class="panel-body">
                    <div class="table-responsive">
                        <!--<table cclass="table" id="tablaPaciente" class="display" style="width:100%">-->
                        <table id="tablaPaciente" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
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
                            <td scope="row" id="monodroga_<?php echo $remedio["id"]; ?>"><?php echo $remedio["monodroga"]; ?></td>
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
<!-- -->
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

<!-- -->
            </div>
        </div>
    </div>
</div>  <!-- End row Prescripción -->







<!-- Botones Generar Receta -->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">

                <div>
                    <div class="d-grid mb-3">
                        <button type="button" class="btn btn-primary btn-lg waves-effect waves-light" onclick="generarRec();" >Generar Receta</button>
                    </div>
                    <div class="d-grid">
                        <button type="button" class="btn btn-light btn-sm waves-effect waves-light">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END botones generar receta -->

 <!-- end contenido de pagina -->  
 
<?php
include('template/footer_js.php');
?>
<script>
     $(document).ready(function() {
        document.getElementById("especialidad").focus();
        $('#tablaPaciente').DataTable(
          {
            language: {
                "decimal": "",
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Entradas",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscar:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            }
          }  
        );
      
      
      
      } );
 </script>
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


<script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.5.2/underscore-min.js"></script>
<!-- Paciente -->
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
              console.log(datos);
              if(_.isEmpty(datos) === true){//NO encontro nro de dni muestra formulario de carga
                $("#mostrarPaciente").html(' ');
                var nvoDni = $("#buscardni").val();
                var itemHtmlNo = `
                <div class="col text-star">
            <h4 class="card-title">Paciente</h4>
            <p class="ppac"><samp>Apellido: <input type="text" class="" id="apellido_Pac" value="" maxlength="20"  oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" style="width:200px;"></samp></p>
            <p class="ppac"><samp>Nombre:&nbsp;&nbsp;&nbsp;<input type="text" class="" id="nombre_Pac" value="" maxlength="20"  oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" style="width:200px;"></samp></p>
            <p class="ppac"><samp>DNI:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="number" class="" id="talla_Pac" value="`+nvoDni+`" maxlength="8" inputmode="numeric" disabled oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" style="width:200px;"></p>
            <p class="ppac"><samp>Sexo:</samp></p>
          
            <p class="ppac" style="padding-left: 80px"><input type="radio" name="inputSexo" value="F" required><samp> Femenino</samp></p>
            <p class="ppac" style="padding-left: 80px"><input type="radio" name="inputSexo" value="M" required><samp> Masculino</samp></p>
            <p class="ppac" style="padding-left: 80px"><input type="radio" name="inputSexo" value="O" required><samp> Otro</samp></p>
                              
          </div>
          <div class="col text-star">
            <h4 class="card-title">Estado</h4>
            <p class="ppac" id="talla"><samp>Talla: <input type="number" class="" id="talla_Pac" value="" maxlength="3" inputmode="numeric" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" style="width:50px;"> cm </samp></p>
            
            <p class="ppac" id="peso"><samp>Peso:&nbsp;&nbsp;<input type="number" class="" id="peso_Pac" value="" maxlength="3" inputmode="numeric" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" style="width:50px;"> kg </samp></p>
            <p class="ppac"><samp>Antecedentes: <small>próxima versión</small></samp></p>
          </div>
          <div class="col text-star">
            <h4 class="card-title">Cobertura</h4>
            <p class="ppac"><select class="fw-normal" name="inputObraSocial" id="inputObraSocial" aria-label=".form-select-lg example">
              <option selected><small>Selecionar Obra Social</small></option> </select> </p>          
            <p class="ppac" id="numobrasoc"><samp>Nro Afiliado: <input type="text" class="" id="numafiliado_Pac" value="" maxlength="20"  oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" style="width:200px;"></samp></p>
            <p class="ppac"><samp>Plan: <small>próxima versión</small></samp></p>
          </div>
          <div class="col text-star">
            <h4 class="card-title">Comunicación</h4>
            <p class="ppac" id="celular"><samp>Celular: <input type="text" class="" id="telefono_Pac" value="" maxlength="15"  oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" style="width:200px;"></samp></p>
            <p class="ppac" id="emailp"><samp>Email:&nbsp;&nbsp;     <input type="email" class="" id="email_Pac" value="" maxlength="30"  oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" style="width:200px;"></samp></p>
            <p class="ppac"><samp>Whatsapp: <small>próxima versión</small></samp></p>
            <p class="ppac"><samp>Telegram: <small>próxima versión</small></samp></p>
            <br>
            <button type="button" class="btn btn-outline-success" onclick="agregarPaciente();">Guardar</button><button type="button" class="btn btn-outline-success" onclick="cancelarPaciente();">Cancelar</button>
          </div>`;
                
                document.getElementById("VentPaciente").style.display = "block";
                document.querySelector("#mostrarPaciente").innerHTML = itemHtmlNo; 
                document.getElementById('buscardni').disabled = true;   
                document.getElementById("apellido_Pac").focus(); 
                ArmarSelectObraSocial();
                document.getElementById("apellido_Pac").focus(); 
                
              }else{
                //************************************      
                      var itemHtmlSi = `
                      <div class="col text-star">
                        <h4 class="card-title">Paciente</h4>
                        <p class="ppac"><samp>Apellido: `+datos[0].apellido+`</samp></p>
                        <p class="ppac"><samp>Nombre: `+datos[0].nombre+`</samp></p>
                        <p class="ppac"><samp>DNI: `+datos[0].dni+`</samp></p>
                        <p class="ppac"><samp>Sexo: `+datos[0].sexo+`</samp></p>
                        <input id="id_Pac" type="hidden" value="`+datos[0].id+`">
                        <input id="dni_Pac" type="hidden" value="`+datos[0].dni+`">
                      </div>
                      <div class="col text-star">
                        <h4 class="card-title">Estado</h4>
                        <p class="ppac" id="talla"><samp>Talla: <input type="number" class="" id="talla_Pac" value="`+datos[0].talla+`" maxlength="3" inputmode="numeric" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" style="width:50px;" disabled> cm </samp><button type="button" class="peditar" onclick="modificarTalla('modificar')"><i class="ri-edit-2-line"></i></button></p>
                        
                        <p class="ppac" id="peso"><samp>Peso:&nbsp;&nbsp;<input type="number" class="" id="peso_Pac" value="`+datos[0].peso+`" maxlength="3" inputmode="numeric" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" style="width:50px;" disabled> kg </samp><button type="button" class="peditar" onclick="modificarPeso('modificar')"><i class="ri-edit-2-line"></i></button></p>
                        <p class="ppac"><samp>Antecedentes: <small>próxima versión</small></samp></p>
                      </div>
                     
                      <div class="col text-star">
                      <h4 class="card-title">Cobertura</h4>
                      <p class="form-check form-switch">Obra Social 
                      <input class="form-check-input" type="checkbox" role="switch" name="miswitch" data-bs-toggle="collapse" data-bs-target="#cajaObraSocial">
                      </p>
                      <p class="form-check form-switch">Convenio/Bono
                      <input class="form-check-input" type="checkbox" role="switch" name="miswitch" data-bs-toggle="collapse" data-bs-target="#cajaConvenio">
                      </p>                       
                        
                        <div id="cajaObraSocial" class="collapse">
                          <p class="ppac" id="osocial"><samp>Obra Social:&nbsp;&nbsp;<input type="text" class="" id="obrasocial_Pac" value="`+(datos[0].sigla).toUpperCase()+`" maxlength="20"  oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" style="width:200px;" disabled></samp><button type="button" class="peditar" onclick="modificarObraSocial('modificar')"> <i class="ri-edit-2-line"></i></button></p>
                          <input id="Idobrasocial_Pac" type="hidden" value="`+datos[0].idobrasocial+`">
                          <p class="ppac" id="numobrasoc"><samp>Nro Afiliado: <input type="text" class="" id="numafiliado_Pac" value="`+datos[0].nromatriculadoc+`" maxlength="20"  oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" style="width:200px;" disabled></samp><button type="button" class="peditar" onclick="modificarNumObraSocial('modificar')"> <i class="ri-edit-2-line"></i></button></p>
                          <p class="ppac" id="numobrasoc"><samp>Plan:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" class="" id="plan_Pac" value="" maxlength="20"  oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" style="width:200px;"></samp></p>
                        </div>
                        <div id="cajaConvenio" class="collapse">
                          <p class="ppac"><samp>Convenio:<select class="" name="convenio_Pac" id="convenio_Pac" aria-label=".form-select-lg example">
                              <option selected="">Selecionar Convenio/Bono</option> 
                              <option value="cb1">BONO PAP</option>
                              <option value="cb2">RECETARIO SOLIDARIO</option>
                              <option value="cb3">TARMET</option>
                              <option value="cb4">VALE+ SALUD</option>
                              </select>
                          <p class="ppac" id="numconvenio"><samp>Datos:&nbsp;&nbsp;&nbsp;<input type="text" class="" id="numconvenio_Pac" value="" maxlength="20"  oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" style="width:250px;"></samp></p>
                          
                        </div>
                      
                      </div>

                      <div class="col text-star">
                        <h4 class="card-title">Comunicación</h4>
                        <p class="ppac" id="celular"><samp>Celular:<input type="text" class="" id="telefono_Pac" value="`+datos[0].telefono+`" maxlength="15"  oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" style="width:250px;" disabled></samp><button type="button" class="peditar" onclick="modificarTelefono('modificar')"> <i class="ri-edit-2-line"></i></button></p>
                        
                        <p class="ppac" id="emailp"><samp>Email:&nbsp;&nbsp;<input type="email" class="" id="email_Pac" value="`+datos[0].email+`" maxlength="30"  oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" style="width:250px;" disabled></samp><button type="button" class="peditar" onclick="modificarEmail('modificar')"> <i class="ri-edit-2-line"></i></button></p>
                        <p class="ppac"><samp>Whatsapp: <small>próxima versión</small></samp></p>
                        <p class="ppac"><samp>Telegram: <small>próxima versión</small></samp></p>
                      </div> 
                      `
                      document.getElementById("VentPaciente").style.display = "block";
                      document.querySelector("#mostrarPaciente").innerHTML = itemHtmlSi;
              }
          }
      };
      http.open('POST', 'webservis.php', true);
      http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
  
      http.send('donde=1&nrodni='+numdni);
          
        }
  
  }  
</script>
<script>
function ArmarSelectObraSocial(){
//console.log('entro en armar...');

  const xhr = new XMLHttpRequest();

    function onRequestHandler(){
        if(this.readyState === 4 && this.status === 200){
        
        const data = JSON.parse(this.response);
        //console.log(data);
        var x = document.getElementById("inputObraSocial");
        var option = document.createElement("option");
        data.forEach(function(obrasocial) {
          
          var xSelect = document.getElementById("inputObraSocial");
          var aTag = document.createElement('option');
          aTag.setAttribute('value', obrasocial["id"]);
          aTag.innerHTML = obrasocial["sigla"];
          xSelect.appendChild(aTag);
        
        });  
      }  

    }
xhr.addEventListener("load", onRequestHandler);
xhr.open('GET','https://rx.cmpc.org.ar/obrasocialservis.php');
xhr.send();

}  
</script>
<script>
//$(document).ready(function() {});
function agregarPaciente(){ 
       
  var aApellido    = $("#apellido_Pac").val();
  var aNombre      = $("#nombre_Pac").val();
  var aDni         = $("#buscardni").val();
  var aTalla       = $("#talla_Pac").val();
  var aPeso        = $("#peso_Pac").val();
  var aTelefono    = $("#telefono_Pac").val();
  var aEmail       = $("#email_Pac").val();
  var aSexo        = $('input:radio[name=inputSexo]:checked').val(); 
  var aIdObraSocial  = $('select[name=inputObraSocial]').val(); 
  var texObra = $('select[name="inputObraSocial"] option:selected').text();
  var aNroAfiliado = $("#numafiliado_Pac").val();
  //console.log(aObraSocial);
  var http = new XMLHttpRequest();

  http.onreadystatechange = function () {
      if (this.readyState == 4) {
          //cargapaciente display:none
          //document.getElementById("cargapaciente").style.display = "none";
          var resp = this.response;
          console.log(resp);
          if(resp == "N"){
            //ver error
          }else{
          var HtmlRespSi = `
                      <div class="col text-star">
                        <h4 class="card-title">Paciente</h4>
                        <p class="ppac"><samp>Apellido: `+aApellido+`</samp></p>
                        <p class="ppac"><samp>Nombre: `+aNombre+`</samp></p>
                        <p class="ppac"><samp>DNI: `+aDni+`</samp></p>
                        <p class="ppac"><samp>Sexo: `+aSexo+`</samp></p>
                        <input id="id_Pac" type="hidden" value="`+aDni+`">
                        
                      </div>
                      <div class="col text-star">
                        <h4 class="card-title">Estado</h4>
                        <p class="ppac" id="talla"><samp>Talla: <input type="number" class="" id="talla_Pac" value="`+aTalla+`" maxlength="3" inputmode="numeric" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" style="width:50px;" disabled> cm </samp><button type="button" class="peditar" onclick="modificarTalla('modificar')"><i class="ri-edit-2-line"></i></button></p>
                        
                        <p class="ppac" id="peso"><samp>Peso:&nbsp;&nbsp;<input type="number" class="" id="peso_Pac" value="`+aPeso+`" maxlength="3" inputmode="numeric" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" style="width:50px;" disabled> kg </samp><button type="button" class="peditar" onclick="modificarPeso('modificar')"><i class="ri-edit-2-line"></i></button></p>
                        <p class="ppac"><samp>Antecedentes: <small>próxima versión</small></samp></p>
                      </div>
                     
                      <div class="col text-star">
                      <h4 class="card-title">Cobertura</h4>
                      <p class="form-check form-switch">Obra Social 
                      <input class="form-check-input" type="checkbox" role="switch" name="miswitch" data-bs-toggle="collapse" data-bs-target="#cajaObraSocial">
                      </p>
                      <p class="form-check form-switch">Convenio/Bono
                      <input class="form-check-input" type="checkbox" role="switch" name="miswitch" data-bs-toggle="collapse" data-bs-target="#cajaConvenio">
                      </p>                       
                        
                        <div id="cajaObraSocial" class="collapse">
                          <p class="ppac" id="osocial"><samp>Obra Social:<input type="text" class="" id="obrasocial_Pac" value="`+texObra+`" maxlength="20"  oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" style="width:200px;" disabled></samp><button type="button" class="peditar" onclick="modificarObraSocial('modificar')"> <i class="ri-edit-2-line"></i></button></p>
                         
                          <input id="Idobrasocial_Pac" type="hidden" value="`+aIdObraSocial+`">
                          <p class="ppac" id="numobrasoc"><samp>Nro Afiliado: <input type="text" class="" id="numafiliado_Pac" value="`+aNroAfiliado+`" maxlength="20"  oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" style="width:200px;" disabled></samp><button type="button" class="peditar" onclick="modificarNumObraSocial('modificar')"> <i class="ri-edit-2-line"></i></button></p>
                          <p class="ppac" id="numobrasoc"><samp>Plan: <input type="text" class="" id="numafiliado_Pac" value="" maxlength="20"  oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" style="width:200px;"></samp></p>
                        </div>
                        <div id="cajaConvenio" class="collapse">
                          <p class="ppac"><samp>Convenio:<input type="text" class="" id="obrasocial_Pac" value="" maxlength="20"  oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" style="width:200px;" disabled></samp><button type="button" class="peditar" onclick="modificarObraSocial('modificar')"> <i class="ri-edit-2-line"></i></button></p>
                          <input id="obrasocial_Pac" type="hidden" value="">
                          <p class="ppac" id="numobrasoc"><samp>Datos: <input type="text" class="" id="numafiliado_Pac" value="" maxlength="20"  oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" style="width:200px;"></samp></p>
                          
                        </div>
                      
                      </div>

                      <div class="col text-star">
                        <h4 class="card-title">Comunicación</h4>
                        <p class="ppac" id="celular"><samp>Celular: <input type="text" class="" id="telefono_Pac" value="`+aTelefono+`" maxlength="15"  oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" style="width:250px;" disabled></samp><button type="button" class="peditar" onclick="modificarTelefono('modificar')"> <i class="ri-edit-2-line"></i></button></p>
                        <p class="ppac" id="emailp"><samp>Email: <input type="email" class="" id="email_Pac" value="`+aEmail+`" maxlength="30"  oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" style="width:250px;" disabled></samp><button type="button" class="peditar" onclick="modificarEmail('modificar')"> <i class="ri-edit-2-line"></i></button></p>
                        <p class="ppac"><samp>Whatsapp: <small>próxima versión</small></samp></p>
                        <p class="ppac"><samp>Telegram: <small>próxima versión</small></samp></p>
                      </div> 
                      `
                      document.getElementById("VentPaciente").style.display = "block";
                      document.querySelector("#mostrarPaciente").innerHTML = itemHtmlSi;
          }          
      }
  };
  http.open('POST', 'pacienteservis.php', true);
  http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

  http.send('accion=addpaciente&apel='+aApellido+'&nom='+aNombre+'&dni='+aDni+'&talla='+aTalla+'&peso='+aPeso+'&tel='+aTelefono+'&mail='+aEmail+'&sex='+aSexo+'&obra='+aIdObraSocial+'&nroafi='+aNroAfiliado);
}
</script>
<script>
function cancelarPaciente(){
    document.getElementById('VentPaciente').style.display = "none";
    document.querySelector('#mostrarPaciente').innerHTML = ""; 
    document.getElementById('buscardni').disabled = false;  
    document.getElementById('buscardni').focus(); 
}
</script>
<script>
function modificarTalla(srt){
  if(srt === 'modificar'){
    var tallam = $("#talla_Pac").val();
    console.log(tallam);
    document.querySelector("#talla").innerHTML =`
    <samp>Talla: <input type="number" class="" id="talla_Pac" value="`+tallam+`" maxlength="3" inputmode="numeric" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" style="width:50px;"> cm </samp><button type="button" class="peditar" onclick="modificarTalla('guardar')"><i class="ri-save-3-line"></i></button>`;
  }else{
    var tallam = $("#talla_Pac").val();
    console.log('guardar'+tallam)
    // envio a guardar y regreso
    GuardarModi(tallam,"talla");
    document.querySelector("#talla").innerHTML =`
    <samp>Talla: <input type="number" class="" id="talla_Pac" value="`+tallam+`" maxlength="3" inputmode="numeric" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" style="width:50px;" disabled> cm </samp><button type="button" class="peditar" onclick="modificarTalla('modificar')"><i class="ri-edit-2-line"></i></button>`;
  }
}
</script>
<script>
function modificarPeso(srt){
  if(srt === 'modificar'){
   var pesom = $("#peso_Pac").val();
   console.log(pesom);
   document.querySelector("#peso").innerHTML =`<samp>Peso:&nbsp;&nbsp;<input type="number" class="" id="peso_Pac" value="`+pesom+`" maxlength="3" inputmode="numeric" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" style="width:50px;"> kg </samp><button type="button" class="peditar" onclick="modificarPeso('guardar')"><i class="ri-save-3-line"></i></button>`; 
  }else{
   var pesom = $("#peso_Pac").val();
   console.log('guardar'+pesom);
   // envio a guardar y regreso
   GuardarModi(pesom,"peso");
   document.querySelector("#peso").innerHTML =`<samp>Peso:&nbsp;&nbsp;<input type="number" class="" id="peso_Pac" value="`+pesom+`" maxlength="3" inputmode="numeric" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" style="width:50px;" disabled> kg </samp><button type="button" class="peditar" onclick="modificarPeso('modificar')"><i class="ri-edit-2-line"></i></button>`;
  }
}
</script>
<script>
function modificarObraSocial(){
  var obraSocialm = $("#obrasocial_Pac").val();
  var Idobrasocialm = $("#Idobrasocial_Pac").val();
  console.log(Idobrasocialm);
  document.querySelector("#osocial").innerHTML =`<select class="" name="inputObraSocial" id="inputObraSocial" aria-label=".form-select-lg example"><option selected>Selecionar Obra Social</option> </select>`;
  ArmarSelectObraSocial(); 
  //$("#inputObraSocial option[value='62']").attr("selected", true);
  
}
</script>
<script>
function modificarNumObraSocial(srt){
  if(srt === 'modificar'){
   var numAfiliadoOSm = $("#numafiliado_Pac").val();
   console.log(numAfiliadoOSm);
   document.querySelector("#numobrasoc").innerHTML =`<samp>Nro Afiliado: <input type="text" class="" id="numafiliado_Pac" value="`+numAfiliadoOSm+`" maxlength="20"  oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" style="width:200px;"></samp><button type="button" class="peditar" onclick="modificarNumObraSocial('guardar')"> <i class="ri-save-3-line"></i></button>`;
  }else{
   var numAfiliadoOSm = $("#numafiliado_Pac").val();
   console.log('guardo'+numAfiliadoOSm);
   // envio a guardar y regreso
   GuardarModi(numAfiliadoOSm,"nroobrasocial");
   document.querySelector("#numobrasoc").innerHTML =`<samp>Nro Afiliado: <input type="text" class="" id="numafiliado_Pac" value="`+numAfiliadoOSm+`" maxlength="20"  oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" style="width:200px;" disabled></samp><button type="button" class="peditar" onclick="modificarNumObraSocial('modificar')"> <i class="ri-edit-2-line"></i></button>`; 
  }
}
</script>
<script>
function modificarTelefono(srt){
  if(srt === 'modificar'){
   var telefonom = $("#telefono_Pac").val();
   console.log(telefonom);
   document.querySelector("#celular").innerHTML =`<samp>Celular: <input type="text" class="" id="telefono_Pac" value="`+telefonom+`" maxlength="15"  oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" style="width:250px;"></samp><button type="button" class="peditar" onclick="modificarTelefono('guardar')"> <i class="ri-save-3-line"></i></button>`;
  }else{
   var telefonom = $("#telefono_Pac").val();
   console.log('guardo'+telefonom);
   // envio a guardar y regreso
   GuardarModi(telefonom,"nrocelular");
   document.querySelector("#celular").innerHTML =`<samp>Celular: <input type="text" class="" id="telefono_Pac" value="`+telefonom+`" maxlength="15"  oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" style="width:250px;" disabled></samp><button type="button" class="peditar" onclick="modificarTelefono('modificar')"> <i class="ri-edit-2-line"></i></button>`;
  }
}
</script>
<script>
function modificarEmail(srt){
  if(srt === 'modificar'){
   var emailm = $("#email_Pac").val();
   console.log(emailm);
   document.querySelector("#emailp").innerHTML =`<samp>Email: <input type="email" class="" id="email_Pac" value="`+emailm+`" maxlength="30"  oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" style="width:250px;"></samp><button type="button" class="peditar" onclick="modificarEmail('guardar')"> <i class="ri-save-3-line"></i></button>`;
  }else{
   var emailm = $("#email_Pac").val();
   console.log('guardo'+emailm);
   // envio a guardar y regreso
   GuardarModi(emailm,"email");
   document.querySelector("#emailp").innerHTML =`<samp>Email: <input type="email" class="" id="email_Pac" value="`+emailm+`" maxlength="30"  oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" style="width:250px;" disabled></samp><button type="button" class="peditar" onclick="modificarEmail('modificar')"> <i class="ri-edit-2-line"></i></button>`;
  }

} 
</script>
<script>
function GuardarModi(data,etiqueta){
  console.log("entro guardar"+data);
  var ddato = data;
  var txtetiqueta = etiqueta;
  var idpaciente = $("#id_Pac").val();
var http = new XMLHttpRequest();
http.onreadystatechange = function () {
  if(this.readyState === 4 && this.status === 200){
      var resp = this.response;
      console.log("resp"+resp);
      if(resp == "N"){
            //ver error
          }else{
            return;
      }    
  }
}  
http.open('POST', 'pacienteservis.php', true);
http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
http.send('accion=Uppaciente&etiqueta='+txtetiqueta+'&data='+ddato+'&id='+idpaciente);
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
  console.log("Ingreso a generar receta");
  var error = "";
  var errorEspecialidad = 0;
  var errorPaciente = 0;
  var errorDiagnostico = 0;
  var errorVademecum = 0;
  //especialidad
  var numMatEspec = $('select[name=especialidad]').val();
  console.log(numMatEspec);
  if(numMatEspec == 0 ){
    error = `<div class="alert alert-danger text-center" role="alert">
            Por favor seleccione una especialidad.
            </div> `;
    document.querySelector("#error").innerHTML = error;         
  }else{
    errorEspecialidad = 1;
  }

  //var nomEspec = $("#especialidad option:selected").text();
  //var numMatDoc = <?php //echo $_SESSION['matricula']?>;
  var numMatDoc = '181572';
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
  
  var obraSocialPac ="12";// $("#obrasocial_Pac").val();
  var numAfiliadoOSPac = "123"; //$("#numafiliado_Pac").val();
  // Diagnostico
  var diag = ""; 
  diag = "duro"; // $("#texDiagnostico").val();
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
//console.log(PcrObj);
//console.log(JSON.stringify(PcrObj));
remedios = JSON.stringify(PcrObj);
/*
console.log(numMatDoc);
console.log(numMatEspec);
console.log(idPac);
console.log(obraSocialPac);
console.log(diag);
console.log(remedios);
console.log(nFilas);
*/
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
          /*$( "#pieapp" ).html(' ');
          var HtmlRespPie = `
          En proceso...          
          `;
          document.querySelector("#pieapp").innerHTML = HtmlRespPie;
          */
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
<script>
function OnOffventOS(){


}

</script>  
<?php
include('template/footer.php');
?>