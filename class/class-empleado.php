<?php 

  class Empleado extends Persona{
    private $idEmpleado;
    private $fechaIngreso;
    private $fechaDespido;
    public function __construct(
      $idEmpleado = null,
      $fechaIngreso = null,
      $fechaDespido = null
    ){
      $this->idEmpleado = $idEmpleado;
      $this->fechaIngreso = $fechaIngreso;
      $this->fechaDespido = $fechaDespido;
    }
    public function __toString(){
      $var = "Empleado{"
      ."idEmpleado: ".$this->idEmpleado." , "
      ."fechaIngreso: ".$this->fechaIngreso." , "
      ."fechaDespido: ".$this->fechaDespido;
      return $var."}";
    }
    public function getIdEmpleado(){
      return $this->idEmpleado;
    }
    public function setIdEmpleado($idEmpleado){
      $this->idEmpleado = $idEmpleado;
    }
    public function getFechaIngreso(){
      return $this->fechaIngreso;
    }
    public function setFechaIngreso($fechaIngreso){
      $this->fechaIngreso = $fechaIngreso;
    }
    public function getFechaDespido(){
      return $this->fechaDespido;
    }
    public function setFechaDespido($fechaDespido){
      $this->fechaDespido = $fechaDespido;
    }
    public static function leer($conexion){
      $sql = 
      ' SELECT * FROM TBL_EMPLEADO A
        INNER JOIN TBL_PERSONAS B
        ON (A.ID_PERSONA = B.ID_PERSONA)';
      $rows = $conexion->query($sql);
      return $rows;
    }
    public function leerPorId($conexion){
      $sql = 
      ' SELECT * FROM TBL_EMPLEADO A
        INNER JOIN TBL_PERSONAS B
        ON (A.ID_PERSONA = B.ID_PERSONA)
        INNER JOIN TBL_USUARIO C
        ON (A.ID_USUARIO = C.ID_USUARIO)
        WHERE ID_EMPLEADO = %s
      ';
      $valores = [$this->getIdEmpleado()];
      $rows = $conexion->query($sql, $valores);
      if (count($rows)) return $rows[0];
      else return null;
    }
    public function crear($conexion){
      $sql = "
        CALL SP_INSERTAR_EMPLEADO(
          '%s','%s','%d','%s','%s','%s',DATE('%s'),'%s','%s', @mensaje, @error
        );
      ";
      $valores = [
        $this->getNombre(),
        $this->getApellido(),
        $this->getGenero(),
        $this->getDireccion(),
        $this->getEmail(),
        $this->getNumeroIdentidad(),
        $this->getFechaNacimiento(),
        $this->getTelefono(),
        $this->getEdad()
      ];
      $rows = $conexion->query($sql, $valores);
      return $rows[0];
    }
    public function borrar($conexion){
      $sql = 'CALL SP_ELIMINAR_EMPLEADO(%d, @mensaje, @error);';
      $valores = [
        $this->getIdEmpleado()
      ];
      $rows = $conexion->query($sql, $valores);
      return $rows[0];
    }
    public function actualizar($conexion){
      $sql = "
      CALL SP_ACTUALIZAR_EMPLEADO(
        '%d','%s','%s','%s','%s','%s','%s',DATE('%s'),'%s','%s', @mensaje, @error
      );
      ";
      $valores = [
        $this->getIdEmpleado(),
        $this->getNombre(),
        $this->getApellido(),
        $this->getGenero(),
        $this->getDireccion(),
        $this->getEmail(),
        $this->getNumeroIdentidad(),
        $this->getFechaNacimiento(),
        $this->getTelefono(),
        $this->getEdad()
      ];
      $rows = $conexion->query($sql, $valores);
      return $rows[0];
    }
    public function actualizarPerfil($conexion){
      $sql = "
        CALL SP_ACTUALIZAR_PERFIL(
          '%d','%s','%s','%s', @mensaje, @error
        );
      ";
      $valores = [
        $this->getIdEmpleado(),
        $this->getEmail(),
        $this->getTelefono(),
        $this->getDireccion()
      ];
    }
  }

?>