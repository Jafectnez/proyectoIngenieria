SELECT f.ID_FACTURA,
	   f.FECHA_EXAMEN, 
	   CONCAT(p.NOMBRE,' ',p.APELLIDO) AS NOMBRECLIENTE,
	   e.NOMBRE,
	   f.ESTADO_FACTURA,
	   CONCAT(p.NOMBRE,' ',p.APELLIDO) AS EMPLEADO,
	   f.TOTAL
FROM TBL_FACTURA f
INNER JOIN EXAMENES_X_FACTURA ef 
ON ef.ID_FACTURA=f.ID_FACTURA
INNER JOIN TBL_EXAMENES e
ON e.ID_EXAMEN=ef.ID_EXAMEN
INNER JOIN TBL_CLIENTE c 
ON c.ID_CLIENTE=f.ID_CLIENTE
INNER JOIN TBL_PERSONAS p
ON c.ID_PERSONA=p.ID_PERSONA
INNER JOIN TBL_EMPLEADO ep
ON ep.ID_PERSONA=ep.ID_PERSONA

CREATE VIEW VW_EMPLEADO AS 
SELECT e.ID_EMPLEADO, CONCAT(p.NOMBRE, ' ',p.APELLIDO) NOMBREEMPLEADO FROM TBL_EMPLEADO e
INNER JOIN TBL_PERSONAS p
ON p.ID_PERSONA=e.ID_PERSONA

CREATE VIEW VW_CLIENTE AS 
SELECT c.ID_CLIENTE, CONCAT(p.NOMBRE, ' ',p.APELLIDO) NOMBRECLIENTE FROM TBL_CLIENTE c
INNER JOIN TBL_PERSONAS p
ON p.ID_PERSONA=c.ID_PERSONA


SELECT f.ID_FACTURA,
	   f.FECHA_EXAMEN, 
	   c.NOMBRECLIENTE,
	   e.NOMBRE,
	   f.ESTADO_FACTURA,
	   ep.NOMBREEMPLEADO,
	   f.TOTAL
FROM TBL_FACTURA f
LEFT JOIN EXAMENES_X_FACTURA ef 
ON ef.ID_FACTURA=f.ID_FACTURA
LEFT JOIN TBL_EXAMENES e
ON e.ID_EXAMEN=ef.ID_EXAMEN
LEFT JOIN VW_CLIENTE c
ON c.ID_CLIENTE=f.ID_FACTURA
LEFT JOIN VW_EMPLEADO ep
ON ep.ID_EMPLEADO=f.ID_EMPLEADO






