<?php
//examenes.php obtiene la lista de examenes que cargan el combobox en agregar promocion
require_once('conexion.php');
$conexion = conectar();
$sql = "SELECT * FROM `TBL_EXAMENES` order by NOMBRE"; 
$result = mysqli_query($conexion, $sql);

while( $row = mysqli_fetch_array($result))
{
	echo '<option value="'.$row['ID_EXAMEN'].'">'.$row['NOMBRE'].'</option>';
}

?> 