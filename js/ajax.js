$(document).ready(function(e){
  // Al ingresar a la página muestra el menu de agregar deportistas
  $.get( "index.php?action=home", function(data) {$(".listado").html(data);});

  // Se agrega /click o /submit para arreglar carga del selector despues de partial render
  addAjax(".nav-home/click", "home");
  addAjax(".nav-comp/click", "agregar_competencia");
  addAjax(".nav-inscripciones/click", "inscripcion");
  addAjax(".nav-deportistas/click", "listado_deportistas");
  addAjax(".nav-jueces/click", "listado_jueces");
  addAjax(".selecCompetencia/submit", "listado_deportistas");
  addAjax(".selecJueces/submit", "listado_jueces");
  addAjax(".inscribir/submit", "inscripcion", "La inscripción se realizo correctamente");
  addAjax(".addCompetencia/submit", "agregar_competencia", "La competencia fué agregada correctamente");
  addAjax(".addDeportista/submit", "agregar_deportista", "La competencia fué agregada correctamente");

$(document).on('change', '.federacion', function(ev) {
  let valor = $(this).val();
  let input = ".licencia";
  if(valor != 0){
    $(input).removeClass("hidden");
    $(input + " input").attr("name", "licencia");
  }
  else {
    $(input).addClass("hidden");
    $(input + " input").attr("name", "");
  }
});


$(document).on('change', '.tipoCompetencia', function(ev) {
  let valor = $(this).val();

  $(".optCompetencia").each(function() {
    let opt = $(this);
    if(opt.attr("tipo") != valor) opt.addClass("hidden");
    else {
       $(this).parent().val(opt.val());
       opt.removeClass("hidden");
    }
  });

  let selectDeportista = ".s_deportista";
  let selectEquipo = ".s_equipo";

  $(selectDeportista).toggleClass("hidden");
  $(selectEquipo).toggleClass("hidden");
  updateSelects("deportista", selectDeportista);
  updateSelects("equipo", selectEquipo);

});


function updateSelects(name, selector) {
  if ($(selector + ' select').attr('name')) {
      $(selector + ' select').removeAttr('name');
  }
  else $(selector + ' select').attr("name", name);
}

// Función genérica para ajax
function addAjax(selector, action, msgSuccess) {
  var datos = selector.split("/");
  var tipo = datos[1];
  selector = datos[0];
  $(document).on(tipo, selector, function(ev) {
    $(".carga").toggleClass("hidden");

    var formData = new FormData(this);
    var method = "GET";
    if (tipo == "submit") method = "POST";
    ev.preventDefault();
    $.ajax({
      method: method,
      url: "index.php?action="+ action,
      data: formData,
      contentType: false,
      cache: false,
      processData:false,
      success: function(data) {
        $(".listado").html(data);
        $(".modal-backdrop").remove();
        if(data == "") toastr.error("Hubo un error al ejecutar la acción");
        else if(msgSuccess != undefined) toastr.success(msgSuccess);
        $(".carga").toggleClass("hidden");

      }
    })
  });
}

});
