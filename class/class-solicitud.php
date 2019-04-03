<?php 

  class Solicitud{
    private $idSolicitud;
    private $idUsuarioEmisor;
    private $idUsuarioReceptor;
    private $idEstadoSolicitud;
    private $descripcion;
    private $fechaEmision;
    public function __construct(
      $idSolicitud,
      $idUsuarioEmisor,
      $idUsuarioReceptor,
      $idEstadoSolicitud,
      $descripcion,
      $fechaEmision
    ){
      $this->idSolicitud = $idSolicitud;
      $this->idUsuarioEmisor = $idUsuarioEmisor;
      $this->idUsuarioReceptor = $idUsuarioReceptor;
      $this->idEstadoSolicitud = $idEstadoSolicitud;
      $this->descripcion = $descripcion;
      $this->fechaEmision = $fechaEmision;
    }
    public function __toString(){
      $var = "Solicitud{"
      ."idSolicitud: ".$this->idSolicitud." , "
      ."idUsuarioEmisor: ".$this->idUsuarioEmisor." , "
      ."idUsuarioReceptor: ".$this->idUsuarioReceptor." , "
      ."idEstadoSolicitud: ".$this->idEstadoSolicitud." , "
      ."descripcion: ".$this->descripcion." , "
      ."fechaEmision: ".$this->fechaEmision;
      return $var."}";
    }
    public function getIdSolicitud(){
      return $this->idSolicitud;
    }
    public function setIdSolicitud($idSolicitud){
      $this->idSolicitud = $idSolicitud;
    }
    public function getIdUsuarioEmisor(){
      return $this->idUsuarioEmisor;
    }
    public function setIdUsuarioEmisor($idUsuarioEmisor){
      $this->idUsuarioEmisor = $idUsuarioEmisor;
    }
    public function getIdUsuarioReceptor(){
      return $this->idUsuarioReceptor;
    }
    public function setIdUsuarioReceptor($idUsuarioReceptor){
      $this->idUsuarioReceptor = $idUsuarioReceptor;
    }
    public function getIdEstadoSolicitud(){
      return $this->idEstadoSolicitud;
    }
    public function setIdEstadoSolicitud($idEstadoSolicitud){
      $this->idEstadoSolicitud = $idEstadoSolicitud;
    }
    public function getDescripcion(){
      return $this->descripcion;
    }
    public function setDescripcion($descripcion){
      $this->descripcion = $descripcion;
    }
    public function getFechaEmision(){
      return $this->fechaEmision;
    }
    public function setFechaEmision($fechaEmision){
      $this->fechaEmision = $fechaEmision;
    }

    public static function leer($conexion){
      $sql = 
      ' SELECT * FROM TBL_SOLICITUDES A
        INNER JOIN TBL_EMPLEADO B
        ON (A.ID_USUARIO_EMISOR = B.ID_USUARIO)
        INNER JOIN TBL_PERSONAS C
        ON (B.ID_PERSONA = C.ID_PERSONA)
        INNER JOIN TBL_USUARIOS D
        ON (A.ID_USUARIO_EMISOR = D.ID_USUARIO)
        INNER JOIN TBL_ESTADO_SOLICITUD E
        ON (A.ID_ESTADO_SOLICITUD = E.ID_ESTADO_SOLICITUD)';
      $rows = $conexion->query($sql);
      return $rows;
    }
    public function leerPorId($conexion){
      $sql = 
      ' SELECT * FROM TBL_SOLICITUDES A
        INNER JOIN TBL_EMPLEADO B
        ON (A.ID_USUARIO_EMISOR = B.ID_USUARIO)
        INNER JOIN TBL_PERSONA C
        ON (B.ID_PERSONA = C.ID_PERSONA)
        WHERE ID_SOLICITUD = %s
      ';
      $valores = [$this->getIdSolicitud()];
      $rows = $conexion->query($sql, $valores);
      if (count($rows)) return $rows[0];
      else return null;
    }
    public function crear($conexion){
      $sql = "
        CALL SP_Insertar_Solicitud(
          '%d','%d','%d','%s',DATE('%s'), @mensaje, @error
        );
      ";
      $valores = [
        $this->getIdUsuarioEmisor(),
        $this->getIdUsuarioReceptor(),
        $this->getIdEstadoSolicitud(),
        $this->getDescripcion(),
        $this->getFechaEmision()
      ];
      $rows = $conexion->query($sql, $valores);
      return $rows[0];
    }
    public function borrar($conexion){
      $sql = 'CALL SP_Eliminar_Solicitud(%s, @mensaje, @error);';
      $valores = [
        $this->getIdSolicitud()
      ];
      $rows = $conexion->query($sql, $valores);
      return $rows[0];
    }
    public function actualizar($conexion){
      $sql = "
      CALL SP_Actualizar_Solicitud(
        '%d', @mensaje, @error
      );
      ";
      $valores = [
        $this->getIdEstadoSolicitud()
      ];
      $rows = $conexion->query($sql, $valores);
      return $rows[0];
    }
  }

?>