<?php

	class emision_resultado{

		private $id_resultado;
		private $id_examen;
		private $id_cliente;
		private $id_empleado;
		private $observaciones;

		public function __construct($id_resultado,
					$id_examen,
					$id_cliente,
					$id_empleado,
					$observaciones){
			$this->id_resultado = $id_resultado;
			$this->id_examen = $id_examen;
			$this->id_cliente = $id_cliente;
			$this->id_empleado = $id_empleado;
			$this->observaciones = $observaciones;
		}
		public function getId_resultado(){
			return $this->id_resultado;
		}
		public function setId_resultado($id_resultado){
			$this->id_resultado = $id_resultado;
		}
		public function getId_examen(){
			return $this->id_examen;
		}
		public function setId_examen($id_examen){
			$this->id_examen = $id_examen;
		}
		public function getId_cliente(){
			return $this->id_cliente;
		}
		public function setId_cliente($id_cliente){
			$this->id_cliente = $id_cliente;
		}
		public function getId_empleado(){
			return $this->id_empleado;
		}
		public function setId_empleado($id_empleado){
			$this->id_empleado = $id_empleado;
		}
		public function getObservaciones(){
			return $this->observaciones;
		}
		public function setObservaciones($observaciones){
			$this->observaciones = $observaciones;
		}
		public function __toString(){
			return "Id_resultado: " . $this->id_resultado . 
				" Id_examen: " . $this->id_examen . 
				" Id_cliente: " . $this->id_cliente . 
				" Id_empleado: " . $this->id_empleado . 
				" Observaciones: " . $this->observaciones;
		}
		//-----------------------------------------------------------------------------------------
		//			Funcion cuyo objetivo es listar las areas del laboratorio
		//-----------------------------------------------------------------------------------------
		public static function listar_areas($conexion){
			$sql = "SELECT ID_AREA, NOMBRE FROM TBL_AREA";
			$row = $conexion->query($sql);
			return $row;
		}
		public static function listar_caracteristicas($conexion,$id){
			// $sql="SELECT ID_EXAMEN, ID_AREA, NOMBRE, PRECIO, DESCRIPCION, TIEMPO_ANALISIS
			// FROM TBL_EXAMENES
			// WHERE ID_AREA='$id'";
			$sql="
				  SELECT  C.CARACTERISTICA, C.VALOR_REF, C.UNIDADES_MEDIDA, C.ID_CARACTERISTICAS, A.ID_AREA, A.NOMBRE
				  FROM TBL_AREA A
				  INNER JOIN AREA_X_CARACTERISTICAS AC 
                  ON (AC.ID_AREA=A.ID_AREA)
				  INNER JOIN TBL_CARACTERISTICAS C 
                  ON (AC.ID_CARACTERISTICAS=C.ID_CARACTERISTICAS)
			      WHERE A.ID_AREA='$id'";
			$row=$conexion->query($sql);
			return $row;
		}
		//-----------------------------------------------------------------------------------------


		//----------------------------------------------------------------------------------------------------
		// Esta funcion es para poder obtener el valor de las caracteristica ingresadas por los laboratoristas
		//-----------------------------------------------------------------------------------------------------
		public static function obtener_inputs($conexion){
			$sql="
				  SELECT  C.CARACTERISTICA, A.ID_AREA, c.ID_CARACTERISTICAS, A.NOMBRE
				  FROM TBL_AREA A
				  INNER JOIN AREA_X_CARACTERISTICAS AC 
                  ON (AC.ID_AREA=A.ID_AREA)
				  INNER JOIN TBL_CARACTERISTICAS C 
                  ON (AC.ID_CARACTERISTICAS=C.ID_CARACTERISTICAS)";
			$row=$conexion->query($sql);
			return $row;
		}
		//-----------------------------------------------------------------------------------------


		//-----------------------------------------------------------------------------------------
		//Aqui Es donde se realiza el proceso de guardrn los resultados del paciente
		//-----------------------------------------------------------------------------------------
		public static function guardar_resultado($conexion,$parametros,$cliente,$examenes){
			//Llamado a una funcion para validar nombre
			$usuario=emision_resultado::verificarUsuario($conexion,$cliente);
			if ($usuario!=0) {
				//Se inicia sesion para poder obtener las variables globales
				session_start();
				$fecha=date("y").'-'.date("m").'-'.date("d");
	           
				
				//Esta es la insersion de el resultado
				
					$sql = 'INSERT INTO TBL_RESULTADOS (
	                                  ID_EXAMEN,
	                                  ID_CLIENTE, 
	                                  ID_EMPLEADO, 
	                                  FECHA_EMISION,
	                                  OBSERVACIONES)
	                          VALUES ( 
	                                  '.$examenes[$i].',
	                                  '.$usuario.', 
	                                  '.$_SESSION['id_empleado'].',
	                                  "'.$fecha.'",
	                                  "N/A")';
	                $resultado = $conexion->ejecutarConsulta($sql);
				
				//Se obtiene el tamanio del arreglo que es equivalente al numero de caracteristicas a insertar
				$tamanio=count($parametros);
				 //Consulta que btiene el id del ultimo registro insertado
	            $sql1 = 'SELECT MAX(ID_RESULTADO) id FROM TBL_RESULTADOS';
	            $resultado1 = $conexion->ejecutarConsulta($sql1);
				$id=$conexion->obtenerFila($resultado1);
				//Se hace un for para ir insertando las caracteristicas en la base de datos
				for ($i=0; $i < $tamanio ; $i++) { 
					list($valor,$idcaracteristica)=explode(':', $parametros[$i]) ;
					$sql2='INSERT INTO caracteristicas_x_resultados(
									   ID_CARACTERISTICAS,
									   ID_RESULTADO,
									   VALOR_RESULTADO)
					 			VALUES ('.$idcaracteristica.','.$id['id'].','.$valor.')';
					$resultado2=$conexion->ejecutarConsulta($sql2);
				}
				echo "Resultado guardado con exito";
			}
			else{
				echo "Ingrese un cliente válido";
			}

			

		}
	//-----------------------------------------------------------------------------------------
	//Funcion para validar que el nombre del cliente esta almacenado en la base de datos para poder emitir los resultados
	//-----------------------------------------------------------------------------------------

	public static function verificarUsuario($conexion,$nombreUsuario){
			//Dividir el nombre obtenido en el campo para obtener el nombre y el apellido
			$nombre = strtok($nombreUsuario, ' ');
			$apellido = strtok(' ');

			$sql = 'select c.id_cliente idPersona from tbl_personas p 
					inner join tbl_cliente c
					on c.id_persona = p.id_persona
					where (p.nombre = "'.$nombre.'" and p.apellido = "'.$apellido.'")';
			//echo $sql;

			$resultado = $conexion->ejecutarConsulta($sql);

			if (($usuario=$conexion->obtenerFila($resultado))) {
				//echo "Debe retornar el id de ese cliente";
				/*echo '<input type="text" style="display:none" name="" id="txt-id-usuario" value="'.$usuario['idPersona'].'">';*/
				return $usuario['idPersona'];
			}
			else{
				// echo "Se debe registrar el cliente";
				return 0;

			}

		}
	//-----------------------------------------------------------------------------------------
	//Funcion que obtiene el resultado que se acaba de emitir
	//-----------------------------------------------------------------------------------------
	public static function ultimo_resultado($conexion){
		 $sql='

				SELECT c.caracteristica, cr.valor_resultado, a.nombre
				FROM tbl_caracteristicas c 
				INNER JOIN caracteristicas_x_resultados cr 
				on cr.ID_CARACTERISTICAS=c.ID_CARACTERISTICAS
				INNER JOIN area_x_caracteristicas ac 
				on ac.ID_CARACTERISTICAS=c.ID_CARACTERISTICAS
				INNER JOIN tbl_area a 
				on a.ID_AREA=ac.ID_AREA
				INNER JOIN tbl_resultados r
				on r.ID_RESULTADO=cr.ID_RESULTADO
				WHERE (cr.ID_RESULTADO=(SELECT MAX(ID_RESULTADO) FROM TBL_RESULTADOS) and (r.ID_EXAMEN in (

					SELECT id_examen from tbl_resultados WHERE ID_RESULTADO=(SELECT MAX(ID_RESULTADO))



				))  )
				ORDER by a.NOMBRE';
		$row=$conexion->query($sql);

		return $row;

	}



	//-----------------------------------------------------------------------------------------
	//Funcion que obtiene los examenes disponibles en la base de datos
	//-----------------------------------------------------------------------------------------
	
	public static function listar_examenes($conexion){
		$sql='select id_examen, id_area,nombre from tbl_examenes';
		$row=$conexion->query($sql);
		return $row;

	}
}
?>