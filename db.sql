SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `petthar_parks` DEFAULT CHARACTER SET utf8 ;
USE `petthar_parks` ;

-- -----------------------------------------------------
-- Table `petthar_parks`.`members`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `petthar_parks`.`members` (
  `userID` INT NOT NULL AUTO_INCREMENT ,
  `username` VARCHAR(45) NOT NULL ,
  `email` VARCHAR(45) NOT NULL ,
  `dob` VARCHAR(45) NOT NULL ,
  `gender` VARCHAR(45) NOT NULL ,
  `password` VARCHAR(45) NOT NULL ,
  `salt` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`userID`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `petthar_parks`.`items`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `petthar_parks`.`items` (
  `itemID` INT NOT NULL ,
  `parkCode` VARCHAR(45) NOT NULL ,
  `name` VARCHAR(45) NOT NULL ,
  `street` VARCHAR(45) NOT NULL ,
  `suburb` VARCHAR(45) NOT NULL ,
  `easting` DOUBLE NOT NULL ,
  `northing` DOUBLE NOT NULL ,
  `latitude` DOUBLE NOT NULL ,
  `longitude` DOUBLE NOT NULL ,
  PRIMARY KEY (`itemID`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `petthar_parks`.`reviews`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `petthar_parks`.`reviews` (
  `reviewID` INT NOT NULL AUTO_INCREMENT ,
  `datestamp` DATETIME NOT NULL ,
  `userID` INT NOT NULL ,
  `itemID` INT NOT NULL ,
  `stars` INT NOT NULL ,
  `text` TEXT NULL DEFAULT NULL ,
  PRIMARY KEY (`reviewID`) )
ENGINE = InnoDB;

USE `petthar_parks` ;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
