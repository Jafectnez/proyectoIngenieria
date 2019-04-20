<?php 

  class Bitacora{
    private $idBitacora;
    private $idUsuario;
    private $descripcion;
    private $fecha;
    public function __construct(
      $idBitacora = null,
      $idUsuario = null,
      $descripcion = null,
      $fecha = null
    ){
      $this->idBitacora = $idBitacora;
      $this->idUsuario = $idUsuario;
      $this->descripcion = $descripcion;
      $this->fecha = $fecha;
    }
    public function __toString(){
      $var = "Bitacora{"
      ."idBitacora: ".$this->idBitacora." , "
      ."idUsuario: ".$this->idUsuario." , "
      ."descripcion: ".$this->descripcion." , "
      ."fecha: ".$this->fecha;
      return $var."}";
    }
    public function getIdBitacora(){
      return $this->idBitacora;
    }
    public function setIdBitacora($idBitacora){
      $this->idBitacora = $idBitacora;
    }
    public function getIdUsuario(){
      return $this->idUsuario;
    }
    public function setIdUsuario($idUsuario){
      $this->idUsuario = $idUsuario;
    }
    public function getDescripcion(){
      return $this->descripcion;
    }
    public function setDescripcion($descripcion){
      $this->descripcion = $descripcion;
    }
    public function getFecha(){
      return $this->fecha;
    }
    public function setFecha($fecha){
      $this->fecha = $fecha;
    }
    public static function leer($conexion){
      $sql = 
      ' SELECT A.ID_BITACORA,
               B.USUARIO,
               A.DESCRIPCION,
               A.FECHA
        FROM TBL_BITACORA A
        INNER JOIN TBL_USUARIOS B
        ON (A.ID_USUARIO = B.ID_USUARIO)';
      $rows = $conexion->query($sql);
      return $rows;
    }
    public function leerPorId($conexion){
      $sql = 
      '  SELECT A.ID_BITACORA,
                B.USUARIO,
                A.DESCRIPCION,
                A.FECHA
          FROM TBL_BITACORA A
          INNER JOIN TBL_USUARIOS B
          ON (A.ID_USUARIO = B.ID_USUARIO)
          WHERE ID_BITACORA = %s
      ';
      $valores = [$this->getIdBitacora()];
      $rows = $conexion->query($sql, $valores);
      if (count($rows)) return $rows[0];
      else return null;
    }
  }

?>