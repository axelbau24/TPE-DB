<?php
class ConfigApp{

  public static $ACTION = "action"; // Action de PHP index.php?action=
  // Todos los actions utilizados para cargar cada una de las secciones
  // Ejemplo index.php?action=agregar_competencia
  public static $ACTIONS = [
    'home' =>  "Deportistas",
    'inscripcion' =>  "Competencias",
    'agregar_competencia' =>  "Competencias",
    'listado_deportistas' =>  "Competencias",
    'listado_jueces' =>  "Competencias",
    'agregar_deportista' =>  "Deportistas"];

}

 ?>
