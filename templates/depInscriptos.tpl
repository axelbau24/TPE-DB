<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <div class="view-header">

          <div class="header-title">
            <h3 class="m-b-xs">Listado de deportistas</h3>
            <small>Deportistas inscriptos en alguna competencia</small>
          </div>
        </div>
        <hr>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="row">
          <div class="col-md-12">
            <div class="panel panel-filled">
              <div class="panel-heading">
                <form class="selecCompetencia form-inline" method="post">
                  <h4>Seleccione competencia:</h4>
                  <div class="form-group">
                    <select name="competencia" class="form-control">
                      {foreach from=$competencias item=competencia}
                      <option value="{$competencia["idcompetencia"]}">{$competencia["nombre"]}</option>
                      {/foreach}
                    </select>
                  </div>
                  <button type="submit" class="btn btn-default">Enviar</button>
                </form>


                {if count($competencia) != 0}
                <br><br>
                <h4><span>Deportistas inscriptos en <strong><i>{$competencia["nombre"]}</i></strong></span></h4>
                {if count($deportistas) == 0} <span>No existen deportistas inscriptos en esta competencia.</span>{/if}
                {/if}

                {if count($deportistas) > 0}
                <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Documento</th>
                        <th>Categoría</th>
                        <th>Dirección</th>
                        <th>Localidad</th>
                      </tr>
                    </thead>
                    <tbody>
                      {foreach from=$deportistas item=deportista}
                      <tr>
                        <td>
                          <span>{$deportista["nombre"]}</span>
                        </td>
                        <td>
                          <span>{$deportista["apellido"]}</span>
                        </td>
                        <td>
                          <span>{$deportista["tipodoc"]} - {$deportista["nrodoc"]}</span>
                        </td>
                        <td>
                          <span>{$deportista["cdocategoria"]} - {$deportista["cdodisciplina"]}</span>
                        </td>
                        <td>
                          <span>{$deportista["direccion"]}</span>
                        </td>
                        <td>
                          <span>{$deportista["nombrelocalidad"]}</span>
                        </td>
                      </tr>
                      {/foreach}
                    </tbody>
                  </table>
                </div>
                {/if}
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>
  </section>
