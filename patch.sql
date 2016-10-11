ALTER TABLE `riskassessment` ADD `expiry_date` INT NOT NULL DEFAULT '1' AFTER `ecpireReminder`;
CREATE TABLE `safety3`.`injury_hazard` ( `id` INT NOT NULL AUTO_INCREMENT , `hazard_id` INT NOT NULL , `injury` INT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;
ALTER TABLE `injury_hazard` CHANGE `injury` `injury` TEXT NOT NULL;
ALTER TABLE `hazard` ADD `name_other` TEXT NOT NULL AFTER `status`;
