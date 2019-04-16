<?php 

	include ("../class/class-conexion.php");
	include ("../class/class-usuario.php");	
	
			
		$conexion=new Conexion();
	if (isset($_POST['accion'])) {
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
		# code...
	}
	$conexion->cerrar();

?>