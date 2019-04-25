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
				$sql="select f.id_factura idFactura,f.fecha_examen fechaExamen,p.nombre nombreCliente, p.apellido apellidoCliente,f.estado_factura estadoFactura,em.id_empleado idEmpleado, f.total costoTotal  from tbl_factura f
					inner join tbl_cliente c
					on f.id_cliente = c.id_cliente
					inner join tbl_personas p
					on p.id_persona = c.id_persona
					inner join tbl_empleado em
					on em.id_empleado = f.id_empleado
					order by (f.id_factura)";
					
				$row=$conexion->ejecutarConsulta($sql);
				while(($facturas=$conexion->obtenerFila($row))){
					echo '<tr>';
					echo 		'<td>'.$facturas['idFactura'].'</td>';
					echo 		'<td>'.$facturas['fechaExamen'].'</td>';
					echo 		'<td>'.$facturas['nombreCliente'].' '.$facturas['apellidoCliente'].'</td>';
					echo 		'<td>'.$facturas['estadoFactura'].'</td>';
					echo 		'<td>'.$facturas['idEmpleado'].'</td>';
					echo 		'<td>'.$facturas['costoTotal'].'</td>';
					echo 		'<td>';
					echo 			'<button onclick="visualizarFactura('.$facturas['idFactura'].');">';
					echo 				'<span class="glyphicon glyphicon-eye-open"></span>';
					echo 			'</button>';
					echo 		'</td>';
					echo '</tr>';
					$totalFacturas = $totalFacturas + 1;
			}
		}

		public static function cargarFacturasFechas($conexion,$fechaDesde,$fechaHasta){
			$totalFacturas = 0;
				$sql="select f.id_factura idFactura,f.fecha_examen fechaExamen,p.nombre nombreCliente, p.apellido apellidoCliente,f.estado_factura estadoFactura,em.id_empleado idEmpleado, f.total costoTotal  from tbl_factura f
					inner join tbl_cliente c
					on f.id_cliente = c.id_cliente
					inner join tbl_personas p
					on p.id_persona = c.id_persona
					inner join tbl_empleado em
					on em.id_empleado = f.id_empleado
					where f.fecha_examen between '".$fechaDesde."' and '".$fechaHasta
					."' order by (f.id_factura)";
				echo $sql;
					
				$row=$conexion->ejecutarConsulta($sql);
				while(($facturas=$conexion->obtenerFila($row))){
					echo '<tr>';
					echo 		'<td>'.$facturas['idFactura'].'</td>';
					echo 		'<td>'.$facturas['fechaExamen'].'</td>';
					echo 		'<td>'.$facturas['nombreCliente'].' '.$facturas['apellidoCliente'].'</td>';
					echo 		'<td>'.$facturas['estadoFactura'].'</td>';
					echo 		'<td>'.$facturas['idEmpleado'].'</td>';
					echo 		'<td>'.$facturas['costoTotal'].'</td>';
					echo 		'<td>';
					echo 			'<button onclick="visualizarFactura('.$facturas['idFactura'].');">';
					echo 				'<span class="glyphicon glyphicon-eye-open"></span>';
					echo 			'</button>';
					echo 		'</td>';
					echo '</tr>';
					$totalFacturas = $totalFacturas + 1;
			}

		}

		public static function visualizarFactura($conexion,$idFactura){
			$sql = 'select p.nombre nombre, p.apellido apellido,f.total totalFactura, f.fecha_examen
			fechaFactura from tbl_personas p
					inner join tbl_cliente c on c.id_persona = p.id_persona
					inner join tbl_factura f on f.id_cliente = c.id_cliente
					where f.id_factura = '.$idFactura;
			
			$resultado = $conexion->ejecutarConsulta($sql);
			while(($factura=$conexion->obtenerFila($resultado))){
				echo '<input type="text" id="input-nombre" value="'.$factura['nombre'].' '.$factura['apellido'].'"></input>';
				echo '<input type="text" id="input-total" value="'.$factura['totalFactura'].'"></input>';
				echo '<input type="text" id="input-fecha" value="'.$factura['fechaFactura'].'"></input>';
					
			}

			$sql1 = 'select count(ef.id_examen) cantidadFacturas from tbl_factura f
					inner join examenes_x_factura ef on ef.id_factura = f.id_factura
					where f.id_factura = '.$idFactura;
			$resultado1 = $conexion->ejecutarConsulta($sql1);
			while(($cantidadFactura=$conexion->obtenerFila($resultado1))){
				echo '<input type="text" id="input-cantidad-factura" value="'.$cantidadFactura['cantidadFacturas'].'"></input>';
					
			}

			$sql2 = 'select e.nombre nombreExamen,e.precio precioExamen, e.id_examen idExamen,f.fecha_examen fechaFactura from tbl_factura f
					inner join examenes_x_factura ef on ef.id_factura = f.id_factura
					inner join tbl_examenes e on e.id_examen = ef.id_examen
					where f.id_factura = '.$idFactura;

			
			$registros = '';
			$resultado2 = $conexion->ejecutarConsulta($sql2);
			while(($examen=$conexion->obtenerFila($resultado2))){
				$sql3 = 'select p.promocion rebajaPromocion from tbl_promociones p
						inner join promociones_x_examenes pe 
						on p.id_promociones = pe.tbl_promociones_id_promociones
						inner join tbl_examenes e
						on e.id_examen = pe.tbl_examenes_id_examen
						where (e.id_examen = '.$examen['idExamen'].' and
						("'.$examen['fechaFactura'].'" between p.fecha_inicio and p.fecha_fin)
					)';
				echo $sql3;
				$resultado3 = $conexion->ejecutarConsulta($sql3);
				if (($promocion=$conexion->obtenerFila($resultado3))) {
					$promo = $examen['precioExamen'] * $promocion['rebajaPromocion'];
					//echo $promocion['rebajaPromocion'];
					$registros =  $registros.
							'<tr>'.
								'<td>'.
									$examen['nombreExamen'].
								'</td>'.
								'<td>'.
									$examen['precioExamen'].
								'</td>'.
								'<td>'.
									'- '.$promo.
								'</td>'.
							 '</tr>';
					
				}else{




				$registros =  $registros.
							'<tr>'.
								'<td>'.
									$examen['nombreExamen'].
								'</td>'.
								'<td>'.
									$examen['precioExamen'].
								'</td>'.
								'<td>'.
									'0.0'.
								'</td>'.
							 '</tr>';
				
			}		
			}
			$tabla = $registros;
			echo "'".'<input type="text" id="input-tabla" value="'.$tabla.'"></input>'."'";
		}

		
	}
?>