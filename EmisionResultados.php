<!DOCTYPE html>
<html>
<head>
<<<<<<< HEAD
	<title>Laboratorio Clinico Emanual-Catalogo</title>
=======
	<title>Laboratorio Clinico Emanual-Emisión de Resultados</title>
	<meta charset="utf-8" />
	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/carousel.js"></script>
>>>>>>> upstream/menu2
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/barra-menu.css">
	<link rel="stylesheet" type="text/css" href="css/carousel.css">
	<link href="http://allfont.es/allfont.css?fonts=comic-sans-ms" rel="stylesheet" type="text/css" />
	
</head>
<body>

	<!--Contenedor-->
	<div class="container-fluid">
		<div class="row">
<<<<<<< HEAD
		<!--Aqui Esta Contenida La Barra De Menu-->
		<div id="barraNav" class="col-lg-3 lista"></div>
        <!--Aqui Esta Finaliza La La Barra De Menu-->
		
		<!--Contenido Del Catalogo-->
=======
			<!--Aqui Esta Contenida La La Barra De Menu-->
			<div class="col-lg-3 lista">
				<div class="col-lg-4">
					<img src="img/usuario.jpg" class="img-responsive img-circle">
				</div>
				<div class="col-lg-7">
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
								<li><a href="historial_factura.php"> Historial De Factura</a></li>
							</ul>
						</li> 

						<li><b> <a href="inventario.php">Inventario</a></b></li>
						<li><b> <a href="catalogo.php">Catalogo De Servicios</a></b></li>
						<li><b> <a href="#">Emision De Resultados</a></li>
						<li><b> <a href="cliente.php">Cliente</a></b></li>
						<li><b> <a href="administracion.php">Administración</a></b></li>
				</ul>
			<!--Final De La Lista Anidada-->

			</div>
			<!--Aqui Esta Finaliza La La Barra De Menu-->
			<!--Contenido Del Catalogo-->
>>>>>>> upstream/menu2

			<div class="col-lg-9 well" style="border: black 1px solid;">
				<!--Barra De Menu-->
				<ul class="menu">
					<li style="padding-right: 170px"><input type="text" placeholder="Perfil"></li>
					<li><span class="glyphicon glyphicon-plus-sign" style="font-size: 40px"></span> </li>
					<li><a href="">Añadir Resultado</a></li>
				</ul>
				<!--Fin De Barra De Menu-->
				<!--Contenido-->
				<label><span class="glyphicon glyphicon-plus-sign" style="font-size: 20px"></span>Filtro/Tag</label>
				<a href="">Tipo Cliente x: Regular x, Nuevo x, Perdido x, Aprox:"2 Meses"x</a>
				<br><br>
				<label>Acciones: </label>
				<span class="glyphicon glyphicon-trash forte"></span>
				<span class="glyphicon glyphicon-print forte"></span>
				<span class="glyphicon glyphicon-file forte"></span>
				<span class="glyphicon glyphicon-envelope forte"></span>
				<span class="glyphicon glyphicon-floppy-disk forte"></span>
				<select class="form.control">
					<option>Mover a:</option>
					<option>Mover a 1:</option>
					<option>Mover a 2:</option>
					<option>Mover a 3:</option>
					<option>Mover a 4:</option>
				</select>
				<div class="lista" style="padding-bottom: 0px">
					<label>Todos</label>				
				</div>
				<div class="lista" style="padding-bottom: 0px">
					<label>Resultados No Entregados</label>	
				</div>
				<div class="lista" style="padding: 0px">
					<table class="table table-striped table-hover">
						<tr>
							<th></th>
							<th>Cliente</th>
							<th>Fecha y Hora</th>
							<th>Tipo</th>
							<th>Precion Lps</th>
							<th>Laboratorista</th>
							<th>Acciones</th>
						</tr>
						<tr>
							<td><input type="checkbox" name="" style="width: 50px"></td>
							<td>Lizzul Giron</td>
							<td>10/Dic/2018 11:50</td>
							<td>P.b Metabolico </td>
							<td>750</td>
							<td>Levi Canales</td>
							<td><span class="glyphicon glyphicon-new-window forte"></span><span class="glyphicon glyphicon-briefcase forte"></span></td>

						</tr>
						<tr>
							<td><input type="checkbox" name="" style="width: 50px"></td>
							<td>Manolo Urbina</td>
							<td>10/Dic/2018 11:50</td>
							<td>Glisemia </td>
							<td>750</td>
							<td>Soliman Carcamo</td>
							<td><span class="glyphicon glyphicon-new-window forte"></span><span class="glyphicon glyphicon-briefcase forte"></span></td>

						</tr>
						<tr>
							<td><input type="checkbox" name="" style="width: 50px"></td>
							<td>Evelin Izaguirre</td>
							<td>10/Dic/2018 11:50</td>
							<td>Trigliseridos </td>
							<td>750</td>
							<td>Letti Sanchez</td>
							<td><span class="glyphicon glyphicon-new-window forte"></span><span class="glyphicon glyphicon-briefcase forte"></span></td>

						</tr>
						<tr>
							<td><input type="checkbox" name="" style="width: 50px"></td>
							<td>Bessy Velasquez</td>
							<td>10/Dic/2018 11:50</td>
							<td>T. de salud </td>
							<td>750</td>
							<td>Maria Canales</td>
							<td><span class="glyphicon glyphicon-new-window forte"></span><span class="glyphicon glyphicon-briefcase forte"></span></td>

						</tr>
						<tr>
							<td><input type="checkbox" name="" style="width: 50px"></td>
							<td>Manolo Urbina</td>
							<td>10/Dic/2018 11:50</td>
							<td>Lipido </td>
							<td>750</td>
							<td>Allan Jafet</td>
							<td><span class="glyphicon glyphicon-new-window forte"></span><span class="glyphicon glyphicon-briefcase forte"></span></td>

						</tr>
					</table>
				</div>
				<div class="lista" style="padding-bottom: 0px">
					<label>Entregados</label>
				</div>
				<!--Fin Contenido-->

					
			</div>
		</div>
	</div>
	<!--Fin Del Contenedor-->
	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/carousel.js"></script>
	<script src="js/menu.js"></script>

</body>
</html>
