<?php 

	include ("../class/class-conexion.php");
	include ("../class/class-usuario.php");	
		
	if (isset($_POST['accion'])) {
		$conexion=new Conexion();
		switch ($_POST["accion"]) {
			case 'iniciar-sesion':
				$usuario=$_POST["txt-Usuario"];
				$password=$_POST["txt-Password"];
	
				//$password = hash('sha512',$password); 		
				$respuesta = Usuario::verificarUsuario($conexion,$usuario,$password);
				echo $respuesta;
				
				break;
			case 'cerrar-sesion':
					session_start();
					$_SESSION['status']=false;
					$respuesta['loggedin'] = 0;
					echo json_encode($respuesta);
				break;
			
			default:
				# code...
				break;
		}
    $conexion->cerrar();
    $conexion = null;
  } else {
    $res['data']['mensaje']='Accion no especificada';
    $res['data']['resultado']=false;
    $res['data']['accion']=$_POST;
    echo json_encode($res);
  }
  

?>