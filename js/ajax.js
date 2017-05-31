$(document).ready(function(e){
  // Al ingresar a la página muestra el menu de agregar deportistas
  $.get( "index.php?action=home", function(data) {$(".listado").html(data);});

  // Se agrega /click o /submit para arreglar carga del selector despues de partial render
  addAjax(".nav-home/click", "home", ".listado", 0, 0);
  addAjax(".nav-comp/click", "agregar_competencia", ".listado", 0, 0);
  addAjax(".nav-inscripciones/click", "inscripcion", ".listado", 0, 0);
  addAjax(".nav-deportistas/click", "listado_deportistas", ".listado", 0, 0);
  addAjax(".nav-jueces/click", "listado_jueces", ".listado", 0, 0);
  addAjax(".selecCompetencia/submit", "listado_deportistas", ".listado", 0, 0);
  addAjax(".selecJueces/submit", "listado_jueces", ".listado", 0, 0);
  addAjax(".inscribir/submit", "inscripcion", ".listado", "La inscripción se realizo correctamente", 0);
  addAjax(".addCompetencia/submit", "agregar_competencia", ".listado", "La competencia fué agregada correctamente", 0);
  addAjax(".addDeportista/submit", "agregar_deportista", ".listado", "La competencia fué agregada correctamente", 0);


$(document).on('submit', '.agregarComentario', function(ev) {
  ev.preventDefault();
  var comentario = $(this).serialize();
  $.post( "api/comentarios", comentario, function( comentarios ) {
    var rendered = Mustache.render(template,{comentarios});
    $(rendered).hide().appendTo(".comentarios").show("slow");
    $(".agregarComentario").find("textarea").val("");
  });
});

$(document).on('change', '.federacion', function(ev) {
  let valor = $(this).val();
  let input = ".licencia";
  if(valor != 0){ // TODO
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
function addAjax(selector, action, aCargar, msgSuccess, id, extra) {
  var datos = selector.split("/");
  var tipo = datos[1];
  selector = datos[0];
  $(document).on(tipo, selector, function(ev) {
    $(".carga").toggleClass("hidden");
    var formData = null;
    var method = "GET";
    if (tipo == "submit") {
      formData = new FormData(this);
      method = "POST";
    }
    ev.preventDefault();
    id = (id == 0) ? "" : $(this).attr("data-id");
    $.ajax({
      method: method,
      url: "index.php?action="+ action + id,
      data: formData,
      contentType: false,
      cache: false,
      processData:false,
      success: function(data) {
        if(aCargar.indexOf("-") >= 0) $(aCargar + id).html(data);
        else $(aCargar).html(data);
        $(".modal-backdrop").remove();
        if(extra != undefined) extra();
        if(msgSuccess != undefined && msgSuccess != 0 && data != "") toastr.success(msgSuccess);
        if(data == "") toastr.error("Hubo un error al ejecutar la acción");
        $(".carga").toggleClass("hidden");
      }
    })
  });
}

});
