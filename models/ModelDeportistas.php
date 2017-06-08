<?php
include_once ("models/Model.php");
class ModelDeportistas extends Model{

  function __construct() {
    parent::__construct();
  }
  // Se obtienen los datos de los deportistas con los datos de su persona
  function getDeportistas(){
    $deportistas = $this->db->prepare("SELECT d.*, p.nombre, p.apellido FROM gr18_deportista d NATURAL JOIN gr18_persona p");
    $deportistas->execute();
    return $deportistas->fetchAll(PDO::FETCH_ASSOC);
  }

  // Se obtienen los deportistas inscriptos en alguna competencia
  function getDepInscriptos($idCompetencia){
    $deportistas = $this->db->prepare("SELECT * FROM GR18_deportistas_inscriptos WHERE idcompetencia = ?");
    $deportistas->execute(array($idCompetencia));
    return $deportistas->fetchAll(PDO::FETCH_ASSOC);
  }

  // Se agrega un deportista con los datos requeridos
  function addDeportista($deportista){
    $deportistas = $this->db->prepare("INSERT INTO GR18_Deportista VALUES(?, ?, ?, to_date(?, 'YYYY-MM-DD'), ?, ?, ?, ?, ?)");
    $deportistas->execute($deportista);
  }

 // Se agrega un deportista y luego se asocia a una competencia
 // Si no se pudo asociar a esa competencia, el deportista no se agrega.
  function addDeportistaAsociar($deportista, $idCompetencia, $fecha){
    $error = null;
    try {
      $this->db->beginTransaction();
      $this->addDeportista($deportista);

      $error = $this->asociarDeportista($deportista, $idCompetencia, $fecha);

      $this->db->commit();

    } catch (Exception $e) {
      $this->db->rollBack();
    }
   return $error;
  }

 // Inscribe un deportista a una competencia
  function asociarDeportista($deportista, $idCompetencia, $fecha){
    $inscripcion = $this->db->prepare("INSERT INTO GR18_Inscripcion VALUES(DEFAULT ,?, ?, null, ?, to_date(?, 'YYYY-MM-DD'))");
    $inscripcion->execute(array($deportista[0], $deportista[1], $idCompetencia, $fecha));
    return $inscripcion->errorInfo()[2];
  }

  // Inscribe un equipo a una competencia
  function asociarEquipo($idEquipo, $idCompetencia, $fecha){
    $inscripcion = $this->db->prepare("INSERT INTO GR18_Inscripcion VALUES(DEFAULT ,null, null, ?, ?, to_date(?, 'YYYY-MM-DD'))");
    $inscripcion->execute(array($idEquipo, $idCompetencia, $fecha));
    return $inscripcion->errorInfo()[2];
  }

  // Se obtienen las personas que no son deportistas
  function getPersonas(){
    $personas = $this->db->prepare(
      "SELECT * FROM gr18_persona
       WHERE  tipoDoc || '.' || nroDoc NOT IN (SELECT tipoDoc || '.' || nroDoc FROM gr18_deportista) ");
    $personas->execute();
    return $personas->fetchAll(PDO::FETCH_ASSOC);
  }

  // Se obtienen todas las categorias con su respectiva discplina
  function getCategorias(){
    $categorias = $this->db->prepare("SELECT * FROM gr18_categoria c INNER JOIN gr18_disciplina d ON(c.cdodisciplina = d.cdodisciplina)");
    $categorias->execute();
    return $categorias->fetchAll(PDO::FETCH_ASSOC);
  }

  // Se obtienen todas las federaciones
  function getFederaciones(){
    $federaciones = $this->db->prepare("SELECT * FROM gr18_federacion");
    $federaciones->execute();
    return $federaciones->fetchAll(PDO::FETCH_ASSOC);
  }

  // Se obtienen todos los equipos
  function getEquipos(){
    $equipos = $this->db->prepare("SELECT * FROM gr18_equipo");
    $equipos->execute();
    return $equipos->fetchAll(PDO::FETCH_ASSOC);
  }
}

 ?>
