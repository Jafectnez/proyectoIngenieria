$(document).ready(function(){
	cargarAreas();
});
function cargarAreas(){

$.ajax({
		url:"ajax/gestionar-resultados.php",
		data:{"accion":"listar-areas"},
		method:"post",
		success:function(respuesta){
			//Parsear respuesta para convertirlo en un objeto y poder acceder a sus valores
			var type = JSON.parse(respuesta);
			 console.log(type);
			for (var i = 0; i < type.length; i++) {
				 var row='<li >'+
				 		 '<div class="collapsible-header" >'+
					 	 type[i].NOMBRE+
					 	 '</div>'+
					 	 '<div class="collapsible-body" id="div-caracteristica'+type[i].ID_AREA+'">'+
					 	 '<table>'+
				 	 	 '<tr>'+
				 	 	 	'<th>'+
				 	 	 		'<label><b>Caracteristicas</b></label>'+
				 	 	 	'</th>'+
				 	 	 	'<th>'+
				 	 	 	'<label><b>valor de referencia</b></label>'+
				 	 	 	'</th>'+
				 	 	 	'<th>'+
				 	 	 	'<label><b>resultado</b></label>'
				 	 	 	'</th>'+
				 	 	 '</tr>'+
				 	 	 cargarCaracteristicas(type[i].ID_AREA);
				 		 '</table>'
					 	 +'</div>'+
					 	 '</li>'+
					 	 '<button class="btn waves-effect waves-light" >Guardar</button>';

					 	 // console.log(row);
				 $('#ul-area').append(row);

			}
			
		},
		error:function(e){
		alert(e);
		}

	});
}
function cargarCaracteristicas(idarea){
	
	$.ajax({
		url:"ajax/gestionar-resultados.php",
		data:{"accion":"listar-caracteristicas",
			  "id":idarea},
		method:"post",
		success:function(respuesta){
			// alert(respuesta);
			//Parsear respuesta para convertirlo en un objeto y poder acceder a sus valores
			var type = JSON.parse(respuesta);
			for (var i = 0; i < type.length; i++) {
				var row=
				 	 	 '<tr>'+
				 	 	 	'<td style="width:330px">'+
				 	 	 		'<label>'+type[i].CARACTERISTICA+'</label>'+
				 	 	 	'</td>'+
				 	 	 	'<td style="width:200px">'+
				 	 	 		'<label>'+type[i].VALOR_REF+" "+type[i].UNIDADES_MEDIDA+'</label>'+
				 	 	 	'</td>'+
				 	 	 	'<td style="width:350px">'+
				 	 	 		'<input type="text">'+
				 	 	 	'</td>'+
				 	 	 '</tr>';
				 	$('#div-caracteristica'+idarea).append(row);
			}
	
		},
		error:function(e){
		alert(e);
		}

	});
}