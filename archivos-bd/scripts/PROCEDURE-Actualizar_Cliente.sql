USE DB_EMANUEL;

DROP PROCEDURE IF EXISTS `SP_ACTUALIZAR_CLIENTE`;//

CREATE PROCEDURE `SP_ACTUALIZAR_CLIENTE`(

  IN P_ID_CLIENTE INTEGER(11),
  IN P_ID_USUARIO INTEGER(11),
  IN P_NOMBRE VARCHAR(50),
  IN P_APELLIDO VARCHAR(50),
  IN P_GENERO VARCHAR(1),
  IN P_DIRECCION VARCHAR(300),
  IN P_EMAIL VARCHAR(100),
  IN P_IDENTIDAD VARCHAR(13),
  IN P_FECHA_NAC DATE,
  IN P_TELEFONO VARCHAR(50),
  IN P_EDAD VARCHAR(50),
  IN P_USUARIO VARCHAR(50),
  IN P_CONTRASEÑA VARCHAR(50),
  IN P_NUEVA_CONTRASEÑA VARCHAR(50),
  
  OUT pO_mensaje VARCHAR(1000),
  OUT pO_error BOOLEAN
)
SP:BEGIN

  # Declaraciones
  DECLARE mensaje VARCHAR(1000);
  DECLARE contador INTEGER(20);
  DECLARE error BOOLEAN;
  DECLARE idPersona INT(11);
  DECLARE uEstado VARCHAR(1);

  # Inicializaciones
  SET AUTOCOMMIT=0;
  START TRANSACTION;
  SET mensaje = '';
  SET contador =0;
  SET error=FALSE;
  SET uEstado='A';
  # ___________________________VALIDACIONES__________________________________________________________
  # Verificaciones de campos obligatorios que no esten vacios
  # employee registers
  IF P_ID_CLIENTE='' OR P_ID_CLIENTE IS NULL THEN 
    SET mensaje=CONCAT(mensaje, 'Identificador de cliente vacio, ');
  END IF;
  
  IF P_ID_USUARIO='' OR P_ID_USUARIO IS NULL THEN 
    SET mensaje=CONCAT(mensaje, 'Identificador de usuario vacio, ');
  END IF;

  IF P_DIRECCION='' OR P_DIRECCION IS NULL THEN
    SET mensaje=CONCAT(mensaje,'Direccion vacia, ');
  END IF;

  IF P_EMAIL='' OR P_EMAIL IS NULL THEN
    SET mensaje=CONCAT(mensaje,'Correo electronico vacio, ');
  END IF;

  IF P_FECHA_NAC='' OR P_FECHA_NAC IS NULL THEN
    SET mensaje=CONCAT(mensaje,'Fecha de nacimiento vacia, ');
  END IF;

  IF P_EDAD='' OR P_EDAD IS NULL THEN
    SET mensaje=CONCAT(mensaje,'Edad vacia, ');
  END IF;
  
  IF P_USUARIO='' OR P_USUARIO IS NULL THEN 
    SET mensaje=CONCAT(mensaje, 'Identificador de cliente vacio, ');
  END IF;
  
  IF P_CONTRASEÑA='' OR P_CONTRASEÑA IS NULL THEN 
    SET mensaje=CONCAT(mensaje, 'Identificador de usuario vacio, ');
  END IF;
  

  IF P_TELEFONO='' OR P_TELEFONO IS NULL THEN
    SET mensaje=CONCAT(mensaje,'Telefono a actualizar vacio, ');
  ELSE
    IF( P_TELEFONO REGEXP'^(2|3|6|7|8|9){1}[0-9]{3}-[0-9]{4}$')=0 THEN
      SET mensaje=CONCAT(mensaje,'Formato del telefono a actualizar invalido, ');
    END IF;
  END IF;
  
  # _________________________CUERPO DEL PL___________________________________________
  # update n Commit
  # verify employee registers
  SELECT COUNT(*) INTO contador
  FROM TBL_CLIENTE
  WHERE TBL_CLIENTE.ID_CLIENTE = P_ID_CLIENTE;

  IF contador=0 THEN  
      SET mensaje = CONCAT(mensaje, 'El cliente no existe, ');
  END IF;

  IF mensaje <> '' THEN
      SET mensaje=mensaje;
      SET error=TRUE;
      SET pO_mensaje=mensaje;
      SET pO_error=error;
      SELECT mensaje,error;
      # SELECT mensaje, resultado;, usar para salida de parametros en caso de no utilizar
      # parametros de salida
      LEAVE SP;
  END IF;
  
  IF mensaje <> '' THEN
  SET mensaje=mensaje;
  SET error = TRUE;
  SET pO_mensaje=mensaje;
  SET pO_error=error;
  SELECT mensaje, error;
  LEAVE SP;
  END IF;
  
  SELECT ID_PERSONA INTO idPersona 
  FROM TBL_CLIENTE
  WHERE TBL_CLIENTE.ID_CLIENTE = P_ID_CLIENTE;

  CALL SP_ACTUALIZAR_PERSONA( idPersona,
                              P_NOMBRE,
                              P_APELLIDO,
                              P_GENERO,
                              P_DIRECCION,
                              P_EMAIL,
                              P_IDENTIDAD,
                              P_FECHA_NAC,
                              P_TELEFONO,
                              @mensajeActualizarPersonaEmpleado,
                              @errorActulizarPersonaEmpleado
                              );
  IF @errorActulizarPersonaEmpleado THEN
    SET mensaje=@mensajeActualizarPersonaEmpleado;
    SET error=TRUE;
    SET pO_mensaje=mensaje;
    SET pO_error=error;
    SELECT mensaje,error;
    LEAVE SP;
  END IF;
  
  UPDATE TBL_PERSONAS 
  SET
    TBL_PERSONAS.TELEFONO = P_TELEFONO
  WHERE TBL_PERSONAS.ID_PERSONA= idPersona;
  COMMIT;
  
  IF P_NUEVA_CONTRASEÑA <>'' THEN 
    UPDATE TBL_USUARIOS 
  SET
    TBL_USUARIOS.CONTRASEÑA = P_NUEVA_CONTRASEÑA
  WHERE TBL_USUARIOS.ID_USUARIO= P_ID_USUARIO;
  COMMIT;
  END IF;
  
  SET mensaje='Actualización exitosa';
  SET error=FALSE;
  SET pO_mensaje=mensaje;
  SET pO_error=error;
  SELECT mensaje,error;
  
END//