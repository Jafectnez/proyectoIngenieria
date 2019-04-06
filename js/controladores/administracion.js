//  FORMAS
let popUp = new Popup();
/*let popUp = new PopUp();
formaEmpleado.addInput('slc-genero');
formaEmpleado.addInput('nombre', /^[A-Z]+[A-Za-záéíóúñ]+$/, true);
formaEmpleado.addInput('apellido', /^[A-Z]+[A-Za-záéíóúñ]+$/, true);
formaEmpleado.addInput('edad', /^[1-9][0-9]{2}$/,true);
formaEmpleado.addInput('telefono',/^(2|3|8|9)[0-9]{3}\-[0-9]{4}$/,true);
formaEmpleado.addInput('email', /^[a-zA-Z0-9\._-]+@([_a-zA-Z0-9])+(\.[a-zA-Z]+)+$/, true);
formaEmpleado.addInput('fecha-nacimiento');
formaEmpleado.addInput('direccion', /.+/, true);
formaEmpleado.addInput('numero-identidad', /^(0[1-9]|1[0-8])(0[1-9]|1[0-9]|2[1-8])(19|20)[0-1][0-9][0-9]{5}$/, true);
formaEmpleado.addInput('fecha-ingreso');

formaEmpleado.setButtonEnvio('guardar-empleado');
formaEmpleado.setButtonUpdate('actualizar-empleado');
Forma.addTrigger(formaEmpleado);*/

$(document).ready(function() {

  //Carga las solicitudes registradas
  $("#table-solicitudes").DataTable({
    pageLength: 10,
    searching: true,
    ordering: true,
    paging: true,
    responsive: true,
    serverSide: true,
    ajax: {
      "url": "http://laboratorio-emanuel/ajax/acciones-administracion.php",
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
      {data: "ESTADO_SOLICITUD", title: "Estado Solicitud"},
      {data: "FECHA", title: "Fecha"},
      {data: null, title: "Acciones",
      render: function (data, type, row, meta) {
        return `<button class="form-control" data-toggle="modal" data-target="#modalVerSolicitud" onclick="verSolicitud(${row.ID_SOLICITUD});">Ver más</button>`;
      }}
    ]
  });
  
  //Carga los empleados registrados 
  $("#table-empleados").DataTable({
    pageLength: 10,
    searching: true,
    ordering: true,
    paging: true,
    responsive: true,
    serverSide: true,
    ajax: {
      "url": "http://laboratorio-emanuel/ajax/acciones-administracion.php",
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

});

/* Funcion para guardar empleado nuevo */
$('#guardar-empleado').click(function(){
  var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://laboratorio-emanuel/ajax/acciones-administracion.php",
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
    console.log(response.data.mensaje);
    $('#table-empleados').DataTable().ajax.reload();
  });

});

var idSolicitudVisible;
/* Funcion para ver los datos de una solicitud */
function verSolicitud(idSolicitud) {
  var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://laboratorio-emanuel/ajax/acciones-administracion.php",
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
  });
}

var idEmpleadoVisible;
/* Funcion para ver los datos de un empleado */
function verEmpleado(idEmpleado){
  var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://laboratorio-emanuel/ajax/acciones-administracion.php",
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

/* Editar Empleado */
$("#editar-empleado").click(function(){
  $("#formulario-actualizar-empleado").removeClass("hide");
  $("#datos-empleado").addClass("hide");
  $("#actualizar-empleado").removeClass("hide");
  $("#eliminar-empleado").addClass("hide");
  $("#editar-empleado").addClass("hide");
});

/* Actualizar empleado */
$("#actualizar-empleado").click(function(){
  var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://laboratorio-emanuel/ajax/acciones-administracion.php",
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
      "fecha_ingreso": $('#fecha-ingreso-actualizar').val(),
    }
  }

  $.ajax(settings).done(function (response) {
    if(response.data.error == "1"){
      popUp.setTexto(response.data.mensaje);
      popUp.incorrecto();
      popUp.mostrar();
    }
    else{
      popUp.setTexto(response.data.mensaje);
      popUp.correcto();
      popUp.mostrar();
      $("#formulario-actualizar-empleado").addClass("hide");
      $("#datos-empleado").removeClass("hide");
      $("#actualizar-empleado").addClass("hide");
      $("#eliminar-empleado").removeClass("hide");
      $("#editar-empleado").removeClass("hide");

      verEmpleado(idEmpleadoVisible);
    }
  });

});

/* CRUD Empleado: Delete 
function funcionBorrar(id){
  var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://laboratorio-emanuel/ajax/acciones-administracion.php",
    "method": "POST",
    "dataType": "json",
    "headers": {
      "content-type": "application/x-www-form-urlencoded"
    },
    "data": {
      "accion": "leer-empleado-id",
      "id_empleado": id
    }
  }

  $.ajax(settings).done(function (response) {
      $.confirm({
       icon: 'fa fa-trash',
       theme: 'modern',
       closeIcon: true,
       type: 'blue',
       title:'Alerta!',
       content:'¿Esta seguro de eliminar a ' + response.data.nombre_completo + ' ?',
       buttons:{
         Eliminar:{
            text:"Si, seguro!",
            btnClass:"btn-blue",
            action:function(){
              var settings = {
                "async": true,
                "crossDomain": true,
                "url": "http://farma/services/empleado.php",
                "method": "POST",
                "dataType": "json",
                "headers": {
                  "content-type": "application/x-www-form-urlencoded"
                },
                "data": {
                  "accion": "eliminar-empleado",
                  "id_empleado": id
                }
              }

              $.ajax(settings).done(function (response) {
                $.alert({
                  title: response.data.mensaje,
                  icon: 'fa fa-check',
                  type: 'blue',
                  content: '',
                });

              $('#table-empleados').DataTable().ajax.reload();
              })
            }

         },
         Cancelar:function(){

         }
       }
     })
  });
}*/
/*
function imprimirMensaje(response){
  if (response.data.error == 0) {
    console.log(response.data);
    $('#table-empleados').DataTable().ajax.reload(); // Se encarga de refrescar las tablas

    $("#div-exito").html(response.data.mensaje);
    $("#div-exito").removeClass("d-none");

    $("#div-exito").hide(8000, function(){
      $('#div-exito').addClass("d-none");
      $("#div-exito").show();
      $("#div-exito").html("");
    });
  } else {
    console.log(response);
    $("#div-error").html(response.data.mensaje);
    $("#div-error").removeClass("d-none");

    $("#div-error").hide(8000, function(){
      $('#div-error').show();
      $('#div-error').addClass("d-none");
      $("#div-error").html("");
    });
  }
}
*/
/* Función que se encarga de dejar los campos por defecto 
$(".reset").click(function(){
  $("#footer-actualizar").addClass("d-none");
  $("#footer-guardar").show();

  $('.selectpicker').selectpicker('val', '');
  $('.selectpicker').selectpicker('refresh');

  $('#telefono').prop('readonly', false); // Deshabilita los campos

  $('#id-empleado').val("");
  $('#nombre').val("");
  $('#apellido').val("");
  $('#direccion').val("");
  $('#email').val("");
  $('#numero-identidad').val("");
  $('#telefono').val("");
  $('#fecha-nacimiento').val("");
  $('#fecha-ingreso').val("");

});*/