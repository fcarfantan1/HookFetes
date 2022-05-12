
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- agenda_fetes
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `agenda_fetes`;

CREATE TABLE `agenda_fetes`
(
    `fetes_id` INTEGER NOT NULL AUTO_INCREMENT,
    `title` VARCHAR(255),
    `description` LONGTEXT,
    `departement` VARCHAR(255) NOT NULL,
    `ville` VARCHAR(255) NOT NULL,
    `lien` VARCHAR(255),
    `debut` DATE NOT NULL,
    `fin` DATE NOT NULL,
    `position` INTEGER NOT NULL default 0,
    PRIMARY KEY (`fetes_id`)
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
