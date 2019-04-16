<?php

	class Factura{

		private $idFactura;
		private $idImpuesto;
		private $idCliente;
		private $idEmpleado;
		private $idFormaPago;
		private $rtn;
		private $fechaExamen;
		private $total;
		private $estadoFactura;

		public function __construct($idFactura,
					$idImpuesto,
					$idCliente,
					$idEmpleado,
					$idFormaPago,
					$rtn,
					$fechaExamen,
					$total,
					$estadoFactura){
			$this->idFactura = $idFactura;
			$this->idImpuesto = $idImpuesto;
			$this->idCliente = $idCliente;
			$this->idEmpleado = $idEmpleado;
			$this->idFormaPago = $idFormaPago;
			$this->rtn = $rtn;
			$this->fechaExamen = $fechaExamen;
			$this->total = $total;
			$this->estadoFactura = $estadoFactura;
		}
		public function getIdFactura(){
			return $this->idFactura;
		}
		public function setIdFactura($idFactura){
			$this->idFactura = $idFactura;
		}
		public function getIdImpuesto(){
			return $this->idImpuesto;
		}
		public function setIdImpuesto($idImpuesto){
			$this->idImpuesto = $idImpuesto;
		}
		public function getIdCliente(){
			return $this->idCliente;
		}
		public function setIdCliente($idCliente){
			$this->idCliente = $idCliente;
		}
		public function getIdEmpleado(){
			return $this->idEmpleado;
		}
		public function setIdEmpleado($idEmpleado){
			$this->idEmpleado = $idEmpleado;
		}
		public function getIdFormaPago(){
			return $this->idFormaPago;
		}
		public function setIdFormaPago($idFormaPago){
			$this->idFormaPago = $idFormaPago;
		}
		public function getRtn(){
			return $this->rtn;
		}
		public function setRtn($rtn){
			$this->rtn = $rtn;
		}
		public function getFechaExamen(){
			return $this->fechaExamen;
		}
		public function setFechaExamen($fechaExamen){
			$this->fechaExamen = $fechaExamen;
		}
		public function getTotal(){
			return $this->total;
		}
		public function setTotal($total){
			$this->total = $total;
		}
		public function getEstadoFactura(){
			return $this->estadoFactura;
		}
		public function setEstadoFactura($estadoFactura){
			$this->estadoFactura = $estadoFactura;
		}
		public function toString(){
			return "IdFactura: " . $this->idFactura . 
				" IdImpuesto: " . $this->idImpuesto . 
				" IdCliente: " . $this->idCliente . 
				" IdEmpleado: " . $this->idEmpleado . 
				" IdFormaPago: " . $this->idFormaPago . 
				" Rtn: " . $this->rtn . 
				" FechaExamen: " . $this->fechaExamen . 
				" Total: " . $this->total . 
				" EstadoFactura: " . $this->estadoFactura;
		}

		public static function leerUltimaFactura($conexion){
			$sql = '
					SELECT MAX(ID_FACTURA) as ID_ULTIMA_FACTURA
					FROM TBL_FACTURA;
			';
			$row = $conexion->query($sql);
			return $row;
		}
	}
?>