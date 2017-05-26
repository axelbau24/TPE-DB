$(document).ready(function(e){
  // Al ingresar a la página muestra el menu de agregar deportistas
  $.get( "index.php?action=home", function(data) {$(".listado").html(data);});

  // Se agrega /click o /submit para arreglar carga del selector despues de partial render
  addAjax(".nav-home/click", "home", ".listado", 0, 0);
  addAjax(".nav-comp/click", "agregar_competencia", ".listado", 0, 0);
  addAjax(".nav-inscripciones/click", "inscripcion", ".listado", 0, 0);
  addAjax(".nav-componentes/click", "admin_componentes", ".listado", 0, 0);
  addAjax(".nav-categorias/click", "admin_categorias", ".listado", 0, 0);
  addAjax(".nav-consultas/click", "mostrar_consultas", ".listado", 0, 0);
  addAjax(".nav-contacto/click", "agregar_consulta", ".listado", 0, 0);
  addAjax(".categorias/click", "filtrar_categoria&categoria=", ".cat-");
  addAjax(".addCompetencia/submit", "agregar_competencia", ".listado", "La competencia fué agregada correctamente", 0);
  addAjax(".addDeportista/submit", "agregar_deportista", ".listado", "La competencia fué agregada correctamente", 0);
  addAjax(".borrarCategoria/submit", "eliminar_categoria&id=", ".listado", "La categoría se eliminó correctamente");
  addAjax(".editarCategoria/submit", "editar_categoria&id=", ".listado", "La categoría se editó correctamente");
  addAjax(".addComponente/submit", "agregar_componente", ".listado", "El componente se agregó correctamente", 0);
  addAjax(".editarComponente/submit", "editar_componente&id=", ".listado", "El componente se editó correctamente");
  addAjax(".mostrarComponente/click", "mostrar_componente&id=", ".listado", 0, 1, function() {
    var id_componente = $(".comentarios").attr("data-id");
    obtenerComentarios(id_componente);
  });
  addAjax(".eliminarRol/click", "eliminar_rol&id_rol=", ".listado", "El rol se eliminó correctamente");
  addAjax(".eliminarComponente/click", "eliminar_componente&id=", ".listado", "El componente se eliminó correctamente");
  addAjax(".addCategoria/submit", "agregar_categoria", ".listado", "La categoría se agregó correctamente", 0);
  addAjax(".addUsuario/submit", "agregar_usuario", ".listado", "El usuario se agregó correctamente", 0);
  addAjax(".addRol/submit", "agregar_rol", ".listado", "El rol fue creado correctamente", 0);
  addAjax(".agregarComentario", "agregar_comentario", ".listado", "El comentario se agregó correctamente", 0);
  addAjax(".buscarUsuario/submit", "buscar_usuario&id=", ".listado");
  addAjax(".eliminarConsulta/click", "eliminar_consulta&id=", ".listado", "La consulta se eliminó correctamente");
  addAjax(".eliminarUsuario/click", "eliminar_usuario&id=", ".listado", "El usuario se eliminó correctamente");
  addAjax(".editarUsuario/submit", "editar_usuario&id=", ".listado", "El usuario se editó correctamente");
  addAjax(".config/click", "configurar_perfil", ".listado",0,0);
  addAjax(".editarPerfil/submit", "configurar_perfil", ".listado","El perfil se editó correctamente", 0);
  addAjax(".contacto/submit", "agregar_consulta", ".listado", "La consulta se envió correctamente", 0, function() {
    $("input, textarea").each(function() {
      $("input, textarea").val("");
    });
  });



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
  ev.preventDefault();
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


$(document).on('click', '.borrarComentario', function(ev) {
  ev.preventDefault();
  var comentario = $(this).parents(".comentario");
  var id =  $(this).attr("data-id");
  $.ajax({
    type: "DELETE",
    url: 'api/comentarios/' + id,
    success: function(){
      comentario.hide("slow", function(){ comentario.remove(); });
    }
  });
});

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

// Sección Lista de categorias, se usa esto para mostrar los componentes en esa categoria
$(document).on("click", ".categorias", function() {
  $(this).parent().find("div").toggle();
});

// Filtro de categorias obtenido por base de datos
$(document).on('change', '.categorias', function() {
  var valor = $(this).val();
  var url = "index.php?action=filtrar_categoria&id=" + valor;
  if(valor == 0) url = "index.php?action=home";
  $.get(url, function(data) {
    if(valor == 0) $(".listado").html(data)
    else $(".contenido-componentes").html(data);
  });
});


$(document).on('change', '.roles', function() {
  var id = $(this).val();
  var url = "index.php?action=admin_roles&filtrar_rol=" + id;
  $.get(url, function(data) {
    $(".listado").html(data);
  });
});

$(document).on('click', '.guardarUsuario', function(ev) {
  ev.preventDefault();
  var idUsuario = $(this).attr("data-id");
  var inputs = $(this).parents(".usuario").find(".input-e");
  var usuario = {
    username: $(inputs[0]).val(),
    email: $(inputs[1]).val(),
    rol: $(inputs[2]).find(":selected").attr("data-id")
  }
  $.post( "index.php?action=editar_usuario&id=" + idUsuario, usuario, function( data ) {
    if(data != "") toastr.success("Los datos del usuario fueron actualizados correctamente");
    else toastr.error("Hubo un error al ejecutar la acción");
    $(".listado").html(data)
  });
});

var cantUsuarios;
$(document).on('click', '.mostrarMas', function(ev) {
  ev.preventDefault();
  cantUsuarios = $(".usuario").length + 2;
  $.get( "index.php?action=admin_usuarios&cantUsuarios=" + cantUsuarios, function(data) {
    $(".listado").html(data);
  });
});


});
