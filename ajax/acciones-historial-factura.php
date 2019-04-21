<?php
	include_once("../class/class-conexion.php");
	include_once("../class/class-historial-factura.php");
	if (isset($_POST['accion'])) {
		$conexion=new Conexion();
		switch ($_POST['accion']) {
			case 'cargar-historial':
				$res=historialFacturas::cargarFacturas($conexion);
				echo $res;
				break;
			
			default:
				# code...
				break;
		}
	}




?>