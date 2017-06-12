/*persons. They will have attributes including names and species
Worlds. These are the locations where battles and stories occur
Alliances. This will show what government or order the person belonged to.
Vehicles. There are many different types of land, air and space vehicles in the show

These are the relationships between the entities:

persons originate from worlds, a one to one relationships.
persons report to other persons, a one to many relationship.
For example, a Jedi apprentice serves one master, but a Jedi master may command
other Jedi
persons belong to different alliances, a many to many relationship.
For example, a Jedi may belong to the Jedi order, but also fight for the Alliance.
persons use different vehicles, a many to many relationship. For example,
 a Jedi could server on a Starship, but also pilot a star fighter. */

CREATE TABLE `person` (
  `id` int NOT NULL AUTO_INCREMENT,
  `p_name` VARCHAR(25) NOT NULL,
  `species` VARCHAR(255) NOT NULL,
  `homeworld` VARCHAR(255) NOT NULL,
  `occupation` VARCHAR(255) NOT NULL,
  `c_affiliation` VARCHAR(255) NOT NULL,
  PRIMARY KEY(`id`)
) ENGINE=InnoDB;

CREATE TABLE `world`(
  `id` int NOT NULL AUTO_INCREMENT,
  `w_name` VARCHAR(255) NOT NULL,
  `w_affiliation` VARCHAR(255) NOT NULL,
  PRIMARY KEY(`id`)
) ENGINE=InnoDB;

CREATE TABLE `alliances`(
  `id` int NOT NULL AUTO_INCREMENT,
  `a_name` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`)
)ENGINE=InnoDB;

CREATE TABLE `vehicles`(
  `id` int NOT NULL AUTO_INCREMENT,
  `v_name` VARCHAR(255) NOT NULL,
  `class` VARCHAR(255) NOT NULL,
  PRIMARY KEY(`id`)
)ENGINE=InnoDB;

--relationships
CREATE TABLE `origin`(
  `p_id` int NOT NULL,
  `world_id` int NOT NULL,
  PRIMARY KEY(`p_id`, `world_id`),
  FOREIGN KEY(`p_id`) REFERENCES person(`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  FOREIGN KEY(`world_id`) REFERENCES world(`id`) ON DELETE RESTRICT ON UPDATE CASCADE
)ENGINE=InnoDB;

CREATE TABLE `serves`(
  `master_id` int NOT NULL,
  `servant_id` int NOT NULL,
  PRIMARY KEY(`master_id`, `servant_id`),
  FOREIGN KEY(`master_id`) REFERENCES person(`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  FOREIGN KEY(`servant_id`) REFERENCES person(`id`) ON DELETE RESTRICT ON UPDATE CASCADE
)ENGINE=InnoDB;

CREATE TABLE `associations`(
  `p_id` int NOT NULL,
  `alliance_id` int NOT NULL,
  PRIMARY KEY(`p_id`, `alliance_id`),
  FOREIGN KEY(`p_id`) REFERENCES person(`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  FOREIGN KEY(`alliance_id`) REFERENCES alliances(`id`) ON DELETE RESTRICT ON UPDATE CASCADE
)ENGINE=InnoDB;

CREATE TABLE `pilots`(
  `p_id` int NOT NULL,
  `vehicle_id` int NOT NULL,
  PRIMARY KEY(`p_id`, `vehicle_id`),
  FOREIGN KEY(`p_id`) REFERENCES person(`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  FOREIGN KEY(`vehicle_id`) REFERENCES vehicles(`id`) ON DELETE RESTRICT ON UPDATE CASCADE
)ENGINE=InnoDB;

--insert alliances
INSERT INTO alliances(a_name)
VALUES ('Jedi'), ('Sith'), ('Galactic Republic'), ('Separatist'), ('Ohnaka Gang'), ('Neutral'), ('Nightsisters');

--insert worlds--
INSERT INTO world(w_name, w_affiliation)
VALUES ('Coruscant', 'Galactic Republic'), ('Geonosis', 'Separatist'),
       ('Tatooine', 'Neutral'),('Stewjon', 'Neutral'), ('Dagobah', 'Neutral'),
       ('Naboo', 'Galactic Republic'), ('Sriluur', 'Neutral'), ('Dathomir', 'Nightsisters'),
       ('Mustafar', 'Sith'), ('Kalee', 'Neutral'), ('Shili', 'Galactic Republic');

--insert persons--
INSERT INTO person(p_name, species, homeworld, occupation, c_affiliation)
VALUES ('Anakin Skywalker', 'Human', 'Tatooine', 'Jedi Knight', 'Jedi, Galactic Republic'),
       ('Obi-wan Kenobi', 'Human', 'Stewjon', 'Jedi Master', 'Jedi, Galactic Republic'),
       ('Sheev Palpatine', 'Human', 'Naboo', 'Chancellor of Republic, Leader of Separatists', 'Sith, Galactic Republic, Separatist'),
       ('Asajj Ventress', 'Dathomirian', 'Dathomir', 'Bounty Hunter', 'Nightsisters'),
       ('Hondo Ohnaka', 'Weequay', 'Sriluur', 'Pirate', 'Ohnaka Gang'),
       ('Ahsoka Tano', 'Togruta', 'Shili', 'Jedi Padawan', 'Jedi, Galactic Republic'),
       ('Grievous', 'Kaleesh', 'Kalee', 'General', 'Separatist');

--vehicles--
INSERT INTO vehicles(v_name, class)
VALUES ('Jedi Interceptor', 'Starfighter'),
       ('Recusant-class light destroyer', 'Cruiser'),
       ('Venator-class Star Destroyer', 'Star Destroyer'),
       ('Droid Tri-Fighter', 'Starfighter');

--insert origin pairs from person and world--
INSERT INTO origin(p_id, world_id)
VALUES ((SELECT id FROM person WHERE p_name = 'Anakin Skywalker'), (SELECT id FROM world WHERE w_name = 'Tatooine')),
        ((SELECT id FROM person WHERE p_name = 'Obi-wan Kenobi'), (SELECT id FROM world WHERE w_name = 'Stewjon')),
        ((SELECT id FROM person WHERE p_name = 'Sheev Palpatine'), (SELECT id FROM world WHERE w_name = 'Naboo')),
        ((SELECT id FROM person WHERE p_name = 'Asajj Ventress'), (SELECT id FROM world WHERE w_name = 'Dathomir')),
        ((SELECT id FROM person WHERE p_name = 'Hondo Ohnaka'), (SELECT id FROM world WHERE w_name = 'Sriluur')),
        ((SELECT id FROM person WHERE p_name = 'Ahsoka Tano'), (SELECT id FROM world WHERE w_name = 'Shili')),
        ((SELECT id FROM person WHERE p_name = 'Grievous'), (SELECT id FROM world WHERE w_name = 'Kalee'));
--insert serves pairs from person and person--
INSERT INTO serves(master_id, servant_id)
VALUES ((SELECT id FROM person WHERE p_name = 'Obi-wan Kenobi'), (SELECT id FROM person WHERE p_name = 'Anakin Skywalker')),
       ((SELECT id FROM person WHERE p_name = 'Sheev Palpatine'), (SELECT id FROM person WHERE p_name = 'Grievous')),
       ((SELECT id FROM person WHERE p_name = 'Anakin Skywalker'), (SELECT id FROM person WHERE p_name = 'Ahsoka Tano')),
       ((SELECT id FROM person WHERE p_name = 'Sheev Palpatine'), (SELECT id FROM person WHERE p_name = 'Asajj Ventress'));

--insert associations pairs from person and alliance--
INSERT INTO associations(p_id, alliance_id)
VALUES ((SELECT id FROM person WHERE p_name = 'Obi-wan Kenobi'), (SELECT id FROM alliances WHERE a_name = 'Jedi')),
       ((SELECT id FROM person WHERE p_name = 'Obi-wan Kenobi'), (SELECT id FROM alliances WHERE a_name = 'Galactic Republic')),
       ((SELECT id FROM person WHERE p_name = 'Sheev Palpatine'), (SELECT id FROM alliances WHERE a_name = 'Sith')),
       ((SELECT id FROM person WHERE p_name = 'Sheev Palpatine'), (SELECT id FROM alliances WHERE a_name = 'Separatist')),
       ((SELECT id FROM person WHERE p_name = 'Sheev Palpatine'), (SELECT id FROM alliances WHERE a_name = 'Galactic Republic')),
       ((SELECT id FROM person WHERE p_name = 'Hondo Ohnaka'), (SELECT id FROM alliances WHERE a_name = 'Pirate')),
       ((SELECT id FROM person WHERE p_name = 'Anakin Skywalker'), (SELECT id FROM alliances WHERE a_name = 'Jedi')),
       ((SELECT id FROM person WHERE p_name = 'Anakin Skywalker'), (SELECT id FROM alliances WHERE a_name = 'Galactic Republic'));

--insert pilots pairs from person and vehicles
INSERT INTO pilots(p_id, vehicle_id)
VALUES ((SELECT id FROM person WHERE p_name = 'Obi-wan Kenobi'), (SELECT id from vehicles WHERE v_name = 'Venator-class Star Destroyer')),
       ((SELECT id FROM person WHERE p_name = 'Ahsoka Tano'), (SELECT id from vehicles WHERE v_name = 'Jedi Interceptor')),
       ((SELECT id FROM person WHERE p_name = 'Grievous'), (SELECT id from vehicles WHERE v_name = 'Recusant-class light Destroyer')),
       ((SELECT id FROM person WHERE p_name = 'Asajj Ventress'), (SELECT id from vehicles WHERE v_name = 'Droid Tri-Fighter'));
