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
    $("#text-alerta").text("Prueba");
  }

  setTextoAlerta(texto){
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

  mostrarAlerta() {
    $("#alerta").fadeIn(1000);
    $("#alerta").fadeOut(4000);
  }

  setTextoDecision(texto){
    $("#text-decision").text(texto);
  }

  mostrarDecision() {
    $("#decision").fadeIn(500);
    $("#decision").fadeOut(2000);
  }

  static ocultarAlerta() {
    $("#alerta").hide();
  }

  static mantenerAlerta(){
    $("#alerta").show();
  }

  static ocultarDecision() {
    $("#decision").hide("slow");
  }

  static mantenerDecision(){
    $("#decision").show();
  }
}