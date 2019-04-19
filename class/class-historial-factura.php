<?php

	class historialFacturas{

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
		public function __toString(){
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
		public static function cargarFacturas($conexion){
			$sql="SELECT f.ID_FACTURA,
					   f.FECHA_EXAMEN, 
					   c.NOMBRECLIENTE,
					   e.NOMBRE,
					   f.ESTADO_FACTURA,
					   ep.NOMBREEMPLEADO,
					   f.TOTAL
				FROM TBL_FACTURA f
				INNER JOIN EXAMENES_X_FACTURA ef 
				ON ef.ID_FACTURA=f.ID_FACTURA
				INNER JOIN TBL_EXAMENES e
				ON e.ID_EXAMEN=ef.ID_EXAMEN
				INNER JOIN VW_CLIENTE c
				ON c.ID_CLIENTE=f.ID_FACTURA
				INNER JOIN VW_EMPLEADO ep
				ON ep.ID_EMPLEADO=f.ID_EMPLEADO";

			$row=$conexion->ejecutarConsulta($sql);
			while(($facturas=$conexion->obtenerFila($row))){
				echo '<tr>';
				echo 		'<td>'.$facturas['ID_FACTURA'].'</td>';
				echo 		'<td>'.$facturas['FECHA_EXAMEN'].'</td>';
				echo 		'<td>'.$facturas['NOMBRECLIENTE'].'</td>';
				echo 		'<td>'.$facturas['NOMBRE'].'</td>';
				echo 		'<td>'.$facturas['ESTADO_FACTURA'].'</td>';
				echo 		'<td>'.$facturas['NOMBREEMPLEADO'].'</td>';
				echo 		'<td>'.$facturas['TOTAL'].'</td>';
				echo '</tr>';
			}
		}

		
	}
?>