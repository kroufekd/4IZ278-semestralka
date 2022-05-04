-- Exported from QuickDBD: https://www.quickdatabasediagrams.com/
-- NOTE! If you have used non-SQL datatypes in your design, you will have to change these here.


CREATE TABLE `Persons` (
    `id_person` int  NOT NULL AUTO_INCREMET PRIMARY KEY,
    `name` varchar(50)  NOT NULL ,
    `surname` varchar(50)  NOT NULL ,
    `email` varchar(50)  NOT NULL ,
    `phone` int(9)  NOT NULL ,
);

CREATE TABLE `Teams` (
    `id_team` int  NOT NULL AUTO_INCREMET PRIMARY KEY,
    `name` varchar(50)  NOT NULL ,
    `id_coach` int(11)  NOT NULL ,
);

CREATE TABLE `Persons_teams` (
    `id_person` int  NOT NULL ,
    `id_team` int  NOT NULL 
);

CREATE TABLE `Competition` (
    `id_competition` int  NOT NULL AUTO_INCREMET PRIMARY KEY,
    `name` varchar(50)  NOT NULL ,
    `city` varchar(50)  NOT NULL ,
    `street` varchar(50)  NOT NULL ,
    `building_number` int(11)  NOT NULL ,
    `zip` int(5)  NOT NULL ,
    `start_time` datetime  NOT NULL ,
    `end_time` datetime  NOT NULL ,
);

CREATE TABLE `Competition_teams` (
    `id_competition` int  NOT NULL ,
    `id_team` int  NOT NULL 
);

ALTER TABLE `Teams` ADD CONSTRAINT `fk_Teams_id_coach` FOREIGN KEY(`id_coach`)
REFERENCES `Persons` (`id_person`);

ALTER TABLE `Persons_teams` ADD CONSTRAINT `fk_Persons_teams_id_person` FOREIGN KEY(`id_person`)
REFERENCES `Persons` (`id_person`);

ALTER TABLE `Persons_teams` ADD CONSTRAINT `fk_Persons_teams_id_team` FOREIGN KEY(`id_team`)
REFERENCES `Teams` (`id_team`);

ALTER TABLE `Competition_teams` ADD CONSTRAINT `fk_Competition_teams_id_competition` FOREIGN KEY(`id_competition`)
REFERENCES `Competition` (`id_competition`);

ALTER TABLE `Competition_teams` ADD CONSTRAINT `fk_Competition_teams_id_team` FOREIGN KEY(`id_team`)
REFERENCES `Teams` (`id_team`);

