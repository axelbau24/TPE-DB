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
                <h4>Juez:</h4>
                <div class="form-group">
                      <select name="juez" class="form-control">
                          {foreach from=$jueces item=juez}
                          <option value="{$juez["tipodoc"]}.{$persona["nrodoc"]}">{$persona["nombre"]} {$persona["apellido"]}</option>
                          {/foreach}
                      </select>
                </div>
                  <button type="submit" class="btn btn-default">Enviar</button>
                </form>

                <br>
                <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>{$competencia["nombre"]}</th>
                        <th>{$competencia["fecha"]}</th>
                        <th>{$competencia["cdoDisciplina"]}</th>
                        <th>{$competencia["web"]}</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>
                          <span>asd 1 1</span>
                        </td>
                        <td>
                          <span>asd 1 2</span>
                        </td>
                        <td>
                          <span>asd 1 3</span>
                        </td>
                        <td>
                          <span>asd 1 4</span>
                        </td>
                      </tr>

                      <tr>
                        <td>
                          <span>asd 2 1</span>
                        </td>
                        <td>
                          <span>asd 2 2</span>
                        </td>
                        <td>
                          <span>asd 2 3</span>
                        </td>
                        <td>
                          <span>asd 2 4</span>
                        </td>
                      </tr>

                      <tr>
                        <td>
                          <span>asd 3 1</span>
                        </td>
                        <td>
                          <span>asd 3 2</span>
                        </td>
                        <td>
                          <span>asd 3 3</span>
                        </td>
                        <td>
                          <span>asd 3 4</span>
                        </td>
                      </tr>

                    </tbody>
                  </table>
                </div>
            </div>
          </div>
        </div>
      </div>

    </div>

  </div>
</section>
