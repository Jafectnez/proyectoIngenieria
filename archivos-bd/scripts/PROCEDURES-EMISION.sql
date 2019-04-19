    DELIMITER //
    DROP PROCEDURE IF EXISTS `SP_INSERTAR_RESULTADO`//
    CREATE PROCEDURE `SP_INSERTAR_RESULTADO`(
      IN P_ID_EXAMEN INT,
      IN P_ID_CLIENTE INT,
      IN P_ID_EMPLEADO INT, 
      IN P_VALOR_RESULTADO VARCHAR(200),
      IN P_ID_CARACTERISTICA VARCHAR(200),

      
      OUT pO_mensaje VARCHAR(1000),
      OUT pO_error BOOLEAN
    )
      BEGIN

      # Declaraciones
      DECLARE mensaje VARCHAR(1000);
      DECLARE error BOOLEAN;
      DECLARE id INT;

      # Inicializaciones
      SET AUTOCOMMIT=0;
      START TRANSACTION;
      SET mensaje = '';
      
      # ___________________VALIDACIONES___________________________
       IF P_ID_EXAMEN='' OR P_ID_EXAMEN IS NULL THEN 
        SET mensaje=CONCAT(mensaje, 'Id examen vacio, ');
      END IF; 
       IF P_ID_CLIENTE='' OR P_ID_CLIENTE IS NULL THEN 
        SET mensaje=CONCAT(mensaje, 'Id cliente vacio, ');
      END IF; 
      IF P_ID_EMPLEADO='' OR P_ID_EMPLEADO IS NULL THEN 
        SET mensaje=CONCAT(mensaje, 'Id empleado vacio, ');
      END IF; 
      IF P_ID_EXAMEN='' OR P_ID_CARACTERISTICA IS NULL THEN 
        SET mensaje=CONCAT(mensaje, 'Id caracteristica vacio, ');
      END IF;     
       # Insert y Commit

      INSERT INTO TBL_RESULTADOS (
                                  ID_EXAMEN,
                                  ID_CLIENTE, 
                                  ID_EMPLEADO, 
                                  FECHA_EMISION)
                          VALUES ( 
                                  P_ID_EXAMEN,
                                  P_ID_CLIENTE, 
                                  P_ID_EMPLEADO,
                                  NOW());
     SELECT MAX(ID_RESULTADO) INTO id FROM TBL_RESULTADOS;


      INSERT INTO CARACTERISTICAS_X_RESULTADOS(
                                  ID_CARACTERISTICAS,
                                  ID_RESULTADO,
                                  VALOR_RESULTADO )
                          VALUES(P_ID_CARACTERISTICA,
                                id,
                                P_VALOR_RESULTADO);
      COMMIT;
          
      SET mensaje='Inserción exitosa';
      SET error=FALSE;
      SET pO_mensaje=mensaje;
      SET pO_error=error;
      SELECT mensaje, error;

    END//

