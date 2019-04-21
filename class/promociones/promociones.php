<?php
//promociones.php obtiene la informacion requerida en promociones actuales y el historico
require_once('conexion.php');
$conexion = conectar();
$sql = "SELECT * FROM `TBL_PROMOCIONES`"; 
$result = mysqli_query($conexion, $sql);
$fecha_actual = strtotime(date("d-m-Y"));
$contador = 1;
$p_disponibles = true;
$accion = $_POST['ac'];

if ($accion == 1) {
	echo '<table class="table">
    <thead>
      <tr>
        <th>N-</th>
        <th>Examen</th>
        <th>Descripción</th>
        <th>Restricción</th>
        <th>Comienzo</th>
        <th>Final</th>
      </tr>
    </thead>
    <tbody>
';
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
        <td>'.$row["FECHA_INICIO"].'</td>
        <td>'.$row["FECHA_FIN"].'</td>
      	</tr>';
      	$contador++;
	}
}
if ($p_disponibles) {
	echo "<p>No hay promociones disponibles en la actualidad</p>";
}
echo '</tbody>
  </table>';
} else {
	echo "<p>Pura mierda, Dentro de historico</p>";
}
?> 





      
