ALTER TABLE `riskassessment` ADD `expiry_date` INT NOT NULL DEFAULT '1' AFTER `ecpireReminder`;
CREATE TABLE `safety3`.`injury_hazard` ( `id` INT NOT NULL AUTO_INCREMENT , `hazard_id` INT NOT NULL , `injury` INT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;
