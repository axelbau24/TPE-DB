<?php

require ('config/ConfigApp.php');
require ('controller/CompetenciasController.php');
require ('controller/DeportistasController.php');

$c_competencias = new CompetenciasController();
$c_deportistas = new DeportistasController();

$controllers = ['Competencias' =>  $c_competencias, 'Deportistas' =>  $c_deportistas];

// Se checkea que se haya seleccionado la opcion de ir a alguna de las secciones
// Sino siempre se ira al principio (Default es la seccion Alta de deportistas)

if (array_key_exists(ConfigApp::$ACTION,$_REQUEST) && array_key_exists($_REQUEST[ConfigApp::$ACTION], ConfigApp::$ACTIONS)){
    $action = $_REQUEST[ConfigApp::$ACTION];
    $nombreController = ConfigApp::$ACTIONS[$action];
    $controllers[$nombreController]->{$action}();
} else $c_deportistas->iniciar();
 ?>
