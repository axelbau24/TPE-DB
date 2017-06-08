<?php
include_once 'view/View.php';
class ViewDeportistas extends View {

  function __construct(){
    parent::__construct();
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
