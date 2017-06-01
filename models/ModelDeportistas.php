<?php
include_once ("models/Model.php");
class ModelDeportistas extends Model{

  function __construct() {
    parent::__construct();
  }
  function getDeportistas(){
    $deportistas = $this->db->prepare("SELECT d.*, p.nombre, p.apellido FROM gr18_deportista d NATURAL JOIN gr18_persona p");
    $deportistas->execute();
    return $deportistas->fetchAll(PDO::FETCH_ASSOC);
  }
  function getDepInscriptos($idCompetencia){
    $deportistas = $this->db->prepare("SELECT * FROM GR18_deportistas_inscriptos WHERE idcompetencia = ?");
    $deportistas->execute(array($idCompetencia));
    return $deportistas->fetchAll(PDO::FETCH_ASSOC);
  }
  function addDeportista($deportista){
    $deportistas = $this->db->prepare("INSERT INTO GR18_Deportista VALUES(?, ?, ?, to_date(?, 'YYYY-MM-DD'), ?, ?, ?, ?, ?)");
    $deportistas->execute($deportista);
  }

  function addDeportistaAsociar($deportista, $idCompetencia){
    try {
      $this->db->beginTransaction();
      $this->addDeportista($deportista);

      $this->asociarDeportista($deportista, $idCompetencia);

      $this->db->commit();

    } catch (Exception $e) {
      $this->db->rollBack();
    }

  }

  function asociarDeportista($deportista, $idCompetencia){
    $inscripcion = $this->db->prepare("INSERT INTO GR18_Inscripcion VALUES(DEFAULT ,?, ?, null, ?, now())");
    $inscripcion->execute(array($deportista[0], $deportista[1], $idCompetencia));
  }
  function asociarEquipo($idEquipo, $idCompetencia){
    $inscripcion = $this->db->prepare("INSERT INTO GR18_Inscripcion VALUES(DEFAULT ,null, null, ?, ?, now())");
    $inscripcion->execute(array($idEquipo, $idCompetencia));
  }

  function getPersonas(){
    $personas = $this->db->prepare(
      "SELECT * FROM gr18_persona
       WHERE  tipoDoc || '.' || nroDoc NOT IN (SELECT tipoDoc || '.' || nroDoc FROM gr18_deportista) ");
    $personas->execute();
    return $personas->fetchAll(PDO::FETCH_ASSOC);
  }

  function getCategorias(){
    $categorias = $this->db->prepare("SELECT * FROM gr18_categoria c INNER JOIN gr18_disciplina d ON(c.cdodisciplina = d.cdodisciplina)");
    $categorias->execute();
    return $categorias->fetchAll(PDO::FETCH_ASSOC);
  }

  function getFederaciones(){
    $federaciones = $this->db->prepare("SELECT * FROM gr18_federacion");
    $federaciones->execute();
    return $federaciones->fetchAll(PDO::FETCH_ASSOC);
  }

  function getEquipos(){
    $equipos = $this->db->prepare("SELECT * FROM gr18_equipo");
    $equipos->execute();
    return $equipos->fetchAll(PDO::FETCH_ASSOC);
  }
}

 ?>
