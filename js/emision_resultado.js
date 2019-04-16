$(document).ready(function(){
	cargarExamenes();
});
function cargarExamenes(){

$.ajax({
		url:"ajax/gestionar-resultados.php",
		data:{"accion":"listar-examenes"},
		method:"post",
		success:function(respuesta){
			//Parsear respuesta para convertirlo en un objeto y poder acceder a sus valores
			var type = JSON.parse(respuesta);
			console.log(type);
			for (var i = 0; i < type.length; i++) {
				 var row='<li >'+
				 		 '<div class="collapsible-header" >'+
					 	 type[i].NOMBRE+
					 	 '<div>'+
					 	 '<div class="collapsible-body"></div>'+
					 	 '</li>';

					 	 console.log(row);
				 $('#ul-area').append(row);

			}
			
		},
		error:function(e){
		alert(e);
		}

	});
}