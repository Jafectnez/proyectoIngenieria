-- -----------------------------------------------------
-- Todos los inserts de la base en el orden correcto
-- -----------------------------------------------------

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
  VALUES (1, 'Allan', 'Martinez', 21, '9900-0000', 'allan.martinez@unah.hn', '2019-03-28', 'Tegucigalpa, Honduras', '0801201900001');

INSERT INTO `TBL_PERSONAS` (`ID_GENERO`, `NOMBRE`, `APELLIDO`, `EDAD`, `TELEFONO`, `EMAIL`, `FECHA_NAC`, `DIRECCION`, `IDENTIDAD`) 
  VALUES (2, 'Evelin', 'Izaguirre', 21, '9900-0000', 'evelin.izaguirre@unah.hn', '2019-03-28', 'Tegucigalpa, Honduras', '0801201900001');

INSERT INTO `TBL_PERSONAS` (`ID_GENERO`, `NOMBRE`, `APELLIDO`, `EDAD`, `TELEFONO`, `EMAIL`, `FECHA_NAC`, `DIRECCION`, `IDENTIDAD`) 
  VALUES (2, 'Lizzul', 'Giron', 21, '9900-0000', 'lizzul.giron@unah.hn', '2019-03-28', 'Tegucigalpa, Honduras', '0801201900001');

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

INSERT INTO `DESCUENTOS_X_FACTURA` (`ID_DESCUENTOS`, `ID_FACTURA`) 
  VALUES (1, 1);
INSERT INTO `TBL_PROVEEDORES` (`PROVEEDOR`, `CONTACTO`, `AGENTE_VENTAS`) 
  VALUES ('Bayer', '9900-0000', 'Junaito Alcachofa');

INSERT INTO `TBL_TIPOS_INSUMOS` (`TIPO_INSUMO`) 
  VALUES ('Material');

INSERT INTO `TBL_TIPOS_INSUMOS` (`TIPO_INSUMO`) 
  VALUES ('Reactivo');

INSERT INTO `TBL_INSUMOS` (`ID_TIPO_INSUMO`, `ID_PROVEEDOR`, `INSUMO`, `DESCRIPCION`, `PRECIO_COSTO`, `CANTIDAD`, `FECHA_INGRESO`, `FECHA_VENC`) 
  VALUES (1, 1, 'Acido X', 'Acido para el examen de sangre', 150.0, 15, '2019-03-28', '2020-03-20');

INSERT INTO `TBL_PROMOCIONES` (`PROMOCION`, `DESCRIPCION`, `FECHA_INICIO`, `FECHA_FIN`) 
  VALUES (0.10, 'Descuento por Aniversario', '2019-03-28', '2019-03-28');

INSERT INTO `TBL_ESTADO_SOLICITUD` (`ESTADO_SOLICITUD`) 
  VALUES ('Pendiente');

INSERT INTO `TBL_ESTADO_SOLICITUD` (`ESTADO_SOLICITUD`) 
  VALUES ('Denegado');

INSERT INTO `TBL_ESTADO_SOLICITUD` (`ESTADO_SOLICITUD`) 
  VALUES ('Aprobado');

INSERT INTO `TBL_SOLICITUDES` (`ID_USUARIO_EMISOR`, `ID_USUARIO_RECEPTOR`, `ID_ESTADO_SOLICITUD`, `DESCRIPCION`, `FECHA`) 
  VALUES (2, 1, 1, 'Solicitud de Acceso al modulo de clientes', '2019-03-28');

INSERT INTO `TBL_BITACORA` (`ID_USUARIO`, `DESCRIPCION`, `FECHA`) 
  VALUES (2, 'Examen de Sangre Realizado', '2019-03-28');
  
  #--------------------------------------------------------------------------   
# AREAS
INSERT INTO `TBL_AREA` (`NOMBRE`) 
  VALUES ('Hematología');
INSERT INTO `TBL_AREA` (`NOMBRE`) 
  VALUES ('Uroanálisis');
INSERT INTO `TBL_AREA` (`NOMBRE`) 
  VALUES ('Coproparasitológico');
INSERT INTO `TBL_AREA` (`NOMBRE`) 
  VALUES ('Inmunología');
INSERT INTO `TBL_AREA` (`NOMBRE`) 
  VALUES ('Química Sanguinea');
INSERT INTO `TBL_AREA` (`NOMBRE`) 
  VALUES ('Pruebas Especiales');
INSERT INTO `TBL_AREA` (`NOMBRE`) 
  VALUES ('Marcadores Tumorales');

#--------------------------------------------------------------------------    
# CARACTERISTICAS  

#						--   HEMATOLOGIA  -- 

INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`, `UNIDADES_MEDIDA`) 
  VALUES ('Eritrocitos', 'x10 cmm³');
INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`, `UNIDADES_MEDIDA` ) 
  VALUES ('Hemoglobina', 'g-dl');
INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`, `UNIDADES_MEDIDA` ) 
  VALUES ('Hematocrito', '%');
INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`, `UNIDADES_MEDIDA` ) 
  VALUES ('V.E.S', 'mm-h');
INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`) 
  VALUES ('Reticulositos');
INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`) 
  VALUES ('Drepanositos');
INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`) 
  VALUES ('Malaria');
INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`, `UNIDADES_MEDIDA` ) 
  VALUES ('Leucocitos', 'cmm³');
INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA` ) 
  VALUES ('Neutrofilos');
INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`) 
  VALUES ('Eosinofilos');

INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`) 
  VALUES ('Basofilos');
INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`) 
  VALUES ('Monocitos');
INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`) 
  VALUES ('Linfocitos');
INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`) 
  VALUES ('Plaquetas');
INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA` ) 
  VALUES ('T. Sangrado');
INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`) 
  VALUES ('T. Coagulación');
INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`) 
  VALUES ('R. del Coagulo');
INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`) 
  VALUES ('T.P. Paciente');
INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`) 
  VALUES ('T.P. Control');
INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`) 
  VALUES ('T.P.T Paciente');
INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`) 
  VALUES ('T.P.T Control');
INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`) 
  VALUES ('INR');

#						--   COPROPARASITOLOGICO  -- 

INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA` ) 
  VALUES ('Color');
INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`) 
  VALUES ('Consistencia');
INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`) 
  VALUES ('Moco');
INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`) 
  VALUES ('Sangre');
INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`) 
  VALUES ('Ph');
INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`) 
  VALUES ('Fehling');
INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`) 
  VALUES ('Sudan III');
INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`) 
  VALUES ('Sangre Oculta');

 INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA` ) 
  VALUES ('A. Lubricoides');
INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`) 
  VALUES ('T. Trichiura');
INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`) 
  VALUES ('Taenia SP');
INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`) 
  VALUES ('Uncinaria');
INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`) 
  VALUES ('Strongyloides');
INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`) 
  VALUES ('H. Nana');
INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`) 
  VALUES ('E. Histolylica');
INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`) 
  VALUES ('E. Coli');
INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`) 
  VALUES ('E. Hartmanni');
INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`) 
  VALUES ('E. Nana');
INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`) 
  VALUES ('G. Lamblia');
INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`) 
  VALUES ('B. Hominis');

#						--   UROANALISIS  -- 

INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA` ) 
  VALUES ('Olor');
INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`) 
  VALUES ('Aspecto');
INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`) 
  VALUES ('Densidad');
INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`, `VALOR_REF`,`UNIDADES_MEDIDA`) 
  VALUES ('Glucosa','70-110','mg/dl');
INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`) 
  VALUES ('Proteinas');
INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`) 
  VALUES ('Cetonas');
INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`) 
  VALUES ('Urobilinogeno');
INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`) 
  VALUES ('Bilirrubina');

INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`) 
  VALUES ('Nitritos');
INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA` ) 
  VALUES ('Células Epiteliales');
INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`) 
  VALUES ('Bacterias');
INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`) 
  VALUES ('Levaduras');
INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`) 
  VALUES ('Mocus');
INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`) 
  VALUES ('Cilindros');
INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`) 
  VALUES ('Cristales');
INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`) 
  VALUES ('Parasitos');
INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`) 
  VALUES ('En Sangre');
INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`) 
  VALUES ('En Orina');

#						--   INMUNILOGIA  -- 

INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`) 
  VALUES ('RPR');
INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`) 
  VALUES ('Factor Reumatoideo');
INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`) 
  VALUES ('ASO');
INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`) 
  VALUES ('Proteina C Reactiva');
INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`) 
  VALUES ('Tipo');
INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`) 
  VALUES ('Rh');

INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`) 
  VALUES ('Tifico O');
INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`) 
  VALUES ('Tifico H');
INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`) 
  VALUES ('Paratifico O');
INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`) 
  VALUES ('Paratifico B');    
INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`) 
  VALUES ('Brucella');
INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`) 
  VALUES ('Proteus 0X19'); 

#						--   QUIMICA  -- 
# la glucosa
INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`, `VALOR_REF`,`UNIDADES_MEDIDA`) 
  VALUES ('Glucosa post pandrial','70-110','mg/dl');
INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`, `VALOR_REF`,`UNIDADES_MEDIDA`) 
  VALUES ('Ácido Úrico','2.6-6 / 3.5-7.2','mg/dl');
INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`, `VALOR_REF`,`UNIDADES_MEDIDA`) 
  VALUES ('Urea','15-40','mg/dl');
INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`) 
  VALUES ('BUN');
INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`, `VALOR_REF`,`UNIDADES_MEDIDA`) 
  VALUES ('Creatinina','0.5-0.9 / 0.7-1.2','mg/dl');
INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`, `VALOR_REF`,`UNIDADES_MEDIDA`) 
  VALUES ('Colesterol Total','0-200','mg/dl');
INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`, `VALOR_REF`,`UNIDADES_MEDIDA`) 
  VALUES ('Colesterol HDL','> 65','mg/dl');
INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`, `VALOR_REF`,`UNIDADES_MEDIDA`) 
  VALUES ('Colesterol LDL','0- 130','mg/dl');

INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`, `VALOR_REF`,`UNIDADES_MEDIDA`) 
  VALUES ('Triglicéridos','25-160','mg/dl');
INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`, `VALOR_REF`,`UNIDADES_MEDIDA`) 
  VALUES ('Fosfata Alcalina','0-270','mg/dl');
INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`, `VALOR_REF`,`UNIDADES_MEDIDA`) 
  VALUES ('TGO','0-40','mg/dl');
INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`, `VALOR_REF`,`UNIDADES_MEDIDA`) 
  VALUES ('TGP','0-40','mg/dl');
INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`, `VALOR_REF`,`UNIDADES_MEDIDA`) 
  VALUES ('LDH','225-240','U/l');
INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`, `VALOR_REF`,`UNIDADES_MEDIDA`) 
  VALUES ('Amilasa','0-86','mg/dl');
INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`, `VALOR_REF`,`UNIDADES_MEDIDA`) 
  VALUES ('Bilirrubina Total','Hasta 2','mg/dl');
INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`, `VALOR_REF`,`UNIDADES_MEDIDA`) 
  VALUES ('Bilirrubina Directa','0.1-0.4','mg/dl');
INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`, `VALOR_REF`,`UNIDADES_MEDIDA`) 
  VALUES ('Bilirrubina Indirecta','0.2-0.7','mg/dl');
INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`, `VALOR_REF`,`UNIDADES_MEDIDA`) 
  VALUES ('Fosfatasa Ácida','0-270','mg/dl');
INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`) 
  VALUES ('Calcio');
INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`) 
  VALUES ('Cloro');
INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`) 
  VALUES ('Sodio');
INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`) 
  VALUES ('Potasio');
INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`, `VALOR_REF`,`UNIDADES_MEDIDA`) 
  VALUES ('Glicohemoglobina','4.5-6.4%','Hb alc');
INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`, `VALOR_REF`,`UNIDADES_MEDIDA`) 
  VALUES ('Proteinas Totales','6.6-8.7','g/dl');
INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`, `VALOR_REF`,`UNIDADES_MEDIDA`) 
  VALUES ('Albuminas','3.8-4.6','g/dl');
INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`) 
  VALUES ('Proteinas en Orina 24H');

#           --   PRUEBAS RAPIDAS (Pruebas Especiales)  -- 

INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`) 
  VALUES ('Anticuerpos Anti Toxoplasma');
INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`) 
  VALUES ('Anticuerpos IgG');
INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`) 
  VALUES ('Anticuerpos IgM');
INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`) 
  VALUES ('Anticuerpos HIV');
INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`) 
  VALUES ('Antígeno Hepatitis A');
INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`) 
  VALUES ('Antígeno Hepatitis B');
INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`) 
  VALUES ('Antígeno Hepatitis C');
INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`) 
  VALUES ('Anticuerpos Anti Chagas');
INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`) 
  VALUES ('Anticuerpos de Tuberculosis');
INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`) 
  VALUES ('Antígeno Rotavirus');
INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`) 
  VALUES ('Antígeno Adenovirus');
INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`) 
  VALUES ('Antígeno Malaria');

INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`) 
  VALUES ('Antígeno Sífilis');
INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`) 
  VALUES ('Antígeno Helicobacter pylori Heces');
INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`) 
  VALUES ('Anticuerpo Helicobacter pylori Sangre');
INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`) 
  VALUES ('Antígeno Influenza A y B');

#           --   MARCADORES TUMORALES  -- 

INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`) 
  VALUES ('CA - 125');
INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`) 
  VALUES ('Dimero - D');
INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`) 
  VALUES ('HCG');
INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`) 
  VALUES ('TSH');
INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`) 
  VALUES ('Inmunoglobulina E (IgE)');
INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`) 
  VALUES ('Alfafetoproteína (AFP)');
INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`) 
  VALUES ('CEA');
INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`) 
  VALUES ('Mioglobina');
INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`) 
  VALUES ('CK-MB');
INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`) 
  VALUES ('Troponina');
INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`) 
  VALUES ('Antígeno Prostático (PSA)');

INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`) 
  VALUES ('Insulina');
INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`) 
  VALUES ('LH');
INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`) 
  VALUES ('FSH');
INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`) 
  VALUES ('PCR (Ultrasensible)');
INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`) 
  VALUES ('Prolastina');
INSERT INTO `TBL_CARACTERISTICAS` (`CARACTERISTICA`) 
  VALUES ('Ferritina');


#--------------------------------------------------------------------------    
# CARACTERISTICAS POR AREA  
#

INSERT INTO `AREA_X_CARACTERISTICAS` (`ID_AREA`, `ID_CARACTERISTICAS`) 
  VALUES (1, 1);
INSERT INTO `AREA_X_CARACTERISTICAS` (`ID_AREA`, `ID_CARACTERISTICAS`) 
  VALUES (1, 2);
INSERT INTO `AREA_X_CARACTERISTICAS` (`ID_AREA`, `ID_CARACTERISTICAS`) 
  VALUES (1, 3);
INSERT INTO `AREA_X_CARACTERISTICAS` (`ID_AREA`, `ID_CARACTERISTICAS`) 
  VALUES (1, 4);  
INSERT INTO `AREA_X_CARACTERISTICAS` (`ID_AREA`, `ID_CARACTERISTICAS`) 
  VALUES (1, 5);
INSERT INTO `AREA_X_CARACTERISTICAS` (`ID_AREA`, `ID_CARACTERISTICAS`) 
  VALUES (1, 6);
INSERT INTO `AREA_X_CARACTERISTICAS` (`ID_AREA`, `ID_CARACTERISTICAS`) 
  VALUES (1, 7);
INSERT INTO `AREA_X_CARACTERISTICAS` (`ID_AREA`, `ID_CARACTERISTICAS`) 
  VALUES (1, 8);
INSERT INTO `AREA_X_CARACTERISTICAS` (`ID_AREA`, `ID_CARACTERISTICAS`) 
  VALUES (1, 9);
INSERT INTO `AREA_X_CARACTERISTICAS` (`ID_AREA`, `ID_CARACTERISTICAS`) 
  VALUES (1, 10);

INSERT INTO `AREA_X_CARACTERISTICAS` (`ID_AREA`, `ID_CARACTERISTICAS`) 
  VALUES (2, 8);
INSERT INTO `AREA_X_CARACTERISTICAS` (`ID_AREA`, `ID_CARACTERISTICAS`) 
  VALUES (2, 23);
INSERT INTO `AREA_X_CARACTERISTICAS` (`ID_AREA`, `ID_CARACTERISTICAS`) 
  VALUES (2, 26);
INSERT INTO `AREA_X_CARACTERISTICAS` (`ID_AREA`, `ID_CARACTERISTICAS`) 
  VALUES (2, 27);
INSERT INTO `AREA_X_CARACTERISTICAS` (`ID_AREA`, `ID_CARACTERISTICAS`) 
  VALUES (2, 43);
INSERT INTO `AREA_X_CARACTERISTICAS` (`ID_AREA`, `ID_CARACTERISTICAS`) 
  VALUES (2, 44);
INSERT INTO `AREA_X_CARACTERISTICAS` (`ID_AREA`, `ID_CARACTERISTICAS`) 
  VALUES (2, 45);
INSERT INTO `AREA_X_CARACTERISTICAS` (`ID_AREA`, `ID_CARACTERISTICAS`) 
  VALUES (2, 46);
INSERT INTO `AREA_X_CARACTERISTICAS` (`ID_AREA`, `ID_CARACTERISTICAS`) 
  VALUES (2, 47);
INSERT INTO `AREA_X_CARACTERISTICAS` (`ID_AREA`, `ID_CARACTERISTICAS`) 
  VALUES (2, 48);  
INSERT INTO `AREA_X_CARACTERISTICAS` (`ID_AREA`, `ID_CARACTERISTICAS`) 
  VALUES (2, 49);  
INSERT INTO `AREA_X_CARACTERISTICAS` (`ID_AREA`, `ID_CARACTERISTICAS`) 
  VALUES (2, 50);
  
INSERT INTO `AREA_X_CARACTERISTICAS` (`ID_AREA`, `ID_CARACTERISTICAS`) 
  VALUES (3, 23);
INSERT INTO `AREA_X_CARACTERISTICAS` (`ID_AREA`, `ID_CARACTERISTICAS`) 
  VALUES (3, 24);
INSERT INTO `AREA_X_CARACTERISTICAS` (`ID_AREA`, `ID_CARACTERISTICAS`) 
  VALUES (3, 25);
INSERT INTO `AREA_X_CARACTERISTICAS` (`ID_AREA`, `ID_CARACTERISTICAS`) 
  VALUES (3, 26);
INSERT INTO `AREA_X_CARACTERISTICAS` (`ID_AREA`, `ID_CARACTERISTICAS`) 
  VALUES (3, 27);
INSERT INTO `AREA_X_CARACTERISTICAS` (`ID_AREA`, `ID_CARACTERISTICAS`) 
  VALUES (3, 28);
INSERT INTO `AREA_X_CARACTERISTICAS` (`ID_AREA`, `ID_CARACTERISTICAS`) 
  VALUES (3, 29);
INSERT INTO `AREA_X_CARACTERISTICAS` (`ID_AREA`, `ID_CARACTERISTICAS`) 
  VALUES (3, 30);

INSERT INTO `AREA_X_CARACTERISTICAS` (`ID_AREA`, `ID_CARACTERISTICAS`) 
  VALUES (4, 61);
INSERT INTO `AREA_X_CARACTERISTICAS` (`ID_AREA`, `ID_CARACTERISTICAS`) 
  VALUES (4, 62);  
INSERT INTO `AREA_X_CARACTERISTICAS` (`ID_AREA`, `ID_CARACTERISTICAS`) 
  VALUES (4, 63);  
INSERT INTO `AREA_X_CARACTERISTICAS` (`ID_AREA`, `ID_CARACTERISTICAS`) 
  VALUES (4, 64);
INSERT INTO `AREA_X_CARACTERISTICAS` (`ID_AREA`, `ID_CARACTERISTICAS`) 
  VALUES (4, 65);
INSERT INTO `AREA_X_CARACTERISTICAS` (`ID_AREA`, `ID_CARACTERISTICAS`) 
  VALUES (4, 66);

INSERT INTO `AREA_X_CARACTERISTICAS` (`ID_AREA`, `ID_CARACTERISTICAS`) 
  VALUES (5, 46);
INSERT INTO `AREA_X_CARACTERISTICAS` (`ID_AREA`, `ID_CARACTERISTICAS`) 
  VALUES (5, 73);
INSERT INTO `AREA_X_CARACTERISTICAS` (`ID_AREA`, `ID_CARACTERISTICAS`) 
  VALUES (5, 74);
INSERT INTO `AREA_X_CARACTERISTICAS` (`ID_AREA`, `ID_CARACTERISTICAS`) 
  VALUES (5, 75);
INSERT INTO `AREA_X_CARACTERISTICAS` (`ID_AREA`, `ID_CARACTERISTICAS`) 
  VALUES (5, 76);  
INSERT INTO `AREA_X_CARACTERISTICAS` (`ID_AREA`, `ID_CARACTERISTICAS`) 
  VALUES (5, 77);
INSERT INTO `AREA_X_CARACTERISTICAS` (`ID_AREA`, `ID_CARACTERISTICAS`) 
  VALUES (5, 78);
INSERT INTO `AREA_X_CARACTERISTICAS` (`ID_AREA`, `ID_CARACTERISTICAS`) 
  VALUES (5, 79);
INSERT INTO `AREA_X_CARACTERISTICAS` (`ID_AREA`, `ID_CARACTERISTICAS`) 
  VALUES (5, 80); 

INSERT INTO `AREA_X_CARACTERISTICAS` (`ID_AREA`, `ID_CARACTERISTICAS`) 
  VALUES (6, 99);
INSERT INTO `AREA_X_CARACTERISTICAS` (`ID_AREA`, `ID_CARACTERISTICAS`) 
  VALUES (6, 100);
INSERT INTO `AREA_X_CARACTERISTICAS` (`ID_AREA`, `ID_CARACTERISTICAS`) 
  VALUES (6, 101);
INSERT INTO `AREA_X_CARACTERISTICAS` (`ID_AREA`, `ID_CARACTERISTICAS`) 
  VALUES (6, 102);
INSERT INTO `AREA_X_CARACTERISTICAS` (`ID_AREA`, `ID_CARACTERISTICAS`) 
  VALUES (6, 103);
INSERT INTO `AREA_X_CARACTERISTICAS` (`ID_AREA`, `ID_CARACTERISTICAS`) 
  VALUES (6, 104);
INSERT INTO `AREA_X_CARACTERISTICAS` (`ID_AREA`, `ID_CARACTERISTICAS`) 
  VALUES (6, 105);
INSERT INTO `AREA_X_CARACTERISTICAS` (`ID_AREA`, `ID_CARACTERISTICAS`) 
  VALUES (6, 106);
INSERT INTO `AREA_X_CARACTERISTICAS` (`ID_AREA`, `ID_CARACTERISTICAS`) 
  VALUES (6, 107);
INSERT INTO `AREA_X_CARACTERISTICAS` (`ID_AREA`, `ID_CARACTERISTICAS`) 
  VALUES (6, 108);
INSERT INTO `AREA_X_CARACTERISTICAS` (`ID_AREA`, `ID_CARACTERISTICAS`) 
  VALUES (6, 109);
INSERT INTO `AREA_X_CARACTERISTICAS` (`ID_AREA`, `ID_CARACTERISTICAS`) 
  VALUES (6, 110);

INSERT INTO `AREA_X_CARACTERISTICAS` (`ID_AREA`, `ID_CARACTERISTICAS`) 
  VALUES (7, 115);
INSERT INTO `AREA_X_CARACTERISTICAS` (`ID_AREA`, `ID_CARACTERISTICAS`) 
  VALUES (7, 116);
INSERT INTO `AREA_X_CARACTERISTICAS` (`ID_AREA`, `ID_CARACTERISTICAS`) 
  VALUES (7, 117);
INSERT INTO `AREA_X_CARACTERISTICAS` (`ID_AREA`, `ID_CARACTERISTICAS`) 
  VALUES (7, 118);  
INSERT INTO `AREA_X_CARACTERISTICAS` (`ID_AREA`, `ID_CARACTERISTICAS`) 
  VALUES (7, 119);
INSERT INTO `AREA_X_CARACTERISTICAS` (`ID_AREA`, `ID_CARACTERISTICAS`) 
  VALUES (7, 120);
INSERT INTO `AREA_X_CARACTERISTICAS` (`ID_AREA`, `ID_CARACTERISTICAS`) 
  VALUES (7, 121);
INSERT INTO `AREA_X_CARACTERISTICAS` (`ID_AREA`, `ID_CARACTERISTICAS`) 
  VALUES (7, 122);
INSERT INTO `AREA_X_CARACTERISTICAS` (`ID_AREA`, `ID_CARACTERISTICAS`) 
  VALUES (7, 123);
INSERT INTO `AREA_X_CARACTERISTICAS` (`ID_AREA`, `ID_CARACTERISTICAS`) 
  VALUES (7, 124);
INSERT INTO `AREA_X_CARACTERISTICAS` (`ID_AREA`, `ID_CARACTERISTICAS`) 
  VALUES (7, 125);

INSERT INTO `TBL_EXAMENES` (`ID_AREA`, `NOMBRE`, `PRECIO`, `DESCRIPCION`, `TIEMPO_ANALISIS`) 
  VALUES (1, 'Hemograma', 400.0, 'Examen de Sangre', '1 dia');

INSERT INTO `EXAMENES_X_FACTURA` (`ID_EXAMEN`, `ID_FACTURA`) 
  VALUES (1, 1);

INSERT INTO `TBL_RESULTADOS` (`ID_EXAMEN`, `ID_CLIENTE`, `ID_EMPLEADO`, `FECHA_EMISION`, `OBSERVACIONES`) 
  VALUES (1, 1, 2, '2019-03-28', 'N/A');

INSERT INTO `INSUMOS_X_EXAMENES` (`ID_INSUMO`, `ID_EXAMEN`) 
  VALUES (1, 1);

INSERT INTO `PROMOCIONES_X_EXAMENES` (`TBL_PROMOCIONES_ID_PROMOCIONES`, `TBL_EXAMENES_ID_EXAMEN`) 
  VALUES (1, 1);
  
INSERT INTO `CARACTERISTICAS_X_RESULTADOS` (`ID_CARACTERISTICAS`, `ID_RESULTADO`, `VALOR_RESULTADO`) 
  VALUES (1, 1, '220');