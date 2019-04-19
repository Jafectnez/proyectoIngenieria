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
    		$('#txt-codigo-factura').val(registro)

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
	if (nombreCliente != '') {
	//---------------------------------------------------------------
	//Se hace la peticion ajax para ver si el usuario esta registrado
	//---------------------------------------------------------------
	alert('Campo rellenado');
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
					alert(idCliente);
					
					//alert('usuario registrado');

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
					alert(idCliente);


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
				}
				else{
					//alert('Registrar cliente');
					//----------------------------------------------------------
					//-----------El usuario no esta registrado------------------
					//----------------------------------------------------------



					


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
		alert('Rellenar campo');
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