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
  `Ferite` INT NULL DEFAULT NULL ,
  `MaxPuntiFerita` INT NULL DEFAULT NULL ,
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
  `Modificatore` INT NULL ,
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


-- -----------------------------------------------------
-- Table `adndproject`.`proficienze`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `adndproject`.`proficienze` ;

CREATE  TABLE IF NOT EXISTS `adndproject`.`proficienze` (
  `idProficienza` INT NOT NULL ,
  `Nome` VARCHAR(45) NOT NULL ,
  `Categoria` VARCHAR(45) NOT NULL ,
  `CostoPP` INT NOT NULL ,
  `ValoreBase` INT NOT NULL ,
  `Abilita` VARCHAR(256) NOT NULL ,
  PRIMARY KEY (`idProficienza`) )
ENGINE = InnoDB
COMMENT = 'Contiene tutte le proficienze';


-- -----------------------------------------------------
-- Table `adndproject`.`pg_proficienze`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `adndproject`.`pg_proficienze` ;

CREATE  TABLE IF NOT EXISTS `adndproject`.`pg_proficienze` (
  `idPersonaggio` INT NOT NULL ,
  `idProficienza` INT NOT NULL ,
  `Valore` INT NOT NULL ,
  PRIMARY KEY (`idPersonaggio`, `idProficienza`) ,
  CONSTRAINT `fk_prof_personaggio`
    FOREIGN KEY (`idPersonaggio` )
    REFERENCES `adndproject`.`personaggi` (`idPersonaggio` )
    ON DELETE NO ACTION
    ON UPDATE CASCADE,
  CONSTRAINT `fk_prof_proficienza`
    FOREIGN KEY (`idProficienza` )
    REFERENCES `adndproject`.`proficienze` (`idProficienza` )
    ON DELETE NO ACTION
    ON UPDATE CASCADE)
ENGINE = InnoDB
COMMENT = 'Contiene le proficienze specifiche di un personaggio';

CREATE INDEX `fk_prof_personaggio` ON `adndproject`.`pg_proficienze` (`idPersonaggio` ASC) ;

CREATE INDEX `fk_prof_proficienza` ON `adndproject`.`pg_proficienze` (`idProficienza` ASC) ;


-- -----------------------------------------------------
-- Table `adndproject`.`armatura`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `adndproject`.`armatura` ;

CREATE  TABLE IF NOT EXISTS `adndproject`.`armatura` (
  `idArmatura` INT NOT NULL ,
  `Categoria` VARCHAR(256) NOT NULL ,
  `CA` INT NULL ,
  PRIMARY KEY (`idArmatura`) )
ENGINE = InnoDB
COMMENT = 'Contiene la lista delle armature';


-- -----------------------------------------------------
-- Table `adndproject`.`pg_armatura`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `adndproject`.`pg_armatura` ;

CREATE  TABLE IF NOT EXISTS `adndproject`.`pg_armatura` (
  `idPersonaggio` INT NOT NULL ,
  `idArmatura` INT NOT NULL ,
  `CA` INT NOT NULL ,
  `Attiva` TINYINT(1)  NOT NULL ,
  PRIMARY KEY (`idPersonaggio`, `idArmatura`) ,
  CONSTRAINT `fk_armor_idPersonaggio`
    FOREIGN KEY (`idPersonaggio` )
    REFERENCES `adndproject`.`personaggi` (`idPersonaggio` )
    ON DELETE NO ACTION
    ON UPDATE CASCADE,
  CONSTRAINT `fk_armor_idArmatura`
    FOREIGN KEY (`idArmatura` )
    REFERENCES `adndproject`.`armatura` (`idArmatura` )
    ON DELETE NO ACTION
    ON UPDATE CASCADE)
ENGINE = InnoDB
COMMENT = 'Contiene l\'armatura indossata dal personaggio ';

CREATE INDEX `fk_armor_idPersonaggio` ON `adndproject`.`pg_armatura` (`idPersonaggio` ASC) ;

CREATE INDEX `fk_armor_idArmatura` ON `adndproject`.`pg_armatura` (`idArmatura` ASC) ;


-- -----------------------------------------------------
-- Table `adndproject`.`arma`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `adndproject`.`arma` ;

CREATE  TABLE IF NOT EXISTS `adndproject`.`arma` (
  `idArma` INT NOT NULL ,
  `Nome` VARCHAR(128) NOT NULL ,
  `Costo` VARCHAR(16) NOT NULL ,
  `Peso` FLOAT NOT NULL ,
  `Taglia` VARCHAR(1) NOT NULL ,
  `Tipo` VARCHAR(8) NULL ,
  `FattoreVelocita` INT NULL ,
  `DannoPM` VARCHAR(8) NULL ,
  `DannoG` VARCHAR(8) NULL ,
  `Categoria` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`idArma`) )
ENGINE = InnoDB
COMMENT = 'Contiene l\'elenco delle armi';


-- -----------------------------------------------------
-- Table `adndproject`.`pg_arma`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `adndproject`.`pg_arma` ;

CREATE  TABLE IF NOT EXISTS `adndproject`.`pg_arma` (
  `idPersonaggio` INT NOT NULL ,
  `idArma` INT NOT NULL ,
  PRIMARY KEY (`idPersonaggio`, `idArma`) ,
  CONSTRAINT `fk_weapon_idPersonaggio`
    FOREIGN KEY (`idPersonaggio` )
    REFERENCES `adndproject`.`personaggi` (`idPersonaggio` )
    ON DELETE NO ACTION
    ON UPDATE CASCADE,
  CONSTRAINT `fk_weapon_idArma`
    FOREIGN KEY (`idArma` )
    REFERENCES `adndproject`.`arma` (`idArma` )
    ON DELETE NO ACTION
    ON UPDATE CASCADE)
ENGINE = InnoDB
COMMENT = 'Contiene le armi possedute dai personaggi';

CREATE INDEX `fk_weapon_idPersonaggio` ON `adndproject`.`pg_arma` (`idPersonaggio` ASC) ;

CREATE INDEX `fk_weapon_idArma` ON `adndproject`.`pg_arma` (`idArma` ASC) ;


-- -----------------------------------------------------
-- Table `adndproject`.`tratti`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `adndproject`.`tratti` ;

CREATE  TABLE IF NOT EXISTS `adndproject`.`tratti` (
  `idTratto` INT NOT NULL ,
  `Nome` VARCHAR(45) NOT NULL ,
  `CostoPP` INT NOT NULL ,
  PRIMARY KEY (`idTratto`) )
ENGINE = InnoDB
COMMENT = 'Contiene tutti i possibili tratti ereditari acquisibili';


-- -----------------------------------------------------
-- Table `adndproject`.`pg_tratti`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `adndproject`.`pg_tratti` ;

CREATE  TABLE IF NOT EXISTS `adndproject`.`pg_tratti` (
  `idPersonaggio` INT NOT NULL ,
  `idTratto` INT NOT NULL ,
  PRIMARY KEY (`idPersonaggio`, `idTratto`) ,
  CONSTRAINT `fk_tratti_idPersonaggio`
    FOREIGN KEY (`idPersonaggio` )
    REFERENCES `adndproject`.`personaggi` (`idPersonaggio` )
    ON DELETE NO ACTION
    ON UPDATE CASCADE,
  CONSTRAINT `fk_tratti_idTratto`
    FOREIGN KEY (`idTratto` )
    REFERENCES `adndproject`.`tratti` (`idTratto` )
    ON DELETE NO ACTION
    ON UPDATE CASCADE)
ENGINE = InnoDB
COMMENT = 'Contiene i tratti specifici dei personaggi';

CREATE INDEX `fk_tratti_idPersonaggio` ON `adndproject`.`pg_tratti` (`idPersonaggio` ASC) ;

CREATE INDEX `fk_tratti_idTratto` ON `adndproject`.`pg_tratti` (`idTratto` ASC) ;


-- -----------------------------------------------------
-- Table `adndproject`.`svantaggi`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `adndproject`.`svantaggi` ;

CREATE  TABLE IF NOT EXISTS `adndproject`.`svantaggi` (
  `idSvantaggio` INT NOT NULL ,
  `Nome` VARCHAR(45) NOT NULL ,
  `PPModerato` INT NOT NULL ,
  `PPGrave` INT NULL ,
  PRIMARY KEY (`idSvantaggio`) )
ENGINE = InnoDB
COMMENT = 'Contiene tutti i possibili svantaggi';


-- -----------------------------------------------------
-- Table `adndproject`.`pg_svantaggi`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `adndproject`.`pg_svantaggi` ;

CREATE  TABLE IF NOT EXISTS `adndproject`.`pg_svantaggi` (
  `idPersonaggio` INT NOT NULL ,
  `idSvantaggio` INT NOT NULL ,
  `Grave` TINYINT(1)  NOT NULL DEFAULT 0 ,
  PRIMARY KEY (`idPersonaggio`, `idSvantaggio`) ,
  CONSTRAINT `fk_svantaggi_idPersonaggio`
    FOREIGN KEY (`idPersonaggio` )
    REFERENCES `adndproject`.`personaggi` (`idPersonaggio` )
    ON DELETE NO ACTION
    ON UPDATE CASCADE,
  CONSTRAINT `fk_svantaggi_idSvantaggio`
    FOREIGN KEY (`idSvantaggio` )
    REFERENCES `adndproject`.`svantaggi` (`idSvantaggio` )
    ON DELETE NO ACTION
    ON UPDATE CASCADE)
ENGINE = InnoDB
COMMENT = 'Contiene tutti gli svantaggi dei personaggi specifici';

CREATE INDEX `fk_svantaggi_idPersonaggio` ON `adndproject`.`pg_svantaggi` (`idPersonaggio` ASC) ;

CREATE INDEX `fk_svantaggi_idSvantaggio` ON `adndproject`.`pg_svantaggi` (`idSvantaggio` ASC) ;


-- -----------------------------------------------------
-- Table `adndproject`.`abilitadirazza`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `adndproject`.`abilitadirazza` ;

CREATE  TABLE IF NOT EXISTS `adndproject`.`abilitadirazza` (
  `idAbilitadirazza` INT NOT NULL ,
  `Nome` VARCHAR(45) NOT NULL ,
  `Razza` INT NOT NULL ,
  PRIMARY KEY (`idAbilitadirazza`) ,
  CONSTRAINT `fk_abilitadirazza_Razza`
    FOREIGN KEY (`Razza` )
    REFERENCES `adndproject`.`razza` (`idRazza` )
    ON DELETE NO ACTION
    ON UPDATE CASCADE)
ENGINE = InnoDB
COMMENT = 'Contiene tutte le abilita di razza, con le razze da cui possono essere apprese';

CREATE INDEX `fk_abilitadirazza_Razza` ON `adndproject`.`abilitadirazza` (`Razza` ASC) ;


-- -----------------------------------------------------
-- Table `adndproject`.`pg_abilitadirazza`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `adndproject`.`pg_abilitadirazza` ;

CREATE  TABLE IF NOT EXISTS `adndproject`.`pg_abilitadirazza` (
  `idPersonaggio` INT NOT NULL ,
  `idAbilitadirazza` INT NOT NULL ,
  PRIMARY KEY (`idPersonaggio`, `idAbilitadirazza`) ,
  CONSTRAINT `fk_pgabdirazza_idPersonaggio`
    FOREIGN KEY (`idPersonaggio` )
    REFERENCES `adndproject`.`personaggi` (`idPersonaggio` )
    ON DELETE NO ACTION
    ON UPDATE CASCADE,
  CONSTRAINT `fk_pgabdirazza_idAbilitadirazza`
    FOREIGN KEY (`idAbilitadirazza` )
    REFERENCES `adndproject`.`abilitadirazza` (`idAbilitadirazza` )
    ON DELETE NO ACTION
    ON UPDATE CASCADE)
ENGINE = InnoDB
COMMENT = 'Contiene le abilita di razza specifiche dei personaggi';

CREATE INDEX `fk_pgabdirazza_idPersonaggio` ON `adndproject`.`pg_abilitadirazza` (`idPersonaggio` ASC) ;

CREATE INDEX `fk_pgabdirazza_idAbilitadirazza` ON `adndproject`.`pg_abilitadirazza` (`idAbilitadirazza` ASC) ;


-- -----------------------------------------------------
-- Table `adndproject`.`abilitadiclasse`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `adndproject`.`abilitadiclasse` ;

CREATE  TABLE IF NOT EXISTS `adndproject`.`abilitadiclasse` (
  `idAbilitadiclasse` INT NOT NULL ,
  `Nome` VARCHAR(45) NOT NULL ,
  `Classe` INT NOT NULL ,
  PRIMARY KEY (`idAbilitadiclasse`) ,
  CONSTRAINT `fk_abdiclasse_Classe`
    FOREIGN KEY (`Classe` )
    REFERENCES `adndproject`.`classe` (`idClasse` )
    ON DELETE NO ACTION
    ON UPDATE CASCADE)
ENGINE = InnoDB
COMMENT = 'Contiene le varie abilita di classe';

CREATE INDEX `fk_abdiclasse_Classe` ON `adndproject`.`abilitadiclasse` (`Classe` ASC) ;


-- -----------------------------------------------------
-- Table `adndproject`.`pg_abilitadiclasse`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `adndproject`.`pg_abilitadiclasse` ;

CREATE  TABLE IF NOT EXISTS `adndproject`.`pg_abilitadiclasse` (
  `idPersonaggio` INT NOT NULL ,
  `idAbilitadiclasse` INT NOT NULL ,
  PRIMARY KEY (`idPersonaggio`, `idAbilitadiclasse`) ,
  CONSTRAINT `fk_pgabdiclasse_idPersonaggio`
    FOREIGN KEY (`idPersonaggio` )
    REFERENCES `adndproject`.`personaggi` (`idPersonaggio` )
    ON DELETE NO ACTION
    ON UPDATE CASCADE,
  CONSTRAINT `fk_pgabdiclasse_idAbilitadiclasse`
    FOREIGN KEY (`idAbilitadiclasse` )
    REFERENCES `adndproject`.`abilitadiclasse` (`idAbilitadiclasse` )
    ON DELETE NO ACTION
    ON UPDATE CASCADE)
ENGINE = InnoDB
COMMENT = 'Contiene le abilita di classe specifiche dei personaggi';

CREATE INDEX `fk_pgabdiclasse_idPersonaggio` ON `adndproject`.`pg_abilitadiclasse` (`idPersonaggio` ASC) ;

CREATE INDEX `fk_pgabdiclasse_idAbilitadiclasse` ON `adndproject`.`pg_abilitadiclasse` (`idAbilitadiclasse` ASC) ;


-- -----------------------------------------------------
-- Table `adndproject`.`pg_proficienzearmi`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `adndproject`.`pg_proficienzearmi` ;

CREATE  TABLE IF NOT EXISTS `adndproject`.`pg_proficienzearmi` (
  `idPersonaggio` INT NOT NULL ,
  `idArma` INT NOT NULL ,
  `PP` INT NULL ,
  `Scelta` TINYINT(1)  NULL ,
  `Esperto` TINYINT(1)  NULL ,
  `Specializzato` TINYINT(1)  NULL ,
  `Maestro` TINYINT(1)  NULL ,
  `Alto` TINYINT(1)  NULL ,
  `Grande` TINYINT(1)  NULL ,
  PRIMARY KEY (`idPersonaggio`, `idArma`) ,
  CONSTRAINT `fk_profarmi_idPersonaggio`
    FOREIGN KEY (`idPersonaggio` )
    REFERENCES `adndproject`.`personaggi` (`idPersonaggio` )
    ON DELETE NO ACTION
    ON UPDATE CASCADE,
  CONSTRAINT `fk_profarmi_idArma`
    FOREIGN KEY (`idArma` )
    REFERENCES `adndproject`.`arma` (`idArma` )
    ON DELETE NO ACTION
    ON UPDATE CASCADE)
ENGINE = InnoDB
COMMENT = 'Contiene le varie proficienze delle armi dei vari personaggi';

CREATE INDEX `fk_profarmi_idPersonaggio` ON `adndproject`.`pg_proficienzearmi` (`idPersonaggio` ASC) ;

CREATE INDEX `fk_profarmi_idArma` ON `adndproject`.`pg_proficienzearmi` (`idArma` ASC) ;


-- -----------------------------------------------------
-- Table `adndproject`.`stilicombattimento`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `adndproject`.`stilicombattimento` ;

CREATE  TABLE IF NOT EXISTS `adndproject`.`stilicombattimento` (
  `idStile` INT NOT NULL ,
  `Nome` VARCHAR(45) NOT NULL ,
  `Effetto` TEXT NULL ,
  PRIMARY KEY (`idStile`) )
ENGINE = InnoDB
COMMENT = 'Contiene gli stili di combattimento apprendibili dai personaggi';


-- -----------------------------------------------------
-- Table `adndproject`.`pg_stilicombattimento`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `adndproject`.`pg_stilicombattimento` ;

CREATE  TABLE IF NOT EXISTS `adndproject`.`pg_stilicombattimento` (
  `idPersonaggio` INT NOT NULL ,
  `idStile` INT NOT NULL ,
  `PP` INT NULL ,
  `Specializzazione` TINYINT(1)  NULL ,
  PRIMARY KEY (`idPersonaggio`, `idStile`) ,
  CONSTRAINT `fk_stilicombatt_idPersonaggio`
    FOREIGN KEY (`idPersonaggio` )
    REFERENCES `adndproject`.`personaggi` (`idPersonaggio` )
    ON DELETE NO ACTION
    ON UPDATE CASCADE,
  CONSTRAINT `fk_stilicombatt_idStile`
    FOREIGN KEY (`idStile` )
    REFERENCES `adndproject`.`stilicombattimento` (`idStile` )
    ON DELETE NO ACTION
    ON UPDATE CASCADE)
ENGINE = InnoDB
COMMENT = 'Contiene gli stili di combattimento dei personaggi specifici';

CREATE INDEX `fk_stilicombatt_idPersonaggio` ON `adndproject`.`pg_stilicombattimento` (`idPersonaggio` ASC) ;

CREATE INDEX `fk_stilicombatt_idStile` ON `adndproject`.`pg_stilicombattimento` (`idStile` ASC) ;


-- -----------------------------------------------------
-- Table `adndproject`.`abilitaladri`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `adndproject`.`abilitaladri` ;

CREATE  TABLE IF NOT EXISTS `adndproject`.`abilitaladri` (
  `idAbilitaladri` INT NOT NULL ,
  `Nome` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`idAbilitaladri`) )
ENGINE = InnoDB
COMMENT = 'Contiene le abilita per la tabella delle abilita dei ladri';


-- -----------------------------------------------------
-- Table `adndproject`.`pg_abilitaladri`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `adndproject`.`pg_abilitaladri` ;

CREATE  TABLE IF NOT EXISTS `adndproject`.`pg_abilitaladri` (
  `idPersonaggio` INT NOT NULL ,
  `idAbilitaladri` INT NOT NULL ,
  `Base` INT NULL ,
  `Razza` INT NULL ,
  `Destrezza` INT NULL ,
  `Armatura` INT NULL ,
  `Tratti` INT NULL ,
  `Oggetti` INT NULL ,
  `Livello` INT NULL ,
  `Speciale` INT NULL ,
  `Totale` INT NULL ,
  PRIMARY KEY (`idPersonaggio`, `idAbilitaladri`) ,
  CONSTRAINT `fk_abilitaladri_idPersonaggio`
    FOREIGN KEY (`idPersonaggio` )
    REFERENCES `adndproject`.`personaggi` (`idPersonaggio` )
    ON DELETE NO ACTION
    ON UPDATE CASCADE,
  CONSTRAINT `fk_abilitaladri_idAbilitaladri`
    FOREIGN KEY (`idAbilitaladri` )
    REFERENCES `adndproject`.`abilitaladri` (`idAbilitaladri` )
    ON DELETE NO ACTION
    ON UPDATE CASCADE)
ENGINE = InnoDB
COMMENT = 'Contiene le abilita da ladro dei vari personaggi (tecnicamente ladri o che per qualche motivo hanno abilita da ladro)';

CREATE INDEX `fk_abilitaladri_idPersonaggio` ON `adndproject`.`pg_abilitaladri` (`idPersonaggio` ASC) ;

CREATE INDEX `fk_abilitaladri_idAbilitaladri` ON `adndproject`.`pg_abilitaladri` (`idAbilitaladri` ASC) ;



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
INSERT INTO `adndproject`.`utenti` (`Username`, `Email`, `Password`) VALUES ('Halukhar', 'federicos101@gmail.com', '$2y$10$IyKzsjrEz4PFBmdxakQf4.yLDEpXqCRkdxUFg7bccgNgV700iZaA2');

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

-- -----------------------------------------------------
-- Data for table `adndproject`.`proficienze`
-- -----------------------------------------------------
SET AUTOCOMMIT=0;
USE `adndproject`;
INSERT INTO `adndproject`.`proficienze` (`idProficienza`, `Nome`, `Categoria`, `CostoPP`, `ValoreBase`, `Abilita`) VALUES ('1', 'Accendere il fuoco', 'Generali', '2', '8', 'Sag/Intuizione, Int/Ragione');
INSERT INTO `adndproject`.`proficienze` (`idProficienza`, `Nome`, `Categoria`, `CostoPP`, `ValoreBase`, `Abilita`) VALUES ('2', 'Addestrare animali', 'Generali', '4', '5', 'Sag/Forza di Volontà, Car/Comando');
INSERT INTO `adndproject`.`proficienze` (`idProficienza`, `Nome`, `Categoria`, `CostoPP`, `ValoreBase`, `Abilita`) VALUES ('3', 'Agricoltura', 'Generali', '3', '7', 'Int/Conoscenza');
INSERT INTO `adndproject`.`proficienze` (`idProficienza`, `Nome`, `Categoria`, `CostoPP`, `ValoreBase`, `Abilita`) VALUES ('4', 'Allevare animali', 'Generali', '3', '7', 'Sag/Forza di Volontà');
INSERT INTO `adndproject`.`proficienze` (`idProficienza`, `Nome`, `Categoria`, `CostoPP`, `ValoreBase`, `Abilita`) VALUES ('5', 'Araldica', 'Generali', '2', '8', 'Int/Conoscenza');
INSERT INTO `adndproject`.`proficienze` (`idProficienza`, `Nome`, `Categoria`, `CostoPP`, `ValoreBase`, `Abilita`) VALUES ('6', 'Ballare', 'Generali', '2', '6', 'Des/Equilibrio, Car/Fascino');
INSERT INTO `adndproject`.`proficienze` (`idProficienza`, `Nome`, `Categoria`, `CostoPP`, `ValoreBase`, `Abilita`) VALUES ('7', 'Calzoleria', 'Generali', '3', '7', 'Des/Mira, Int/Conoscenza');
INSERT INTO `adndproject`.`proficienze` (`idProficienza`, `Nome`, `Categoria`, `CostoPP`, `ValoreBase`, `Abilita`) VALUES ('8', 'Cantare', 'Generali', '2', '5', 'Car/Comando');
INSERT INTO `adndproject`.`proficienze` (`idProficienza`, `Nome`, `Categoria`, `CostoPP`, `ValoreBase`, `Abilita`) VALUES ('9', 'Carpenteria', 'Generali', '3', '7', 'For/Energia, Int/Conoscenza');
INSERT INTO `adndproject`.`proficienze` (`idProficienza`, `Nome`, `Categoria`, `CostoPP`, `ValoreBase`, `Abilita`) VALUES ('10', 'Cavalcare', 'Generali', '2', '8', 'Sag/Forza di Volontà, Des/Equilibrio');
INSERT INTO `adndproject`.`proficienze` (`idProficienza`, `Nome`, `Categoria`, `CostoPP`, `ValoreBase`, `Abilita`) VALUES ('11', 'Cavalcare creature volanti', 'Generali', '4', '5', 'Sag/Forza di Volontà, Des/Equilibrio');
INSERT INTO `adndproject`.`proficienze` (`idProficienza`, `Nome`, `Categoria`, `CostoPP`, `ValoreBase`, `Abilita`) VALUES ('12', 'Ceramica', 'Generali', '3', '7', 'Des/Mira');
INSERT INTO `adndproject`.`proficienze` (`idProficienza`, `Nome`, `Categoria`, `CostoPP`, `ValoreBase`, `Abilita`) VALUES ('13', 'Cucinare', 'Generali', '3', '7', 'Int/Ragione');
INSERT INTO `adndproject`.`proficienze` (`idProficienza`, `Nome`, `Categoria`, `CostoPP`, `ValoreBase`, `Abilita`) VALUES ('14', 'Dipingere', 'Generali', '2', '7', 'Des/Mira, Sag/Intuizione');
INSERT INTO `adndproject`.`proficienze` (`idProficienza`, `Nome`, `Categoria`, `CostoPP`, `ValoreBase`, `Abilita`) VALUES ('15', 'Distillare', 'Generali', '3', '8', 'Int/Conoscenza');
INSERT INTO `adndproject`.`proficienze` (`idProficienza`, `Nome`, `Categoria`, `CostoPP`, `ValoreBase`, `Abilita`) VALUES ('16', 'Edilizia', 'Generali', '4', '5', 'For/Energia, Sag/Intuizione');
INSERT INTO `adndproject`.`proficienze` (`idProficienza`, `Nome`, `Categoria`, `CostoPP`, `ValoreBase`, `Abilita`) VALUES ('17', 'Estrarre minerali', 'Generali', '5', '5', 'Sag/Intuizione, For/Energia');
INSERT INTO `adndproject`.`proficienze` (`idProficienza`, `Nome`, `Categoria`, `CostoPP`, `ValoreBase`, `Abilita`) VALUES ('18', 'Galateo', 'Generali', '2', '8', 'Car/Fascino, Sag/Intuizione');
INSERT INTO `adndproject`.`proficienze` (`idProficienza`, `Nome`, `Categoria`, `CostoPP`, `ValoreBase`, `Abilita`) VALUES ('19', 'Giocatore d\'azzardo', 'Generali', '2', '5', 'Sag/Intuizione, Int/Conoscenza');
INSERT INTO `adndproject`.`proficienze` (`idProficienza`, `Nome`, `Categoria`, `CostoPP`, `ValoreBase`, `Abilita`) VALUES ('20', 'Immersione', 'Generali', '2', '5', 'Des/Equilibrio, Cos/Salute');
INSERT INTO `adndproject`.`proficienze` (`idProficienza`, `Nome`, `Categoria`, `CostoPP`, `ValoreBase`, `Abilita`) VALUES ('21', 'Ingegneria', 'Generali', '4', '5', 'Int/Ragione, Sag/Intuizione');
INSERT INTO `adndproject`.`proficienze` (`idProficienza`, `Nome`, `Categoria`, `CostoPP`, `ValoreBase`, `Abilita`) VALUES ('22', 'Lavorare il cuoio', 'Generali', '3', '7', 'Int/Conoscenza, Des/Mira');
INSERT INTO `adndproject`.`proficienze` (`idProficienza`, `Nome`, `Categoria`, `CostoPP`, `ValoreBase`, `Abilita`) VALUES ('23', 'Lingue moderne', 'Generali', '2', '9', 'Int/Conoscenza');
INSERT INTO `adndproject`.`proficienze` (`idProficienza`, `Nome`, `Categoria`, `CostoPP`, `ValoreBase`, `Abilita`) VALUES ('24', 'Marineria', 'Generali', '3', '8', 'Sag/Intuizione, Des/Equilibrio');
INSERT INTO `adndproject`.`proficienze` (`idProficienza`, `Nome`, `Categoria`, `CostoPP`, `ValoreBase`, `Abilita`) VALUES ('25', 'Metallurgia', 'Generali', '4', '6', 'For/Muscoli, Int/Conoscenza');
INSERT INTO `adndproject`.`proficienze` (`idProficienza`, `Nome`, `Categoria`, `CostoPP`, `ValoreBase`, `Abilita`) VALUES ('26', 'Meteorologia', 'Generali', '2', '7', 'Sag/Intuizione');
INSERT INTO `adndproject`.`proficienze` (`idProficienza`, `Nome`, `Categoria`, `CostoPP`, `ValoreBase`, `Abilita`) VALUES ('27', 'Navigare', 'Generali', '3', '6', 'Int/Conoscenza, Sag/Intuizione');
INSERT INTO `adndproject`.`proficienze` (`idProficienza`, `Nome`, `Categoria`, `CostoPP`, `ValoreBase`, `Abilita`) VALUES ('28', 'Nuotare', 'Generali', '2', '9', 'For/Energia');
INSERT INTO `adndproject`.`proficienze` (`idProficienza`, `Nome`, `Categoria`, `CostoPP`, `ValoreBase`, `Abilita`) VALUES ('29', 'Pescare', 'Generali', '3', '6', 'Sag/Intuizione, Int/Conoscenza');
INSERT INTO `adndproject`.`proficienze` (`idProficienza`, `Nome`, `Categoria`, `CostoPP`, `ValoreBase`, `Abilita`) VALUES ('30', 'Pilotare barche', 'Generali', '2', '6', 'For/Muscoli, Int/Ragione');
INSERT INTO `adndproject`.`proficienze` (`idProficienza`, `Nome`, `Categoria`, `CostoPP`, `ValoreBase`, `Abilita`) VALUES ('31', 'Sartoria', 'Generali', '3', '7', 'Des/Mira, Int/Ragione');
INSERT INTO `adndproject`.`proficienze` (`idProficienza`, `Nome`, `Categoria`, `CostoPP`, `ValoreBase`, `Abilita`) VALUES ('32', 'Scolpire', 'Generali', '2', '5', 'Des/Mira, Sag/Intuizione');
INSERT INTO `adndproject`.`proficienze` (`idProficienza`, `Nome`, `Categoria`, `CostoPP`, `ValoreBase`, `Abilita`) VALUES ('33', 'Senso dell\'orientamento', 'Generali', '3', '7', 'Int/Conoscenza, Sag/Intuizione');
INSERT INTO `adndproject`.`proficienze` (`idProficienza`, `Nome`, `Categoria`, `CostoPP`, `ValoreBase`, `Abilita`) VALUES ('34', 'Strumenti musicali', 'Generali', '2', '7', 'Car/Comando');
INSERT INTO `adndproject`.`proficienze` (`idProficienza`, `Nome`, `Categoria`, `CostoPP`, `ValoreBase`, `Abilita`) VALUES ('35', 'Tessitura', 'Generali', '3', '6', 'Int/Ragione, Des/Mira');
INSERT INTO `adndproject`.`proficienze` (`idProficienza`, `Nome`, `Categoria`, `CostoPP`, `ValoreBase`, `Abilita`) VALUES ('36', 'Uso della corda', 'Generali', '2', '8', 'Des/Mira, Sag/Intuizione');
INSERT INTO `adndproject`.`proficienze` (`idProficienza`, `Nome`, `Categoria`, `CostoPP`, `ValoreBase`, `Abilita`) VALUES ('37', 'Astrologia', 'Stregoni', '3', '5', 'Sag/Intuizione, Int/Conoscenza');
INSERT INTO `adndproject`.`proficienze` (`idProficienza`, `Nome`, `Categoria`, `CostoPP`, `ValoreBase`, `Abilita`) VALUES ('38', 'Astronomia', 'Stregoni', '2', '7', 'Int/Conoscenza');
INSERT INTO `adndproject`.`proficienze` (`idProficienza`, `Nome`, `Categoria`, `CostoPP`, `ValoreBase`, `Abilita`) VALUES ('39', 'Conoscenza della magia', 'Stregoni', '3', '7', 'Int/Ragione');
INSERT INTO `adndproject`.`proficienze` (`idProficienza`, `Nome`, `Categoria`, `CostoPP`, `ValoreBase`, `Abilita`) VALUES ('40', 'Crittografia', 'Stregoni', '3', '6', 'Int/Ragione, Sag/Intuizione');
INSERT INTO `adndproject`.`proficienze` (`idProficienza`, `Nome`, `Categoria`, `CostoPP`, `ValoreBase`, `Abilita`) VALUES ('41', 'Erboristeria', 'Stregoni', '3', '6', 'Int/Conoscenza, Sag/Intuizione');
INSERT INTO `adndproject`.`proficienze` (`idProficienza`, `Nome`, `Categoria`, `CostoPP`, `ValoreBase`, `Abilita`) VALUES ('42', 'Lavorare pietre preziose', 'Stregoni', '3', '6', 'Des/Mira');
INSERT INTO `adndproject`.`proficienze` (`idProficienza`, `Nome`, `Categoria`, `CostoPP`, `ValoreBase`, `Abilita`) VALUES ('43', 'Leggere/Scrivere', 'Stregoni', '2', '8', 'Int/Conoscenza');
INSERT INTO `adndproject`.`proficienze` (`idProficienza`, `Nome`, `Categoria`, `CostoPP`, `ValoreBase`, `Abilita`) VALUES ('44', 'Lingue antiche', 'Stregoni', '4', '5', 'Int/Conoscenza');
INSERT INTO `adndproject`.`proficienze` (`idProficienza`, `Nome`, `Categoria`, `CostoPP`, `ValoreBase`, `Abilita`) VALUES ('45', 'Religioni', 'Stregoni', '2', '6', 'Sag/Intuizione');
INSERT INTO `adndproject`.`proficienze` (`idProficienza`, `Nome`, `Categoria`, `CostoPP`, `ValoreBase`, `Abilita`) VALUES ('46', 'Storia antica', 'Stregoni', '3', '6', 'Sag/Intuizione, Int/Conoscenza');
INSERT INTO `adndproject`.`proficienze` (`idProficienza`, `Nome`, `Categoria`, `CostoPP`, `ValoreBase`, `Abilita`) VALUES ('47', 'Alpinismo', 'Combattenti', '4', '7', 'For/Energia, Sag/Forza di Volontà');
INSERT INTO `adndproject`.`proficienze` (`idProficienza`, `Nome`, `Categoria`, `CostoPP`, `ValoreBase`, `Abilita`) VALUES ('48', 'Cacciare', 'Combattenti', '2', '7', 'Sag/Intuizione');
INSERT INTO `adndproject`.`proficienze` (`idProficienza`, `Nome`, `Categoria`, `CostoPP`, `ValoreBase`, `Abilita`) VALUES ('49', 'Combattere alla cieca', 'Combattenti', '4', '6', 'Sag/Intuizione, Des/Equilibrio');
INSERT INTO `adndproject`.`proficienze` (`idProficienza`, `Nome`, `Categoria`, `CostoPP`, `ValoreBase`, `Abilita`) VALUES ('50', 'Conoscenza degli animali', 'Combattenti', '3', '7', 'Int/Conoscenza, Sag/Intuizione');
INSERT INTO `adndproject`.`proficienze` (`idProficienza`, `Nome`, `Categoria`, `CostoPP`, `ValoreBase`, `Abilita`) VALUES ('51', 'Correre', 'Combattenti', '2', '5', 'For/Energia, Cos/Forma Fisica');
INSERT INTO `adndproject`.`proficienze` (`idProficienza`, `Nome`, `Categoria`, `CostoPP`, `ValoreBase`, `Abilita`) VALUES ('52', 'Fabbr. di archi/frecce', 'Combattenti', '5', '6', 'Int/Conoscenza, Sag/Intuizione');
INSERT INTO `adndproject`.`proficienze` (`idProficienza`, `Nome`, `Categoria`, `CostoPP`, `ValoreBase`, `Abilita`) VALUES ('53', 'Fabbricare armature', 'Combattenti', '5', '5', 'Int/Conoscenza, For/Muscoli');
INSERT INTO `adndproject`.`proficienze` (`idProficienza`, `Nome`, `Categoria`, `CostoPP`, `ValoreBase`, `Abilita`) VALUES ('54', 'Fabbricare armi', 'Combattenti', '5', '5', 'Int/Conoscenza, Des/Mira');
INSERT INTO `adndproject`.`proficienze` (`idProficienza`, `Nome`, `Categoria`, `CostoPP`, `ValoreBase`, `Abilita`) VALUES ('55', 'Guidare carri', 'Combattenti', '4', '5', 'Des/Equilibrio, Sag/Forza di Volontà');
INSERT INTO `adndproject`.`proficienze` (`idProficienza`, `Nome`, `Categoria`, `CostoPP`, `ValoreBase`, `Abilita`) VALUES ('56', 'Preparare trappole', 'Combattenti', '4', '8', 'Des/Mira, Sag/Intuizione');
INSERT INTO `adndproject`.`proficienze` (`idProficienza`, `Nome`, `Categoria`, `CostoPP`, `ValoreBase`, `Abilita`) VALUES ('57', 'Resistenza', 'Combattenti', '2', '3', 'Cos/Forma Fisica');
INSERT INTO `adndproject`.`proficienze` (`idProficienza`, `Nome`, `Categoria`, `CostoPP`, `ValoreBase`, `Abilita`) VALUES ('58', 'Seguire tracce', 'Combattenti', '4', '7', 'Sag/Intuizione');
INSERT INTO `adndproject`.`proficienze` (`idProficienza`, `Nome`, `Categoria`, `CostoPP`, `ValoreBase`, `Abilita`) VALUES ('59', 'Sopravvivenza', 'Combattenti', '3', '6', 'Int/Conoscenza, Sag/Forza di Volontà');
INSERT INTO `adndproject`.`proficienze` (`idProficienza`, `Nome`, `Categoria`, `CostoPP`, `ValoreBase`, `Abilita`) VALUES ('60', 'Astrologia', 'Sacerdoti', '3', '5', 'Sag/Intuizione, Int/Conoscenza');
INSERT INTO `adndproject`.`proficienze` (`idProficienza`, `Nome`, `Categoria`, `CostoPP`, `ValoreBase`, `Abilita`) VALUES ('61', 'Conoscenza della magia', 'Sacerdoti', '3', '7', 'Int/Ragione');
INSERT INTO `adndproject`.`proficienze` (`idProficienza`, `Nome`, `Categoria`, `CostoPP`, `ValoreBase`, `Abilita`) VALUES ('62', 'Curare', 'Sacerdoti', '4', '5', 'Sag/Intuizione, Car/Comando');
INSERT INTO `adndproject`.`proficienze` (`idProficienza`, `Nome`, `Categoria`, `CostoPP`, `ValoreBase`, `Abilita`) VALUES ('63', 'Erboristeria', 'Sacerdoti', '3', '6', 'Int/Conoscenza, Sag/Intuizione');
INSERT INTO `adndproject`.`proficienze` (`idProficienza`, `Nome`, `Categoria`, `CostoPP`, `ValoreBase`, `Abilita`) VALUES ('64', 'Leggere/Scrivere', 'Sacerdoti', '2', '8', 'Int/Conoscenza');
INSERT INTO `adndproject`.`proficienze` (`idProficienza`, `Nome`, `Categoria`, `CostoPP`, `ValoreBase`, `Abilita`) VALUES ('65', 'Lingue antiche', 'Sacerdoti', '4', '5', 'Int/Conoscenza');
INSERT INTO `adndproject`.`proficienze` (`idProficienza`, `Nome`, `Categoria`, `CostoPP`, `ValoreBase`, `Abilita`) VALUES ('66', 'Religioni', 'Sacerdoti', '2', '6', 'Sag/Intuizione');
INSERT INTO `adndproject`.`proficienze` (`idProficienza`, `Nome`, `Categoria`, `CostoPP`, `ValoreBase`, `Abilita`) VALUES ('67', 'Storia antica', 'Sacerdoti', '3', '6', 'Sag/Intuizione, Int/Conoscenza');
INSERT INTO `adndproject`.`proficienze` (`idProficienza`, `Nome`, `Categoria`, `CostoPP`, `ValoreBase`, `Abilita`) VALUES ('68', 'Storia locale', 'Sacerdoti', '2', '8', 'Int/Conoscenza, Car/Fascino');
INSERT INTO `adndproject`.`proficienze` (`idProficienza`, `Nome`, `Categoria`, `CostoPP`, `ValoreBase`, `Abilita`) VALUES ('69', 'Acrobazia', 'Vagabondi', '3', '7', 'Des/Equilibrio, For/Muscoli');
INSERT INTO `adndproject`.`proficienze` (`idProficienza`, `Nome`, `Categoria`, `CostoPP`, `ValoreBase`, `Abilita`) VALUES ('70', 'Camminare sulla corda', 'Vagabondi', '3', '5', 'Des/Equilibrio');
INSERT INTO `adndproject`.`proficienze` (`idProficienza`, `Nome`, `Categoria`, `CostoPP`, `ValoreBase`, `Abilita`) VALUES ('71', 'Camuffarsi', 'Vagabondi', '4', '5', 'Sag/Intuizione, Car/Comando');
INSERT INTO `adndproject`.`proficienze` (`idProficienza`, `Nome`, `Categoria`, `CostoPP`, `ValoreBase`, `Abilita`) VALUES ('72', 'Combattere alla cieca', 'Vagabondi', '4', '6', 'Sag/Intuizione, Des/Equilibrio');
INSERT INTO `adndproject`.`proficienze` (`idProficienza`, `Nome`, `Categoria`, `CostoPP`, `ValoreBase`, `Abilita`) VALUES ('73', 'Crittografia', 'Vagabondi', '3', '6', 'Int/Ragione, Sag/Intuizione');
INSERT INTO `adndproject`.`proficienze` (`idProficienza`, `Nome`, `Categoria`, `CostoPP`, `ValoreBase`, `Abilita`) VALUES ('74', 'Falsificare', 'Vagabondi', '3', '5', 'Des/Mira, Sag/Forza di Volontà');
INSERT INTO `adndproject`.`proficienze` (`idProficienza`, `Nome`, `Categoria`, `CostoPP`, `ValoreBase`, `Abilita`) VALUES ('75', 'Giocoliere', 'Vagabondi', '3', '7', 'Des/Mira');
INSERT INTO `adndproject`.`proficienze` (`idProficienza`, `Nome`, `Categoria`, `CostoPP`, `ValoreBase`, `Abilita`) VALUES ('76', 'Lanciare', 'Vagabondi', '2', '8', 'Des/Mira, For/Muscoli');
INSERT INTO `adndproject`.`proficienze` (`idProficienza`, `Nome`, `Categoria`, `CostoPP`, `ValoreBase`, `Abilita`) VALUES ('77', 'Lavorare pietre preziose', 'Vagabondi', '3', '6', 'Des/Mira');
INSERT INTO `adndproject`.`proficienze` (`idProficienza`, `Nome`, `Categoria`, `CostoPP`, `ValoreBase`, `Abilita`) VALUES ('78', 'Leggere le labbra', 'Vagabondi', '3', '7', 'Int/Consocenza, Sag/Intuizione');
INSERT INTO `adndproject`.`proficienze` (`idProficienza`, `Nome`, `Categoria`, `CostoPP`, `ValoreBase`, `Abilita`) VALUES ('79', 'Preparare trappole', 'Vagabondi', '3', '6', 'Des/Mira, Sag/Intuizione');
INSERT INTO `adndproject`.`proficienze` (`idProficienza`, `Nome`, `Categoria`, `CostoPP`, `ValoreBase`, `Abilita`) VALUES ('80', 'Saltare', 'Vagabondi', '2', '8', 'For/Muscolatura, Des/Equilibrio');
INSERT INTO `adndproject`.`proficienze` (`idProficienza`, `Nome`, `Categoria`, `CostoPP`, `ValoreBase`, `Abilita`) VALUES ('81', 'Storia antica', 'Vagabondi', '3', '6', 'Sag/Intuizione, Int/Conoscenza');
INSERT INTO `adndproject`.`proficienze` (`idProficienza`, `Nome`, `Categoria`, `CostoPP`, `ValoreBase`, `Abilita`) VALUES ('82', 'Storia locale', 'Vagabondi', '2', '8', 'Int/Conoscenza, Car/Fascino');
INSERT INTO `adndproject`.`proficienze` (`idProficienza`, `Nome`, `Categoria`, `CostoPP`, `ValoreBase`, `Abilita`) VALUES ('83', 'Valutare', 'Vagabondi', '2', '8', 'Int/Ragione, Sag/Intuizione');
INSERT INTO `adndproject`.`proficienze` (`idProficienza`, `Nome`, `Categoria`, `CostoPP`, `ValoreBase`, `Abilita`) VALUES ('84', 'Ventriloquio', 'Vagabondi', '4', '5', 'Int/Conoscenza, Car/Comando');

COMMIT;

-- -----------------------------------------------------
-- Data for table `adndproject`.`armatura`
-- -----------------------------------------------------
SET AUTOCOMMIT=0;
USE `adndproject`;
INSERT INTO `adndproject`.`armatura` (`idArmatura`, `Categoria`, `CA`) VALUES ('1', 'Nessuna', '10');
INSERT INTO `adndproject`.`armatura` (`idArmatura`, `Categoria`, `CA`) VALUES ('2', 'Solo scudo', '9');
INSERT INTO `adndproject`.`armatura` (`idArmatura`, `Categoria`, `CA`) VALUES ('3', 'Corazza di cuoio o imbottita', '8');
INSERT INTO `adndproject`.`armatura` (`idArmatura`, `Categoria`, `CA`) VALUES ('4', 'Corazza di cuoio o imbottita + scudo, corazza di cuoio borchiata o corazza ad anelli', '7');
INSERT INTO `adndproject`.`armatura` (`idArmatura`, `Categoria`, `CA`) VALUES ('5', 'Corazza di cuoio borchiata o ad anelli + scudo, brigantina, corazza di pelle o a scaglie', '6');
INSERT INTO `adndproject`.`armatura` (`idArmatura`, `Categoria`, `CA`) VALUES ('6', 'Corazza di pelle o a scaglie + scudo, corazza di maglia', '5');
INSERT INTO `adndproject`.`armatura` (`idArmatura`, `Categoria`, `CA`) VALUES ('7', 'Corazza di maglia + scudo, corazza a strisce o a bande, corazza di piastre di bronzo', '4');
INSERT INTO `adndproject`.`armatura` (`idArmatura`, `Categoria`, `CA`) VALUES ('8', 'Corazza a strisce, a bande o di piastre di bronzo + scudo, corazza di piastre', '3');
INSERT INTO `adndproject`.`armatura` (`idArmatura`, `Categoria`, `CA`) VALUES ('9', 'Corazza di piastre + scudo, armatura da campo', '2');
INSERT INTO `adndproject`.`armatura` (`idArmatura`, `Categoria`, `CA`) VALUES ('10', 'Armatura da campo + scudo, armatura completa', '1');
INSERT INTO `adndproject`.`armatura` (`idArmatura`, `Categoria`, `CA`) VALUES ('11', 'Armatura completa + scudo', '0');
INSERT INTO `adndproject`.`armatura` (`idArmatura`, `Categoria`, `CA`) VALUES ('12', 'Altro', NULL);

COMMIT;

-- -----------------------------------------------------
-- Data for table `adndproject`.`arma`
-- -----------------------------------------------------
SET AUTOCOMMIT=0;
USE `adndproject`;
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('1', 'Accetta', '1 mo', '2.5', 'M', 'T', '4', '1d6', '1d4', 'Generiche');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('2', 'Arco Corto', '30 mo', '1', 'M', NULL, '7', NULL, NULL, 'Archi');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('3', 'Arco Corto Composito', '75 mo', '1', 'M', NULL, '6', NULL, NULL, 'Archi');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('4', 'Arco Lungo', '75 mo', '1.5', 'G', NULL, '7', NULL, NULL, 'Archi');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('5', 'Arco Lungo Composito', '100 mo', '1.5', 'G', NULL, '7', NULL, NULL, 'Archi');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('6', 'Freccia da Guerra', '3 ma/6', '0.05', 'P', 'P', NULL, '1d8', '1d8', 'Archi');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('7', 'Freccia da Tiro', '3 ma/12', '0.05', 'P', 'P', NULL, '1d6', '1d6', 'Archi');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('8', 'Archibugio', '500 mo', '4.5', 'M', 'P', '15', '1d10', '1d10', 'Generiche');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('9', 'Alabarda', '10 mo', '7', 'G', 'P/T', '9', '1d10', '2d6', 'Armi Lunghe');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('10', 'Bardica', '7 mo', '5.5', 'G', 'T', '9', '2d4', '2d6', 'Armi Lunghe');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('11', 'Bec De Corbin', '8 mo', '4.5', 'G', 'P/C', '9', '1d8', '1d6', 'Armi Lunghe');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('12', 'Corseca', '5 mo', '3', 'G', 'P', '8', '1d6 + 1', '2d6', 'Armi Lunghe');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('13', 'Falcione', '5 mo', '3', 'G', 'P/T', '8', '1d6', '1d8', 'Armi Lunghe');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('14', 'Falcione-Giusarma', '10 mo', '4.5', 'G', 'P/T', '9', '2d4', '2d6', 'Armi Lunghe');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('15', 'Falcione Uncinato', '10 mo', '3.5', 'G', 'P/T', '9', '1d4', '1d4', 'Generiche');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('16', 'Falcione-Forca', '8 mo', '4', 'G', 'P/T', '8', '1d8', '1d10', 'Generiche');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('17', 'Falcione-Glaive', '6 mo', '3.5', 'G', 'T', '8', '1d6', '1d10', 'Armi Lunghe');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('18', 'Forcone da Guerra', '5 mo', '3', 'G', 'P', '7', '1d8', '2d4', 'Armi Lunghe');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('19', 'Giusarma', '5 mo', '3.5', 'G', 'T', '8', '2d4', '1d8', 'Armi Lunghe');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('20', 'Martello d\'Arme', '7 mo', '7', 'G', 'P/C', '9', '2d4', '1d6', 'Armi Lunghe');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('21', 'Partigiana', '10 mo', '3.5', 'G', 'P', '9', '1d6', '1d6 + 1', 'Armi Lunghe');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('22', 'Picca', '5 mo', '5.5', 'G', 'P', '13', '1d6', '1d12', 'Armi Lunghe');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('23', 'Roncone-Giusarma', '7 mo', '7', 'G', 'P/T', '10', '2d4', '1d10', 'Armi Lunghe');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('24', 'Spuntone', '6 mo', '3', 'G', 'P', '8', '2d4', '2d4', 'Armi Lunghe');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('25', 'Volgia', '5 mo', '5.5', 'G', 'T', '10', '2d4', '2d4', 'Armi Lunghe');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('26', 'Volgia-Giusarma', '8 mo', '7', 'G', 'P/T', '10', '2d4', '2d4', 'Armi Lunghe');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('27', 'Arpione', '20 mo', '2.5', 'G', 'P', '7', '2d4', '2d6', 'Arpione');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('28', 'Ascia da Battaglia', '5 mo ', '3', 'M', 'T', '7', '1d8', '1d8', 'Generiche');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('29', 'Balestra a Mano', '300 mo', '1.5', 'P', NULL, '5', NULL, NULL, 'Balestre');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('30', 'Balestra Leggera', '35 mo', '3', 'M', NULL, '7', NULL, NULL, 'Balestre');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('31', 'Balestra Pesante', '50 mo', '7', 'M', NULL, '10', NULL, NULL, 'Balestre');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('32', 'Quadrello a Mano', '1 mo', '0.05', 'P', 'P', NULL, '1d3', '1d2', 'Balestre');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('33', 'Quadrello Leggero', '1 ma', '0.05', 'P', 'P', NULL, '1d6 + 1', '1d8 + 1', 'Balestre');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('34', 'Quadrello Pesante', '2 ma', '0.05', 'P', 'P', NULL, '1d8 + 1', '1d10 + 1', 'Balestre');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('35', 'Cerbottana', '5 mo', '0.05', 'G', NULL, '5', NULL, NULL, 'Cerbottana');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('36', 'Ago', '2 mr', '0.05', 'P', 'P', NULL, '1', '1', 'Cerbottana');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('37', 'Dardo', '1 ma', '0.05', 'P', 'P', NULL, '1d3', '1d2', 'Cerbottana');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('38', 'Clava', '-', '1.5', 'M', 'C', '4', '1d6', '1d3', 'Generiche');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('39', 'Coltello', '5 ma', '0.25', 'P', 'P/T', '2', '1d3', '1d2', 'Coltello');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('40', 'Dardo', '5 ma', '0.25', 'P', 'P', '2', '1d3', '1d2', 'Generiche');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('41', 'Falcetto', '6 ma', '1.5', 'P', 'T', '4', '1d4 + 1', '1d4', 'Generiche');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('42', 'Fionda', '5 mr', '0.05', 'P', NULL, '6', NULL, NULL, 'Fionda');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('43', 'Sasso', '-', '0.25', 'P', 'C', NULL, '1d4', '1d4', 'Fionda');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('44', 'Proiettile', '1 mr', '0.25', 'P', 'C', NULL, '1d4 + 1', '1d6 + 1', 'Fionda');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('45', 'Fionda ad Asta', '2 ma', '1', 'M', NULL, '11', NULL, NULL, 'Fionda ad Asta');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('46', 'Sferza', '1 mo', '1', 'P', NULL, '5', '1d4', '1d2', 'Generiche');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('47', 'Frusta', '1 ma', '1', 'M', NULL, '8', '1d2', '1', 'Generiche');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('48', 'Giavellotto', '5 ma', '1', 'M', 'P', '4', '1d6', '1d6', 'Giavellotto');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('49', 'Lancia a Una Mano', '8 ma', '2.5', 'M', 'P', '6', '1d6', '1d8', 'Lancia');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('50', 'Lancia da Giostra', '20 mo', '9', 'G', 'P', '10', '1d3 - 1', '1d2 - 1', 'Lancia');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('51', 'Lancia Leggera', '6 mo ', '2.5', 'G', 'P', '6', '1d6', '1d8', 'Lancia');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('52', 'Lancia Media', '10 mo', '4.5', 'G', 'P', '7', '1d6 + 1', '2d6', 'Lancia');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('53', 'Lancia Pesante', '15 mo', '7', 'G', 'P', '8', '1d8 + 1', '3d6', 'Lancia');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('54', 'Mancatcher', '30 mo', '3.5', 'G', NULL, '7', NULL, NULL, 'Generiche');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('55', 'Martello da Guerra', '2 mo', '2.5', 'M', 'C', '4', '1d4 + 1', '1d4', 'Generiche');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('56', 'Mazza da Cavaliere', '5 mo', '2.5', 'M', 'C', '6', '1d6', '1d4', 'Generiche');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('57', 'Mazza da Fante', '8 mo', '4.5', 'M', 'C', '7', '1d6 + 1', '1d6', 'Generiche');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('58', 'Mazzafrusto da Cavaliere', '8 mo', '2.5', 'M', 'C', '6', '1d4 + 1', '1d4 + 1', 'Generiche');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('59', 'Mazzafrusto da Fante', '15 mo', '7', 'M', 'C', '7', '1d6 + 1', '2d4', 'Generiche');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('60', 'Morning Star', '10 mo', '5.5', 'M', 'P/C', '7', '2d4', '1d6 + 1', 'Generiche');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('61', 'Piccone da Cavaliere', '7 mo', '2', 'M', 'P', '5', '1d4 + 1', '1d4', 'Generiche');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('62', 'Piccone da Fante', '8 mo', '2.5', 'M', 'P', '7', '1d6 + 1', '2d4', 'Generiche');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('63', 'Pugnale', '2 mo', '0.5', 'P', 'P', '2', '1d4', '1d3', 'Pugnale');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('64', 'Bastone Rinforzato', '-', '2', 'G', 'C', '4', '1d6', '1d6', 'Generiche');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('65', 'Khopesh', '10 mo', '3', 'M', 'T', '9', '2d4', '1d6', 'Spade');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('66', 'Scimitarra', '15 mo', '2', 'M', 'T', '5', '1d8', '1d8', 'Spade');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('67', 'Spada a Due Mani', '50 mo', '7', 'G', 'T', '10', '1d10', '3d6', 'Spade');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('68', 'Spada Bastarda a Una Mano', '25 mo', '4.5', 'M', 'T', '6', '1d8', '1d12', 'Spade');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('69', 'Spada Bastarda a Due Mani', '25 mo', '4.5', 'M', 'T', '8', '2d4', '2d8', 'Spade');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('70', 'Spada Corta', '10 mo', '1.5', 'P', 'P', '3', '1d6', '1d8', 'Spade');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('71', 'Spada Larga', '10 mo', '2', 'M', 'P', '5', '2d4', '1d6 + 1', 'Spade');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('72', 'Spada Lunga', '15 mo', '2', 'M', 'P', '5', '1d8', '1d12', 'Spade');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('73', 'Tridente a Una Mano', '15 mo', '2.5', 'G', 'P', '7', '1d6 + 1', '2d4', 'Generiche');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('74 ', 'Accetta di Pietra', '5 ma', '2.5', 'M', 'C/T', '6', '1d6', '1d4', 'Generiche');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('75', 'Ankus', '3 mo', '2', 'M', 'P/C', '6', '1d4', '1d4', 'Generiche');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('76', 'Freccia con Punta di Pietra', '3 mr/12', '0.05', 'P', 'P', NULL, '1d4', '1d4', 'Archi');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('77', 'Freccia di Penetrazione', '3 mr/6', '0.05', 'P', 'P', NULL, '1d6', '1d6', 'Archi');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('78', 'Lajatang', '7 mo', '2.5', 'G', 'T', '6', '1d10', '1d10', 'Armi Lunghe');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('79', 'Nagimaki', '6 mo', '2.5', 'M', 'T', '6', '1d6', '1d8', 'Armi Lunghe');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('80', 'Naginata', '8 mo', '4.5', 'G', 'T', '7', '1d8', '1d10', 'Armi Lunghe');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('81', 'Roncone', '7 mo', '7', 'G', 'P/T', '10', '2d4', '1d10', 'Armi Lunghe');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('82', 'Arpione d\'Osso', '1 mo', '2.5', 'G', 'P', '7', '1d6', '1d10', 'Arpione');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('83', 'Ascia a Due Mani', '15 mo', '4.5', 'G', 'T', '9', '1d10', '2d8', 'Generiche');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('84', 'Azza', '3 ma', '2', 'P', 'T/P', '4', '1d4 + 1', '1d4', 'Generiche');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('85', 'Balestra a Fionda', '25 mo', '2.5', 'M', NULL, '7', NULL, NULL, 'Balestre');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('86', 'Cho-ku-no', '50 mo', '5.5', 'M', NULL, '6', NULL, NULL, 'Balestre');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('87', 'Proiettile', '5 mr', '0.05', 'P', 'C', NULL, '1d4', '1d4', 'Balestre');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('88', 'Bolas', '5 ma', '1', 'M', 'C', '8', '1d3', '1d2', 'Generiche');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('89', 'Bo Stick', '5 mr', '2', 'G', 'C', '3', '1d6', '1d4', 'Generiche');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('90', 'Boomerang', '5 ma', '1', 'P', 'C', '4', '1d4', '1d4', 'Generiche');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('91', 'Caltrop', '2 mo/12', '0.05', 'P', 'P', NULL, '1', '1d2', 'Generiche');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('92', 'Catena', '5 ma', '1.5', 'G', 'C', '5', '1d4 + 1', '1d4', 'Generiche');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('93', 'Cestus', '1 mo', '1', 'P', 'C', '2', '1d4', '1d3', 'Generiche');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('94', 'Chakram', '8 ma', '0.5', 'P', 'T', '4', '1d4', '1d4', 'Generiche');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('95', 'Chijikiri', '6 mo', '2.5', 'M', 'P/C', '7', '1d6', '1d8', 'Generiche');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('96', 'Clava da Guerra', '2 mo', '2.5', 'M', 'C/T', '7', '1d6 + 1', '1d4 + 1', 'Generiche');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('97', 'Coltello d\'Osso', '3 ma', '0.5', 'P', 'P/T', '2', '1d2', '1d2', 'Coltello');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('98', 'Coltello da Lancio', '5 mo', '2', 'M', 'T/P', '8', '2d4', '1d6 + 1', 'Coltello');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('99', 'Coltello di Pietra', '5 mr', '0.5', 'P', 'P/T', '2', '1d2', '1d2', 'Coltello');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('100', 'Fiala', '1 ma', '1', 'P', 'C', NULL, '1d3', '1d3', 'Fionda ad Asta');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('101', 'Sasso', '-', '1', 'P', 'C', NULL, '1d4 + 1', '1d6 + 1', 'Fionda ad Asta');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('102', 'Giavellotto di Pietra', '5 mr', '1', 'M', 'P', '4', '1d4', '1d4', 'Giavellotto');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('103', 'Gunsen', '4 mo', '0.5', 'P', 'C/P', '2', '1d3', '1d2', 'Generiche');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('104', 'Jitte', '5 ma', '1', 'P', 'P', '2', '1d4', '1d2', 'Generiche');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('105', 'Kama', '2 mo', '1', 'P', 'P/T', '4', '1d6', '1d4', 'Generiche');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('106', 'Kau sin ke', '3 mo', '2', 'M', 'C', '6', '1d8', '1d6', 'Generiche');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('107', 'Kawanaga', '1 mo', '0.5', 'P', 'P/C', '7', '1d3', '1d2', 'Generiche');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('108', 'Kusari-gama', '4 mo', '1.5', 'M', 'T/P/C', '6', '1d6', '1d4', 'Generiche');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('109', 'Lancia a Due Mani', '8 ma', '2.5', 'M', 'P', '6', '1d6 + 1', '2d6', 'Lancia');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('110', 'Lancia di Pietra a Una Mano', '2 ma', '2.5', 'M', 'P', '6', '1d4', '1d6', 'Lancia');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('111', 'Lancia di Pietra a Due Mani', '2 ma', '2.5', 'M', 'P', '6', '1d6', '2d4', 'Lancia');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('112', 'Lazo', '5 ma', '1.5', 'M', NULL, '10', NULL, NULL, 'Generiche');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('113 ', 'Machete', '8 mo', '2.5', 'M', 'T', '6', '1d8', '1d8', 'Generiche');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('114', 'Maglio', '4 mo', '4.5', 'G', 'C', '8', '2d4', '1d10', 'Generiche');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('115', 'Mazza Scure', '12 mo', '4', 'M', 'C/T', '8', '2d4', '1d6 + 1', 'Generiche');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('116', 'Nunchaku', '5 ma', '1.5', 'M', 'C', '3', '1d6', '1d6', 'Generiche');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('117', 'Pietra', '-', '0.5', 'P', 'C', '2', '1d3', '1d2', 'Generiche');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('118', 'Pilum', '1 mo', '1.5', 'M', 'P', '5', '1d6', '1d6', 'Generiche');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('119', 'Jambiya', '4 mo', '0.5', 'P', 'P/T', '3', '1d4', '1d4', 'Pugnale');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('120', 'Katar', '3 mo', '0.5', 'P', 'P', '2', '1d3 + 1', '1d3', 'Pugnale');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('121', 'Main-gauche', '3 mo', '1', 'P', 'P/T', '2', '1d4', '1d3', 'Pugnale');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('122', 'Pugnale d\'Osso', '1 ma', '0.5', 'P', 'P', '2', '1d2', '1d2', 'Pugnale');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('123', 'Pugnale da Guardia', '5 mo', '0.5', 'P', 'P', '2', '1d3', '1d3', 'Pugnale');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('124', 'Pugnale di Pietra', '2 ma', '0.5', 'P', 'P', '2', '1d3', '1d2', 'Pugnale');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('125', 'Stiletto', '8 ma', '0.5', 'P', 'P', '2', '1d3', '1d2', 'Pugnale');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('126', 'Rete', '5 mo', '4.5', 'M', NULL, '10', NULL, NULL, 'Generiche');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('127', 'Sai', '1 mo', '1', 'P', 'C', '2', '1d4', '1d2', 'Generiche');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('128', 'Sang Kauw', '5 mo', '5', 'G', 'P/T', '7', '1d8', '1d6', 'Generiche');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('129', 'Shuriken', '3 mo', '0.05', 'P', 'P', '2', '1d4', '1d4', 'Generiche');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('130', 'Claymore', '25 mo', '3.5', 'M', 'T', '7', '2d4', '2d8', 'Spade');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('131', 'Cutlass', '12 mo', '2', 'M', 'T', '5', '1d6 + 1', '1d8 + 1', 'Spade');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('132', 'Drusus', '50 mo', '1.5', 'M', 'T', '3', '1d6 + 1', '1d8 + 1', 'Spade');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('133', 'Falchion', '17 mo', '3.5', 'M', 'T', '5', '1d6 + 1', '1d4', 'Spade');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('134', 'Gladio', '10 mo', '1.5', 'P', 'P', '3', '1d6', '1d8', 'Spade');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('135', 'Grande Scimitarra', '60 mo', '7', 'G', 'T', '9', '2d6', '4d4', 'Spade');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('136', 'Katana a Una Mano', '100 mo', '2.5', 'M', 'T/P', '4', '1d10', '1d12', 'Spade');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('137', 'Katana a Due Mani', '100 mo', '2.5', 'M', 'T/P', '4', '2d6', '2d6', 'Spade');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('138', 'Ninja-to', '20 mo', '2.5', 'M', 'T/P', '3', '1d8', '1d8', 'Spade');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('139', 'No-dachi', '45 mo', '4.5', 'G', 'T/P', '8', '1d10', '1d20', 'Spade');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('140', 'Sapara', '10 mo', '2', 'P', 'T', '5', '1d6 + 1', '1d4', 'Spade');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('141', 'Sciabola', '17 mo', '2.5', 'M', 'T', '5', '1d6 + 1', '1d8 + 1', 'Spade');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('142', 'Spada Scure', '20 mo', '5.5', 'G', 'T', '10', '1d8 + 1', '1d12 + 1', 'Spade');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('143', 'Spatha', '25 mo', '2', 'M', 'T', '5', '1d8', '1d12', 'Spade');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('144', 'Stocco', '15 mo', '2', 'M', 'P', '4', '1d6', '1d8', 'Spade');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('145', 'Tulwar', '17 mo', '3.5', 'M', 'T', '5', '1d6 + 1', '2d4', 'Spade');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('146', 'Wakizashi', '50 mo', '1.5', 'M', 'T/P', '3', '1d8', '1d8', 'Spade');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('147', 'Tridente a Due Mani', '15 mo', '2.5', 'G', 'P', '7', '1d8 + 1', '3d4', 'Generiche');
INSERT INTO `adndproject`.`arma` (`idArma`, `Nome`, `Costo`, `Peso`, `Taglia`, `Tipo`, `FattoreVelocita`, `DannoPM`, `DannoG`, `Categoria`) VALUES ('148', 'Verga a Tre Pezzi', '2 mo', '1.5', 'M', 'C', '7', '1d6', '1d4', 'Generiche');

COMMIT;

-- -----------------------------------------------------
-- Data for table `adndproject`.`tratti`
-- -----------------------------------------------------
SET AUTOCOMMIT=0;
USE `adndproject`;
INSERT INTO `adndproject`.`tratti` (`idTratto`, `Nome`, `CostoPP`) VALUES ('1', 'Affascinare', '4');
INSERT INTO `adndproject`.`tratti` (`idTratto`, `Nome`, `CostoPP`) VALUES ('2', 'Allerta', '6');
INSERT INTO `adndproject`.`tratti` (`idTratto`, `Nome`, `CostoPP`) VALUES ('3', 'Ambidestria', '4');
INSERT INTO `adndproject`.`tratti` (`idTratto`, `Nome`, `CostoPP`) VALUES ('4', 'Bussola interiore', '5');
INSERT INTO `adndproject`.`tratti` (`idTratto`, `Nome`, `CostoPP`) VALUES ('5', 'Contorsionismo', '4');
INSERT INTO `adndproject`.`tratti` (`idTratto`, `Nome`, `CostoPP`) VALUES ('6', 'Cultura eclettica', '4');
INSERT INTO `adndproject`.`tratti` (`idTratto`, `Nome`, `CostoPP`) VALUES ('7', 'Doti artistiche', '4');
INSERT INTO `adndproject`.`tratti` (`idTratto`, `Nome`, `CostoPP`) VALUES ('8', 'Empatia animale', '4');
INSERT INTO `adndproject`.`tratti` (`idTratto`, `Nome`, `CostoPP`) VALUES ('9', 'Empatia', '4');
INSERT INTO `adndproject`.`tratti` (`idTratto`, `Nome`, `CostoPP`) VALUES ('10', 'Fortuna', '6');
INSERT INTO `adndproject`.`tratti` (`idTratto`, `Nome`, `CostoPP`) VALUES ('11', 'Guarigione rapida', '6');
INSERT INTO `adndproject`.`tratti` (`idTratto`, `Nome`, `CostoPP`) VALUES ('12', 'Gusto acuto', '4');
INSERT INTO `adndproject`.`tratti` (`idTratto`, `Nome`, `CostoPP`) VALUES ('13', 'Imitazione', '5');
INSERT INTO `adndproject`.`tratti` (`idTratto`, `Nome`, `CostoPP`) VALUES ('14', 'Immunità naturale al Caldo', '5');
INSERT INTO `adndproject`.`tratti` (`idTratto`, `Nome`, `CostoPP`) VALUES ('15', 'Immunità naturale al Freddo', '4');
INSERT INTO `adndproject`.`tratti` (`idTratto`, `Nome`, `CostoPP`) VALUES ('16', 'Immunità naturale al Veleno', '6');
INSERT INTO `adndproject`.`tratti` (`idTratto`, `Nome`, `CostoPP`) VALUES ('17', 'Immunità naturale alle Malattie', '5');
INSERT INTO `adndproject`.`tratti` (`idTratto`, `Nome`, `CostoPP`) VALUES ('18', 'Memoria Precisa', '4');
INSERT INTO `adndproject`.`tratti` (`idTratto`, `Nome`, `CostoPP`) VALUES ('19', 'Musica/Canto', '5');
INSERT INTO `adndproject`.`tratti` (`idTratto`, `Nome`, `CostoPP`) VALUES ('20', 'Musica/Strumento', '4');
INSERT INTO `adndproject`.`tratti` (`idTratto`, `Nome`, `CostoPP`) VALUES ('21', 'Olfatto Acuto', '6');
INSERT INTO `adndproject`.`tratti` (`idTratto`, `Nome`, `CostoPP`) VALUES ('22', 'Persuasione', '4');
INSERT INTO `adndproject`.`tratti` (`idTratto`, `Nome`, `CostoPP`) VALUES ('23', 'Senso del clima', '4');
INSERT INTO `adndproject`.`tratti` (`idTratto`, `Nome`, `CostoPP`) VALUES ('24', 'Sonno leggero', '5');
INSERT INTO `adndproject`.`tratti` (`idTratto`, `Nome`, `CostoPP`) VALUES ('25', 'Tatto acuto', '4');
INSERT INTO `adndproject`.`tratti` (`idTratto`, `Nome`, `CostoPP`) VALUES ('26', 'Udito acuto', '5');
INSERT INTO `adndproject`.`tratti` (`idTratto`, `Nome`, `CostoPP`) VALUES ('27', 'Vista acuta', '5');

COMMIT;

-- -----------------------------------------------------
-- Data for table `adndproject`.`svantaggi`
-- -----------------------------------------------------
SET AUTOCOMMIT=0;
USE `adndproject`;
INSERT INTO `adndproject`.`svantaggi` (`idSvantaggio`, `Nome`, `PPModerato`, `PPGrave`) VALUES ('1', 'Allergico', '3', '8');
INSERT INTO `adndproject`.`svantaggi` (`idSvantaggio`, `Nome`, `PPModerato`, `PPGrave`) VALUES ('2', 'Avido', '7', NULL);
INSERT INTO `adndproject`.`svantaggi` (`idSvantaggio`, `Nome`, `PPModerato`, `PPGrave`) VALUES ('3', 'Codardo', '7', '15');
INSERT INTO `adndproject`.`svantaggi` (`idSvantaggio`, `Nome`, `PPModerato`, `PPGrave`) VALUES ('4', 'Daltonico', '3', NULL);
INSERT INTO `adndproject`.`svantaggi` (`idSvantaggio`, `Nome`, `PPModerato`, `PPGrave`) VALUES ('5', 'Fanatico', '8', NULL);
INSERT INTO `adndproject`.`svantaggi` (`idSvantaggio`, `Nome`, `PPModerato`, `PPGrave`) VALUES ('6', 'Fisico delicato', '8', NULL);
INSERT INTO `adndproject`.`svantaggi` (`idSvantaggio`, `Nome`, `PPModerato`, `PPGrave`) VALUES ('7', 'Fobia: acqua', '6', '12');
INSERT INTO `adndproject`.`svantaggi` (`idSvantaggio`, `Nome`, `PPModerato`, `PPGrave`) VALUES ('8', 'Fobia: altezza', '5', '10');
INSERT INTO `adndproject`.`svantaggi` (`idSvantaggio`, `Nome`, `PPModerato`, `PPGrave`) VALUES ('9', 'Fobia: buio', '5', '11');
INSERT INTO `adndproject`.`svantaggi` (`idSvantaggio`, `Nome`, `PPModerato`, `PPGrave`) VALUES ('10', 'Fobia: folla', '4', '10');
INSERT INTO `adndproject`.`svantaggi` (`idSvantaggio`, `Nome`, `PPModerato`, `PPGrave`) VALUES ('11', 'Fobia: magia', '8', '14');
INSERT INTO `adndproject`.`svantaggi` (`idSvantaggio`, `Nome`, `PPModerato`, `PPGrave`) VALUES ('12', 'Fobia: mostro (specifico)', '4', '9');
INSERT INTO `adndproject`.`svantaggi` (`idSvantaggio`, `Nome`, `PPModerato`, `PPGrave`) VALUES ('13', 'Fobia: non morti', '8', '14');
INSERT INTO `adndproject`.`svantaggi` (`idSvantaggio`, `Nome`, `PPModerato`, `PPGrave`) VALUES ('14', 'Fobia: ragni', '5', '10');
INSERT INTO `adndproject`.`svantaggi` (`idSvantaggio`, `Nome`, `PPModerato`, `PPGrave`) VALUES ('15', 'Fobia: serpenti', '5', '10');
INSERT INTO `adndproject`.`svantaggi` (`idSvantaggio`, `Nome`, `PPModerato`, `PPGrave`) VALUES ('16', 'Fobia: spazi chiusi', '5', '11');
INSERT INTO `adndproject`.`svantaggi` (`idSvantaggio`, `Nome`, `PPModerato`, `PPGrave`) VALUES ('17', 'Irascibile', '6', NULL);
INSERT INTO `adndproject`.`svantaggi` (`idSvantaggio`, `Nome`, `PPModerato`, `PPGrave`) VALUES ('18', 'Maldestro', '4', '8');
INSERT INTO `adndproject`.`svantaggi` (`idSvantaggio`, `Nome`, `PPModerato`, `PPGrave`) VALUES ('19', 'Nemico potente', '10', NULL);
INSERT INTO `adndproject`.`svantaggi` (`idSvantaggio`, `Nome`, `PPModerato`, `PPGrave`) VALUES ('20', 'Onestà forzata', '8', NULL);
INSERT INTO `adndproject`.`svantaggi` (`idSvantaggio`, `Nome`, `PPModerato`, `PPGrave`) VALUES ('21', 'Personalità irritante', '6', NULL);
INSERT INTO `adndproject`.`svantaggi` (`idSvantaggio`, `Nome`, `PPModerato`, `PPGrave`) VALUES ('22', 'Pigro', '7', NULL);
INSERT INTO `adndproject`.`svantaggi` (`idSvantaggio`, `Nome`, `PPModerato`, `PPGrave`) VALUES ('23', 'Sbadato', '6', NULL);
INSERT INTO `adndproject`.`svantaggi` (`idSvantaggio`, `Nome`, `PPModerato`, `PPGrave`) VALUES ('24', 'Sfortuna', '8', NULL);
INSERT INTO `adndproject`.`svantaggi` (`idSvantaggio`, `Nome`, `PPModerato`, `PPGrave`) VALUES ('25', 'Sonno pesante', '7', NULL);

COMMIT;

-- -----------------------------------------------------
-- Data for table `adndproject`.`stilicombattimento`
-- -----------------------------------------------------
SET AUTOCOMMIT=0;
USE `adndproject`;
INSERT INTO `adndproject`.`stilicombattimento` (`idStile`, `Nome`, `Effetto`) VALUES ('1', 'Con un\'arma', '+1 alla CA. Spendendo 2 PP in più, +2 alla CA anziché +1.');
INSERT INTO `adndproject`.`stilicombattimento` (`idStile`, `Nome`, `Effetto`) VALUES ('2', 'Con arma e scudo', '+1 alla CA o +1 all\'attacco, a scelta ogni round di combattimento.');
INSERT INTO `adndproject`.`stilicombattimento` (`idStile`, `Nome`, `Effetto`) VALUES ('3', 'Con arma a due mani', '-3 al fattore velocità. Se si usa un\'arma a una mano con due mani, +1 ai danni.');
INSERT INTO `adndproject`.`stilicombattimento` (`idStile`, `Nome`, `Effetto`) VALUES ('4', 'Con due armi', 'Riduce le penalità a 0 mano primaria e 2 secondaria. Con tratto Ambidestria, 0 a entrambe. L\'arma secondaria dev\'essere di una taglia più piccola della primaria a meno che non si spendano altri 2 PP.');
INSERT INTO `adndproject`.`stilicombattimento` (`idStile`, `Nome`, `Effetto`) VALUES ('5', 'Con armi da lancio', '+1 alla CA contro armi da lancio, solo se si sta usando armi da lancio. Bonus al movimento durante il combattimento.');
INSERT INTO `adndproject`.`stilicombattimento` (`idStile`, `Nome`, `Effetto`) VALUES ('6', 'A cavallo con armi da lancio', 'Riduce le penalità a cavallo di -2.');
INSERT INTO `adndproject`.`stilicombattimento` (`idStile`, `Nome`, `Effetto`) VALUES ('7', 'Con armi scagliate/fionde', '+1 alla CA contro armi da lancio, solo se si sta usando un arma da scagliare/fionda. Bonus al movimento durante il combattimento.');
INSERT INTO `adndproject`.`stilicombattimento` (`idStile`, `Nome`, `Effetto`) VALUES ('8', 'Speciale', NULL);

COMMIT;

-- -----------------------------------------------------
-- Data for table `adndproject`.`abilitaladri`
-- -----------------------------------------------------
SET AUTOCOMMIT=0;
USE `adndproject`;
INSERT INTO `adndproject`.`abilitaladri` (`idAbilitaladri`, `Nome`) VALUES ('1', 'Svuotare Tasche');
INSERT INTO `adndproject`.`abilitaladri` (`idAbilitaladri`, `Nome`) VALUES ('2', 'Scassinare Serrature');
INSERT INTO `adndproject`.`abilitaladri` (`idAbilitaladri`, `Nome`) VALUES ('3', 'Scoprire/Rimuovere Trappole');
INSERT INTO `adndproject`.`abilitaladri` (`idAbilitaladri`, `Nome`) VALUES ('4', 'Muoversi Silenziosamente');
INSERT INTO `adndproject`.`abilitaladri` (`idAbilitaladri`, `Nome`) VALUES ('5', 'Nascondersi nelle Ombre');
INSERT INTO `adndproject`.`abilitaladri` (`idAbilitaladri`, `Nome`) VALUES ('6', 'Sentire Rumori');
INSERT INTO `adndproject`.`abilitaladri` (`idAbilitaladri`, `Nome`) VALUES ('7', 'Scalare Pareti');
INSERT INTO `adndproject`.`abilitaladri` (`idAbilitaladri`, `Nome`) VALUES ('8', 'Lettura Linguaggi');
INSERT INTO `adndproject`.`abilitaladri` (`idAbilitaladri`, `Nome`) VALUES ('9', 'Individuazione del Magico');
INSERT INTO `adndproject`.`abilitaladri` (`idAbilitaladri`, `Nome`) VALUES ('10', 'Individuazione delle Illusioni');
INSERT INTO `adndproject`.`abilitaladri` (`idAbilitaladri`, `Nome`) VALUES ('11', 'Corrompere');
INSERT INTO `adndproject`.`abilitaladri` (`idAbilitaladri`, `Nome`) VALUES ('12', 'Scavare Passaggi');
INSERT INTO `adndproject`.`abilitaladri` (`idAbilitaladri`, `Nome`) VALUES ('13', 'Svincolarsi');
INSERT INTO `adndproject`.`abilitaladri` (`idAbilitaladri`, `Nome`) VALUES ('14', 'Pugnalare alle Spalle');

COMMIT;
