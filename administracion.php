<!DOCTYPE html>
<html>
	<head>
		<title>Laboratorio Clinico Emanuel-Administración</title>
		<meta charset="utf-8" />
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="css/barra-menu.css">
		<link rel="stylesheet" href="css/styleBarra.css">
		<link rel="stylesheet" type="text/css" href="css/carousel.css">
		<link rel="stylesheet" type="text/css" href="css/pestañas.css">
		<link href="http://allfont.es/allfont.css?fonts=comic-sans-ms" rel="stylesheet" type="text/css" />
		
	</head>
	<body onload="init()">

		<!--Contenedor-->
		<div class="container-fluid">
			<div class="row">
			
			<!--Aqui Esta Contenida La Barra De Menu-->
			<div id="barraNav" class="col-lg-3 lista"></div>
      		<!--Aqui Esta Finaliza La La Barra De Menu-->
				
				<!--Contenido Del Inventario-->
				<div class="col-lg-9 well" style="border: black 1px solid;">
					<nav>
						<div class="nav nav-tabs" id="nav-tab" role="tablist">
							<ul class="nav nav-tabs" id="myTab">
								<li class="nav-item pestaña" id="nav-adm-init-li">
									<a class="nav-item nav-link active" id="nav-adm-init-tab" data-toggle="tab" href="#nav-adm-init" role="tab" aria-controls="nav-inv-main" aria-selected="true">Inicio</a>
								</li>
								<li class="nav-item pestaña" id="nav-adm-soli-li">
									<a class="nav-item nav-link" id="nav-adm-soli-tab" data-toggle="tab" href="#nav-adm-soli" role="tab" aria-controls="nav-adm-soli" aria-selected="false">Solicitudes</a>
								</li>
								<li class="nav-item pestaña" id="nav-adm-usr-li">
									<a class="nav-item nav-link" id="nav-adm-usr-tab" data-toggle="tab" href="#nav-adm-usr" role="tab" aria-controls="nav-adm-usr" aria-selected="false">Usuarios</a>
								</li>
								<li class="nav-item pestaña" id="nav-adm-reg-li">
									<a class="nav-item nav-link" id="nav-adm-reg-tab" data-toggle="tab" href="#nav-adm-reg" role="tab" aria-controls="nav-adm-reg" aria-selected="false">Registros</a>
								</li>
								<li class="nav-item pestaña" id="nav-adm-graf-li">
									<a class="nav-item nav-link" id="nav-adm-graf-tab" data-toggle="tab" href="#nav-adm-graf" role="tab" aria-controls="nav-adm-graf" aria-selected="false">Gráficos</a>
								</li>
							</ul>
						</div>
					</nav>
					<div class="tab-content" id="nav-tabContent">
						<div class="tab-pane fade show active" id="nav-adm-init" role="tabpanel" aria-labelledby="nav-adm-init-tab">
							<ul class="menu">
								<li>
									<a style="color: #5a5a5a;">Solicitudes:</a>
								</li>
								<li>
									<input class="form-control" type="text" placeholder="Buscar" style="width: 150px;margin-left: 550px">
								</li>
							</ul>
							<table class="table table-striped" >
								<thead>
									<tr>
										<th scope="col" ><b>Nombre</b></th>
										<th scope="col" ><b>Módulo que desea</b></th>
										<th scope="col" ><b>Correo</b></th>
										<th scope="col" ><b>Teléfono</b></th>
										<th scope="col" ><b>Fecha y Hora</b></th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<th scope="row" >Ramón Rosa</th>
										<td>Facturación</td>
										<td>ramon.presi@unah.hn</td>
										<td>9900-0000</td>
										<td>15/12/18 - 09:30 am</td>
									</tr>
									<tr>
										<th scope="row" >Ramón Rosa</th>
										<td>Facturación</td>
										<td>ramon.presi@unah.hn</td>
										<td>9900-0000</td>
										<td>15/12/18 - 09:31 am</td>
									</tr>
									<tr>
										<th scope="row" >Ramón Rosa</th>
										<td>Facturación</td>
										<td>ramon.presi@unah.hn</td>
										<td>9900-0000</td>
										<td>15/12/18 - 09:32 am</td>
									</tr>
									<tr>
										<th scope="row" >Ramón Rosa</th>
										<td>Facturación</td>
										<td>ramon.presi@unah.hn</td>
										<td>9900-0000</td>
										<td>15/12/18 - 09:33 am</td>
									</tr>
								</tbody>
							</table>
							<ul class="menu">
									<li>
										<a style="color: #5a5a5a;">Usuarios:</a>
									</li>
									<li>
										<input class="form-control" type="text" placeholder="Buscar" style="width: 150px;margin-left: 570px">
									</li>
								</ul>
							<table class="table table-striped" >
								<thead>
									<tr>
										<th scope="col" ><b>Nombre</b></th>
										<th scope="col" ><b>Módulo</b></th>
										<th scope="col" ><b>Última Conexión</b></th>
										<th scope="col" ><b>Acciones</b></th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<th scope="row" >Ramón Rosa</th>
										<td>Inventario</td>
										<td>15/12/18 9:35 am</td>
										<td><button class="form-control">Acciones</button></td>
									</tr>
									<tr>
										<th scope="row" >Ramón Rosa</th>
										<td>Inventario</td>
										<td>15/12/18 9:20 am</td>
										<td><button class="form-control">Acciones</button></td>
									</tr>
									<tr>
										<th scope="row" >Ramón Rosa</th>
										<td>Inventario</td>
										<td>15/12/18 8:50 am</td>
										<td><button class="form-control">Acciones</button></td>
									</tr>
									<tr>
										<th scope="row" >Ramón Rosa</th>
										<td>Inventario</td>
										<td>15/12/18 8:00 am</td>
										<td><button class="form-control">Acciones</button></td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="tab-pane fade" id="nav-adm-soli" role="tabpanel" aria-labelledby="nav-adm-soli-tab">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Harum, doloribus laudantium alias velit laborum quam magnam, voluptatibus libero illum eligendi quis voluptate earum sunt molestiae error facere minima doloremque fugiat?</div>
						<div class="tab-pane fade" id="nav-adm-usr" role="tabpanel" aria-labelledby="nav-adm-usr-tab">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt vitae nobis placeat, adipisci consequatur harum error. Ducimus veritatis eius ex fugit vitae, repellendus accusantium animi, error quia qui facere quos!</div>
						<div class="tab-pane fade" id="nav-adm-reg" role="tabpanel" aria-labelledby="nav-adm-reg-tab">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Voluptatem sequi suscipit provident dolorum autem sunt amet hic maxime excepturi, nobis aspernatur earum debitis ad dignissimos, rem alias officiis nulla! Dignissimos.</div>
						<div class="tab-pane fade" id="nav-inv-repo" role="tabpanel" aria-labelledby="nav-inv-repo-tab">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Voluptatem sequi suscipit provident dolorum autem sunt amet hic maxime excepturi, nobis aspernatur earum debitis ad dignissimos, rem alias officiis nulla! Dignissimos.</div>
						<div class="tab-pane fade" id="nav-adm-graf" role="tabpanel" aria-labelledby="nav-adm-graf-tab">
							<ul class="menu">
								<li>
									<a style="color: #5a5a5a;">Desde:</a>
								</li>
								<li>
									<input type="date" style="width: 110px;" >
									<span class="glyphicon glyphicon-calendar" style="font-size: 20px"></span>
								</li>
								<li>
									<a style="color: #5a5a5a;margin-left: 10px">Hasta:</a>
								</li>
								<li>
									<input type="date" style="width: 110px;" >
									<span class="glyphicon glyphicon-calendar" style="font-size: 20px"></span>
								</li>
							</ul>
							<select>
								<option>--</option>
								<option selected>Productos</option>
							</select>
							<input type="text" placeholder="Buscar" value="Jeringas">
							<div id="div-graf" style="width: 700px; height: 400px ">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--Fin Del Contenedor-->

	</body>
	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/carousel.js"></script>
	<script src="js/pestañas.js"></script>
	<script src="js/highcharts.js"></script>
	<script src="js/graficos.js"></script>
	<script src="js/menu.js"></script>

</html>
