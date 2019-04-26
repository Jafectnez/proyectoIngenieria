<?php

	include("../class/class-conexion.php");
	include("../class/class-cliente.php");	

	if(isset($_POST["accion"])){
		$conexion = new Conexion();
		switch ($_POST['accion']) {
			case 'listar-clientes':
				$res=cliente::Listar_Clientes($conexion);
				echo json_encode($res);
				break;

			case 'obtener_datos':
				$id_cliente=$_POST["id_cliente"];
				$res=cliente::Obtener_Datos($conexion,$id_cliente);
				echo json_encode($res);
				break;
			
			case 'listar_examenes_cliente':
				$id_cliente=$_POST["id_cliente"];
				$res=cliente::Examenes_Cliente($conexion,$id_cliente);
				echo json_encode($res);
				break;
				
			case 'listar_resultado_examen':
				$id_resultado=$_POST["id_resultado"];
				$res=cliente::Resultados_Examen($conexion,$id_resultado);
				echo json_encode($res);
				break;

			case 'actualizar_cliente':
			    $res=cliente::Actualizar_Cliente($conexion);
				echo json_encode($res);
				break;

			default:
				echo " default ";
				# code...
				break;

		}
	}

?>