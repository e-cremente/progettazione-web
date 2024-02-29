SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

DROP SCHEMA IF EXISTS `adndproject` ;
CREATE SCHEMA IF NOT EXISTS `adndproject` DEFAULT CHARACTER SET latin1 ;
USE `adndproject` ;

-- -----------------------------------------------------
-- Table `adndproject`.`razza`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `adndproject`.`razza` ;

CREATE  TABLE IF NOT EXISTS `adndproject`.`razza` (
  `idRazza` INT NOT NULL ,
  `Nome` VARCHAR(15) NOT NULL ,
  PRIMARY KEY (`idRazza`) )
ENGINE = InnoDB
COMMENT = 'Contiene le varie tipologie di razze giocabili con un personaggio';


-- -----------------------------------------------------
-- Table `adndproject`.`classe`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `adndproject`.`classe` ;

CREATE  TABLE IF NOT EXISTS `adndproject`.`classe` (
  `idClasse` INT NOT NULL ,
  `Nome` VARCHAR(20) NOT NULL ,
  PRIMARY KEY (`idClasse`) )
ENGINE = InnoDB
COMMENT = 'Contiene le varie classi selezionabili dai vari personaggi';


-- -----------------------------------------------------
-- Table `adndproject`.`allineamento`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `adndproject`.`allineamento` ;

CREATE  TABLE IF NOT EXISTS `adndproject`.`allineamento` (
  `idAllineamento` VARCHAR(2) NOT NULL ,
  `Tipologia` VARCHAR(25) NOT NULL ,
  PRIMARY KEY (`idAllineamento`) )
ENGINE = InnoDB
COMMENT = 'Contiene i possibili allineamenti che un personaggio puo avere';


-- -----------------------------------------------------
-- Table `adndproject`.`personaggi`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `adndproject`.`personaggi` ;

CREATE  TABLE IF NOT EXISTS `adndproject`.`personaggi` (
  `idPersonaggio` INT NOT NULL ,
  `Nome` VARCHAR(20) NOT NULL ,
  `Razza` INT NOT NULL ,
  `Classe` INT NOT NULL ,
  `Classi_Secondarie` VARCHAR(45) NULL ,
  `Allineamento` VARCHAR(2) NOT NULL ,
  `Livello` INT NOT NULL DEFAULT 1 ,
  `Livelli_Secondari` VARCHAR(45) NULL ,
  `Esperienza` INT NOT NULL DEFAULT 0 ,
  `PuntiFerita` INT NULL DEFAULT NULL ,
  `MaxPuntiFerita` INT NULL DEFAULT NULL ,
  `ClasseArmatura` INT NULL DEFAULT NULL ,
  `Origine` VARCHAR(45) NULL DEFAULT NULL ,
  `Famiglia` VARCHAR(45) NULL DEFAULT NULL ,
  `Stirpe_Clan` VARCHAR(45) NULL DEFAULT NULL ,
  `Religione` VARCHAR(45) NULL DEFAULT NULL ,
  `Classe_Sociale` VARCHAR(45) NULL DEFAULT NULL ,
  `Fratelli_Sorelle` VARCHAR(45) NULL DEFAULT NULL ,
  `Sesso` VARCHAR(1) NOT NULL DEFAULT 'M' ,
  `Anni` INT(11) NOT NULL DEFAULT 18 ,
  `Altezza` INT(11) NOT NULL DEFAULT 160 ,
  `Peso` INT(11) NOT NULL DEFAULT 65 ,
  `Capelli` VARCHAR(20) NULL DEFAULT NULL ,
  `Occhi` VARCHAR(20) NULL DEFAULT NULL ,
  `Aspetto` VARCHAR(20) NULL DEFAULT NULL ,
  PRIMARY KEY (`idPersonaggio`) ,
  CONSTRAINT `fk_pg_Razza`
    FOREIGN KEY (`Razza` )
    REFERENCES `adndproject`.`razza` (`idRazza` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_pg_Classe`
    FOREIGN KEY (`Classe` )
    REFERENCES `adndproject`.`classe` (`idClasse` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_pg_Allineamento`
    FOREIGN KEY (`Allineamento` )
    REFERENCES `adndproject`.`allineamento` (`idAllineamento` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1
COMMENT = 'Contiene i personaggi creati dagli utenti e alcune informazioni presenti sulla scheda, sostanzialmente quelle che la maggior parte delle volte sono fisse, o l\'unico modo per cambiarle è a mano dall\'utente.';

CREATE INDEX `fk_pg_Razza` ON `adndproject`.`personaggi` (`Razza` ASC) ;

CREATE INDEX `fk_pg_Classe` ON `adndproject`.`personaggi` (`Classe` ASC) ;

CREATE INDEX `fk_pg_Allineamento` ON `adndproject`.`personaggi` (`Allineamento` ASC) ;


-- -----------------------------------------------------
-- Table `adndproject`.`testoelingua`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `adndproject`.`testoelingua` ;

CREATE  TABLE IF NOT EXISTS `adndproject`.`testoelingua` (
  `idOggetto` DECIMAL(7,0) NOT NULL ,
  `Lingua` VARCHAR(2) NOT NULL ,
  `Testo` TEXT NULL DEFAULT NULL ,
  PRIMARY KEY (`idOggetto`, `Lingua`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1
COMMENT = 'Contiene i testi presenti sul sito in diverse lingue';


-- -----------------------------------------------------
-- Table `adndproject`.`utenti`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `adndproject`.`utenti` ;

CREATE  TABLE IF NOT EXISTS `adndproject`.`utenti` (
  `Username` VARCHAR(32) NOT NULL ,
  `Email` VARCHAR(128) NOT NULL ,
  `Password` LONGTEXT NOT NULL ,
  PRIMARY KEY (`Username`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1
COMMENT = 'Contiene gli utenti registrati nel sito';

CREATE UNIQUE INDEX `UK_Email` ON `adndproject`.`utenti` (`Email` ASC) ;


-- -----------------------------------------------------
-- Table `adndproject`.`vocimenu`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `adndproject`.`vocimenu` ;

CREATE  TABLE IF NOT EXISTS `adndproject`.`vocimenu` (
  `VociMenuId` DECIMAL(7,0) NOT NULL ,
  `Lingua` VARCHAR(2) NULL DEFAULT NULL ,
  `idpadre` INT(11) NULL DEFAULT NULL ,
  `Azione` VARCHAR(256) NULL DEFAULT NULL ,
  PRIMARY KEY (`VociMenuId`) ,
  CONSTRAINT `fk_vm_Lingua`
    FOREIGN KEY (`VociMenuId` , `Lingua` )
    REFERENCES `adndproject`.`testoelingua` (`idOggetto` , `Lingua` )
    ON DELETE NO ACTION
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1
COMMENT = 'Contiene le varie voci presenti nel menu collocato in alto';

CREATE INDEX `fk_vm_Lingua` ON `adndproject`.`vocimenu` (`VociMenuId` ASC, `Lingua` ASC) ;


-- -----------------------------------------------------
-- Table `adndproject`.`abilita`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `adndproject`.`abilita` ;

CREATE  TABLE IF NOT EXISTS `adndproject`.`abilita` (
  `idAbilita` INT NOT NULL ,
  `Nome` VARCHAR(45) NOT NULL ,
  `Skill1` VARCHAR(45) NOT NULL ,
  `Skill2` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`idAbilita`) )
ENGINE = InnoDB
COMMENT = 'Contiene le statistiche principali di ogni personaggio. Ogni personaggio le possiede.';


-- -----------------------------------------------------
-- Table `adndproject`.`pg_abilita`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `adndproject`.`pg_abilita` ;

CREATE  TABLE IF NOT EXISTS `adndproject`.`pg_abilita` (
  `idPersonaggio` INT NOT NULL ,
  `idAbilita` INT NOT NULL ,
  `Val_Abilita` INT NOT NULL ,
  `Val_Skill1` INT NOT NULL ,
  `Val_Skill2` INT NOT NULL ,
  PRIMARY KEY (`idPersonaggio`, `idAbilita`) ,
  CONSTRAINT `fk_pgab_idAbilita`
    FOREIGN KEY (`idAbilita` )
    REFERENCES `adndproject`.`abilita` (`idAbilita` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_pgab_idPersonaggio`
    FOREIGN KEY (`idPersonaggio` )
    REFERENCES `adndproject`.`personaggi` (`idPersonaggio` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
COMMENT = 'Contiene le specifiche abilita dei vari personaggi con i propri valori';

CREATE INDEX `fk_pgab_idAbilita` ON `adndproject`.`pg_abilita` (`idAbilita` ASC) ;

CREATE INDEX `fk_pgab_idPersonaggio` ON `adndproject`.`pg_abilita` (`idPersonaggio` ASC) ;


-- -----------------------------------------------------
-- Table `adndproject`.`tirosalvezza`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `adndproject`.`tirosalvezza` ;

CREATE  TABLE IF NOT EXISTS `adndproject`.`tirosalvezza` (
  `idTiroSalvezza` INT NOT NULL ,
  `NomeTV` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`idTiroSalvezza`) )
ENGINE = InnoDB
COMMENT = 'Contiene le categorie sui quali si puo effettuare un tiro salvezza, tra quelli elencati sulla prima pagina della scheda personaggio';


-- -----------------------------------------------------
-- Table `adndproject`.`pg_tirosalv_mod`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `adndproject`.`pg_tirosalv_mod` ;

CREATE  TABLE IF NOT EXISTS `adndproject`.`pg_tirosalv_mod` (
  `idPersonaggio` INT NOT NULL ,
  `idTiroSalvezza` INT NOT NULL ,
  `Modificatore` INT NOT NULL ,
  PRIMARY KEY (`idPersonaggio`, `idTiroSalvezza`) ,
  CONSTRAINT `fk_pgtv_idPersonaggio`
    FOREIGN KEY (`idPersonaggio` )
    REFERENCES `adndproject`.`personaggi` (`idPersonaggio` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_pgtv_idTiroSalvezza`
    FOREIGN KEY (`idTiroSalvezza` )
    REFERENCES `adndproject`.`tirosalvezza` (`idTiroSalvezza` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
COMMENT = 'Contiene i tiri salvezza specifici per ogni personaggio';

CREATE INDEX `fk_pgtv_idPersonaggio` ON `adndproject`.`pg_tirosalv_mod` (`idPersonaggio` ASC) ;

CREATE INDEX `fk_pgtv_idTiroSalvezza` ON `adndproject`.`pg_tirosalv_mod` (`idTiroSalvezza` ASC) ;


-- -----------------------------------------------------
-- Table `adndproject`.`moneta`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `adndproject`.`moneta` ;

CREATE  TABLE IF NOT EXISTS `adndproject`.`moneta` (
  `idMoneta` INT NOT NULL ,
  `Materiale` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`idMoneta`) )
ENGINE = InnoDB
COMMENT = 'Contiene i vari tipi di monete inclusi nel gioco';


-- -----------------------------------------------------
-- Table `adndproject`.`pg_moneta`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `adndproject`.`pg_moneta` ;

CREATE  TABLE IF NOT EXISTS `adndproject`.`pg_moneta` (
  `idPersonaggio` INT NOT NULL ,
  `idMoneta` INT NOT NULL ,
  `Quantita` INT NULL ,
  PRIMARY KEY (`idPersonaggio`, `idMoneta`) ,
  CONSTRAINT `fk_pgmo_idPersonaggio`
    FOREIGN KEY (`idPersonaggio` )
    REFERENCES `adndproject`.`personaggi` (`idPersonaggio` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_pgmo_idMoneta`
    FOREIGN KEY (`idMoneta` )
    REFERENCES `adndproject`.`moneta` (`idMoneta` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
COMMENT = 'Contiene le monete possedute dai singoli personaggi';

CREATE INDEX `fk_pgmo_idPersonaggio` ON `adndproject`.`pg_moneta` (`idPersonaggio` ASC) ;

CREATE INDEX `fk_pgmo_idMoneta` ON `adndproject`.`pg_moneta` (`idMoneta` ASC) ;


-- -----------------------------------------------------
-- Table `adndproject`.`requisitirazza`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `adndproject`.`requisitirazza` ;

CREATE  TABLE IF NOT EXISTS `adndproject`.`requisitirazza` (
  `idRazza` INT NOT NULL ,
  `idAbilita` INT NOT NULL ,
  `ValoreMinimo` INT NOT NULL ,
  PRIMARY KEY (`idRazza`, `idAbilita`) ,
  CONSTRAINT `fk_reqraz_idRazza`
    FOREIGN KEY (`idRazza` )
    REFERENCES `adndproject`.`razza` (`idRazza` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_reqraz_idAbilita`
    FOREIGN KEY (`idAbilita` )
    REFERENCES `adndproject`.`abilita` (`idAbilita` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
COMMENT = 'Contiene i valori minimi di ogni caratteristica, per ogni razza.';

CREATE INDEX `fk_reqraz_idRazza` ON `adndproject`.`requisitirazza` (`idRazza` ASC) ;

CREATE INDEX `fk_reqraz_idAbilita` ON `adndproject`.`requisitirazza` (`idAbilita` ASC) ;


-- -----------------------------------------------------
-- Table `adndproject`.`requisiticlasse`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `adndproject`.`requisiticlasse` ;

CREATE  TABLE IF NOT EXISTS `adndproject`.`requisiticlasse` (
  `idClasse` INT NOT NULL ,
  `idAbilita` INT NOT NULL ,
  `ValoreMinimo` INT NOT NULL ,
  PRIMARY KEY (`idClasse`, `idAbilita`) ,
  CONSTRAINT `fk_reqcla_idClasse`
    FOREIGN KEY (`idClasse` )
    REFERENCES `adndproject`.`classe` (`idClasse` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_reqcla_idAbilita`
    FOREIGN KEY (`idAbilita` )
    REFERENCES `adndproject`.`abilita` (`idAbilita` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
COMMENT = 'Contiene il valore minimo di ogni caratteristica per ogni classe (se non c\'e un valore minimo, non e specificato)';

CREATE INDEX `fk_reqcla_idClasse` ON `adndproject`.`requisiticlasse` (`idClasse` ASC) ;

CREATE INDEX `fk_reqcla_idAbilita` ON `adndproject`.`requisiticlasse` (`idAbilita` ASC) ;


-- -----------------------------------------------------
-- Table `adndproject`.`restr_classe_razza`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `adndproject`.`restr_classe_razza` ;

CREATE  TABLE IF NOT EXISTS `adndproject`.`restr_classe_razza` (
  `idClasse` INT NOT NULL ,
  `idRazza` INT NOT NULL ,
  PRIMARY KEY (`idClasse`, `idRazza`) ,
  CONSTRAINT `fk_restr_idClasse`
    FOREIGN KEY (`idClasse` )
    REFERENCES `adndproject`.`classe` (`idClasse` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_restr_idRazza`
    FOREIGN KEY (`idRazza` )
    REFERENCES `adndproject`.`razza` (`idRazza` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
COMMENT = 'Contiene le restrizioni per le varie classi. Alcune razze possono scegliere solo determinate classi. Qui e contenuto quali.';

CREATE INDEX `fk_restr_idClasse` ON `adndproject`.`restr_classe_razza` (`idClasse` ASC) ;

CREATE INDEX `fk_restr_idRazza` ON `adndproject`.`restr_classe_razza` (`idRazza` ASC) ;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `adndproject`.`razza`
-- -----------------------------------------------------
SET AUTOCOMMIT=0;
USE `adndproject`;
INSERT INTO `adndproject`.`razza` (`idRazza`, `Nome`) VALUES ('1', 'Nano');
INSERT INTO `adndproject`.`razza` (`idRazza`, `Nome`) VALUES ('2', 'Elfo');
INSERT INTO `adndproject`.`razza` (`idRazza`, `Nome`) VALUES ('3', 'Gnomo');
INSERT INTO `adndproject`.`razza` (`idRazza`, `Nome`) VALUES ('4', 'Mezzelfo');
INSERT INTO `adndproject`.`razza` (`idRazza`, `Nome`) VALUES ('5', 'Halfling');
INSERT INTO `adndproject`.`razza` (`idRazza`, `Nome`) VALUES ('6', 'Umano');

COMMIT;

-- -----------------------------------------------------
-- Data for table `adndproject`.`classe`
-- -----------------------------------------------------
SET AUTOCOMMIT=0;
USE `adndproject`;
INSERT INTO `adndproject`.`classe` (`idClasse`, `Nome`) VALUES ('1', 'Guerriero');
INSERT INTO `adndproject`.`classe` (`idClasse`, `Nome`) VALUES ('2', 'Ranger');
INSERT INTO `adndproject`.`classe` (`idClasse`, `Nome`) VALUES ('3', 'Paladino');
INSERT INTO `adndproject`.`classe` (`idClasse`, `Nome`) VALUES ('4', 'Mago');
INSERT INTO `adndproject`.`classe` (`idClasse`, `Nome`) VALUES ('5', 'Chierico');
INSERT INTO `adndproject`.`classe` (`idClasse`, `Nome`) VALUES ('6', 'Druido');
INSERT INTO `adndproject`.`classe` (`idClasse`, `Nome`) VALUES ('7', 'Ladro');
INSERT INTO `adndproject`.`classe` (`idClasse`, `Nome`) VALUES ('8', 'Bardo');

COMMIT;

-- -----------------------------------------------------
-- Data for table `adndproject`.`allineamento`
-- -----------------------------------------------------
SET AUTOCOMMIT=0;
USE `adndproject`;
INSERT INTO `adndproject`.`allineamento` (`idAllineamento`, `Tipologia`) VALUES ('1', 'Legale Buono');
INSERT INTO `adndproject`.`allineamento` (`idAllineamento`, `Tipologia`) VALUES ('2', 'Legale Neutrale');
INSERT INTO `adndproject`.`allineamento` (`idAllineamento`, `Tipologia`) VALUES ('3', 'Legale Malvagio');
INSERT INTO `adndproject`.`allineamento` (`idAllineamento`, `Tipologia`) VALUES ('4', 'Neutrale Buono');
INSERT INTO `adndproject`.`allineamento` (`idAllineamento`, `Tipologia`) VALUES ('5', 'Neutrale Puro');
INSERT INTO `adndproject`.`allineamento` (`idAllineamento`, `Tipologia`) VALUES ('6', 'Neutrale Malvagio');
INSERT INTO `adndproject`.`allineamento` (`idAllineamento`, `Tipologia`) VALUES ('7', 'Caotico Buono');
INSERT INTO `adndproject`.`allineamento` (`idAllineamento`, `Tipologia`) VALUES ('8', 'Caotico Neutrale');
INSERT INTO `adndproject`.`allineamento` (`idAllineamento`, `Tipologia`) VALUES ('9', 'Caotico Malvagio');

COMMIT;

-- -----------------------------------------------------
-- Data for table `adndproject`.`testoelingua`
-- -----------------------------------------------------
SET AUTOCOMMIT=0;
USE `adndproject`;
INSERT INTO `adndproject`.`testoelingua` (`idOggetto`, `Lingua`, `Testo`) VALUES ('100100', 'en', 'Start Here');
INSERT INTO `adndproject`.`testoelingua` (`idOggetto`, `Lingua`, `Testo`) VALUES ('100100', 'fr', 'Commence Ici');
INSERT INTO `adndproject`.`testoelingua` (`idOggetto`, `Lingua`, `Testo`) VALUES ('100100', 'it', 'Inizia Da Qui');
INSERT INTO `adndproject`.`testoelingua` (`idOggetto`, `Lingua`, `Testo`) VALUES ('100200', 'it', 'Crea');
INSERT INTO `adndproject`.`testoelingua` (`idOggetto`, `Lingua`, `Testo`) VALUES ('100201', 'it', 'Nuovo Personaggio');
INSERT INTO `adndproject`.`testoelingua` (`idOggetto`, `Lingua`, `Testo`) VALUES ('100202', 'it', 'Nuova Campagna');
INSERT INTO `adndproject`.`testoelingua` (`idOggetto`, `Lingua`, `Testo`) VALUES ('100300', 'it', 'Esplora');
INSERT INTO `adndproject`.`testoelingua` (`idOggetto`, `Lingua`, `Testo`) VALUES ('100301', 'it', 'Personaggi');
INSERT INTO `adndproject`.`testoelingua` (`idOggetto`, `Lingua`, `Testo`) VALUES ('100302', 'it', 'Campagne');
INSERT INTO `adndproject`.`testoelingua` (`idOggetto`, `Lingua`, `Testo`) VALUES ('100400', 'it', 'Manuali');

COMMIT;

-- -----------------------------------------------------
-- Data for table `adndproject`.`utenti`
-- -----------------------------------------------------
SET AUTOCOMMIT=0;
USE `adndproject`;
INSERT INTO `adndproject`.`utenti` (`Username`, `Email`, `Password`) VALUES ('admin', 'edoardo.cremente@tiscali.it', '$2y$10$Sxc6NG1DBiN5RPDjr6AW2eo0xB7VyF2WNzQwB8R6gYZKRD0oZPhs2');
INSERT INTO `adndproject`.`utenti` (`Username`, `Email`, `Password`) VALUES ('Iperione', 'andba9710@gmail.com', '$2y$10$AI3jFYxo9Bqiyj8Od4bekO5oMzNOcCgbfO2G9PWrL/txeKzKbvQXK');
INSERT INTO `adndproject`.`utenti` (`Username`, `Email`, `Password`) VALUES ('marcello', 'marcello.cremente@tiscali.it', '$2y$10$w5TBYjc0lcDdXqcjgcDsqOSAfE0l4dZNHWd/inQ0e1t0/9AS178GW');

COMMIT;

-- -----------------------------------------------------
-- Data for table `adndproject`.`vocimenu`
-- -----------------------------------------------------
SET AUTOCOMMIT=0;
USE `adndproject`;
INSERT INTO `adndproject`.`vocimenu` (`VociMenuId`, `Lingua`, `idpadre`, `Azione`) VALUES ('100100', 'it', NULL, 'IniziaDaQui.php');
INSERT INTO `adndproject`.`vocimenu` (`VociMenuId`, `Lingua`, `idpadre`, `Azione`) VALUES ('100200', 'it', NULL, NULL);
INSERT INTO `adndproject`.`vocimenu` (`VociMenuId`, `Lingua`, `idpadre`, `Azione`) VALUES ('100201', 'it', '100200', 'CreaNuovoPersonaggio.php');
INSERT INTO `adndproject`.`vocimenu` (`VociMenuId`, `Lingua`, `idpadre`, `Azione`) VALUES ('100202', 'it', '100200', 'CreaNuovaCampagna.php');
INSERT INTO `adndproject`.`vocimenu` (`VociMenuId`, `Lingua`, `idpadre`, `Azione`) VALUES ('100300', 'it', NULL, NULL);
INSERT INTO `adndproject`.`vocimenu` (`VociMenuId`, `Lingua`, `idpadre`, `Azione`) VALUES ('100301', 'it', '100300', 'EsploraPersonaggi.php');
INSERT INTO `adndproject`.`vocimenu` (`VociMenuId`, `Lingua`, `idpadre`, `Azione`) VALUES ('100302', 'it', '100300', 'EsploraCampagne.php');
INSERT INTO `adndproject`.`vocimenu` (`VociMenuId`, `Lingua`, `idpadre`, `Azione`) VALUES ('100400', 'it', NULL, 'Manuali.php');

COMMIT;

-- -----------------------------------------------------
-- Data for table `adndproject`.`abilita`
-- -----------------------------------------------------
SET AUTOCOMMIT=0;
USE `adndproject`;
INSERT INTO `adndproject`.`abilita` (`idAbilita`, `Nome`, `Skill1`, `Skill2`) VALUES ('1', 'Forza', 'Energia', 'Muscoli');
INSERT INTO `adndproject`.`abilita` (`idAbilita`, `Nome`, `Skill1`, `Skill2`) VALUES ('2', 'Destrezza', 'Mira', 'Equilibrio');
INSERT INTO `adndproject`.`abilita` (`idAbilita`, `Nome`, `Skill1`, `Skill2`) VALUES ('3', 'Costituzione', 'Salute', 'FormaFisica');
INSERT INTO `adndproject`.`abilita` (`idAbilita`, `Nome`, `Skill1`, `Skill2`) VALUES ('4', 'Intelligenza', 'Ragione', 'Conoscenza');
INSERT INTO `adndproject`.`abilita` (`idAbilita`, `Nome`, `Skill1`, `Skill2`) VALUES ('5', 'Saggezza', 'Intuizione', 'ForzaDiVolonta');
INSERT INTO `adndproject`.`abilita` (`idAbilita`, `Nome`, `Skill1`, `Skill2`) VALUES ('6', 'Carisma', 'Comando', 'Fascino');

COMMIT;

-- -----------------------------------------------------
-- Data for table `adndproject`.`tirosalvezza`
-- -----------------------------------------------------
SET AUTOCOMMIT=0;
USE `adndproject`;
INSERT INTO `adndproject`.`tirosalvezza` (`idTiroSalvezza`, `NomeTV`) VALUES ('1', 'Paralisi_Veleno_Morte');
INSERT INTO `adndproject`.`tirosalvezza` (`idTiroSalvezza`, `NomeTV`) VALUES ('2', 'Verghe_Bast_Bacch');
INSERT INTO `adndproject`.`tirosalvezza` (`idTiroSalvezza`, `NomeTV`) VALUES ('3', 'Pietrificazione_Pol');
INSERT INTO `adndproject`.`tirosalvezza` (`idTiroSalvezza`, `NomeTV`) VALUES ('4', 'Soffio');
INSERT INTO `adndproject`.`tirosalvezza` (`idTiroSalvezza`, `NomeTV`) VALUES ('5', 'Incantesimi');

COMMIT;

-- -----------------------------------------------------
-- Data for table `adndproject`.`moneta`
-- -----------------------------------------------------
SET AUTOCOMMIT=0;
USE `adndproject`;
INSERT INTO `adndproject`.`moneta` (`idMoneta`, `Materiale`) VALUES ('1', 'Rame');
INSERT INTO `adndproject`.`moneta` (`idMoneta`, `Materiale`) VALUES ('2', 'Argento');
INSERT INTO `adndproject`.`moneta` (`idMoneta`, `Materiale`) VALUES ('3', 'Electrum');
INSERT INTO `adndproject`.`moneta` (`idMoneta`, `Materiale`) VALUES ('4', 'Oro');
INSERT INTO `adndproject`.`moneta` (`idMoneta`, `Materiale`) VALUES ('5', 'Platino');

COMMIT;

-- -----------------------------------------------------
-- Data for table `adndproject`.`requisitirazza`
-- -----------------------------------------------------
SET AUTOCOMMIT=0;
USE `adndproject`;
INSERT INTO `adndproject`.`requisitirazza` (`idRazza`, `idAbilita`, `ValoreMinimo`) VALUES ('1', '1', '8');
INSERT INTO `adndproject`.`requisitirazza` (`idRazza`, `idAbilita`, `ValoreMinimo`) VALUES ('1', '2', '3');
INSERT INTO `adndproject`.`requisitirazza` (`idRazza`, `idAbilita`, `ValoreMinimo`) VALUES ('1', '3', '1');
INSERT INTO `adndproject`.`requisitirazza` (`idRazza`, `idAbilita`, `ValoreMinimo`) VALUES ('1', '4', '3');
INSERT INTO `adndproject`.`requisitirazza` (`idRazza`, `idAbilita`, `ValoreMinimo`) VALUES ('1', '5', '3');
INSERT INTO `adndproject`.`requisitirazza` (`idRazza`, `idAbilita`, `ValoreMinimo`) VALUES ('1', '6', '3');
INSERT INTO `adndproject`.`requisitirazza` (`idRazza`, `idAbilita`, `ValoreMinimo`) VALUES ('2', '1', '3');
INSERT INTO `adndproject`.`requisitirazza` (`idRazza`, `idAbilita`, `ValoreMinimo`) VALUES ('2', '2', '6');
INSERT INTO `adndproject`.`requisitirazza` (`idRazza`, `idAbilita`, `ValoreMinimo`) VALUES ('2', '3', '7');
INSERT INTO `adndproject`.`requisitirazza` (`idRazza`, `idAbilita`, `ValoreMinimo`) VALUES ('2', '4', '8');
INSERT INTO `adndproject`.`requisitirazza` (`idRazza`, `idAbilita`, `ValoreMinimo`) VALUES ('2', '5', '3');
INSERT INTO `adndproject`.`requisitirazza` (`idRazza`, `idAbilita`, `ValoreMinimo`) VALUES ('2', '6', '8');
INSERT INTO `adndproject`.`requisitirazza` (`idRazza`, `idAbilita`, `ValoreMinimo`) VALUES ('3', '1', '6');
INSERT INTO `adndproject`.`requisitirazza` (`idRazza`, `idAbilita`, `ValoreMinimo`) VALUES ('3', '2', '3');
INSERT INTO `adndproject`.`requisitirazza` (`idRazza`, `idAbilita`, `ValoreMinimo`) VALUES ('3', '3', '8');
INSERT INTO `adndproject`.`requisitirazza` (`idRazza`, `idAbilita`, `ValoreMinimo`) VALUES ('3', '4', '6');
INSERT INTO `adndproject`.`requisitirazza` (`idRazza`, `idAbilita`, `ValoreMinimo`) VALUES ('3', '5', '3');
INSERT INTO `adndproject`.`requisitirazza` (`idRazza`, `idAbilita`, `ValoreMinimo`) VALUES ('3', '6', '3');
INSERT INTO `adndproject`.`requisitirazza` (`idRazza`, `idAbilita`, `ValoreMinimo`) VALUES ('4', '1', '3');
INSERT INTO `adndproject`.`requisitirazza` (`idRazza`, `idAbilita`, `ValoreMinimo`) VALUES ('4', '2', '6');
INSERT INTO `adndproject`.`requisitirazza` (`idRazza`, `idAbilita`, `ValoreMinimo`) VALUES ('4', '3', '6');
INSERT INTO `adndproject`.`requisitirazza` (`idRazza`, `idAbilita`, `ValoreMinimo`) VALUES ('4', '4', '4');
INSERT INTO `adndproject`.`requisitirazza` (`idRazza`, `idAbilita`, `ValoreMinimo`) VALUES ('4', '5', '3');
INSERT INTO `adndproject`.`requisitirazza` (`idRazza`, `idAbilita`, `ValoreMinimo`) VALUES ('4', '6', '3');
INSERT INTO `adndproject`.`requisitirazza` (`idRazza`, `idAbilita`, `ValoreMinimo`) VALUES ('5', '1', '7');
INSERT INTO `adndproject`.`requisitirazza` (`idRazza`, `idAbilita`, `ValoreMinimo`) VALUES ('5', '2', '7');
INSERT INTO `adndproject`.`requisitirazza` (`idRazza`, `idAbilita`, `ValoreMinimo`) VALUES ('5', '3', '10');
INSERT INTO `adndproject`.`requisitirazza` (`idRazza`, `idAbilita`, `ValoreMinimo`) VALUES ('5', '4', '6');
INSERT INTO `adndproject`.`requisitirazza` (`idRazza`, `idAbilita`, `ValoreMinimo`) VALUES ('5', '5', '3');
INSERT INTO `adndproject`.`requisitirazza` (`idRazza`, `idAbilita`, `ValoreMinimo`) VALUES ('5', '6', '3');

COMMIT;

-- -----------------------------------------------------
-- Data for table `adndproject`.`requisiticlasse`
-- -----------------------------------------------------
SET AUTOCOMMIT=0;
USE `adndproject`;
INSERT INTO `adndproject`.`requisiticlasse` (`idClasse`, `idAbilita`, `ValoreMinimo`) VALUES ('1', '1', '9');
INSERT INTO `adndproject`.`requisiticlasse` (`idClasse`, `idAbilita`, `ValoreMinimo`) VALUES ('2', '1', '13');
INSERT INTO `adndproject`.`requisiticlasse` (`idClasse`, `idAbilita`, `ValoreMinimo`) VALUES ('2', '2', '13');
INSERT INTO `adndproject`.`requisiticlasse` (`idClasse`, `idAbilita`, `ValoreMinimo`) VALUES ('2', '3', '14');
INSERT INTO `adndproject`.`requisiticlasse` (`idClasse`, `idAbilita`, `ValoreMinimo`) VALUES ('2', '5', '14');
INSERT INTO `adndproject`.`requisiticlasse` (`idClasse`, `idAbilita`, `ValoreMinimo`) VALUES ('3', '1', '12');
INSERT INTO `adndproject`.`requisiticlasse` (`idClasse`, `idAbilita`, `ValoreMinimo`) VALUES ('3', '3', '9');
INSERT INTO `adndproject`.`requisiticlasse` (`idClasse`, `idAbilita`, `ValoreMinimo`) VALUES ('3', '5', '13');
INSERT INTO `adndproject`.`requisiticlasse` (`idClasse`, `idAbilita`, `ValoreMinimo`) VALUES ('3', '6', '17');
INSERT INTO `adndproject`.`requisiticlasse` (`idClasse`, `idAbilita`, `ValoreMinimo`) VALUES ('4', '4', '9');
INSERT INTO `adndproject`.`requisiticlasse` (`idClasse`, `idAbilita`, `ValoreMinimo`) VALUES ('5', '5', '9');
INSERT INTO `adndproject`.`requisiticlasse` (`idClasse`, `idAbilita`, `ValoreMinimo`) VALUES ('6', '5', '12');
INSERT INTO `adndproject`.`requisiticlasse` (`idClasse`, `idAbilita`, `ValoreMinimo`) VALUES ('6', '6', '15');
INSERT INTO `adndproject`.`requisiticlasse` (`idClasse`, `idAbilita`, `ValoreMinimo`) VALUES ('7', '2', '9');
INSERT INTO `adndproject`.`requisiticlasse` (`idClasse`, `idAbilita`, `ValoreMinimo`) VALUES ('8', '2', '12');
INSERT INTO `adndproject`.`requisiticlasse` (`idClasse`, `idAbilita`, `ValoreMinimo`) VALUES ('8', '4', '13');
INSERT INTO `adndproject`.`requisiticlasse` (`idClasse`, `idAbilita`, `ValoreMinimo`) VALUES ('8', '6', '15');

COMMIT;

-- -----------------------------------------------------
-- Data for table `adndproject`.`restr_classe_razza`
-- -----------------------------------------------------
SET AUTOCOMMIT=0;
USE `adndproject`;
INSERT INTO `adndproject`.`restr_classe_razza` (`idClasse`, `idRazza`) VALUES ('3', '6');
INSERT INTO `adndproject`.`restr_classe_razza` (`idClasse`, `idRazza`) VALUES ('2', '2');
INSERT INTO `adndproject`.`restr_classe_razza` (`idClasse`, `idRazza`) VALUES ('2', '4');
INSERT INTO `adndproject`.`restr_classe_razza` (`idClasse`, `idRazza`) VALUES ('2', '6');
INSERT INTO `adndproject`.`restr_classe_razza` (`idClasse`, `idRazza`) VALUES ('4', '2');
INSERT INTO `adndproject`.`restr_classe_razza` (`idClasse`, `idRazza`) VALUES ('4', '4');
INSERT INTO `adndproject`.`restr_classe_razza` (`idClasse`, `idRazza`) VALUES ('4', '6');
INSERT INTO `adndproject`.`restr_classe_razza` (`idClasse`, `idRazza`) VALUES ('5', '1');
INSERT INTO `adndproject`.`restr_classe_razza` (`idClasse`, `idRazza`) VALUES ('5', '2');
INSERT INTO `adndproject`.`restr_classe_razza` (`idClasse`, `idRazza`) VALUES ('5', '3');
INSERT INTO `adndproject`.`restr_classe_razza` (`idClasse`, `idRazza`) VALUES ('5', '4');
INSERT INTO `adndproject`.`restr_classe_razza` (`idClasse`, `idRazza`) VALUES ('5', '6');
INSERT INTO `adndproject`.`restr_classe_razza` (`idClasse`, `idRazza`) VALUES ('6', '4');
INSERT INTO `adndproject`.`restr_classe_razza` (`idClasse`, `idRazza`) VALUES ('6', '6');
INSERT INTO `adndproject`.`restr_classe_razza` (`idClasse`, `idRazza`) VALUES ('8', '4');
INSERT INTO `adndproject`.`restr_classe_razza` (`idClasse`, `idRazza`) VALUES ('8', '6');

COMMIT;
