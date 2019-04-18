<?php
	include("../class/class-conexion.php");
	include("../class/class-emision-resultados.php");
	

	if(isset($_POST["accion"])){
		$conexion = new Conexion();
		switch ($_POST['accion']) {
			case 'listar-areas':
				$res=emision_resultado::listar_areas($conexion);
				echo json_encode($res);
				break;
			case 'listar-caracteristicas':
				$res=emision_resultado::listar_caracteristicas($conexion,$_POST["id"]);
				echo json_encode($res);
				break;
			
			default:
				# code...
				break;

		}
	}

?>