
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <div class="view-header">

          <div class="header-title">
            <h3 class="m-b-xs">Competencias deportivas - Realizar inscripción</h3>
            <small>Inscribe un equipo o deportista a una competencia.</small>
          </div>
        </div>
        <hr>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-filled">
          <div class="panel-heading">
            Nueva inscripcion
          </div>
          <div class="panel-body">
              <form class="contacto" method="post">
              <div class="row">
                <div class="form-group col-lg-6"><label for="jueces">Competencia:</label>
                    <div class="form-group">
                      <select name="competencia" class="form-control">
                          {foreach from=$competencias item=competencia}
                          <option value="{$competencia["idcompetencia"]}">{$competencia["nombre"]}</option>
                          {/foreach}
                      </select>
                    </div>
                </div>

                <div class="form-group col-lg-6"><label for="disciplina">Deportista:</label>
                      <select name="deportista" class="form-control">
                          {foreach from=$deportistas item=deportista}
                          <option value="{$deportista["tipoDoc"]}.{$deportista["nroDoc"]}">{$deportista["nombre"]} {$deportista["apellido"]}</option>
                          {/foreach}
                      </select>
                </div>

                <div class="form-group col-lg-6"><label for="disciplina">Equipo:</label>
                      <select name="deportista" class="form-control">
                          {foreach from=$deportistas item=deportista}
                          <option value="{$deportista["tipoDoc"]}.{$deportista["nroDoc"]}">{$deportista["nombre"]} {$deportista["apellido"]}</option>
                          {/foreach}
                      </select>
                </div>

              </div>
                  <button type="submit" class="btn btn-default">Inscribir</button>
                </form>
            </div>
          </div>
        </div>

      </div>
</section>
