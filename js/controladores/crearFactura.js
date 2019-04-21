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
	//Comprobar que la identidad sea introducida
	//------------------------------------------
	var nombreCliente = $("#txt-nombre-cliente").val();
	if (nombreCliente != '') {
		//El campo nombreCliente esta lleno
		//---------------------------------
		if(nombreCliente.length > 13){
			//Alertar que el formato de la identidad no es valido
			//---------------------------------------------------
			$.confirm({
    			title: 'Lo sentimos...',
    			content: 'El numero de identidad no es correcto',
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
		}else{
			//Hacer la peticion ajax para ver si el usuario esta registrado
			//-------------------------------------------------------------
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
//-----------------------------------------------------------------------------------------
//-------------Usuario registrado..........................................................
					if(respuesta != 'Se debe registrar el cliente'){
						$("#div-usuario").append(respuesta);
						var idCliente = $("#txt-id-usuario").attr("value");
						$("#txt-id-cliente").val(idCliente);
						alert(idCliente);
					
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
		//------------------------------------------------------
		//-------------Fin de calculos de precio---------------
				var comprobarTotal = $('#txt-total').val();
				alert(comprobarTotal);
		//-----------------------------------------------------
		//--------No hay examenes añadidos a la factura-------------


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
		//------------------------------------------------------------
		//----------hay examenes añadidos a la factura---------------
		//----------Registro de la factura----------------------------
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
//------------------------------------------------------------------------------------------
//--------------------------Usuario no registrado------------------------------------------
					else{
					var identidadCliente = "'"+$("#txt-nombre-cliente").val()+"'";
					alert(identidadCliente);
					$.ajax({
						async: true,
						crossDomain:true,
						url:'ajax/acciones-crear-factura.php',
						method:'POST',
						data:{
        				        'accion' : 'verificar-persona',
        				        'identidadCliente' : identidadCliente
     					},
						success:function(respuesta){
							console.log(respuesta);
							$("#div-usuario").append(respuesta);
							if (respuesta != ' ') {
	//---------------------------------------------------------------------------------------
	//---------------------Registrar unicamente el usuario y el cliente-----------------------
							//alert('Solo se debe registrar el usuario y el cliente');
							var usuarioPersona = $("#input-usuario").attr("value");
							alert(usuarioPersona);
							var idPersona = $("#input-id-persona").attr("value");
							alert(idPersona);
							$.ajax({
								async: true,
								crossDomain:true,
								url:'ajax/acciones-crear-factura.php',
								method:'POST',
								data:{
        						        'accion': 'crear-usuario-cliente',
        						        'usuarioPersona' : usuarioPersona,
        						        'idPersona' : idPersona
     							},
								success:function(respuesta){
									$("#div-usuario").append(respuesta);
									var idCliente = $("#txt-id-usuario").attr("value");
									$("#txt-id-cliente").val(idCliente);

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
				if (respuesta != 'Se debe registrar el cliente') {
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




































































								},
								error:function(error){
									console.log(error);
								}
							});
									
							}
							else{
	//------------------------------------------------------------------------------------------
	//-------------------Registrar persona, usuario y cliente------------------------------------
								alert('Registrar persona usuario y cliente');
							}
						},
						error:function(error){
							console.log(error);
						}

					});
					}
//------------------------------------------------------------------------------------------
//----------------------Fin del usuario no registrado---------------------------------------
				},
				error:function(error){
					console.log(respuesta);
				}
			});
		}
	}else{
		$.confirm({
    			title: 'Lo sentimos...',
    			content: 'Por favor introduzca el numero de identidad',
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

$('.input-number').on('input', function () { 
    this.value = this.value.replace(/[^0-9]/g,'');
});
