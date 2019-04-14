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
        "cantidad" : 5
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

});