<?php
// Cree este nuevo elemento conexion para avanzar con los reportes, eludiendo de forma temporal los "errores" 
// marcados en el anterior

	function conectar(){
		$conexion = mysqli_connect("localhost", "root", "", "DB_EMANUEL");
		return $conexion;
	}

	$con = new mysqli("localhost", "root", "", "db_extendida");

?>
 