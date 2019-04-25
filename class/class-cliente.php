<?php

	class cliente{

		private $id_cliente;
		private $id_persona;
		private $id_usuario;

		public function __construct(
			$id_cliente,
			$id_persona,
			$id_usuario
		){
			$this->id_cliente = $id_cliente;
			$this->id_persona = $id_persona;
			$this->id_usuario = $id_usuario;
		}

		public function getId_cliente(){
			return $this->id_cliente;
		}
		public function setId_cliente($id_resultado){
			$this->id_cliente = $id_cliente;
		}
		public function getId_persona(){
			return $this->id_persona;
		}
		public function setId_persona($id_persona){
			$this->id_persona = $id_persona;
		}
		public function getId_usuario(){
			return $this->id_usuario;
		}
		public function setId_usuario($id_persona){
			$this->id_usuario = $id_usuario;
		}

		public function __toString(){
			return "Id_cliente: " . $this->id_cliente . 
				" Id_persona: " . $this->id_persona .  
				" Id_usuario: " . $this->id_usuario;
		}

		public static function Listar_Clientes($conexion){
			$sql='SELECT A.ID_CLIENTE AS ID_CLIENTE,
						 CONCAT_WS(" ",B.NOMBRE,B.APELLIDO) AS NOMBRE, 
				  	     C.USUARIO AS USUARIO, 
						 C.FECHA_REGISTRO AS FECHA_REGISTRO
				  FROM TBL_PERSONAS B
				  INNER JOIN TBL_CLIENTE A
				  ON (A.ID_PERSONA=B.ID_PERSONA)
				  INNER JOIN TBL_USUARIOS C
				  ON (A.ID_USUARIO=C.ID_USUARIO)';
			$rows=$conexion->query($sql);
			return $rows;
		}

		public static function Obtener_Datos($conexion, $id_cliente){
			$sql='SELECT  A.ID_CLIENTE,
						A.ID_PERSONA,
						CONCAT_WS(" ",B.NOMBRE,B.APELLIDO) AS NOMBRE, 
						B.IDENTIDAD, 
				        B.EDAD,
				        B.TELEFONO,
				        B.EMAIL AS CORREO,
				        B.FECHA_NAC AS FECHA_NACIMINETO,
				        B.DIRECCION
				FROM TBL_PERSONAS B
				INNER JOIN TBL_CLIENTE A
				ON (A.ID_PERSONA=B.ID_PERSONA)
				WHERE A.ID_CLIENTE='.$id_cliente;
			$row=$conexion->query($sql);
			return $row;
		}

		public static function Examenes_Cliente($conexion, $id_cliente){
			$sql='SELECT   A.FECHA_EMISION,
						   A.ID_RESULTADO,
						   A.ID_EXAMEN,
					       B.NOMBRE AS EXAMEN,
					       A.ID_EMPLEADO,
					       CONCAT_WS(" ",D.NOMBRE,D.APELLIDO) AS EMPLEADO
					from tbl_resultados A
					INNER JOIN tbl_examenes B
					ON (A.ID_EXAMEN = B.ID_EXAMEN)
					INNER JOIN tbl_empleado C
					ON (A.ID_EMPLEADO = C.ID_EMPLEADO)
					INNER JOIN tbl_personas D
					ON (C.ID_PERSONA = D.ID_PERSONA)
					WHERE A.ID_CLIENTE = '.$id_cliente;
			$row=$conexion->query($sql);
			return $row;
		}

		public static function Resultados_Examen($conexion, $id_resultado){
			$sql = 'SELECT  A.ID_CARACTERISTICAS,
							B.CARACTERISTICA,
							C.ID_EXAMEN,
					        D.NOMBRE AS EXAMEN,
					        A.VALOR_RESULTADO ,
					        CONCAT_WS(" ",B.VALOR_REF,B.UNIDADES_MEDIDA) AS REFERENCIA
					FROM CARACTERISTICAS_X_RESULTADOS A
					INNER jOIN TBL_CARACTERISTICAS B
					ON (A.ID_CARACTERISTICAS=B.ID_CARACTERISTICAS)
					INNER JOIN TBL_RESULTADOS C
					ON(A.ID_RESULTADO = C.ID_RESULTADO)
					INNER JOIN TBL_EXAMENES D
					ON (C.ID_EXAMEN = D.ID_EXAMEN)
					WHERE A.ID_RESULTADO ='.$id_resultado;
			$row=$conexion->query($sql);
			return $row;
		}

	}

?>