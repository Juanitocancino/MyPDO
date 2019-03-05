<?php
require_once 'config.php';

function borrar($conexion, $tabla, $campo, $valor){
  $SQL="DELETE FROM $tabla WHERE $campo=$valor";
  $sentence = $conexion -> prepare($SQL);
  if ($sentence -> execute()) {
    return 1;
  }else {
    return 0;
  }
}
function rawInsert($conexion, $tabla, $campos, $datos){
  $total=count($datos);
  if ($total==count($campos)) {
    $SQL="INSERT INTO ".$tabla." (";
    for ($i=0; $i <$total ; $i++) {
      if ($i==$total-1) {$SQL.=$campos[$i];}else {$SQL.=$campos[$i].",";}
    }
    $SQL.=") VALUES (";
    for ($i=0; $i <$total ; $i++) {
      if ($i==$total-1) {$SQL.="'".$datos[$i]."'";}else{$SQL.="'".$datos[$i]."',";}
    }
    $SQL.=");";
    echo "$SQL";
    $sentence = $conexion -> prepare($SQL);
    if ($sentence -> execute()) {
      return 1;
    }else {
      return 0;
    }
  }else {return "Cantidad de Campos no coincide con Datos";  }
}
function PDOInsert ($conexion, $tabla, $campos, $datos){
  $total=count($datos);
  if ($total==count($campos)) {
    $SQL="INSERT INTO ".$tabla." (";
    for ($i=0; $i <$total ; $i++) {
      if ($i==$total-1) {$SQL.=$campos[$i];}else {$SQL.=$campos[$i].",";}
    }
    $SQL.=") VALUES (";
    for ($i=0; $i <$total ; $i++) {
      if ($i==$total-1) {$SQL.=":".$campos[$i];}else{$SQL.=":".$campos[$i].",";}
    }
    $SQL.=");";
    $sentence = $conexion -> prepare($SQL);
    for ($i=0; $i <$total ; $i++) {
      switch (gettype($datos[$i])) {
        case 'string':
          if (strpos($datos[$i], 'DROP')!== false||strpos($datos[$i], 'TRUNCATE')!== false) {
            return "Valor Malicioso en el campo: ".$i;
          }else {$sentence->bindParam(":".$campos[$i],$datos[$i],PDO::PARAM_STR);}
          break;
        case 'integer':
          $sentence->bindParam(":".$campos[$i],$datos[$i],PDO::PARAM_INT);
          break;
        case 'double':
          $sentence->bindParam(":".$campos[$i],$datos[$i],PDO::PARAM_STR);
          break;
        default:
          return "Varialbe no especificada -Campo:".$i;
          break;
      }
    }
    if ($sentence -> execute()) {return 1;}else{return $sentence->errorCode();}
  }else{return "Tamaño de campos no concuerda con datos";}
}
function PDOUpdate ($conexion, $tabla, $campos, $datos,$campoID, $datoID){
$total=count($campos);
  if ($total==count($datos)) {
    $SQL="UPDATE $tabla SET ";
    for ($i=0; $i <$total ; $i++) {
      if ($i==$total-1) {$SQL.=$campos[$i]."=:".$campos[$i]." ";}else{$SQL.=$campos[$i]."=:".$campos[$i].", ";}
    }
    $SQL.="WHERE $campoID = $datoID;";
    $sentence = $conexion -> prepare($SQL);
    for ($i=0; $i <$total ; $i++) {
      switch (gettype($datos[$i])) {
        case 'string':
          if (strpos($datos[$i], 'DROP')!== false||strpos($datos[$i], 'TRUNCATE')!== false) {
            return "Valor Malicioso en el campo: ".$i;
          }else {$sentence->bindParam(":".$campos[$i],$datos[$i],PDO::PARAM_STR);}
          break;
        case 'integer':
          $sentence->bindParam(":".$campos[$i],$datos[$i],PDO::PARAM_INT);
          break;
        case 'double':
          $sentence->bindParam(":".$campos[$i],$datos[$i],PDO::PARAM_STR);
          break;
        default:
          return "Varialbe no especificada -Campo:".$i;
          break;
      }
    }
    if ($sentence->execute()) {return 1;}else {return $sentence->errorCode();}
  }else {return "Tamaño de campos no concuerda con datos";}

}
 ?>
