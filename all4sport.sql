-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           10.4.11-MariaDB - mariadb.org binary distribution
-- SE du serveur:                Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour all4stock
CREATE DATABASE IF NOT EXISTS `all4stock` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `all4stock`;

-- Listage de la structure de la table all4stock. commande
CREATE TABLE IF NOT EXISTS `commande` (
  `com_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `com_date` varchar(45) NOT NULL,
  `com_quantite` varchar(45) NOT NULL,
  `fk_produit` int(11) unsigned NOT NULL,
  `fk_stock` int(11) unsigned NOT NULL,
  `fk_utilisateur` int(11) unsigned NOT NULL,
  `fk_etat` int(11) unsigned NOT NULL,
  PRIMARY KEY (`com_id`),
  KEY `khu_idx` (`fk_produit`),
  KEY `stock` (`fk_stock`),
  KEY `utilisateur_idx` (`fk_utilisateur`),
  KEY `etats` (`fk_etat`) USING BTREE,
  CONSTRAINT `etat` FOREIGN KEY (`fk_etat`) REFERENCES `etat` (`et_id`),
  CONSTRAINT `produit` FOREIGN KEY (`fk_produit`) REFERENCES `produit` (`pr_id`),
  CONSTRAINT `stock` FOREIGN KEY (`fk_stock`) REFERENCES `stock` (`sto_id`),
  CONSTRAINT `utilisateur` FOREIGN KEY (`fk_utilisateur`) REFERENCES `utilisateur` (`ut_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Listage des données de la table all4stock.commande : ~4 rows (environ)
DELETE FROM `commande`;
/*!40000 ALTER TABLE `commande` DISABLE KEYS */;
INSERT INTO `commande` (`com_id`, `com_date`, `com_quantite`, `fk_produit`, `fk_stock`, `fk_utilisateur`, `fk_etat`) VALUES
	(1, '2020/11/09', '1', 1, 1, 1, 1),
	(2, '2020/11/09', '2', 3, 2, 1, 3),
	(3, '2020/11/01', '4', 1, 2, 2, 4),
	(4, '2020/10/31', '1', 2, 1, 3, 6);
/*!40000 ALTER TABLE `commande` ENABLE KEYS */;

-- Listage de la structure de la table all4stock. est_associe
CREATE TABLE IF NOT EXISTS `est_associe` (
  `quantite` int(11) NOT NULL,
  `fk_stock` int(11) unsigned NOT NULL,
  `fk_produit` int(11) unsigned NOT NULL,
  KEY `fk_sto_idx` (`fk_stock`),
  KEY `fk_prod_idx` (`fk_produit`),
  CONSTRAINT `fk_prod` FOREIGN KEY (`fk_produit`) REFERENCES `produit` (`pr_id`),
  CONSTRAINT `fk_sto` FOREIGN KEY (`fk_stock`) REFERENCES `stock` (`sto_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Listage des données de la table all4stock.est_associe : ~17 rows (environ)
DELETE FROM `est_associe`;
/*!40000 ALTER TABLE `est_associe` DISABLE KEYS */;
INSERT INTO `est_associe` (`quantite`, `fk_stock`, `fk_produit`) VALUES
	(50, 1, 2),
	(6, 2, 2),
	(150, 1, 1),
	(60, 1, 3),
	(3, 2, 3),
	(2, 4, 3),
	(20, 2, 1),
	(18, 3, 1),
	(50, 1, 4),
	(4, 2, 4),
	(6, 4, 4),
	(200, 1, 6),
	(30, 2, 6),
	(35, 3, 6),
	(500, 1, 5),
	(30, 3, 5),
	(40, 4, 5);
/*!40000 ALTER TABLE `est_associe` ENABLE KEYS */;

-- Listage de la structure de la table all4stock. etat
CREATE TABLE IF NOT EXISTS `etat` (
  `et_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `et_nom` varchar(45) NOT NULL,
  PRIMARY KEY (`et_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Listage des données de la table all4stock.etat : ~6 rows (environ)
DELETE FROM `etat`;
/*!40000 ALTER TABLE `etat` DISABLE KEYS */;
INSERT INTO `etat` (`et_id`, `et_nom`) VALUES
	(1, 'transmise'),
	(2, 'validée'),
	(3, 'en prépartion'),
	(4, 'expédiée'),
	(5, 'livrée'),
	(6, 'retiré');
/*!40000 ALTER TABLE `etat` ENABLE KEYS */;

-- Listage de la structure de la table all4stock. produit
CREATE TABLE IF NOT EXISTS `produit` (
  `pr_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pr_nom` varchar(45) NOT NULL,
  `pr_cout` double NOT NULL,
  `pr_description` varchar(255) NOT NULL,
  `pr_image` varchar(45) NOT NULL,
  `fk_rayon` int(11) unsigned NOT NULL,
  PRIMARY KEY (`pr_id`),
  KEY `fk_ra_idx` (`fk_rayon`),
  CONSTRAINT `fk_rayon` FOREIGN KEY (`fk_rayon`) REFERENCES `rayon` (`ra_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- Listage des données de la table all4stock.produit : ~7 rows (environ)
DELETE FROM `produit`;
/*!40000 ALTER TABLE `produit` DISABLE KEYS */;
INSERT INTO `produit` (`pr_id`, `pr_nom`, `pr_cout`, `pr_description`, `pr_image`, `fk_rayon`) VALUES
	(1, 'raquette de tennis', 107.99, 'ergonomique', 'm1.png', 3),
	(2, 'ski', 799.99, 'Ski Atomic G7 et bâtons de ski au design BWT.', 'm2.png', 1),
	(3, 'bateau de rafting', 569.99, 'Léger et facile à ranger, le Fisherpro 260 est conçu en PVC d’une épaisseur de 0,9 mm, celui-ci est parfaitement résistant et solide à basse température, résistant également aux UV.', 'm3.png', 1),
	(4, 'Parachute', 139.99, 'Le sac PARA de la marque Dimatex est de couleur Bleu nuit et possède un volume de 28L.', 'm4.png', 1),
	(5, 'Ballon de football', 15.99, 'Ballon en cuire de qualité sous norme française. Circonérence : 63,5 cm. Poids : 340g. Différents coloris.', 'ballon.png', 2),
	(6, 'Maillot', 24.99, 'Maillot officiel de l\'équipe de football du Real Madrid. Tailles : S, M, L, XL.', 'maillot.png', 2);
/*!40000 ALTER TABLE `produit` ENABLE KEYS */;

-- Listage de la structure de la table all4stock. rayon
CREATE TABLE IF NOT EXISTS `rayon` (
  `ra_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ra_nom` varchar(45) NOT NULL,
  PRIMARY KEY (`ra_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Listage des données de la table all4stock.rayon : ~3 rows (environ)
DELETE FROM `rayon`;
/*!40000 ALTER TABLE `rayon` DISABLE KEYS */;
INSERT INTO `rayon` (`ra_id`, `ra_nom`) VALUES
	(1, 'sport extreme'),
	(2, 'football'),
	(3, 'tennis');
/*!40000 ALTER TABLE `rayon` ENABLE KEYS */;

-- Listage de la structure de la table all4stock. stock
CREATE TABLE IF NOT EXISTS `stock` (
  `sto_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `sto_type` varchar(45) NOT NULL,
  PRIMARY KEY (`sto_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Listage des données de la table all4stock.stock : ~4 rows (environ)
DELETE FROM `stock`;
/*!40000 ALTER TABLE `stock` DISABLE KEYS */;
INSERT INTO `stock` (`sto_id`, `sto_type`) VALUES
	(1, 'Internet'),
	(2, 'Magasin n°1'),
	(3, 'Magasin n°2'),
	(4, 'Magasin n°3');
/*!40000 ALTER TABLE `stock` ENABLE KEYS */;

-- Listage de la structure de la table all4stock. typeutilisateur
CREATE TABLE IF NOT EXISTS `typeutilisateur` (
  `ty_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ty_libelle` varchar(45) NOT NULL,
  PRIMARY KEY (`ty_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Listage des données de la table all4stock.typeutilisateur : ~3 rows (environ)
DELETE FROM `typeutilisateur`;
/*!40000 ALTER TABLE `typeutilisateur` DISABLE KEYS */;
INSERT INTO `typeutilisateur` (`ty_id`, `ty_libelle`) VALUES
	(1, 'SALARIE'),
	(2, 'CLIENT'),
	(3, 'MAGASIN');
/*!40000 ALTER TABLE `typeutilisateur` ENABLE KEYS */;

-- Listage de la structure de la table all4stock. utilisateur
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `ut_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ut_surnom` varchar(45) NOT NULL,
  `ut_nom` varchar(45) NOT NULL,
  `ut_adresse` varchar(45) DEFAULT 'AUCUN',
  `ut_email` varchar(45) DEFAULT 'AUCUN',
  `ut_mdp` varchar(45) NOT NULL,
  `fk_typeUtilisateur` int(11) unsigned NOT NULL,
  PRIMARY KEY (`ut_id`),
  KEY `typeUtilisateur_idx` (`fk_typeUtilisateur`),
  CONSTRAINT `typeUtilisateur` FOREIGN KEY (`fk_typeUtilisateur`) REFERENCES `typeutilisateur` (`ty_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Listage des données de la table all4stock.utilisateur : ~6 rows (environ)
DELETE FROM `utilisateur`;
/*!40000 ALTER TABLE `utilisateur` DISABLE KEYS */;
INSERT INTO `utilisateur` (`ut_id`, `ut_surnom`, `ut_nom`, `ut_adresse`, `ut_email`, `ut_mdp`, `fk_typeUtilisateur`) VALUES
	(0, 'Magasin', 'MAGASIN', 'AUCUN', 'AUCUN', 'aLl4SpoRT', 3),
	(1, 'Yoh', 'CARVALHO', '30 rue de Lesdain CREVECOEUR SUR L\'ESCAUT', 'yohan.carvalho.59@gmail.com', '1234', 1),
	(2, 'Libra', 'CHILLARD', 'une adresse JE-NE-SAIS-PAS-OU', 'dylan.chillard@ltpdampierre.fr', '2468', 2),
	(3, 'ravageur', 'GIERA', 'une adresse JE-NE-SAIS-PAS-OU', 'maxime.giera@ltpdampierre.fr', '6789', 2),
	(4, 'yo', 'CARVALHO', 'rue là', 'yo@hotmail.com', 'yohp', 2),
	(5, 'roger2.0', 'ROGER', 'rue de Roger', 'roger@gmail.com', '', 1);
/*!40000 ALTER TABLE `utilisateur` ENABLE KEYS */;

-- Listage de la structure de la table all4stock. vente
CREATE TABLE IF NOT EXISTS `vente` (
  `ve_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ve_date` varchar(45) NOT NULL,
  `ve_quantite` varchar(45) NOT NULL,
  `fk_stock` int(11) unsigned NOT NULL,
  `fk_utilisateur` int(11) unsigned DEFAULT NULL,
  `fk_produit` int(11) unsigned NOT NULL,
  PRIMARY KEY (`ve_id`),
  KEY `stock_vente` (`fk_stock`),
  KEY `utilisateur_vente` (`fk_utilisateur`),
  KEY `produit_vente` (`fk_produit`),
  CONSTRAINT `produit_vente` FOREIGN KEY (`fk_produit`) REFERENCES `produit` (`pr_id`),
  CONSTRAINT `stock_vente` FOREIGN KEY (`fk_stock`) REFERENCES `stock` (`sto_id`),
  CONSTRAINT `utilisateur_vente` FOREIGN KEY (`fk_utilisateur`) REFERENCES `utilisateur` (`ut_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Listage des données de la table all4stock.vente : ~3 rows (environ)
DELETE FROM `vente`;
/*!40000 ALTER TABLE `vente` DISABLE KEYS */;
INSERT INTO `vente` (`ve_id`, `ve_date`, `ve_quantite`, `fk_stock`, `fk_utilisateur`, `fk_produit`) VALUES
	(1, '2020/11/14', '1', 2, 0, 3),
	(2, '2020/11/14', '2', 2, 2, 1),
	(3, '2020/11/14', '1', 3, 0, 1);
/*!40000 ALTER TABLE `vente` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
