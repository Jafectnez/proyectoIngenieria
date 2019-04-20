// Alerta
let popUp = new Popup();

$(document).ready(function() {

  //Carga las solicitudes registradas
  $("#table-solicitudes").DataTable({
    pageLength: 10,
    ordering: true,
    paging: true,
    responsive: true,
    serverSide: true,
    ajax: {
      "url": "ajax/acciones-administracion.php",
      "method": "POST",
      "dataType": "json",
      "data": {
        "accion" : "leer-solicitudes"
      }
    },
    columns: [
      {data: "NOMBRE", title: "Nombre"},
      {data: "DESCRIPCION", title: "Descripcion"},
      {data: "USUARIO", title: "Usuario"},
      {data: "ESTADO_SOLICITUD", title: "Estado Solicitud", 
      render: function ( data, type, row, meta ) {
        return `<b>${data}</b>`;
      }},
      {data: "FECHA", title: "Fecha"},
      {data: null, title: "Acciones",
      render: function (data, type, row, meta) {
        return `<button class="form-control" data-toggle="modal" data-target="#modalVerSolicitud" onclick="verSolicitud(${row.ID_SOLICITUD});">Ver más</button>`;
      }}
    ]
  });
  setInterval(recargarSolicitudes, 59000);
  
  //Carga los empleados registrados 
  $("#table-empleados").DataTable({
    pageLength: 10,
    ordering: true,
    paging: true,
    responsive: true,
    serverSide: true,
    ajax: {
      "url": "ajax/acciones-administracion.php",
      "method": "POST",
      "dataType": "json",
      "data": {
        "accion" : "leer-empleados"
      }
    },
    columns: [
      {data: "NOMBRE", title: "Nombre"},
      {data: "TELEFONO", title: "Teléfono"},
      {data: "FECHA_INGRESO", title: "Fecha de Ingreso"},
      {data: null, title: "Acciones",
      render: function (data, type, row, meta) {
        return `<button class="form-control" data-toggle="modal" data-target="#modalVerEmpleado" onclick="verEmpleado(${row.ID_EMPLEADO});">Ver más</button>`;
      }}
    ]
  });

  //Carga los registros de la bitácora
  $("#table-bitacora").DataTable({
    pageLength: 10,
    ordering: true,
    paging: true,
    responsive: true,
    serverSide: true,
    ajax: {
      "url": "ajax/acciones-administracion.php",
      "method": "POST",
      "dataType": "json",
      "data": {
        "accion" : "leer-bitacora"
      }
    },
    columns: [
      {data: "FECHA", title: "Fecha de registro"},
      {data: "DESCRIPCION", title: "Descripcion"},
      {data: "USUARIO", title: "Usuario Responsable del Registro"}
    ]
  });
  setInterval(recargarBitacora, 59000);

 $("#nav-adm-pro-tab").click(function(argument){
  ListExamenes();
 });

 $("#prom_ac").click(function(argument){
    var pa = 1;
    document.getElementById('prom_historico').style.display = 'none';
    document.getElementById('prom_actuales').style.display = 'block';
    parametros = {
      "ac": pa
    }
    $.ajax({
      type:  'post',
      url:   'class/promociones/promociones.php', 
      data:  parametros, 
      success:  function (response) {
        $("#prom_actuales").html(response);
      }
    });
 });

 $("#prom_h").click(function(argument){
    document.getElementById('prom_actuales').style.display = 'none';
    document.getElementById('prom_historico').style.display = 'block';
 });

}); // fin document ready

function recargarBitacora() {
  $("#table-bitacora").DataTable().ajax.reload();
}

function recargarSolicitudes() {
  $("#table-solicitudes").DataTable().ajax.reload();
}

function ListExamenes() {
  $.ajax({
    type:  'post',
    url:   'class/promociones/examenes.php', 
    data:  'parametros', 
    success:  function (response) {
      $("#selectTipo").html(response);
    }
  });
}

function AddPromos() {
  var DescripcionPromo = $("#descripcion").val();
  var RestriccionPromo = $("#restricciones").val();
  var FIPromo = $("#fecha-inicio").val();
  var FFPromo = $("#fecha-final").val();
  var idExamen = document.getElementById('selectTipo'); // esta linea y la siguiente recogen la opcion seleccionada en examen(crear promocion)
  var idExam = idExamen.options[idExamen.selectedIndex].value;
  var parametrosPromo = {
  "des": DescripcionPromo,
  "res": RestriccionPromo,
  "fi": FIPromo,
  "ff": FFPromo,
  "ie": idExam
  };
  $.ajax({
    type: 'post',
    url: 'class/promociones/Add-promo.php',
    data: parametrosPromo,
    success: function(response) {
      if (response == 1) {
        $("#msj2").html("Promoción agregada con exito");
        window.setTimeout(function() { 
          $("#msj2").html("");
        }, 2500);
      } else {
        $("#msj").html("No se pudo agregar la nueva promoción, inténtelo nuevamente, si el fallo persiste póngase en contacto con el administrador del sistema.");
        window.setTimeout(function() { 
          $("#msj").html("");
        }, 5000);
      }
    }
  });
} // funcion AddPromos

function validarEmpleado(parametros) {
  var control = true
  var regexEmpleado = {
                "nombre": /((^[A-Z]+[A-Za-záéíóúñ]+)((\s)(^[A-Z]+[A-Za-záéíóúñ]+)))*$/,
                "apellido": /((^[A-Z]+[A-Za-záéíóúñ]+)((\s)(^[A-Z]+[A-Za-záéíóúñ]+)))*$/,
                "genero": /[1-3]$/,
                "direccion": /((^[A-Za-záéíóúñ0-9]+)((\s)(^[A-Z]+[A-Za-záéíóúñ0-9]+)))*$/,
                "edad": /^[1-9][0-9]$/,
                "email": /^[a-zA-Z0-9\._-]+@([_a-zA-Z0-9])+(\.[a-zA-Z]+)+$/,
                "identidad": /^(0[1-9][0-9]{2}|1[0-8][0-9]{2})(19[4-9][0-9]|20[0-1][0-9])[0-9]{5}$/,
                "telefono": /^(2|3|8|9)[0-9]{3}\-[0-9]{4}$/,
                "fecha_nacimiento": /^(19[6-9][0-9]|200[0-9])\-(0[0-9]|1[0-2])\-([0-2][0-9]|3[0-1])$/,
                "fecha_ingreso": /^(19[6-9][0-9]|20[0-1][0-9])\-(0[0-9]|1[0-2])\-([0-2][0-9]|3[0-1])$/
              };
  
  for(let i in parametros){
    if(!validarCampoVacio(parametros[i], regexEmpleado[i])) 
      control = false;
  }

  return control;
}

var idSolicitudVisible;
/* Funcion para ver los datos de una solicitud */
function verSolicitud(idSolicitud) {
  var settings = {
    "async": true,
    "crossDomain": true,
    "url": "ajax/acciones-administracion.php",
    "method": "POST",
    "dataType": "json",
    "headers": {
      "content-type": "application/x-www-form-urlencoded"
    },
    "data": {
      "accion": "leer-solicitud-id",

      "id_solicitud": parseInt(idSolicitud)
    }
  }

  $.ajax(settings).done(function (response) {
    datosSolicitud = response.data;
    $('#solicitante').text(`${datosSolicitud.NOMBRE} ${datosSolicitud.APELLIDO}`);
    $('#descripcion-solicitud').text(datosSolicitud.DESCRIPCION);
    $('#usuario-solicitante').text(datosSolicitud.USUARIO);
    $('#email-solicitante').text(datosSolicitud.EMAIL);
    $('#estado-solicitud').text(datosSolicitud.ESTADO_SOLICITUD);
    $('#fecha-solicitud').text(datosSolicitud.FECHA);

    idSolicitudVisible = idSolicitud;

    if(datosSolicitud.ID_ESTADO_SOLICITUD == 2)
      $('#estado-solicitud').css("color", "rgb(255,0,0)");
    else if(datosSolicitud.ID_ESTADO_SOLICITUD == 3)
      $('#estado-solicitud').css("color", "rgb(0,255,0)");

    if(datosSolicitud.ID_ESTADO_SOLICITUD != 1){
      $("#denegar-solicitud").addClass("hide");
      $("#aceptar-solicitud").addClass("hide");
    }
  });
}

var idEmpleadoVisible;
/* Funcion para ver los datos de un empleado */
function verEmpleado(idEmpleado){
  var settings = {
    "async": true,
    "crossDomain": true,
    "url": "ajax/acciones-administracion.php",
    "method": "POST",
    "dataType": "json",
    "headers": {
      "content-type": "application/x-www-form-urlencoded"
    },
    "data": {
      "accion": "leer-empleado-id",

      "id_empleado": parseInt(idEmpleado)
    }
  }

  $.ajax(settings).done(function (response) {
    datosEmpleado = response.data;
    $('#spn-nombre').text(datosEmpleado.NOMBRE);
    $('#spn-apellido').text(datosEmpleado.APELLIDO);
    $('#spn-genero').text(datosEmpleado.GENERO);
    $('#spn-direccion').text(datosEmpleado.DIRECCION);
    $('#spn-edad').text(datosEmpleado.EDAD);
    $('#spn-email').text(datosEmpleado.EMAIL);
    $('#spn-numero-identidad').text(datosEmpleado.IDENTIDAD);
    $('#spn-telefono').text(datosEmpleado.TELEFONO);
    $('#spn-fecha-ingreso').text(datosEmpleado.FECHA_INGRESO);
    $('#spn-fecha-nacimiento').text(datosEmpleado.FECHA_NAC);
    $('#spn-usuario').text(datosEmpleado.USUARIO);
    $('#spn-fecha-registro').text(datosEmpleado.FECHA_REGISTRO);
    
    $('#nombre-actualizar').val(datosEmpleado.NOMBRE);
    $('#apellido-actualizar').val(datosEmpleado.APELLIDO);
    $('#slc-genero-actualizar option[value="'+datosEmpleado.ID_GENERO+'"]').attr("selected",true);
    $('#direccion-actualizar').val(datosEmpleado.DIRECCION);
    $('#edad-actualizar').val(datosEmpleado.EDAD);
    $('#email-actualizar').val(datosEmpleado.EMAIL);
    $('#numero-identidad-actualizar').val(datosEmpleado.IDENTIDAD);
    $('#telefono-actualizar').val(datosEmpleado.TELEFONO);
    $('#fecha-ingreso-actualizar').val(datosEmpleado.FECHA_INGRESO);
    $('#fecha-nacimiento-actualizar').val(datosEmpleado.FECHA_NAC);

    idEmpleadoVisible = idEmpleado;
  });
}

/* Funcion para guardar empleado nuevo */
$('#guardar-empleado').click(function(){
  parametros = {
                "nombre": 'nombre-fAgregar',
                "apellido": 'apellido-fAgregar',
                "genero": 'slc-genero-fAgregar',
                "direccion": 'direccion-fAgregar',
                "edad": 'edad-fAgregar',
                "email": 'email-fAgregar',
                "identidad": 'numero-identidad-fAgregar',
                "telefono": 'telefono-fAgregar',
                "fecha_nacimiento": 'fecha-nacimiento-fAgregar',
                "fecha_ingreso": 'fecha-ingreso-fAgregar'
              };

  validacion = validarEmpleado(parametros);
  if(validacion){
    var settings = {
      "async": true,
      "crossDomain": true,
      "url": "ajax/acciones-administracion.php",
      "method": "POST",
      "dataType": "json",
      "headers": {
        "content-type": "application/x-www-form-urlencoded"
      },
      "data": {
        "accion": "insertar-empleado",
  
        "nombre": $('#nombre-fAgregar').val(),
        "apellido": $('#apellido-fAgregar').val(),
        "genero": $('#slc-genero-fAgregar').val(),
        "direccion": $('#direccion-fAgregar').val(),
        "edad": $('#edad-fAgregar').val(),
        "email": $('#email-fAgregar').val(),
        "identidad": $('#numero-identidad-fAgregar').val(),
        "telefono": $('#telefono-fAgregar').val(),
        "fecha_nacimiento": $('#fecha-nacimiento-fAgregar').val(),
        "fecha_ingreso": $('#fecha-ingreso-fAgregar').val()
      }
    }
  
    $.ajax(settings).done(function (response) {
      if(response.data.error == "1"){
        popUp.setTextoAlerta(response.data.mensaje);
        popUp.incorrecto();
        popUp.mostrarAlerta();
      }
      else{
        popUp.setTextoAlerta(response.data.mensaje);
        popUp.correcto();
        popUp.mostrarAlerta();
        $('#table-empleados').DataTable().ajax.reload();
      }
    });
  }else{
    popUp.setTextoAlerta("Formato incorrecto en un dato, verifique e intente nuevamente");
    popUp.incorrecto();
    popUp.mostrarAlerta();
  }

});

$("#atras").on("click", function(){
  verEmpleado(idEmpleadoVisible);
  $("#formulario-actualizar-empleado").addClass("hide");
  $("#datos-empleado").removeClass("hide");
  $("#actualizar-empleado").addClass("hide");
  $("#atras").addClass("hide");
  $("#editar-empleado").removeClass("hide");
});

/* Editar Empleado */
$("#editar-empleado").click(function(){
  $("#formulario-actualizar-empleado").removeClass("hide");
  $("#datos-empleado").addClass("hide");
  $("#actualizar-empleado").removeClass("hide");
  $("#atras").removeClass("hide");
  $("#eliminar-empleado").addClass("hide");
  $("#editar-empleado").addClass("hide");
});

/* Actualizar empleado */
$("#actualizar-empleado").click(function(){
  parametros = {
                "nombre": 'nombre-actualizar',
                "apellido": 'apellido-actualizar',
                "genero": 'slc-genero-actualizar',
                "direccion": 'direccion-actualizar',
                "edad": 'edad-actualizar',
                "email": 'email-actualizar',
                "identidad": 'numero-identidad-actualizar',
                "telefono": 'telefono-actualizar',
                "fecha_nacimiento": 'fecha-nacimiento-actualizar',
                "fecha_ingreso": 'fecha-ingreso-actualizar'
              };

  validacion = validarEmpleado(parametros);
  if(validacion){
    var settings = {
      "async": true,
      "crossDomain": true,
      "url": "ajax/acciones-administracion.php",
      "method": "POST",
      "dataType": "json",
      "headers": {
        "content-type": "application/x-www-form-urlencoded"
      },
      "data": {
        "accion": "actualizar-empleado",

        "id_empleado": idEmpleadoVisible,
        "nombre": $('#nombre-actualizar').val(),
        "apellido": $('#apellido-actualizar').val(),
        "genero": $('#slc-genero-actualizar').val(),
        "direccion": $('#direccion-actualizar').val(),
        "edad": $('#edad-actualizar').val(),
        "email": $('#email-actualizar').val(),
        "numero_identidad": $('#numero-identidad-actualizar').val(),
        "fecha_nacimiento": $('#fecha-nacimiento-actualizar').val(),
        "telefono": $('#telefono-actualizar').val(),
        "fecha_ingreso": $('#fecha-ingreso-actualizar').val()
      }
    }

    $.ajax(settings).done(function (response) {
      if(response.data.error == "1"){
        popUp.setTextoAlerta(response.data.mensaje);
        popUp.incorrecto();
        popUp.mostrarAlerta();
      }
      else{
        popUp.setTextoAlerta(response.data.mensaje);
        popUp.correcto();
        popUp.mostrarAlerta();
        $("#formulario-actualizar-empleado").addClass("hide");
        $("#datos-empleado").removeClass("hide");
        $("#actualizar-empleado").addClass("hide");
        $("#atras").addClass("hide");
        $("#eliminar-empleado").removeClass("hide");
        $("#editar-empleado").removeClass("hide");
        $('#table-empleados').DataTable().ajax.reload();

        verEmpleado(idEmpleadoVisible);
      }
    });
  }else{
    popUp.setTextoAlerta("Formato incorrecto en un dato, verifique e intente nuevamente");
    popUp.incorrecto();
    popUp.mostrarAlerta();
  }

});

/* Eliminar empleado*/ 
$("#eliminar-empleado").click(function(){
  popUp.setTextoDecision('Desea eliminar?');
  Popup.mantenerDecision();
  $("#decision-no").click(function() { 
    Popup.ocultarDecision();
  });

  $("#decision-si").click(function() {
    Popup.ocultarDecision();
    var settings = {
      "async": true,
      "crossDomain": true,
      "url": "ajax/acciones-administracion.php",
      "method": "POST",
      "dataType": "json",
      "headers": {
        "content-type": "application/x-www-form-urlencoded"
      },
      "data": {
        "accion": "eliminar-empleado",
        "id_empleado": idEmpleadoVisible
      }
    }
  
    $.ajax(settings).done(function (response) {
      if(response.data.error == "1"){
        popUp.setTextoAlerta(response.data.mensaje);
        popUp.incorrecto();
        popUp.mostrarAlerta();
      }
      else{
        popUp.setTextoAlerta(response.data.mensaje);
        popUp.correcto();
        popUp.mostrarAlerta();
        $('#table-empleados').DataTable().ajax.reload();

        setTimeout(function(){
          $("#modalVerEmpleado").modal('hide');
          $('body').removeClass('modal-open');
          $('.modal-backdrop').remove();
        }, 1000);
      }
    });
  });
});

/* Aceptar solicitud */
$("#aceptar-solicitud").click(function(){
  var settings = {
    "async": true,
    "crossDomain": true,
    "url": "ajax/acciones-administracion.php",
    "method": "POST",
    "dataType": "json",
    "headers": {
      "content-type": "application/x-www-form-urlencoded"
    },
    "data": {
      "accion": "aceptar-solicitud",

      "id_solicitud": idSolicitudVisible
    }
  }

  $.ajax(settings).done(function (response) {
    if(response.data.error == "1"){
      popUp.setTextoAlerta(response.data.mensaje);
      popUp.incorrecto();
      popUp.mostrarAlerta();
    }
    else{
      popUp.setTextoAlerta(response.data.mensaje);
      popUp.correcto();
      popUp.mostrarAlerta();
      $("#denegar-solicitud").addClass("hide");
      $('#table-solicitudes').DataTable().ajax.reload();

      verSolicitud(idSolicitudVisible);
    }
  });

});

/* Denegar solicitud */
$("#denegar-solicitud").click(function(){
  var settings = {
    "async": true,
    "crossDomain": true,
    "url": "ajax/acciones-administracion.php",
    "method": "POST",
    "dataType": "json",
    "headers": {
      "content-type": "application/x-www-form-urlencoded"
    },
    "data": {
      "accion": "denegar-solicitud",

      "id_solicitud": idSolicitudVisible
    }
  }

  $.ajax(settings).done(function (response) {
    if(response.data.error == "1"){
      popUp.setTextoAlerta(response.data.mensaje);
      popUp.incorrecto();
      popUp.mostrarAlerta();
    }
    else{
      popUp.setTextoAlerta(response.data.mensaje);
      popUp.correcto();
      popUp.mostrarAlerta();
      $("#aceptar-solicitud").addClass("hide");
      $('#table-solicitudes').DataTable().ajax.reload();

      verSolicitud(idSolicitudVisible);
    }
  });

});
