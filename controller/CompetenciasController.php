<?php
include_once("view/ViewCompetencias.php");
include_once("models/ModelCompetencias.php");

class CompetenciasController{

  private $model;
  private $view;
  private $modelDeportistas;

  function __construct(){
    $this->view = new ViewCompetencias();
    $this->model = new ModelCompetencias();
    $this->modelDeportistas = new ModelDeportistas();
  }


  function listado_deportistas(){
    $this->view->mostrarListadoDeportistas();
  }

  function listado_jueces(){
    $this->view->mostrarListadoJueces();
  }

  function inscripcion(){
    $competencias = $this->model->getCompetencias();
    $deportistas = $this->modelDeportistas->getDeportistas();
    $equipos = $this->modelDeportistas->getEquipos();
    // Array ([competencia] => 7 [equipo] => 1 )
    // Array ([competencia] => 1 [deportista] => DNI.19345244 )
    if(isset($_POST["competencia"]) && isset($_POST["tipo"]) && (isset($_POST["deportista"]) || isset($_POST["equipo"])) ){
      // inscribirlos
    }

    $this->view->mostrarMenuInscripcion($competencias, $deportistas, $equipos);
  }

  function agregar_competencia(){
    $juecesActuales = $this->model->getJueces();

    if($this->datosValidos()){
      $jueces = [];
      foreach ($juecesActuales as $juez) {
        if(isset($_POST["juez_" . $juez["tipodoc"]."_".$juez["nrodoc"]])) {
          array_push($jueces, $juez);
        }
      }

      $competencia = array(
        $_POST["disciplina"], // Código disciplina
        $_POST["name"], // Nombre competencia
        empty($_POST["fecha"]) ? null : $_POST["fecha"], // Fecha
        $_POST["lugar"], // Nombre lugar
        $_POST["localidad"], // Nombre localidad
        $_POST["organizador"], // Nombre organizador
        $_POST["individual"], // ¿Competencia individual?
        empty($_POST["fechaLimite"]) ? null : $_POST["fechaLimite"], // Fecha limite de inscripcion
        count($jueces), // Cantidad de jueces
        $_POST["coberturaTv"], // ¿Cobertura por tv?
        empty($_POST["mapa"]) ? null : $_POST["mapa"], // Mapa
        empty($_POST["web"]) ? null : $_POST["web"] // Pagina web
      );

      $this->model->addCompetencia($competencia, $jueces);
    }

    $disciplinas = $this->model->getDisciplinas();
    $this->view->mostrarMenuAgregar($disciplinas, $juecesActuales);
  }

  private function datosValidos(){
    return isset($_POST["name"]) && isset($_POST["disciplina"]) && isset($_POST["fecha"]) && isset($_POST["lugar"]) &&
    isset($_POST["localidad"]) && isset($_POST["coberturaTv"]) &&
    isset($_POST["fechaLimite"]) && isset($_POST["mapa"]) && isset($_POST["web"]);
  }


}

?>
