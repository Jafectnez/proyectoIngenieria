<?php
//include("class/class-conexion.php");
 //session_start();
 //if($_SESSION['status']==false) { // CUALQUIER USUARIO REGISTRADO PUEDE VER ESTA PAGINA
 //     session_destroy();
  //   header("Location: login.php");
 //}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Laboratorio Clinico Emanuel-Emisión de Resultados</title>
		<meta charset="utf-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="css/barra-menu.css">
		<link rel="stylesheet" type="text/css" href="css/styles.css">
		<link rel="stylesheet" type="text/css" href="css/styleBarra.css">
		<link rel="stylesheet" type="text/css" href="css/materialize.min.css">
	</head>
	<body>

		<!--Contenedor-->
		<div class="container-fluid">
			<div class="row">

				<!--Aqui Esta Contenida La La Barra De Menu-->
				<div id="barraNav" class="col-lg-2 col-sm-2 lista" style="width: 20%"></div>
				<!--Aqui Esta Finaliza La La Barra De Menu-->
				<!--Contenido Del Catalogo-->

				<div class="col-lg-10 col-sm-10 well" style="border: black 1px solid;width: 80%">
					<!--Barra De busqueda-->

						<input type="text" placeholder="Perfil">
						
					<!--Fin De Barra De busqueda-->

					<!--Contenido-->

					<!-- <div class="lista" style="padding-bottom: 0px">
						<label>Todos</label>				
					</div>

					<div class="lista" style="padding-bottom: 0px">
						<label>Resultados No Entregados</label>	
					</div>

					<div class="lista" style="padding: 0px">
						<table class="table table-striped table-hover">
							<tr>
								<th></th>
								<th>Cliente</th>
								<th>Fecha y Hora</th>
								<th>Tipo</th>
								<th>Precion Lps</th>
								<th>Laboratorista</th>
								<th>Acciones</th>
							</tr>
							<tr>
								<td><input type="checkbox" name="" style="width: 50px"></td>
								<td>Lizzul Giron</td>
								<td>10/Dic/2018 11:50</td>
								<td>P.b Metabolico </td>
								<td>750</td>
								<td>Levi Canales</td>
								<td><span class="glyphicon glyphicon-new-window forte"></span><span class="glyphicon glyphicon-briefcase forte"></span></td>

							</tr>
							<tr>
								<td><input type="checkbox" name="" style="width: 50px"></td>
								<td>Manolo Urbina</td>
								<td>10/Dic/2018 11:50</td>
								<td>Glisemia </td>
								<td>750</td>
								<td>Soliman Carcamo</td>
								<td><span class="glyphicon glyphicon-new-window forte"></span><span class="glyphicon glyphicon-briefcase forte"></span></td>

							</tr>
							<tr>
								<td><input type="checkbox" name="" style="width: 50px"></td>
								<td>Evelin Izaguirre</td>
								<td>10/Dic/2018 11:50</td>
								<td>Trigliseridos </td>
								<td>750</td>
								<td>Letti Sanchez</td>
								<td><span class="glyphicon glyphicon-new-window forte"></span><span class="glyphicon glyphicon-briefcase forte"></span></td>

							</tr>
							<tr>
								<td><input type="checkbox" name="" style="width: 50px"></td>
								<td>Bessy Velasquez</td>
								<td>10/Dic/2018 11:50</td>
								<td>T. de salud </td>
								<td>750</td>
								<td>Maria Canales</td>
								<td><span class="glyphicon glyphicon-new-window forte"></span><span class="glyphicon glyphicon-briefcase forte"></span></td>

							</tr>
							<tr>
								<td><input type="checkbox" name="" style="width: 50px"></td>
								<td>Manolo Urbina</td>
								<td>10/Dic/2018 11:50</td>
								<td>Lipido </td>
								<td>750</td>
								<td>Allan Jafet</td>
								<td><span class="glyphicon glyphicon-new-window forte"></span><span class="glyphicon glyphicon-briefcase forte"></span></td>

							</tr>
						</table>
					</div>

					<div class="lista" style="padding-bottom: 0px">
						<label>Entregados</label>
					</div>
					
					<div class="lista" style="padding: 0px">
						<table class="table table-striped table-hover">
							<tr>
								<th></th>
								<th>Cliente</th>
								<th>Fecha y Hora</th>
								<th>Tipo</th>
								<th>Precion Lps</th>
								<th>Laboratorista</th>
								<th>Acciones</th>
							</tr>
							<tr>
								<td><input type="checkbox" name="" style="width: 50px"></td>
								<td>David Soliman</td>
								<td>10/Dic/2018 11:50</td>
								<td>P.b Metabolico </td>
								<td>750</td>
								<td>Levi Canales</td>
								<td><span class="glyphicon glyphicon-new-window forte"></span><span class="glyphicon glyphicon-briefcase forte"></span></td>

							</tr>
						</table>
					</div> -->
					  <ul class="collapsible">
					    <li>
					      <div class="collapsible-header">Todos</div>
					      <div class="collapsible-body"><span>Lorem ipsum dolor sit amet.</span></div>
					    </li>
					    <li>
					      <div class="collapsible-header">Second</div>
					      <div class="collapsible-body"><span>Lorem ipsum dolor sit amet.</span></div>
					    </li>
					    <li>
					      <div class="collapsible-header">Third</div>
					      <div class="collapsible-body"><span>Lorem ipsum dolor sit amet.</span></div>
					    </li>
					  </ul>
					<!--Fin Contenido-->
						
				</div>
			</div>
		</div>
		<!--Fin Del Contenedor-->

	</body>
	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/materialize.min.js"></script>	
	<script src="js/emision_resultado.js"></script>	
	<script src="js/menu.js"></script>
</html>