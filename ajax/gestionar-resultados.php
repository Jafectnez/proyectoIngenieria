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
			    $data = json_decode($_POST['arreglo']);
					// var_dump($data);
					// var_dump($_POST['examenes']);
				$res=emision_resultado::guardar_resultado($conexion,$data,$_POST['cliente'],$_POST['examenes']);
				echo $res;
				break;
			case 'obtener-ultimo-resultado':
				$res=emision_resultado::ultimo_resultado($conexion);
				echo json_encode($res);
				break;
			case 'obtener-examenes':
				$res=emision_resultado::listar_examenes($conexion);
				echo json_encode($res);
				break;
			
			default:
				# code...
				break;

		}
	}

?>