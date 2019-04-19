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
		public static function obtener_inputs($conexion){
			$sql="
				  SELECT  C.CARACTERISTICA, A.ID_AREA, c.ID_CARACTERISTICAS
				  FROM TBL_AREA A
				  INNER JOIN AREA_X_CARACTERISTICAS AC 
                  ON (AC.ID_AREA=A.ID_AREA)
				  INNER JOIN TBL_CARACTERISTICAS C 
                  ON (AC.ID_CARACTERISTICAS=C.ID_CARACTERISTICAS)";
			$row=$conexion->query($sql);
			return $row;
		}
		public static function guardar_resultado($conexion,$parametros){
			//Registro es cada registro que se agregara a la tabla
			 $registro=explode(',', $parametros);
			 $tamanio=count($registro);
			 for ($i=0; $i < $tamanio; $i++) { 
			 	//Aqui se separan los 2 campos que se agregaran a las tablas siendo valor el campo en donde se obtiene el valor real
			 	//De los resultados emitidos y el id de la caracteristica a agregar
			 	list($valor,$id)=explode('#', $registro[$i]);
			 	//Aqui dividimos el valor en el nombre de su caracteristica y su valor como tal
			 	list($resultado,$valorresultado)=explode(':', $valor);
			 	//Se divide el id en su valor como tal y el nombre del input que lo contiene 
			 	list($caracteristica,$idcaracteristica)=explode(':', $id);
			 	// echo $valorresultado;
			 	// echo " ";
			 	// echo $idcaracteristica;
			 	// echo " _______________________________________ ";
			 	$sql="CALL SP_INSERTAR_RESULTADO(1,1,1,'$valorresultado','$idcaracteristica',@mensaje,@error);";
			 	$row=$conexion->ejecutarConsulta($sql);
			 	
			 }
			 
		return $registro;

		}
	}
?>