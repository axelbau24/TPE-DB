<?php
include_once 'view/View.php';
class ViewCompetencias extends View{

  function __construct(){
    parent::__construct();
  }

  function mostrarListadoDeportistas($deportistas, $competencias, $competencia){
    $this->smarty->assign("deportistas", $deportistas);
    $this->smarty->assign("competencias", $competencias);
    $this->smarty->assign("competencia", $competencia);
    $this->smarty->display("depInscriptos.tpl");
  }

  function mostrarListadoJueces($jueces, $competencias, $juez){
    $this->smarty->assign("jueces", $jueces);
    $this->smarty->assign("juez", $juez);
    $this->smarty->assign("competencias", $competencias);
    $this->smarty->display("juecesComp.tpl");
  }

  function mostrarMenuAgregar($disciplinas, $jueces){
    $this->smarty->assign("disciplinas", $disciplinas);
    $this->smarty->assign("jueces", $jueces);
    $this->smarty->display("competencia.tpl");
  }

  function mostrarMenuInscripcion($competencias, $deportistas, $equipos){
    $this->smarty->assign("competencias", $competencias);
    $this->smarty->assign("deportistas", $deportistas);
    $this->smarty->assign("equipos", $equipos);
    $this->smarty->display("inscripcion.tpl");
  }

  function mostrarHome(){
    $this->smarty->display("header.tpl");
  }

}

 ?>
