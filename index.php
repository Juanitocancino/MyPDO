<?php
require_once 'config.php';
require_once 'sql.php';
error_reporting(E_ALL);
ini_set('display_errors', '1');
$tabla="eventos";
$campos= array("descrip","fecha", "hora", "id_edificio", "id_Usuario", "duracion", "Observa");
$datos = array("Seminario2", "2018-09-13", "09:00:00", 1, 13, 2,"Alguna");
$conexion=Conexion::singleton_conexion();


?>
