<!DOCTYPE html>
<html>
<head>
  <title>Laboratorio Clinico Emanuel-Login</title>
 	<meta charset="utf-8" />
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/log.css">
</head>
<body>

<div style="width: 1100px; padding-left: 200px;">
  <div class="cuadro" >
    <h4><b> Solicitud de registro</b></h4>
    <hr>
    <table>
      <tr>
        <th><label>Modulo al que desea registrarse:</label></th>
        <th>
                <select style="border-radius: 5px; height: 30px; width: 300px;">
                  <option>Facturacion</option>
                  <option>Cliente</option>
                  <option>Administracion</option>
                  <option>Inventario</option>
                </select>
        </th>
      </tr>
      <tr>
        <th><label>Nombre:</label></th>
        <th><input type="text" name="" class="format"></th>
      </tr>
      <tr>
        <th><label>Apellido:</label></th>
        <th><input type="text" name="" class="format"></th>
      </tr>
      <tr>
        <th><label>Codigo Empleado:</label></th>
        <th><input type="text" name="" class="format"></th>
      </tr>
      <tr>
        <th><label>Correo:</label></th>
        <th><input type="email" name="" class="format"></th>
      </tr>
      <tr>
        <th><label>Contrasenia:</label></th>
        <th><input type="password" name="" class="format"></th>
      </tr>
      <tr>
        <th><label>Repita Contrasenia:</label></th>
        <th><input type="password" name="" class="format"></th>
      </tr>
      <tr>
        <th><label>Telefono:</label></th>
        <th><input type="text" name="" class="format"></th>
      </tr>
    </table>
    <button class="btn btn-primary reg">Registrarse</button>
  </div>
  
</div>


</body>
</html>