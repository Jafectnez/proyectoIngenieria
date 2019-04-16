$(document).ready(function() {
	
	$.ajax({
		url:'ajax/acciones-crear-factura.php',
		data:{"accion":"obtener-ultima-factura"},
		method:'POST',
		dataType:'json',
		success:function(respuesta){
			console.log(respuesta);
		},
		error:function(error){
			alert(error);
		}

	});
	
});