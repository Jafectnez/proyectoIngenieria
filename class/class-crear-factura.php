<?php

	class crearFactura{

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

		//Metodo para obtener la ultima factura registrada en la base de datos
		public static function ultimaFactura ($conexion){
			$sql = 'select id_factura idFactura from tbl_factura order by id_factura desc limit 1';
			$rows = $conexion->query($sql);
      		

      		$resultado = $conexion->ejecutarConsulta($sql);
      		while(($factura=$conexion->obtenerFila($resultado))){
      			//Primero asegurarse que la tabla no exista
      			$sql2 = 'DROP TABLE IF EXISTS tbl_examenes_x_factura'.($factura['idFactura']+1);
      			$resultado2 = $conexion->ejecutarConsulta($sql2);


      			//Crear nuevamente la tabla
      			$sql1 = 'create table tbl_examenes_x_factura'.($factura['idFactura']+1).'( id_examen INT, id_factura INT )';
				$resultado1 = $conexion->ejecutarConsulta($sql1);
					
      		}

      		return $rows;
		}

		//Metodo para listar los servicios de la empresa
		public static function obtenerServicios($conexion){
			$sql = 'select id_area,nombre from tbl_area';
			$resultado = $conexion->ejecutarConsulta($sql);
			echo '<div id="wrapper">';
			echo "<h4><strong>Servicios</strong></h4>";
			echo '<ul class="menu">';
			$item = 1;
			while(($servicio=$conexion->obtenerFila($resultado))){
				echo '<li class="item'.$item.'" style="margin-bottom:-20px"><a href="#">'.$servicio['nombre'].'</a>'; 
				echo "<ul>";
				//Obtener los examenes por cada area
				$sql1 = 'select id_examen,id_area,nombre,precio from tbl_examenes where id_area='.$servicio['id_area'];;
				$resultado1 = $conexion->ejecutarConsulta($sql1);
				$item1=1;
					while(($examen=$conexion->obtenerFila($resultado1))){
						echo '<li class="subitem'.$item.'" onclick="servicioSeleccionado('.$examen['id_examen'].','.$examen['id_area'].')"><a href="#">'.$examen['nombre'].'</a></li>';
						$item1 = $item1 + 1;
					}
				echo "</ul>";
				echo "<br>";
				$item = $item + 1;
			} 	
			echo "</ul>";
			echo "</div>";
			
		}
		//---------------------------------------------------------------------------


		//---------------------------------------------------------------------------

		//Funcion que establecera los parametros de cada uno de los servicios
		public static function seleccionarServicio($conexion,$idExamen,$codigoFactura){
			

			// Insertar los registros en la parte de la tabla
			$sql1 = 'insert into tbl_examenes_x_factura'.$codigoFactura.' value ('.$idExamen.','.$codigoFactura.')';
			$resultado1 = $conexion->ejecutarConsulta($sql1);
			echo $sql1;
			
		}
		//---------------------------------------------------------------------------

		//Funcion para eliminar un registro de ser necesario en la factura
		public static function eliminarServicio($conexion,$idExamen,$codigoFactura){
			$sql = 'delete from tbl_examenes_x_factura'.$codigoFactura.' where (id_examen = '.$idExamen.' and id_factura = '.$codigoFactura.')';
			$resultado = $conexion->ejecutarConsulta($sql);


		}
		//---------------------------------------------------------------------------


		//Funcion para mostrar en pantalla
		public static function mostrarPantalla($conexion,$idExamen,$codigoFactura){
			//Llenado en pantalla de cada registro
			$sql = 'select e.nombre nombreExamen,e.precio precio, e.id_examen idExamen from tbl_examenes_x_factura'.$codigoFactura.' ef inner join tbl_examenes e 
				on e.id_examen = ef.id_examen';

			$resultado = $conexion->ejecutarConsulta($sql);
			echo "<h6><strong>Servicios</strong></h6>";
			echo '<table class="table table-striped " >';
			while(($servicio=$conexion->obtenerFila($resultado))){
				echo '<tr>';
				echo 		'<th>'.$servicio['nombreExamen'].'</th>';
				echo 		'<th>'.$servicio['precio'].'</th>';
				echo 		'<th><span class="glyphicon glyphicon-remove-sign" onclick="eliminarExamen('.$servicio['idExamen'].','.$codigoFactura.')"></span></th>';
				echo '</tr>';
			}
			echo '</table>';

		}
		//---------------------------------------------------------------------------


		//Funcion para calcular el total de la factura
		public static function totalFactura($conexion,$codigoFactura){
			$sql = 'select sum(e.precio) total from tbl_examenes_x_factura'.$codigoFactura.' ef
					inner join tbl_examenes e
					on ef.id_examen = e.id_examen
					where ef.id_factura = '.$codigoFactura;
			//echo $sql;
			$rows = $conexion->query($sql);
      		return $rows;

		}

		//---------------------------------------------------------------------------

		//Funcion para obtener las promociones 
		public static function obtenerPromociones($conexion,$fechaActual,$idFactura){
			$sql = 'select e.id_examen idExamen from tbl_examenes_x_factura'.$idFactura.' ef
					inner join tbl_examenes e on e.id_examen = ef.id_examen
					where ef.id_factura = '.$idFactura;
			$totalPromocion = 0;
			$resultado = $conexion->ejecutarConsulta($sql);
			while(($examen=$conexion->obtenerFila($resultado))){
				$sql1 = 'select e.nombre nombre,e.precio precio,p.promocion promocion, p.fecha_fin fechaFin, p.fecha_inicio fechaInicio from promociones_x_examenes pe 
						 inner join tbl_examenes e 
						 on e.id_examen = pe.tbl_examenes_id_examen
						 inner join tbl_promociones p
						 on p.id_promociones = pe.tbl_promociones_id_promociones
						 where (e.id_examen = '.$examen['idExamen'].' and ("'.$fechaActual.'" between p.fecha_inicio and p.fecha_fin))';


				$resultado1 = $conexion->ejecutarConsulta($sql1);
				while(($promocion=$conexion->obtenerFila($resultado1))){
						echo '<span>'.$promocion['nombre'].' ('.$promocion['precio'].' - '.$promocion['promocion'].'%)</span>';
						echo "<br>";
						$monto = $promocion['precio'] * $promocion['promocion'];
						$totalPromocion = $totalPromocion + $monto;
				}
			

			}
			//echo "No hay promociones disponibles";
			echo '<input type="input" name="totalPromocion" id="total-promocion" style="width: 80px;" value="'.$totalPromocion.'" checked>';
		}
		
	}
?>