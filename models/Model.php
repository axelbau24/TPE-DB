<?php
include_once "config.php";

abstract class Model{
  protected $db;

  function __construct() {
    try {
     $this->db = new PDO('pgsql:host='.HOST.';port='.PORT.';dbname='.DBNAME.'', USER, DBPASS);
     $this->db->exec('SET search_path TO '.USER.'');

    } catch (PDOException $e) {
        echo "Error al conectarse a la base de datos";
        die();
    }
  }
}

 ?>
