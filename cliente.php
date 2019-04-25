
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
        <div id="barraNav" class="col-lg-2 col-sm-2 lista" style="width: 20%"></div>
        <!--Aqui Finaliza La Barra De Menu-->
              
        <!--Contenido de Clientes-->
        <div class="col-lg-10 col-sm-10 well" style="border: black 1px solid;width: 80%"> 
          <!--Barra De Menu 2-->
          <br>
          <div align="right" style="width: 80%; margin: 0 auto;">
            <label><input type="text" id="input-buscar" align="center" style="margin: 0 auto;" placeholder="Buscar"></label>
          </div>
          
          <!--Fin De Barra De Menu 2-->
          <hr>
          <!-- Contenido Lista de Clientes-->
          <div id="div-clientes">
            <table id="table-clientes" class="table table-striped table-hover" style="width: 75%; margin: 0 auto;">
              <tr>
                  <td></td>
                  <th>Cliente</th>
                  <th>Usuario</th>
                  <th>Fecha Registro</th>
                  <th></th>
              </tr>
            </table>
          </div><!-- Fin contenido Lista de Clientes-->
        </div>
        <!-- Fin del contenido modulo CLientes-->
      </div><!--Fin del row-->
    </div><!--Fin del Contenedor-->
  </body>
  <script src="js/jquery-3.2.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/carousel.js"></script>
  <script src="js/menu.js"></script>
  <script src="js/Clientes.js"></script>

</html>