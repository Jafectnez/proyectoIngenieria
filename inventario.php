<!DOCTYPE html>
<html>
	<head>
		<title>Laboratorio Clinico Emanuel-Inventario</title>
		<meta charset="utf-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="css/barra-menu.css">
		<link rel="stylesheet" type="text/css" href="css/pestañas.css">
		<link rel="stylesheet" type="text/css" href="css/styleBarra.css">
		<link rel="stylesheet" type="text/css" href="css/inventario.css">

		<!--Extension-->
		<link rel="stylesheet" type="text/css" href="extensiones/datatables.min.css">
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
									<a class="nav-item nav-link active" id="nav-inv-main-tab" data-toggle="tab" href="#nav-inv-main" role="tab" aria-controls="nav-inv-main" aria-selected="true">Insumos</a>
								</li>
								<li class="nav-item pestaña" id="nav-inv-add-li">
									<a class="nav-item nav-link active" id="nav-inv-add-tab" data-toggle="tab" href="#nav-inv-add" role="tab" aria-controls="nav-inv-add" aria-selected="true">Agregar Insumos</a>
								</li>
							</ul>
						</div>
					</nav>
					<div class="tab-content" id="nav-tabContent">
						<div class="tab-pane fade show active" id="nav-inv-main" role="tabpanel" aria-labelledby="nav-inv-main-tab">
							<!--Insumos en menor cantidad-->
							<table class="table table-striped table-bordered" id="table-insumos-proximos">
								<h3>Productos con menor cantidad</h3>
								<label for="txt-limite">Cantidad menor a: </label>
								<input style="width: 50px" class="form-control" type="text" id="txt-limite" value="5"> 
							</table>
							<!--Insumos sin problemas-->
							<table class="table table-striped table-bordered" id="table-insumos" style="width: 100%; text-align: center;">
								<h3>Productos</h3>
							</table>
						</div>
						<div class="tab-pane fade show active" id="nav-inv-add" role="tabpanel" aria-labelledby="nav-inv-add-tab">
							<!--Insumos en menor cantidad-->
							<label for="formulario-insumo"><h2>Agregar Insumo</h2></label>
							<div id="fomulario-insumo" class="row" style="padding: 20px;">
								<label for="nombre-insumo">Nombre del Insumo</label>
								<input type="text" id="nombre-insumo" class="form-control" placeholder="Ingrese un nombre para el insumo">

								<label for="slc-tipo-insumo">Tipo del Insumo</label>
								<select id="slc-tipo-insumo" class="form-control" style="margin-left: 10px;margin-bottom: 10px;">
									<option>--Seleccione un tipo--</option>
								</select>

								<label for="cantidad-insumo">Cantidad actual del insumo</label>
								<input type="text" id="cantidad-insumo" class="form-control" placeholder="Ingrese una cantidad">
								
								<label for="precio-costo">Precio de costo del Insumo</label>
								<input type="text" id="precio-costo" class="form-control" placeholder="Ingrese un precio en el formato 999.99">
								
								<label for="descripcion-insumo">Descripcion del Insumo</label>
								<input type="text" id="descripcion-insumo" class="form-control" placeholder="Ingrese una descripcion">
								
								<label for="slc-proveedor-insumo">Proveedor del Insumo</label>
								<select id="slc-proveedor-insumo" class="form-control" style="margin-left: 10px;margin-bottom: 10px;">
									<option>--Seleccione un proveedor--</option>
								</select>
								
								<label for="fecha-ingreso-insumo">Fecha de Ingreso del Insumo</label>
								<input type="date" id="fecha-ingreso-insumo" class="form-control" style="padding-top: 0;">
								
								<label for="fecha-vencimiento-insumo">Fecha de Vencimiento del Insumo</label>
								<input type="date" id="fecha-vencimiento-insumo" class="form-control" style="padding-top: 0;">
							</div>
							<button id="guardar-insumo" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span>Crear insumo</button>
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
	<script src="js/menu.js"></script>
	
	<!--Extensiones-->
	<script src="extensiones/datatables.min.js"></script>

	<!--Controladores-->
	<script src="js/controladores/validaciones.js"></script>
	<script src="js/controladores/popup.js"></script>
	<script src="js/controladores/inventario.js"></script>
</html>
