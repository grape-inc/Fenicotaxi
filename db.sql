-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema fenicotaxi
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema fenicotaxi
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `fenicotaxi` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci ;
USE `fenicotaxi` ;

-- -----------------------------------------------------
-- Table `fenicotaxi`.`cargo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `fenicotaxi`.`cargo` (
  `ID_Cargo` INT NOT NULL AUTO_INCREMENT,
  `Nombre_Cargo` VARCHAR(60) NOT NULL,
  `Salario_Cargo` DECIMAL(10,0) NULL DEFAULT NULL,
  PRIMARY KEY (`ID_Cargo`))
ENGINE = InnoDB
AUTO_INCREMENT = 6
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `fenicotaxi`.`rol`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `fenicotaxi`.`rol` (
  `ID_Rol` INT NOT NULL AUTO_INCREMENT,
  `Nombre_Rol` VARCHAR(80) NOT NULL,
  PRIMARY KEY (`ID_Rol`))
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `fenicotaxi`.`empleado`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `fenicotaxi`.`empleado` (
  `ID_Empleado` INT NOT NULL AUTO_INCREMENT,
  `Nombre_Empleado` VARCHAR(100) NOT NULL,
  `Apellido_Empleado` VARCHAR(100) NOT NULL,
  `Fecha_Nacimiento` DATE NOT NULL,
  `Cedula` VARCHAR(20) NOT NULL,
  `Fecha_Ingreso` DATE NOT NULL,
  `Usuario` VARCHAR(25) NULL DEFAULT NULL,
  `Password` VARCHAR(150) NULL DEFAULT NULL,
  `Correo` VARCHAR(100) NOT NULL,
  `ID_Cargo` INT NULL DEFAULT NULL,
  `Imagen` LONGTEXT NULL DEFAULT NULL,
  `ID_Rol` INT NULL DEFAULT NULL,
  PRIMARY KEY (`ID_Empleado`),
  INDEX `fk_Empleado_Cargo_1` (`ID_Cargo` ASC) VISIBLE,
  INDEX `fk_Empleado_Rol_1` (`ID_Rol` ASC) VISIBLE,
  CONSTRAINT `fk_Empleado_Cargo_1`
    FOREIGN KEY (`ID_Cargo`)
    REFERENCES `fenicotaxi`.`cargo` (`ID_Cargo`),
  CONSTRAINT `fk_Empleado_Rol_1`
    FOREIGN KEY (`ID_Rol`)
    REFERENCES `fenicotaxi`.`rol` (`ID_Rol`))
ENGINE = InnoDB
AUTO_INCREMENT = 17
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `fenicotaxi`.`arqueocaja`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `fenicotaxi`.`arqueocaja` (
  `ID_Jornada` INT NOT NULL AUTO_INCREMENT,
  `Saldo_Inicial` DECIMAL(10,0) NOT NULL,
  `Saldo_Final` DECIMAL(10,0) NULL DEFAULT NULL,
  `ID_Empleado` INT NOT NULL,
  `Fecha_Jornada` DATE NOT NULL,
  `Jornada_Abierta` BIT(1) NOT NULL,
  `B10` INT NULL DEFAULT NULL,
  `B20` INT NULL DEFAULT NULL,
  `B50` INT NULL DEFAULT NULL,
  `B100` INT NULL DEFAULT NULL,
  `B200` INT NULL DEFAULT NULL,
  `B500` INT NULL DEFAULT NULL,
  `B1000` INT NULL DEFAULT NULL,
  `M025` INT NULL DEFAULT NULL,
  `M050` INT NULL DEFAULT NULL,
  `M1` INT NULL DEFAULT NULL,
  `M5` INT NULL DEFAULT NULL,
  `Fecha_Actualizacion` DATE NOT NULL,
  `Fecha_Caja` DATE NULL DEFAULT NULL,
  `BD1` INT NULL DEFAULT NULL,
  `BD2` INT NULL DEFAULT NULL,
  `BD5` INT NULL DEFAULT NULL,
  `BD10` INT NULL DEFAULT NULL,
  `BD20` INT NULL DEFAULT NULL,
  `BD50` INT NULL DEFAULT NULL,
  `BD100` INT NULL DEFAULT NULL,
  `Saldo_Final_Dolar` DECIMAL(10,0) NULL DEFAULT NULL,
  `Centavos_Dolar` DECIMAL(10,0) NULL DEFAULT NULL,
  `Centavos_Cordobas` DECIMAL(10,0) NULL DEFAULT NULL,
  PRIMARY KEY (`ID_Jornada`),
  INDEX `fk_ArqueoCaja_Empleado_1` (`ID_Empleado` ASC) VISIBLE,
  CONSTRAINT `fk_ArqueoCaja_Empleado_1`
    FOREIGN KEY (`ID_Empleado`)
    REFERENCES `fenicotaxi`.`empleado` (`ID_Empleado`))
ENGINE = InnoDB
AUTO_INCREMENT = 29
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `fenicotaxi`.`cliente`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `fenicotaxi`.`cliente` (
  `ID_Cliente` INT NOT NULL AUTO_INCREMENT,
  `Nombre_Cliente` VARCHAR(100) NOT NULL,
  `Apellido_Cliente` VARCHAR(100) NOT NULL,
  `Cedula` VARCHAR(20) NOT NULL,
  `Fecha_Ingreso` DATETIME NOT NULL,
  `Correo` VARCHAR(100) NOT NULL,
  `Fecha_Realizacion` DATETIME NOT NULL,
  `Direccion` VARCHAR(150) NOT NULL,
  PRIMARY KEY (`ID_Cliente`))
ENGINE = InnoDB
AUTO_INCREMENT = 16
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `fenicotaxi`.`divisa`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `fenicotaxi`.`divisa` (
  `ID_Divisa` INT NOT NULL AUTO_INCREMENT,
  `Nombre_Divisa` VARCHAR(50) NOT NULL,
  `Equivalencia_Cordoba` DECIMAL(10,2) NULL DEFAULT NULL,
  `Simbolo_Divisa` VARCHAR(20) NULL DEFAULT NULL,
  PRIMARY KEY (`ID_Divisa`))
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `fenicotaxi`.`factura_venta`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `fenicotaxi`.`factura_venta` (
  `ID_Factura` INT NOT NULL AUTO_INCREMENT,
  `Codigo_Factura` VARCHAR(16) NOT NULL,
  `ID_Divisa` INT NOT NULL,
  `Es_Credito` BIT(1) NOT NULL,
  `Descuento` FLOAT NOT NULL,
  `SubTotal` DECIMAL(10,2) NOT NULL,
  `Total_Facturado` DECIMAL(10,2) NOT NULL,
  `ID_Empleado` INT NOT NULL,
  `Fecha_Realizacion` DATE NOT NULL,
  `Fecha_Actualizacion` DATE NOT NULL,
  `ID_Cliente` INT NOT NULL,
  `Monto_Restante` DECIMAL(10,0) NULL DEFAULT NULL,
  `ID_Jornada` INT NULL DEFAULT NULL,
  `Observacion` VARCHAR(300) NULL DEFAULT NULL,
  `IVA` DECIMAL(10,2) NULL DEFAULT NULL,
  PRIMARY KEY (`ID_Factura`),
  INDEX `fk_Factura_Venta_Divisa_1` (`ID_Divisa` ASC) VISIBLE,
  INDEX `fk_Factura_Venta_Empleado_1` (`ID_Empleado` ASC) VISIBLE,
  INDEX `fk_Factura_Venta_ArqueoCaja_1` (`ID_Jornada` ASC) VISIBLE,
  INDEX `fk_Factura_Venta_Cliente_1` (`ID_Cliente` ASC) VISIBLE,
  CONSTRAINT `fk_Factura_Venta_ArqueoCaja_1`
    FOREIGN KEY (`ID_Jornada`)
    REFERENCES `fenicotaxi`.`arqueocaja` (`ID_Jornada`),
  CONSTRAINT `fk_Factura_Venta_Cliente_1`
    FOREIGN KEY (`ID_Cliente`)
    REFERENCES `fenicotaxi`.`cliente` (`ID_Cliente`),
  CONSTRAINT `fk_Factura_Venta_Divisa_1`
    FOREIGN KEY (`ID_Divisa`)
    REFERENCES `fenicotaxi`.`divisa` (`ID_Divisa`),
  CONSTRAINT `fk_Factura_Venta_Empleado_1`
    FOREIGN KEY (`ID_Empleado`)
    REFERENCES `fenicotaxi`.`empleado` (`ID_Empleado`))
ENGINE = InnoDB
AUTO_INCREMENT = 105
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `fenicotaxi`.`abono`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `fenicotaxi`.`abono` (
  `ID_Abono` INT NOT NULL AUTO_INCREMENT,
  `Numero_Factura` INT NOT NULL,
  `Monto_Abonado` DECIMAL(10,0) NOT NULL,
  `Descripcion_Abono` VARCHAR(200) NOT NULL,
  `Fecha_Realizacion` DATETIME NOT NULL,
  PRIMARY KEY (`ID_Abono`),
  INDEX `fk_Abono_Factura_Venta_1` (`Numero_Factura` ASC) VISIBLE,
  CONSTRAINT `fk_Abono_Factura_Venta_1`
    FOREIGN KEY (`Numero_Factura`)
    REFERENCES `fenicotaxi`.`factura_venta` (`ID_Factura`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `fenicotaxi`.`categoria_producto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `fenicotaxi`.`categoria_producto` (
  `ID_Categoria` INT NOT NULL AUTO_INCREMENT,
  `Nombre_Categoria` VARCHAR(50) NOT NULL,
  `Descripcion_Categoria` VARCHAR(150) NOT NULL,
  PRIMARY KEY (`ID_Categoria`))
ENGINE = InnoDB
AUTO_INCREMENT = 32
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `fenicotaxi`.`empleado_hora_laborada`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `fenicotaxi`.`empleado_hora_laborada` (
  `ID_Empleado` INT NOT NULL,
  `Fecha_Registro` DATE NOT NULL,
  `Horas_Laboradas` INT NULL DEFAULT NULL,
  PRIMARY KEY (`ID_Empleado`, `Fecha_Registro`),
  CONSTRAINT `ID_Empledo_FK`
    FOREIGN KEY (`ID_Empleado`)
    REFERENCES `fenicotaxi`.`empleado` (`ID_Empleado`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `fenicotaxi`.`proveedor`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `fenicotaxi`.`proveedor` (
  `ID_Proveedor` INT NOT NULL AUTO_INCREMENT,
  `Nombre_Proveedor` VARCHAR(60) NOT NULL,
  `Direccion_Proveedor` VARCHAR(200) NOT NULL,
  `Telefono` VARCHAR(20) NOT NULL,
  `Contacto_Proveedor` VARCHAR(80) NULL DEFAULT NULL,
  PRIMARY KEY (`ID_Proveedor`))
ENGINE = InnoDB
AUTO_INCREMENT = 26
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `fenicotaxi`.`unidad_medida`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `fenicotaxi`.`unidad_medida` (
  `ID_Unidad` INT NOT NULL AUTO_INCREMENT,
  `Nombre_Unidad` VARCHAR(60) NULL DEFAULT NULL,
  PRIMARY KEY (`ID_Unidad`))
ENGINE = InnoDB
AUTO_INCREMENT = 17
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `fenicotaxi`.`producto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `fenicotaxi`.`producto` (
  `ID_Producto` INT NOT NULL AUTO_INCREMENT,
  `Cod_Producto` VARCHAR(150) NOT NULL,
  `Nombre_Producto` VARCHAR(200) NOT NULL,
  `Descripcion_Producto` VARCHAR(500) NOT NULL,
  `Existencias` DECIMAL(10,2) NOT NULL,
  `Existencias_Minimas` DECIMAL(10,2) NOT NULL,
  `Precio_Venta` DECIMAL(10,3) NOT NULL,
  `ID_Categoria` INT NOT NULL,
  `ID_Proveedor` INT NOT NULL,
  `ID_Divisa` INT NOT NULL,
  `ID_UnidadMedida` INT NOT NULL,
  `Es_Repuesto` BIT(1) NOT NULL,
  `Año` VARCHAR(4) NULL DEFAULT NULL,
  `Modelo` VARCHAR(200) NULL DEFAULT NULL,
  `Origen` VARCHAR(200) NULL DEFAULT NULL,
  `Marca` VARCHAR(200) NULL DEFAULT NULL,
  `Imagen` LONGTEXT NULL DEFAULT NULL,
  PRIMARY KEY (`ID_Producto`),
  INDEX `fk_Producto_Categoria_Producto_1` (`ID_Categoria` ASC) VISIBLE,
  INDEX `fk_Producto_Divisa_1` (`ID_Divisa` ASC) VISIBLE,
  INDEX `fk_Producto_Proveedor_1` (`ID_Proveedor` ASC) VISIBLE,
  INDEX `fk_Producto_Unidad_Medida_1` (`ID_UnidadMedida` ASC) VISIBLE,
  CONSTRAINT `fk_Producto_Categoria_Producto_1`
    FOREIGN KEY (`ID_Categoria`)
    REFERENCES `fenicotaxi`.`categoria_producto` (`ID_Categoria`),
  CONSTRAINT `fk_Producto_Divisa_1`
    FOREIGN KEY (`ID_Divisa`)
    REFERENCES `fenicotaxi`.`divisa` (`ID_Divisa`),
  CONSTRAINT `fk_Producto_Proveedor_1`
    FOREIGN KEY (`ID_Proveedor`)
    REFERENCES `fenicotaxi`.`proveedor` (`ID_Proveedor`),
  CONSTRAINT `fk_Producto_Unidad_Medida_1`
    FOREIGN KEY (`ID_UnidadMedida`)
    REFERENCES `fenicotaxi`.`unidad_medida` (`ID_Unidad`))
ENGINE = InnoDB
AUTO_INCREMENT = 66
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `fenicotaxi`.`factura_venta_detalle`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `fenicotaxi`.`factura_venta_detalle` (
  `ID_Factura` INT NOT NULL,
  `ID_Producto` INT NOT NULL,
  `Cantidad` INT NOT NULL,
  `Descuento_Individual` FLOAT NULL DEFAULT NULL,
  `Precio` DECIMAL(30,2) NULL DEFAULT NULL,
  `Observacion` VARCHAR(200) NULL DEFAULT NULL,
  INDEX `fk_Factura_Venta_Detalle_Producto_1` (`ID_Producto` ASC) INVISIBLE,
  CONSTRAINT `fk_Factura_Venta_Detalle_Producto_1`
    FOREIGN KEY (`ID_Producto`)
    REFERENCES `fenicotaxi`.`producto` (`ID_Producto`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `fenicotaxi`.`factura_venta_pago`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `fenicotaxi`.`factura_venta_pago` (
  `factura_venta_id` INT NOT NULL,
  `tipo_pago_id` INT NULL DEFAULT NULL,
  `tipo_divisa_id` INT NULL DEFAULT NULL,
  `monto` DECIMAL(10,2) NULL DEFAULT NULL)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `fenicotaxi`.`ingreso`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `fenicotaxi`.`ingreso` (
  `ID_Ingreso` INT NOT NULL AUTO_INCREMENT,
  `ID_Proveedor` INT NOT NULL,
  `ID_Empleado` INT NOT NULL,
  `Fecha_Realizacion` DATETIME NULL DEFAULT NULL,
  `Impuesto` DECIMAL(10,2) NULL DEFAULT NULL,
  `Total` DECIMAL(10,2) NULL DEFAULT NULL,
  `Codigo_Ingreso` INT NOT NULL,
  `ID_Divisa` INT NOT NULL,
  PRIMARY KEY (`ID_Ingreso`),
  INDEX `ID_Proveedor_idx` (`ID_Proveedor` ASC) VISIBLE,
  INDEX `ID_Empleado_idx` (`ID_Empleado` ASC) VISIBLE,
  INDEX `Codigo_Ingreso_idx` (`Codigo_Ingreso` ASC) VISIBLE,
  INDEX `ID_Divisa_idx` (`ID_Divisa` ASC) VISIBLE,
  CONSTRAINT `ID_Divisa`
    FOREIGN KEY (`ID_Divisa`)
    REFERENCES `fenicotaxi`.`divisa` (`ID_Divisa`),
  CONSTRAINT `ID_Empleado`
    FOREIGN KEY (`ID_Empleado`)
    REFERENCES `fenicotaxi`.`empleado` (`ID_Empleado`),
  CONSTRAINT `ID_Proveedor`
    FOREIGN KEY (`ID_Proveedor`)
    REFERENCES `fenicotaxi`.`proveedor` (`ID_Proveedor`))
ENGINE = InnoDB
AUTO_INCREMENT = 27
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `fenicotaxi`.`ingreso_detalle`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `fenicotaxi`.`ingreso_detalle` (
  `ID` INT NOT NULL AUTO_INCREMENT,
  `ID_Producto` INT NOT NULL,
  `Cantidad` INT NOT NULL,
  `Precio` DECIMAL(10,2) NOT NULL,
  `ID_Ingreso` INT NOT NULL,
  PRIMARY KEY (`ID`),
  INDEX `ID_Producto_idx` (`ID_Producto` ASC) VISIBLE,
  INDEX `ID_Ingreso_idx` (`ID_Ingreso` ASC) VISIBLE,
  CONSTRAINT `ID_Ingreso`
    FOREIGN KEY (`ID_Ingreso`)
    REFERENCES `fenicotaxi`.`ingreso` (`ID_Ingreso`),
  CONSTRAINT `ID_Producto`
    FOREIGN KEY (`ID_Producto`)
    REFERENCES `fenicotaxi`.`producto` (`ID_Producto`))
ENGINE = InnoDB
AUTO_INCREMENT = 29
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `fenicotaxi`.`nomina_empleado`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `fenicotaxi`.`nomina_empleado` (
  `ID_Nomina` INT NOT NULL AUTO_INCREMENT,
  `Año_Nomina` VARCHAR(4) NOT NULL,
  `Mes_Nomina` VARCHAR(30) NOT NULL,
  `Fecha_Generado` DATETIME NOT NULL,
  `Empleado_Genero` INT NOT NULL,
  `Total_Bruto` DECIMAL(10,2) NULL DEFAULT NULL,
  `Total_Deducciones` DECIMAL(10,2) NULL DEFAULT NULL,
  `Total_Nomina` DECIMAL(10,2) NULL DEFAULT NULL,
  PRIMARY KEY (`ID_Nomina`),
  UNIQUE INDEX `Año_Nomina_UNIQUE` (`Año_Nomina` ASC, `Mes_Nomina` ASC) VISIBLE,
  INDEX `fk_Nomina_Empleado_Empleado_1` (`Empleado_Genero` ASC) VISIBLE,
  CONSTRAINT `fk_Nomina_Empleado_Empleado_1`
    FOREIGN KEY (`Empleado_Genero`)
    REFERENCES `fenicotaxi`.`empleado` (`ID_Empleado`))
ENGINE = InnoDB
AUTO_INCREMENT = 126
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `fenicotaxi`.`nominadetalle`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `fenicotaxi`.`nominadetalle` (
  `ID_Nomina` INT NOT NULL,
  `ID_Empleado` INT NOT NULL,
  `Salario_Bruto` DECIMAL(10,2) NOT NULL,
  `INSS_Laboral` DECIMAL(10,2) NOT NULL,
  `IR_Laboral` DECIMAL(10,2) NOT NULL,
  `Total_Neto` DECIMAL(10,2) NOT NULL,
  `Horas_Laboradas` INT NULL DEFAULT NULL,
  INDEX `fk_NominaDetalle_Empleado_1` (`ID_Empleado` ASC) VISIBLE,
  CONSTRAINT `fk_NominaDetalle_Empleado_1`
    FOREIGN KEY (`ID_Empleado`)
    REFERENCES `fenicotaxi`.`empleado` (`ID_Empleado`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `fenicotaxi`.`tipo_factura`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `fenicotaxi`.`tipo_factura` (
  `ID_TipoFactura` INT NOT NULL AUTO_INCREMENT,
  `NombreTipo` VARCHAR(60) NOT NULL,
  PRIMARY KEY (`ID_TipoFactura`))
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `fenicotaxi`.`tipo_pago`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `fenicotaxi`.`tipo_pago` (
  `ID` INT NOT NULL AUTO_INCREMENT,
  `Tipo_Pago` VARCHAR(100) NULL DEFAULT NULL,
  PRIMARY KEY (`ID`))
ENGINE = InnoDB
AUTO_INCREMENT = 5
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;

USE `fenicotaxi`;

DELIMITER $$
USE `fenicotaxi`$$
CREATE
DEFINER=`admin`@`%`
TRIGGER `fenicotaxi`.`tr_DeleteStockVenta`
AFTER DELETE ON `fenicotaxi`.`factura_venta_detalle`
FOR EACH ROW
BEGIN
     UPDATE Producto SET Existencias = Existencias + OLD.Cantidad
        WHERE Producto.ID_Producto = OLD.ID_Producto;
END$$

USE `fenicotaxi`$$
CREATE
DEFINER=`admin`@`%`
TRIGGER `fenicotaxi`.`tr_updStockVenta`
AFTER INSERT ON `fenicotaxi`.`factura_venta_detalle`
FOR EACH ROW
BEGIN
     UPDATE Producto SET Existencias = Existencias - NEW.Cantidad
        WHERE Producto.ID_Producto = NEW.ID_Producto;
END$$

USE `fenicotaxi`$$
CREATE
DEFINER=`admin`@`%`
TRIGGER `fenicotaxi`.`tr_updStockIngreso`
AFTER INSERT ON `fenicotaxi`.`ingreso_detalle`
FOR EACH ROW
BEGIN
     UPDATE Producto SET Existencias = Existencias + NEW.Cantidad
        WHERE Producto.ID_Producto = NEW.ID_Producto;
END$$


DELIMITER ;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
