-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema biblioteca
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `biblioteca` DEFAULT CHARACTER SET utf8 ;
USE `biblioteca` ;

-- -----------------------------------------------------
-- Table `biblioteca`.`usuario`
-- (Mantida - Para administradores / bibliotecários)
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `biblioteca`.`usuario` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(255) NOT NULL,
  `nome` VARCHAR(255) NOT NULL,
  `senha` TEXT NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `biblioteca`.`aluno` (RF2)
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `biblioteca`.`aluno` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `matricula` VARCHAR(45) NOT NULL,
  `telefone` VARCHAR(45) NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC),
  UNIQUE INDEX `matricula_UNIQUE` (`matricula` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `biblioteca`.`autor` (RF3)
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `biblioteca`.`autor` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `biblioteca`.`livro` (RF1)
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `biblioteca`.`livro` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `titulo` VARCHAR(255) NOT NULL,
  `isbn` VARCHAR(20) NULL,
  `editora` VARCHAR(100) NULL,
  `ano_publicacao` INT NULL,
  `quantidade_disponivel` INT NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `isbn_UNIQUE` (`isbn` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `biblioteca`.`emprestimo` (RF4)
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `biblioteca`.`emprestimo` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `data_emprestimo` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `data_devolucao_prevista` DATE NOT NULL,
  `data_devolucao_real` DATETIME NULL,
  `aluno_id` INT NOT NULL,
  `livro_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_emprestimo_aluno_idx` (`aluno_id` ASC),
  INDEX `fk_emprestimo_livro_idx` (`livro_id` ASC),
  CONSTRAINT `fk_emprestimo_aluno`
    FOREIGN KEY (`aluno_id`)
    REFERENCES `biblioteca`.`aluno` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_emprestimo_livro`
    FOREIGN KEY (`livro_id`)
    REFERENCES `biblioteca`.`livro` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `biblioteca`.`livro_autor` (RF1 - Tabela de Ligação N:M)
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `biblioteca`.`livro_autor` (
  `livro_id` INT NOT NULL,
  `autor_id` INT NOT NULL,
  PRIMARY KEY (`livro_id`, `autor_id`),
  INDEX `fk_livro_autor_autor_idx` (`autor_id` ASC),
  INDEX `fk_livro_autor_livro_idx` (`livro_id` ASC),
  CONSTRAINT `fk_livro_autor_livro`
    FOREIGN KEY (`livro_id`)
    REFERENCES `biblioteca`.`livro` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_livro_autor_autor`
    FOREIGN KEY (`autor_id`)
    REFERENCES `biblioteca`.`autor` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;