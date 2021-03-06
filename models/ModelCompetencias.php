<?php
include_once ("models/Model.php");
class ModelCompetencias extends Model{

  function __construct() {
    parent::__construct();
  }

  function getDisciplinas(){
    $disciplinas = $this->db->prepare("SELECT * FROM gr18_disciplina");
    $disciplinas->execute();
    return $disciplinas->fetchAll(PDO::FETCH_ASSOC);
  }

  function addCompetencia($competencia, $jueces){
    $comp = null;
    try {
      $this->db->beginTransaction();
      $comp = $this->db->prepare("INSERT INTO gr18_competencia VALUES(DEFAULT, ?, ?, to_date(?, 'YYYY-MM-DD'), ?, ?, ?, ?, to_date(?, 'YYYY-MM-DD'), ?, ?, ?, ?)");
      $comp->execute($competencia);

      $idCompetencia = $this->db->lastInsertId();

      foreach ($jueces as $juez) {
        $this->addJuez($idCompetencia, $juez);
      }
      $this->db->commit();

    } catch (Exception $e) {
      $this->db->rollBack();
    }

    return $comp->errorInfo()[2];
  }

  function getJueces(){
    $jueces = $this->db->prepare("SELECT j.*, p.nombre, p.apellido FROM gr18_juez j NATURAL JOIN gr18_persona p");
    $jueces->execute();
    return $jueces->fetchAll(PDO::FETCH_ASSOC);
  }

  function getJuez($juez){
    $j = $this->db->prepare("SELECT j.*, p.nombre, p.apellido FROM gr18_juez j NATURAL JOIN gr18_persona p WHERE tipoDoc = ? AND nroDoc = ?");
    $j->execute($juez);
    return $j->fetch(PDO::FETCH_ASSOC);
  }

  function addJuez($idCompetencia, $_juez){
    $juez = $this->db->prepare("INSERT INTO gr18_juezcompetencia VALUES(?, ?, ?)");
    $juez->execute(array($idCompetencia, $_juez["tipodoc"], $_juez["nrodoc"]));

  }
  function getJuezComIncriptos($datosjuez){
     $juez = $this->db->prepare("SELECT * FROM GR18_juez_competencias WHERE tipoDoc = ? AND nroDoc =?");
     $juez->execute($datosjuez);
     return $juez->fetchAll(PDO::FETCH_ASSOC);
  }

  function getCompetencias(){
    $competencias = $this->db->prepare("SELECT * FROM gr18_competencia");
    $competencias->execute();
    return $competencias->fetchAll(PDO::FETCH_ASSOC);
  }

  function getCompetencia($idCompetencia){
    $competencias = $this->db->prepare("SELECT * FROM gr18_competencia WHERE idCompetencia = ?");
    $competencias->execute(array($idCompetencia));
    return $competencias->fetch(PDO::FETCH_ASSOC);
  }


}

 ?>
