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
						'<th>'+respuesta[0].NOMBRE_COMPLETO+'</th>'+
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



function Cargar_Cliente(id_cliente){
	$.ajax({
		url:"ajax/acciones-cliente.php",
		data:{"accion":"obtener_datos",id_cliente},
		method:"POST",
		dataType:"json",
		success:function(respuesta){
			//alert(respuesta);	
			$('#formulario').remove();
			var row='<form class="form-horizontal" id="formulario" role="form">'+
						'<div class="form-group">'+
							'<label for="txt-nombre" class="col-lg-2 col-md-2 control-label">Nombre</label>'+
							'<div class="col-lg-4 col-md-4">'+
								'<input type="text" class="form-control" id="txt-nombre" value="'+respuesta[0].NOMBRE+'">'+
							'</div>'+
							'<label for="txt-nombre" class="col-lg-2 col-md-2 control-label">Apellido</label>'+
							'<div class="col-lg-4 col-md-4">'+
								'<input type="text" class="form-control"  id="txt-apellido" value="'+respuesta[0].APELLIDO+'" placeholder="Apellido">'+
							'</div>'+
						'</div>'+

						'<div class="form-group">'+
							'<label for="slc-genero" class="col-lg-2 col-md-2 control-label">Genero</label>'+
							'<div class="col-lg-4 col-md-4">'+
								'<select class="form-control" id="genero" value="'+respuesta[0].GENERO+'" name="genero" style="margin-left:10px">'+
								'<option value="2">Femenino</option>'+
								'<option value="1">Masculino</option>'+
								'</select>'+
							'</div>'+
							'<label for="txt-fecha" class="col-lg-2 col-md-2 control-label">Fecha Nacimiento:</label>'+
							'<div class="col-lg-4 col-md-4">'+
								'<input type="date" class="form-control" disabled value="'+respuesta[0].FECHA_NACIMINETO+'" id="txt-fecha">'+
							'</div>'+
						'</div>'+

						'<div class="form-group">'+
							'<label for="txt-telefono" class="col-lg-2 col-md-2 control-label">Telefono:</label>'+
							'<div class="col-lg-4 col-md-4">'+
								'<input type="text" class="form-control" value="'+respuesta[0].TELEFONO+'" id="txt-telefono" placeholder="Telefono">'+
							'</div>'+
							'<label for="txt-correo" class="col-lg-2 col-md-2 control-label">Email</label>'+
							'<div class="col-lg-4 col-md-4">'+
								'<input type="mail" class="form-control" value="'+respuesta[0].CORREO+'" id="txt-correo" placeholder="Email">'+
							'</div>'+
						'</div>'+

						'<div class="form-group">'+
							'<label for="txt-nombre" class="col-lg-2 col-md-2 control-label">Identidad</label>'+
							'<div class="col-lg-4 col-md-4">'+
								'<input type="text" class="form-control" id="txt-identidad" disabled value="'+respuesta[0].IDENTIDAD+'">'+
							'</div>'+
							'<label for="txt-nombre" class="col-lg-2 col-md-2 control-label">Usuario</label>'+
							'<div class="col-lg-4 col-md-4">'+
								'<input type="text" class="form-control" disabled id="txt-usuario" value="'+respuesta[0].USUARIO+'">'+
							'</div>'+
						'</div>'+

						'<div class="form-group">'+
							'<label for="txt-nombre" class="col-lg-2 col-md-2 control-label">contraseña</label>'+
							'<div class="col-lg-4 col-md-4">'+
								'<input type="password" class="form-control" id="txt-contrasena" value="'+respuesta[0].CONTRASEÑA+'">'+
							'</div>'+
							'<label for="txt-nombre" class="col-lg-2 col-md-2 control-label">Nueva contraseña</label>'+
							'<div class="col-lg-4 col-md-4">'+
								'<input type="password" class="form-control"  id="txt-nueva_contrasena" placeholder="Nueva contraseña">'+
							'</div>'+
						'</div>'+							

						'<div class="form-group">'+
							'<label for="txt-direccion" class="col-lg-2 col-md-2 control-label">Direccion:</label>'+
							'<div class="col-lg-10 col-md-10">'+
								'<input type="text" class="form-control" id="txt-direccion" value="'+respuesta[0].DIRECCION+'" placeholder="Direccion">'+
							'</div>'+
							'<input type="hidden" class="form-control" id="id_usuario" value="'+respuesta[0].ID_USUARIO+'">'+
							'<input type="hidden" class="form-control" id="edad" value="'+respuesta[0].EDAD+'">'+
						'</div>'+
					'</form>';
			$('#div-formulario').append(row);
		}
	});
}


function Editar_Cliente(id_cliente){

	$.ajax({
		url:"ajax/acciones-cliente.php",
		data:{"accion":"actualizar_cliente",
			"id_cliente": id_cliente,
			"id_usuario":$("#id_usuario").val(),
			"txt-nombre":$("#txt-nombre").val(),
			"txt-apellido": $("#txt-apellido").val(),
			"genero":$("#genero").val(),
			"txt-fecha":$("#txt-fecha").val(),
			"txt-telefono":$("#txt-telefono").val(),
			"txt-correo":$("#txt-correo").val(),
			"txt-usuario":$("#txt-usuario").val(),
			"edad":$("#edad").val(),
			"txt-identidad":$("#txt-identidad").val(),
			"txt-direccion":$("#txt-direccion").val(),
			"txt-contrasena":$("#txt-contrasena").val(),
			"txt-nueva_contrasena":$("#txt-nueva_contrasena").val()
			},
		method:"POST",
		dataType:"json",
		success:function(respuesta){
			if ((respuesta.error) == 0) {
				$("#div-resultado").html('<div class="alert alert-success" style="text-align: center;"> '+respuesta.mensaje+"</div>");
				location.reload();
			}else
				$("#div-resultado").html('<div class="alert alert-warning" style="text-align: center;"> '+respuesta.mensaje+"</div>");
		}
	});
}
