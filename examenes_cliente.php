<?php
	$id_cliente=$_GET['id'];
?>

<!DOCTYPE html>
<html>
<head>
	<title>Laboratorio Clinico Emanuel - Clientes</title>
      <meta charset="utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
      <link rel="stylesheet" type="text/css" href="css/barra-menu.css">
      <link rel="stylesheet" type="text/css" href="css/carousel.css">
      <link rel="stylesheet" type="text/css" href="css/styleBarra.css">

</head>
<body>

    <!--Contenedor-->
 <div class="container-fluid">
   	<div class="row">
        <!--Aqui Esta Contenida La Barra De Menu-->
        <div id="barraNav" class="col-lg-2 col-sm-2 lista">
        </div>
        <!--Aqui Finaliza La Barra De Menu-->
              
        <!--Contenido de Cliente-->
        <div class="col-lg-10 col-sm-10 well sector-contenido" style="border: black 1px solid;background-image:url(img/catalogo.jpg);">
			<div style="background-color: rgba(255,255,255,0.9) ;border-radius: 25px">
				<!--Encabezado informacion del laboratorio-->
				<div class="row">
					<div class="col-md-2 col-lg-2">
						<img src="img/maletin.png" style="height: 40px;">
					</div>
					<div class="col-md-8 col-lg-8" style="text-align: center;">
						<p><h2>Laboratorio Clínico Emanuel</h2></p>
						<h5>La Libertad, Comayagua, Honduras, CA</h5>
						<h5>Telefonos: 2784-0292, 2784-0699</h5>
						<h5><a href="">labclinico.emanuel@gmail.com</a></h5>
					</div>	
				</div>
				<hr>
				<!--Fin del encabezado-->
				<!-- Datos del Paciente-->
				<div class="container-fluid">
					<div id="div-datos_cliente" class="container-fluid" style="text-align: center;">
						<input type="hidden" id="id_cliente" name="id_cliente" value="<?php echo $id_cliente ?>">
					</div>
					<div style="width: 40%; margin: 0 auto;">
						<table id="table-datos_cliente" align="center" style="width: 80%;">
							
						</table>
						<div align="right">
							<a type="button" title="Editar" class="btn btn-secondary" onclick="Editar_Cliente($id_cliente)" data-toggle="modal" data-target="#modal-edicion_cliente"><span class="glyphicon glyphicon-pencil"></span></a>
						</div>
					</div>
				</div>
				<!--Fin de datos del paciente-->
				<hr><br>
				<!-- Contenido examenes por Cliente-->
				<div>
					<table id="table-examenes_cliente" class="table table-striped table-hover" align="center" style="width: 850px;">
					    <tr>
					    	<td></td>
					        <th>Fecha</th>
					        <th>Examen</th>
					        <th>Encargado</th>
					        <th>Resultado</th>
					    </tr>
				    </table>
				</div>
				<!--Fin contenido examenes por cliente-->
				<!--<br>
				!--Inicio de las observaciones--
				<div class="row" style="text-align: center" style="margin-left: 20px">
					<p>
						<span>Observaciones</span>
						<button><span>Editar <span class="glyphicon glyphicon-pencil"></span></span></button>
					</p>	
				</div>
				!--Fin de las observaciones-->
				<br><br>

			</div>
		</div>
	</div>
  </div>
	<!--Fin Del Contenedor-->

	<!-- Modal Resultados de examen-->
	<div class="modal fade" tabindex="-1" role="dialog" id="modal-resultados_examen">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header" id="modal_header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h2 class="modal-title" id="modal_titulo" align="center">Examen</h2>
	      </div>
	      <div class="modal-body" id="div_body">
	        <table id="table_resultados" class="table table-striped table-hover" style="width: 90%; margin: 0 auto;">
		        <tbody id="tbody_resultados">
		        	<tr>
			            <th></th>
			            <th>Caracteristica</th>
			            <th>Resultado</th>
			            <th>Valor de Referencia</th>
	                	<th></th>
	              	</tr>
	              	<tr id="tr_resultados" class="tr_resultados">
			            <td></td>
			            <td>Caracteristica</td>
			            <td>Resultado</td>
			            <td>Valor de Referencia</td>
	                	<td></td>
	              	</tr>
	            </tbody>
            </table>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
	      </div>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div>
	<!-- Fin Modal Resultados de examen -->

	<!-- Modal Edición cliente-->
	<div class="modal fade" tabindex="-1" role="dialog" id="modal-edicion_cliente">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header" id="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <!--h2 class="modal-title" id="modal-titulo" align="center">Examen</h2-->
	      </div>
	      <div class="modal-body" id="div-body">
	        
			<form class="form-horizontal" role="form">
				<div class="form-group">
					<label for="txt-nombre" class="col-lg-1 col-md-1 control-label">Nombre</label>
					<div class="col-lg-4 col-md-4">
						<input type="text" class="form-control" id="txt-nombre" placeholder="Nombre" onKeyPress="return ValidateAlpha(event);">
					</div>
					<label for="txt-nombre" class="col-lg-2 col-md-2 control-label">Apellido</label>
					<div class="col-lg-4 col-md-4">
						<input type="text" class="form-control" id="txt-apellido" placeholder="Apellido" onKeyPress="return ValidateAlpha(event);">
					</div>
				</div>

				<div class="form-group">
					<label for="slc-genero" class="col-lg-1 col-md-1 control-label">Genero</label>
					<div class="col-lg-4 col-md-4">
						<select class="form-control" id="genero" name="genero" style="margin-left:10px">
						<option value="F">Femenino</option>
						<option value="M">Masculino</option>
						</select>
					</div>
					<label for="txt-fecha" class="col-lg-2 col-md-2 control-label">Fecha Nacimiento:</label>
					<div class="col-lg-4 col-md-4">
						<input type="date" class="form-control" id="txt-fecha">
					</div>
				</div>

				<div class="form-group">
					<label for="txt-telefono" class="col-lg-1 col-md-1 control-label">Telefono:</label>
					<div class="col-lg-4 col-md-4">
						<input type="text" class="form-control" onkeypress="return validaNumericos(event)" id="txt-telefono" placeholder="Telefono">
					</div>
					<label for="txt-correo" class="col-lg-2 col-md-2 control-label">Email</label>
					<div class="col-lg-4 col-md-4">
						<input type="mail" class="form-control" id="txt-correo" placeholder="Email">
					</div>
				</div>

				<div class="form-group">
					<label for="txt-direccion" class="col-lg-1 col-md-1 control-label">Direccion:</label>
					<div class="col-lg-10 col-md-10">
						<input type="text" class="form-control" id="txt-direccion" placeholder="Direccion" onKeyPress="return ValidateAlpha(event);">
					</div>
				</div>
			</form>	                
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
	      </div>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div>
	<!-- Fin Modal Edición cliente -->

</body>

  <script src="js/jquery-3.2.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/carousel.js"></script>
  <script src="js/menu.js"></script>
  <script src="js/Clientes.js"></script>

</html>