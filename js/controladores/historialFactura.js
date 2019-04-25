$(document).ready(function(){
	$("#btn-regresar-atras").hide();
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

function buscarFactura(){
	//Funcion que permite realizar la busqueda de acuerdo a una fecha de inicio
	var fechaDesde = $("#txt-fecha-desde").val();
	var fechaHasta = $("#txt-fecha-hasta").val();

	if((fechaHasta == '' || fechaDesde == '') || (fechaDesde > fechaHasta)){
		$.confirm({
		    title: 'Fechas inválidas',
		    content: 'Por favor seleccione un rango de búsqueda válido...',
		    type: 'blue',
		    typeAnimated: true,
		    buttons: {
		        ok: function () {
		        },
		    }
		});
	}
	else{
		$.ajax({
			async: true,
			crossDomain:true,
			url:'ajax/acciones-historial-factura.php',
			method:'POST',
			data:{
        	        'accion' : 'cargar-historial-segun-fechas',
        	        'fechaDesde' : fechaDesde,
        	        'fechaHasta' : fechaHasta
     		},
			success:function(respuesta){
				$("#tbl-cuerpo-historial").html(respuesta);
				$("#btn-regresar-atras").show();
			},
			error:function(error){
				console.log(error);
			}

		});
	}
}

function regresarAtras(){
	$("#btn-regresar-atras").hide();
	cargarFacturas();

}