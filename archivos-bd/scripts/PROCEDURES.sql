USE DB_EMANUEL;
#Procedimiento para Insertar Persona
DROP PROCEDURE IF EXISTS `SP_INSERTAR_PERSONA`;
CREATE PROCEDURE `SP_INSERTAR_PERSONA`(
  IN P_NOMBRE VARCHAR(50),
  IN P_APELLIDO VARCHAR(50),
  IN P_ID_GENERO INT,
  IN P_DIRECCION VARCHAR(300),
  IN P_EMAIL VARCHAR(100),
  IN P_IDENTIDAD VARCHAR(13),
  IN P_FECHA_NAC DATE,
  IN P_TELEFONO VARCHAR(50),
  IN P_EDAD VARCHAR(50),
  
  OUT pO_mensaje VARCHAR(1000),
  OUT pO_error BOOLEAN
)
SP:BEGIN

  # Declaraciones
  DECLARE mensaje VARCHAR(1000);
  DECLARE error BOOLEAN;
  DECLARE contador INT;
  DECLARE isTelefono BOOLEAN;
  DECLARE ultimoId INT;

  # Inicializaciones
  SET AUTOCOMMIT=0;
  START TRANSACTION;
  SET mensaje = '';
  SET isTelefono=FALSE;

  # ___________________VALIDACONES___________________________
  IF P_NOMBRE='' OR P_NOMBRE IS NULL THEN 
    SET mensaje=CONCAT(mensaje, 'Nombre vacio, ');
  END IF; 
  IF P_APELLIDO='' OR P_APELLIDO IS NULL THEN 
    SET mensaje=CONCAT(mensaje, 'Apellido vacio, ');
  END IF; 
  IF P_ID_GENERO='' OR P_ID_GENERO IS NULL THEN 
    SET mensaje=CONCAT(mensaje, 'Genero vacio, ');
  END IF;
  IF P_IDENTIDAD='' OR P_IDENTIDAD IS NULL THEN 
    SET mensaje=CONCAT(mensaje, 'Numero de identidad vacia, ');
  END IF;
  IF P_EDAD='' OR P_EDAD IS NULL THEN 
    SET mensaje=CONCAT(mensaje, 'Edad vacia, ');
  END IF;

    
  # Otras Validaciones
  # email
  IF NOT (P_EMAIL='' OR P_EMAIL IS NULL) THEN 
    IF (P_EMAIL  REGEXP '^[a-zA-Z0-9][a-zA-Z0-9._-]*@[a-zA-Z0-9][a-zA-Z0-9._-]*\\.[a-zA-Z]{2,4}$') = 0 THEN
      SET mensaje=CONCAT(mensaje, 'Correo electronico invalido, ');
    END IF;
  END IF;
  # genero
  IF NOT (P_ID_GENERO='' OR P_ID_GENERO IS NULL) THEN
    IF NOT( P_ID_GENERO = 1 OR P_ID_GENERO = 2 OR P_ID_GENERO=3) THEN
      SET mensaje=CONCAT(mensaje,'Genero invalido, ');
    END IF;
  END IF;

  # identidad
  IF NOT (P_IDENTIDAD='' OR P_IDENTIDAD IS NULL) THEN
    IF (P_IDENTIDAD REGEXP '^(0[1-9]|1[0-8])(0[1-9]|1[0-9]|2[1-8])(19|2[0-9])[0-9]{2}[0-9]{5}$' ) = 0 THEN
      SET mensaje=CONCAT(mensaje,'Numero de identidad invalido, ');
    END IF;
  END IF;

  # telefono
  IF NOT(P_TELEFONO='' OR P_TELEFONO IS NULL) THEN
    IF( P_TELEFONO REGEXP'^(2|3|8|9){1}[0-9]{3}-[0-9]{4}$')=0 THEN
      SET mensaje=CONCAT('Formato de telefono invalido, ');
    ELSE
      SET isTelefono=TRUE;
      SELECT COUNT(*) INTO contador 
      FROM TBL_PERSONAS 
      WHERE TBL_PERSONAS.TELEFONO=P_TELEFONO;
      IF contador>=1 THEN
        SET mensaje=CONCAT(mensaje,"El telefono ya existe, ");
      END IF;
    END IF;
  END IF;
  # __________________________CUERPO DEL PL______________________________________________
  # Validar que el numero de identidad no se repita 
  SELECT COUNT(*) INTO contador 
  FROM TBL_PERSONAS 
  WHERE TBL_PERSONAS.IDENTIDAD = P_IDENTIDAD;
  IF contador>=1 THEN
    SET mensaje = CONCAT(mensaje, 'El numero de identidad ya existe, ');
  END IF;

  # Validar  correo unico
  SELECT COUNT(*) INTO contador 
  FROM TBL_PERSONAS 
  WHERE TBL_PERSONAS.EMAIL = P_EMAIL;
  IF contador>=1 THEN
    SET mensaje = CONCAT(mensaje, 'El correo electronico ya existe, ');
  END IF;

  IF mensaje <> '' THEN
    SET mensaje=mensaje;
    SET error = TRUE;
    SET pO_mensaje=mensaje;
    SET pO_error=error;
    SELECT mensaje,error;
    # SELECT mensaje, resultado; #Hacer el mismo trabajo que las variables de salida
    # se llama al procedimiento con call y devuelve los valores de salida mensaje y resultado
    # siendo mensaje y resultado variable locales declare mensaje varchar(1000); 
    # declare error BOOLEAN;
    LEAVE SP;
  END IF;

  # Insert y Commit
  INSERT INTO TBL_PERSONAS (NOMBRE, 
                            APELLIDO, 
                            ID_GENERO, 
                            DIRECCION, 
                            EMAIL,
                            IDENTIDAD, 
                            FECHA_NAC,
                            TELEFONO,
                            EDAD)
    VALUES (P_NOMBRE,
            P_APELLIDO, 
            P_ID_GENERO, 
            P_DIRECCION,
            P_EMAIL, 
            P_IDENTIDAD, 
            P_FECHA_NAC,
            P_TELEFONO,
            P_EDAD);
  COMMIT;
      
  SET mensaje='Inserción exitosa';
  SET error=FALSE;
  SET pO_mensaje=mensaje;
  SET pO_error=error;
  SELECT mensaje, error;

END;

#Procedimiento para Eliminar Persona
DROP PROCEDURE IF EXISTS `SP_ELIMINAR_PERSONA`;
CREATE PROCEDURE `SP_ELIMINAR_PERSONA`(
        IN P_ID_PERSONA INT(11),
  
        OUT pO_mensaje VARCHAR(1000),
        OUT pO_error BOOLEAN
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

  # _______________________VALIDACION_____________________________________
  # Verificaciones de campos obligatorios que no esten vacios

  IF P_ID_PERSONA='' OR P_ID_PERSONA IS NULL THEN 
    SET mensaje=CONCAT(mensaje, 'Identificador de persona vacio, ');
  ELSE
    SELECT COUNT(*)  INTO contador
    FROM TBL_PERSONAS    
    WHERE TBL_PERSONAS.ID_PERSONA= P_ID_PERSONA;
    
    IF contador =0 THEN
      SET mensaje = CONCAT(mensaje,'La persona no existe');
    END IF;
  END IF;

  # ______________________CUERPO__________________________________________
  
  IF mensaje <> '' THEN
    SET mensaje=mensaje;
    SET error=TRUE;
    SET pO_mensaje=mensaje;
    SET pO_error=error;
    SELECT mensaje, error;
    LEAVE SP;
  END IF;


  DELETE FROM TBL_PERSONAS
  WHERE TBL_PERSONAS.ID_PERSONA = P_ID_PERSONA;
      
  COMMIT;

  SET mensaje='Eliminación exitosa';
  SET error=FALSE;
  SET pO_mensaje=mensaje;
  SET pO_error=error;
  SELECT mensaje, error;

END;

#Procedimiento para Actualizar Persona
DROP PROCEDURE IF EXISTS `SP_ACTUALIZAR_PERSONA`;
CREATE PROCEDURE `SP_ACTUALIZAR_PERSONA`(
  IN P_ID_PERSONA INTEGER(11),
  IN P_NOMBRE VARCHAR(50),
  IN P_APELLIDO VARCHAR(50),
  IN P_ID_GENERO VARCHAR(1),
  IN P_DIRECCION VARCHAR(300),
  IN P_EMAIL VARCHAR(100),
  IN P_IDENTIDAD VARCHAR(13),
  IN P_FECHA_NAC DATE,
  IN P_TELEFONO VARCHAR(50),
  
  OUT pO_mensaje VARCHAR(1000),
  OUT pO_error BOOLEAN
)
SP:BEGIN

  # Declaraciones
  DECLARE mensaje VARCHAR(1000);
  DECLARE error BOOLEAN;
  DECLARE contador INTEGER(20);
  DECLARE uEstado VARCHAR(1);
  DECLARE isTelefono BOOLEAN;
  DECLARE idTelefono INT;

  # Inicializaciones
  SET AUTOCOMMIT=0;
  START TRANSACTION;
  SET mensaje = '';
  SET contador =0;
  SET error =FALSE;
  SET uEstado='A';
  SET isTelefono=FALSE;
  
  # ___________________VALIDACIONES___________________________________
  IF P_ID_PERSONA ='' OR P_ID_PERSONA IS NULL THEN 
    SET mensaje=CONCAT(mensaje, 'Identificador de persona vacio, ');
  ELSE
    SELECT COUNT(*) INTO contador FROM TBL_PERSONAS
    WHERE P_ID_PERSONA = TBL_PERSONAS.ID_PERSONA;

    IF contador=0 THEN
      SET mensaje = CONCAT(mensaje, 'La persona no existe, ');
    END IF;
  END IF;

  IF P_NOMBRE='' OR P_NOMBRE IS NULL THEN 
    SET mensaje=CONCAT(mensaje, 'Nombre vacio, ');
  END IF; 

  IF P_APELLIDO='' OR P_APELLIDO IS NULL THEN 
    SET mensaje=CONCAT(mensaje, 'Apellido vacio, ');
  END IF;
  
  IF P_IDENTIDAD='' OR P_IDENTIDAD IS NULL THEN 
    SET mensaje=CONCAT(mensaje, 'Numero de identidad vacia, ');
  END IF; 

  IF P_ID_GENERO='' OR P_ID_GENERO IS NULL THEN 
    SET mensaje=CONCAT(mensaje, 'Genero vacio, ');
  ELSE
    IF NOT( P_ID_GENERO = 1 OR P_ID_GENERO = 2 OR P_ID_GENERO=3 ) THEN
      SET mensaje=CONCAT(mensaje,'Genero invalido, ');
    END IF;
  END IF;
  

  # Otras Validaciones
  # identidad
  IF NOT(P_IDENTIDAD='' OR P_IDENTIDAD IS NULL) THEN
    IF (P_IDENTIDAD REGEXP '^(0[1-9]|1[0-8])(0[1-9]|1[0-9]|2[1-8])(19|2[0-9])[0-9]{2}[0-9]{5}$' ) = 0 THEN
      SET mensaje=CONCAT(mensaje,'Numero de identidad invalido, ');
    END IF;
  END IF;

  IF mensaje <> '' THEN
    SET mensaje=mensaje;
    SET error=TRUE;
    SET pO_mensaje=mensaje;
    SET pO_error=error;
    SELECT mensaje, error;
    LEAVE SP;
  END IF;

  # email
  IF NOT (P_EMAIL='' OR P_EMAIL IS NULL) THEN 
    IF (P_EMAIL  REGEXP '^[a-zA-Z0-9][a-zA-Z0-9._-]*@[a-zA-Z0-9][a-zA-Z0-9._-]*\\.[a-zA-Z]{2,4}$') = 0 THEN
      SET mensaje=CONCAT(mensaje, 'Correo electronico invalido, ');
    ELSE
      # verificar email valido para actualizacion(Pertenezca a la misma persona o no este en la db)
      SELECT COUNT(*) INTO contador FROM TBL_PERSONAS
      WHERE TBL_PERSONAS.ID_PERSONA=P_ID_PERSONA 
      AND TBL_PERSONAS.EMAIL = P_EMAIL; 
      IF contador=0 THEN
        SELECT COUNT(*) INTO contador FROM TBL_PERSONAS
        WHERE TBL_PERSONAS.EMAIL=P_EMAIL 
        AND TBL_PERSONAS.ID_PERSONA<>P_ID_PERSONA;
        IF contador>=1 THEN 
          SET mensaje=CONCAT(mensaje,'El correo electronico a actualizar ya existe, ');
        END IF;  
      END IF;
    END IF;
  END IF;
  
  # verificar numero de identidad valido para actualizacion(Pertenesca a la misma persona o no este en la db)
  SELECT COUNT(*) INTO contador FROM TBL_PERSONAS
  WHERE TBL_PERSONAS.ID_PERSONA=P_ID_PERSONA 
  AND P_IDENTIDAD = TBL_PERSONAS.IDENTIDAD; 
  IF contador=0 THEN
    SELECT COUNT(*) INTO contador FROM TBL_PERSONAS
    WHERE TBL_PERSONAS.IDENTIDAD=P_IDENTIDAD 
    AND TBL_PERSONAS.ID_PERSONA<>P_ID_PERSONA;
    IF contador>=1 THEN 
      SET mensaje=CONCAT(mensaje,'El numero de identidad a actualizar ya existe');
    END IF;  
  END IF;

  IF NOT(P_TELEFONO='' OR P_TELEFONO IS NULL) THEN
    IF( P_TELEFONO REGEXP'^(2|3|6|7|8|9){1}[0-9]{3}-[0-9]{4}$')=0 THEN
      SET mensaje=CONCAT(mensaje,'Formato del telefono invalido, ');
    ELSE
      SELECT COUNT(*) INTO contador FROM TBL_PERSONAS
      WHERE TBL_PERSONAS.TELEFONO=P_TELEFONO AND TBL_PERSONAS.ID_PERSONA = P_ID_PERSONA;
      IF contador=0 THEN
      SELECT COUNT(*) INTO contador FROM TBL_PERSONAS
      WHERE TBL_PERSONAS.TELEFONO=P_TELEFONO AND TBL_PERSONAS.ID_PERSONA<>P_ID_PERSONA;
        IF contador>=1 THEN 
          SET mensaje=CONCAT(mensaje,'El numero de telefono a actualizar ya existe');
        ELSE
          SET isTelefono=TRUE;
        END IF;  
      END IF;
    END IF;    
  END IF;

  IF mensaje <> '' THEN
    SET mensaje=mensaje;
    SET error = TRUE;
    SET pO_mensaje=mensaje;
    SET pO_error=error;
    SELECT mensaje, error;
    LEAVE SP;
  END IF;

  UPDATE TBL_PERSONAS 
  SET
    TBL_PERSONAS.NOMBRE = P_NOMBRE,
    TBL_PERSONAS.APELLIDO = P_APELLIDO, 
    TBL_PERSONAS.DIRECCION = P_DIRECCION, 
    TBL_PERSONAS.EMAIL = P_EMAIL,
    TBL_PERSONAS.IDENTIDAD = P_IDENTIDAD, 
    TBL_PERSONAS.FECHA_NAC = P_FECHA_NAC
  WHERE TBL_PERSONAS.ID_PERSONA= P_ID_PERSONA;
  COMMIT;
    
  SET mensaje='Actualización exitosa';
  SET error=FALSE;
  SET pO_mensaje=mensaje;
  SET pO_error=error;
  SELECT mensaje, error;
    
END;

#Procedimiento para Insertar Usuario
DROP PROCEDURE IF EXISTS `SP_INSERTAR_USUARIO`;
CREATE PROCEDURE `SP_INSERTAR_USUARIO`(
  IN P_ID_TIPO_USUARIO INTEGER(11),
  IN P_USUARIO VARCHAR(150),
  IN P_CONTRASEÑA VARCHAR(50),
  IN P_FECHA_REGISTRO DATE,
  
  OUT pO_mensaje VARCHAR(1000),
  OUT pO_error BOOLEAN
)
  SP:BEGIN
  # Declaraciones
  DECLARE mensaje VARCHAR(255);
  DECLARE error BOOLEAN;
  DECLARE contador INTEGER;

  # Inicializaciones
  SET AUTOCOMMIT=0;
  START TRANSACTION;
  SET mensaje='';
  SET contador = 0;
  SET error=FALSE;
  
  # Verificaciones de campos obligatorios que no esten vacios
  # __________________________VALIDACIONES___________________
  IF P_ID_TIPO_USUARIO='' OR P_ID_TIPO_USUARIO IS NULL THEN 
    SET mensaje=CONCAT(mensaje, 'Tipo Usuario vacio, ');
  END IF;

  IF P_FECHA_REGISTRO='' OR P_FECHA_REGISTRO IS NULL THEN 
    SET mensaje=CONCAT(mensaje, 'Fecha de registro vacia, ');
  END IF;

  IF P_USUARIO='' OR P_USUARIO IS NULL THEN 
    SET mensaje=CONCAT(mensaje, 'Usuario vacio, ');
  END IF;

  IF P_CONTRASEÑA='' OR P_CONTRASEÑA IS NULL THEN 
    SET mensaje=CONCAT(mensaje, 'Contraseña vacia, ');
  END IF;
   
  IF mensaje <> '' THEN
    SET error = TRUE;
    SET mensaje=mensaje;
    SET pO_mensaje=mensaje;
    SET pO_error=error;
    SELECT mensaje,error;
    LEAVE SP;
  END IF;

  INSERT INTO TBL_USUARIOS( ID_TIPO_USUARIO, 
                            USUARIO,
                            CONTRASEÑA,
                            FECHA_REGISTRO) 
    VALUES( P_ID_TIPO_USUARIO,
            P_USUARIO,
            P_CONTRASEÑA,
            P_FECHA_REGISTRO);
  COMMIT;

  SET mensaje='Inserción exitosa';
  SET error = FALSE;
  SET pO_mensaje=mensaje;
  SET pO_error=error;
  SELECT mensaje,error;

END ;


#Procedimiento para Insertar Empleado
DROP PROCEDURE IF EXISTS `SP_INSERTAR_EMPLEADO`;
CREATE PROCEDURE `SP_INSERTAR_EMPLEADO`(
  IN P_NOMBRE VARCHAR(50),
  IN P_APELLIDO VARCHAR(50),
  IN P_ID_GENERO INT,
  IN P_DIRECCION VARCHAR(300),
  IN P_EMAIL VARCHAR(100),
  IN P_IDENTIDAD VARCHAR(13),
  IN P_FECHA_NAC DATE,
  IN P_TELEFONO VARCHAR(50),
  IN P_EDAD VARCHAR(50),
  OUT pO_mensaje VARCHAR(1000),
  OUT pO_error BOOLEAN
)
  SP:BEGIN
  # Declaraciones
  DECLARE mensaje VARCHAR(255);
  DECLARE error BOOLEAN;
  DECLARE contador INTEGER;
  DECLARE ultimoIdPersona INTEGER;
  DECLARE ultimoIdUsuario INTEGER;

  # Inicializaciones
  SET AUTOCOMMIT=0;
  START TRANSACTION;
  SET mensaje='';
  SET contador = 0;
  SET error=FALSE;
  
  # Verificaciones de campos obligatorios que no esten vacios
  # __________________________VALIDACIONES___________________
  IF P_TELEFONO='' OR P_TELEFONO IS NULL THEN 
    SET mensaje=CONCAT(mensaje, 'Telefono vacio, ');
  END IF;

  IF P_FECHA_NAC='' OR P_FECHA_NAC IS NULL THEN 
    SET mensaje=CONCAT(mensaje, 'Fecha de nacimiento vacia, ');
  END IF;

  IF P_DIRECCION='' OR P_DIRECCION IS NULL THEN 
    SET mensaje=CONCAT(mensaje, 'Direccion vacia, ');
  END IF;

  IF P_EMAIL='' OR P_EMAIL IS NULL THEN 
    SET mensaje=CONCAT(mensaje, 'Correo electronico vacio, ');
  END IF;
   
  IF mensaje <> '' THEN
    SET error = TRUE;
    SET mensaje=mensaje;
    SET pO_mensaje=mensaje;
    SET pO_error=error;
    SELECT mensaje,error;
    LEAVE SP;
  END IF;


  CALL SP_INSERTAR_PERSONA( P_NOMBRE,
                            P_APELLIDO,
                            P_ID_GENERO,
                            P_DIRECCION,
                            P_EMAIL,
                            P_IDENTIDAD,
                            P_FECHA_NAC,
                            P_TELEFONO,
                            P_EDAD,
                            @mensajeInsertarPersonaEmpleado,
                            @errorInsertarPesonaEmpleado                           
  );
    
  IF @errorInsertarPesonaEmpleado THEN
    SET mensaje = @mensajeInsertarPersonaEmpleado;
    SET error=TRUE;
    SET pO_mensaje=mensaje;
    SET pO_error=error;
    SELECT mensaje,error;
    LEAVE SP;
  END IF;

  CALL SP_INSERTAR_USUARIO( 2,
                            CONCAT(P_NOMBRE, P_APELLIDO),
                            'asd.456',
                            SYSDATE(),
                            @mensajeInsertarUsuarioEmpleado,
                            @errorInsertarUsuarioEmpleado                           
  );
    
  IF @errorInsertarUsuarioEmpleado THEN
    SET mensaje = @mensajeInsertarUsuarioEmpleado;
    SET error=TRUE;
    SET pO_mensaje=mensaje;
    SET pO_error=error;
    SELECT mensaje,error;
    
    SELECT MAX(ID_PERSONA) INTO ultimoIdPersona FROM TBL_PERSONAS;
    CALL SP_ELIMINAR_PERSONA( ultimoIdPersona,
                              @mensajeEliminarPersonaEmpleado,
                              @errorEliminarPersonaEmpleado
    );

    LEAVE SP;
  END IF;
  # Ultimo id persona + Ultimo id usuario + Insercion de empleado

  SELECT MAX(ID_PERSONA) INTO ultimoIdPersona FROM TBL_PERSONAS;

  SELECT MAX(ID_USUARIO) INTO ultimoIdUsuario FROM TBL_USUARIOS;

  INSERT INTO TBL_EMPLEADO( ID_PERSONA, 
                            ID_USUARIO,
                            FECHA_INGRESO) 
    VALUES( ultimoIdPersona,
            ultimoIdUsuario,
            SYSDATE());
  COMMIT;

  SET mensaje='Inserción exitosa';
  SET error = FALSE;
  SET pO_mensaje=mensaje;
  SET pO_error=error;
  SELECT mensaje,error;

END ;

#Procedimiento para Eliminar Empleado
DROP PROCEDURE IF EXISTS `SP_ELIMINAR_EMPLEADO`;
CREATE PROCEDURE `SP_ELIMINAR_EMPLEADO`(
  IN P_ID_EMPLEADO INTEGER(11),

  OUT pO_mensaje VARCHAR(1000),
  OUT pO_error BOOLEAN
)
SP:BEGIN
  # DECLARE
  DECLARE mensaje VARCHAR(1000);
  DECLARE contador INTEGER(20);
  DECLARE error BOOLEAN;
  DECLARE idPersona INTEGER(11);

  # Inicializaciones
  SET AUTOCOMMIT=0;
  START TRANSACTION;
  SET mensaje = '';
  SET contador = 0;
  SET error = FALSE;
  # _______________________VALIDACION DE CAMPOS____________________________
  # Verificaciones de campos obligatorios que no esten vacios
  IF P_ID_EMPLEADO='' OR P_ID_EMPLEADO IS NULL THEN 
    SET mensaje=CONCAT('Identificador de empleado vacio, ');
  ELSE
    SELECT COUNT(*) INTO contador
    FROM TBL_EMPLEADO
    WHERE TBL_EMPLEADO.ID_EMPLEADO = P_ID_EMPLEADO;
    
    IF contador=0 THEN  
      SET mensaje ='El empleado no existe';
    END IF;
  END IF;    
  
  IF mensaje <> '' THEN
    SET mensaje=mensaje;
    SET error=TRUE;
    SET pO_mensaje=mensaje;
    SET pO_error=error;
    SELECT mensaje, error;
    LEAVE SP;
  END IF;

  SELECT ID_PERSONA INTO idPersona
  FROM TBL_EMPLEADO
  WHERE TBL_EMPLEADO.ID_EMPLEADO = P_ID_EMPLEADO;

  CALL SP_ELIMINAR_PERSONA( idPersona,
                            @mensajeEliminarPersonaEmpleado,
                            @errorEliminarPersonaEmpleado
                            );
  IF @errorEliminarPersonaEmpleado THEN
    SET mensaje=@mensajeEliminarPersonaEmpleado;
    SET error=TRUE;
    SET pO_mensaje=mensaje;
    SET pO_error=error;
    SELECT mensaje,error;
    LEAVE SP;
  END IF;

  DELETE FROM TBL_EMPLEADO
  WHERE TBL_EMPLEADO.ID_EMPLEADO = P_ID_EMPLEADO;
  COMMIT;

  SET mensaje='Eliminación exitosa';
  SET error=FALSE;
  SET pO_mensaje=mensaje;
  SET pO_error=error;
  SELECT mensaje, error;
  
END;

#Procedimiento para Actualizar Empleado
DROP PROCEDURE IF EXISTS `SP_ACTUALIZAR_EMPLEADO`;
CREATE PROCEDURE `SP_ACTUALIZAR_EMPLEADO`(
  IN P_ID_EMPLEADO INTEGER(11),
  IN P_NOMBRE VARCHAR(50),
  IN P_APELLIDO VARCHAR(50),
  IN P_GENERO VARCHAR(1),
  IN P_DIRECCION VARCHAR(300),
  IN P_EMAIL VARCHAR(100),
  IN P_IDENTIDAD VARCHAR(13),
  IN P_FECHA_NAC DATE,
  IN P_TELEFONO VARCHAR(50),
  IN P_EDAD VARCHAR(50),
  
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
  IF P_ID_EMPLEADO='' OR P_ID_EMPLEADO IS NULL THEN 
    SET mensaje=CONCAT(mensaje, 'Identificador de empleado vacio, ');
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
  FROM TBL_EMPLEADO
  WHERE TBL_EMPLEADO.ID_EMPLEADO = P_ID_EMPLEADO;

  IF contador=0 THEN  
      SET mensaje = CONCAT(mensaje, 'El empleado no existe, ');
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

  SELECT ID_PERSONA INTO idPersona 
  FROM TBL_EMPLEADO 
  WHERE TBL_EMPLEADO.ID_EMPLEADO=P_ID_EMPLEADO;
  
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
  
  SET mensaje='Actualización exitosa';
  SET error=FALSE;
  SET pO_mensaje=mensaje;
  SET pO_error=error;
  SELECT mensaje,error;
  
END;


#Procedimiento para Actualizar Perfil de un Empleado
DROP PROCEDURE IF EXISTS `SP_ACTUALIZAR_PERFIL`;
CREATE PROCEDURE `SP_ACTUALIZAR_PERFIL`(
  IN P_ID_EMPLEADO INTEGER(11),
  IN P_EMAIL VARCHAR(100),
  IN P_TELEFONO VARCHAR(50),
  IN P_DIRECCION VARCHAR(50),

  OUT pO_mensaje VARCHAR(1000),
  OUT pO_error BOOLEAN
)
SP:BEGIN
  # DECLARE
  DECLARE mensaje VARCHAR(1000);
  DECLARE contador INTEGER(20);
  DECLARE error BOOLEAN;
  DECLARE idTelefono INT;
  DECLARE idPersona INT;

  DECLARE EXIT HANDLER FOR SQLEXCEPTION
  BEGIN
    ROLLBACK ;
    SET mensaje = 'Error';
    SET error = 1;
    SELECT mensaje, error;
  END;

  # Inicializaciones
  SET AUTOCOMMIT=0;
  START TRANSACTION;
  SET mensaje = '';
  SET contador = 0;
  SET error = FALSE;
  # _______________________VALIDACION DE CAMPOS____________________________
  # Verificaciones de campos obligatorios que no esten vacios
  IF P_ID_EMPLEADO='' OR P_ID_EMPLEADO IS NULL THEN
    SET mensaje=CONCAT('Identificador de empleado vacio, ');
  ELSE
    SELECT COUNT(*) INTO contador
    FROM TBL_EMPLEADO
    WHERE TBL_EMPLEADO.ID_EMPLEADO = P_ID_EMPLEADO;

    IF contador=0 THEN
      SET mensaje ='El empleado no existe';
    END IF;
  END IF;

  IF P_DIRECCION='' OR P_DIRECCION IS NULL THEN 
    SET mensaje=CONCAT(mensaje, 'Direccion vacia, ');
  END IF;

  IF P_EMAIL = '' OR P_EMAIL IS NULL THEN
    SET mensaje=CONCAT(mensaje, 'Correo electrónico vacío, ');
  END IF;

  IF mensaje <> '' THEN
    SET mensaje=mensaje;
    SET error=TRUE;
    SET pO_mensaje=mensaje;
    SET pO_error=error;
    SELECT mensaje, error;
    LEAVE SP;
  END IF;

  SELECT ID_PERSONA INTO idPersona 
  FROM TBL_EMPLEADO 
  WHERE TBL_EMPLEADO.ID_EMPLEADO = P_ID_EMPLEADO;

  UPDATE TBL_PERSONAS 
  SET TBL_PERSONAS.EMAIL = P_EMAIL,
      TBL_PERSONAS.TELEFONO = P_TELEFONO,
      TBL_PERSONAS.DIRECCION = P_DIRECCION
  WHERE TBL_PERSONAS.ID_PERSONA = idPersona;

  COMMIT;
  
  SET mensaje='Actualización de Perfil exitosa';
  SET error=FALSE;
  SET pO_mensaje=mensaje;
  SET pO_error=error;
  SELECT mensaje,error;
  LEAVE SP;
  
END;