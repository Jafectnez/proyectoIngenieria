class Popup {
  constructor() {
    var dir_alertaHTML = "alerta.txt";
    $.ajax({
      url : dir_alertaHTML,
      dataType: "text",
      success : function (data) 
      {
        $("body").prepend(data);
      }
    });
  }

  setTexto(texto){
    $("#text-alerta").text(texto);
  }

  correcto(){
    $("#icono-alerta").removeClass("glyphicon-remove");
    $("#icono-alerta").addClass("glyphicon-ok");
    $("#icono-alerta").css("color", "green");
  }

  incorrecto(){
    $("#icono-alerta").removeClass("glyphicon-ok");
    $("#icono-alerta").addClass("glyphicon-remove");
    $("#icono-alerta").css("color", "red");
  }

  mostrar() {
    $("#alerta").fadeIn(1000);
    $("#alerta").fadeOut(4000);
  }

  static ocultar() {
    $("#alerta").hide();
  }

  static mantener(){
    $("#alerta").show();
  }
}