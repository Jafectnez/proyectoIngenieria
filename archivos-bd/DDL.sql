-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema DB_EMANUEL
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema DB_EMANUEL
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `DB_EMANUEL` DEFAULT CHARACTER SET utf8 ;
USE `DB_EMANUEL` ;

-- -----------------------------------------------------
-- Table `DB_EMANUEL`.`TBL_IMPUESTOS`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `DB_EMANUEL`.`TBL_IMPUESTOS` (
  `ID_IMPUESTO` INT NOT NULL AUTO_INCREMENT,
  `IMPUESTO` VARCHAR(50) NOT NULL,
  `PORCENTAJE` FLOAT NOT NULL,
  PRIMARY KEY (`ID_IMPUESTO`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DB_EMANUEL`.`TBL_GENERO`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `DB_EMANUEL`.`TBL_GENERO` (
  `ID_GENERO` INT NOT NULL AUTO_INCREMENT,
  `GENERO` VARCHAR(1) NOT NULL,
  PRIMARY KEY (`ID_GENERO`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DB_EMANUEL`.`TBL_PERSONAS`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `DB_EMANUEL`.`TBL_PERSONAS` (
  `ID_PERSONA` INT NOT NULL AUTO_INCREMENT,
  `ID_GENERO` INT NOT NULL,
  `NOMBRE` VARCHAR(50) NOT NULL,
  `APELLIDO` VARCHAR(50) NOT NULL,
  `EDAD` INT NOT NULL,
  `TELEFONO` VARCHAR(20) NOT NULL,
  `EMAIL` VARCHAR(50) NOT NULL,
  `FECHA_NAC` DATE NOT NULL,
  `DIRECCION` VARCHAR(50) NOT NULL,
  `IDENTIDAD` VARCHAR(13) NULL,
  PRIMARY KEY (`ID_PERSONA`),
  INDEX `fk_TBL_PERSONAS_TBL_GENERO1_idx` (`ID_GENERO` ASC),
  CONSTRAINT `fk_TBL_PERSONAS_TBL_GENERO1`
    FOREIGN KEY (`ID_GENERO`)
    REFERENCES `DB_EMANUEL`.`TBL_GENERO` (`ID_GENERO`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DB_EMANUEL`.`TBL_TIPO_USUARIO`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `DB_EMANUEL`.`TBL_TIPO_USUARIO` (
  `ID_TIPO_USUARIO` INT NOT NULL AUTO_INCREMENT,
  `TIPO_USUARIO` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`ID_TIPO_USUARIO`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DB_EMANUEL`.`TBL_USUARIOS`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `DB_EMANUEL`.`TBL_USUARIOS` (
  `ID_USUARIO` INT NOT NULL AUTO_INCREMENT,
  `ID_TIPO_USUARIO` INT NOT NULL,
  `USUARIO` VARCHAR(50) NOT NULL,
  `CONTRASEÑA` VARCHAR(50) NOT NULL,
  `FECHA_REGISTRO` DATE NOT NULL,
  PRIMARY KEY (`ID_USUARIO`),
  INDEX `fk_TBL_USUARIOS_TBL_TIPO_USUARIO1_idx` (`ID_TIPO_USUARIO` ASC),
  CONSTRAINT `fk_TBL_USUARIOS_TBL_TIPO_USUARIO1`
    FOREIGN KEY (`ID_TIPO_USUARIO`)
    REFERENCES `DB_EMANUEL`.`TBL_TIPO_USUARIO` (`ID_TIPO_USUARIO`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DB_EMANUEL`.`TBL_CLIENTE`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `DB_EMANUEL`.`TBL_CLIENTE` (
  `ID_CLIENTE` INT NOT NULL AUTO_INCREMENT,
  `ID_PERSONA` INT NOT NULL,
  `ID_USUARIO` INT NOT NULL,
  PRIMARY KEY (`ID_CLIENTE`),
  INDEX `fk_TBL_CLIENTE_TBL_PERSONAS1_idx` (`ID_PERSONA` ASC),
  INDEX `fk_TBL_CLIENTE_TBL_USUARIOS1_idx` (`ID_USUARIO` ASC),
  CONSTRAINT `fk_TBL_CLIENTE_TBL_PERSONAS1`
    FOREIGN KEY (`ID_PERSONA`)
    REFERENCES `DB_EMANUEL`.`TBL_PERSONAS` (`ID_PERSONA`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_TBL_CLIENTE_TBL_USUARIOS1`
    FOREIGN KEY (`ID_USUARIO`)
    REFERENCES `DB_EMANUEL`.`TBL_USUARIOS` (`ID_USUARIO`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DB_EMANUEL`.`TBL_EMPLEADO`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `DB_EMANUEL`.`TBL_EMPLEADO` (
  `ID_EMPLEADO` INT NOT NULL AUTO_INCREMENT,
  `ID_PERSONA` INT NOT NULL,
  `ID_USUARIO` INT NOT NULL,
  `FECHA_INGRESO` DATE NOT NULL,
  `FECHA_DESPIDO` DATE NULL,
  PRIMARY KEY (`ID_EMPLEADO`),
  INDEX `fk_TBL_EMPLEADO_TBL_PERSONAS1_idx` (`ID_PERSONA` ASC),
  INDEX `fk_TBL_EMPLEADO_TBL_USUARIOS1_idx` (`ID_USUARIO` ASC),
  CONSTRAINT `fk_TBL_EMPLEADO_TBL_PERSONAS1`
    FOREIGN KEY (`ID_PERSONA`)
    REFERENCES `DB_EMANUEL`.`TBL_PERSONAS` (`ID_PERSONA`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_TBL_EMPLEADO_TBL_USUARIOS1`
    FOREIGN KEY (`ID_USUARIO`)
    REFERENCES `DB_EMANUEL`.`TBL_USUARIOS` (`ID_USUARIO`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DB_EMANUEL`.`TBL_FORMAS_PAGO`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `DB_EMANUEL`.`TBL_FORMAS_PAGO` (
  `ID_FORMA_PAGO` INT NOT NULL AUTO_INCREMENT,
  `FORMA_PAGO` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`ID_FORMA_PAGO`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DB_EMANUEL`.`TBL_FACTURA`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `DB_EMANUEL`.`TBL_FACTURA` (
  `ID_FACTURA` INT NOT NULL AUTO_INCREMENT,
  `ID_IMPUESTO` INT NOT NULL,
  `ID_CLIENTE` INT NOT NULL,
  `ID_EMPLEADO` INT NOT NULL,
  `ID_FORMA_PAGO` INT NOT NULL,
  `RTN` VARCHAR(45) NOT NULL,
  `FECHA_EXAMEN` DATE NOT NULL,
  `TOTAL` FLOAT NOT NULL,
  `ESTADO_FACTURA` INT NOT NULL,
  PRIMARY KEY (`ID_FACTURA`),
  INDEX `fk_TBL_FACTURA_TBL_IMPUESTOS1_idx` (`ID_IMPUESTO` ASC),
  INDEX `fk_TBL_FACTURA_TBL_CLIENTE1_idx` (`ID_CLIENTE` ASC),
  INDEX `fk_TBL_FACTURA_TBL_EMPLEADO1_idx` (`ID_EMPLEADO` ASC),
  INDEX `fk_TBL_FACTURA_TBL_FORMAS_PAGO1_idx` (`ID_FORMA_PAGO` ASC),
  CONSTRAINT `fk_TBL_FACTURA_TBL_IMPUESTOS1`
    FOREIGN KEY (`ID_IMPUESTO`)
    REFERENCES `DB_EMANUEL`.`TBL_IMPUESTOS` (`ID_IMPUESTO`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_TBL_FACTURA_TBL_CLIENTE1`
    FOREIGN KEY (`ID_CLIENTE`)
    REFERENCES `DB_EMANUEL`.`TBL_CLIENTE` (`ID_CLIENTE`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_TBL_FACTURA_TBL_EMPLEADO1`
    FOREIGN KEY (`ID_EMPLEADO`)
    REFERENCES `DB_EMANUEL`.`TBL_EMPLEADO` (`ID_EMPLEADO`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_TBL_FACTURA_TBL_FORMAS_PAGO1`
    FOREIGN KEY (`ID_FORMA_PAGO`)
    REFERENCES `DB_EMANUEL`.`TBL_FORMAS_PAGO` (`ID_FORMA_PAGO`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DB_EMANUEL`.`TBL_DESCUENTOS`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `DB_EMANUEL`.`TBL_DESCUENTOS` (
  `ID_DESCUENTOS` INT NOT NULL AUTO_INCREMENT,
  `DESCRIPCION` VARCHAR(50) NOT NULL,
  `PORCENTAJE` FLOAT NOT NULL,
  PRIMARY KEY (`ID_DESCUENTOS`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DB_EMANUEL`.`DESCUENTOS_X_FACTURA`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `DB_EMANUEL`.`DESCUENTOS_X_FACTURA` (
  `ID_DESCUENTOS` INT NOT NULL,
  `ID_FACTURA` INT NOT NULL,
  PRIMARY KEY (`ID_DESCUENTOS`, `ID_FACTURA`),
  INDEX `fk_TBL_DESCUENTOS_has_TBL_FACTURA_TBL_FACTURA1_idx` (`ID_FACTURA` ASC),
  INDEX `fk_TBL_DESCUENTOS_has_TBL_FACTURA_TBL_DESCUENTOS_idx` (`ID_DESCUENTOS` ASC),
  CONSTRAINT `fk_TBL_DESCUENTOS_has_TBL_FACTURA_TBL_DESCUENTOS`
    FOREIGN KEY (`ID_DESCUENTOS`)
    REFERENCES `DB_EMANUEL`.`TBL_DESCUENTOS` (`ID_DESCUENTOS`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_TBL_DESCUENTOS_has_TBL_FACTURA_TBL_FACTURA1`
    FOREIGN KEY (`ID_FACTURA`)
    REFERENCES `DB_EMANUEL`.`TBL_FACTURA` (`ID_FACTURA`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DB_EMANUEL`.`TBL_AREA`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `DB_EMANUEL`.`TBL_AREA` (
  `ID_AREA` INT NOT NULL AUTO_INCREMENT,
  `NOMBRE` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`ID_AREA`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DB_EMANUEL`.`TBL_EXAMENES`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `DB_EMANUEL`.`TBL_EXAMENES` (
  `ID_EXAMEN` INT NOT NULL AUTO_INCREMENT,
  `ID_AREA` INT NOT NULL,
  `NOMBRE` VARCHAR(50) NOT NULL,
  `PRECIO` FLOAT NOT NULL,
  `DESCRIPCION` VARCHAR(100) NOT NULL,
  `TIEMPO_ANALISIS` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`ID_EXAMEN`),
  INDEX `fk_TBL_EXAMENES_TBL_AREA1_idx` (`ID_AREA` ASC),
  CONSTRAINT `fk_TBL_EXAMENES_TBL_AREA1`
    FOREIGN KEY (`ID_AREA`)
    REFERENCES `DB_EMANUEL`.`TBL_AREA` (`ID_AREA`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DB_EMANUEL`.`EXAMENES_X_FACTURA`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `DB_EMANUEL`.`EXAMENES_X_FACTURA` (
  `ID_EXAMEN` INT NOT NULL,
  `ID_FACTURA` INT NOT NULL,
  PRIMARY KEY (`ID_EXAMEN`, `ID_FACTURA`),
  INDEX `fk_TBL_EXAMENES_has_TBL_FACTURA_TBL_FACTURA1_idx` (`ID_FACTURA` ASC),
  INDEX `fk_TBL_EXAMENES_has_TBL_FACTURA_TBL_EXAMENES1_idx` (`ID_EXAMEN` ASC),
  CONSTRAINT `fk_TBL_EXAMENES_has_TBL_FACTURA_TBL_EXAMENES1`
    FOREIGN KEY (`ID_EXAMEN`)
    REFERENCES `DB_EMANUEL`.`TBL_EXAMENES` (`ID_EXAMEN`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_TBL_EXAMENES_has_TBL_FACTURA_TBL_FACTURA1`
    FOREIGN KEY (`ID_FACTURA`)
    REFERENCES `DB_EMANUEL`.`TBL_FACTURA` (`ID_FACTURA`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DB_EMANUEL`.`TBL_PROVEEDORES`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `DB_EMANUEL`.`TBL_PROVEEDORES` (
  `ID_PROVEEDOR` INT NOT NULL AUTO_INCREMENT,
  `PROVEEDOR` VARCHAR(50) NOT NULL,
  `CONTACTO` VARCHAR(50) NOT NULL,
  `AGENTE_VENTAS` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`ID_PROVEEDOR`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DB_EMANUEL`.`TBL_TIPOS_INSUMOS`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `DB_EMANUEL`.`TBL_TIPOS_INSUMOS` (
  `ID_TIPO_INSUMO` INT NOT NULL AUTO_INCREMENT,
  `TIPO_INSUMO` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`ID_TIPO_INSUMO`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DB_EMANUEL`.`TBL_INSUMOS`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `DB_EMANUEL`.`TBL_INSUMOS` (
  `ID_INSUMO` INT NOT NULL AUTO_INCREMENT,
  `ID_TIPO_INSUMO` INT NOT NULL,
  `ID_PROVEEDOR` INT NOT NULL,
  `INSUMO` VARCHAR(50) NOT NULL,
  `DESCRIPCION` VARCHAR(100) NULL,
  `PRECIO_COSTO` FLOAT NOT NULL,
  `CANTIDAD` INT NOT NULL,
  `FECHA_INGRESO` DATE NOT NULL,
  `FECHA_VENC` DATE NOT NULL,
  PRIMARY KEY (`ID_INSUMO`),
  INDEX `fk_TBL_INSUMOS_TBL_PROVEEDORES1_idx` (`ID_PROVEEDOR` ASC),
  INDEX `fk_TBL_INSUMOS_TBL_TIPOS_INSUMOS1_idx` (`ID_TIPO_INSUMO` ASC),
  CONSTRAINT `fk_TBL_INSUMOS_TBL_PROVEEDORES1`
    FOREIGN KEY (`ID_PROVEEDOR`)
    REFERENCES `DB_EMANUEL`.`TBL_PROVEEDORES` (`ID_PROVEEDOR`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_TBL_INSUMOS_TBL_TIPOS_INSUMOS1`
    FOREIGN KEY (`ID_TIPO_INSUMO`)
    REFERENCES `DB_EMANUEL`.`TBL_TIPOS_INSUMOS` (`ID_TIPO_INSUMO`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DB_EMANUEL`.`TBL_RESULTADOS`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `DB_EMANUEL`.`TBL_RESULTADOS` (
  `ID_RESULTADO` INT NOT NULL AUTO_INCREMENT,
  `ID_EXAMEN` INT NOT NULL,
  `ID_CLIENTE` INT NOT NULL,
  `ID_EMPLEADO` INT NOT NULL,
  `FECHA_EMISION` DATE NOT NULL,
  `OBSERVACIONES` VARCHAR(200) NULL,
  PRIMARY KEY (`ID_RESULTADO`),
  INDEX `fk_TBL_RESULTADOS_TBL_EXAMENES1_idx` (`ID_EXAMEN` ASC),
  INDEX `fk_TBL_RESULTADOS_TBL_CLIENTE1_idx` (`ID_CLIENTE` ASC),
  INDEX `fk_TBL_RESULTADOS_TBL_EMPLEADO1_idx` (`ID_EMPLEADO` ASC),
  CONSTRAINT `fk_TBL_RESULTADOS_TBL_EXAMENES1`
    FOREIGN KEY (`ID_EXAMEN`)
    REFERENCES `DB_EMANUEL`.`TBL_EXAMENES` (`ID_EXAMEN`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_TBL_RESULTADOS_TBL_CLIENTE1`
    FOREIGN KEY (`ID_CLIENTE`)
    REFERENCES `DB_EMANUEL`.`TBL_CLIENTE` (`ID_CLIENTE`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_TBL_RESULTADOS_TBL_EMPLEADO1`
    FOREIGN KEY (`ID_EMPLEADO`)
    REFERENCES `DB_EMANUEL`.`TBL_EMPLEADO` (`ID_EMPLEADO`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DB_EMANUEL`.`INSUMOS_X_EXAMENES`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `DB_EMANUEL`.`INSUMOS_X_EXAMENES` (
  `ID_INSUMO` INT NOT NULL,
  `ID_EXAMEN` INT NOT NULL,
  PRIMARY KEY (`ID_INSUMO`, `ID_EXAMEN`),
  INDEX `fk_TBL_INSUMOS_has_TBL_EXAMENES_TBL_EXAMENES1_idx` (`ID_EXAMEN` ASC),
  INDEX `fk_TBL_INSUMOS_has_TBL_EXAMENES_TBL_INSUMOS1_idx` (`ID_INSUMO` ASC),
  CONSTRAINT `fk_TBL_INSUMOS_has_TBL_EXAMENES_TBL_INSUMOS1`
    FOREIGN KEY (`ID_INSUMO`)
    REFERENCES `DB_EMANUEL`.`TBL_INSUMOS` (`ID_INSUMO`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_TBL_INSUMOS_has_TBL_EXAMENES_TBL_EXAMENES1`
    FOREIGN KEY (`ID_EXAMEN`)
    REFERENCES `DB_EMANUEL`.`TBL_EXAMENES` (`ID_EXAMEN`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DB_EMANUEL`.`TBL_CARACTERISTICAS`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `DB_EMANUEL`.`TBL_CARACTERISTICAS` (
  `ID_CARACTERISTICAS` INT NOT NULL AUTO_INCREMENT,
  `CARACTERISTICA` VARCHAR(50) NOT NULL,
  `VALOR_REF` VARCHAR(50) NULL,
  `UNIDADES_MEDIDA` VARCHAR(5) NULL,
  PRIMARY KEY (`ID_CARACTERISTICAS`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DB_EMANUEL`.`TBL_PROMOCIONES`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `DB_EMANUEL`.`TBL_PROMOCIONES` (
  `ID_PROMOCIONES` INT NOT NULL AUTO_INCREMENT,
  `DESCRIPCION` VARCHAR(100) NOT NULL,
  `RESTRICCIONES` VARCHAR(100) NULL,
  `FECHA_INICIO` DATE NOT NULL,
  `FECHA_FIN` DATE NOT NULL,
  PRIMARY KEY (`ID_PROMOCIONES`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DB_EMANUEL`.`PROMOCIONES_X_EXAMENES`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `DB_EMANUEL`.`PROMOCIONES_X_EXAMENES` (
  `TBL_PROMOCIONES_ID_PROMOCIONES` INT NOT NULL,
  `TBL_EXAMENES_ID_EXAMEN` INT NOT NULL,
  PRIMARY KEY (`TBL_PROMOCIONES_ID_PROMOCIONES`, `TBL_EXAMENES_ID_EXAMEN`),
  INDEX `fk_TBL_PROMOCIONES_has_TBL_EXAMENES_TBL_EXAMENES1_idx` (`TBL_EXAMENES_ID_EXAMEN` ASC),
  INDEX `fk_TBL_PROMOCIONES_has_TBL_EXAMENES_TBL_PROMOCIONES1_idx` (`TBL_PROMOCIONES_ID_PROMOCIONES` ASC),
  CONSTRAINT `fk_TBL_PROMOCIONES_has_TBL_EXAMENES_TBL_PROMOCIONES1`
    FOREIGN KEY (`TBL_PROMOCIONES_ID_PROMOCIONES`)
    REFERENCES `DB_EMANUEL`.`TBL_PROMOCIONES` (`ID_PROMOCIONES`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_TBL_PROMOCIONES_has_TBL_EXAMENES_TBL_EXAMENES1`
    FOREIGN KEY (`TBL_EXAMENES_ID_EXAMEN`)
    REFERENCES `DB_EMANUEL`.`TBL_EXAMENES` (`ID_EXAMEN`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DB_EMANUEL`.`TBL_ESTADO_SOLICITUD`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `DB_EMANUEL`.`TBL_ESTADO_SOLICITUD` (
  `ID_ESTADO_SOLICITUD` INT NOT NULL AUTO_INCREMENT,
  `ESTADO_SOLICITUD` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`ID_ESTADO_SOLICITUD`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DB_EMANUEL`.`TBL_SOLICITUDES`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `DB_EMANUEL`.`TBL_SOLICITUDES` (
  `ID_SOLICITUD` INT NOT NULL AUTO_INCREMENT,
  `ID_USUARIO_EMISOR` INT NOT NULL,
  `ID_USUARIO_RECEPTOR` INT NOT NULL,
  `ID_ESTADO_SOLICITUD` INT NOT NULL,
  `DESCRIPCION` VARCHAR(100) NOT NULL,
  `FECHA` DATE NULL,
  PRIMARY KEY (`ID_SOLICITUD`),
  INDEX `fk_TBL_SOLICITUDES_TBL_USUARIOS1_idx` (`ID_USUARIO_EMISOR` ASC),
  INDEX `fk_TBL_SOLICITUDES_TBL_USUARIOS2_idx` (`ID_USUARIO_RECEPTOR` ASC),
  INDEX `fk_TBL_SOLICITUDES_TBL_ESTADO_SOLICITUD1_idx` (`ID_ESTADO_SOLICITUD` ASC),
  CONSTRAINT `fk_TBL_SOLICITUDES_TBL_USUARIOS1`
    FOREIGN KEY (`ID_USUARIO_EMISOR`)
    REFERENCES `DB_EMANUEL`.`TBL_USUARIOS` (`ID_USUARIO`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_TBL_SOLICITUDES_TBL_USUARIOS2`
    FOREIGN KEY (`ID_USUARIO_RECEPTOR`)
    REFERENCES `DB_EMANUEL`.`TBL_USUARIOS` (`ID_USUARIO`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_TBL_SOLICITUDES_TBL_ESTADO_SOLICITUD1`
    FOREIGN KEY (`ID_ESTADO_SOLICITUD`)
    REFERENCES `DB_EMANUEL`.`TBL_ESTADO_SOLICITUD` (`ID_ESTADO_SOLICITUD`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DB_EMANUEL`.`AREA_X_CARACTERISTICAS`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `DB_EMANUEL`.`AREA_X_CARACTERISTICAS` (
  `ID_AREA` INT NOT NULL,
  `ID_CARACTERISTICAS` INT NOT NULL,
  PRIMARY KEY (`ID_AREA`, `ID_CARACTERISTICAS`),
  INDEX `fk_TBL_AREA_has_TBL_CARACTERISTICAS_TBL_CARACTERISTICAS1_idx` (`ID_CARACTERISTICAS` ASC),
  INDEX `fk_TBL_AREA_has_TBL_CARACTERISTICAS_TBL_AREA1_idx` (`ID_AREA` ASC),
  CONSTRAINT `fk_TBL_AREA_has_TBL_CARACTERISTICAS_TBL_AREA1`
    FOREIGN KEY (`ID_AREA`)
    REFERENCES `DB_EMANUEL`.`TBL_AREA` (`ID_AREA`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_TBL_AREA_has_TBL_CARACTERISTICAS_TBL_CARACTERISTICAS1`
    FOREIGN KEY (`ID_CARACTERISTICAS`)
    REFERENCES `DB_EMANUEL`.`TBL_CARACTERISTICAS` (`ID_CARACTERISTICAS`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DB_EMANUEL`.`CARACTERISTICAS_X_RESULTADOS`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `DB_EMANUEL`.`CARACTERISTICAS_X_RESULTADOS` (
  `ID_CARACTERISTICAS` INT NOT NULL,
  `ID_RESULTADO` INT NOT NULL,
  `VALOR_RESULTADO` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`ID_CARACTERISTICAS`, `ID_RESULTADO`),
  INDEX `fk_TBL_CARACTERISTICAS_has_TBL_RESULTADOS_TBL_RESULTADOS1_idx` (`ID_RESULTADO` ASC),
  INDEX `fk_TBL_CARACTERISTICAS_has_TBL_RESULTADOS_TBL_CARACTERISTIC_idx` (`ID_CARACTERISTICAS` ASC),
  CONSTRAINT `fk_TBL_CARACTERISTICAS_has_TBL_RESULTADOS_TBL_CARACTERISTICAS1`
    FOREIGN KEY (`ID_CARACTERISTICAS`)
    REFERENCES `DB_EMANUEL`.`TBL_CARACTERISTICAS` (`ID_CARACTERISTICAS`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_TBL_CARACTERISTICAS_has_TBL_RESULTADOS_TBL_RESULTADOS1`
    FOREIGN KEY (`ID_RESULTADO`)
    REFERENCES `DB_EMANUEL`.`TBL_RESULTADOS` (`ID_RESULTADO`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DB_EMANUEL`.`TBL_BITACORA`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `DB_EMANUEL`.`TBL_BITACORA` (
  `ID_BITACORA` INT NOT NULL AUTO_INCREMENT,
  `ID_USUARIO` INT NOT NULL,
  `DESCRIPCION` VARCHAR(100) NOT NULL,
  `FECHA` DATE NOT NULL,
  PRIMARY KEY (`ID_BITACORA`),
  INDEX `fk_TBL_BITACORA_TBL_USUARIOS1_idx` (`ID_USUARIO` ASC),
  CONSTRAINT `fk_TBL_BITACORA_TBL_USUARIOS1`
    FOREIGN KEY (`ID_USUARIO`)
    REFERENCES `DB_EMANUEL`.`TBL_USUARIOS` (`ID_USUARIO`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;