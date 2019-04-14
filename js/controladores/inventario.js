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
      {data: "PROVEEDOR", title: "Proveedor"}
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
      {data: "PROVEEDOR", title: "Proveedor"}
    ]
  });

  cargarFormularioAgregar();

});

$("#txt-limite").on("change", function() {
  $("#table-insumos-proximos").DataTable().ajax.reload();
});

function cargarFormularioAgregar() {
  
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