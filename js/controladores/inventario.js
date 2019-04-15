// Alerta
let popUp = new Popup();

$(document).ready(function() {

  //Carga los insumos con menor cantidad disponible
  $("#table-insumos-proximos").DataTable({
    pageLength: 10,
    ordering: true,
    paging: true,
    responsive: true,
    serverSide: true,
    ajax: {
      "url": "http://laboratorio-emanuel/ajax/acciones-inventario.php",
      "method": "POST",
      "dataType": "json",
      "data": {
        "accion" : "leer-insumos-proximos",
        "cantidad" : function(){
            regex = /^[0-9]+$/;
            if(regex.exec($("#txt-limite").val())){
              $("#txt-limite").css('color', '');
              $("#txt-limite").css('border', '');
              $("#txt-limite").addClass("form-control");
              return parseInt($("#txt-limite").val())
            } else{
              popUp.setTextoAlerta("Error en la cantidad ingresada, debe ser un número válido");
              popUp.incorrecto();
              popUp.mostrarAlerta();
              $("#txt-limite").css('color', 'red');
              $("#txt-limite").css('border', 'solid 1px red');
            }
          }
      }
    },
    columns: [
      {data: "ID_INSUMO", title: "Código", 
      render: function ( data, type, row, meta ) {
        return `<b>${data}</b>`;
      }},
      {data: "INSUMO", title: "Insumo"},
      {data: "TIPO_INSUMO", title: "Tipo Insumo"},
      {data: "CANTIDAD", title: "Cantidad Disponible"},
      {data: "PRECIO_COSTO", title: "Precio Aproximado"},
      {data: "PROVEEDOR", title: "Proveedor"},
      {data: null, title: "Acciones",
      render: function (data, type, row, meta) {
        return `<button class="form-control" data-toggle="modal" data-target="#modalVerInsumo" onclick="verInsumo(${row.ID_INSUMO});">Ver más</button>`;
      }}
    ]
  });
  
  //Carga los insumos
  $("#table-insumos").DataTable({
    pageLength: 10,
    ordering: true,
    paging: true,
    responsive: true,
    serverSide: true,
    ajax: {
      "url": "http://laboratorio-emanuel/ajax/acciones-inventario.php",
      "method": "POST",
      "dataType": "json",
      "data": {
        "accion" : "leer-insumos"
      }
    },
    columns: [
      {data: "ID_INSUMO", title: "Código", 
      render: function ( data, type, row, meta ) {
        return `<b>${data}</b>`;
      }},
      {data: "INSUMO", title: "Insumo"},
      {data: "TIPO_INSUMO", title: "Tipo Insumo"},
      {data: "CANTIDAD", title: "Cantidad Disponible"},
      {data: "PRECIO_COSTO", title: "Precio Aproximado"},
      {data: "PROVEEDOR", title: "Proveedor"},
      {data: null, title: "Acciones",
      render: function (data, type, row, meta) {
        return `<button class="form-control" data-toggle="modal" data-target="#modalVerInsumo" onclick="verInsumo(${row.ID_INSUMO});">Ver más</button>`;
      }}
    ]
  });

  cargarFormulario();

});

$("#txt-limite").on("change", function() {
  $("#table-insumos-proximos").DataTable().ajax.reload();
});

function cargarFormulario() {
  
  var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://laboratorio-emanuel/ajax/acciones-inventario.php",
    "method": "POST",
    "dataType": "json",
    "headers": {
      "content-type": "application/x-www-form-urlencoded"
    },
    "data": {
      "accion": "leer-tipos-insumo"
    }
  }

  $.ajax(settings).done(function (response) {
    if(response.data.error == "1"){
      popUp.setTextoAlerta("Ocurrió un error en el servidor");
      popUp.incorrecto();
      popUp.mostrarAlerta();
    }
    else{
      for(var i in response.data){
        var option = document.createElement("option");
        option.value = response.data[i].ID_TIPO_INSUMO;
        option.innerText = response.data[i].TIPO_INSUMO;
        $('#slc-tipo-insumo').append(option);
        $('#slc-tipo-insumo-actualizar').append(option);
      }
    }
  });

  var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://laboratorio-emanuel/ajax/acciones-inventario.php",
    "method": "POST",
    "dataType": "json",
    "headers": {
      "content-type": "application/x-www-form-urlencoded"
    },
    "data": {
      "accion": "leer-proveedores"
    }
  }

  $.ajax(settings).done(function (response) {
    if(response.data.error == "1"){
      popUp.setTextoAlerta("Ocurrió un error en el servidor");
      popUp.incorrecto();
      popUp.mostrarAlerta();
    }
    else{
      var option = document.createElement("option");
      for(var i in response.data){
        option.value = response.data[i].ID_PROVEEDOR;
        option.innerText = response.data[i].PROVEEDOR;
        $('#slc-proveedor-insumo').append(option);
        $('#slc-proveedor-insumo-actualizar').append(option);
      }
    }
  });
}

function validarInsumo(parametros) {
  var control = true
  var regexInsumo = {
                "nombre": /((^[A-Z]+[A-Za-záéíóúñ]+)((\s)(^[A-Z]+[A-Za-záéíóúñ]+)))*/,
                "id_tipo_insumo": /^[1-9][0-9]*$/,
                "cantidad": /[0-9]+$/,
                "precio": /^([0-9]+)\.[0-9]+$/,
                "descripcion": /((^[A-Za-záéíóúñ0-9]+)((\s)(^[A-Z]+[A-Za-záéíóúñ0-9]+)))*$/,
                "id_proveedor": /^[1-9][0-9]*$/,
                "fecha_ingreso": /^(19[6-9][0-9]|20[0-1][0-9])\-(0[0-9]|1[0-2])\-([0-2][0-9]|3[0-1])$/,
                "fecha_vencimiento": /^([0-9]{4})\-(0[0-9]|1[0-2])\-([0-2][0-9]|3[0-1])$/
              };
  
  for(let i in parametros){
    if(!validarCampoVacio(parametros[i], regexInsumo[i])) 
      control = false;
  }

  return control;
}

var idInsumoVisible;
/* Funcion para ver los datos de un insumo */
function verInsumo(idInsumo) {
  parametros = {
                "nombre": 'nombre-insumo',
                "id_tipo_insumo": 'slc-tipo-insumo',
                "cantidad": 'cantidad-insumo',
                "precio": 'precio-costo',
                "descripcion": 'descripcion-insumo',
                "id_proveedor": 'slc-proveedor-insumo',
                "fecha_ingreso": 'fecha-ingreso-insumo',
                "fecha_vencimiento": 'fecha-vencimiento-insumo'
              };
  var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://laboratorio-emanuel/ajax/acciones-inventario.php",
    "method": "POST",
    "dataType": "json",
    "headers": {
      "content-type": "application/x-www-form-urlencoded"
    },
    "data": {
      "accion": "leer-insumos-id",

      "id_insumo": parseInt(idInsumo)
    }
  }

  $.ajax(settings).done(function (response) {
    datosInsumo = response.data;
    $(`#spn-${parametros.nombre}`).text(datosInsumo.INSUMO);
    $(`#spn-${parametros.id_tipo_insumo}`).text(datosInsumo.TIPO_INSUMO);
    $(`#spn-${parametros.cantidad}`).text(datosInsumo.CANTIDAD);
    $(`#spn-${parametros.precio}`).text(datosInsumo.PRECIO_COSTO);
    $(`#spn-${parametros.descripcion}`).text(datosInsumo.DESCRIPCION);
    $(`#spn-${parametros.id_preveedor}`).text(datosInsumo.PROVEEDOR);
    $(`#spn-${parametros.fecha_ingreso}`).text(datosInsumo.FECHA_INGRESO);
    $(`#spn-${parametros.fecha_vencimiento}`).text(datosInsumo.FECHA_VENC);
    
    $(`#${parametros.nombre}-actualizar`).val(datosInsumo.INSUMO);
    $(`#${parametros.id_tipo_insumo}-actualizar option[value="${datosInsumo.ID_TIPO_INSUMO}"]`).attr("selected",true);
    $(`#${parametros.cantidad}-actualizar`).val(datosInsumo.CANTIDAD);
    $(`#${parametros.precio}-actualizar`).val(datosInsumo.PRECIO_COSTO);
    $(`#${parametros.descripcion}-actualizar`).val(datosInsumo.DESCRIPCION);
    $(`#${parametros.id_proveedor}-actualizar option[value="${datosInsumo.ID_PROVEEDOR}"]`).attr("selected",true);
    $(`#${parametros.fecha_ingreso}-actualizar`).val(datosInsumo.FECHA_INGRESO);
    $(`#${parametros.fecha_vencimiento}-actualizar`).val(datosInsumo.FECHA_VENC);

    idInsumoVisible = idInsumo;
  });
}

$("#guardar-insumo").on("click", function(){
  parametros = {
                "nombre": 'nombre-insumo',
                "id_tipo_insumo": 'slc-tipo-insumo',
                "cantidad": 'cantidad-insumo',
                "precio": 'precio-costo',
                "descripcion": 'descripcion-insumo',
                "id_proveedor": 'slc-proveedor-insumo',
                "fecha_ingreso": 'fecha-ingreso-insumo',
                "fecha_vencimiento": 'fecha-vencimiento-insumo'
              };

  validacion = validarInsumo(parametros);
  if(validacion){
    var settings = {
      "async": true,
      "crossDomain": true,
      "url": "http://laboratorio-emanuel/ajax/acciones-inventario.php",
      "method": "POST",
      "dataType": "json",
      "headers": {
        "content-type": "application/x-www-form-urlencoded"
      },
      "data": {
        "accion": "insertar-insumo",
  
        "nombre": $('#nombre-insumo').val(),
        "id_tipo_insumo": $('#slc-tipo-insumo').val(),
        "id_proveedor": $('#slc-proveedor-insumo').val(),
        "cantidad": $('#cantidad-insumo').val(),
        "precio": $('#precio-costo').val(),
        "descripcion": $('#descripcion-insumo').val(),
        "fecha_ingreso": $('#fecha-ingreso-insumo').val(),
        "fecha_vencimiento": $('#fecha-vencimiento-insumo').val()
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
        $('#table-insumos').DataTable().ajax.reload();
      }
    });
  }else{
    popUp.setTextoAlerta("Datos vacios o formato incorrecto en un dato, verifique e intente nuevamente");
    popUp.incorrecto();
    popUp.mostrarAlerta();
  }
});

/* Editar Insumo */
$("#editar-insumo").click(function(){
  $("#formulario-actualizar-insumo").removeClass("hide");
  $("#datos-insumo").addClass("hide");
  $("#actualizar-insumo").removeClass("hide");
  $("#editar-insumo").addClass("hide");
});

/* Actualizar insumo */
$("#actualizar-insumo").click(function(){
  parametros = {
                "nombre": 'nombre-insumo',
                "id_tipo_insumo": 'slc-tipo-insumo',
                "cantidad": 'cantidad-insumo',
                "precio": 'precio-costo',
                "descripcion": 'descripcion-insumo',
                "id_proveedor": 'slc-proveedor-insumo',
                "fecha_ingreso": 'fecha-ingreso-insumo',
                "fecha_vencimiento": 'fecha-vencimiento-insumo'
              };

  validacion = validarInsumo(parametros);
  if(validacion){
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
        "accion": "actualizar-insumo",

        "id_insumo": idInsumoVisible,
        "nombre": $('#nombre-insumo-actualizar').val(),
        "id_tipo_insumo": $('#slc-tipo-insumo-actualizar').val(),
        "cantidad": $('#cantidad-insumo-actualizar').val(),
        "precio": $('#precio-costo-actualizar').val(),
        "descripcion": $('#descripcion-insumo-actualizar').val(),
        "id_proveedor": $('#slc-proveedor-insumo-actualizar').val(),
        "fecha_ingreso": $('#fecha-ingreso-insumo-actualizar').val(),
        "fecha_vencimiento": $('#fecha-vencimiento-insumo-actualizar').val()
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
        $("#formulario-actualizar-insumo").addClass("hide");
        $("#datos-insumo").removeClass("hide");
        $("#actualizar-insumo").addClass("hide");
        $("#editar-insumo").removeClass("hide");

        verInsumo(idInsumoVisible);
      }
    });
  }else{
    popUp.setTextoAlerta("Formato incorrecto en un dato, verifique e intente nuevamente");
    popUp.incorrecto();
    popUp.mostrarAlerta();
  }

});