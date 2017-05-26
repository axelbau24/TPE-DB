$(document).ready(function(e){
  // Funcionalidad para el formulario de registro
  $('#passwordCheck').on('input', function() {
    var changer = $("#pwseguridad");
    var valor = $(this).val();
    var cantNumeros = valor.replace(/[^0-9]/g,"").length + 1;
    var cantLetrasUpper = valor.replace(/[^A-Z]/g,"").length + 1;
    var cantEspeciales = valor.match(/[@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/g);
    var nivel = cantLetrasUpper * cantNumeros + valor.length + 1 + (cantEspeciales ? cantEspeciales.length : 0 + 1 * 5);
    if(nivel < 20) changer.html("Insegura").attr('class', 'pwseguridad');
    else if(nivel < 30) changer.html("Mediana").attr('class', 'pwseguridad-med pwseguridad');
    else if(nivel < 40)changer.html("Buena").attr('class', 'pwseguridad-high pwseguridad');
    else if(nivel < 55)changer.html("Extrema").attr('class', 'pwseguridad-ext pwseguridad');
    checkChange($(this));
  });

 $('#newPasswordCheck').on('input', function() { checkChange($(this)); });

  function checkChange(selector) {
    $(selector).next().removeClass("hidden");
    var pw_input1 = $("#passwordCheck");
    var pw_input2 = $("#newPasswordCheck");
    var msg_match = $(".msg-match");
    var submit_button = $(".btn-default");
    if(pw_input1.val() == pw_input2.val()) {
      pw_input2.next().removeClass("glyphicon-remove error-icon").addClass("glyphicon-ok success-icon");
      submit_button.removeAttr("disabled");
      msg_match.addClass("hidden");
    } else {
      pw_input2.next().removeClass("glyphicon-ok success-icon").addClass("glyphicon-remove error-icon");
      submit_button.attr("disabled", "true");
      msg_match.removeClass("hidden");
    }
  }
});
