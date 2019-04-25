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

function visualizarFactura(idFactura){
	$.ajax({
		url: 'ajax/acciones-historial-factura.php',
		data:{'accion':'visualizar-factura',
			  'idFactura' : idFactura

		},
		method:'post',
		success:function(respuesta){
			console.log(respuesta);
			$("#div-factura").html(respuesta);
			var nombreCliente = $("#input-nombre").attr("value");
			var fechaFactura = $("#input-fecha").attr("value");
			var contenidoTabla = $("#input-tabla").attr("value");
			var totalFactura = $("#input-total").attr("value");
			$.confirm({
		    	title: '',
		    	columnClass: 'col-md-6 col-lg-6',
		    	content: '<div style="text-align: center">'+
							'<h5><strong>Laboratorio Clínico Emanuel</strong></h5>'+
							'<h6><strong>SIRVIENDO A DIOS ATRAVES DE SU SALUD</strong></h6>'+
							'<h6><strong>La libertad, Comayagua, Honduras, C.A</strong></h6>'+
							'<h6><strong>Telefonos: 2784-0292, 2784-0699</strong></h6>'+
							'<hr>'+
							'<span style="text-align:left;"><strong>Nombre cliente:</strong> '+nombreCliente+'</span>'+
							'&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp'+
							'<span style="text-align:left;"><strong>Fecha:</strong> '+fechaFactura+'</span>'+
							'<br>'+
							'<div class="well row">'+
								'<table class="table table-striped" style="font-size:12px">'+
									'<thead>'+
										'<tr>'+
											'<th>Examén</th>'+
											'<th>Costo</th>'+
											'<th>Promocion</th>'+
										'</tr>'+
									'</thead>'+
									'<tbody>'+
										contenidoTabla+
										'<tr></tr>'+
										'<tr></tr>'+
									'</tbody>'+
								'</table>'+
							'</div>'+
							'&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp'+
							'<span><strong>Total factura: </strong>'+
								totalFactura+
							'</span>'+
						'</div>'
		    	,
		    	type: 'blue',
		    	typeAnimated: true,
		    	buttons: {
		    	    ok: function () {
		    	    },
		    	}
			});
		},
		error:function(error){}
	});

}

function mostrarTabla(){

}