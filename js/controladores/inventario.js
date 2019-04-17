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
      "url": "ajax/acciones-inventario.php",
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
      "url": "ajax/acciones-inventario.php",
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
    "url": "ajax/acciones-inventario.php",
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
    "url": "ajax/acciones-inventario.php",
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
      for(var i in response.data){
        var option = document.createElement("option");
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
  var settings = {
    "async": true,
    "crossDomain": true,
    "url": "ajax/acciones-inventario.php",
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
    $(`#spn-nombre-insumo`).text(datosInsumo.INSUMO);
    $(`#spn-slc-tipo-insumo`).text(datosInsumo.TIPO_INSUMO);
    $(`#spn-cantidad-insumo`).text(datosInsumo.CANTIDAD);
    $(`#spn-precio-costo`).text(datosInsumo.PRECIO_COSTO);
    $(`#spn-descripcion-insumo`).text(datosInsumo.DESCRIPCION);
    $(`#spn-slc-proveedor-insumo`).text(datosInsumo.PROVEEDOR);
    $(`#spn-fecha-ingreso-insumo`).text(datosInsumo.FECHA_INGRESO);
    $(`#spn-fecha-vencimiento-insumo`).text(datosInsumo.FECHA_VENC);
    
    $(`#nombre-insumo-actualizar`).val(datosInsumo.INSUMO);
    $(`#slc-tipo-insumo-actualizar option[value="${datosInsumo.ID_TIPO_INSUMO}"]`).attr("selected",true);
    $(`#cantidad-insumo-actualizar`).val(datosInsumo.CANTIDAD);
    $(`#precio-costo`).val(datosInsumo.PRECIO_COSTO);
    $(`#descripcion-insumo-actualizar`).val(datosInsumo.DESCRIPCION);
    $(`#slc-proveedor-insumo-actualizar option[value="${datosInsumo.ID_PROVEEDOR}"]`).attr("selected",true);
    $(`#fecha-ingreso-insumo-actualizar`).val(datosInsumo.FECHA_INGRESO);
    $(`#fecha-vencimiento-insumo-actualizar`).val(datosInsumo.FECHA_VENC);

    $("#spn-nombre-insumo-disminuir").text(datosInsumo.INSUMO);
    $("#spn-cantidad-insumo-disminuir").text(datosInsumo.CANTIDAD);
    
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
      "url": "ajax/acciones-inventario.php",
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

$("#atras").on("click", function(){
  verInsumo(idInsumoVisible);
  $("#formulario-actualizar-insumo").addClass("hide");
  $("#formulario-disminuir-insumo").addClass("hide");
  $("#datos-insumo").removeClass("hide");
  $("#actualizar-insumo").addClass("hide");
  $("#atras").addClass("hide");
  $("#editar-insumo").removeClass("hide");
  $("#disminuir-insumo").removeClass("hide");
});

/* Editar Insumo */
$("#editar-insumo").click(function(){
  $("#formulario-actualizar-insumo").removeClass("hide");
  $("#datos-insumo").addClass("hide");
  $("#actualizar-insumo").removeClass("hide");
  $("#atras").removeClass("hide");
  $("#editar-insumo").addClass("hide");
  $("#disminuir-insumo").addClass("hide");
});

/* Habilitar Formulario Disminuir Insumo */
$("#disminuir-insumo").click(function(){
  $("#formulario-disminuir-insumo").removeClass("hide");
  $("#datos-insumo").addClass("hide");
  $("#atras").removeClass("hide");
  $("#editar-insumo").addClass("hide");
  $("#disminuir-insumo").addClass("hide");
});

/* Actualizar insumo */
$("#actualizar-insumo").click(function(){
  parametros = {
                "nombre": 'nombre-insumo-actualizar',
                "id_tipo_insumo": 'slc-tipo-insumo-actualizar',
                "cantidad": 'cantidad-insumo-actualizar',
                "precio": 'precio-costo',
                "descripcion": 'descripcion-insumo-actualizar',
                "id_proveedor": 'slc-proveedor-insumo-actualizar',
                "fecha_ingreso": 'fecha-ingreso-insumo-actualizar',
                "fecha_vencimiento": 'fecha-vencimiento-insumo-actualizar'
              };

  validacion = validarInsumo(parametros);
  if(validacion){
    var settings = {
      "async": true,
      "crossDomain": true,
      "url": "ajax/acciones-inventario.php",
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
        "precio": $('#precio-costo').val(),
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
        $("#atras").addClass("hide");
        $("#editar-insumo").removeClass("hide");
        $("#disminuir-insumo").removeClass("hide");
        $('#table-insumos').DataTable().ajax.reload();
        $('#table-insumos-proximos').DataTable().ajax.reload();

        verInsumo(idInsumoVisible);
      }
    });
  }else{
    popUp.setTextoAlerta("Formato incorrecto en un dato, verifique e intente nuevamente");
    popUp.incorrecto();
    popUp.mostrarAlerta();
  }

});

$("#cantidad-disminuir").on("change", function(){
  if(validarCampoVacio("cantidad-disminuir", /^[0-9]+$/)){
    $("#spn-nueva-cantidad-insumo").text(parseInt($("#spn-cantidad-insumo-disminuir").text()) - $("#cantidad-disminuir").val());
  }else{
    $("#cantidad-disminuir").css("color", "red");
    $("#cantidad-disminuir").css("border", "1px solid red");
    setTimeout(function(){    
      $("#cantidad-disminuir").css("color", "");
      $("#cantidad-disminuir").css("border", "");
    }, 2000);
  }
});

function disminuirInsumo() {
  if(validarCampoVacio("cantidad-disminuir", /^[0-9]+$/)){
    var cantidadVieja = parseInt($("#spn-cantidad-insumo-disminuir").text());
    var cantidadDisminuir = $("#cantidad-disminuir").val(); 
    var nuevaCantidad =  cantidadVieja - cantidadDisminuir;

    if(nuevaCantidad > 0){
      popUp.setTextoDecision('Desea disminuir?');
      Popup.mantenerDecision();
      $("#decision-no").on("click", function() { 
        Popup.ocultarDecision();
        $("#decision-no").off();
        $("#decision-si").off();
      });

      $("#decision-si").on("click", function() {
        Popup.ocultarDecision();
        
        var settings = {
          "async": true,
          "crossDomain": true,
          "url": "ajax/acciones-inventario.php",
          "method": "POST",
          "dataType": "json",
          "headers": {
            "content-type": "application/x-www-form-urlencoded"
          },
          "data": {
            "accion": "disminuir-insumo",

            "id_insumo": idInsumoVisible,
            "cantidad": cantidadDisminuir
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
            $("#formulario-disminuir-insumo").addClass("hide");
            $("#datos-insumo").removeClass("hide");
            $("#actualizar-insumo").addClass("hide");
            $("#atras").addClass("hide");
            $("#editar-insumo").removeClass("hide");
            $("#disminuir-insumo").removeClass("hide");
            $('#table-insumos').DataTable().ajax.reload();
            $('#table-insumos-proximos').DataTable().ajax.reload();

            verInsumo(idInsumoVisible);
            $("#decision-no").off();
            $("#decision-si").off();
          }
        });
      });
    }else{
      popUp.setTextoAlerta("La cantidad a disminuir es mayor que la cantidad actual");
      popUp.incorrecto();
      popUp.mostrarAlerta();
    }
  }else{
    popUp.setTextoAlerta("Formato incorrecto en un dato, verifique e intente nuevamente");
    popUp.incorrecto();
    popUp.mostrarAlerta();
  }
}