<!DOCTYPE html>
<html>
	<head>
		<title>Laboratorio Clinico Emanuel-Administración</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="css/barra-menu.css">
		<link rel="stylesheet" type="text/css" href="css/pestañas.css">
		<link rel="stylesheet" type="text/css" href="css/styleBarra.css">
		<link rel="stylesheet" type="text/css" href="css/administracion.css">
	</head>
	<body onload="init()">

		<!--Contenedor-->
		<div class="container-fluid">
			<div class="row">
				<!--Aqui Esta Contenida La Barra De Menu-->
				<div id="barraNav" class="col-lg-2 col-sm-2 lista">
				</div>
				<!--Aqui Esta Finaliza La La Barra De Menu-->
				
				<!--Contenido De La Administracion-->
				<div class="col-lg-10 col-sm-10 well sector-contenido" style="border: black 1px solid;">
					<nav>
						<div class="nav nav-tabs" id="nav-tab" role="tablist">
							<ul class="nav nav-tabs" id="myTab">
								<li class="nav-item pestaña" id="nav-adm-soli-li">
									<a class="nav-item nav-link" id="nav-adm-soli-tab" data-toggle="tab" href="#nav-adm-soli" role="tab" aria-controls="nav-adm-soli" aria-selected="false">Solicitudes</a>
								</li>
								<li class="nav-item pestaña" id="nav-adm-usr-li">
									<a class="nav-item nav-link" id="nav-adm-usr-tab" data-toggle="tab" href="#nav-adm-usr" role="tab" aria-controls="nav-adm-usr" aria-selected="false">Empleados</a>
								</li>
								<li class="nav-item pestaña" id="nav-adm-pro-li">
								<a class="nav-item nav-link" id="nav-adm-pro-tab" data-toggle="tab" href="#nav-adm-pro" role="tab" aria-controls="nav-adm-pro" aria-selected="false">Promociones</a>
								</li>
							</ul>
						</div>
					</nav>
					<div class="tab-content" id="nav-tabContent">
						<!--Seccion Solicitudes-->
						<div class="tab-pane fade" id="nav-adm-soli" role="tabpanel" aria-labelledby="nav-adm-soli-tab">
							<div class="row">
								<div class="col-lg-12 col-sm-3">
									<table class="table table-striped table-bordered w-100">
										<thead>
											<tr>
												<th scope="col"><b>Nombre</b></th>
												<th scope="col"><b>Descripcion</b></th>
												<th scope="col"><b>Usuario</b></th>
												<th scope="col"><b>Estado Solicitud</b></th>
												<th scope="col"><b>Fecha</b></th>
												<th scope="col"><b>Acciones</b></th>
											</tr>
										</thead>
										<tbody id="table-solicitudes">
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<!--Seccion Usuarios (Empleados)-->
						<div class="tab-pane fade" id="nav-adm-usr" role="tabpanel" aria-labelledby="nav-adm-usr-tab">
							<div class="row">
								<div class="col-lg-12 col-sm-12">
									<table class="table table-striped table-bordered w-100">
										<thead>
											<tr>
												<th scope="col"><b>Nombre</b></th>
												<th scope="col"><b>Teléfono</b></th>
												<th scope="col"><b>Fecha Contratación</b></th>
												<th scope="col"><b>Acciones</b></th>
											</tr>
										</thead>
										<tbody id="table-empleados">

										</tbody>
									</table>
									<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarEmpleado">
										<span class="glyphicon glyphicon-plus"></span>Agregar Empleado
									</button>

									<!-- Modal Agregar Empleado -->
									<div class="modal fade" id="modalAgregarEmpleado" tabindex="-1" role="dialog" aria-labelledby="modalAgregarEmpleadoLabel" aria-hidden="true">
										<div class="modal-dialog" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" id="modalAgregarEmpleadoLabel" style="text-align: center;font-weight: bold;">AGREGAR EMPLEADO</h5>
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="row modal-body">
													<!-- Formulario -->
													<div class="form-group col-12 col-sm-6 col-md-6">
														<label for="nombre">Nombre:</label>
														<input type="text" class="form-control" id="nombre" name="nombre"  placeholder="Nombre" required>
													</div>

													<div class="form-group col-12 col-sm-6 col-md-6">
														<label for="apellido">Apellido:</label>
														<input type="text" class="form-control" id="apellido" name="apellido" placeholder="Apellido" required>
													</div>

													<div class="form-group col-12 col-sm-6 col-md-6">
														<label for="edad">Edad:</label>
														<input id="edad" class="form-control" type="text" placeholder="XX" required>
													</div>

													<div class="form-group col-12 col-sm-6 col-md-6">
														<label for="numero-identidad">Número de identidad:</label>
														<input type="text" class="form-control" id="numero-identidad" name="numero-identidad" placeholder="0102199912345" required>
													</div>

													<div class="form-group col-12 col-sm-6 col-md-6">
														<label for="email">Correo Electrónico:</label>
														<input type="text" class="form-control" id="email" name="email" placeholder="correo@gmail.com">
													</div>

													<div class="form-group col-12 col-sm-6 col-md-6">
														<label for="telefono">Teléfono:</label>
														<input id="telefono" name="telefono" class="form-control" type="text" placeholder="9900-0000" >
													</div>

													<div class="form-group col-12 col-sm-6 col-md-6">
														<label for="fecha-ingreso">Fecha Ingreso:</label>
														<input type="date" id="fecha-ingreso" name="fecha-ingreso" class="form-control" placeholder="2019-03-31" style="padding-top:0" required>
													</div>

													<div class="form-group col-12 col-sm-6 col-md-6">
														<label for="direccion">Dirección:</label>
														<input type="text" class="form-control" id="direccion" name="direccion" placeholder="Dirección" required>
													</div>

													<div class="form-group col-12 col-sm-6 col-md-6">
														<label for="fecha-nacimiento">Fecha Nacimiento:</label>
														<input type="date" id="fecha-nacimiento" class="form-control" placeholder="1999-12-31" style="padding-top:0" required>
													</div>

													<div class="form-group col-12 col-sm-6 col-md-6">
														<label for="slc-genero">Género:</label>
														<select id="slc-genero" class="form-control" title="genero" data-style="btn-primary" style="margin-left: 4%;margin-top: 10px;" required>
															<option value="1">Masculino</option>
															<option value="2">Femenino</option>
															<option value="3">Indefinido</option>
														</select>
													</div>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
													<button type="button" class="btn btn-primary" id="guardar-empleado">Crear Empleado</button>
												</div>
											</div>
										</div>
									</div>

									<!-- Modal Ver Empleado -->
									<div class="modal fade" id="modalVerEmpleado" tabindex="-1" role="dialog" aria-labelledby="modalVerEmpleadoLabel" aria-hidden="true">
										<div class="modal-dialog" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" id="modalVerEmpleadoLabel" style="text-align: center;font-weight: bold;">DATOS DEL EMPLEADO</h5>
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="row modal-body">
													<!-- Formulario -->
													<div class="form-group col-12 col-sm-6 col-md-6">
														<label for="nombre">Nombre:</label>
														<input type="text" class="form-control" id="nombre" name="nombre"  placeholder="Nombre" disabled>
													</div>

													<div class="form-group col-12 col-sm-6 col-md-6">
														<label for="apellido">Apellido:</label>
														<input type="text" class="form-control" id="apellido" name="apellido" placeholder="Apellido" disabled>
													</div>

													<div class="form-group col-12 col-sm-6 col-md-6">
														<label for="edad">Edad:</label>
														<input id="edad" class="form-control" type="text" placeholder="XX" disabled>
													</div>

													<div class="form-group col-12 col-sm-6 col-md-6">
														<label for="numero-identidad">Número de identidad:</label>
														<input type="text" class="form-control" id="numero-identidad" name="numero-identidad" placeholder="0102199912345" disabled>
													</div>

													<div class="form-group col-12 col-sm-6 col-md-6">
														<label for="email">Correo Electrónico:</label>
														<input type="text" class="form-control" id="email" name="email" placeholder="correo@gmail.com" disabled>
													</div>

													<div class="form-group col-12 col-sm-6 col-md-6">
														<label for="telefono">Teléfono:</label>
														<input id="telefono" name="telefono" class="form-control" type="text" placeholder="9900-0000" disabled>
													</div>

													<div class="form-group col-12 col-sm-6 col-md-6">
														<label for="fecha-ingreso">Fecha Ingreso:</label>
														<input type="date" id="fecha-ingreso" name="fecha-ingreso" class="form-control" placeholder="2019-03-31" style="padding-top:0" disabled>
													</div>

													<div class="form-group col-12 col-sm-6 col-md-6">
														<label for="direccion">Dirección:</label>
														<input type="text" class="form-control" id="direccion" name="direccion" placeholder="Dirección" disabled>
													</div>

													<div class="form-group col-12 col-sm-6 col-md-6">
														<label for="fecha-nacimiento">Fecha Nacimiento:</label>
														<input type="date" id="fecha-nacimiento" class="form-control" placeholder="1999-12-31" style="padding-top:0" disabled>
													</div>

													<div class="form-group col-12 col-sm-6 col-md-6">
														<label for="slc-genero">Género:</label>
														<select id="slc-genero" class="form-control" title="genero" data-style="btn-primary" style="margin-left: 4%;margin-top: 10px;" disabled>
															<option value="1">Masculino</option>
															<option value="2">Femenino</option>
															<option value="3">Indefinido</option>
														</select>
													</div>

													<h3>Datos de Usuario</h3>

													<div class="form-group col-12 col-sm-6 col-md-6">
														<label for="usuario">Usuario:</label>
														<input type="text" id="usuario" class="form-control" placeholder="usuarioEjemplo" disabled>
													</div>
													
													<div class="form-group col-12 col-sm-6 col-md-6">
														<label for="fecha-registro">Fecha Registro:</label>
														<input type="date" id="fecha-registro" style="padding-top:0" class="form-control" disabled>
													</div>

												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
													<button type="button" class="btn btn-primary" id="editar-empleado">Editar Empleado</button>
													<button type="button" class="btn btn-primary hide" id="actualizar-empleado">Actualizar Empleado</button>
													<button type="button" class="btn btn-primary" id="eliminar-empleado">Eliminar Empleado</button>
												</div>
											</div>
										</div>
									</div>

								</div>
							</div>
						</div>
						<!--Seccion Promociones-->						
						<div class="tab-pane fade" id="nav-adm-pro" role="tabpanel" aria-labelledby="nav-adm-pro-tab">
							<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarPromo">
								<span class="glyphicon glyphicon-plus"></span>Crear promocion
							</button>
							<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#">
								<span class="glyphicon glyphicon-eye-open"></span>Promociones actuales
							</button>							
							<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#">
								<span class="glyphicon glyphicon-time"></span>Historial
							</button>						
							<!--=====================================================================-->
							<!-- Modal -->
							<div class="modal fade" id="modalAgregarPromo" tabindex="-1" role="dialog" aria-labelledby="modalAgregarPromocionLabel" aria-hidden="true">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="modalAgregarPromocionLabel" style="text-align: center;font-weight: bold;">NUEVA PROMOCION</h5>
										</div>
										<div class="row modal-body">
											<!-- Formulario -->
											<div class="form-group col-md-12">
												<label for="descripcion">Descripcion:</label>	
												<br>													
												<textarea id="descripcion" name="descripcion" cols="55" rows="3"></textarea>
											</div>

											<div class="form-group col-md-12">
												<label for="restricciones">Restricciones:</label>
												<br>													
												<textarea id="restricciones" name="restricciones" cols="55" rows="3"></textarea>														
											</div>												

											<div class="form-group col-12 col-sm-6 col-md-6">
												<label for="fecha-inicio">Fecha Inicio:</label>
												<input type="date" id="fecha-inicio" class="form-control" placeholder="1999-12-31" style="padding-top:0">
											</div>

											<div class="form-group col-12 col-sm-6 col-md-6">
												<label for="fecha-final">Fecha Final:</label>
												<input type="date" id="fecha-final" class="form-control" placeholder="1999-12-31" style="padding-top:0">
											</div>													
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
											<button type="button" class="btn btn-primary">Crear</button>
										</div>
									</div>
								</div>
							</div>
							<!--=====================================================================-->
						</div> <!-- fin de seccion promociones -->

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

	<script src="js/controladores/validaciones.js"></script>
	<script src="js/controladores/administracion.js"></script>
</html>