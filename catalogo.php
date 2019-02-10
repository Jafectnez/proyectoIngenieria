<!DOCTYPE html>
<html>
<head>
	<title>Laboratorio Clinico Emanuel-Catálogo</title>
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
					<li><b> <a href="#">Catalogo De Servicios</a></b></li>
					<li><b> <a href="resultados.php">Emision De Resultados</a></li>
					<li><b> <a href="cliente.php">Cliente</a></b></li>
					<li><b> <a href="administracion.php">Administración</a></b></li>
			</ul>
			<!--Final De La Lista Anidada-->

			</div>
>>>>>>> upstream/menu2
			<!--Aqui Esta Finaliza La La Barra De Menu-->
			
			<!--Contenido Del Catalogo-->

			<div class="col-lg-9 well" style="border: black 1px solid;">
				<!--Barra De Menu-->
				<ul class="menu">
					<li><img src="img/maletin.png" style="height: 40px"></li>
					<li><input type="text" placeholder="Busqueda"></li>
					<li><a href=""><span class="glyphicon glyphicon-th"></span> Modo Simplificado</a></li>
					<li><a href="">Promos</a></li>
					<li><a href="">Contactos</a></li>
				</ul>
				<!--Fin De Barra De Menu-->

				<div class="portada">
					<div class="text">
						<h1 style="color: rgb(0,0,0);">Laboratorio Clinico Emanuel</h1>
						<!--Carrusel-->
							    <div id="myCarousel" class="carousel slide" data-ride="carousel">
							      <!-- Indicators -->
							      <ol class="carousel-indicators">
							        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
							        <li data-target="#myCarousel" data-slide-to="1"></li>
							        <li data-target="#myCarousel" data-slide-to="2"></li>
							      </ol>
							      <div class="carousel-inner" role="listbox">
							        <div class="item active">
							          <img class="first-slide" src="img/promo1.jpg" alt="First slide">
							          <div class="container">
							            <div class="carousel-caption">
							            
							            </div>
							          </div>
							        </div>
							        <div class="item">
							          <img class="second-slide" src="img/promo2.jpg" alt="Second slide">
							          <div class="container">
							            <div class="carousel-caption">
							            </div>
							          </div>
							        </div>
							        <div class="item">
							          <img class="third-slide" src="img/promo3.jpg" alt="Third slide">
							          <div class="container">
							            <div class="carousel-caption">
							            </div>
							          </div>
							        </div>
							      </div>
							      <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
							        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
							        <span class="sr-only">Previous</span>
							      </a>
							      <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
							        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
							        <span class="sr-only">Next</span>
							      </a>
							    </div>
						<!--Fin Carrusel-->	

					</div>
					<div>
						<!--Barra De Menu-->
					<ul class="menu">
						<li ><input type="text" placeholder="Perfil" style="width: 200px"></li>
						<li ><a href="">Ordenar Por: <select>
								<option>Mas Hechos</option>
								<option>2</option>
								<option>3</option>
								<option>4</option>
							</select>
						<li><a>
						<li><a href="">Añadir Filtro <span class="glyphicon glyphicon-plus-sign"></span></a></li>
						<li><a href=""><span class="glyphicon glyphicon-align-justify"></span></a></li>
						<li><a href=""><span class="glyphicon glyphicon-th-large"></span></a></li>
					</ul>
					<!--Fin De Barra De Menu-->
					</div>
					<!--Barra De Menu
					<ul class="menu">
						
						<li ><a href="">Perfil Basico Metabolico <li>
						<li><a href=""> Ver Mas aqui</a></li>
						<li><a href="">Todo a Lps. 425.00</a></li>
					
					</ul>
					Fin De Barra De Menu-->

					
				</div>
				<table  style="width: 700px; ">
						<tr>
							<th style="width: 400px ">Perfil Basico Metabolico </th>
							<th>Ver Mas <a href="">aqui</a></th>
							<th>Todo a Lps. 425.00</th>
						</tr>
						<tr>
							<th style="width: 400px ">Perfil Lipidico </th>
							<th>Ver Mas <a href="">aqui</a></th>
							<th>Todo a Lps. 525.00</th>
						</tr>
						<tr>
							<th style="width: 400px ">Perfil Epatico </th>
							<th>Ver Mas <a href="">aqui</a></th>
							<th>Todo a Lps. 600.00</th>
						</tr>
					</table>
			</div>
		</div>
	</div>
	<!--Fin Del Contenedor-->
	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/carousel.js"></script>
	<script src="js/menu.js"></script>

</body>
</html>
