
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <div class="view-header">

          <div class="header-title">
            <h3 class="m-b-xs">Competencias deportivas - Nueva competencia</h3>
            <small>Agrega una nueva competencia.</small>
          </div>
        </div>
        <hr>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-filled">
          <div class="panel-heading">
            Nueva competencia
          </div>
          <div class="panel-body">
              <form class="addCompetencia" method="post">
              <div class="row">
                <div class="form-group col-lg-6"><label for="name">Nombre:</label>
                  <input type="name" required class="form-control" name="name" placeholder="Nombre">
                </div>

                <div class="form-group col-lg-6"><label for="disciplina">Disciplina:</label>
                      <select name="disciplina" class="form-control">
                          {foreach from=$disciplinas item=disciplina}
                          <option value="{$disciplina["cdodisciplina"]}">{$disciplina["nombre"]}</option>
                          {/foreach}
                      </select>
                </div>

                <div class="form-group col-lg-6"><label for="fecha">Fecha:</label>
                   <input type="date" class="form-control" name="fecha">
                </div>

                <div class="form-group col-lg-6"><label for="lugar">Lugar:</label>
                  <input type="name" required class="form-control" name="lugar" placeholder="ej. Urquiza 356" required>
                </div>

                <div class="form-group col-lg-6"><label for="organizador">Organizador:</label>
                  <input type="name" required class="form-control" name="organizador" placeholder="ej. Roberto" required>
                </div>

                <div class="form-group col-lg-6"><label for="localidad">Localidad:</label>
                  <input type="name" required class="form-control" name="localidad" placeholder="ej. Capital Federal" required>
                </div>

                <div class="form-group col-lg-6"><label for="individual">Tipo competencia:</label>
                      <select name="individual" class="form-control">
                          <option value="1">Individual</option>
                          <option value="0">Grupal</option>
                      </select>
                </div>

                <div class="form-group col-lg-6"><label for="jueces">Jueces:</label>
                    <div class="form-group">
                          {foreach from=$jueces item=juez}
                          <div class="checkbox"><label><input type="checkbox" name="juez_{$juez["tipodoc"]}.{$juez["nrodoc"]}">{$juez["nombre"]} {$juez["apellido"]}</label></div>
                          {/foreach}
                    </div>
                </div>

                <div class="form-group col-lg-6"><label for="coberturaTv">¿Tiene cobertura por TV?:</label>
                      <select name="coberturaTv" class="form-control">
                          <option value="1">Si</option>
                          <option value="0">No</option>
                      </select>
                </div>

                <div class="form-group col-lg-6"><label for="fechaLimite">Fecha límite inscripción:</label>
                   <input type="date" class="form-control" name="fechaLimite">
                </div>

                <div class="form-group col-lg-6"><label for="mapa">Mapa:</label>
                  <input type="name" class="form-control" name="mapa" placeholder="Mapa">
                </div>

                <div class="form-group col-lg-6"><label for="web">Página web:</label>
                  <input type="name" class="form-control" name="web" placeholder="http://lacompetencia.com">
                </div>
              </div>
                  <button type="submit" class="btn btn-default">Crear</button>
                </form>
            </div>
          </div>
        </div>

      </div>
</section>
