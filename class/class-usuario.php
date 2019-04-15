<?php

	class Usuario{

		private $id_usuario;
		private $id_tipo_usuario;
		private $usuario;
		private $contrasenia;
		private $fecha_registro;

		public function __construct($id_usuario,
					$id_tipo_usuario,
					$usuario,
					$contrasenia,
					$fecha_registro){
			$this->id_usuario = $id_usuario;
			$this->id_tipo_usuario = $id_tipo_usuario;
			$this->usuario = $usuario;
			$this->contrasenia = $contrasenia;
			$this->fecha_registro = $fecha_registro;
		}
		public function getId_usuario(){
			return $this->id_usuario;
		}
		public function setId_usuario($id_usuario){
			$this->id_usuario = $id_usuario;
		}
		public function getId_tipo_usuario(){
			return $this->id_tipo_usuario;
		}
		public function setId_tipo_usuario($id_tipo_usuario){
			$this->id_tipo_usuario = $id_tipo_usuario;
		}
		public function getUsuario(){
			return $this->usuario;
		}
		public function setUsuario($usuario){
			$this->usuario = $usuario;
		}
		public function getContrasenia(){
			return $this->contrasenia;
		}
		public function setContrasenia($contrasenia){
			$this->contrasenia = $contrasenia;
		}
		public function getFecha_registro(){
			return $this->fecha_registro;
		}
		public function setFecha_registro($fecha_registro){
			$this->fecha_registro = $fecha_registro;
		}
		public function __toString(){
			return "Id_usuario: " . $this->id_usuario . 
				" Id_tipo_usuario: " . $this->id_tipo_usuario . 
				" Usuario: " . $this->usuario . 
				" Contrasenia: " . $this->contrasenia . 
				" Fecha_registro: " . $this->fecha_registro;
		}
		public static function verificarUsuario($conexion,$usuario,$password){
			#consulta
			// $sql="SELECT  id_usuario, id_tipo_usuario, usuario, 
			// 			  contraseña
			// 	  FROM tbl_usuarios
			// 	  WHERE email='$usuario' && contraseña='$password'";
			$sql="SELECT  ID_USUARIO, ID_TIPO_USUARIO, USUARIO, 
						  CONTRASEÑA
				  FROM TBL_USUARIOS
				  WHERE USUARIO='$usuario' && contraseña='$password'";


			#resultado de la consulta				
			$resultado=$conexion->ejecutarConsulta($sql);
			//$cantidadRegistros=$conexion->cantidadRegistros($resultado);
			
		// 	if ($cantidadRegistros==1)  {
		// 		$fila = $conexion->obtenerFila($resultado);
		// 		session_start();
		// 		$_SESSION['status']=true;
		// 		$_SESSION['id_usuario']=$fila['id_usuario'];
		// 		$_SESSION['usuario']=$fila['usuario'];
		// 		$_SESSION['contrasenia']=$fila['contraseña'];
		// 		$_SESSION['tipo_usuario']=$fila['id_tipo_usuario'];
		// 		$respuesta['loggedin'] = 1;
		// 		$respuesta["mensaje"]="tiene acceso" ;

		// 	}
		// 	else {
		// 		//echo'correo o contrasenia invalidos';	
		// 		session_start();
		// 		$_SESSION['status']=false;
		// 		$respuesta['loggedin'] = 0;
		// 		$respuesta["mensaje"]="No tiene acceso" ;
		// 		}	  
		// 	echo json_encode($respuesta);
			echo json_encode($resultado);
		 }
	}
?>