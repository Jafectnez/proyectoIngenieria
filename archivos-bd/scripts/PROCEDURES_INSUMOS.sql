USE DB_EMANUEL;
#Procedimiento para Insertar Insumo
DROP PROCEDURE IF EXISTS `SP_INSERTAR_INSUMO`;
CREATE PROCEDURE `SP_INSERTAR_INSUMO`(
  IN P_ID_TIPO_INSUMO INT(11),
  IN P_ID_PROVEEDOR INT(11),
  IN P_INSUMO VARCHAR(50),
  IN P_DESCRIPCION VARCHAR(300),
  IN P_PRECIO_COSTO FLOAT(20),
  IN P_CANTIDAD INT,
  IN P_FECHA_INGRESO DATE,
  IN P_FECHA_VENC DATE,
  
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
  IF P_ID_TIPO_INSUMO='' OR P_ID_TIPO_INSUMO IS NULL THEN 
    SET mensaje=CONCAT(mensaje, 'Tipo de insumo vacío, ');
  END IF;

  IF P_ID_PROVEEDOR ='' OR P_ID_PROVEEDOR IS NULL THEN 
    SET mensaje=CONCAT(mensaje, 'Identificador del proveedor vacío, ');
  ELSE
    SELECT COUNT(*) INTO contador FROM TBL_PROVEEDORES
    WHERE P_ID_PROVEEDOR = TBL_PROVEEDORES.ID_PROVEEDOR;

    IF contador=0 THEN
      SET mensaje = CONCAT(mensaje, 'El proveedor no existe, ');
    END IF;
  END IF;

  IF P_DESCRIPCION='' OR P_DESCRIPCION IS NULL THEN 
    SET mensaje=CONCAT(mensaje, 'Descripcion vacía, ');
  END IF;

  IF P_PRECIO_COSTO='' OR P_PRECIO_COSTO IS NULL THEN 
    SET mensaje=CONCAT(mensaje, 'Precio de costo vacío, ');
  END IF;

  IF P_CANTIDAD='' OR P_CANTIDAD IS NULL THEN 
    SET mensaje=CONCAT(mensaje, 'Cantidad vacía, ');
  END IF;

  IF P_FECHA_INGRESO ='' OR P_FECHA_INGRESO IS NULL THEN 
    SET mensaje=CONCAT(mensaje, 'Fecha de ingreso vacía, ');
  ELSE 
    IF P_FECHA_INGRESO > SYSDATE() THEN
      SET mensaje=CONCAT(mensaje, 'Fecha de ingreso es superior a la fecha actual, ');
    END IF;
  END IF;

  IF P_FECHA_VENC ='' OR P_FECHA_VENC IS NULL THEN 
    SET mensaje=CONCAT(mensaje, 'Fecha de vencimiento vacía, ');
  ELSE 
    IF P_FECHA_VENC < SYSDATE() THEN
      SET mensaje=CONCAT(mensaje, 'Fecha de vencimiento es inferior a la fecha actual, ');
    END IF;
  END IF;

  IF mensaje <> '' THEN
    SET mensaje=mensaje;
    SET error = TRUE;
    SET P_MENSAJE=mensaje;
    SET P_ERROR=error;
    SELECT mensaje,error;
    
    LEAVE SP;
  END IF;

  INSERT INTO TBL_INSUMOS (ID_TIPO_INSUMO, 
                           ID_PROVEEDOR, 
                           INSUMO, 
                           DESCRIPCION,
                           PRECIO_COSTO,
                           CANTIDAD,
                           FECHA_INGRESO,
                           FECHA_VENC)
    VALUES (P_ID_TIPO_INSUMO,
            P_ID_PROVEEDOR, 
            P_INSUMO,
            P_DESCRIPCION,
            P_PRECIO_COSTO,
            P_CANTIDAD,
            P_FECHA_INGRESO,
            P_FECHA_VENC);

  INSERT INTO TBL_BITACORA(ID_USUARIO,
                           DESCRIPCION,
                           FECHA)
    VALUES (1,
            CONCAT('Se creó un nuevo insumo: ', P_INSUMO),
            SYSDATE());
  COMMIT;
      
  SET mensaje='Creación exitosa';
  SET error=FALSE;
  SET P_MENSAJE=mensaje;
  SET P_ERROR=error;
  SELECT mensaje, error;

END;

#Procedimiento para Disminuir Solicitud
DROP PROCEDURE IF EXISTS `SP_DISMINUIR_INSUMO`;
CREATE PROCEDURE `SP_DISMINUIR_INSUMO`(
        IN P_ID_INSUMO INT(11),
        IN P_CANTIDAD INT(11),
  
        OUT P_MENSAJE VARCHAR(1000),
        OUT P_ERROR BOOLEAN
)
SP:BEGIN
  # Declaraciones
  DECLARE mensaje VARCHAR(1000);
  DECLARE error BOOLEAN;
  DECLARE contador INTEGER;
  DECLARE total INTEGER;
  # Inicializaciones
  SET mensaje='';
  SET error = FALSE;
  SET contador = 0;
  SET total = 0;

  # Validaciones

  IF P_ID_INSUMO='' OR P_ID_INSUMO IS NULL THEN 
    SET mensaje=CONCAT(mensaje, 'Identificador de insumo vacío, ');
  ELSE
    SELECT COUNT(*)  INTO contador
    FROM TBL_INSUMOS    
    WHERE TBL_INSUMOS.ID_INSUMO= P_ID_INSUMO;
    
    IF contador = 0 THEN
      SET mensaje = CONCAT(mensaje,'El insumo no existe');
    END IF;
  END IF;

  SELECT CANTIDAD INTO contador
  FROM TBL_INSUMOS
  WHERE TBL_INSUMOS.ID_INSUMO = P_ID_INSUMO;

  SET total = contador - P_CANTIDAD;
  IF total < 0 THEN
    SET mensaje = CONCAT(mensaje,'No hay existencias suficientes para disminuir');
  END IF;
  
  IF mensaje <> '' THEN
    SET mensaje=mensaje;
    SET error=TRUE;
    SET P_MENSAJE=mensaje;
    SET P_ERROR=error;
    SELECT mensaje, error;
    
    LEAVE SP;
  END IF;

  IF total <= 5 THEN
    SET mensaje = CONCAT(mensaje,'El insumo tiene pocas cantidades ');
  END IF;

  UPDATE TBL_INSUMOS 
  SET 
    TBL_INSUMOS.CANTIDAD = total
  WHERE TBL_INSUMOS.ID_INSUMO = P_ID_INSUMO;

  INSERT INTO TBL_BITACORA(ID_USUARIO,
                           DESCRIPCION,
                           FECHA)
    VALUES (1,
            CONCAT('Se disminuyó el insumo ', P_INSUMO,' en', P_CANTIDAD),
            SYSDATE());
  COMMIT;
      
  SET mensaje= CONCAT(mensaje,'Disminución exitosa');
  SET error=FALSE;
  SET P_MENSAJE=mensaje;
  SET P_ERROR=error;
  SELECT mensaje, error;

END;

#Procedimiento para Actualizar Insumo
DROP PROCEDURE IF EXISTS `SP_ACTUALIZAR_INSUMO`;
CREATE PROCEDURE `SP_ACTUALIZAR_INSUMO`(
  IN P_ID_INSUMO INTEGER(11),
  IN P_ID_TIPO_INSUMO INT(11),
  IN P_ID_PROVEEDOR INT(11),
  IN P_INSUMO VARCHAR(50),
  IN P_DESCRIPCION VARCHAR(300),
  IN P_PRECIO_COSTO FLOAT(20),
  IN P_CANTIDAD INT,
  IN P_FECHA_INGRESO DATE,
  IN P_FECHA_VENC DATE,
  
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
  IF P_ID_INSUMO ='' OR P_ID_INSUMO IS NULL THEN 
    SET mensaje=CONCAT(mensaje, 'Identificador del insumo vacío, ');
  ELSE
    SELECT COUNT(*) INTO contador FROM TBL_INSUMOS
    WHERE P_ID_INSUMO = TBL_INSUMOS.ID_INSUMO;

    IF contador=0 THEN
      SET mensaje = CONCAT(mensaje, 'El insumo no existe, ');
    END IF;
  END IF;

  IF P_ID_TIPO_INSUMO='' OR P_ID_TIPO_INSUMO IS NULL THEN 
    SET mensaje=CONCAT(mensaje, 'Tipo de insumo vacío, ');
  END IF;

  IF P_ID_PROVEEDOR ='' OR P_ID_PROVEEDOR IS NULL THEN 
    SET mensaje=CONCAT(mensaje, 'Identificador del proveedor vacío, ');
  ELSE
    SELECT COUNT(*) INTO contador FROM TBL_PROVEEDORES
    WHERE P_ID_PROVEEDOR = TBL_PROVEEDORES.ID_PROVEEDOR;

    IF contador=0 THEN
      SET mensaje = CONCAT(mensaje, 'El proveedor no existe, ');
    END IF;
  END IF;

  IF P_DESCRIPCION='' OR P_DESCRIPCION IS NULL THEN 
    SET mensaje=CONCAT(mensaje, 'Descripcion vacía, ');
  END IF;

  IF P_PRECIO_COSTO='' OR P_PRECIO_COSTO IS NULL THEN 
    SET mensaje=CONCAT(mensaje, 'Precio de costo vacío, ');
  END IF;

  IF P_CANTIDAD='' OR P_CANTIDAD IS NULL THEN 
    SET mensaje=CONCAT(mensaje, 'Cantidad vacía, ');
  END IF;

  IF P_FECHA_INGRESO ='' OR P_FECHA_INGRESO IS NULL THEN 
    SET mensaje=CONCAT(mensaje, 'Fecha de ingreso vacía, ');
  ELSE 
    IF P_FECHA_INGRESO > SYSDATE() THEN
      SET mensaje=CONCAT(mensaje, 'Fecha de ingreso es superior a la fecha actual, ');
    END IF;
  END IF;

  IF P_FECHA_VENC ='' OR P_FECHA_VENC IS NULL THEN 
    SET mensaje=CONCAT(mensaje, 'Fecha de vencimiento vacía, ');
  ELSE 
    IF P_FECHA_VENC < SYSDATE() THEN
      SET mensaje=CONCAT(mensaje, 'Fecha de vencimiento es inferior a la fecha actual, ');
    END IF;
  END IF;

  IF mensaje <> '' THEN
    SET mensaje=mensaje;
    SET error = TRUE;
    SET P_MENSAJE=mensaje;
    SET P_ERROR=error;
    SELECT mensaje,error;
    
    LEAVE SP;
  END IF;

  UPDATE TBL_INSUMOS 
  SET
    TBL_INSUMOS.ID_TIPO_INSUMO = P_ID_TIPO_INSUMO,
    TBL_INSUMOS.ID_PROVEEDOR = P_ID_PROVEEDOR,
    TBL_INSUMOS.INSUMO = P_INSUMO, 
    TBL_INSUMOS.DESCRIPCION = P_DESCRIPCION, 
    TBL_INSUMOS.PRECIO_COSTO = P_PRECIO_COSTO, 
    TBL_INSUMOS.CANTIDAD = P_CANTIDAD, 
    TBL_INSUMOS.FECHA_INGRESO = P_FECHA_INGRESO,
    TBL_INSUMOS.FECHA_VENC = P_FECHA_VENC
  WHERE TBL_INSUMOS.ID_INSUMO= P_ID_INSUMO;

  INSERT INTO TBL_BITACORA(ID_USUARIO,
                           DESCRIPCION,
                           FECHA)
    VALUES (1,
            CONCAT('Se actulizó el insumo ', P_INSUMO),
            SYSDATE());
  COMMIT;
  COMMIT;
    
  SET mensaje='Actualización exitosa';
  SET error=FALSE;
  SET P_MENSAJE=mensaje;
  SET P_ERROR=error;
  SELECT mensaje, error;
    
END;