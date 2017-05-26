
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <div class="view-header">

          <div class="header-title">
            <h3 class="m-b-xs">Competencias deportivas - Nuevo deportista</h3>
            <small>Agrega nuevos deportistas.</small>
          </div>
        </div>
        <hr>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-filled">

          <div class="panel-body">
              <form class="addDeportista" method="post">
              <div class="row">
                <div class="form-group col-lg-6"><label for="persona">Persona:</label> <!-- personas que no son deportistas -->
                      <select name="persona" class="form-control">
                          {foreach from=$personas item=persona}
                          <option value="{$persona["tipodoc"]}..{$persona["nrodoc"]}">{$persona["nombre"]} {$persona["apellido"]}</option>
                          {/foreach}
                      </select>
                </div>

                <div class="form-group col-lg-6 "><label for="federacion">Federación:</label>
                      <select name="federacion" class="form-control federacion">
                          <option value="0">Ninguna</option>
                          {foreach from=$federaciones item=federacion}
                          <option value="{$federacion["cdodisciplina"]}">{$federacion["nombre"]} </option>
                          {/foreach}
                      </select>
                </div>

                <div class="form-group col-lg-6 hidden licencia"><label for="licencia">Número licencia:</label>
                  <input type="text" class="form-control" name="" placeholder="ej. AT84F15">
                </div>

                <div class="form-group col-lg-6"><label for="categoria">Categoría:</label>
                      <select name="categoria" class="form-control">
                          {foreach from=$categorias item=categoria}
                          <option value="{$categoria["cdodisciplina"]}.{$categoria["cdocategoria"]}">{$categoria["nombre"]} - {$categoria["cdodisciplina"]}{$categoria["cdocategoria"]} </option>
                          {/foreach}
                      </select>
                </div>

                <div class="form-group col-lg-6"><label for="categoria">Asociar a competencia:</label>
                      <select name="categoria" class="form-control">
                          <option value="0">Ninguna</option>
                          {foreach from=$competencias item=competencia}
                          <option value="{$competencia["idcompetencia"]}">{$competencia["nombre"]}</option>
                          {/foreach}
                      </select>
                </div>



              </div>
                  <button type="submit" class="btn btn-default">Enviar</button>
                </form>
            </div>
          </div>
        </div>

      </div>
</section>
