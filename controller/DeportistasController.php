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
    print_r($_POST);
  }

}

?>
