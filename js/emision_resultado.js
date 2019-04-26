$(document).ready(function(){
	cargarAreas();
	cargarExamenes();
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
			var caracteristicas= new Array();	
			for (var i = 0; i < type.length; i++) {
			
					// var valor=document.getElementById('txt-'+type[i].ID_AREA+type[i].CARACTERISTICA).value;
					// var idcaracteristica=document.getElementById('txt-caracteristica-'+type[i].ID_CARACTERISTICAS+type[i].CARACTERISTICA).value;
					// if (valor!='') {
					// 	//valor='NA';
					// 	parametro+="txt-"+type[i].ID_AREA+type[i].CARACTERISTICA+':'+valor+'#'+'txt-caracteristica-'+type[i].ID_CARACTERISTICAS+type[i].CARACTERISTICA+':'+idcaracteristica+',';
					// }
					//Este es el valor ingresado en el input

				    var valor=document.getElementById('txt-'+type[i].ID_AREA+type[i].CARACTERISTICA).value;
					var idcaracteristica=document.getElementById('txt-caracteristica-'+type[i].ID_CARACTERISTICAS+type[i].CARACTERISTICA).value;
					 if (valor!='') {
					 	parametro=valor+':'+idcaracteristica;
					 	//valor='NA';
					// 	parametro+="txt-"+type[i].ID_AREA+type[i].CARACTERISTICA+':'+valor+'#'+'txt-caracteristica-'+type[i].ID_CARACTERISTICAS+type[i].CARACTERISTICA+':'+idcaracteristica+',';
						caracteristicas.push(parametro);
					 }
			}
					// console.log(caracteristicas);
			parametros(caracteristicas);
		},
		error:function(e){
		alert(e);
		}

	});
}
//-----------------------------------------------------------------------------------------------------------------
//Funcion en donde se obtiene la data con el formato correcto para hacer la peticion ajax 
//-----------------------------------------------------------------------------------------------------------------
function parametros(data){
	//En este punto es en donde se guardara la data en la base de datos
	//console.log(data);
	var cliente=$('#txt-nombre-cliente').val();
	var examenes=$("input[type='radio'][name='rbt-examenes']:checked").val()
	$.ajax({
		url:"ajax/gestionar-resultados.php",
		data:{"accion":"guardar-resultado","cliente":cliente,"arreglo":JSON.stringify(data),"examenes":examenes},
		method:"post",
		success:function(respuesta){
			console.log(respuesta);
			var cliente="";
			cliente=respuesta;

					if (cliente == 'Ingrese un cliente válido' ) {
						$.confirm({
    						title: 'Lo sentimos...',
    						content: 'Este cliente no esta registrado',
    						type: 'blue',
    						typeAnimated: true,
    						buttons: {
        						tryAgain: {
            					text: 'Volver',
            					btnClass: 'btn-blue',
            					action: function(){	}
        						}
        					}
						});
				}
					if (cliente=='Resultado guardado con exito') {
						$.confirm({
    						title: 'Resultados',
    						content: 'Resultados guardados con Exito! ',
    						type: 'blue',
    						typeAnimated: true,
    						buttons: {
        						tryAgain: {
            					text: 'Ok',
            					btnClass: 'btn-blue',
            					action: function(){
            						cargarUltimoResultado();
            						$("#mod-emitido").modal("show");
            					}
        						}
        					}
						});
					}
			
		},
		error:function(e){
		alert(e);
		}

	});

}
//-----------------------------------------------------------------------------------------------------------------
//Aqui se llamara el resultado que se acaba de insertar
//-----------------------------------------------------------------------------------------------------------------
function cargarUltimoResultado(){
	cargarDatosUsuario();
	$.ajax({
		url:"ajax/gestionar-resultados.php",
		data:{"accion":"obtener-ultimo-resultado"},
		method:"post",
		success:function(respuesta){
			var type = JSON.parse(respuesta);
			var row='';
			var referencia="";
			for (var i = 0; i < type.length; i++) {
				if (type[i].valor_ref==null) {
					referencia="N/A";
				} else {
					referencia=type[i].valor_ref;
				}

				row=	'<tr>'+
							'<td>'+
								type[i].caracteristica+
							'</td>'+
							'<td>'+
								referencia+
							'/<td>'+
							'<td>'+
								type[i].valor_resultado+
							'</td>'+
						'</tr>';
					
			$('#div-resultado-emitido').append(row);
			console.log(row);
			}
			
		},
		error:function(e){
		alert(e);
		}

	});

}
//-----------------------------------------------------------------------------------------------------------------


//-----------------------------------------------------------------------------------------------------------------
//Aqui se listan los examenes disponibles
//-----------------------------------------------------------------------------------------------------------------
function cargarExamenes(){
	$.ajax({
		url:"ajax/gestionar-resultados.php",
		data:{"accion":"obtener-examenes"},
		method:"post",
		datatype:'JSON',
		success:function(respuesta){
			var type = JSON.parse(respuesta);
			//console.log(type);
			var row='<table><tr>';	
			for (var i = 0; i < type.length; i++) {
				row+='<td><label><input type="radio" style="opacity:100" name="rbt-examenes" value="'+type[i].id_examen+'">'+type[i].nombre+' </label></td>';
				
			}
			row+='</tr></table>';
			$('#div-examen').append(row);
		},
		error:function(e){
		alert(e);
		}

	});	

}
function cargarDatosUsuario(){
	var cliente=$('#txt-nombre-cliente').val();

}
