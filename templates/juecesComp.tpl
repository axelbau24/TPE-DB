<section class="content">
<div class="container-fluid">
  <div class="row">
    <div class="col-lg-12">
      <div class="view-header">

        <div class="header-title">
          <h3 class="m-b-xs">Listado de competencias de un juez</h3>
          <small>Competencias en la cual el juez participó inscripto.</small>
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
              <form class="selecJueces form-inline" method="post">
                <h4>Seleccione juez:</h4>
                <div class="form-group">
                      <select name="juez" class="form-control">
                          {foreach from=$jueces item=juez}
                          <option value="{$juez["tipodoc"]}.{$juez["nrodoc"]}">{$juez["nombre"]} {$juez["apellido"]}</option>
                          {/foreach}
                      </select>
                </div>
                  <button type="submit" class="btn btn-default">Enviar</button>
                </form>

                <br>
                {if count($competencias) > 0}
                <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Nombre competencia</th>
                        <th>Lugar</th>
                        <th>Fecha</th>
                        <th>Localidad</th>
                        <th>Organizador</th>
                      </tr>
                    </thead>
                    <tbody>
                      {foreach from=$competencias item=competencia}
                      <tr>
                        <td>
                          <span>{$competencia["nombre"]}</span>
                        </td>
                        <td>
                          <span>{$competencia["nombrelugar"]}</span>
                        </td>
                        <td>
                          <span>{$competencia["fecha"]}</span>
                        </td>
                        <td>
                          <span>{$competencia["nombrelocalidad"]}</span>
                        </td>
                        <td>
                          <span>{$competencia["organizador"]}</span>
                        </td>
                      </tr>
                      {/foreach}
                    </tbody>
                  </table>
                </div>
                {else if count($juez) > 0}
                <h3>El juez no participó en ninguna competencia.</h3>
                {/if}
            </div>
          </div>
        </div>
      </div>

    </div>

  </div>
</section>
