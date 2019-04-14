<?php 

  class Insumo{
    private $idInsumo;
    private $idTipoInsumo;
    private $idProveedor;
    private $insumo;
    private $descripcion;
    private $precioCosto;
    private $cantidad;
    private $fechaIngreso;
    private $fechaVencimiento;
    public function __construct(
      $idInsumo = null,
      $idTipoInsumo = null,
      $idProveedor = null,
      $insumo = null,
      $descripcion = null,
      $precioCosto = null,
      $cantidad = null,
      $fechaIngreso = null,
      $fechaVencimiento = null
      ){
        $this->idInsumo = $idInsumo;
        $this->idTipoInsumo = $idTipoInsumo;
        $this->idProveedor = $idProveedor;
        $this->insumo = $insumo;
        $this->descripcion = $descripcion;
        $this->precioCosto = $precioCosto;
        $this->cantidad = $cantidad;
        $this->fechaIngreso = $fechaIngreso;
        $this->fechaVencimiento = $fechaVencimiento;
    }
    public function __toString(){
      $var = "Insumo{"
      ."idInsumo: ".$this->idInsumo." , "
      ."idTipoInsumo: ".$this->idTipoInsumo." , "
      ."idProveedor: ".$this->idProveedor." , "
      ."insumo: ".$this->insumo." , "
      ."descripcion: ".$this->descripcion." , "
      ."precioCosto: ".$this->precioCosto." , "
      ."cantidad: ".$this->cantidad." , "
      ."fechaIngreso: ".$this->fechaIngreso." , "
      ."fechaVencimiento: ".$this->fechaVencimiento;
      return $var."}";
    }
    public function getIdInsumo(){
      return $this->idInsumo;
    }
    public function setIdInsumo($idInsumo){
      $this->idInsumo = $idInsumo;
    }
    public function getIdTipoInsumo(){
      return $this->idTipoInsumo;
    }
    public function setIdTipoInsumo($idTipoInsumo){
      $this->idTipoInsumo = $idTipoInsumo;
    }
    public function getIdProveedor(){
      return $this->idProveedor;
    }
    public function setIdProveedor($idProveedor){
      $this->idProveedor = $idProveedor;
    }
    public function getInsumo(){
      return $this->insumo;
    }
    public function setInsumo($insumo){
      $this->insumo = $insumo;
    }
    public function getDescripcion(){
      return $this->descripcion;
    }
    public function setDescripcion($descripcion){
      $this->descripcion = $descripcion;
    }
    public function getPrecioCosto(){
      return $this->precioCosto;
    }
    public function setprecioCosto($precioCosto){
      $this->precioCosto = $precioCosto;
    }
    public function getCantidad(){
      return $this->cantidad;
    }
    public function setCantidad($cantidad){
      $this->cantidad = $cantidad;
    }
    public function getFechaIngreso(){
      return $this->fechaIngreso;
    }
    public function setFechaIngreso($fechaIngreso){
      $this->fechaIngreso = $fechaIngreso;
    }
    public function getFechaVencimiento(){
      return $this->fechaVencimiento;
    }
    public function setFechaVencimiento($fechaVencimiento){
      $this->fechaVencimiento = $fechaVencimiento;
    }

    public static function leer($conexion){
      $sql = 
      ' SELECT A.ID_INSUMO,
               B.TIPO_INSUMO,
               A.INSUMO,
               A.CANTIDAD,
               A.PRECIO_COSTO,
               C.PROVEEDOR
        FROM TBL_INSUMOS A
        INNER JOIN TBL_TIPOS_INSUMOS B
        ON (A.ID_TIPO_INSUMO = B.ID_TIPO_INSUMO)
        INNER JOIN TBL_PROVEEDORES C
        ON (A.ID_PROVEEDOR = C.ID_PROVEEDOR)';
      $rows = $conexion->query($sql);
      return $rows;
    }
    public function leerMenorCantidad($conexion){
      $sql = 
      ' SELECT A.ID_INSUMO,
               B.TIPO_INSUMO,
               A.INSUMO,
               A.CANTIDAD,
               A.PRECIO_COSTO,
               C.PROVEEDOR
        FROM TBL_INSUMOS A
        INNER JOIN TBL_TIPOS_INSUMOS B
        ON (A.ID_TIPO_INSUMO = B.ID_TIPO_INSUMO)
        INNER JOIN TBL_PROVEEDORES C
        ON (A.ID_PROVEEDOR = C.ID_PROVEEDOR)
        WHERE A.CANTIDAD <= %d';
      $valores = [$this->getCantidad()];
      $rows = $conexion->query($sql, $valores);
      return $rows;
    }
    public function leerPorId($conexion){
      $sql = 
      ' SELECT A.ID_INSUMO,
               B.TIPO_INSUMO,
               A.INSUMO,
               A.DESCRIPCION,
               A.CANTIDAD,
               A.PRECIO_COSTO,
               A.FECHA_INGRESO,
               A.FECHA_VENC,
               C.PROVEEDOR
        FROM TBL_INSUMOS A
        INNER JOIN TBL_TIPOS_INSUMOS B
        ON (A.ID_TIPO_INSUMO = B.ID_TIPO_INSUMO)
        INNER JOIN TBL_PROVEEDORES C
        ON (A.ID_PROVEEDOR = C.ID_PROVEEDOR)
        WHERE ID_INSUMO = %s
      ';
      $valores = [$this->getIdInsumo()];
      $rows = $conexion->query($sql, $valores);
      if (count($rows)) return $rows[0];
      else return null;
    }
    public function crear($conexion){
      $sql = "
        CALL SP_Insertar_Insumo(
          '%d','%d','%s','%s','%s','%s',DATE('%s'),DATE('%s'), @mensaje, @error
        );
      ";
      $valores = [
        $this->getIdTipoInsumo(),
        $this->getIdProveedor(),
        $this->getInsumo(),
        $this->getDescripcion(),
        $this->getPrecioCosto(),
        $this->getCantidad(),
        $this->getFechaIngreso(),
        $this->getFechaVencimiento()
      ];
      $rows = $conexion->query($sql, $valores);
      return $rows[0];
    }
    public function disminuir($conexion){
      $sql = 'CALL SP_Disminuir_Insumo(%d, @mensaje, @error);';
      $valores = [
        $this->getIdInsumo()
      ];
      $rows = $conexion->query($sql, $valores);
      return $rows[0];
    }
    public function actualizar($conexion){
      $sql = "
        CALL SP_Actualizar_Insumo(
          '%d','%d','%s','%s','%s','%s',DATE('%s'),DATE('%s'), @mensaje, @error
        );
      ";
      $valores = [
        $this->getIdTipoInsumo(),
        $this->getIdProveedor(),
        $this->getInsumo(),
        $this->getDescripcion(),
        $this->getPrecioCosto(),
        $this->getCantidad(),
        $this->getFechaIngreso(),
        $this->getFechaVencimiento()
      ];
      $rows = $conexion->query($sql, $valores);
      return $rows[0];
    }
  }

?>