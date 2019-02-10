<!DOCTYPE html>
<html>
<head>
	<title>Laboratorio Clinico Emanuel-Resultados</title>
 	<meta charset="utf-8" />
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

			<div class="col-lg-9 col-md-9 well" style="border: black 1px solid;background-image:url(img/catalogo.jpg); ">
				<div style="background-color: rgba(255,255,255,0.9) ;border-radius: 25px ">
				<!--Encabezado del resultado del analisis-->
				<div class="row">
					<div class="col-lg-1 col-md-1">
						
					</div>
					<div class="col-md-2 col-lg-2">
						<img src="img/maletin.png" style="height: 40px">
					</div>
					<div class="col-md-4 col-lg-4" style="text-align: center;">
						<p>Laboratorio Clinico Emanuel</p>
						<h5>--Direccion--</h5>
						<h5>--Contiguo--<h5>
						<h5>--Telefono--</h5>
						<h5><a href="">correoelectronico@gmail.com</a></h5>
					</div>
					
				</div>
				<br>
				<!--Fin del encabezado-->

				<!--Formato de emision de los resultados-->
				<div class="row" style="margin-left: 20px">
					<table style="width: 700px; ">
						<tr>
							<th>Paciente:</th>
							<th>Evelin Paola Izaguirre</th>
						</tr>
						<tr>
							<th>Genero:</th>
							<th>Femenino</th>
						</tr>
						<tr>
							<th>Edad:</th>
							<th>22 años</th>
						</tr>
						<tr>
							<th>Fecha y hora de emision:</th>
							<th>23/01/2019 3:00 PM</th>
						</tr>
						<tr>
							<th>Medico/Encargado:</th>
							<th>Allan Jafect Martinez</th>
						</tr>
					</table>
					
				</div>
				<!--Fin del formato de la emision de los resultados-->


				<!--Contenido de los resultados-->
				<br>
				<h4 style="text-align: center">Resultados</h4>

				<div class="row" style="margin-left: 20px">
					<div class="col-md-4 col-lg-4">
						<p>
							Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras ac nisl mauris. Integer lobortis eu mi eget bibendum. Proin et magna sed turpis laoreet tempor.
						</p>
						
					</div>
					<div  class="col-md-8 col-lg-8">
						<p>
							 Aenean sit amet nibh dignissim, luctus magna vitae, aliquam ex. Nam sed erat consequat, ultricies metus eu, convallis velit. Etiam vitae felis porttitor, tempor ante in, tincidunt sem. Nulla sollicitudin leo a orci bibendum, sed pharetra quam ullamcorper. Maecenas rutrum turpis ac pharetra vulputate. Morbi id augue mi. Pellentesque quis lectus nulla.
						</p>
					</div>
					
				</div>
				<!--Fin del contenido de la emision de los resultados-->

				<!--Observaciones-->
				<br>
				<div class="row" style="text-align: center" style="margin-left: 20px">
					<p>
						<span>Observaciones</span>
						<button><span>Editar <span class="glyphicon glyphicon-pencil"></span></span></button>
						
					</p>
					
					
				</div>
				

				<!--Fin de las observaciones-->
				</div>
				<!--Fin del formato-->
				<br>
				<br>

				<div class="row" style="background-color: rgb(255,255,255) ;border-radius: 25px; text-align: center;">
					<div>
						<button class="btn btn-secondary btn-lg"><span class="glyphicon glyphicon-trash"></span></button>
						<button class="btn btn-secondary btn-lg"><span class="glyphicon glyphicon-download-alt"></span></button>	
						<button class="btn btn-secondary btn-lg"><span class="glyphicon glyphicon-envelope"></span></button>	
						<button class="btn btn-secondary btn-lg"><span class="glyphicon glyphicon-print"></span></button>							
					</div>					
				</div>
			</div>
		</div>
				
			</div>
		</div>
	</div>
	<!--Fin Del Contenedor-->
	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/carousel.js"></script>
	<script src="js/menu.js"></script>

</body>
</html>
