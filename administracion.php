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
				
				<!--Contenido De La Administracion-->
				<div class="col-lg-10 col-sm-10 well sector-contenido" style="border: black 1px solid; width: 80%">
					<nav>
						<!--Pestañas-->
						<div class="nav nav-tabs" id="nav-tab" role="tablist">
							<ul class="nav nav-tabs" id="myTab">

								<!--Pestaña Solicitudes-->
								<li class="nav-item pestaña" id="nav-adm-soli-li">
									<a class="nav-item nav-link" id="nav-adm-soli-tab" data-toggle="tab" href="#nav-adm-soli" role="tab" aria-controls="nav-adm-soli" aria-selected="false">Solicitudes</a>
								</li>
								<!--Pestaña Empleados-->
								<li class="nav-item pestaña" id="nav-adm-usr-li">
									<a class="nav-item nav-link" id="nav-adm-usr-tab" data-toggle="tab" href="#nav-adm-usr" role="tab" aria-controls="nav-adm-usr" aria-selected="false">Empleados</a>
								</li>
								<!--Pestaña Promociones-->
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
								<div class="col-lg-12 col-sm-12">
									<table class="table table-striped table-bordered" id="table-solicitudes" style="width: 100%">
									</table>
								</div>
							</div>

							<!-- Modal Ver Solicitud -->
							<div class="modal fade" id="modalVerSolicitud" tabindex="-1" role="dialog" aria-labelledby="modalVerSolicitudLabel" aria-hidden="true">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h3 class="modal-title" id="modalVerSolicitudLabel" style="text-align: center;font-weight: bold;">SOLICITUD</h3>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="row modal-body" style="padding-bottom: 0;">
											<!-- Formulario -->
											<div class="form-group col-12 col-sm-6 col-md-6">
												<h4 class="palido">Nombre del Solicitante:</h4>
												<span id="solicitante" name="solicitante"></span>
											</div>

											<div class="form-group col-12 col-sm-6 col-md-6">
												<h4 class="palido">Descripcion:</h4>
												<span id="descripcion-solicitud" name="descripcion-solicitud" ></span>
											</div>

											<div class="form-group col-12 col-sm-6 col-md-6">
												<h4 class="palido">Usuario Solicitante:</h4>
												<span type="text" id="usuario-solicitante" name="usuario-solicitante"></span>
											</div>

											<div class="form-group col-12 col-sm-6 col-md-6">
												<h4 class="palido">Correo Electrónico:</h4>
												<span type="text" id="email-solicitante" name="email-solicitante"></span>
											</div>

											<div class="form-group col-12 col-sm-6 col-md-6">
												<h4 class="palido">Estado de la Solicitud:</h4>
												<span id="estado-solicitud" name="estado-solicitud" style="font-weight: bold"></span>
											</div>

											<div class="form-group col-12 col-sm-6 col-md-6">
												<h4 class="palido">Fecha:</h4>
												<span type="date" id="fecha-solicitud" name="fecha-solicitud"></span>
											</div>
										</div>

										<div class="modal-footer">
											<button type="button" class="btn btn-success" id="aceptar-solicitud">Aceptar Solicitud</button>
											<button type="button" class="btn btn-danger" id="denegar-solicitud">Denegar Solicitud</button>
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
										</div>
									</div>
								</div>
							</div>
						</div>

						<!--Seccion Usuarios (Empleados)-->
						<div class="tab-pane fade" id="nav-adm-usr" role="tabpanel" aria-labelledby="nav-adm-usr-tab">
							<div class="row">
								<div class="col-lg-12 col-sm-12">
									<table class="table table-striped table-bordered w-100" id="table-empleados" style="width:100%;">
									</table>
								</div>
							</div>

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
										<!-- Formulario -->
										<div class="row modal-body">
											<div class="form-group col-12 col-sm-6 col-md-6">
												<label for="nombre-fAgregar">Nombre:</label>
												<input type="text" class="form-control" id="nombre-fAgregar" name="nombre-fAgregar"  placeholder="Nombre" required>
											</div>

											<div class="form-group col-12 col-sm-6 col-md-6">
												<label for="apellido-fAgregar">Apellido:</label>
												<input type="text" class="form-control" id="apellido-fAgregar" name="apellido-fAgregar" placeholder="Apellido" required>
											</div>

											<div class="form-group col-12 col-sm-6 col-md-6">
												<label for="edad-fAgregar">Edad:</label>
												<input id="edad-fAgregar" class="form-control" type="text" placeholder="XX" required>
											</div>

											<div class="form-group col-12 col-sm-6 col-md-6">
												<label for="numero-identidad-fAgregar">Número de identidad:</label>
												<input type="text" class="form-control" id="numero-identidad-fAgregar" name="numero-identidad-fAgregar" placeholder="0102199912345" required>
											</div>

											<div class="form-group col-12 col-sm-6 col-md-6">
												<label for="email-fAgregar">Correo Electrónico:</label>
												<input type="text" class="form-control" id="email-fAgregar" name="email-fAgregar" placeholder="correo@gmail.com">
											</div>

											<div class="form-group col-12 col-sm-6 col-md-6">
												<label for="telefono-fAgregar">Teléfono:</label>
												<input id="telefono-fAgregar" name="telefono-fAgregar" class="form-control" type="text" placeholder="9900-0000" >
											</div>

											<div class="form-group col-12 col-sm-6 col-md-6">
												<label for="fecha-ingreso-fAgregar">Fecha Ingreso:</label>
												<input type="date" id="fecha-ingreso-fAgregar" name="fecha-ingreso-fAgregar" class="form-control" placeholder="2019-03-31" style="padding-top:0" required>
											</div>

											<div class="form-group col-12 col-sm-6 col-md-6">
												<label for="direccion-fAgregar">Dirección:</label>
												<input type="text" class="form-control" id="direccion-fAgregar" name="direccion-fAgregar" placeholder="Dirección" required>
											</div>

											<div class="form-group col-12 col-sm-6 col-md-6">
												<label for="fecha-nacimiento-fAgregar">Fecha Nacimiento:</label>
												<input type="date" id="fecha-nacimiento-fAgregar" name="fecha-nacimiento-fAgregar" class="form-control" placeholder="1999-12-31" style="padding-top:0" required>
											</div>

											<div class="form-group col-12 col-sm-6 col-md-6">
												<label for="slc-genero-fAgregar">Género:</label>
												<select id="slc-genero-fAgregar" name="slc-genero-fAgregar" class="form-control" title="genero" data-style="btn-primary" style="margin-left: 4%;margin-top: 10px;" required>
													<option value="1">Masculino</option>
													<option value="2">Femenino</option>
													<option value="3">Indefinido</option>
												</select>
											</div>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-primary" id="guardar-empleado">Crear Empleado</button>
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
										</div>
									</div>
								</div>
							</div>

							<!-- Modal Ver/Actualizar Empleado -->
							<div class="modal fade" id="modalVerEmpleado" tabindex="-1" role="dialog" aria-labelledby="modalVerEmpleadoLabel" aria-hidden="true">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h3 class="modal-title" id="modalVerEmpleadoLabel" style="text-align: center;font-weight: bold;">DATOS DEL EMPLEADO</h3>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="row modal-body">
											<!-- Formulario -->
											<div class="hide" id="formulario-actualizar-empleado">
												<div class="row modal-body" style="padding: 0;">
													<div class="form-group col-12 col-sm-6 col-md-6">
														<label class="palido" for="nombre-actualizar">Nombre:</label>
														<input type="text" class="form-control" id="nombre-actualizar" name="nombre-actualizar"  placeholder="Nombre">
													</div>

													<div class="form-group col-12 col-sm-6 col-md-6">
														<label class="palido" for="apellido-actualizar">Apellido:</label>
														<input type="text" class="form-control" id="apellido-actualizar" name="apellido-actualizar" placeholder="Apellido">
													</div>

													<div class="form-group col-12 col-sm-6 col-md-6">
														<label class="palido" for="edad-actualizar">Edad:</label>
														<input id="edad-actualizar" name="edad-actualizar" class="form-control" type="text" placeholder="XX">
													</div>

													<div class="form-group col-12 col-sm-6 col-md-6">
														<label class="palido" for="numero-identidad-actualizar">Número de identidad:</label>
														<input type="text" class="form-control" id="numero-identidad-actualizar" name="numero-identidad-actualizar" placeholder="0102199912345">
													</div>

													<div class="form-group col-12 col-sm-6 col-md-6">
														<label class="palido" for="email-actualizar">Correo Electrónico:</label>
														<input type="text" class="form-control" id="email-actualizar" name="email-actualizar" placeholder="correo@gmail.com">
													</div>

													<div class="form-group col-12 col-sm-6 col-md-6">
														<label class="palido" for="telefono-actualizar">Teléfono:</label>
														<input id="telefono-actualizar" name="telefono-actualizar" class="form-control" type="text" placeholder="9900-0000">
													</div>

													<div class="form-group col-12 col-sm-6 col-md-6">
														<label class="palido" for="fecha-ingreso-actualizar">Fecha Ingreso:</label>
														<input type="date" id="fecha-ingreso-actualizar" name="fecha-ingreso-actualizar" class="form-control" placeholder="2019-03-31" style="padding-top:0">
													</div>

													<div class="form-group col-12 col-sm-6 col-md-6">
														<label class="palido" for="direccion-actualizar">Dirección:</label>
														<input type="text" class="form-control" id="direccion-actualizar" name="direccion-actualizar" placeholder="Dirección">
													</div>

													<div class="form-group col-12 col-sm-6 col-md-6">
														<label class="palido" for="fecha-nacimiento-actualizar">Fecha Nacimiento:</label>
														<input type="date" id="fecha-nacimiento-actualizar" name="fecha-nacimiento-actualizar" class="form-control" placeholder="1999-12-31" style="padding-top:0">
													</div>

													<div class="form-group col-12 col-sm-6 col-md-6">
														<label class="palido" for="slc-genero-actualizar">Género:</label>
														<select id="slc-genero-actualizar" name="slc-genero-actualizar" class="form-control" title="genero" data-style="btn-primary" style="margin-left: 4%;margin-top: 10px;">
															<option value="1">Masculino</option>
															<option value="2">Femenino</option>
															<option value="3">Indefinido</option>
														</select>
													</div>
												</div>
											</div>

											<div id="datos-empleado">
												<div class="form-group col-12 col-sm-6 col-md-6">
													<h4 class="palido">Nombre:</h4>
													<span id="spn-nombre" name="spn-nombre"></span>
												</div>

												<div class="form-group col-12 col-sm-6 col-md-6">
													<h4 class="palido">Apellido:</h4>
													<span id="spn-apellido" name="spn-apellido"></span>
												</div>

												<div class="form-group col-12 col-sm-6 col-md-6">
													<h4 class="palido">Edad:</h4>
													<span id="spn-edad" name="spn-edad"></span>
												</div>

												<div class="form-group col-12 col-sm-6 col-md-6">
													<h4 class="palido">Número de identidad:</h4>
													<span id="spn-numero-identidad" name="spn-numero-identidad"></span>
												</div>

												<div class="form-group col-12 col-sm-6 col-md-6">
													<h4 class="palido">Correo Electrónico:</h4>
													<span type="text" id="spn-email" name="spn-email"></span>
												</div>

												<div class="form-group col-12 col-sm-6 col-md-6">
													<h4 class="palido">Teléfono:</h4>
													<span id="spn-telefono" name="spn-telefono"></span>
												</div>

												<div class="form-group col-12 col-sm-6 col-md-6">
													<h4 class="palido">Fecha Ingreso:</h4>
													<span id="spn-fecha-ingreso" name="spn-fecha-ingreso"></span>
												</div>

												<div class="form-group col-12 col-sm-6 col-md-6">
													<h4 class="palido">Dirección:</h4>
													<span id="spn-direccion" name="spn-direccion"></span>
												</div>

												<div class="form-group col-12 col-sm-6 col-md-6">
													<h4 class="palido">Fecha Nacimiento:</h4>
													<span id="spn-fecha-nacimiento" name="spn-fecha-nacimiento"></span>
												</div>

												<div class="form-group col-12 col-sm-6 col-md-6">
													<h4 class="palido">Género:</h4>
													<span id="spn-genero" name="spn-genero"></span>
												</div>
												
												<div class="row modal-body" style="padding-top: 0;">
													<h3 style="text-align: center; margin-top: 2%;">Datos de Usuario</h3>
													<hr>

													<div class="form-group col-12 col-sm-6 col-md-6">
														<h4 class="palido">Usuario:</h4>
														<span id="spn-usuario" name="spn-usuario"></span>
													</div>
													
													<div class="form-group col-12 col-sm-6 col-md-6">
														<h4 class="palido">Fecha Registro:</h4>
														<span id="spn-fecha-registro" name="spn-fecha-registro"></span>
													</div>
												</div>
											</div>
										</div>

										<div class="modal-footer">
											<button type="button" class="btn btn-secondary hide" id="atras">Atrás</button>
											<button type="button" class="btn btn-primary" id="editar-empleado">Editar Empleado</button>
											<button type="button" class="btn btn-success hide" id="actualizar-empleado">Actualizar Empleado</button>
											<button type="button" class="btn btn-danger" id="eliminar-empleado">Eliminar Empleado</button>
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
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
												<label for="descripcion">Tipo de examen:</label>	
												<br>													
												<select id="selectTipo"></select> 
											</div>
											<div class="form-group col-md-12"> 
												<label for="descripcion">Descripcion: <label style="color:red;">*</label></label>	
												<br>													
												<textarea id="descripcion" name="descripcion" cols="55" rows="3"></textarea>
											</div>

											<div class="form-group col-md-12">
												<label for="restricciones">Restricciones:</label>
												<br>													
												<textarea id="restricciones" name="restricciones" cols="55" rows="3"></textarea>														
											</div>												

											<div class="form-group col-12 col-sm-6 col-md-6">
												<label for="fecha-inicio">Fecha Inicio: <label style="color:red;">*</label></label>
												<input type="date" id="fecha-inicio" class="form-control" placeholder="1999-12-31" style="padding-top:0">
											</div>

											<div class="form-group col-12 col-sm-6 col-md-6">
												<label for="fecha-final">Fecha Final: <label style="color:red;">*</label></label>
												<input type="date" id="fecha-final" class="form-control" placeholder="1999-12-31" style="padding-top:0">
											</div>	

											<div class="form-group col-12 col-sm-12 centroMsj">
												<p id="msj"></p>
												<p id="msj2"></p>												
											</div>												
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
											<button id="crearPromo" type="button" class="btn btn-primary">Crear</button>
										</div>
									</div>
								</div>
							</div>
							<!--=====================================================================-->
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

	<script src="js/controladores/popUp.js"></script>
	<script src="js/controladores/validaciones.js"></script>
	<script src="js/controladores/admin-promos.js"></script>	
	<script src="js/controladores/administracion.js"></script>


</html>