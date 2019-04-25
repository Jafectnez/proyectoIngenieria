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
			$totalFacturas = 0;
				$sql="select f.id_factura idFactura,f.fecha_examen fechaExamen,p.nombre nombreCliente, p.apellido apellidoCliente, e.nombre nombreExamen,f.estado_factura estadoFactura,em.id_empleado idEmpleado, e.precio precioExamen  from tbl_factura f
					inner join tbl_cliente c
					on f.id_cliente = c.id_cliente
					inner join tbl_personas p
					on p.id_persona = c.id_persona
					inner join examenes_x_factura ef
					on ef.id_factura = f.id_factura
					inner join tbl_examenes e
					on e.id_examen = ef.id_examen
					inner join tbl_empleado em
					on em.id_empleado = f.id_empleado
					order by (f.id_factura)";
					
				$row=$conexion->ejecutarConsulta($sql);
				while(($facturas=$conexion->obtenerFila($row))){
					echo '<tr>';
					echo 		'<td>'.$facturas['idFactura'].'</td>';
					echo 		'<td>'.$facturas['fechaExamen'].'</td>';
					echo 		'<td>'.$facturas['nombreCliente'].' '.$facturas['apellidoCliente'].'</td>';
					echo 		'<td>'.$facturas['nombreExamen'].'</td>';
					echo 		'<td>'.$facturas['estadoFactura'].'</td>';
					echo 		'<td>'.$facturas['idEmpleado'].'</td>';
					echo 		'<td>'.$facturas['precioExamen'].'</td>';
					echo '</tr>';
					$totalFacturas = $totalFacturas + 1;
			}

			echo '<input type="number" id="txt-total-facturas" value="'.$totalFacturas.'" style="backgroun-color:black;">';
		}

		public static function cargarFacturasFechas($conexion,$fechaDesde,$fechaHasta){
			$totalFacturas = 0;
			$sql="select f.id_factura idFactura,f.fecha_examen fechaExamen,p.nombre nombreCliente, p.apellido apellidoCliente, e.nombre nombreExamen,f.estado_factura estadoFactura,em.id_empleado idEmpleado, e.precio precioExamen  from tbl_factura f
					inner join tbl_cliente c
					on f.id_cliente = c.id_cliente
					inner join tbl_personas p
					on p.id_persona = c.id_persona
					inner join examenes_x_factura ef
					on ef.id_factura = f.id_factura
					inner join tbl_examenes e
					on e.id_examen = ef.id_examen
					inner join tbl_empleado em
					on em.id_empleado = f.id_empleado
					where f.fecha_examen between '".$fechaDesde."' and '".$fechaHasta
					."' order by (f.id_factura)";

					
				$row=$conexion->ejecutarConsulta($sql);
				while(($facturas=$conexion->obtenerFila($row))){
					echo '<tr>';
					echo 		'<td>'.$facturas['idFactura'].'</td>';
					echo 		'<td>'.$facturas['fechaExamen'].'</td>';
					echo 		'<td>'.$facturas['nombreCliente'].' '.$facturas['apellidoCliente'].'</td>';
					echo 		'<td>'.$facturas['nombreExamen'].'</td>';
					echo 		'<td>'.$facturas['estadoFactura'].'</td>';
					echo 		'<td>'.$facturas['idEmpleado'].'</td>';
					echo 		'<td>'.$facturas['precioExamen'].'</td>';
					echo '</tr>';
					$totalFacturas = $totalFacturas + 1;
			}

			echo '<input type="number" id="txt-total-facturas" value="'.$totalFacturas.'" style="display:none;"></input>';

		}

		
	}
?>