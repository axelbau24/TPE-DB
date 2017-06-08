<?php
include_once("view/ViewCompetencias.php");
include_once("models/ModelCompetencias.php");
include_once("models/ModelDeportistas.php");

class CompetenciasController{

  private $model;
  private $view;
  private $modelDeportistas;

  function __construct(){
    $this->view = new ViewCompetencias();
    $this->model = new ModelCompetencias();
    $this->modelDeportistas = new ModelDeportistas();
  }

  // Se muestra el listado de los deportistas inscriptos en alguna competencia
  // Si no se selecciono competencia, solo se muestra el menú desplegable para elegir la misma.
  function listado_deportistas(){
    $deportistas = [];
    $competenciaInscripto = [];
    $competencias = $this->model->getCompetencias();;

    if(isset($_POST["competencia"])){
      $deportistas = $this->modelDeportistas->getDepInscriptos($_POST["competencia"]);
      $competenciaInscripto = $this->model->getCompetencia($_POST["competencia"]);
    }

    $this->view->mostrarListadoDeportistas($deportistas, $competencias, $competenciaInscripto);
  }

  // Se muestra el listado de jueces que estuvieron inscriptos en alguna competencia
  // Si no se selecciono competencia, solo se muestra el menu desplegable
  function listado_jueces(){
    $competencias = [];
    $juez = [];

    if(isset($_POST["juez"])){
      $datosJuez = explode(".", $_POST["juez"]);
      $competencias = $this->model->getJuezComIncriptos($datosJuez);
      $juez = $datosJuez;
    }

    $jueces = $this->model->getJueces();

    $this->view->mostrarListadoJueces($jueces, $competencias, $juez);
  }

  // Se obtienen todos los datos desde el formulario para realizar la inscripcion de un equipo o un deportista
  function inscripcion(){
    $competencias = $this->model->getCompetencias();
    $deportistas = $this->modelDeportistas->getDeportistas();
    $equipos = $this->modelDeportistas->getEquipos();
    $mensajeDb = null;
    $fecha = null;

    if(isset($_POST["competencia"]) && isset($_POST["tipo"])){

      if(isset($_POST["fecha"])) $fecha = $_POST["fecha"];
      else $fecha = date("Y-m-d");

      if(isset($_POST["deportista"])){
          $datosDeportista = explode(".", $_POST["deportista"]);
          $mensajeDb = $this->modelDeportistas->asociarDeportista($datosDeportista , $_POST["competencia"], $fecha);
      }
      else if (isset($_POST["equipo"])){
          $mensajeDb = $this->modelDeportistas->asociarEquipo($_POST["equipo"] , $_POST["competencia"], $fecha);
      }


    }

    if(empty($mensajeDb)) $this->view->mostrarMenuInscripcion($competencias, $deportistas, $equipos);
    else $this->view->showError($mensajeDb);
  }

  // Se obtienen todos los datos desde el formulario necesarios para crear una competencia
  // Los jueces son asociados a esta luego de su creacion.
  function agregar_competencia(){
    $juecesActuales = $this->model->getJueces();
    $mensajeDb = null;

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

      $mensajeDb = $this->model->addCompetencia($competencia, $jueces);
    }

    $disciplinas = $this->model->getDisciplinas();
    if(empty($mensajeDb)) $this->view->mostrarMenuAgregar($disciplinas, $juecesActuales);
    else if(count($jueces) == 0) $this->view->showError("ERROR: Debe haber seleccionado al menos un juez");
    else $this->view->showError("ERROR: Hubo un error");
  }

  // Comprueba que los datos del formulario sean los requeridos
  private function datosValidos(){
    return isset($_POST["name"]) && isset($_POST["disciplina"]) && isset($_POST["fecha"]) && isset($_POST["lugar"]) &&
    isset($_POST["localidad"]) && isset($_POST["coberturaTv"]) &&
    isset($_POST["fechaLimite"]) && isset($_POST["mapa"]) && isset($_POST["web"]);
  }


}

?>
