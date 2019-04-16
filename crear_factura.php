<!DOCTYPE html>
<html>
	<head>
		<title>Laboratorio Clinico Emanuel-Crear factura</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="css/styles.css">
		<link rel="stylesheet" type="text/css" href="css/styleBarra.css">
	</head>
	<body>

		<!--Contenedor-->
		<div class="container-fluid">
			<div class="row">

				<!--Aqui Esta Contenida La La Barra De Menu-->
				<div id="barraNav" class="col-lg-2 col-sm-2 col-md-2 lista"></div>
				<!--Aqui Esta Finaliza La La Barra De Menu-->

				<!--=============================================================================================-->
				<!--Contenido De la factura-->

				<div id="sector-contenido" class="col-lg-10 col-md-10 col-sm-10 well" style="border: black 1px solid;background-image:url(img/catalogo.jpg); ">

					<div class="col-md-8 col-lg-8 col-sm-8 well" style="background-color: rgba(255,255,255,0.9) ;">
						<!--Informacion de la factura-->
						<p><h5><strong>Codigo factura: 000 </strong></h5></p>
						<hr>
						<p>
							Cliente:
							<input type="text" name="">
						</p>

						<!--Div que detalla la informacionn de los servicios-->
						<div>

							<!--Servicios por categoria-->
							<!--Categoria 1-->
							<div class="row">
								<div class="col-md-4 col-lg-4 col-sm-4">
									<strong>Perfil básico Metabólico</strong>
								</div>
								<div class="col-md-8 col-lg-8 col-sm-4">
									<table class="table table-striped">
										<tr>
											<th>Tarjeta de salud</th>
											<th>60 Lps.</th>
											<th><span class="glyphicon glyphicon-remove-sign"></span></th>
										</tr>
									</table>
								</div>
							</div>
							<!--Categoria 2-->
							<div class="row">
								<div class="col-md-4 col-lg-4 col-sm-4">
									<strong>Perfil Hepátitico</strong>
								</div>
								<div class="col-md-8 col-lg-8 col-sm-8">
									<table class="table table-striped">
											<tr>
												<th>Bilirrubina</th>
												<th>120 Lps.</th>
												<th><span class="glyphicon glyphicon-remove-sign"></span></th>
											</tr>
											<tr>
												<th>AST</th>
												<th>115 Lps.</th>
												<th><span class="glyphicon glyphicon-remove-sign"></span></th>
											</tr>
											<tr>
												<th>LDH</th>
												<th>90 Lps.</th>
												<th><span class="glyphicon glyphicon-remove-sign"></span></th>
											</tr>
									</table>
								</div>
							</div>

						<!--Fin del listado de los servicios-->
						</div>

						<div class="row">
							<div class="col-lg-4 col-md-4 col-sm-4"></div>
							<div class="col-lg-4 col-md-4 col-sm-4"></div>
							<div class="col-lg-4 col-md-4 col-sm-4">
								<button class="btn btn-primary btn-md" style="content-aling: center;">
									<span><i class="glyphicon glyphicon-plus-sign"></i>Agregar</span>
								</button>
							</div>
						</div>
						<!--Fin del Div-->
					</div>

					<!--Inicio del Menu de servicios-->
					<div class="col-lg-4 col-md-4 col-sm-4" id="wrapper">
						<h4><strong>Servicios</strong></h4>
						<ul class="menu">
							<li class="item1" style="margin-bottom:-20px"><a href="#">Perfil Básico Metabólico</a>
								<ul>
									<li class="subitem1"><a href="#">Opcion 1 </a></li>
									<li class="subitem2"><a href="#">Opcion 2 </a></li>
									<li class="subitem3"><a href="#">Opcion 3 </a></li>
								</ul>
							</li>
							<br>

							<li class="item2"><a href="#">Perfil Hepatitico</a>
								<ul>
									<li class="subitem1"><a href="#">Opcion 1 </a></li>
										<li class="subitem2"><a href="#">Opcion 2 </a></li>
									<li class="subitem3"><a href="#">Opcion 3 </a></li>
								</ul>
							</li>

							<li class="item3"><a href="#">Perfil Lipido </a>
								<ul>
									<li class="subitem1"><a href="#">Opcion 1 </a></li>
										<li class="subitem2"><a href="#">Opcion 2 </a></li>
									<li class="subitem3"><a href="#">Opcion 3 </a></li>
								</ul>
							</li>

							<li class="item3"><a href="#">Perfil Renal </a>
								<ul>
									<li class="subitem1"><a href="#">Opcion 1 </a></li>
										<li class="subitem2"><a href="#">Opcion 2 </a></li>
									<li class="subitem3"><a href="#">Opcion 3 </a></li>
								</ul>
							</li>

							<li class="item3"><a href="#">Perfil Tiroide </a>
								<ul>
									<li class="subitem1"><a href="#">Opcion 1 </a></li>
										<li class="subitem2"><a href="#">Opcion 2 </a></li>
									<li class="subitem3"><a href="#">Opcion 3 </a></li>
								</ul>
							</li>
						</ul>
					</div>
					<!--==============================================================================================-->
				</div>	
			</div>
		</div>
		<!--Fin Del Contenedor-->

	</body>

	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/menu_desplegable.js"></script>
	<script src="js/menu.js"></script>
	<script src="js/crearFactura.js"></script>
</html> 