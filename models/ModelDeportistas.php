<?php
include_once ("models/Model.php");
class ModelDeportistas extends Model{

  function __construct() {
    parent::__construct();
  }
  function getDeportistas(){
    $deportistas = $this->db->prepare("SELECT d.*, p.nombre, p.apellido FROM grxx_deportista d NATURAL JOIN grxx_persona p");
    $deportistas->execute();
    return $deportistas->fetchAll(PDO::FETCH_ASSOC);
  }

  function getPersonas(){
    $personas = $this->db->prepare(
      "SELECT * FROM grxx_persona
       WHERE  tipoDoc || '.' || nroDoc NOT IN (SELECT tipoDoc || '.' || nroDoc FROM grxx_deportista) ");
    $personas->execute();
    return $personas->fetchAll(PDO::FETCH_ASSOC);
  }

  function getCategorias(){
    $categorias = $this->db->prepare("SELECT * FROM grxx_categoria c INNER JOIN grxx_disciplina d ON(c.cdodisciplina = d.cdodisciplina)");
    $categorias->execute();
    return $categorias->fetchAll(PDO::FETCH_ASSOC);
  }

  function getFederaciones(){
    $federaciones = $this->db->prepare("SELECT * FROM grxx_federacion");
    $federaciones->execute();
    return $federaciones->fetchAll(PDO::FETCH_ASSOC);
  }

}

 ?>
