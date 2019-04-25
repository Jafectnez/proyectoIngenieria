//<?php
//include("class/class-conexion.php");
// session_start();
// if($_SESSION['status']==false) { // CUALQUIER USUARIO REGISTRADO PUEDE VER ESTA PAGINA
//      session_destroy();
//     header("Location: login.php");
// }
//?>
<!DOCTYPE html>
<html>
	<head>
		<title>Laboratorio Clinico Emanuel-Historial Facturas</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="css/barra-menu.css">
		<link rel="stylesheet" type="text/css" href="css/styles.css">
		<link rel="stylesheet" type="text/css" href="css/styleBarra.css">
		<link rel="stylesheet" href="css/jquery-confirm.min.css">
	</head>
	<body>

		<!--Contenedor-->
		<div class="container-fluid">
			<div class="row">
				<!--Aqui Esta Contenida La La Barra De Menu-->
				<div id="barraNav" class="col-lg-2 col-md-2 col-sm-2 lista" style="width: 20%"></div>
				<!--Aqui Esta Finaliza La La Barra De Menu-->

				<!--Contenido Del Catalogo-->

				<div class="col-lg-10 col-md-10 col-sm-10 well" style="border: black 1px solid;background-image:url(img/catalogo.jpg);width: 80%">
					<div style="background-color: rgba(255,255,255,0.9) ;border-radius: 25px ">
					<br>
					<!--Encabezado con opciones de las facturas-->

					<div style="text-align: center">
							<h5><strong>Laboratorio Clínico Emanuel</strong></h5>
							<h6><strong>SIRVIENDO A DIOS ATRAVES DE SU SALUD</strong></h6>
							<h6><strong>La libertad, Comayagua, Honduras, C.A</strong></h6>
							<h6><strong>Telefonos: 2784-0292, 2784-0699</strong></h6>
							<h6><strong>R.T.N 03131965001420</strong></h6>
							<h6><strong>C.A.I 289EFE-910C78-7C4C88-3CDEDF-FF9732-C7</strong></h6>
							<h4>Historial de facturación</h4>
							<hr>
					</div>

					<div class="row">
						<div class="col-md-8 col-lg-8">
							
						</div>
						<div class="col-md-4 col-lg-4">
							<div style="text-align: left">
								<button class="btn btn-default btn-lg" id="btn-regresar-atras" onclick="regresarAtras();">
									<span class="glyphicon glyphicon-circle-arrow-left"></span> Regresar al Historial
								</button>
							</div>
						</div>
						
					</div>
					<hr>
					
					<!--Fin del encabezado-->



					<!--Tabla que contiene el historial de las pruebas-->
					<table class="table table-striped">
						<thead>
							<tr>
								<th scope="col">Cod</th>
								<th scope="col">Fecha</th>
								<th scope="col">Cliente</th>
								<th scope="col">Tipo examen</th>
								<th scope="col">Estado</th>
								<th scope="col">Cajero</th>
								<th scope="col">Costo</th>
							</tr>
						</thead>
						<tbody id="tbl-cuerpo-historial">
							
						</tbody>
					</table>
					<!-- Fin de la tabla-->

					<!--Barra De Menu para los tipos de examenes-->
 				<!-- 	<div  class="row" style="margin-left: 20px">
						<ul class="menu">
							<li ><span>Examén:</span>
								<select>
									<option>Opcion 1</option>
									<option>Opcion 2</option>
									<option>Opcion 3</option>
									<option>Opcion 4</option>
								</select>
							<li style="margin-left: 150px"><input type="text" placeholder="Examen disponible" style="width: 200px"></li>
						</ul>
					</div> -->
					<!--Fin De Barra De Menu -->

					<!--Conteo actual de las facturas existentes-->
					<!-- <div class="row">
						<div class="col-lg-3 col-md-3">
							<p>
								<span>
									Facturas: <input type="number" name="" style="width: 150px">
								</span>
							</p>
						</div>

						<div class="col-lg-3 col-md-3">
							<p>
								<span>
									Total: <input type="number" name="" style="width: 150px">
								</span>
							</p>
						</div>

						<div class="col-lg-3 col-md-3">
							<p>
								<span>
									De: <input type="text" name="" style="width: 150px">
								</span>
							</p>
						</div>

						<div class="col-lg-3 col-md-3">
							<p>
								<span>
									Hasta: <input type="text" name="" style="width: 150px">
								</span>
							</p>
						</div>
					</div> -->
					<table class="table">
						<tr>
							
							<td>
								<span>
									Total: <input type="number" name="" readonly="readonly" style="width: 150px">
								</span>
							</td>
							<td>
								<span>
									De: <input placeholder="03/09/2019" type="date" id="txt-fecha-desde"  style="width: 170px">
								</span>
							</td>
							<td>
								<span>
									Hasta: <input placeholder="03/09/2019" type="date" id="txt-fecha-hasta" style="width: 170px">
								</span>
							</td>
							<td>
								<button type="button" class="btn btn-default btn-lg" id="btn-buscar" onclick="buscarFactura();">
									<span class="glyphicon glyphicon-search"></span>
								</button>
							</td>
						</tr>
					</table>
					<!--Fin del conteo-->
				</div>
				<!--Fin del formato-->
			</div>
		</div>
		<!--Fin Del Contenedor-->
	</body>
	
	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/carousel.js"></script>
	<script src="js/menu.js"></script>
	<script src="js/controladores/historialFactura.js"></script>
	<script src="js/jquery-confirm.min.js"></script>
</html>