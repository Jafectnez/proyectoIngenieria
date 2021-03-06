var respuesta = false; // este bool se usara para validar promociones con 0% descuento

//=====================Empleados============================
function validarCampoVacio(campo, regex = /.+/){
  if ($("#"+campo).val() ==''){
    $("#"+campo).css('color', 'red');
    $("#"+campo).css('border', 'solid 1px red');
    return false;

  }else if(regex.exec($("#"+campo).val())){
    $("#"+campo).css('color', 'green');
    $("#"+campo).css('border', 'solid 1px green');
    return true;

  }else{
    $("#"+campo).css('color', 'red');
    $("#"+campo).css('border', 'solid 1px red');
    return false;
  }
}
//=====================Fin empleados========================

//=====================Promociones============================

function descuento(){
  if ($("#descuento").val() > 0 && $("#descuento").val() <= 100) {
    return true;    
  } else {
    return false;   
  }
}

$("#crearPromo").click(function(argument){
  if ($("#descripcion").val() != "") {
    let hoy = new Date();
    let fecha1 = new Date($("#fecha-inicio").val());
    fecha1.setDate(fecha1.getDate()+1); // le sumo un dia, dado que la captura de la fecha la realizaba con un dia de retraso
    let fecha2 = new Date($("#fecha-final").val());
    fecha2.setDate(fecha2.getDate()+1);
    hoy.setHours(0,0,0,0); // iniciamos en 00:00 horas, se comparan las fechas, no las horas
    if (hoy <= fecha1) {      
      if (fecha1 <= fecha2) {
        if(descuento()){
          AddPromos();       
        }else{
          $("#msj").html("Favor revisar los descuentos.");
          window.setTimeout(function() { 
          $("#msj").html("");
        }, 2500);
        }
      } else {
        $("#msj").html("La fecha final, no puede ser menor a la fecha de inicio");
        window.setTimeout(function() { 
          $("#msj").html("");
        }, 2500);
      }
      
    }
    else {
      $("#msj").html("La fecha de inicio, no puede ser inferior a la fecha actual");
      window.setTimeout(function() {
        $("#msj").html("");
      }, 2500);
    }    
  } else {
    $("#msj").html("Favor llenar los campos obligatorios");
    window.setTimeout(function() {
      $("#msj").html("");
    }, 2500);
  }
});


 
//=====================Fin promociones========================

