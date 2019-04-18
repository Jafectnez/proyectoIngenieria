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

function registrarFactura(){
	if( $('#chk-descuento').is(':checked')) {
    	var total = $('#txt-total-neto').val();
    	var totalNeto = parseInt(total);
    	var descuento =totalNeto * 0.25;
    	$('#txt-descuento').val(descuento);
	}
	$("input[type=checkbox]:checked").each(function(){
        //cada elemento seleccionado
        if ($(this).val() != 'on') {
        	alert($(this).val());
        }

    });
	alert(contador);
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
                'accion': 'obtener-promociones',
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

	var totalPromocion = $('#total-promocion').val();
	//var totalPromocion=document.getElementById('#total-promocion').value;
	console.log(totalPromocion);
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