<?php
require_once('libs/Smarty.class.php');
class ViewDeportistas {

  private $smarty;

  function __construct(){
    $this->smarty = new Smarty();
  }

  function mostrarMenuDeportista($personas, $categorias, $federaciones, $competencias){
    $this->smarty->assign("personas", $personas);
    $this->smarty->assign("categorias", $categorias);
    $this->smarty->assign("federaciones", $federaciones);
    $this->smarty->assign("competencias", $competencias);
    $this->smarty->display("deportista.tpl");
  }

  function mostrarHome(){
    $this->smarty->display("header.tpl");
  }

}

 ?>
