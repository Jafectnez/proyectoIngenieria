#Este Trigger crea un registro cada vez que un empleado nuevo es creado

DROP TRIGGER IF EXISTS `REGISTRO_BITACORA__EMPLEADO_CREADO`;
CREATE DEFINER=`root`@`localhost` TRIGGER `REGISTRO_BITACORA__EMPLEADO_CREADO` AFTER INSERT ON `tbl_empleado` 
FOR EACH ROW 
  INSERT INTO tbl_bitacora(ID_USUARIO, DESCRIPCION, FECHA) 
  VALUES(1, CONCAT('Se registró un empleado con código: ', NEW.ID_EMPLEADO), SYSDATE());

#Este Trigger crea un registro cada vez que un empleado es actualizado

DROP TRIGGER IF EXISTS `REGISTRO_BITACORA__EMPLEADO_ACTUALIZADO`;
CREATE TRIGGER `REGISTRO_BITACORA__EMPLEADO_ACTUALIZADO` AFTER UPDATE ON `tbl_personas`
 FOR EACH ROW BEGIN
DECLARE cambios varchar(500);

SET @cambios := CONCAT('Se actualizó el empleado ', NEW.NOMBRE);

IF OLD.NOMBRE != NEW.NOMBRE THEN
	SET @cambios := CONCAT(@cambios, ' Se cambió el nombre del empleado de ', OLD.NOMBRE, ' a: ', NEW.NOMBRE);
END IF;

IF OLD.APELLIDO != NEW.APELLIDO THEN
	SET @cambios := CONCAT(@cambios, ' Se cambió el apellido del empleado de ', OLD.APELLIDO, ' a: ', NEW.APELLIDO);
END IF;

IF OLD.ID_GENERO != NEW.ID_GENERO THEN
	SET @cambios := CONCAT(@cambios, ' Se cambió el genero del empleado de ', OLD.ID_GENERO, ' a: ', NEW.ID_GENERO);
END IF;

IF OLD.DIRECCION != NEW.DIRECCION THEN
	SET @cambios := CONCAT(@cambios, ' Se cambió la dirección del empleado de ', OLD.DIRECCION, ' a: ', NEW.DIRECCION);
END IF;

IF OLD.EDAD != NEW.EDAD THEN
	SET @cambios := CONCAT(@cambios, ' Se cambió la edad del empleado de ', OLD.EDAD, ' a: ', NEW.EDAD);
END IF;

IF OLD.TELEFONO != NEW.TELEFONO THEN
	SET @cambios := CONCAT(@cambios, ' Se cambió el telefono del empleado de ', OLD.TELEFONO, ' a: ', NEW.TELEFONO);
END IF;

IF OLD.EMAIL != NEW.EMAIL THEN
	SET @cambios := CONCAT(@cambios, ' Se cambió el correo electrónico del empleado de ', OLD.EMAIL, ' a: ', NEW.EMAIL);
END IF;

IF OLD.FECHA_NAC != NEW.FECHA_NAC THEN
	SET @cambios := CONCAT(@cambios, ' Se cambió la fecha de nacimiento del empleado de ', OLD.FECHA_NAC, ' a: ', NEW.FECHA_NAC);
END IF;

IF OLD.IDENTIDAD != NEW.IDENTIDAD THEN
	SET @cambios := CONCAT(@cambios, ' Se cambió la identidad del empleado de ', OLD.IDENTIDAD, ' a: ', NEW.IDENTIDAD);
END IF;

INSERT INTO tbl_bitacora(ID_USUARIO,
                         DESCRIPCION,
                         FECHA)
	VALUE(1,
          @cambios,
          SYSDATE());
          
END;

#Este Trigger crea un registro cada vez que un empleado es eliminado

DROP TRIGGER IF EXISTS `REGISTRO_BITACORA__EMPLEADO_ELIMINADO`;
CREATE DEFINER=`root`@`localhost` TRIGGER `REGISTRO_BITACORA__EMPLEADO_ELIMINADO` AFTER DELETE ON `tbl_empleado` 
FOR EACH ROW 
BEGIN
DECLARE
empleado VARCHAR(50);

SET @empleado := '';

SELECT NOMBRE INTO @empleado
FROM tbl_personas
WHERE tbl_personas.ID_PERSONA = OLD.ID_PERSONA;

INSERT INTO tbl_bitacora(ID_USUARIO, DESCRIPCION, FECHA) 
  VALUES(1, CONCAT('Se eliminó un empleado con nombre: ', @empleado), SYSDATE());
END

#Este Trigger crea un registro cada vez que un usuario es actualizado

DROP TRIGGER IF EXISTS `REGISTRO_BITACORA__USUARIO_ACTUALIZADO`;
CREATE DEFINER=`ROOT`@`LOCALHOST` TRIGGER `REGISTRO_BITACORA__USUARIO_ACTUALIZADO` AFTER UPDATE ON `tbl_usuarios` 
FOR EACH ROW BEGIN 
DECLARE cambios varchar(500); 

SET @cambios := ''; 

IF OLD.USUARIO != NEW.USUARIO THEN 
  SET @cambios := CONCAT(@cambios, ' Se cambió el nick de usuario de ', OLD.USUARIO, ' a: ', NEW.USUARIO); 
END IF;
 
IF OLD.CONTRASEÑA != NEW.CONTRASEÑA THEN
 SET @cambios := CONCAT(@cambios, ' Se cambió la contraseña del usuario de ', NEW.USUARIO);
END IF;

IF OLD.FECHA_REGISTRO != NEW.FECHA_REGISTRO THEN
  SET @cambios := CONCAT(@cambios, ' Se cambió la fecha de registro del usuario de ', OLD.FECHA_REGISTRO, ' a: ', NEW.FECHA_REGISTRO);
END IF;

INSERT INTO tbl_bitacora(ID_USUARIO, 
                         DESCRIPCION, 
                         FECHA)
  VALUE(1, 
        @cambios, 
        SYSDATE());
 END;

#Este Trigger crea un registro cada vez que una solicitud nueva es creada

DROP TRIGGER IF EXISTS `REGISTRO_BITACORA__SOLICITUD_CREADO`;
CREATE DEFINER=`root`@`localhost` TRIGGER `REGISTRO_BITACORA__SOLICITUD_CREADO` AFTER INSERT ON `tbl_solicitudes` 
FOR EACH ROW 
INSERT INTO tbl_bitacora(ID_USUARIO, DESCRIPCION, FECHA) 
  VALUES(1, CONCAT('Se creó una solicitud con código: ', NEW.ID_SOLICITUD), SYSDATE());

 #Este Trigger crea un registro cada vez que una solicitud es aceptada

DROP TRIGGER IF EXISTS `REGISTRO_BITACORA__SOLICITUD_ACEPTADA`;
CREATE DEFINER=`root`@`localhost` TRIGGER `REGISTRO_BITACORA__SOLICITUD_RESPONDIDA` AFTER UPDATE ON `tbl_solicitudes` 
FOR EACH ROW BEGIN 
IF NEW.ID_ESTADO_SOLICITUD = 2 THEN
  INSERT INTO tbl_bitacora(ID_USUARIO, 
                           DESCRIPCION, 
                           FECHA) 
  VALUE(1, 
        CONCAT('Se denegó la solicitud con código: ', NEW.ID_SOLICITUD), 
        SYSDATE());
END IF; 
IF NEW.ID_ESTADO_SOLICITUD = 3 THEN
  INSERT INTO tbl_bitacora(ID_USUARIO, 
                           DESCRIPCION, 
                           FECHA) 
  VALUE(1, 
        CONCAT('Se aprobó la solicitud con código: ', NEW.ID_SOLICITUD), 
        SYSDATE());
END IF; END;