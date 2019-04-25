USE DB_EMANUEL;

INSERT INTO `TBL_IMPUESTOS` (`IMPUESTO`, `PORCENTAJE`) 
  VALUES ('ISV', 0.15);

INSERT INTO `TBL_GENERO` (`GENERO`)
  VALUES ('MASCULINO');

INSERT INTO `TBL_GENERO` (`GENERO`) 
  VALUES ('FEMENINO');

INSERT INTO `TBL_GENERO` (`GENERO`) 
  VALUES ('INDETERMINADO');

INSERT INTO `TBL_PERSONAS` (`ID_GENERO`, `NOMBRE`, `APELLIDO`, `EDAD`, `TELEFONO`, `EMAIL`, `FECHA_NAC`, `DIRECCION`, `IDENTIDAD`) 
  VALUES (1, 'Allan', 'Martinez', 21, '9900-0001', 'allan.martinez@unah.hn', '2000-03-28', 'Tegucigalpa, Honduras', '0801201900001');

INSERT INTO `TBL_PERSONAS` (`ID_GENERO`, `NOMBRE`, `APELLIDO`, `EDAD`, `TELEFONO`, `EMAIL`, `FECHA_NAC`, `DIRECCION`, `IDENTIDAD`) 
  VALUES (2, 'Evelin', 'Izaguirre', 21, '9900-0002', 'evelin.izaguirre@unah.hn', '2000-03-28', 'Tegucigalpa, Honduras', '0801201900002');

INSERT INTO `TBL_PERSONAS` (`ID_GENERO`, `NOMBRE`, `APELLIDO`, `EDAD`, `TELEFONO`, `EMAIL`, `FECHA_NAC`, `DIRECCION`, `IDENTIDAD`) 
  VALUES (2, 'Lizzul', 'Giron', 21, '9900-0003', 'lizzul.giron@unah.hn', '2000-03-28', 'Tegucigalpa, Honduras', '0801201900003');

INSERT INTO `TBL_TIPO_USUARIO` (`TIPO_USUARIO`) 
  VALUES ('Administrador');

INSERT INTO `TBL_TIPO_USUARIO` (`TIPO_USUARIO`) 
  VALUES ('Empleado');

INSERT INTO `TBL_TIPO_USUARIO` (`TIPO_USUARIO`) 
  VALUES ('Cliente');

INSERT INTO `TBL_USUARIOS` (`ID_TIPO_USUARIO`, `USUARIO`, `CONTRASEÑA`, `FECHA_REGISTRO`) 
  VALUES (1, 'AllanMartinez', 'asd.456', '2019-03-28');

INSERT INTO `TBL_USUARIOS` (`ID_TIPO_USUARIO`, `USUARIO`, `CONTRASEÑA`, `FECHA_REGISTRO`) 
  VALUES (2, 'EvelinIzaguirre', 'asd.456', '2019-03-28');

INSERT INTO `TBL_USUARIOS` (`ID_TIPO_USUARIO`, `USUARIO`, `CONTRASEÑA`, `FECHA_REGISTRO`) 
  VALUES (3, 'LizzulGiron', 'asd.456', '2019-03-28');

INSERT INTO `TBL_CLIENTE` (`ID_PERSONA`, `ID_USUARIO`) 
  VALUES (3, 3);

INSERT INTO `TBL_EMPLEADO` (`ID_PERSONA`, `ID_USUARIO`, `FECHA_INGRESO`, `FECHA_DESPIDO`) 
  VALUES (2, 2, '2019-03-28', NULL);

INSERT INTO `TBL_EMPLEADO` (`ID_PERSONA`, `ID_USUARIO`, `FECHA_INGRESO`, `FECHA_DESPIDO`) 
  VALUES (1, 1, '2019-03-28', NULL);

INSERT INTO `TBL_FORMAS_PAGO` (`FORMA_PAGO`) 
  VALUES ('Efectivo');

INSERT INTO `TBL_FORMAS_PAGO` (`FORMA_PAGO`) 
  VALUES ('Tarjeta');

INSERT INTO `TBL_FACTURA` (`ID_IMPUESTO`, `ID_CLIENTE`, `ID_EMPLEADO`, `ID_FORMA_PAGO`, `RTN`, `FECHA_EXAMEN`, `TOTAL`, `ESTADO_FACTURA`) 
  VALUES (1, 1, 2, 1, '0709-2019-000004', '2019-03-28', 400.0, 1);

INSERT INTO `TBL_DESCUENTOS` (`DESCRIPCION`, `PORCENTAJE`) 
  VALUES ('Descuento por Cupon', 0.05);


INSERT INTO `TBL_EXAMENES` (`ID_AREA`, `NOMBRE`, `PRECIO`, `DESCRIPCION`, `TIEMPO_ANALISIS`) 
  VALUES (1, 'Hemograma', 400.0, 'Examen de Sangre', '1 dia');

INSERT INTO `EXAMENES_X_FACTURA` (`ID_EXAMEN`, `ID_FACTURA`) 
  VALUES (1, 1);

INSERT INTO `TBL_PROVEEDORES` (`PROVEEDOR`, `CONTACTO`, `AGENTE_VENTAS`) 
  VALUES ('Bayer', '9900-0000', 'Junaito Alcachofa');

INSERT INTO `TBL_TIPOS_INSUMOS` (`TIPO_INSUMO`) 
  VALUES ('Material');

INSERT INTO `TBL_TIPOS_INSUMOS` (`TIPO_INSUMO`) 
  VALUES ('Reactivo');

INSERT INTO `TBL_INSUMOS` (`ID_TIPO_INSUMO`, `ID_PROVEEDOR`, `INSUMO`, `DESCRIPCION`, `PRECIO_COSTO`, `CANTIDAD`, `FECHA_INGRESO`, `FECHA_VENC`) 
  VALUES (1, 1, 'Acido X', 'Acido para el examen de sangre', 150.0, 15, '2019-03-28', '2020-03-20');

INSERT INTO `TBL_RESULTADOS` (`ID_EXAMEN`, `ID_CLIENTE`, `ID_EMPLEADO`, `FECHA_EMISION`, `OBSERVACIONES`) 
  VALUES (1, 1, 2, '2019-03-28', 'N/A');

INSERT INTO `INSUMOS_X_EXAMENES` (`ID_INSUMO`, `ID_EXAMEN`) 
  VALUES (1, 1);

INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`, `VALOR_REF`) 
  VALUES ('Eritrocitos', '200-250');

INSERT INTO `TBL_PROMOCIONES` (`PROMOCION`, `DESCRIPCION`, `FECHA_INICIO`, `FECHA_FIN`) 
  VALUES (0.10, 'Descuento por Aniversario', '2019-03-28', '2019-08-28');

INSERT INTO `PROMOCIONES_X_EXAMENES` (`TBL_PROMOCIONES_ID_PROMOCIONES`, `TBL_EXAMENES_ID_EXAMEN`) 
  VALUES (1, 1);

INSERT INTO `TBL_ESTADO_SOLICITUD` (`ESTADO_SOLICITUD`) 
  VALUES ('Pendiente');

INSERT INTO `TBL_ESTADO_SOLICITUD` (`ESTADO_SOLICITUD`) 
  VALUES ('Denegado');

INSERT INTO `TBL_ESTADO_SOLICITUD` (`ESTADO_SOLICITUD`) 
  VALUES ('Aprobado');

INSERT INTO `TBL_SOLICITUDES` (`ID_USUARIO_EMISOR`, `ID_USUARIO_RECEPTOR`, `ID_ESTADO_SOLICITUD`, `DESCRIPCION`, `FECHA`) 
  VALUES (2, 1, 1, 'Solicitud de Acceso al modulo de clientes', '2019-03-28');

INSERT INTO `AREA_X_CARACTERISTICAS` (`ID_AREA`, `ID_CARACTERISTICAS`) 
  VALUES (1, 1);

INSERT INTO `CARACTERISTICAS_X_RESULTADOS` (`ID_CARACTERISTICAS`, `ID_RESULTADO`, `VALOR_RESULTADO`) 
  VALUES (1, 1, '220');

INSERT INTO `TBL_BITACORA` (`ID_USUARIO`, `DESCRIPCION`, `FECHA`) 
  VALUES (2, 'Examen de Sangre Realizado', '2019-03-28');