<?php

  require_once("conexion.php");
  $conexion = conectar();
  //Inserta nueva promocion
  
  // agrega una nueva promocion
  $sql = "INSERT INTO `TBL_PROMOCIONES`(`ID_PROMOCIONES`, `DESCRIPCION`, `RESTRICCIONES`, `PROMOCION`, `FECHA_INICIO`, `FECHA_FIN`) VALUES (null,'".$_POST['des']."','".$_POST['res']."','".$_POST['porc']."','".$_POST['fi']."','".$_POST['ff']."')";
  mysqli_query($conexion, $sql);
  
  // captura el id de la nueva promocion recien agregada
  $sql = "SELECT * from TBL_PROMOCIONES ORDER BY ID_PROMOCIONES DESC LIMIT 1";
  $result = mysqli_query($conexion, $sql);
  $row = mysqli_fetch_array($result);
  
  // crea la conexion entre promociones y la lista de examenes
  $sql = "INSERT INTO `PROMOCIONES_X_EXAMENES`(`TBL_PROMOCIONES_ID_PROMOCIONES`, `TBL_EXAMENES_ID_EXAMEN`) VALUES (".$row['ID_PROMOCIONES'].",".$_POST['ie'].")";
  mysqli_query($conexion, $sql);

  mysqli_close($conexion);


  echo "1";

?>