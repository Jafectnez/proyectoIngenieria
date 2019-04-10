USE DB_EMANUEL;
#Procedimiento para Insertar Solicitud
DROP PROCEDURE IF EXISTS `SP_INSERTAR_SOLICITUD`;
CREATE PROCEDURE `SP_INSERTAR_SOLICITUD`(
  IN P_ID_USUARIO_EMISOR INT(11),
  IN P_ID_USUARIO_RECEPTOR INT(11),
  IN P_DESCRIPCION VARCHAR(300),
  
  OUT P_MENSAJE VARCHAR(1000),
  OUT P_ERROR BOOLEAN
)
SP:BEGIN

  # Declaraciones
  DECLARE mensaje VARCHAR(1000);
  DECLARE error BOOLEAN;
  DECLARE contador INT;

  # Inicializaciones
  SET AUTOCOMMIT=0;
  START TRANSACTION;
  SET mensaje = '';

  # Validaciones
  IF P_ID_USUARIO_EMISOR='' OR P_ID_USUARIO_EMISOR IS NULL THEN 
    SET mensaje=CONCAT(mensaje, 'Usuario emisor vacío, ');
  END IF; 

  IF P_ID_USUARIO_RECEPTOR='' OR P_ID_USUARIO_RECEPTOR IS NULL THEN 
    SET mensaje=CONCAT(mensaje, 'Usuario receptor vacío, ');
  END IF; 

  IF P_DESCRIPCION='' OR P_DESCRIPCION IS NULL THEN 
    SET mensaje=CONCAT(mensaje, 'Descripcion vacía, ');
  END IF;

  IF mensaje <> '' THEN
    SET mensaje=mensaje;
    SET error = TRUE;
    SET P_MENSAJE=mensaje;
    SET P_ERROR=error;
    SELECT mensaje,error;
    
    LEAVE SP;
  END IF;

  INSERT INTO TBL_SOLICITUDES (ID_USUARIO_EMISOR, 
                               ID_USUARIO_RECEPTOR, 
                               ID_ESTADO_SOLICITUD, 
                               DESCRIPCION,
                               FECHA)
    VALUES (P_ID_USUARIO_EMISOR,
            P_ID_USUARIO_RECEPTOR, 
            1, 
            P_DESCRIPCION,
            SYSDATE());
  COMMIT;
      
  SET mensaje='Creación exitosa';
  SET error=FALSE;
  SET P_MENSAJE=mensaje;
  SET P_ERROR=error;
  SELECT mensaje, error;

END;

#Procedimiento para Eliminar Solicitud
DROP PROCEDURE IF EXISTS `SP_ELIMINAR_SOLICITUD`;
CREATE PROCEDURE `SP_ELIMINAR_SOLICITUD`(
        IN P_ID_SOLICITUD INT(11),
  
        OUT P_MENSAJE VARCHAR(1000),
        OUT P_ERROR BOOLEAN
)
SP:BEGIN
  # Declaraciones
  DECLARE mensaje VARCHAR(1000);
  DECLARE error BOOLEAN;
  DECLARE contador INTEGER;
  # Inicializaciones
  SET mensaje='';
  SET error = FALSE;
  SET contador = 0;

  # Validaciones

  IF P_ID_SOLICITUD='' OR P_ID_SOLICITUD IS NULL THEN 
    SET mensaje=CONCAT(mensaje, 'Identificador de solicitud vacío, ');
  ELSE
    SELECT COUNT(*)  INTO contador
    FROM TBL_SOLICITUDES    
    WHERE TBL_SOLICITUDES.ID_SOLICITUD= P_ID_SOLICITUD;
    
    IF contador =0 THEN
      SET mensaje = CONCAT(mensaje,'La solicitud no existe');
    END IF;
  END IF;
  
  IF mensaje <> '' THEN
    SET mensaje=mensaje;
    SET error=TRUE;
    SET P_MENSAJE=mensaje;
    SET P_ERROR=error;
    SELECT mensaje, error;
    
    LEAVE SP;
  END IF;

  DELETE FROM TBL_SOLICITUDES
  WHERE TBL_SOLICITUDES.ID_SOLICITUD = P_ID_SOLICITUD;
  COMMIT;
      
  SET mensaje='Eliminación exitosa';
  SET error=FALSE;
  SET P_MENSAJE=mensaje;
  SET P_ERROR=error;
  SELECT mensaje, error;

END;

#Procedimiento para Actualizar Solicitud
DROP PROCEDURE IF EXISTS `SP_ACTUALIZAR_SOLICITUD`;
CREATE PROCEDURE `SP_ACTUALIZAR_SOLICITUD`(
  IN P_ID_SOLICITUD INTEGER(11),
  IN P_ID_ESTADO_SOLICITUD INTEGER(11),
  
  OUT P_MENSAJE VARCHAR(1000),
  OUT P_ERROR BOOLEAN
)
SP:BEGIN

  # Declaraciones
  DECLARE mensaje VARCHAR(1000);
  DECLARE error BOOLEAN;
  DECLARE contador INTEGER(20);

  # Inicializaciones
  SET AUTOCOMMIT=0;
  START TRANSACTION;
  SET mensaje = '';
  SET contador = 0;
  SET error =FALSE;
  
  # Validaciones
  IF P_ID_SOLICITUD ='' OR P_ID_SOLICITUD IS NULL THEN 
    SET mensaje=CONCAT(mensaje, 'Identificador de solicitud vacío, ');
  ELSE
    SELECT COUNT(*) INTO contador FROM TBL_SOLICITUDES
    WHERE P_ID_SOLICITUD = TBL_SOLICITUDES.ID_SOLICITUD;

    IF contador=0 THEN
      SET mensaje = CONCAT(mensaje, 'La solicitud no existe, ');
    END IF;
  END IF;

  IF P_ID_ESTADO_SOLICITUD='' OR P_ID_ESTADO_SOLICITUD IS NULL THEN 
    SET mensaje=CONCAT(mensaje, 'Estado solicitud vacío, ');
  END IF;

  IF mensaje <> '' THEN
    SET mensaje=mensaje;
    SET error=TRUE;
    SET P_MENSAJE=mensaje;
    SET P_ERROR=error;
    SELECT mensaje, error;
    
    LEAVE SP;
  END IF;

  UPDATE TBL_SOLICITUDES 
  SET
    TBL_SOLICITUDES.ID_ESTADO_SOLICITUD = P_ID_ESTADO_SOLICITUD
  WHERE TBL_SOLICITUDES.ID_SOLICITUD= P_ID_SOLICITUD;
  COMMIT;
    
  SET mensaje='Actualización exitosa';
  SET error=FALSE;
  SET P_MENSAJE=mensaje;
  SET P_ERROR=error;
  SELECT mensaje, error;
    
END;