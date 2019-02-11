<!DOCTYPE html>
<html>
<head>
	<title>Laboratorio Clinico Emanual-Resultados</title>
	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/carousel.js"></script>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/barra-menu.css">
	<link rel="stylesheet" type="text/css" href="css/carousel.css">
	<link href="http://allfont.es/allfont.css?fonts=comic-sans-ms" rel="stylesheet" type="text/css" />
	
</head>
<body>

	<!--Contenedor-->
	<div class="container-fluid">
		<div class="row">
			<!--Aqui Esta Contenida La La Barra De Menu-->
			<div class="col-lg-3 col-md-3 lista">
				<div class="col-lg-4 col-md-4" >
					<img src="img/usuario.jpg" class="img-responsive img-circle">
				</div>
				<div class="col-lg-7 col-md-7">
					<label style="margin-top: 10px "><b>nombre_user</b></label>
					<br>
					<a href="#">Perfil</a>
					<br>
					<a href="#">Cerrar Sesion</a>
				</div>
				<!--Lista Anidada-->

				<ul id="menu">
						<li><input type="checkbox" name="list" id="nivel1-1">  <label for="nivel1-1"> Facturación</label>
							<ul class="interior">
								<li><a href="crear_factura.php"> Crear Factura </a></li>
								<li><a href="#"> Historial De Factura</a></li>
							</ul>
						</li> 
						<li><b> <a href="inventario.php">Inventario</a></b></li>
						<li><b> <a href="catalogo.php">Catálogo De Servicios</a></b></li>
						<li><b> <a href="resultados.php">Emisión De Resultados</a></li>
						<li><b> <a href="cliente.php">Cliente</a></b></li>
						<li><b> <a href="administracion.php">Administración</a></b></li>
				</ul>
			<!--Final De La Lista Anidada-->

			</div>
			<!--Aqui Esta Finaliza La La Barra De Menu-->
			<!--Contenido Del Catalogo-->

			<div class="col-lg-9 col-md-9 well" style="border: black 1px solid;background-image:url(img/catalogo.jpg); ">
				<div style="background-color: rgba(255,255,255,0.9) ;border-radius: 25px ">
				<br>
				<!--Encabezado con opciones de las facturas-->

				<!--Barra De Menu-->
				<div  class="row" style="margin-left: 20px">
					<ul class="menu">
						<li ><span>Mover a:</span>
							<select>
								<option>Opcion 1</option>
								<option>Opcion 2</option>
								<option>Opcion 3</option>
								<option>Opcion 4</option>
							</select>
						<li style="margin-left: 150px"><input type="text" placeholder="Buscar" style="width: 200px"></li>
					</ul>
				</div>
				<!--Fin De Barra De Menu-->
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
					<tbody>
						<tr>
							<th>2</th>
							<th>10/12/2018</th>
							<th>Manolo Urbina</th>
							<th>Multiple</th>
							<th>Emitido</th>
							<th>Leví Canales</th>
							<th>140 Lps.</th>
						</tr>
						<tr>
							<th>9</th>
							<th>12/12/2018</th>
							<th>Lizzul Giron</th>
							<th>Emoglobina</th>
							<th>Emitido</th>
							<th>Leví Canales</th>
							<th>70 Lps.</th>
						</tr>
						<tr>
							<th>17</th>
							<th>23/01/2019</th>
							<th>Evelin Izaguirre</th>
							<th>Tarjeta de salud</th>
							<th>Realizado</th>
							<th>Rosa Cuello</th>
							<th>60 Lps.</th>
						</tr>
						<tr>
							<th>23</th>
							<th>15/02/2019</th>
							<th>Bessy Velasquez</th>
							<th>Hemograma</th>
							<th>Emitido</th>
							<th>Lili Giron</th>
							<th>675 Lps.</th>
						</tr>
					</tbody>
				</table>
				<!-- Fin de la tabla-->



				<!--Barra De Menu para los tipos de examenes-->
				<div  class="row" style="margin-left: 20px">
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
				</div>
				<!--Fin De Barra De Menu-->

				<!--Conteo actual de las facturas existentes-->
				<div class="row">
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
					
				</div>
				<!--Fin del conteo-->






				


				

				
				</div>
				<!--Fin del formato-->
				

			</div>

		</div>
				
			</div>
		</div>
	</div>
	<!--Fin Del Contenedor-->

</body>
</html>