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
			case 'obtener-inputs':
				$res=emision_resultado::obtener_inputs($conexion);
				echo json_encode($res);
				break;
			case 'guardar-resultado':
		//	var_dump($_POST['cadena2']);
				 $res=emision_resultado::guardar_resultado($conexion,$_POST['cadena2']);
				 echo json_encode($res);
				// echo $res;
				# code...
				break;
			
			default:
				# code...
				break;

		}
	}

?>