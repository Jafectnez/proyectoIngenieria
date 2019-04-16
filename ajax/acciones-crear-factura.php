<?php 
	include_once("../class/class-conexion.php");
  include_once("../class/class-utilidades.php");
	include_once("../class/class-factura.php");

	if (isset($_POST['accion'])) {
		$conexion = new Conexion();
		switch ($_POST['accion']) {
			case 'obtener-ultima-factura':
				$res['data'] = Factura::leerUltimaFactura($conexion);
        echo json_encode($res);
				break;
			
			default:
				echo "Opcion no valida";
				break;
		}
    $conexion->cerrar();
    $conexion = null;
	} else {
    $res['data']['mensaje']='Accion no especificada';
    $res['data']['resultado']=false;
    $res['data']['accion']=isset($_POST['accion']);
    echo json_encode($res);
  }
?>