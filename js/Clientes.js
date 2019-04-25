$(document).ready(function(){
	Listar_Clientes();
	Obtener_Datos();
	Examenes_Cliente();	
});


function Listar_Clientes(){
	$.ajax({
		url:"ajax/acciones-cliente.php",
		data:{"accion":"listar-clientes"},
		method:"POST",
		dataType:"json",
		success:function(respuesta){
			for (var i = 0; i < respuesta.length; i++) {
				    var row ='<tr>'+
		                  	'<td></td>'+
		                 	'<td>'+respuesta[i].NOMBRE+'</td>'+
		                  	'<td>'+respuesta[i].USUARIO+'</td>'+
		                  	'<td>'+respuesta[i].FECHA_REGISTRO+'</td>'+
		                  	'<td><a class="btn btn-secondary" title="Ver más" href="examenes_cliente.php?id='+respuesta[i].ID_CLIENTE+'" name="btn-cliente" id="btn-cliente"><span class="glyphicon glyphicon-share"></span></a></td>'+
		              	 '</tr>';
					 	 console.log(row);
				 $('#table-clientes').append(row);
			}
		}
	});

}


function Obtener_Datos(){
	var id_cliente=$("#id_cliente").val();
	$.ajax({
		url:"ajax/acciones-cliente.php",
		data:{"accion":"obtener_datos",id_cliente},
		method:"POST",
		dataType:"json",
		success:function(respuesta){	
			var row='<tr>'+
						'<th></th>'+
						'<th>Paciente:</th>'+
						'<th>'+respuesta[0].NOMBRE+'</th>'+
					'</tr>'+
					'<tr>'+
						'<th></th>'+
						'<th>Identidad:</th>'+
						'<th>'+respuesta[0].IDENTIDAD+'</th>'+
					'</tr>'+
					'<tr>'+
						'<th></th>'+
						'<th>Fecha de nacimiento:</th>'+
						'<th>'+respuesta[0].FECHA_NACIMINETO+'</th>'+
					'</tr>'+
					'<tr>'+
						'<th></th>'+
						'<th>Edad:</th>'+
						'<th>'+respuesta[0].EDAD+'</th>'+
					'</tr>'+
					'<tr>'+
						'<th></th>'+
						'<th>Teléfono:</th>'+
						'<th>'+respuesta[0].TELEFONO+'</th>'+
					'</tr>'+
					'<tr>'+
						'<th></th>'+
						'<th>Correo:</th>'+
						'<th>'+respuesta[0].CORREO+'</th>'+
					'</tr>'+
					'<tr>'+
						'<th></th>'+
						'<th>Dirección:</th>'+
						'<th>'+respuesta[0].DIRECCION+'</th>'+
					'</tr>';
					console.log(row);
			$('#table-datos_cliente').append(row);
		}
	});
}

	
function Examenes_Cliente(){	
	var id_cliente=$("#id_cliente").val();
	$.ajax({
		url:"ajax/acciones-cliente.php",
		data:{"accion":"listar_examenes_cliente",id_cliente},
		method:"POST",
		dataType:"json",
		success:function(respuesta){
			for (var i = 0; i < respuesta.length; i++) {
					var row='<tr>'+
						    	'<td></td>'+
						        '<td>'+respuesta[i].FECHA_EMISION+'</td>'+
						        '<td>'+respuesta[i].EXAMEN+'</td>'+
						        '<td>'+respuesta[i].EMPLEADO+'</td>'+
						        '<td><a class="btn btn-secondary" id="btn_resultados" onclick="Resultados_Examen('+respuesta[i].ID_RESULTADO+')" title="Ver resultados" data-toggle="modal" data-target="#modal-resultados_examen"><span class="glyphicon glyphicon-share"></span></a></td>'+
						    '</tr>';
					 	 console.log(row);
				 $('#table-examenes_cliente').append(row);
			}
		}
	});
}

function Resultados_Examen(id_resultado){
	
	$.ajax({
		url:"ajax/acciones-cliente.php",
		data:{"accion":"listar_resultado_examen",id_resultado},
		method:"POST",
		dataType:"json",
		success:function(respuesta){
			$('tr').remove(".tr_resultados");
			var row='<h2 class="modal-title" id="modal_titulo" align="center">'+respuesta[0].EXAMEN+'</h2>';
			$('#modal_header').append(row);
			
			for (var i = 0; i < respuesta.length; i++) {
					var rows='<tr id="tr_resultados" class="tr_resultados">'+
						    	'<td></td>'+
						        '<td>'+respuesta[i].CARACTERISTICA+'</td>'+
						        '<td>'+respuesta[i].VALOR_RESULTADO+'</td>'+
						        '<td>'+respuesta[i].REFERENCIA+'</td>'+
						        '<td></td>'+
						    '</tr>';
				 $('#table_resultados').append(rows);
			}
			$('#modal_titulo').remove();
		}
	});
}


function Editar_Cliente(id_cliente){

}