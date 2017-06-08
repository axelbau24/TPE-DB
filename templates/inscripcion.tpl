
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
            <form class="inscribir" method="post">
              <div class="row">
                <div class="form-group col-lg-6"><label for="tipo">Tipo de inscripcion:</label>
                  <select name="tipo" class="form-control tipoCompetencia">
                    <option value="1">Individual</option>
                    <option value="0">Grupal</option>
                  </select>
                </div>


                <div class="form-group col-lg-6"><label for="competencia">Competencia:</label>
                  <select name="competencia" class="form-control">
                    {foreach from=$competencias item=competencia}
                    <option class="optCompetencia {if $competencia["individual"] == '0'}hidden{/if}" tipo="{$competencia["individual"]}" value="{$competencia["idcompetencia"]}">{$competencia["nombre"]}</option>
                    {/foreach}
                  </select>
                </div>

                <div class="form-group s_deportista col-lg-6"><label for="deportista">Deportista:</label>
                  <select name="deportista" class="form-control">
                    {foreach from=$deportistas item=deportista}
                    <option value="{$deportista["tipodoc"]}.{$deportista["nrodoc"]}">{$deportista["nombre"]} {$deportista["apellido"]}</option>
                    {/foreach}
                  </select>
                </div>

                <div class="hidden s_equipo form-group col-lg-6"><label for="equipo">Equipo:</label>
                  <select class="form-control">
                    {foreach from=$equipos item=equipo}
                    <option value="{$equipo["id"]}">{$equipo["nombre"]}</option>
                    {/foreach}
                  </select>
                </div>

                <div class="hidden form-group col-lg-6"><label for="fecha">Fecha inscripción:</label>
                  <input type="date" class="form-control fechaInscripcion">
                </div>

                <div class="form-group col-lg-12">
                  <div class="checkbox"><label><input class="fechaInsc" type="checkbox" checked>Utilizar fecha de hoy para la inscripción</label></div>
                </div>

              </div>
              <button type="submit" class="btn btn-default">Inscribir</button>
            </form>
          </div>
        </div>
      </div>

    </div>
  </section>
