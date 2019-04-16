<?php
	include("../class/class-conexion.php");
	include("../class/class-emision-resultados.php");
	

	if(isset($_POST["accion"])){
		$conexion = new Conexion();
		switch ($_POST['accion']) {
			case 'listar-examenes':
				$res=emision_resultado::Listar_examenes($conexion);
				echo json_encode($res);
				break;
			
			default:
				# code...
				break;

		}
	}

?>