<?php
//include("class/class-conexion.php");
// session_start();
 //if($_SESSION['status']==false) { // CUALQUIER USUARIO REGISTRADO PUEDE VER ESTA PAGINA
 //     session_destroy();
 //    header("Location: login.php");
 //}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Laboratorio Clinico Emanuel-Crear factura</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="css/styles.css">
		<link rel="stylesheet" type="text/css" href="css/styleBarra.css">
		<link rel="stylesheet" href="css/jquery-confirm.min.css">
		
	</head>
	<body>

		<!--Contenedor-->
		<div class="container-fluid">
			<div class="row">

				<!--Aqui Esta Contenida La La Barra De Menu-->
				<div id="barraNav" class="col-lg-2 col-sm-2 col-md-3 lista"></div>
				<!--Aqui Esta Finaliza La La Barra De Menu-->

				<!--=============================================================================================-->
				<!--Contenido De la factura-->

				<div class="col-lg-9 col-md-9 col-sm-9 well" style="border: black 1px solid;background-image:url(img/catalogo.jpg); ">

					<div class="col-md-8 col-lg-8 col-sm-8 well" style="background-color: rgba(255,255,255,0.9) ;">
						<!--Informacion de la factura-->
						<div style="text-align: center">
							<h5><strong>Laboratorio Clínico Emanuel</strong></h5>
							<h6><strong>SIRVIENDO A DIOS ATRAVES DE SU SALUD</strong></h6>
							<h6><strong>La libertad, Comayagua, Honduras, C.A</strong></h6>
							<h6><strong>Telefonos: 2784-0292, 2784-0699</strong></h6>
							<h6><strong>R.T.N 03131965001420</strong></h6>
							<h6><strong>C.A.I 289EFE-910C78-7C4C88-3CDEDF-FF9732-C7</strong></h6>
							<hr>
						</div>
						<div id="div-usuario">
							<h6>
								<strong>Codigo factura:  </strong>
								<input type="text" name="" id="txt-codigo-factura" readonly="readonly" style="width: 150px">
							</h6>
							<h6>
								<strong>Cliente: </strong>
								<input type="text" id="txt-nombre-cliente" name="" onKeyPress="return ValidateAlpha(event);">

								<input type="text" name="" id="txt-id-cliente" style="display:none">

							</h6>
						</div>

						<!--Div que detalla la informacionn de los servicios-->
						<div>

							
							<!--Categoria 1-->
							<div class="row" id="tbl-servicios" style="font-size: 11px">
								
							</div>
							

						<!--Fin del listado de los servicios-->
						</div>




					<!--Descuentos-->
					<div class="row">
						<h6>
							<strong>
								<label class="checkbox-inline" style="margin-left: -5px;"><strong>Descuento tercera edad.</strong><input type="checkbox" id="chk-descuento"></label>
							</strong>
						</h6>
						<hr>
								
					</div>
					<!--#######################################################################-->

					<!--Promociones-->
					<div class="row">
						<div class="col-md-6 col-lg-6" >
							<table class=" table table-hover">
								<thead>
									<tr>
										<td colspan="3">
											<span tyle="font-size:12px;">Promociones</span>
										</td>
									</tr>
									<tbody id="div-promociones" >
										
									</tbody>
								</thead>
							</table>
						</div>
						<div class="col-md-6 col-lg-6">
							<h6>
								
							</h6>
							<p style="font-size: 11px">
								
								
								
							</p>
						</div>
				<table class="table table-hover" >
					<tr>
						<th colspan="3"> <strong>Tipo de pago:</strong> </th>
					</tr>
					<tr>
					    <td>
						  <input type="radio" name="formaPago" style="margin-left:-160px"><span style="margin-left: -150px">Efectivo</span>
				         </td>
				         <td>
				         	<input type="radio" name="formaPago" style="margin-left: -160px"><span style="margin-left: -150px">Tarjeta</span>
				         </td>
				         <td>
				         	<input type="radio" name="formaPago" style="margin-left: -160px"><span style="margin-left: -150px">
							    Otros</span>
				         </td>
					</tr>
				</table>
						
					</div>


							<!--Calculo del total de la factura-->
							<div class="row">
								<div class="col-md-4 col-lg-4">
									
								</div>

								<div class="col-md-8 col-lg-8">
		
						<table >
							<tr>
								<td>
									<h6>Total neto:</h6>
								</td>
								<td>
									<input type="number" name="" id="txt-total-neto" readonly="readonly" style="width: 130px;margin-left: 30px;height: 20px;">		
								</td>
							</tr>
							<tr>
								<td>
									<h6>Descuento:</h6>
								</td>
								<td>
									<input type="number" name="" id="txt-descuento" readonly="readonly" style="width: 130px;margin-left: 30px; height: 20px;">
								</td>
							</tr>
								<tr>
									<td>
										<h6>Total:</h6>
									</td>
									<td>
										<input type="number" name="" id="txt-total" readonly="readonly" style="width: 130px;margin-left: 30px; height: 20px;">
									</td>
								</tr>
								
						</table>
									
								</div>
								
							</div>							

						

						<div class="row">
							<div class="col-lg-4 col-md-4 col-sm-4"></div>
							<div class="col-lg-4 col-md-4 col-sm-4"></div>
							<div class="col-lg-4 col-md-4 col-sm-4">
								<button class="btn btn-primary btn-md" id="btn-registrar" onclick="registrarFactura();" style="content-aling: center;margin-left: -10px">
									<span><i class="glyphicon glyphicon-plus-sign"></i> Registrar factura</span>
								</button>
							</div>
						</div>
						<!--Fin del Div-->
					</div>

					<!--Inicio del Menu de servicios-->
					<div  class="col-lg-4 col-md-4 col-sm-4" id="div-listado">
							
					</div>
					<!--==============================================================================================-->
					<input type="text" name="" id="txt-usuario-genero" style="display:none;">
					<input type="text" name="" id="txt-usuario-nombre" style="display:none;">
					<input type="text" name="" id="txt-usuario-telefono" style="display:none;">
					<input type="mail" name="" id="txt-usuario-correo" style="display:none;">
					<input type="date" name="" id="txt-usuario-fecha" style="display:none;">
					<input type="direccion" name="" id="txt-usuario-direccion" style="display:none;">
				</div>	

			</div>
		</div>
		<!--Fin Del Contenedor-->

	</body>

	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/menu_desplegable.js"></script>
	<script src="js/menu.js"></script>
	<script src="js/controladores/crearFactura.js"></script>
	<script src="js/jquery-confirm.min.js"></script>


</html> 