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

/* Funcion para cargar las solicitudes registradas */
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
        btnAcciones.setAttribute("data-toggle","modal");
        btnAcciones.setAttribute("data-target","#modalVerSolicitud");
        btnAcciones.setAttribute("onclick","verSolicitud("+datos[i].ID_SOLICITUD+");");
  
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

/*Funcion para cargar los empleados registrados */
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
        btnAcciones.setAttribute("onclick",`verEmpleado(${datos[i].ID_EMPLEADO});`);
        
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

  alert(JSON.stringify(settings.data));

  $.ajax(settings).done(function (response) {
    alert(response.mensaje);
  });

});

/* Funcion para ver los datos de una solicitud */
function verSolicitud(idSolicitud) {
  
}

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
    $('#usuario-actualizar').val(datosEmpleado.USUARIO);
    $('#fecha-registro-actualizar').val(datosEmpleado.FECHA_REGISTRO);
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
  $("#formulario-actualizar-empleado").addClass("hide");
  $("#datos-empleado").removeClass("hide");
  $("#actualizar-empleado").addClass("hide");
  $("#eliminar-empleado").removeClass("hide");
  $("#editar-empleado").removeClass("hide");
  /*
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
    alert(response.mensaje);
    $("#actualizar-empleado").addClass("hide");
    $("#eliminar-empleado").removeClass("hide");
  });*/

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