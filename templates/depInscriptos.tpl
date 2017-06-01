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
              <form class="getCompetencias form-inline" method="post">
                <h4>Seleccione competencia:</h4>
                <div class="form-group"> 
                      <select name="competencias" class="form-control">
                          {foreach from=$competencias item=competencia}
                          <option value="{$competencia["idCompetencia"]}">{$competencia["nombre"]}</option>
                          {/foreach}
                      </select>
                </div>
                </div>
                  <button type="submit" class="btn btn-default">Enviar</button>
                </form>

                <br>
                <div class="table-responsive">
                  <table class="table" name="persona"> 
                    <thead>
                      <tr>
                        <th>{$persona["nombre"]}</th>
                        <th>{$persona["apellido"]}</th>
                        <th>$persona["tipodoc"]}</th>
                        <th>{$persona["nrodoc"]}</th>
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
