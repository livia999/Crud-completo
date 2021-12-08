CREATE SCHEMA `crudcomp` ;

CREATE TABLE `crudcomp`.`user` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `user` VARCHAR(45) NULL,
  `pass` VARCHAR(45) NULL,
  PRIMARY KEY (`id`));
INSERT INTO `crudcomp`.`user` (`user`, `pass`) VALUES ('amanda1', '123');
INSERT INTO `crudcomp`.`user` (`user`, `pass`) VALUES ('julia7', '123');
INSERT INTO `crudcomp`.`user` (`user`, `pass`) VALUES ('kleber1', '123');

CREATE TABLE `crudcomp`.`rotulo` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `descricao` VARCHAR(45) NULL,
  PRIMARY KEY (`id`));
INSERT INTO `crudcomp`.`rotulo` (`descricao`) VALUES ('ahdishdfi');
INSERT INTO `crudcomp`.`rotulo` (`descricao`) VALUES ('ihesifdhgfug');
INSERT INTO `crudcomp`.`rotulo` (`descricao`) VALUES ('ihefigwer');
