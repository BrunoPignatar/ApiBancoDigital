-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema Db_BancoDigital
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema Db_BancoDigital
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `Db_BancoDigital` DEFAULT CHARACTER SET utf8 ;
USE `Db_BancoDigital` ;

-- -----------------------------------------------------
-- Table `Db_BancoDigital`.`correntista`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Db_BancoDigital`.`correntista` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `CPF` CHAR(11) NOT NULL,
  `data_nasc` DATE NOT NULL,
  `senha` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Db_BancoDigital`.`conta`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Db_BancoDigital`.`conta` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `tipo` VARCHAR(45) NOT NULL,
  `saldo` DOUBLE NOT NULL,
  `limite` DOUBLE NOT NULL,
  `id_correntista` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_conta_correntista_idx` (`id_correntista` ASC) VISIBLE,
  CONSTRAINT `fk_conta_correntista`
    FOREIGN KEY (`id_correntista`)
    REFERENCES `Db_BancoDigital`.`correntista` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Db_BancoDigital`.`chave_pix`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Db_BancoDigital`.`chave_pix` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `tipo` VARCHAR(45) NOT NULL,
  `chave` VARCHAR(45) NOT NULL,
  `id_conta` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_chavepix_conta_idx` (`id_conta` ASC) VISIBLE,
  CONSTRAINT `fk_chavepix_conta`
    FOREIGN KEY (`id_conta`)
    REFERENCES `Db_BancoDigital`.`conta` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Db_BancoDigital`.`transacao`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Db_BancoDigital`.`transacao` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `valor` DOUBLE NOT NULL,
  `data_transacao` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  `id_conta_enviou` INT NOT NULL,
  `id_conta_recebeu` INT NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_conta_enviou_idx` (`id_conta_enviou` ASC) VISIBLE,
  INDEX `fk_conta_recebeu_idx` (`id_conta_recebeu` ASC) VISIBLE,
  CONSTRAINT `fk_conta_enviou`
    FOREIGN KEY (`id_conta_enviou`)
    REFERENCES `Db_BancoDigital`.`conta` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_conta_recebeu`
    FOREIGN KEY (`id_conta_recebeu`)
    REFERENCES `Db_BancoDigital`.`conta` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
