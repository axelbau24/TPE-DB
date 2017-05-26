$(document).ready(function(e){

  $(document).on("focus", ".input-e, .form-control-n", function(){
      $(this)
      .prop("readonly", false)
      .removeClass("editable");
  });

  $(document).on("blur", ".input-e, .form-control-n", function(){
      $(this)
      .prop("readonly", true)
      .addClass("editable")
      .siblings("span").text($(this).val());
  });

  $(document).on("click", "td", function(){
      $(this).children().focus();
  });


  // Agrego efecto de selección al hacer click en una imagen
  $(document).on("click", ".img-thumbnail", function(){
    $(this).toggleClass("check");
  });

  // Configuración plugin de alertas
  toastr.options = {
    "debug": false,
    "newestOnTop": false,
    "positionClass": "toast-bottom-right",
    "closeButton": true,
    "timeOut": "1600"
  };

  // Cambio de la clase "active" entre los menús
  $("nav li a").click(function() {
    $("nav li a").each(function() {
      $(this).parent().removeClass("active");
    });
    $(this).parent().addClass("active");
  });

  $("li a div").click(function() {
    $("li a div").each(function() { $(this).removeClass("panel-c-warning"); });
    $(this).addClass("panel-c-warning");
  });

});
