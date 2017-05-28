<?php
include_once("view/ViewDeportistas.php");
include_once("models/ModelDeportistas.php");
include_once("models/ModelCompetencias.php");

class DeportistasController{

  private $model;
  private $modelCompetencias;
  private $view;

  function __construct(){
    $this->view = new ViewDeportistas();
    $this->model = new ModelDeportistas();
    $this->modelCompetencias = new ModelCompetencias();
  }

  function home(){
    $personas = $this->model->getPersonas();
    $categorias = $this->model->getCategorias();
    $federaciones = $this->model->getFederaciones();
    $competencias = $this->modelCompetencias->getCompetencias();

    $this->view->mostrarMenuDeportista($personas, $categorias, $federaciones, $competencias);
  }

  function iniciar() {
    $this->view->mostrarHome();
  }

  function agregar_deportista(){
    if(isset($_POST["persona"]) && isset($_POST["federacion"]) && isset($_POST["categoria"]) && isset($_POST["competencia"])){
        $datosPersona = explode(".", $_POST["persona"]);
        $categoria = explode(".",$_POST["categoria"]);
        $fed = explode(".",$_POST["federacion"]);

        $seleccionoFed = $_POST["federacion"] == "0" ? false : true;

        $deportista = array(
            $datosPersona[0], // tipo documento
            $datosPersona[1], // numero documento
            $seleccionoFed ? '1' : '0', // si es federado (si se elige una federacion, es si)
            $seleccionoFed ? date("Y-m-d") : null, // si fue federado, se le agrega la fecha de hoy, sino null
            isset($_POST["licencia"]) ? $_POST["licencia"] : null, // numero de licencia
            $categoria[1], // codigo categoria
            $categoria[0], // codigo disciplina de la categoria
            $seleccionoFed ? $fed[0] : null, // codigo federacion (si se selecciono)
            $seleccionoFed ? $fed[1] : null, // codigo discplina de la federacion (si se selecciono)
        );
        if($_POST["competencia"] == '0') $this->model->addDeportista($deportista);
        else $this->model->addDeportistaAsociar($deportista, $_POST["competencia"]);
        $this->home();
    }
  }

}

?>
