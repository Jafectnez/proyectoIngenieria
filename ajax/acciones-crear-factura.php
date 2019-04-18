<?php 
	include_once("../class/class-conexion.php");
	include_once("../class/class-crear-factura.php");

	if (isset($_POST['accion'])) {
		$conexion = new Conexion();
		switch ($_POST['accion']) {
			case 'obtener-ultima-factura':
				$respuesta = crearFactura::ultimaFactura($conexion);
				echo json_encode($respuesta);
				break;
			case 'obtener-servicios':
				$respuesta = crearFactura::obtenerServicios($conexion);
				echo $respuesta;
				break;
			case 'seleccionar-servicio':
				$respuesta = crearFactura::seleccionarServicio($conexion,$_POST['idExamen'],$_POST['codigoFactura']);
				echo $respuesta;
				break;
			case 'eliminar-servicio':
				$respuesta = crearFactura::eliminarServicio($conexion,$_POST['idExamen'],$_POST['codigoFactura']);
				echo $respuesta;
				break;
			case 'mostrar-pantalla':
				$respuesta = crearFactura::mostrarPantalla($conexion,$_POST['idExamen'],$_POST['codigoFactura']);
				echo $respuesta;
				break;
			case 'total-factura':
				$respuesta = crearFactura::totalFactura($conexion,$_POST['codigoFactura']);
				echo json_encode($respuesta);
				break;
			case 'obtener-promociones':
				$respuesta = crearFactura::obtenerPromociones($conexion,$_POST['fechaActual'],$_POST['idFactura']);
				echo $respuesta;
				break;
			
			default:
				# code...
				break;
		}
	}
?>