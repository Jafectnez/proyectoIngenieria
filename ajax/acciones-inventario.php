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
      case 'leer-tipos-insumo':
        $res['data'] = Insumo::leerTiposInsumo($conexion);
        echo json_encode($res);
      break;
      case 'leer-proveedores':
        $res['data'] = Insumo::leerProveedores($conexion);
        echo json_encode($res);
      break;
      case 'insertar-insumo':
        $nombre = ValidarPost::varchar('nombre');
        $idTipoInsumo = ValidarPost::int('id_tipo_insumo');
        $idProveedor = ValidarPost::int('id_proveedor');
        $cantidad = ValidarPost::int('cantidad');
        $precio = ValidarPost::float('precio');
        $descripcion = ValidarPost::varchar('descripcion');
        $fechaIngreso = ValidarPost::date('fecha_ingreso');
        $fechaVencimiento = ValidarPost::date('fecha_vencimiento');
        
        $insumo = new Insumo();
        $insumo->setIdTipoInsumo($idTipoInsumo);
        $insumo->setIdProveedor($idProveedor);
        $insumo->setInsumo($nombre);
        $insumo->setDescripcion($descripcion);
        $insumo->setPrecioCosto($precio);
        $insumo->setCantidad($cantidad);
        $insumo->setFechaIngreso($fechaIngreso);
        $insumo->setFechaVencimiento($fechaVencimiento);
        $res['data'] = $insumo->crear($conexion);
        echo json_encode($res);
      break;
      case 'disminuir-insumo':
        $idInsumo = ValidarPost::unsigned('id_insumo');
        $cantidad = ValidarPost::int('cantidad');
        $insumo = new Insumo();
        $insumo->setIdInsumo($idInsumo);
        $insumo->setCantidad($cantidad);
        $res['data'] = $insumo->disminuir($conexion);
        echo json_encode($res);
      break;
      case 'actualizar-insumo':
        $idInsumo = ValidarPost::unsigned('id_insumo');
        $nombre = ValidarPost::varchar('nombre');
        $idTipoInsumo = ValidarPost::int('id_tipo_insumo');
        $idProveedor = ValidarPost::int('id_proveedor');
        $cantidad = ValidarPost::int('cantidad');
        $precio = ValidarPost::float('precio');
        $descripcion = ValidarPost::varchar('descripcion');
        $fechaIngreso = ValidarPost::date('fecha_ingreso');
        $fechaVencimiento = ValidarPost::date('fecha_vencimiento');
        
        $insumo = new Insumo();
        $insumo->setIdInsumo($idInsumo);
        $insumo->setIdTipoInsumo($idTipoInsumo);
        $insumo->setIdProveedor($idProveedor);
        $insumo->setInsumo($nombre);
        $insumo->setDescripcion($descripcion);
        $insumo->setPrecioCosto($precio);
        $insumo->setCantidad($cantidad);
        $insumo->setFechaIngreso($fechaIngreso);
        $insumo->setFechaVencimiento($fechaVencimiento);
        $res['data'] = $insumo->actualizar($conexion);
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