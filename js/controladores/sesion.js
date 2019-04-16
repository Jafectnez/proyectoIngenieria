function iniciarSesion(){
      var usuario= $("#txt-Usuario").val();
      var contrasenia= $("#txt-Password").val();

       $.ajax({

   url:"ajax/acciones-sesion.php",
    data:{
            "accion":"iniciar-sesion",
            "txt-Usuario":usuario,
            "txt-Password":contrasenia
          },
    dataType: 'json ',
    method: "POST",
    success: function(respuesta){  
    console.log(respuesta) ;
           if (respuesta.loggedin==0) {

              $("#status").html(respuesta.mensaje);
            }
            else {
               if (respuesta.tipo_usuario==1) {
                  window.location="catalogo.php";
               }
               else if (respuesta.tipo_usuario==2) {
                  window.location="catalogo.php";
               }  
            }
    },
    error:function(e){
        console.log(e);
    }
  });
}
