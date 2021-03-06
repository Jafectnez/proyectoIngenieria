<?php
//promociones.php obtiene la informacion requerida en promociones actuales y el historico

// nota para el segmento de filtros: se toman como parametros aceptables todas las fechas que intercepten en un punto
// a las fechas especificadas en el filtro
require_once('conexion.php');
$conexion = conectar();
$sql = "SELECT * FROM `TBL_PROMOCIONES`"; 
$result = mysqli_query($conexion, $sql);
$fecha_actual = strtotime(date("d-m-Y"));
$contador = 1;
$p_disponibles = true;
$accion = $_POST['ac'];

if ($accion == 1) { // imprime solo las promociones en vigencia.
	tablaHead();
while( $row = mysqli_fetch_array($result)){
	if ($fecha_actual <= strtotime($row["FECHA_FIN"])) {
		//=LM355=====================================================
		$sql1 = "SELECT * FROM `PROMOCIONES_X_EXAMENES` WHERE `TBL_PROMOCIONES_ID_PROMOCIONES` =".$row["ID_PROMOCIONES"];
		$result1 = mysqli_query($conexion, $sql1);
		$row1 = mysqli_fetch_array($result1);
		$sql1 = "SELECT * FROM `TBL_EXAMENES` WHERE `ID_EXAMEN` =".$row1["TBL_EXAMENES_ID_EXAMEN"];
		$result1 = mysqli_query($conexion, $sql1);
  	    $numero = mysqli_num_rows($result1);
  	    if ($numero == 1) {
			$row1 = mysqli_fetch_array($result1);
			$examen = $row1["NOMBRE"];
  	    } else {
  	    	$examen = "Sin examen asociado";
  	    }
		//=F_LM355===================================================
		$p_disponibles = false;
		echo '<tr>
        <td>'.$contador.'</td>		
        <td>'.$examen.'</td>
        <td>'.$row["DESCRIPCION"].'</td>
        <td>'.$row["RESTRICCIONES"].'</td>
        <td>'.$row["PROMOCION"].'</td>        
        <td>'.$row["FECHA_INICIO"].'</td>
        <td>'.$row["FECHA_FIN"].'</td>
      	</tr>';
      	$contador++;
	}
}
if ($p_disponibles) {
	echo "<p>No hay promociones disponibles en la actualidad</p>";
}
tablaFooter();
}


if ($accion == 2) {//recibe como parametro solo busqueda de texto sin fechas
	$dato = $_POST['fi']; // parametro de buesqueda en el historial
	$cadena = "";//captura los id de promociones compatibles
	//en esta primer consulta obtenemos el id del nombre del examen
    $sql1 = "SELECT * FROM `TBL_EXAMENES` where `NOMBRE` like '%$dato%'";
	$result1 = mysqli_query($conexion, $sql1);
	if (mysqli_num_rows($result1)>0) {
		$row1 = mysqli_fetch_array($result1);
		$examen = $row1["NOMBRE"];
	$sql1 = "SELECT * FROM `PROMOCIONES_X_EXAMENES` WHERE `TBL_EXAMENES_ID_EXAMEN` =".$row1["ID_EXAMEN"];
	$result1 = mysqli_query($conexion, $sql1);
	tablaHead();
	while($row1 = mysqli_fetch_array($result1)){
		$cadena = $cadena.$row1["TBL_PROMOCIONES_ID_PROMOCIONES"]."-";
	}
	$cadena = explode("-", $cadena);
	
	for ($i=0; $i < count($cadena) -1; $i++) { 
		$sql1 = "SELECT * FROM `TBL_PROMOCIONES` WHERE `ID_PROMOCIONES` =".$cadena[$i];
		$result1 = mysqli_query($conexion, $sql1);
		$row1 = mysqli_fetch_array($result1);
		echo '<tr>
        <td>'.$contador.'</td>		
    	<td>'.$examen.'</td>
        <td>'.$row1["DESCRIPCION"].'</td>
        <td>'.$row1["RESTRICCIONES"].'</td>
        <td>'.$row1["PROMOCION"].'</td>                
        <td>'.$row1["FECHA_INICIO"].'</td>
        <td>'.$row1["FECHA_FIN"].'</td>
      	</tr>';
  		$contador++;		
	}
	} else {
		echo "<p>Sin resultados, intente con una nueva busqueda</p>";
	}	
	tablaFooter();
} // fin if accion = 2


if ($accion == 3) {// recibe fechas y texto
	$desde = $_POST['de'];
	$hasta = $_POST['ha'];
	$dato = $_POST['fi']; // parametro de buesqueda en el historial	
	$cadena = "";//captura los id de promociones compatibles
	//en esta primer consulta obtenemos el id del nombre del examen
    $sql1 = "SELECT * FROM `TBL_EXAMENES` where `NOMBRE` like '%$dato%'";
	$result1 = mysqli_query($conexion, $sql1);
	if (mysqli_num_rows($result1)>0) {
		$row1 = mysqli_fetch_array($result1);
		$examen = $row1["NOMBRE"];
	$sql1 = "SELECT * FROM `PROMOCIONES_X_EXAMENES` WHERE `TBL_EXAMENES_ID_EXAMEN` =".$row1["ID_EXAMEN"];
	$result1 = mysqli_query($conexion, $sql1);
	tablaHead();
	while($row1 = mysqli_fetch_array($result1)){
		$cadena = $cadena.$row1["TBL_PROMOCIONES_ID_PROMOCIONES"]."-";
	}
	$cadena = explode("-", $cadena);
	
	for ($i=0; $i < count($cadena) -1; $i++) { 
		$sql1 = "SELECT * FROM `TBL_PROMOCIONES` WHERE `ID_PROMOCIONES` =".$cadena[$i];
		$result1 = mysqli_query($conexion, $sql1);
		$row1 = mysqli_fetch_array($result1);
		if (strtotime($desde)<=strtotime($row1["FECHA_INICIO"]) && strtotime($hasta) >= strtotime($row1["FECHA_INICIO"]) && strtotime($hasta) <= strtotime($row1["FECHA_FIN"])) {
			echo '<tr>
		    <td>'.$contador.'</td>		
			<td>'.$examen.'</td>
		    <td>'.$row1["DESCRIPCION"].'</td>
		    <td>'.$row1["RESTRICCIONES"].'</td>
        	<td>'.$row1["PROMOCION"].'</td>        
		    <td>'.$row1["FECHA_INICIO"].'</td>
		    <td>'.$row1["FECHA_FIN"].'</td>
		  	</tr>';
			$contador++;
		}
		if (strtotime($desde)>=strtotime($row1["FECHA_INICIO"]) && strtotime($hasta) <= strtotime($row1["FECHA_FIN"])) {
			echo '<tr>
		    <td>'.$contador.'</td>		
			<td>'.$examen.'</td>
		    <td>'.$row1["DESCRIPCION"].'</td>
		    <td>'.$row1["RESTRICCIONES"].'</td>
        	<td>'.$row1["PROMOCION"].'</td>        

		    <td>'.$row1["FECHA_INICIO"].'</td>
		    <td>'.$row1["FECHA_FIN"].'</td>
		  	</tr>';
			$contador++;
		}
		if (strtotime($desde)>=strtotime($row1["FECHA_INICIO"]) && strtotime($hasta) > strtotime($row1["FECHA_FIN"]) && strtotime($desde) < strtotime($row1["FECHA_FIN"])) {
			echo '<tr>
		    <td>'.$contador.'</td>		
			<td>'.$examen.'</td>
		    <td>'.$row1["DESCRIPCION"].'</td>
		    <td>'.$row1["RESTRICCIONES"].'</td>
        	<td>'.$row1["PROMOCION"].'</td>        

		    <td>'.$row1["FECHA_INICIO"].'</td>
		    <td>'.$row1["FECHA_FIN"].'</td>
		  	</tr>';
			$contador++;
		}
	}
	if ($contador == 1){
		echo "<p>Sin resultados, intente con una nueva busqueda</p>";
	}
	} else {
		echo "<p>Sin resultados, intente con una nueva busqueda</p>";
	}	
	tablaFooter();
}// fin if accion 3

if ($accion == 4) {// recibe solamente fechas
	$desde = $_POST['de'];
	$hasta = $_POST['ha'];
	$examen = "Examen";
	tablaHead();	
	$sql1 = "SELECT * FROM `TBL_PROMOCIONES`";
	$result1 = mysqli_query($conexion, $sql1);

	while ($row1 = mysqli_fetch_array($result1)) {		
		if (strtotime($desde)<=strtotime($row1["FECHA_INICIO"]) && strtotime($hasta) >= strtotime($row1["FECHA_INICIO"]) && strtotime($hasta) <= strtotime($row1["FECHA_FIN"])) {
			$sql = "SELECT * FROM `PROMOCIONES_X_EXAMENES` WHERE `TBL_PROMOCIONES_ID_PROMOCIONES` =".$row1["ID_PROMOCIONES"];
			$result = mysqli_query($conexion, $sql);
			$row = mysqli_fetch_array($result);
			$sql = "SELECT * FROM `TBL_EXAMENES` WHERE `ID_EXAMEN` =".$row["TBL_EXAMENES_ID_EXAMEN"];
			$result = mysqli_query($conexion, $sql);
			$numero = mysqli_num_rows($result);
			if ($numero == 1) {
			$row = mysqli_fetch_array($result);
			$examen = $row["NOMBRE"];
			}
			echo '<tr>
			<td>'.$contador.'</td>		
			<td>'.$examen.'</td>
			<td>'.$row1["DESCRIPCION"].'</td>
			<td>'.$row1["RESTRICCIONES"].'</td>
        	<td>'.$row1["PROMOCION"].'</td>        

			<td>'.$row1["FECHA_INICIO"].'</td>
			<td>'.$row1["FECHA_FIN"].'</td>
			</tr>';
			$contador++;
		}
		if (strtotime($desde)>=strtotime($row1["FECHA_INICIO"]) && strtotime($hasta) <= strtotime($row1["FECHA_FIN"])) {
			$sql = "SELECT * FROM `PROMOCIONES_X_EXAMENES` WHERE `TBL_PROMOCIONES_ID_PROMOCIONES` =".$row1["ID_PROMOCIONES"];
			$result = mysqli_query($conexion, $sql);
			$row = mysqli_fetch_array($result);
			$sql = "SELECT * FROM `TBL_EXAMENES` WHERE `ID_EXAMEN` =".$row["TBL_EXAMENES_ID_EXAMEN"];
			$result = mysqli_query($conexion, $sql);
			$numero = mysqli_num_rows($result);
			if ($numero == 1) {
			$row = mysqli_fetch_array($result);
			$examen = $row["NOMBRE"];
			}
			echo '<tr>
			<td>'.$contador.'</td>		
			<td>'.$examen.'</td>
			<td>'.$row1["DESCRIPCION"].'</td>
			<td>'.$row1["RESTRICCIONES"].'</td>
        	<td>'.$row1["PROMOCION"].'</td>        

			<td>'.$row1["FECHA_INICIO"].'</td>
			<td>'.$row1["FECHA_FIN"].'</td>
			</tr>';
			$contador++;
		}
		if (strtotime($desde)>=strtotime($row1["FECHA_INICIO"]) && strtotime($hasta) > strtotime($row1["FECHA_FIN"]) && strtotime($desde) < strtotime($row1["FECHA_FIN"])) {
			$sql = "SELECT * FROM `PROMOCIONES_X_EXAMENES` WHERE `TBL_PROMOCIONES_ID_PROMOCIONES` =".$row1["ID_PROMOCIONES"];
			$result = mysqli_query($conexion, $sql);
			$row = mysqli_fetch_array($result);
			$sql = "SELECT * FROM `TBL_EXAMENES` WHERE `ID_EXAMEN` =".$row["TBL_EXAMENES_ID_EXAMEN"];
			$result = mysqli_query($conexion, $sql);
			$numero = mysqli_num_rows($result);
			if ($numero == 1) {
			$row = mysqli_fetch_array($result);
			$examen = $row["NOMBRE"];
			}
			echo '<tr>
			<td>'.$contador.'</td>		
			<td>'.$examen.'</td>
			<td>'.$row1["DESCRIPCION"].'</td>
			<td>'.$row1["RESTRICCIONES"].'</td>
        	<td>'.$row1["PROMOCION"].'</td>        

			<td>'.$row1["FECHA_INICIO"].'</td>
			<td>'.$row1["FECHA_FIN"].'</td>
			</tr>';
			$contador++;
		}
	}
	if ($contador == 1){
		echo "<p>Sin resultados, intente con una nueva busqueda</p>";
	}		
	tablaFooter();
}// fin if accion 4

function tablaHead()
{
	echo '<table class="table">
    <thead>
      <tr>
        <th>N-</th>
        <th>Examen</th>
        <th>Descripción</th>
        <th>Restricción</th>
        <th>Descuento %</th>
        <th>Comienzo</th>
        <th>Final</th>
      </tr>
    </thead>
    <tbody>
	';
}
function tablaFooter()
{
	echo '</tbody>
	</table>';
}

mysqli_close($conexion);

?> 