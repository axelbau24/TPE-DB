<?php
require_once('libs/Smarty.class.php');
class ViewCompetencias {

  private $smarty;

  function __construct(){
    $this->smarty = new Smarty();
  }


  function mostrarMenuAgregar($disciplinas, $jueces){
    $this->smarty->assign("disciplinas", $disciplinas);
    $this->smarty->assign("jueces", $jueces);
    $this->smarty->display("competencia.tpl");
  }

  function mostrarMenuInscripcion($competencias, $deportistas){
    $this->smarty->assign("competencias", $competencias);
    $this->smarty->assign("deportistas", $deportistas);
    $this->smarty->display("inscripcion.tpl");
  }

  function mostrarHome(){
    $this->smarty->display("header.tpl");
  }

}

 ?>
