<?php
include("class/class-conexion.php");
 session_start();
 if($_SESSION['status']==false) { // CUALQUIER USUARIO REGISTRADO PUEDE VER ESTA PAGINA
      session_destroy();
     header("Location: login.php");
 }
?>
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
				<!--Aqui Esta Contenida La Barra De Menu-->
				<div id="barraNav" class="col-lg-2 col-sm-2 lista" style="width: 20%">
				</div>
				<!--Aqui Esta Finaliza La La Barra De Menu-->

				<!--Contenido Del Inventario-->
				<div class="col-xl-10 col-lg-10 col-md-6 col-sm-6 well" style="border: black 1px solid;width: 80%">
					<nav>
						<!--Pestañas-->
						<div class="nav nav-tabs" id="nav-tab" role="tablist">
							<ul class="nav nav-tabs" id="myTab">

								<!--Pestaña Insumos-->
								<li class="nav-item pestaña" id="nav-inv-main-li">
									<a class="nav-item nav-link active" id="nav-inv-main-tab" data-toggle="tab" href="#nav-inv-main" role="tab" aria-controls="nav-inv-main" aria-selected="true">Insumos</a>
								</li>
								<!--Pestaña Agregar Insumo-->
								<li class="nav-item pestaña" id="nav-inv-add-li">
									<a class="nav-item nav-link active" id="nav-inv-add-tab" data-toggle="tab" href="#nav-inv-add" role="tab" aria-controls="nav-inv-add" aria-selected="true">Agregar Insumos</a>
								</li>

							</ul>
						</div>
					</nav>
					<div class="tab-content" id="nav-tabContent">

						<!--Seccion Insumos-->
						<div class="tab-pane fade show active" id="nav-inv-main" role="tabpanel" aria-labelledby="nav-inv-main-tab">
							<!--Insumos en menor cantidad-->
							<div class="row">
								<div class="col-lg-12 col-sm-12">
									<table class="table table-striped table-bordered" id="table-insumos-proximos" style="width: 100%;">
										<h3>Productos con menor cantidad</h3>
										<label for="txt-limite">Cantidad menor a: </label>
										<input style="width: 50px" class="form-control" type="text" id="txt-limite" value="5"> 
									</table>
								</div>
							</div>
							<hr>

							<!--Insumos sin problemas-->
							<div class="row">
								<div class="col-lg-12 col-sm-12">
									<table class="table table-striped table-bordered" id="table-insumos" style="width: 100%;">
										<h3>Productos</h3>
									</table>
								</div>
							</div>

							<!-- Modal Ver/Actualizar Insumo -->
							<div class="modal fade" id="modalVerInsumo" tabindex="-1" role="dialog" aria-labelledby="modalVerInsumoLabel" aria-hidden="true">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h3 class="modal-title" id="modalVerInsumoLabel" style="text-align: center;font-weight: bold;">DATOS DEL INSUMO</h3>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="row modal-body">
											<!-- Formulario Actualizar-->
											<div class="hide" id="formulario-actualizar-insumo">
												<div class="row modal-body" style="padding:0;">
													<div class="row">	
														<div class="form-group col-12 col-sm-6 col-md-6">
															<label class="palido" for="nombre-insumo-actualizar">Nombre del Insumo</label>
															<input type="text" id="nombre-insumo-actualizar" class="form-control" placeholder="Ingrese un nombre para el insumo">
														</div>

														<div class="form-group col-12 col-sm-6 col-md-6">
															<label class="palido" for="slc-tipo-insumo-actualizar">Tipo del Insumo</label>
															<select id="slc-tipo-insumo-actualizar" class="form-control" data-style="btn-primary" style="margin-left: 4%;margin-top: 10px;">
																<option>--Seleccione un tipo--</option>
															</select>
														</div>
													</div>

													<div class="row">
														<div class="form-group col-12 col-sm-6 col-md-6">
															<label class="palido" for="cantidad-insumo-actualizar">Cantidad</label>
															<input type="text" id="cantidad-insumo-actualizar" class="form-control" placeholder="Ingrese una cantidad">	
														</div>

														<div class="form-group col-12 col-sm-6 col-md-6">
															<label class="palido" for="precio-costo">Precio de costo</label>
															<input type="text" id="precio-costo" class="form-control" placeholder="Ingrese un precio en el formato 999.99">
														</div>
													</div>

													<div class="row">
														<div class="form-group col-12 col-sm-6 col-md-6">	
															<label class="palido" for="descripcion-insumo-actualizar">Descripcion</label>
															<input type="text" id="descripcion-insumo-actualizar" class="form-control" placeholder="Ingrese una descripcion">
														</div>

														<div class="form-group col-12 col-sm-6 col-md-6">
															<label class="palido" for="slc-proveedor-insumo-actualizar">Proveedor</label>
															<select id="slc-proveedor-insumo-actualizar" class="form-control" data-style="btn-primary" style="margin-left: 4%;margin-top: 10px;">
																<option>--Seleccione un proveedor--</option>
															</select>
														</div>
													</div>

													<div class="row">
														<div class="form-group col-12 col-sm-6 col-md-6">
															<label class="palido" for="fecha-ingreso-insumo-actualizar">Fecha de Ingreso</label>
															<input type="date" id="fecha-ingreso-insumo-actualizar" class="form-control" style="padding-top: 0;">	
														</div>

														<div class="form-group col-12 col-sm-6 col-md-6">
															<label class="palido" for="fecha-vencimiento-insumo-actualizar">Fecha de Vencimiento</label>
															<input type="date" id="fecha-vencimiento-insumo-actualizar" class="form-control" style="padding-top: 0;">	
														</div>
													</div>
												</div>
											</div>

											<div id="datos-insumo">
												<div class="row">
													<div class="form-group col-sm-12 col-md-6">
														<h4 class="palido">Nombre del Insumo</h4>
														<span id="spn-nombre-insumo"></span>
													</div>
													<div class="form-group col-sm-12 col-md-6">
														<h4 class="palido">Tipo del Insumo</h4>
														<span id="spn-slc-tipo-insumo"></span>
													</div>												
												</div>
												<div class="row">
													<div class="form-group col-sm-12 col-md-6">
														<h4 class="palido">Cantidad</h4>
														<span id="spn-cantidad-insumo"></span>
													</div>	

													<div class="form-group col-sm-12 col-md-6">
														<h4 class="palido">Precio de costo</h4>
														<span id="spn-precio-costo"></span>
													</div>	
												</div>
												<div class="row">
													<div class="form-group col-sm-12 col-md-6">
														<h4 class="palido">Descripcion</h4>
														<span id="spn-descripcion-insumo"></span>
													</div>	

													<div class="form-group col-sm-12 col-md-6">
														<h4 class="palido">Proveedor</h4>
														<span id="spn-slc-proveedor-insumo"></span>
													</div>	
												</div>
												<div class="row">
													<div class="form-group col-sm-12 col-md-6">
														<h4 class="palido">Fecha de Ingreso</h4>
														<span id="spn-fecha-ingreso-insumo" style="padding-top: 0;"></span>
													</div>	
														
													<div class="form-group col-sm-12 col-md-6">
														<h4 class="palido">Fecha de Vencimiento</h4>
														<span id="spn-fecha-vencimiento-insumo" style="padding-top: 0;"></span>
													</div>
												</div>
											</div>

											<div class="hide" id="formulario-disminuir-insumo">
												<div class="row">
													<div class="form-group col-sm-12 col-md-6">
														<h4 class="palido">Insumo</h4>
														<span id="spn-nombre-insumo-disminuir"></span>
													</div>

													<div class="form-group col-sm-12 col-md-6">
														<h4 class="palido">Cantidad</h4>
														<span id="spn-cantidad-insumo-disminuir"></span>
													</div>
												</div>
												<div class="row">
													<div class="form-group col-sm-12 col-md-6">
														<h4 class="palido">Disminuir en</h4>
														<input type="text" class="form-control" id="cantidad-disminuir" placeholder="Cantidad a disminuir" style="width: 250px;margin-left: 0;">
													</div>

													<div class="form-group col-sm-12 col-md-6">
														<h4 class="palido">Nueva Cantidad</h4>
														<span id="spn-nueva-cantidad-insumo"></span>
													</div>
												</div>

												<div class="row">
													<button class="btn btn-primary" onclick="disminuirInsumo();">Disminuir</button>
												</div>
												
											</div>
										</div>

										<div class="modal-footer">
											<button type="button" class="btn btn-secondary hide" id="atras">Atrás</button>
											<button type="button" class="btn btn-primary" id="editar-insumo">Editar Insumo</button>
											<button type="button" class="btn btn-primary" id="disminuir-insumo">Disminuir Insumo</button>
											<button type="button" class="btn btn-success hide" id="actualizar-insumo">Actualizar Insumo</button>
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
										</div>
									</div>
								</div>
							</div>
						</div>

						<!--Formulario agregar insumo-->
						<div class="tab-pane fade show active" id="nav-inv-add" role="tabpanel" aria-labelledby="nav-inv-add-tab">
							<!--Insumos en menor cantidad-->
							<label for="formulario-agregar-insumo"><h2>Agregar Insumo</h2></label>
							<div id="fomulario-agregar-insumo" class="row" style="padding: 20px;">
								<label for="nombre-insumo">Nombre del Insumo</label>
								<input type="text" id="nombre-insumo" class="form-control" placeholder="Ingrese un nombre para el insumo">

								<label for="slc-tipo-insumo">Tipo del Insumo</label>
								<select id="slc-tipo-insumo" class="form-control" style="margin-left: 10px;margin-bottom: 10px;">
									<option>--Seleccione un tipo--</option>
								</select>

								<label for="cantidad-insumo">Cantidad del insumo</label>
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
	<script src="js/bootstrap.min.js"></script>
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
