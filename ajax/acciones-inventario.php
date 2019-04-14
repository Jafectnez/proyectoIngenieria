<?php
  include_once("../class/class-conexion.php");
  include_once("../class/class-utilidades.php");
  include_once("../class/class-insumo.php");
  
  if(isset($_POST['accion'])){
    $conexion = new Conexion();
    switch ($_POST['accion']) {
      //Acciones con los insumos
      case 'leer-insumos':
        $res['data'] = Insumo::leer($conexion);
        echo json_encode($res);
      break;
      case 'leer-insumos-proximos':
        $cantidad = ValidarPost::int('cantidad');
        $insumo = new Insumo();
        $insumo->setCantidad($cantidad);
        $res['data'] = $insumo->leerMenorCantidad($conexion);
        echo json_encode($res);
      break;
      case 'leer-insumos-id':
        $idInsumo = ValidarPost::unsigned('id_insumo');
        $insumo = new Insumo();
        $insumo->setIdInsumo($idInsumo);
        $res['data'] = $insumo->leerPorId($conexion);
        echo json_encode($res);
      break;
      case 'insertar-insumo':
        $genero = ValidarPost::varchar('genero');
        $nombre = ValidarPost::varchar('nombre');
        $apellido = ValidarPost::varchar('apellido');
        $edad = ValidarPost::int('edad');
        $telefono = ValidarPost::varchar('telefono');
        $email = ValidarPost::varchar('email');
        $fechaNacimiento = ValidarPost::varchar('fecha_nacimiento');
        $direccion = ValidarPost::varchar('direccion');
        $numeroIdentidad = ValidarPost::varchar('identidad');
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
      case 'actualizar-insumo':
        $idEmpleado = ValidarPost::unsigned('id_empleado');
        $nombre = ValidarPost::varchar('nombre');
        $apellido = ValidarPost::varchar('apellido');
        $genero = ValidarPost::varchar('genero');
        $direccion = ValidarPost::varchar('direccion');
        $edad = ValidarPost::varchar('edad');
        $email = ValidarPost::varchar('email');
        $numeroIdentidad = ValidarPost::varchar('numero_identidad');
        $fechaNacimiento = ValidarPost::varchar('fecha_nacimiento');
        $telefono = ValidarPost::varchar('telefono');
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
      case 'disminuir-insumo':
        $idEmpleado = ValidarPost::unsigned('id_empleado');
        $empleado = new Empleado();
        $empleado->setIdEmpleado($idEmpleado);
        $res['data'] = $empleado->borrar($conexion);
        echo json_encode($res);
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
    $res['data']['accion']=$_POST;
    echo json_encode($res);
  }
  
?>