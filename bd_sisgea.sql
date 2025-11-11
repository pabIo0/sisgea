-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema sisgea_db
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema sisgea_db
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `sisgea_db` DEFAULT CHARACTER SET utf8 ;
USE `sisgea_db` ;

-- -----------------------------------------------------
-- Table `USUARIOS`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `USUARIOS` ;

CREATE TABLE IF NOT EXISTS `USUARIOS` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `senha` VARCHAR(255) NOT NULL,
  `perfil` ENUM('organizador', 'participante') NOT NULL DEFAULT 'participante',
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `EVENTOS`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `EVENTOS` ;

CREATE TABLE IF NOT EXISTS `EVENTOS` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `titulo` VARCHAR(255) NOT NULL,
  `descricao` TEXT NOT NULL,
  `data` DATE NOT NULL,
  `hora` TIME NULL,
  `local` VARCHAR(255) NOT NULL,
  `limite_vagas` INT NOT NULL DEFAULT 0,
  `usuario_id` INT NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `usuario_id_idx` (`usuario_id` ASC),
  INDEX `idx_data` (`data` ASC),
  CONSTRAINT `usuario_id`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `USUARIOS` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `INSCRICOES`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `INSCRICOES` ;

CREATE TABLE IF NOT EXISTS `INSCRICOES` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `usuario_id` INT NOT NULL,
  `evento_id` INT NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `usuario_id_idx` (`usuario_id` ASC),
  INDEX `evento_id_idx` (`evento_id` ASC),
  UNIQUE INDEX `unique_inscricao` (`usuario_id` ASC, `evento_id` ASC),
  CONSTRAINT `fk_inscricoes_usuarios`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `USUARIOS` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_inscricoes_eventos`
    FOREIGN KEY (`evento_id`)
    REFERENCES `EVENTOS` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
