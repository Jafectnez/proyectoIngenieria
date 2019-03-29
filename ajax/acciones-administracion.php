<?php
  include_once("../class/class-conexion.php");
  include_once("../class/class-persona.php");
  include_once("../class/class-empleado.php");
  include_once("../class/class-solicitud.php");
  
  $conexion = new Conexion();
  
  if(isset($_POST['accion'])){
    $conexion = new Conexion();
    switch ($_POST['accion']) {
      //Acciones con los empleados
      case 'leer-empleados':
        $res['data'] = Empleado::leer($conexion);
        echo json_encode($res);
      break;
      case 'leer-empleado-id':
        $idEmpleado = ValidarPost::unsigned('id_empleado');
        $empleado = new Empleado();
        $empleado->setIdEmpleado($idEmpleado);
        $res['data'] = $empleado->leerPorId($conexion);
        echo json_encode($res);
      break;
      case 'insertar-empleado':
        $genero = ValidarPost::varchar('genero');
        $nombre = ValidarPost::varchar('nombre');
        $apellido = ValidarPost::varchar('apellido');
        $edad = ValidarPost::varchar('edad');
        $telefono = ValidarPost::varchar('telefono');
        $email = ValidarPost::varchar('email');
        $fechaNacimiento = ValidarPost::varchar('fecha_nacimiento');
        $direccion = ValidarPost::varchar('direccion');
        $numeroIdentidad = ValidarPost::varchar('numero_identidad');
        $fechaIngreso = ValidarPost::date('fecha_ingreso');
        
        $empleado = new Empleado();
        $empleado->setNombre($nombre);
        $empleado->setApellido($apellido);
        $empleado->setGenero($genero);
        $empleado->setDireccion($direccion);
        $empleado->setEmail($email);
        $empleado->setNumeroIdentidad($numeroIdentidad);
        $empleado->setFechaNacimiento($fechaNacimiento);
        $empleado->setTelefono($telefono);
        $empleado->setFechaIngreso($fechaIngreso);
        $empleado->setEdad($edad);
        $res['data'] = $empleado->crear($conexion);
        echo json_encode($res);
      break;
      case 'actualizar-empleado':
        $idEmpleado = ValidarPost::unsigned('id_empleado');
        $genero = ValidarPost::varchar('genero');
        $nombre = ValidarPost::varchar('nombre');
        $apellido = ValidarPost::varchar('apellido');
        $edad = ValidarPost::varchar('edad');
        $telefono = ValidarPost::varchar('telefono');
        $email = ValidarPost::varchar('email');
        $fechaNacimiento = ValidarPost::varchar('fecha_nacimiento');
        $direccion = ValidarPost::varchar('direccion');
        $numeroIdentidad = ValidarPost::varchar('numero_identidad');
        $fechaIngreso = ValidarPost::date('fecha_ingreso');
        
        $empleado = new Empleado();
        $empleado->setIdEmpleado($idEmpleado);
        $empleado->setNombre($nombre);
        $empleado->setApellido($apellido);
        $empleado->setGenero($genero);
        $empleado->setDireccion($direccion);
        $empleado->setEmail($email);
        $empleado->setNumeroIdentidad($numeroIdentidad);
        $empleado->setFechaNacimiento($fechaNacimiento);
        $empleado->setTelefono($telefono);
        $empleado->setFechaIngreso($fechaIngreso);
        $empleado->setEdad($edad);
        $res['data'] = $empleado->actualizar($conexion);
        echo json_encode($res);
      break;
      case 'actualizar-perfil':
        $idEmpleado = ValidarPost::unsigned('id_empleado');
        $email = ValidarPost::varchar('email');
        $telefono = ValidarPost::varchar('telefono');
        $direccion = ValidarPost::varchar('direccion');
        $empleado = new Empleado();
        $empleado->setIdEmpleado($idEmpleado);
        $empleado->setEmail($email);
        $empleado->setTelefono($telefono);
        $empleado->setDireccion($direccion);
        $res['data'] = $empleado->actualizarPerfil($conexion);
        echo json_encode($res);
      break;
      case 'eliminar-empleado':
        $idEmpleado = ValidarPost::unsigned('id_empleado');
        $empleado = new Empleado();
        $empleado->setIdEmpleado($idEmpleado);
        $res['data'] = $empleado->borrar($conexion);
        echo json_encode($res);
      break;

      //Acciones con las solicitudes
      case 'leer-solicitudes':
        $res['data'] = Solicitud::leer($conexion);
        echo json_encode($res);
      break;
      case 'leer-solicitud-id':
        $idSolicitud = ValidarPost::unsigned('id_solicitud');
        $solicitud = new Solicitud();
        $solicitud->setIdSolicitud($idSolicitud);
        $res['data'] = $solicitud->leerPorId($conexion);
        echo json_encode($res);
      break;
      case 'actualizar-solicitud':
        $idSolicitud = ValidarPost::unsigned('id_solicitud');
        $idEstadoSolicitud = ValidarPost::varchar('id_estado_solicitud');
        
        $solicitud = new Solicitud();
        $solicitud->setIdSolicitud($idSolicitud);
        $solicitud->setIdEstadoSolicitud($idEstadoSolicitud);
        $res['data'] = $solicitud->actualizar($conexion);
        echo json_encode($res);
      break;
      case 'eliminar-solicitud':
        $idSolicitud = ValidarPost::unsigned('id_solicitud');
        $solicitud = new Solicitud();
        $solicitud->setIdSolicitud($idSolicitud);
        $res['data'] = $solicitud->borrar($conexion);
        echo json_encode($res);
      break;

      break;
      // DEFAULT
      default:
        $res['data']['mensaje']='Accion no reconocida';
        $res['data']['resultado']=false;
        echo json_encode($res);
      break;
    }
    $conexion->cerrar();
    $conexion = null;
  } else {
    $res['data']['mensaje']='Accion no especificada';
    $res['data']['resultado']=false;
    echo json_encode($res);
  }
  
?>

