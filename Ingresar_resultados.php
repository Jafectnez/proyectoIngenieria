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

	<title>Laboratorio Clinico Emanuel-Emisión de Resultados</title>
	<meta charset="utf-8" />
	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/carousel.js"></script>

	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<!-- <link rel="stylesheet" type="text/css" href="css/barra-menu.css"> -->
	<link rel="stylesheet" type="text/css" href="css/styleBarra.css">
	<link rel="stylesheet" type="text/css" href="css/materialize.min.css">
	<link rel="stylesheet" href="css/jquery-confirm.min.css">
	
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
		         <div class="input-field col s12">
		          <input id="txt-nombre-cliente" type="text" class="validate search">
		          <label for="txt-nombre-cliente">identidad: 08011995xxxxx</label>
		         </div>
		         
		        </div>

		        <!-- Fin de los Encabezados -->
				<!--Contenido-->
				<div id="div-examen"></div>
				 <ul class="collapsible" id="ul-area">
				 	
				 </ul>
				 <button class="btn waves-effect waves-light" id="btn-guardar">Guardar </button>

  				<!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalScrollable">
  Resultado
</button> -->

<!-- Modal -->
<div class="modal fade" id="mod-emitido" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header" style="text-align: center;">
        <!-- <h5 class="modal-title" id="exampleModalScrollableTitle">Modal title</h5> -->
        <h5><strong>Laboratorio Clínico Emanuel</strong></h5>
							<h6><strong>SIRVIENDO A DIOS ATRAVES DE SU SALUD</strong></h6>
							<h6><strong>La libertad, Comayagua, Honduras, C.A</strong></h6>
							<h6><strong>Telefonos: 2784-0292, 2784-0699</strong></h6>
							<hr>
							<div id="datos"></div>
        
      </div>
      <div class="modal-body">
        <!--Cuerpo Del Resultado Recien Emitido-->
        <div >
        	<table  >
        		<thead>
        		<tr>
        			<th>Caracteristica</th>
        			<th>Valor de referencia</th>
        			<th style=" margin-right: 30px;">Resultado</th>
        		</tr>

        		</thead>
        		<tbody id="div-resultado-emitido">
        			
        		</tbody>
        		
        	</table>
        		
        </div>

        <!--Fin del resultado que se acaba de emitir-->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Guardar</button>
      </div>
    </div>
  </div>
</div> 
<!--Fin Modal -->
  
								
				<!--Fin Contenido-->

					
			</div>
		</div>

	</div>
	<!--Fin Del Contenedor-->
	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/carousel.js"></script>
	<script src="js/menu.js"></script>
	<script src="js/emision_resultado.js"></script>	
	<script src="js/jquery-confirm.min.js"></script>
	<script src="js/materialize.min.js"></script>	
	<script type="text/javascript" src="js/bootstrap.js"></script>

</body>
</html>
