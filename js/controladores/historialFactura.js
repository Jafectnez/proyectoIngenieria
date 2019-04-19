$(document).ready(function(){
	cargarFacturas();
});
//Con esta funcion se cargaran todas las facturas que se encuentran en la base de datos
function cargarFacturas(){
	$.ajax({
		url: 'ajax/acciones-historial-factura.php',
		data:{'accion':'cargar-historial'},
		method:'post',
		success:function(respuesta){
			$("#tbl-cuerpo-historial").html(respuesta);
		},
		error:function(error){}
	});
}