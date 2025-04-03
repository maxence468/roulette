DROP TABLE IF EXISTS `roulette_joueur`;
DROP TABLE IF EXISTS `roulette_partie`;


CREATE TABLE `roulette_joueur` (
  `identifiant` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `motdepasse` varchar(255) NOT NULL,
  `argent` int(11) NOT NULL
);

CREATE TABLE `roulette_partie` (
  `identifiant` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `joueur` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `mise` int(11) NOT NULL,
  `gain` int(11) NOT NULL,
   FOREIGN KEY (joueur) REFERENCES roulette_joueur(identifiant)
);

INSERT INTO roulette_joueur VALUES (null, "login", "password", 500);