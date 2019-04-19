<!DOCTYPE html>
<html>
<head>

	<title>Laboratorio Clinico Emanuel-Emisión de Resultados</title>
	<meta charset="utf-8" />
	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/carousel.js"></script>

	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/barra-menu.css">
	<link rel="stylesheet" type="text/css" href="css/carousel.css">
	<link rel="stylesheet" type="text/css" href="css/styleBarra.css">
	<link rel="stylesheet" type="text/css" href="css/materialize.min.css">
	
</head>
<body>

	<!--Contenedor-->
	<div class="container-fluid" style="padding: 0; background-image: url(img/catalogo.jpg)">
		<div class="row">

		<!--Aqui Esta Contenida La Barra De Menu-->
		<div id="barraNav" class="col-lg-2 col-md-2 col-sm-2 lista" style="width: 20%"></div>
        <!--Aqui Esta Finaliza La La Barra De Menu-->
        
			<div id="div-examenes" class="col-xl-10 col-lg-10 col-md-6 col-sm-6" style="border: black 1px solid; width: 80%;background-color: rgba(255,255,255,0.9) ;">
				<div style="text-align: center">
							<h5><strong>Laboratorio Clínico Emanuel</strong></h5>
							<h6><strong>SIRVIENDO A DIOS ATRAVES DE SU SALUD</strong></h6>
							<h6><strong>La libertad, Comayagua, Honduras, C.A</strong></h6>
							<h6><strong>Telefonos: 2784-0292, 2784-0699</strong></h6>
							<hr>
						</div>
				<!-- Encabezado de los examenes -->
				<div>
		         <div class="input-field col s10">
		          <input id="txt-nombre-cliente" type="text" class="validate search_query">
		          <label for="txt-nombre-cliente">Nombre Cliente</label>
		         </div>
		         <div class="input-field col s2">
		          <input id="txt-edad" type="text" class="validate">
		          <label for="txt-edad">Edad</label>
		         </div><div class="input-field col s12">
		          <!-- <input id="txt-medico" type="text" class="validate">
		          <label for="txt-medico">Medico</label>
		         </div> -->
		        </div>

		        <!-- Fin de los Encabezados -->
				<!--Contenido-->
				 <ul class="collapsible" id="ul-area">
				 	
				 </ul>
				 <button class="btn waves-effect waves-light" id="btn-guardar">Guardar </button>
				 <button class="btn waves-effect waves-light" id="btn-actualizar" >Actualizar </button>
				 
								
				<!--Fin Contenido-->

					
			</div>
		</div>
	</div>
	<!--Fin Del Contenedor-->
	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/carousel.js"></script>
	<script src="js/menu.js"></script>
	<script src="js/materialize.min.js"></script>	
	<script src="js/emision_resultado.js"></script>	

</body>
</html>
