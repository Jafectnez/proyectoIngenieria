<!DOCTYPE html>
<html>
  <head>
    <title>Laboratorio Clinico Emanuel-Login</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/log.css">
  </head>
  <body>
    <h1>Laboratorio Clínico Emanuel</h1>

  <div class="login-page">
    <div class="form">
      <div class="login-form">
        <input type="text" class="form-control" placeholder="Usuario" id="txt-Usuario" />
        <input type="password" class="form-control" placeholder="Contraseña" id="txt-Password" />
        <button class="btn btn-primary" id="btn-iniciar-sesion" onclick="iniciarSesion();">Iniciar Sesion</button>
        <div id="status"></div>
        <br><br><br>
        <a href="#">Olvidé mi contraseña</a>
        <br>
      </div>
    </div>
  </div>


  </body>
  <script src="js/jquery-3.2.1.min.js"></script>
  <script src="js/controladores/sesion.js"></script>
</html>