<?php
include('template/head.php');
?>
<!-- start page title y miga de pan -->
<div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0">Pacientes</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Receta Electónica</a></li>
                                            <li class="breadcrumb-item active">Pacientes</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title y miga de pan -->
 <!-- start contenido de pagina -->
 <div class="col-xl-12">
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
    <div class="row" id="VentPaciente" style="display:none">
    <div class="col-xl-12">
        <div class="card mh-100">
 <!--- -->          
        <div id="mostrarPaciente" class="row row-cols-1 row-cols-sm-2 row-cols-md-4 card-body"> 
        <table class="table table-hover">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Fecha</th>
        <th scope="col">Médico</th>
        <th scope="col">Diagnóstico</th>
        <th scope="col">Acción</th>
        <th scope="col">Receta</th>
      </tr>
    </thead>
    <tbody id="contenidoTabla">
    </tbody>
  </table>
          
        </div>         
 <!---  -->          
        </div>   
    </div>     
</div>

<!--  Modal from Button  -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Receta Nro:</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <table class="table table-hover">
    <thead>
      <tr>
        <th scope="col">Cant</th>
        <th scope="col">Dosis x día</th>
        <th scope="col">Monodroga</th>
        <th scope="col">Comercial</th>
        <th scope="col">Presentación</th>
        <th scope="col">Laboratorio</th>
        <th scope="col">Dispensado</th>
      </tr>
    </thead>
    <tbody id="contabla">
    </tbody>
  </table>
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        
      </div>
    </div>
  </div>
</div>

 <!-- end contenido de pagina -->  
 <script>
function buscarDni(){
    console.log("entro");
    $("#mostrarNoexiste").html(' ');
        //document.querySelector("#mostrarPaciente").innerHTML = ' ';
        var numdni = '';
        numdni = $("#buscardni").val();
        console.log(numdni);
        var http = new XMLHttpRequest();
        if(numdni.length === 0){
          //vacio
            $( "#mostrarNoexiste" ).html('<p class="text-danger">Por Favor introducir un nro de DNI !</p>');
            document.getElementById("VentPaciente").style.display = "none";
        }else{
          //con nro
          http.onreadystatechange = function () {
          if (this.readyState == 4) {
              var datos=JSON.parse(this.response);
              console.log("datos: "+datos);
              var itemHtmlSi = '';
              if(datos.length === 0){
                console.log("entro vacio");
                //$("#mostrarPaciente").html(' ');
                var nvoDni = $("#buscardni").val();
                var itemHtmlNo = `<p class="text-danger fs-3"><b>Paciente inexistente...</b></p>`;
                document.getElementById("VentPaciente").style.display = "block";
                document.querySelector("#contenidoTabla").innerHTML = itemHtmlNo;
              }else{
                console.log("entro con dato");
                //document.querySelector("#contenidoTabla").innerHTML = '';
                document.getElementById("VentPaciente").style.display = "none";
                
                let recetas = datos;
                for (x of recetas) {
                    console.log(x.idreceta + ' ' + x.fechaemision);
                    
                    const formatearFecha = fecha => {
                    const mes = fecha.getMonth() + 1; // Ya que los meses los cuenta desde el 0
                    const dia = fecha.getDate();
                    return `${(dia < 10 ? '0' : '').concat(dia)}-${(mes < 10 ? '0' : '').concat(mes)}-${fecha.getFullYear()}`;
                    };
                    // formatear fecha
                    const fechaDeJson = new Date(x.fechaemision);
                    const fechaFormateada = formatearFecha(fechaDeJson);
                    //console.log(fechaFormateada);
                    itemHtmlSi  += `<tr><td scope="row">`+x.idreceta+`</td><td>`+fechaFormateada+`</td><td>`+x.apellido+` `+x.nombre+`</td><td>`+x.diagnostico+`</td><td><button type="button" class="btn btn-outline-success mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="`+x.idreceta+`">ver</button><button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal"> Ver receta</button></td> </tr>`;
                 }
                console.log("Acaaaaa "+itemHtmlSi);
                document.getElementById("VentPaciente").style.display = "block";
                document.querySelector("#contenidoTabla").innerHTML = itemHtmlSi;
              }

              
                      
           }
          }
      };
      http.open('POST', 'webservis.php', true);
      http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
  
      http.send('donde=2&nrodni='+numdni);
          
    }
</script>
<script>
const exampleModal = document.getElementById('exampleModal')
exampleModal.addEventListener('show.bs.modal', event => {
// Button that triggered the modal
const button = event.relatedTarget
// Extract info from data-bs-* attributes
const recipient = button.getAttribute('data-bs-whatever')
// Update the modal's content.
const modalTitle = exampleModal.querySelector('.modal-title')
//const modalBodyInput = exampleModal.querySelector('.modal-body input')
modalTitle.textContent = `Receta nro.: ${recipient}`
//modalBodyInput.value = recipient
var http = new XMLHttpRequest();
http.onreadystatechange = function () {
          if (this.readyState == 4) {
            console.log("receta: "+this.response);
              var datos=JSON.parse(this.response);
              console.log("datos: "+datos);
              console.log("entro con dato");
              
              itemHtmlSi = '';
                for (x of datos) {
                    //console.log(x.cantprescripta + ' ' + x.posologia);
                    var dispensado = '';
                    if(x.dispensado == 0){
                        dispensado = "NO";
                      }else{
                        dispensado = "SI";        
                      }
                    itemHtmlSi  += `<tr><td scope="row">`+x.cantprescripta+`</td><td>`+x.posologia+`</td><td>`+x.monodroga+`</td><td>`+x.nombre_comercial+`</td><td>`+x.presentacion+`</td><td>`+x.laboratorio+`</td><td>`+dispensado+`</td></tr>`;
                 }
                document.querySelector("#contabla").innerHTML = itemHtmlSi;
              }

              
                      
           }
            
      http.open('POST', 'webservis.php', true);
      http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
      http.send('donde=3&nroreceta='+recipient);





})     
</script>


<?php
include('template/footer_js.php');
include('template/footer.php');
?>