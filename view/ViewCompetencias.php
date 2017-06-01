<?php
require_once('libs/Smarty.class.php');
class ViewCompetencias {

  private $smarty;

  function __construct(){
    $this->smarty = new Smarty();
  }


  function mostrarListadoDeportistas(){
    $this->smarty->assign("deportistas", $deportistas);
    $this->smarty->assign("competencias", $competencias);
    $this->smarty->display("depInscriptos.tpl");
  }

  function mostrarListadoJueces(){
    $this->smarty->assign("jueces", $jueces);
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
