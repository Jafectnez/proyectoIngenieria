//  FORMAS
let formaEmpleado = new Forma('agregarempleado');
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
Forma.addTrigger(formaEmpleado);

$(document).ready(function() {

  cargarSolicitudes();
  cargarEmpleados();

});

function cargarSolicitudes() {
  //Obtencion de datos del servidor
  var parametrosAjax = {
    "url": "http://laboratorio-emanuel/ajax/acciones-administracion.php",
    "method": "POST",
    "dataType": "json",
    "data": {
      "accion" : "leer-solicitudes"
    }
  };

  $.ajax(parametrosAjax).done(function (response) {
    var datos = response.data;
    //Creacion de los registros de la tabla
    for(let i in datos){
      if(datos[i] != datos.mensaje && datos[i] != datos.resultado){
        var tr = document.createElement("tr");

        var tdNombre = document.createElement("td");
        var tdDescripcion = document.createElement("td");
        var tdUsuario = document.createElement("td");
        var tdEstadoSolicitud = document.createElement("td");
        var tdFecha = document.createElement("td");
        var tdBtnAcciones = document.createElement("td");
        var btnAcciones = document.createElement("button");

        var nombre = document.createTextNode(datos[i].NOMBRE + " " + datos[i].APELLIDO);
        var descripcion = document.createTextNode(datos[i].DESCRIPCION);
        var usuario = document.createTextNode(datos[i].USUARIO);
        var estadoSolicitud = document.createTextNode(datos[i].ESTADO_SOLICITUD);
        var fecha = document.createTextNode(datos[i].FECHA);
        btnAcciones.className = "form-control";
        btnAcciones.innerText = "Ver más";
  
        tdNombre.appendChild(nombre);
        tdDescripcion.appendChild(descripcion);
        tdUsuario.appendChild(usuario);
        tdEstadoSolicitud.appendChild(estadoSolicitud);
        tdFecha.appendChild(fecha);
        tdBtnAcciones.appendChild(btnAcciones);

        tr.appendChild(tdNombre);
        tr.appendChild(tdDescripcion);
        tr.appendChild(tdUsuario);
        tr.appendChild(tdEstadoSolicitud);
        tr.appendChild(tdFecha);
        tr.appendChild(tdBtnAcciones);

        $("#table-solicitudes").append(tr);
      }
    }
  });
}

function cargarEmpleados() {
  //Obtencion de datos del servidor
  var parametrosAjax = {
    "url": "http://laboratorio-emanuel/ajax/acciones-administracion.php",
    "method": "POST",
    "dataType": "json",
    "data": {
      "accion" : "leer-empleados"
    }
  };

  $.ajax(parametrosAjax).done(function (response) {
    var datos = response.data;
    //Creacion de los registros de la tabla
    for(let i in datos){
      if(datos[i] != datos.mensaje && datos[i] != datos.resultado){
        var tr = document.createElement("tr");

        var tdNombre = document.createElement("td");
        var tdTelefono = document.createElement("td");
        var tdFechaIngreso = document.createElement("td");
        var tdBtnAcciones = document.createElement("td");
        var nombre = document.createTextNode(datos[i].NOMBRE + " " + datos[i].APELLIDO);
        var telefono = document.createTextNode(datos[i].TELEFONO);
        var fechaIngreso = document.createTextNode(datos[i].FECHA_INGRESO);
        var btnAcciones = document.createElement("button");
        btnAcciones.className = "form-control";
        btnAcciones.innerText = "Ver más";
        btnAcciones.setAttribute("data-toggle","modal");
        btnAcciones.setAttribute("data-target","#modalVerEmpleado");
        btnAcciones.onclick = verEmpleado(datos[i].ID_EMPLEADO);
        
        tdNombre.appendChild(nombre);
        tdTelefono.appendChild(telefono);
        tdFechaIngreso.appendChild(fechaIngreso);
        tdBtnAcciones.appendChild(btnAcciones);
        tr.appendChild(tdNombre);
        tr.appendChild(tdTelefono);
        tr.appendChild(tdFechaIngreso);
        tr.appendChild(tdBtnAcciones);

        $("#table-empleados").append(tr);
      }
    }
  });
}

/* CRUD Empleado: Create */
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

      "nombre": $('#nombre').val(),
      "apellido": $('#apellido').val(),
      "genero": $('#slc-genero').val(),
      "direccion": $('#direccion').val(),
      "edad": $('#edad').val(),
      "email": $('#email').val(),
      "identidad": $('#numero-identidad').val(),
      "telefono": $('#telefono').val(),
      "fecha_nacimiento": $('#fecha-nacimiento').val(),
      "fecha_ingreso": $('#fecha-ingreso').val()
    }
  }

  $.ajax(settings).done(function (response) {
    console.log(JSON.stringify(response));
  });

});

function verEmpleado(idEmpleado){
  
}

/* Buscar un Empleado 
function buscarEmpleado(id){
  $("#inputGroupFile").removeClass('is-valid');
  // Se hace el cambio del footer en el Modal
  $("#footer-guardar").hide();
  $("#footer-actualizar").removeClass("d-none");
  $("#tel-nuevo").show();

  $('.selectpicker').selectpicker('val', '');
  $('.selectpicker').selectpicker('refresh');

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
    console.log(response.data);

    $('#contrasena').prop('readonly', true);

    $('#id-empleado').val(response.data.id_empleado);
    $('#nombre').val(response.data.nombre);
    $('#apellido').val(response.data.apellido);
    $('#slc-genero').selectpicker('val', response.data.genero);
    $('#direccion').val(response.data.direccion);
    $('#email').val(response.data.email);
    $('#numero-identidad').val(response.data.numero_identidad);
    $('#telefono').val(response.data.telefono.split(',')[0]);
    $('#fecha-nacimiento').val(response.data.fecha_nacimiento);
    $('#fecha-ingreso').val(response.data.fecha_ingreso);
    formaEmpleado.validateAll();
  });
}

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

      "id_empleado": $('#id-empleado').val(),
      "nombre": $('#nombre').val(),
      "apellido": $('#apellido').val(),
      "genero": $('#slc-genero').val(),
      "direccion": $('#direccion').val(),
      "email": $('#email').val(),
      "identidad": $('#numero-identidad').val(),
      "fecha_nacimiento": $('#fecha-nacimiento').val(),
      "telefono": $('#telefono').val(),
      "fecha_ingreso": $('#fecha-ingreso').val(),
    }
  }

  $.ajax(settings).done(function (response) {
    imprimirMensaje(response);
  });

});*/

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