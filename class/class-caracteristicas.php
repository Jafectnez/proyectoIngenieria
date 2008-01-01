<?php

	class caracteristicas{

		private $idCaracteristicas;
		private $idResultado;

		public function __construct($idCaracteristicas,
					$idResultado){
			$this->idCaracteristicas = $idCaracteristicas;
			$this->idResultado = $idResultado;
		}
		public function getIdCaracteristicas(){
			return $this->idCaracteristicas;
		}
		public function setIdCaracteristicas($idCaracteristicas){
			$this->idCaracteristicas = $idCaracteristicas;
		}
		public function getIdResultado(){
			return $this->idResultado;
		}
		public function setIdResultado($idResultado){
			$this->idResultado = $idResultado;
		}
		public function toString(){
			return "IdCaracteristicas: " . $this->idCaracteristicas . 
				" IdResultado: " . $this->idResultado;
		}
		public static function guardarCaracteristicas($conexion, $id,$parametro){
			echo $id;
			echo $parametro;
			// $registro=explode(',', $parametro);
			//  $tamanio=count($registro);
			//  $valuecr='';

			//  for ($i=0; $i < $tamanio; $i++) { 
			//  	//Aqui se separan los 2 campos que se agregaran a las tablas siendo valor el campo en donde se obtiene el valor real
			//  	//De los resultados emitidos y el id de la caracteristica a agregar
			//  	list($valor,$id)=explode('#', $registro[$i]);
			//  	//Aqui dividimos el valor en el nombre de su caracteristica y su valor como tal
			//  	list($resultado,$valorresultado)=explode(':', $valor);
			//  	//Se divide el id en su valor como tal y el nombre del input que lo contiene 
			//  	list($caracteristica,$idcaracteristica)=explode(':', $id);

                
   //              //Valores del insert que se realizara en resultados x carateristicas
			//  	$valuecr.='('.$idcaracteristica.','.$id.','.$valorresultado.'),';
			//  	// echo $valuecr;
			 	
			//  }
			//  	$valuecr = trim($valuecr,',');
		 //        $sql2='INSERT INTO CARACTERISTICAS_X_RESULTADOS(
   //                                  ID_CARACTERISTICAS,
   //                                  ID_RESULTADO,
   //                                  VALOR_RESULTADO )
   //                            VALUES'.$valuecr;
   //              echo $sql2;
   //             $row2=$conexion->ejecutarConsulta($sql2);

		}
	}
?>