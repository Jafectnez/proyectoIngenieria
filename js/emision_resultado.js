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

			for (var i = 0; i < type.length; i++) {
				 var row='<li >'+
				 		 '<div class="collapsible-header" >'+
					 	 type[i].NOMBRE+
					 	 '</div>'+
					 	 '<div class="collapsible-body" id="div-caracteristica'+type[i].ID_AREA+'">'+
					 	 '<table>  <thead>'+
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
				 	 	 '</tr>  <thead ><tbody>'+
				 	 	 cargarCaracteristicas(type[i].ID_AREA);
				 		 '</tbody></table>'+
					 	 '</div>'+
					 	 
					 	 '</li>';

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
				 	 	 		'<input type="text" id="txt-'+type[i].ID_AREA+type[i].CARACTERISTICA+'">'+
				 	 	 	'</td>'+
				 	 	 	'<td style="visibility: hidden" >'+
				 	 	 		'<input type="text" id="txt-caracteristica-'+type[i].ID_CARACTERISTICAS+type[i].CARACTERISTICA+'" value="'+type[i].ID_CARACTERISTICAS+'">'+
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

$('#btn-guardar').click(function(){
	ObtenerInputs();
});
//Con esta funcion se obtiene los datos que hay en los inputs del formulario
function ObtenerInputs(){
	var parametro='';
	$.ajax({
		url:"ajax/gestionar-resultados.php",
		data:{"accion":"obtener-inputs"},
		method:"post",
		success:function(respuesta){
			var type = JSON.parse(respuesta);	
			for (var i = 0; i < type.length; i++) {
			
					var valor=document.getElementById('txt-'+type[i].ID_AREA+type[i].CARACTERISTICA).value;
					var idcaracteristica=document.getElementById('txt-caracteristica-'+type[i].ID_CARACTERISTICAS+type[i].CARACTERISTICA).value;
					if (valor!='') {
						//valor='NA';
						parametro+="txt-"+type[i].ID_AREA+type[i].CARACTERISTICA+':'+valor+'#'+'txt-caracteristica-'+type[i].ID_CARACTERISTICAS+type[i].CARACTERISTICA+':'+idcaracteristica+',';
					}
					
				
			}
			parametros(parametro);
		},
		error:function(e){
		alert(e);
		}

	});
}
//Funcion en donde se obtiene la data con el formato correcto para hacer la peticion ajax 
function parametros(data){
	var cadena=data;
	var cadena2=cadena.slice(0,-1);
	 //console.log(cadena2);
	//En este punto es en donde se guardara la data en la base de datos
	$.ajax({
		url:"ajax/gestionar-resultados.php",
		data:{"accion":"guardar-resultado",cadena2},
		method:"post",
		success:function(respuesta){
			console.log(respuesta);
			//var type = JSON.parse(respuesta);	
			
		},
		error:function(e){
		alert(e);
		}

	});

}

