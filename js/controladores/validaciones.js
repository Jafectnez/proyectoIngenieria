class Forma {
  constructor(id) {
    this.id = id;
    this.inputs = [];
    this.btnEnvio = '';
    this.btnUpdate = '';
  }

  addInput(id, regexp, required){
    regexp = regexp || /^.+$/ ; 
    let flag = (required == true) ? true : false;
    this.inputs[id] = {pattern: regexp, mandatory: flag, ready: false}
  }

  validate(id){
    if (this.inputs[id]) { 
      let value = $("#" + id).val();
      let regexp = this.inputs[id].pattern;
      let flag = this.inputs[id].mandatory;
      if (value == '' && flag === true){
        $("#" + id).removeClass('is-valid');
        if (flag){  
          $("#" + id).addClass('is-invalid');
        }
        this.inputs[id].ready = false || !flag;
        $("#" + id).next('.invalid-feedback').children('span').html("Campo requerido");
      }
      else if (!regexp.exec(value)) {
        $("#" + id).removeClass('is-valid');
        if (flag){
          $("#" + id).addClass('is-invalid');
        }
        this.inputs[id].ready = false || !flag;
        $("#" + id).next('.invalid-feedback').children('span').html("El valor del campo no es válido");
      } else {
        $("#" + id).addClass('is-valid');
        $("#" + id).removeClass('is-invalid');
        $("#" + id + "-validate").html("");
        this.inputs[id].ready = true;
      }
    }
    this.updateButton(this.btnEnvio);
    this.updateButton(this.btnUpdate);
  }

  setButtonEnvio(btnId){
    this.btnEnvio = btnId;
    this.updateButton();
  }

  setButtonUpdate(btnId){
    this.btnUpdate = btnId;
  }

  updateButton (btn) {
    let value = true;
    for(let key in this.inputs){
      value = value && this.inputs[key].ready;
    }
    if (value){ 
      $(`#${this.id} #${btn}`).removeAttr('disabled');
    } else {
      $(`#${this.id} #${btn}`).attr("disabled", "disabled");
    }
  }

  static addTrigger(form){

    $(`#${form.id} .form-control`).on('input',function(){
      let id = this.id;
      form.validate(id);
    });

    $(`#${form.id} .selectpicker`).on('change',function(){
      let id = this.id;
      form.validate(id);
    });

    $('button[data-toggle="modal"].btn-primary').click(function(event) {
      $("input.form-control").removeClass('is-valid');
      $("input.form-control").removeClass('is-invalid');
    });

  }

  validateAll(){
      for(let key in this.inputs){
        this.validate(key);
      }
  }
}

//=====================Promociones============================
$("#crearPromo").click(function(argument){
  console.log("HJGKJHG");
  if ($("#descripcion").val() != "") {
    let hoy = new Date();
    let fecha1 = new Date($("#fecha-inicio").val());
    fecha1.setDate(fecha1.getDate()+1); // le sumo un dia, dado que la captura de la fecha la realizaba con un dia de retraso
    let fecha2 = new Date($("#fecha-final").val());    
    fecha2.setDate(fecha2.getDate()+1);
    hoy.setHours(0,0,0,0); // iniciamos en 00:00 horas, se comparan las fechas, no las horas    
    if (hoy <= fecha1) {      
      if (fecha1 <= fecha2) {
        //============================================
        
        //============================================
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