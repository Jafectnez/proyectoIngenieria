jQuery(document).ready(function() {


	$.ajax({
		async: true,
		crossDomain:true,
		url:'ajax/acciones-crear-factura.php',
		method:'POST',
		data:{
                'accion' : 'obtener-ultima-factura'
     	},
		success:function(respuesta){
			console.log(respuesta);
			arreglotokens=[];
			separador=":";
			arreglo=respuesta.split(separador);
			caracteres = arreglo[1].length;
			codigo = arreglo[1].slice(1,(caracteres -3 ));
			var codigoFactura = parseInt(codigo);
    		var factura = codigoFactura + 1;
    		var registro = factura.toString();
    		$('#txt-codigo-factura').val(registro);

			//$("#txt-codigo-factura").val(codigo);
		},
		error:function(error){
			console.log(error);
		}

	});




	$.ajax({
		async: true,
		crossDomain:true,
		url:'ajax/acciones-crear-factura.php',
		method:'POST',
		data:{
                'accion' : 'obtener-servicios'
     	},
		success:function(respuesta){
			//console.log(respuesta);
			$("#div-listado").html(respuesta);
		},
		error:function(error){
			console.log(error);
		}

	});



	
	

})



function ValidateAlpha(evt){
    var keyCode = (evt.which) ? evt.which : evt.keyCode
    if ((keyCode < 65 || keyCode > 90) && (keyCode < 97 || keyCode > 123) && keyCode != 32)return false;
    return true;
}

function servicioSeleccionado(idExamen){

	//Peticion ajax para obtener la informacion de cada servicio seleccionado

	 var idFactura = $("#txt-codigo-factura").val();

	 

	$.ajax({
		async: true,
		crossDomain:true,
		url:'ajax/acciones-crear-factura.php',
		method:'POST',
		data:{
                'accion': 'seleccionar-servicio',
                'idExamen' : idExamen,
                'codigoFactura' : idFactura
     	},
		success:function(respuesta){
			console.log(respuesta);
			//$("#tbl-servicios").html(respuesta);
		},
		error:function(error){
			console.log(error);
		}
	});
	mostrarPantalla(idFactura,idExamen);
	total(idFactura);
	obtenerPromociones();
}


function mostrarPantalla(idFactura,idExamen){
	var codigoFactura = $("#txt-codigo-factura").val();

	$.ajax({
		async: true,
		crossDomain:true,
		url:'ajax/acciones-crear-factura.php',
		method:'POST',
		data:{
                'accion': 'mostrar-pantalla',
                'idExamen' : idExamen,
                'codigoFactura' : idFactura
     	},
		success:function(respuesta){
			//console.log(respuesta);
			$("#tbl-servicios").html(respuesta);
		},
		error:function(error){
			console.log(error);
		}

	});
}



//Funcion para eliminar un item seleccionado de los servicios a registrar en la factura

function eliminarExamen(idExamen,codigoFactura){

	var idFactura = $("#txt-codigo-factura").val();

	$.ajax({
		async: true,
		crossDomain:true,
		url:'ajax/acciones-crear-factura.php',
		method:'POST',
		data:{
                'accion': 'eliminar-servicio',
                'idExamen' : idExamen,
                'codigoFactura' : codigoFactura
     	},
		success:function(respuesta){
			//console.log(respuesta);
			//$("#tbl-servicios").append(respuesta);
		},
		error:function(error){
			console.log(error);
		}

	});
	mostrarPantalla(idFactura,idExamen);
	total(idFactura);
	obtenerPromociones();
}


//Funcion que calcula el total de la factura
function total(codigoFactura){

	var idFactura = $("#txt-codigo-factura").val();


	$.ajax({
		async: true,
		crossDomain:true,
		url:'ajax/acciones-crear-factura.php',
		method:'POST',
		data:{
                'accion': 'total-factura',
                'codigoFactura' : codigoFactura
     	},
		success:function(respuesta){
			console.log(respuesta);
			//$("#tbl-servicios").append(respuesta);
			arreglotokens=[];
			separador=":";
			arreglo=respuesta.split(separador);
			caracteres = arreglo[1].length;
			codigo = arreglo[1].slice(1,(caracteres -3 ));
			$("#txt-total-neto").val(codigo);
		},
		error:function(error){
			console.log(error);
		}

	});


}


function almacenarRegistrosFinales(){
	var codigoFactura = $("#txt-codigo-factura").val();


	$.ajax({
		async: true,
		crossDomain:true,
		url:'ajax/acciones-crear-factura.php',
		method:'POST',
		data:{
                'accion': 'guardar-registros-finales',
                'codigoFactura' : codigoFactura
     	},
		success:function(respuesta){
			console.log(respuesta);
			
		},
		error:function(error){
			console.log(error);
		}

	});
	

	

}

function registrarFactura(){
	var nombreCliente = $("#txt-nombre-cliente").val();
	if (nombreCliente != '' && nombreCliente.length == 13 ) {
	//---------------------------------------------------------------
	//Se hace la peticion ajax para ver si el usuario esta registrado
	//---------------------------------------------------------------
	$.ajax({
			async: true,
			crossDomain:true,
			url:'ajax/acciones-crear-factura.php',
			method:'POST',
			data:{
        	        'accion': 'verificar-usuario',
        	        'nombreCliente' : nombreCliente
     		},
			success:function(respuesta){
				console.log(respuesta);
				if(respuesta != 'Se debe registrar el cliente'){
					$("#div-usuario").append(respuesta);
					var idCliente = $("#txt-id-usuario").attr("value");
					$("#txt-id-cliente").val(idCliente);					

					//----------------------------------------------------------
					//-----------------El usuario esta registrado---------------
					
					//-----------Calculo de los precios-------------------------
					//----------------------------------------------------------
					var total = $('#txt-total-neto').val();
    				var totalNeto = parseInt(total);
					//Comprabar si los productos tienen promociones y si las hay modificar el valor neto
					//Comprobar si hay promociones activas
					var promocion = $('#total-promocion').attr("value");

					if (promocion != 0) {
						//----------------------------------------------------------
						//------------------Hay promociones-------------------------
						//----------------------------------------------------------
						$("#txt-total-neto").val(totalNeto-promocion);
						var total = $('#txt-total-neto').val();
    					var totalNeto = parseInt(total);
    					if ($('#chk-descuento').is(':checked')) {
    						//----------------------------------------------------------
							//------------------Hay descuento---------------------------
							//----------------------------------------------------------
							var descuento =totalNeto * 0.25;
    						$('#txt-descuento').val(descuento);
    						var totalFactura = totalNeto - $('#txt-descuento').val();
    						$('#txt-total').val(totalFactura);
    					}else{
    						//----------------------------------------------------------
							//------------------No hay descuento------------------------
							//----------------------------------------------------------
							$('#txt-total').val(totalNeto);

    					}

					}else{
						//----------------------------------------------------------
						//------------------No hay promociones-----------------------
						//----------------------------------------------------------
						if ($('#chk-descuento').is(':checked')) {
							//----------------------------------------------------------
							//------------------Hay descuento---------------------------
							//----------------------------------------------------------
							var total = $('#txt-total-neto').val();
    						var totalNeto = parseInt(total);
    						var descuento =totalNeto * 0.25;
    						$('#txt-descuento').val(descuento);
    						var totalFactura = totalNeto - $('#txt-descuento').val();
    						$('#txt-total').val(totalFactura);


						}else{
							//----------------------------------------------------------
							//------------------No hay descuento------------------------
							//----------------------------------------------------------
							$('#txt-total').val(totalNeto);
						}
					}

					//-----------------------------------------------------------
					//-Validacion para asegurar que se hayan introducido examenes-
					//-----------------------------------------------------------

					var comprobarTotal = $('#txt-total').val();
					if (comprobarTotal == '' || comprobarTotal == 0) {
						$.confirm({
    						title: 'Lo sentimos...',
    						content: 'No han sido añadidos examenes a su factura',
    						type: 'blue',
    						typeAnimated: true,
    						buttons: {
        						tryAgain: {
            					text: 'Volver',
            					btnClass: 'btn-blue',
            					action: function(){}
        						}
        					}
						});
				}
				else{
					//Guardar los datos de la factura y destruir la tabla temporal
					//Id de la factura -> Generado
					//Id impuesto      -> 1
					//Id cliente	   -> Obtener del input id="txt-id-usuario"
					//Id Empleado	   -> 1
					//Id forma pago	   -> Efectivo 1
					//RTN			   -> 03131965001420
					//Fecha idExamen   -> Fecha Actual
					//Total            -> Obtener de $('#txt-total').val();
					//Estado factura   -> 1

					var idCliente = $("#txt-id-cliente").val();


					Date.prototype.yyyymmdd = function() {
  						var yyyy = this.getFullYear().toString();
  						var mm = (this.getMonth()+1).toString(); // getMonth() is zero-based
  						var dd  = this.getDate().toString();
  						return yyyy + "-" + (mm[1]?mm:"0"+mm[0]) + "-" + (dd[1]?dd:"0"+dd[0]); // padding
					};

					var date = new Date();
					console.log( date.yyyymmdd()); 
					var fechaActual = date.yyyymmdd();

					var total = $('#txt-total').val();
					$.ajax({
						async: true,
						crossDomain:true,
						url:'ajax/acciones-crear-factura.php',
						method:'POST',
						data:{
        				        'accion': 'almacenar-factura',
        				        'idImpuesto' : '1',
        				        'idCliente' : idCliente,
        				        'idEmpleado' : '1',
        				        'idFormaPago' : '1',
        				        'rtn': '03131965001420',
        				        'fechaExamen' : fechaActual,
        				        'total' : total,
        				        'estadoFactura': '1'
     					},
						success:function(respuesta){
							console.log(respuesta);
						},
						error:function(error){
							console.log(error);
						}
					});

					almacenarRegistrosFinales();
					setTimeout(function() {
					//alert('Registro almacenado con exito');

					//----------------------------------------------------------------------
					$.confirm({
					    title: 'Facturacion',
					    content: 'Factura almacenada con éxito!',
					    type: 'blue',
					    typeAnimated: true,
					    buttons: {
					        ok: function () {
					            location.reload();
					        },
					    }
					});
					//-----------------------------------------------------------------------------
    				}, 200); 
				}

				
				}
				else{
					//alert('Registrar cliente');
					//----------------------------------------------------------
					//-----------El usuario no esta registrado------------------
					//----------------------------------------------------------

				$.confirm({
				    title: 'Registrar cliente',
				    columnClass: 'col-md-12 col-lg-12',
				    content: 
				    	'<hr>'+
				    	'<form class="form-horizontal" role="form">'+
  						'<div class="form-group">'+
  						  '<label for="txt-nombre" class="col-lg-1 col-md-1 control-label">Nombre</label>'+
  						  '<div class="col-lg-4 col-md-4">'+
  						    '<input type="text" class="form-control" id="txt-nombre" placeholder="Nombre" onKeyPress="return ValidateAlpha(event);">'+
  						  '</div>'+
  						  '<label for="txt-nombre" class="col-lg-2 col-md-2 control-label">Apellido</label>'+
  						  '<div class="col-lg-4 col-md-4">'+
  						    '<input type="text" class="form-control" id="txt-apellido" placeholder="Apellido" onKeyPress="return ValidateAlpha(event);">'+
  						  '</div>'+
  						'</div>'+

  						'<div class="form-group">'+
  							'<label for="slc-genero" class="col-lg-1 col-md-1 control-label">Genero</label>'+
  							'<div class="col-lg-4 col-md-4">'+
  						    '<select class="form-control" id="genero" name="genero" style="margin-left:10px">'+
  						    	'<option value="F">Femenino</option>'+
  						    	'<option value="M">Masculino</option>'+
  						    '</select>'+
  						  '</div>'+
  						  '<label for="txt-fecha" class="col-lg-2 col-md-2 control-label">Fecha Nacimiento:</label>'+
  							'<div class="col-lg-4 col-md-4">'+
  						    '<input type="date" class="form-control" id="txt-fecha">'+
  						  '</div>'+
  						'</div>'+

						'<div class="form-group">'+
						    '<label for="txt-telefono" class="col-lg-1 col-md-1 control-label">Telefono:</label>'+
						    '<div class="col-lg-4 col-md-4">'+
						      '<input type="text" class="form-control" onkeypress="return validaNumericos(event)" id="txt-telefono" placeholder="Telefono">'+
						    '</div>'+
						    '<label for="txt-correo" class="col-lg-2 col-md-2 control-label">Email</label>'+
						    '<div class="col-lg-4 col-md-4">'+
						      '<input type="mail" class="form-control" id="txt-correo" placeholder="Email">'+
						    '</div>'+
						  '</div>'+

  						'<div class="form-group">'+
  						  '<label for="txt-direccion" class="col-lg-1 col-md-1 control-label">Direccion:</label>'+
  						  	'<div class="col-lg-10 col-md-10">'+
  						    '<input type="text" class="form-control" id="txt-direccion" placeholder="Direccion" onKeyPress="return ValidateAlpha(event);">'+
  						  	'</div>'+
  						  '</div>'+
						
  						
  						
					'</form>',
    				buttons: {
    				    formSubmit: {
    				        text: 'Registrar',
    				        btnClass: 'btn-blue',
    				        action: function () {
    				            //var name = this.$content.find('.name').val();
    				            var nombre = $("#txt-nombre").val();
    				            var apellido = $("#txt-apellido").val();
    				            var telefono = $("#txt-telefono").val();
    				            var correo = $("#txt-correo").val();
    				            var fecha = $("#txt-fecha").val();
    				            var direccion = $("#txt-direccion").val();
    				            var identidad = $("#txt-nombre-cliente").val();

    				            if ($("#genero option[value=F]").attr("selected",true)) {
    				            	var genero = '1';
    				            }
    				            else{
    				            	if ($("#genero option[value=M]").attr("selected",true)) {
    				            		var genero = '2';
    				            	}
    				            }
    				            
				
                          		if(genero != '' && nombre != '' && (telefono != '' && (telefono.length == 8)) && correo != '' && fecha != '' && direccion != '' && (identidad !='' && (identidad.length < 14))){
                					var regex = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
                					if (regex.test($('#txt-correo').val().trim())) {
                						$("#txt-usuario-genero").val(genero);
                						$("#txt-usuario-nombre").val(nombre);
                						$("#txt-usuario-apellido").val(apellido);
                						$("#txt-usuario-telefono").val(telefono);
                						$("#txt-usuario-correo").val(correo);
                				    	$("#txt-usuario-fecha").val(fecha);
                				    	$("#txt-usuario-direccion").val(direccion);
                				    	//$("#txt-usuario-identidad").val(identidad);

                				    	//var cliente = nombre +''+ apellido;
                				    	//$("#txt-nombre-cliente").val(cliente);

                				    	//---------------------------------------------------------
                				    	//---------Peticion ajax para crear el nuevo usuario-------
                				    	//---------------------------------------------------------
                				    	$.ajax({
											async: true,
											crossDomain:true,
											url:'ajax/acciones-crear-factura.php',
											method:'POST',
											data:{
        									        'accion': 'crear-usuario',
        									        'genero' : genero,
        									        'nombre' : nombre,
        									        'apellido' : apellido,
        									        'telefono' : telefono,
        									        'correo': correo,
        									        'fecha' : fecha,
        									        'direccion' : direccion,
        									        'identidad' : identidad
     										},
											success:function(respuesta){
												//-----------------------------------------------------------
												//Cuando retorna los parametros se debe confirmar el registro
												//-----------------------------------------------------------
												arreglotokens=[];
												separador=":";
												arreglo=respuesta.split(separador);
												caracteres = arreglo[1].length;
												codigo = arreglo[1].slice(1,(caracteres -3 ));
												var idCliente = parseInt(codigo);
												$("#txt-id-cliente").val(idCliente);

												
												var nombreCliente = $("#txt-nombre-cliente").val();
												
												$.ajax({
													async: true,
													crossDomain:true,
													url:'ajax/acciones-crear-factura.php',
													method:'POST',
													data:{
        											        'accion': 'verificar-usuario',
        											        'nombreCliente' : nombreCliente
     												},
													success:function(respuesta){
														console.log(respuesta);
														if (respuesta != 'Se debe registrar el cliente') {
															//----------------------------------------------------------
															//-----------------El usuario esta registrado---------------
					
															//-----------Calculo de los precios-------------------------
															//----------------------------------------------------------
															var total = $('#txt-total-neto').val();
    														var totalNeto = parseInt(total);
															//Comprabar si los productos tienen promociones y si las hay modificar el valor neto
															//Comprobar si hay promociones activas
															var promocion = $('#total-promocion').attr("value");

															if (promocion != 0) {
																//----------------------------------------------------------
																//------------------Hay promociones-------------------------
																//----------------------------------------------------------
																$("#txt-total-neto").val(totalNeto-promocion);
																var total = $('#txt-total-neto').val();
    															var totalNeto = parseInt(total);
    															if ($('#chk-descuento').is(':checked')) {
    																//----------------------------------------------------------
																	//------------------Hay descuento---------------------------
																	//----------------------------------------------------------
																	var descuento =totalNeto * 0.25;
    																$('#txt-descuento').val(descuento);
    																var totalFactura = totalNeto - $('#txt-descuento').val();
    																$('#txt-total').val(totalFactura);
    															}else{
    																	//----------------------------------------------------------
																		//------------------No hay descuento------------------------
																		//----------------------------------------------------------
																		$('#txt-total').val(totalNeto);

    																}

																}else{
																	//----------------------------------------------------------
																	//------------------No hay promociones-----------------------
																	//----------------------------------------------------------
																	if ($('#chk-descuento').is(':checked')) {
																		//----------------------------------------------------------
																		//------------------Hay descuento---------------------------
																		//----------------------------------------------------------
																		var total = $('#txt-total-neto').val();
    																	var totalNeto = parseInt(total);
    																	var descuento =totalNeto * 0.25;
    																	$('#txt-descuento').val(descuento);
    																	var totalFactura = totalNeto - $('#txt-descuento').val();
    																	$('#txt-total').val(totalFactura);


																	}else{
																		//----------------------------------------------------------
																		//------------------No hay descuento------------------------
																		//----------------------------------------------------------
																		$('#txt-total').val(totalNeto);
																	}
																}

																	//-----------------------------------------------------------
																	//-Validacion para asegurar que se hayan introducido examenes-
																	//-----------------------------------------------------------

																	var comprobarTotal = $('#txt-total').val();
																	if (comprobarTotal == '' || comprobarTotal == 0) {
																		$.confirm({
    																		title: 'Lo sentimos...',
    																		content: 'No han sido añadidos examenes a su factura',
    																		type: 'blue',
    																		typeAnimated: true,
    																		buttons: {
        																		tryAgain: {
            																	text: 'Volver',
            																	btnClass: 'btn-blue',
            																	action: function(){}
        																		}
        																	}
																		});
																}
																else{
																	//Guardar los datos de la factura y destruir la tabla temporal
																	//Id de la factura -> Generado
																	//Id impuesto      -> 1
																	//Id cliente	   -> Obtener del input id="txt-id-usuario"
																	//Id Empleado	   -> 1
																	//Id forma pago	   -> Efectivo 1
																	//RTN			   -> 03131965001420
																	//Fecha idExamen   -> Fecha Actual
																	//Total            -> Obtener de $('#txt-total').val();
																	//Estado factura   -> 1

																	var idCliente = $("#txt-id-cliente").val();


																	Date.prototype.yyyymmdd = function() {
  																		var yyyy = this.getFullYear().toString();
  																		var mm = (this.getMonth()+1).toString(); // getMonth() is zero-based
  																		var dd  = this.getDate().toString();
  																		return yyyy + "-" + (mm[1]?mm:"0"+mm[0]) + "-" + (dd[1]?dd:"0"+dd[0]); // padding
																	};

																	var date = new Date();
																	console.log( date.yyyymmdd()); 
																	var fechaActual = date.yyyymmdd();

																	var total = $('#txt-total').val();
																	$.ajax({
																		async: true,
																		crossDomain:true,
																		url:'ajax/acciones-crear-factura.php',
																		method:'POST',
																		data:{
        																        'accion': 'almacenar-factura',
        																        'idImpuesto' : '1',
        																        'idCliente' : idCliente,
        																        'idEmpleado' : '1',
        																        'idFormaPago' : '1',
        																        'rtn': '03131965001420',
        																        'fechaExamen' : fechaActual,
        																        'total' : total,
        																        'estadoFactura': '1'
     																	},
																		success:function(respuesta){
																			console.log(respuesta);
																		},
																		error:function(error){
																			console.log(error);
																		}
																	});

																	almacenarRegistrosFinales();
																	setTimeout(function() {
																	//alert('Registro almacenado con exito');

																	//----------------------------------------------------------------------
																	$.confirm({
																	    title: 'Facturacion',
																	    content: 'Factura almacenada con éxito!',
																	    type: 'blue',
																	    typeAnimated: true,
																	    buttons: {
																	        ok: function () {
																	            location.reload();
																	        },
																	    }
																	});
																	//-----------------------------------------------------------------------------
    																}, 200); 
																}
														}
													},
													error:function(error){
														console.log(error);
													}
												});
									//alert(idCliente);
											},
											error:function(error){
												console.log(error);
											}
										});

            					}
                				else{
                					$.alert('Correo no válido');
                    				return false;
                				}
                			}
                			else{
                				$.alert('Campos requeridos o formato incorrecto');
                			    return false;
                			}
            			}
        			},
        			cancel: function () {
            			//close
        			},
    			},
    			onContentReady: function () {
        		// bind to events
        		var jc = this;
        		this.$content.find('form').on('submit', function (e) {
            	// if the user submits the form by pressing enter in the field.
            	e.preventDefault();
            	jc.$$formSubmit.trigger('click'); // reference the button and click it
        	});
    	}
	});
				//Fin de la peticion que devuelve si el cliente esta registrado o  no
				}},
				error:function(error){
				console.log(error);
			}
		});

	}
	else{
		//----------------------------------------------
		//Alertar que el campo de cliente es obligatorio
		//----------------------------------------------
		
		$.confirm({
    		title: 'Campo obligatorio',
    		content: 'Verifique el número de identidad',
    		type: 'blue',
    		typeAnimated: true,
    		buttons: {
        		tryAgain: {
            	text: 'Volver',
            	btnClass: 'btn-blue',
            	action: function(){
            }
        }
        
    }
});
	}


	
}


function uncheckRadio(rbutton){
	var era;
	var previo=null;
	if(previo &&previo!=rbutton){previo.era=false;}
	if(rbutton.checked==true && rbutton.era==true){rbutton.checked=false;}
	rbutton.era=rbutton.checked;
	previo=rbutton;
}

function obtenerPromociones(){

	//Capturar la fecha actual
	Date.prototype.yyyymmdd = function() {
  		var yyyy = this.getFullYear().toString();
  		var mm = (this.getMonth()+1).toString(); // getMonth() is zero-based
  		var dd  = this.getDate().toString();
  		return yyyy + "-" + (mm[1]?mm:"0"+mm[0]) + "-" + (dd[1]?dd:"0"+dd[0]); // padding
	};

	var date = new Date();
	console.log( date.yyyymmdd()); 
	var fechaActual = date.yyyymmdd();

	var idFactura = $("#txt-codigo-factura").val();

	$.ajax({
		async: true,
		crossDomain:true,
		url:'ajax/acciones-crear-factura.php',
		method:'POST',
		data:{
                'accion' : 'obtener-promociones',
                'fechaActual' : fechaActual,
                'idFactura' : idFactura
     	},
		success:function(respuesta){
			//console.log(respuesta);
			$("#div-promociones").html(respuesta);
		},
		error:function(error){
			console.log(error);
		}

	});

	

}

function crearTabla(){

	var idFactura = $("#txt-codigo-factura").val();
	alert(idFactura);

	$.ajax({
		async: true,
		crossDomain:true,
		url:'ajax/acciones-crear-factura.php',
		method:'POST',
		data:{
                'accion': 'crear-tabla',
                'codigoFactura' : idFactura
     	},
		success:function(respuesta){
			console.log(respuesta);
			//$("#tbl-servicios").html(respuesta);
		},
		error:function(error){
			console.log(error);
		}
	});
}

function validaNumericos(event) {
    if(event.charCode >= 48 && event.charCode <= 57){
      return true;
     }
     return false;        
}