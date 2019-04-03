<!DOCTYPE html>
<html>
	<head>
		<title>Laboratorio Clinico Emanuel-Inventario</title>
		<meta charset="utf-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="css/barra-menu.css">
		<link rel="stylesheet" type="text/css" href="css/carousel.css">
		<link rel="stylesheet" type="text/css" href="css/pestañas.css">
		<link rel="stylesheet" type="text/css" href="css/styles.css">
		<link rel="stylesheet" type="text/css" href="css/styleBarra.css">
	</head>
	<body onload="init()">

		<!--Contenedor-->
		<div class="container-fluid">
			<div class="row">

				<div id="barraNav" class="col-lg-2 col-sm-1 lista"></div>

				<!--Contenido Del Inventario-->
				<div class="col-xl-10 col-lg-10 col-md-6 col-sm-6 well" style="border: black 1px solid;">
					<nav>
						<div class="nav nav-tabs" id="nav-tab" role="tablist">
							<ul class="nav nav-tabs" id="myTab">
								<li class="nav-item pestaña" id="nav-inv-main-li">
									<a class="nav-item nav-link active" id="nav-inv-main-tab" data-toggle="tab" href="#nav-inv-main" role="tab" aria-controls="nav-inv-main" aria-selected="true">Principal</a>
								</li>
								<li class="nav-item pestaña" id="nav-inv-insu-li">
									<a class="nav-item nav-link" id="nav-inv-insu-tab" data-toggle="tab" href="#nav-inv-insu" role="tab" aria-controls="nav-inv-insu" aria-selected="false">Insumos</a>
								</li>
								<li class="nav-item pestaña" id="nav-inv-prd-li">
									<a class="nav-item nav-link" id="nav-inv-prd-tab" data-toggle="tab" href="#nav-inv-prd" role="tab" aria-controls="nav-inv-prd" aria-selected="false">Productos</a>
								</li>
								<li class="nav-item pestaña" id="nav-inv-mat-li">
									<a class="nav-item nav-link" id="nav-inv-mat-tab" data-toggle="tab" href="#nav-inv-mat" role="tab" aria-controls="nav-inv-mat" aria-selected="false">Materiales</a>
								</li>
								<li class="nav-item pestaña" id="nav-inv-repo-li">
									<a class="nav-item nav-link" id="nav-inv-repo-tab" data-toggle="tab" href="#nav-inv-repo" role="tab" aria-controls="nav-inv-repo" aria-selected="false">Reportes</a>
								</li>
							</ul>
						</div>
					</nav>
					<div class="tab-content" id="nav-tabContent">
						<div class="tab-pane fade show active" id="nav-inv-main" role="tabpanel" aria-labelledby="nav-inv-main-tab">
							<ul class="menu">
								<li>
									<a style="color: #5a5a5a;">Por comprar urgente:</a>
								</li>
								<li>
									<input class="form-control" type="text" placeholder="Buscar" style="width: 150px;margin-left: 550px">
								</li>
							</ul>
							<table class="table table-striped" >
								<thead>
									<tr>
										<th scope="col" ><b>Cod</b></th>
										<th scope="col" ><b>Nombre</b></th>
										<th scope="col" ><b>Cantidad</b></th>
										<th scope="col" ><b>Cant. Comprar</b></th>
										<th scope="col" ><b>Precio Aprox</b></th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<th scope="row" >A23</th>
										<td>Acetato de Sodio Anhidro</td>
										<td>0</td>
										<td>35 Unidades</td>
										<td>L. 542.00</td>
									</tr>
									<tr>
										<th scope="row" >B2</th>
										<td>Ácido Clorhidríco</td>
										<td>1</td>
										<td>30 g</td>
										<td>L. 410.00</td>
									</tr>
									<tr>
										<th scope="row" >L9</th>
										<td>Cloro</td>
										<td>500 ml</td>
										<td>5 Lt</td>
										<td>L. 35.00</td>
									</tr>
									<tr>
										<th scope="row" >P17</th>
										<td >Guantes de Latex</td>
										<td>3 Pares</td>
										<td>2 Cajas</td>
										<td>L. 180.00</td>
									</tr>
								</tbody>
							</table>
							<ul class="menu">
								<li>
									<a style="color: #5a5a5a;">Todos los productos</a>
								</li>
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
								<li>
									<input class="form-control" type="text" placeholder="Buscar" style="width: 150px;margin-left: 100px">
								</li>
							</ul>
							<table class="table table-striped" >
								<thead>
									<tr>
										<th scope="col" ><b>Cod</b></th>
										<th scope="col" ><b>Nombre</b></th>
										<th scope="col" ><b>Cantidad</b></th>
										<th scope="col" ><b>Cant. Comprar</b></th>
										<th scope="col" ><b>Tipo</b></th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<th scope="row" >A22</th>
										<td>Amonio</td>
										<td>400 ml</td>
										<td>35 Unidades</td>
										<td>Insumo</td>
									</tr>
									<tr>
										<th scope="row" >B3</th>
										<td>Agua Destilada</td>
										<td>4 Lt</td>
										<td>1 Lt</td>
										<td>Insumo</td>
									</tr>
									<tr>
										<th scope="row" >L10</th>
										<td>Jabón</td>
										<td>4 Unidades</td>
										<td>8 Unidades</td>
										<td>Material de Limpieza</td>
									</tr>
									<tr>
										<th scope="row" >P19</th>
										<td >Jeringas</td>
										<td>75 Unidades</td>
										<td>15 Unidades</td>
										<td>Producto</td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="tab-pane fade" id="nav-inv-insu" role="tabpanel" aria-labelledby="nav-inv-insu-tab">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Harum, doloribus laudantium alias velit laborum quam magnam, voluptatibus libero illum eligendi quis voluptate earum sunt molestiae error facere minima doloremque fugiat?</div>
						<div class="tab-pane fade" id="nav-inv-prd" role="tabpanel" aria-labelledby="nav-inv-prd-tab">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt vitae nobis placeat, adipisci consequatur harum error. Ducimus veritatis eius ex fugit vitae, repellendus accusantium animi, error quia qui facere quos!</div>
						<div class="tab-pane fade" id="nav-inv-mat" role="tabpanel" aria-labelledby="nav-inv-mat-tab">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Voluptatem sequi suscipit provident dolorum autem sunt amet hic maxime excepturi, nobis aspernatur earum debitis ad dignissimos, rem alias officiis nulla! Dignissimos.</div>
						<div class="tab-pane fade" id="nav-inv-repo" role="tabpanel" aria-labelledby="nav-inv-repo-tab">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Voluptatem sequi suscipit provident dolorum autem sunt amet hic maxime excepturi, nobis aspernatur earum debitis ad dignissimos, rem alias officiis nulla! Dignissimos.</div>
					</div>
				</div>
			</div>
		</div>
		<!--Fin Del Contenedor-->

	</body>
	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/carousel.js"></script>
	<script src="js/pestañas.js"></script>
	<script src="js/menu.js"></script>
</html>
