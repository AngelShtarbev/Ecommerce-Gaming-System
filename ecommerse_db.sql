-- MySQL dump 10.13  Distrib 5.7.9, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: ecommerse_database_normalize
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.9-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `about`
--

DROP TABLE IF EXISTS `about`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `about` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `location` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `skype` varchar(100) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `about`
--

LOCK TABLES `about` WRITE;
/*!40000 ALTER TABLE `about` DISABLE KEYS */;
INSERT INTO `about` VALUES (1,'San Francisco600 Harrison St. 6 3rd Floor San Francisco, CA 94107','GamesCorner@gmail.com','333 126 8347','GamesCorner_online','GamesCorner mission is to provide sellers and buyers from all around the world the possibility to trade video games at fair price with minimal hassle through an innovative platform.\r\nSince its launch in early 2010, GamesCorner has quickly become the largest alternative gaming marketplace with over 2 mil. loving customers.\r\nTo ensure maximum satisfaction customers enjoy the benefit of optional Buyer Protection Program with 30 days money back guarantee. In addition a very competent Customer Support team takes care of any issue through instant LiveChat.');
/*!40000 ALTER TABLE `about` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `administrators`
--

DROP TABLE IF EXISTS `administrators`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `administrators` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `administrators`
--

LOCK TABLES `administrators` WRITE;
/*!40000 ALTER TABLE `administrators` DISABLE KEYS */;
INSERT INTO `administrators` VALUES (1,'admin_angel','c8a50f632c3c4baf27fc05facb1883104e1d16ef','angel@mail.com','angel'),(2,'admin_angel1','11594787a658a5de6a49dccfb90c889fad9eeef1','angel1@mail.com','angel1'),(3,'admin_angel_sht','da39a3ee5e6b4b0d3255bfef95601890afd80709','sht@mail.com','angelsht45'),(4,'admin4_angel3','3713ce542e96b432188327b079d740a38a931d5d','angel4@mail.com','Angel35'),(7,'Koen12','da39a3ee5e6b4b0d3255bfef95601890afd80709','koen12@mail.com','Koen12'),(8,'admin_ivan','da39a3ee5e6b4b0d3255bfef95601890afd80709','ivan13@mail.com','Ivan');
/*!40000 ALTER TABLE `administrators` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contact`
--

DROP TABLE IF EXISTS `contact`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contact` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact`
--

LOCK TABLES `contact` WRITE;
/*!40000 ALTER TABLE `contact` DISABLE KEYS */;
INSERT INTO `contact` VALUES (1,'a.k.shtarbev@mail.com','Game Crysis 3 PC Info','Crysis 3 Crysis 3 Crysis 3 Crysis 3 Crysis 3 Crysis 3 Crysis 3 Crysis 3 Crysis 3 Crysis 3 Crysis 3 Crysis 3 '),(3,'a.k.shtarbev@mail.bg','adwadwadawda5555','awdawdawdawdawdawd4544545454545');
/*!40000 ALTER TABLE `contact` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `games`
--

DROP TABLE IF EXISTS `games`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `games` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name_id` int(10) unsigned NOT NULL,
  `category_id` int(10) unsigned NOT NULL,
  `description_id` int(10) unsigned NOT NULL,
  `year_id` int(10) unsigned NOT NULL,
  `genre_id` int(10) unsigned NOT NULL,
  `image` varchar(100) NOT NULL,
  `price` float(10,2) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `games`
--

LOCK TABLES `games` WRITE;
/*!40000 ALTER TABLE `games` DISABLE KEYS */;
INSERT INTO `games` VALUES (1,1,1,1,1,1,'crysis3_pc.jpg',30.99),(2,2,1,2,2,2,'stc2_legacy.jpg',25.55),(3,3,1,3,3,1,'battlefield4_pc.jpg',27.99),(4,4,2,4,4,3,'diablo3Reaper_xboxOne.jpg',40.75),(5,5,1,5,5,4,'asyn_pc.jpg',45.99),(6,6,2,6,6,4,'fallout4_xbox.jpg',50.99),(7,1,3,1,1,1,'crysis3_ps3.jpg',40.99),(8,1,4,1,1,1,'crysis3_xbox360.jpg',45.99),(9,3,3,3,3,1,'battlefield4_ps3.jpg',37.99),(10,3,5,3,3,1,'battlefield4_ps4.jpg',40.99),(11,3,4,3,3,1,'battlefield4_xbox360.jpg',35.70),(12,7,1,7,7,1,'cob3_pc.jpg',35.65),(13,7,3,7,7,1,'cob3_ps3.jpg',40.65),(14,7,5,7,7,1,'cob3_ps4.jpg',45.65),(15,7,2,7,7,1,'cob3_xboxOne.jpg',50.65),(16,5,2,5,5,4,'asyn_xbox.jpg',50.99),(17,6,1,6,6,4,'fallout4_pc.jpg',30.99),(18,4,1,4,4,3,'diabloReaper_pc.jpg',35.75),(19,4,5,4,4,3,'diablo3Reaper_ps4.jpg',40.75),(20,8,1,8,8,5,'nfs_pc.jpg',30.75),(21,8,5,8,8,5,'nfs_ps4.jpg',35.85),(22,8,2,8,8,5,'nfs_xboxOne.jpg',45.85),(23,9,1,9,9,4,'gta5_pc.jpg',40.75),(24,9,2,9,9,4,'gta5_xboxOne.jpg',45.55),(25,9,3,9,9,4,'71bf839cd1230170418bc78d004b9cc08e490337.jpg',55.65),(26,10,6,10,10,4,'43db770b1301ff94cdceb2491349f52910faf388.jpg',12.45),(27,11,6,11,11,5,'4cd900a22170b969ef318a48e55d758ca34e3716.jpg',15.78),(28,12,6,12,12,1,'324db56b5a126f773c87d67c7d14136da2182dcd.jpg',10.00),(29,13,6,13,13,4,'e453b7153de72e943117a9b04a21bfa0803b7e01.jpg',32.00),(30,14,6,14,14,4,'bfe6b7cb65e3b01b43ad64dbf97a16b6f3726964.jpg',14.65),(31,28,7,28,28,4,'asa.jpg',50.00),(32,15,7,15,15,5,'wrc.jpg',45.65),(33,16,7,16,16,4,'bat.jpg',25.50),(34,17,7,17,17,1,'re.jpg',24.20),(35,18,7,18,18,1,'kill.jpg',25.50),(36,19,4,19,19,4,'efe9de4e0a5f8711b078a4906e32368f2008dd54.jpg',27.43),(37,20,4,20,20,1,'a430070bdc9655a64729905b81609569e7d2664e.jpg',24.45),(38,21,4,21,21,4,'1af363d322f03e05ad285c1350b80a06bb51fc9f.jpg',17.56),(39,22,8,22,22,1,'59b3eb0842ccb7fdf72682a0aac631819785bbda.jpg',15.00),(40,23,8,23,23,4,'as.jpg',17.78),(41,24,8,24,24,1,'call.jpg',11.50),(42,25,9,25,25,4,'ship.jpg',11.94),(43,26,9,26,26,5,'5955800c3333bd5fa84140e7c770581a72638a04.jpg',41.89),(44,27,9,27,27,5,'3f3bcf616584b27b8b87250f904ce8d229ead267.jpg',69.50);
/*!40000 ALTER TABLE `games` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `games_additional_info`
--

DROP TABLE IF EXISTS `games_additional_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `games_additional_info` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name_id` int(11) NOT NULL,
  `image_id` int(11) NOT NULL,
  `video_id` int(11) NOT NULL,
  `games_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=190 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `games_additional_info`
--

LOCK TABLES `games_additional_info` WRITE;
/*!40000 ALTER TABLE `games_additional_info` DISABLE KEYS */;
INSERT INTO `games_additional_info` VALUES (0,0,0,0,0,0),(11,1,1,1,1,1),(12,1,2,1,1,1),(13,1,3,1,1,1),(14,1,4,1,1,1),(15,9,5,9,25,3),(16,9,6,9,25,3),(18,9,7,9,25,3),(19,9,8,9,25,3),(20,9,5,9,24,2),(21,9,6,9,24,2),(22,9,7,9,24,2),(23,9,8,9,24,2),(24,9,5,9,23,1),(25,9,6,9,23,1),(26,9,7,9,23,1),(27,9,8,9,23,1),(28,8,9,8,22,2),(29,8,10,8,22,2),(30,8,11,8,22,2),(31,8,12,8,22,2),(32,8,9,8,21,5),(33,8,10,8,21,5),(34,8,11,8,21,5),(35,8,12,8,21,5),(36,8,9,8,20,1),(37,8,10,8,20,1),(38,8,11,8,20,1),(39,8,12,8,20,1),(40,4,13,4,18,1),(41,4,14,4,18,1),(42,4,15,4,18,1),(43,4,16,4,18,1),(44,4,13,4,19,5),(45,4,14,4,19,5),(47,4,16,4,19,5),(48,4,13,4,4,2),(49,4,14,4,4,2),(50,4,15,4,4,2),(51,4,16,4,4,2),(52,6,17,6,17,1),(53,6,18,6,17,1),(54,6,19,6,17,1),(55,6,20,6,17,1),(56,6,17,6,6,2),(57,6,18,6,6,2),(58,6,19,6,6,2),(59,6,20,6,6,2),(62,5,21,5,5,1),(63,5,22,5,5,1),(64,5,23,5,5,1),(65,5,24,5,5,1),(66,5,21,5,16,2),(67,5,22,5,16,2),(68,5,23,5,16,2),(69,5,24,5,16,2),(70,7,25,7,12,1),(71,7,26,7,12,1),(72,7,27,7,12,1),(73,7,28,7,12,1),(74,7,25,7,13,3),(75,7,26,7,13,3),(76,7,27,7,13,3),(77,7,28,7,13,3),(78,7,25,7,14,5),(79,7,26,7,14,5),(80,7,27,7,14,5),(81,7,28,7,14,5),(82,7,25,7,15,2),(83,7,26,7,15,2),(84,7,27,7,15,2),(85,7,28,7,15,2),(86,3,29,3,3,1),(87,3,30,3,3,1),(88,3,31,3,3,1),(89,3,32,3,3,1),(90,3,29,3,9,3),(91,3,30,3,9,3),(92,3,31,3,9,3),(93,3,32,3,9,3),(94,3,29,3,10,5),(95,3,30,3,10,5),(96,3,31,3,10,5),(97,3,32,3,10,5),(98,3,29,3,11,4),(99,3,30,3,11,4),(100,3,31,3,11,4),(101,3,32,3,11,4),(102,1,1,1,7,3),(103,1,2,1,7,3),(104,1,3,1,7,3),(105,1,4,1,7,3),(106,1,1,1,8,4),(107,1,2,1,8,4),(108,1,3,1,8,4),(109,1,4,1,8,4),(110,2,33,2,2,1),(111,2,34,2,2,1),(112,2,35,2,2,1),(113,2,36,2,2,1),(114,10,37,10,26,6),(115,10,38,10,26,6),(116,10,39,10,26,6),(117,10,40,10,26,6),(118,11,41,11,27,6),(119,11,42,11,27,6),(120,11,43,11,27,6),(121,11,44,11,27,6),(122,12,45,12,28,6),(123,12,46,12,28,6),(124,12,47,12,28,6),(125,12,48,12,28,6),(126,13,49,13,29,6),(127,13,50,13,29,6),(128,13,51,13,29,6),(129,13,52,13,29,6),(130,14,53,14,30,6),(131,14,54,14,30,6),(132,14,55,14,30,6),(133,14,56,14,30,6),(134,28,57,28,31,7),(135,28,58,28,31,7),(136,28,59,28,31,7),(137,28,60,28,31,7),(138,15,61,15,32,7),(139,15,62,15,32,7),(140,15,63,15,32,7),(141,15,64,15,32,7),(142,16,65,16,33,7),(143,16,66,16,33,7),(144,16,67,16,33,7),(145,16,68,16,33,7),(146,17,69,17,34,7),(147,17,70,17,34,7),(148,17,71,17,34,7),(149,17,72,17,34,7),(150,18,73,18,35,7),(151,18,74,18,35,7),(152,18,75,18,35,7),(153,18,76,18,35,7),(154,19,77,19,36,4),(155,19,78,19,36,4),(156,19,79,19,36,4),(157,19,80,19,36,4),(158,20,81,20,37,4),(159,20,82,20,37,4),(160,20,83,20,37,4),(161,20,84,20,37,4),(162,21,85,21,38,4),(163,21,86,21,38,4),(164,21,87,21,38,4),(165,21,88,21,38,4),(166,22,89,22,39,8),(167,22,90,22,39,8),(168,22,91,22,39,8),(169,22,92,22,39,8),(170,23,93,23,40,8),(171,23,94,23,40,8),(172,23,95,23,40,8),(173,23,96,23,40,8),(174,24,97,24,41,8),(175,24,98,24,41,8),(176,24,99,24,41,8),(177,24,100,24,41,8),(178,25,101,25,42,9),(179,25,102,25,42,9),(180,25,103,25,42,9),(181,25,104,25,42,9),(182,26,105,26,43,9),(183,26,106,26,43,9),(184,26,107,26,43,9),(185,26,108,26,43,9),(186,27,109,27,44,9),(187,27,110,27,44,9),(188,27,111,27,44,9),(189,27,112,27,44,9);
/*!40000 ALTER TABLE `games_additional_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `games_categories`
--

DROP TABLE IF EXISTS `games_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `games_categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `games_categories`
--

LOCK TABLES `games_categories` WRITE;
/*!40000 ALTER TABLE `games_categories` DISABLE KEYS */;
INSERT INTO `games_categories` VALUES (1,'PC'),(2,'Xbox One'),(3,'PS3'),(4,'Xbox 360'),(5,'PS4'),(6,'PS2'),(7,'PS Vita'),(8,'Wii U'),(9,'Nintendo 3DS');
/*!40000 ALTER TABLE `games_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `games_description`
--

DROP TABLE IF EXISTS `games_description`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `games_description` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `description` text NOT NULL,
  `game` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `games_description`
--

LOCK TABLES `games_description` WRITE;
/*!40000 ALTER TABLE `games_description` DISABLE KEYS */;
INSERT INTO `games_description` VALUES (1,'The fate of the world is in your hands. New and old enemies threaten the peace you worked so hard to achieve 24 years ago. Your search for the Alpha Ceph continues, but this time you\'ll also need to expose the truth behind the C.E.L.L. corporation. It won\'t be easy, but your Nanosuit helps you clear a path to victory. Craft a stealthy attack to defeat your opponents quietly, or decimate the enemy with a blaze of brute force. There\'s no wrong way to save the world.','Crysis 3'),(2,'All things must come to an end -- but with the psionic power of the Protoss on your side, fear is an illusion. Guide the Protoss as they struggle to unite the three races in the ultimate battle for survival against an ancient evil threatening all life in the universe. Experience the epic conclusion to the StarCraft II trilogy and find out who perseveres in the face of adversity.','StarCraft 2  Legacy of the Void'),(3,'Battlefield 4 puts you in the boots of US Marine Sgt. Daniel Recker, member of the Tombstone squad. Against the backdrop of a global conflict between US, Russia and China, you\'ll engage in combat on foot and by operating land, sea and air units.','Battlefield 4'),(4,'Twenty years have passed since the Prime Evils were defeated and banished from the world of Sanctuary. Now, you must return to where it all began – the town of Tristram – and investigate rumors of a fallen star, for this is the first sign of evil’s rebirth, and an omen that the End Times have begun.Wield the might of a thousand powers.Conquer an infinite battlefield.','Diablo 3 Reaper of Souls'),(5,'London, 1868. The Industrial Revolution unleashes an incredible age of invention, transforming the lives of millions with technologies once thought impossible. Opportunities created during this time period have people rushing to London to engage in this new world. A world no longer controlled by kings, emperors, politicians or religion, but by a new common denominator: money.','Assassin\'s Creed Syndicate'),(6,'Welcome to the next-generation of open-world gaming. As the sole survivor of Vault 111, you enter a world destroyed by nuclear war. Every second is a fight for survival, and every choice is yours. Only you can rebuild and determine the fate of the Wasteland. Welcome home.','Fallout 4'),(7,'Take arms, gather your squad and fulfill your duty as a member of the black ops. The art of warfare around the world has changed significantly due to the scientific progression that has been made in the last years. Machines and biological weapons are dominating the area of war, which led many to leave their fates in the hands of several supersoldiers, all of which were bred and trained to ensure victory in the craziest environments possible.','Call of Duty Black Ops 3'),(8,'Ready to own the streets? Get behind the wheel of iconic cars and floor it through Ventura Bay, a sprawling urban playground. Explore overlapping stories as you build your reputation – and your dream car – and become the ultimate racing icon. Play again and again because this time, you have 5 distinct ways to win.','Need for Speed'),(9,'When a young street hustler, a retired bank robber and a terrifying psychopath find themselves entangled with some of the most frightening and deranged elements of the criminal underworld, the U.S. government and the entertainment industry, they must pull off a series of dangerous heists to survive in a ruthless city in which they can trust nobody, least of all each other.\r\n The game offers players a huge range of PC-specific customization options, including over 25 separate configurable settings for texture quality, shaders, tessellation, anti-aliasing and more, as well as support and extensive customization for mouse and keyboard controls. Additional options include a population density slider to control car and pedestrian traffic, as well as dual and triple monitor support, 3D compatibility, and plug-and-play controller support.  ','Grand Theft Auto V'),(10,'Huge collection of combat & magic - Use combos from the original God Of War, along with brutal new moves and magic\r\n Use the power of Nature\'s elements in your fight, controlling wind, ice and more\r\n Encounter more of the greatest Greek mythological characters and face-off against more terrifying bosses\r\n Experience a labyrinth of challenging mini-games intricately woven into the story, for puzzle-solving action\r\n Journey to more vividly striking environments - The dark and violent world of Greek mythology will come to life in gory detail','God of War 2'),(11,'Point-to-Point Baja style racing takes center stage as full motion videos move the story of your rookie rider progressing through the professional ranks\r\n 3 new offroad racing vehicles including MX Bikes, Buggies and Trophy Trucks along with the classic ATVs\r\n Select a rider, select a vehicle then compete in various races, challenges and championships while earning prestige in Story Mode\r\n 72 distinct tracks from 8 different styles including point to point, supercross, freestyle, rallycross, dirt circuits, hybrid nationals, head to head and hill climb\r\n New Track editor offers racers the ability to make the straight-aways longer, the cornerstighter, the berms slicker and the jumps bigger','ATV Offroad Fury 4'),(12,'Call of Duty 3 brings the battle to life with advanced graphics, a new physics engine, a procedural environment and detailed ensemble animations\r\n All-new close-quarters battle mechanics allow players to fight hand-to-hand, improvise explosive devices, disarm traps and face a host of other battlefield situations\r\n Next-generation level design provides branching mission paths, letting you decide how to confront enemies - flank an opponent, hit him head-on, or choose special tactics like sniping and demolition\r\n Environmental physics allow players to destroy enemy hideouts, forcing foes out in the open -- just remember, your enemies can do the same to you\r\n Team-based Multiplayer with vehicles for team-based combat with up to 24 players battling it out online','Call of Duty 3'),(13,'Confront and associate with familiar faces from the Star Wars films, including Darth Vader in addition to new adversaries such as fugitive Jedi and Force-sensitive Felucians\r\n Unleash and upgrade the Secret Apprentice\'s four core Force powers - Force push, grip, repulse and lightning - throughout the course of the game, and combine them for ultra-destructive, never-before-seen combos.\r\n Examples of unleashing the Force in ways never thought possible: Secret Apprentice won\'t just Force push enemies into walls - he\'ll Force push enemies through walls, and will Force grip them in midair, zap them with lightning, then drop them to the ground.\r\n Decisions made by players throughout the game will determine the path of the story, including multiple endings that will rock Star Wars continuity as they know it.','Star Wars: The Force Unleashed'),(14,'A unique array of attacks specific to each Transformer ranging from powerful missile attacks and rapid-fire chain guns to explosive energy blasts and visceral melee strikes.\r\n Offline co-op challenges and brutal head-to-head battles that redefine the Transformers franchise for console gaming.\r\n Play as your favorite Autobot or Decepticon as you gather the points needed to upgrade your weapons, level up your robot, and use unique abilities to fight the way you\'ve always imagined.\r\n An all new system gives you precise control as you instantly switch between Robot, Vehicle, and Weapon modes at any time.\r\n Intense, heroic mission gameplay that make the difference between survival and destruction as you drive, fly, fight and shoot your way through gripping levels.','Transformers Revenge of the Fallen'),(15,'Over 20 cars, 50 liveries and teams, and all of the WRC, WRC 2, WRC 3 and Junior WRC rallies\r\n 65 new special stages in 13 countries, for over 250 miles of racing\r\n Hot seat and online multiplayer modes\r\n Tire, damage and engine tuning management: your car, your rally, your driving style','WRC 5'),(16,'Journey back in time and put on the cape and cowl of a young and unrefined Batman as you face a defining moment in your early career as a crime fighter that sets your path to becoming the Dark Knight\r\n Encounter a variety of important characters for the first time and forge key relationships that will shape Batman\'s destiny\r\n Explore an expanded Gotham City before the rise of its most dangerous criminals and vile villains came to pass as you delve into an original prequel storyline\r\n Experience the thrilling 2.5D visuals on your PS Vita that let you continue the storyline of the console version and discover more details of the Caped Crusader\'s past','Batman: Arkham Origins - Blackgate'),(17,'The first ever touch-screen first person shooter on PlayStation - developed to showcase the functions of PlayStation Vita.A social networking feature that links players and non-players into a vast worldwide Resistance community.Featuring a frenetic campaign mode.\r\n The first ever touch-screen First-Person Shooter on PlayStation Handheld - developed to showcase the functions of PlayStation Vita\r\n A brand-new hero character, FDNY firefighter Tom Riley\r\n A familiar arsenal of weapons from previous Resistance games, plus new weapons like a new Chimeran sniper rifle and a fireman\'s axe\r\n Featuring a frenetic campaign mode','Resistance: Burning Skies'),(18,'Developed by Guerilla Games Cambridge, Killzone: Mercenary game throws players into a deadly firefight as the ruthless Mercenary faction, taking on paid contracts not only from the dangerous ISA, but the vicious Helghast as well.\r\n Play through 9 massive single-player missions, each with additional challenges and special objectives.\r\n Built on the same Killzone engine used on PlayStation 3 system, Killzone: Mercenary has stunning visuals and the smooth gameplay shows off the PS Vita system like no other game.\r\n Intense combat for up to 8 players keeps the competition fierce.','Killzone Mercenary'),(19,'Harness the Spirit of vengeance to inflict brutal combos while mastering powerful new skills and weaponry.\r\n Exploit the individual fears, weakness and memories of your enemies as you dismantle Sauron\'s forces from within.\r\n Become the most feared force in Mordor in a new chronicle set before the events of the Lord of the Rings.','Middle Earth Shadow of Mordor'),(20,'Far Cry 4 allows for a second player to drop in and out at any point, re-imagining the cooperative experience in the true spirit of Far Cry for the next generation.Discover the most diverse Far Cry world ever created. With terrain spanning from lush forests to the snowcapped Himalayas, the entire world is alive...and deadly.Choose the right weapon for the job, no matter how insane or unpredictable that job might be. With a diverse arsenal, you\'ll be prepared for anything.','Far Cry 4'),(21,'Crafted by one of the co-creators of Call of Duty and other key developers behind the Call of Duty franchise, Titanfall is among the most highly anticipated games of 2014.The advanced combat techniques of Titanfall give you the freedom to fight your way as both elite assault Pilot and fast, heavily armored Titan.','Titanfall'),(22,'Battle as Commander Shepard on many worlds across the galaxy as you unite the ultimate force to take back the Earth before it\'s too late\r\n Enormous enemies and take on a smarter type of foe that will consistently challenge your best combat tactics and put you on the edge of your seat\r\n Customize your Commander Shepard, your squad and weapons to engage the enemy on your terms\r\n Allows the option to import decisions from both of the previous games and supports optional use of the Kinect Sensor for Xbox 360\r\n Experience a new emphasis on melee combat, movement and an improved cover system.','Mass Effect 3'),(23,'As a Native American assassin, eliminate your enemies with guns, bows, tomahawks, and more!\r\n From bustling city streets to the chaotic battlefields, play a critical role in the most legendary events of the American Revolution including the Battle of Bunker Hill and Great Fire of New York.\r\n Experience the truth behind the most gruesome war in history: the American Revolution.\r\n Introducing the Anvil Next game engine, the stunning new technology that will revolutionize gaming with powerful graphics, lifelike animations, immersive combat, and advanced physics.','Assassin\'s Creed III'),(24,'Outnumbered and outgunned, but not outmatched. Welcome to Call of Duty: Ghosts, an extraordinary step forward for one of the largest entertainment franchises of all-time. This new chapter in the Call of Duty franchise features a fresh dynamic where players are on the side of a crippled nation fighting not for freedom, or liberty, but simply to survive.\r\n Ten years after a devastating mass event, the nation\'s borders and the balance of global power have been redrawn forever. As what\'s left of the nation\'s Special Operations forces, a mysterious group known only as \"Ghosts\" leads the fight back against a newly emerged, technologically-superior global power.','Call of Duty Ghosts'),(25,'Action-Packed Gameplay: As a side story to the upcoming Universal Pictures\' film, this fast-paced FPS puts you at the forefront of an extreme alien attack. Facing hazards across land, sea, and air - this won\'t be a walk in the park\r\n \"Spectacle at Sea\" Tactical Battle Command: Take real-time control of naval units as you strategize a map-wide plan of attack by directing your fleet to launch air strikes, conduct radar sweeps, and engage in ship-to-ship sea conflict.\r\n \"War on the Shore\" Battling: As a member of the elite E.O.D., take the fight to the Hawaiian shores to put down the invading threat.','Battleship'),(26,'Stereoscopic 3D graphics throughout allow you to enjoy gameplay designed to take full advantage of the 3D screen, as you weave between cars, drift inches from the curb and navigate menus that come right out of the screen\r\n Get behind the wheel of over 40 vehicles (cars and bikes) from prestigious manufacturers like Ferrari, Lamborghini, Audi and Ducati\r\n Engage in a variety of high-speed challenges beyond your normal race: cash attack, vigilante, high-speed chase, drift, time trail, duel and leader of the pack\r\n Race in 17 exciting destinations including Rio De Janeiro, Tokyo and Cape Town with varied track surfaces, shortcuts and spectacular jumps.','Asphalt 3D'),(27,'Be the first to cross the finish line as you speed across the country from San Francisco to New York in an illicit, high-stakes race\r\n Race as Jack, a marked man who must make it to New York City ahead of the competition, the police and the men who want him dead.Car customization options\r\n Objective-based Challenge mode.','Need for Speed: The Run'),(28,'3 UNIQUE EPISODES: Each with a distinct hero, art style and setting\r\n MASTER DIFFERENT COMBAT STYLES: Each Assassin is equipped with powerful weapons and distinct gadgets, providing a wide range of abilities in your arsenal\r\n STEALTH IN A NEW DIMENSION: Experience the thrill of being a Master Assassin in 2.5D\r\n FAST AND FLUID ASSAULT COURSE: Scout, sneak and hide to avoid detection. Find your target, kill and escape\r\n Includes Assassin\'s Creed Chronicles: China, India and Russia.','Assassin\'s Creed Chronicles');
/*!40000 ALTER TABLE `games_description` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `games_gallery_images`
--

DROP TABLE IF EXISTS `games_gallery_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `games_gallery_images` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `image` varchar(60) NOT NULL,
  `game` varchar(60) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=113 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `games_gallery_images`
--

LOCK TABLES `games_gallery_images` WRITE;
/*!40000 ALTER TABLE `games_gallery_images` DISABLE KEYS */;
INSERT INTO `games_gallery_images` VALUES (1,'38788323260d31fc150c495cc1957727dda9b71e.jpg','Crysis 3'),(2,'3f43ca866a2695fcba92ced40c7a8f73cdecbef5.jpg','Crysis 3'),(3,'c78bdc0ce5352192d17df001b51564e83e05a276.jpg','Crysis 3'),(4,'e4d0516660497c3605cb422f48e6ede5203ca14c.jpg','Crysis 3'),(5,'cc760fba4766a0a4e938d143a97105866cfcf3cc.jpg','Grand Theft Auto V'),(6,'df05ffe300fa96ea79c01ec9de4858c69286f275.jpg','Grand Theft Auto V'),(7,'f01b0b943f9cf445a9113de50f25fae76fe06c4f.jpg','Grand Theft Auto V'),(8,'1e9fb231bc1743c386dfa1fdc8380d6639a30595.jpg','Grand Theft Auto V'),(9,'f5fc6318c01a65d464326549363280d47dedf2ca.jpg','Need for Speed'),(10,'97fb4972b0ebd7ea82a9f87fe6acdf2b08c9dcf3.jpg','Need for Speed'),(11,'fe31c855406a027ca4193935163db0618d30c4f3.jpg','Need for Speed'),(12,'be51e4bddab466f5799f3d212c11d1f8a84de5c6.jpg','Need for Speed'),(13,'4a853bd9d9bf33a7851f530ee0efb66e48ec7d90.jpg','Diablo 3 Reaper of Souls'),(14,'4fe88f37b4e3a42426e5c69b3ffcbb25ef5bc4b1.jpg','Diablo 3 Reaper of Souls'),(15,'90ffb63b3723ebe461820273ed4f571f8fcdf763.jpg','Diablo 3 Reaper of Souls'),(16,'cb2ab7126a58baa6721e07092570c173a28fdd56.jpg','Diablo 3 Reaper of Souls'),(17,'764f7f8a9de960df626cd2bbc7656c9ed8c20d66.jpg','Fallout 4'),(18,'61d0d5d3e8eaab66934bd3159f600c3b8c682f4f.jpg','Fallout 4'),(19,'1304578f609bd294ca4c06e9e74d5eabd3aa0d80.jpg','Fallout 4'),(20,'7a5faba99d895de0146fc5873efcb7dacb1b8d0a.jpg','Fallout 4'),(21,'assassin1.jpg','Assassin\'s Creed Syndicate'),(22,'assassin2.jpg','Assassin\'s Creed Syndicate'),(23,'assassin3.jpg','Assassin\'s Creed Syndicate'),(24,'assassin4.jpg','Assassin\'s Creed Syndicate'),(25,'cob1.jpg','Call of Duty Black Ops 3'),(26,'cob2.jpg','Call of Duty Black Ops 3'),(27,'cob3.jpg','Call of Duty Black Ops 3'),(28,'cob4.jpg','Call of Duty Black Ops 3'),(29,'bat4_small1.jpg','Battlefield 4'),(30,'bat4_small2.jpg','Battlefield 4'),(31,'bat4_small3.jpg','Battlefield 4'),(32,'bat4_small4.jpg','Battlefield 4'),(33,'starcraft2_legacy_1.jpg','StarCraft 2 Legacy of the Void'),(34,'starcraft2_legacy_2.jpg','StarCraft 2 Legacy of the Void'),(35,'starcraft2_legacy_3.jpg','StarCraft 2 Legacy of the Void'),(36,'starcraft2_legacy_4.jpg','StarCraft 2 Legacy of the Void'),(37,'b5084549bd8b9e713202c1f7f15b74d3286661fe.jpg','God of War 2'),(38,'1246c2914fafe2b9f58012a181d04735609caacf.jpg','God of War 2'),(39,'3a8c73d075c61ae4ae5bfe68611fee446120a1bb.jpg','God of War 2'),(40,'0dff14dd4da37cb9b3adcc848a42d964ef91c3a3.jpg','God of War 2'),(41,'c081fc17fc5853d0d1c7b7c21aa8facb0af21875.jpg','ATV Offroad Fury 4'),(42,'9a5992b4b495add551f9eb161073064294a0c93f.jpg','ATV Offroad Fury 4'),(43,'581069325aa67afe67b4f9ab812aeedae9722574.jpg','ATV Offroad Fury 4'),(44,'613e2c0330fbdbb77e631a272616e544d3eabc31.jpg','ATV Offroad Fury 4'),(45,'a38cf5ee0037250d39754321a33b7e92f3153179.jpg','Call of Duty 3'),(46,'1551ae32a2d705f0b6334d3fa5c6f4bf154ff4bb.jpg','Call of Duty 3'),(47,'438419935baa167c001eed5b61b4868681355971.jpg','Call of Duty 3'),(48,'d194456ba6920260e6e3e97f5e75536cf660fc31.jpg','Call of Duty 3'),(49,'71c38ad321f42439f13254b88d79148218ea100b.jpg','Star Wars: The Force Unleashed'),(50,'71c38ad321f42439f13254b88d79148218ea100b.jpg','Star Wars: The Force Unleashed'),(51,'71c38ad321f42439f13254b88d79148218ea100b.jpg','Star Wars: The Force Unleashed'),(52,'71c38ad321f42439f13254b88d79148218ea100b.jpg','Star Wars: The Force Unleashed'),(53,'3b51ca69284a74603681d178385fdcff5252c0f9.jpg','Transformers Revenge of the Fallen'),(54,'125a128b997558304c7c180536e88cce3a9b1dc0.jpg','Transformers Revenge of the Fallen'),(55,'0bd1041c7ba3d8ec187674137c4707a385eea38b.jpg','Transformers Revenge of the Fallen'),(56,'d3d8ea7ba77bb9c7651e81e973ec6ff920aefd4d.jpg','Transformers Revenge of the Fallen'),(57,'asa1.jpg','Assassin\'s Creed Chronicles'),(58,'asa2.jpg','Assassin\'s Creed Chronicles'),(59,'asa3.jpg','Assassin\'s Creed Chronicles'),(60,'asa4.jpg','Assassin\'s Creed Chronicles'),(61,'wrc1.jpg','WRC 5'),(62,'wrc2.jpg','WRC 5'),(63,'wrc3.jpg','WRC 5'),(64,'wrc4.jpg','WRC 5'),(65,'bat1.jpg','Batman: Arkham Origins - Blackgate'),(66,'bat2.jpg','Batman: Arkham Origins - Blackgate'),(67,'bat3.jpg','Batman: Arkham Origins - Blackgate'),(68,'bat4.jpg','Batman: Arkham Origins - Blackgate'),(69,'re1.jpg','Resistance: Burning Skies'),(70,'re2.jpg','Resistance: Burning Skies'),(71,'re3.jpg','Resistance: Burning Skies'),(72,'re4.jpg','Resistance: Burning Skies'),(73,'kill1.jpg','Killzone Mercenary'),(74,'kill2.jpg','Killzone Mercenary'),(75,'kill3.jpg','Killzone Mercenary'),(76,'kill4.jpg','Killzone Mercenary'),(77,'41b2f7d94143f23b82575cf09847c1dd18254e3c.jpg','Middle Earth Shadow of Mordor'),(78,'8bdb3efbf3cd9784cff5dbad2f0be828ec9783db.jpg','Middle Earth Shadow of Mordor'),(79,'378bb36e32aaf2d2568733e4b32942680fde08e8.jpg','Middle Earth Shadow of Mordor'),(80,'ed3e817e83b05fd89b80122da1e4de4b31e6c9b5.jpg','Middle Earth Shadow of Mordor'),(81,'46f36e8193bb8454d01229df85ed8dfc73f98858.jpg','Far Cry 4'),(82,'e8ce59c78573c25d86eda9db45daa38450b0eafb.jpg','Far Cry 4'),(83,'a5db80e372abffea75d50184842039711a013dec.jpg','Far Cry 4'),(84,'31e1b6133fa003d043d4f03d6daa8cabd58b9986.jpg','Far Cry 4'),(85,'d0b692e2151fea05755cc8a47de68e4bb8de21ac.jpg','Titanfall'),(86,'d3ac99f972f2236b94c813db4414169b2fb7ca36.jpg','Titanfall'),(87,'54ab61983dd3f732d326cc57de700c7d4b40a534.jpg','Titanfall'),(88,'9b27de3a36d0c7c283343ba42747c35ecc90300b.jpg','Titanfall'),(89,'mass1.jpg','Mass Effect 3'),(90,'mass2.jpg','Mass Effect 3'),(91,'mass3.jpg','Mass Effect 3'),(92,'mass4.jpg','Mass Effect 3'),(93,'as1.jpg','Assassin\'c Creed III'),(94,'as2.jpg','Assassin\'c Creed III'),(95,'as3.jpg','Assassin\'c Creed III'),(96,'as4.jpg','Assassin\'c Creed III'),(97,'call1.jpg','Call of Duty Ghosts'),(98,'call2.jpg','Call of Duty Ghosts'),(99,'call3.jpg','Call of Duty Ghosts'),(100,'call4.jpg','Call of Duty Ghosts'),(101,'290fa66847dcb6f7ff5bda1b62eff1e9afb56ac5.jpg','Battleship'),(102,'41366eef911494cc10794de40f2efd97289bfbce.jpg','Battleship'),(103,'8f25c9939b50bf9e9df513e37648260d67ff1d08.jpg','Battleship'),(104,'557e887f409406c2067dd145a885f6d0ec0515d7.jpg','Battleship'),(105,'63d230a8b50dc1aeee8f53681e4dac2e8ec1bc99.jpg','Asphalt 3D'),(106,'fa6089b76d4048609f87359faa1e6d5f7d7afa5e.jpg','Asphalt 3D'),(107,'19505bf8b3d73cfd2346d8725c566f5065eb230a.jpg','Asphalt 3D'),(108,'cdf9e0eca7ba7ed3ad4a8475abd439c0f62d7162.jpg','Asphalt 3D'),(109,'cd1281cb18de31ff3331fa9604e32b0a3142f0c6.jpg','Need for Speed: The Run'),(110,'4817d3d0bd8c61fe2dcd83f32684ee0c8265cd08.jpg','Need for Speed: The Run'),(111,'4ee75a68fa8ca5e0294b9bbaf9d85fbe5731210c.jpg','Need for Speed: The Run'),(112,'116261b8a3d05e962f6a608b78995079512ad505.jpg','Need for Speed: The Run');
/*!40000 ALTER TABLE `games_gallery_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `games_genre`
--

DROP TABLE IF EXISTS `games_genre`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `games_genre` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `genre` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `games_genre`
--

LOCK TABLES `games_genre` WRITE;
/*!40000 ALTER TABLE `games_genre` DISABLE KEYS */;
INSERT INTO `games_genre` VALUES (1,'Shooter/Action'),(2,'Real-time Strategy'),(3,'RPG'),(4,'Action/Adventure'),(5,'Racing');
/*!40000 ALTER TABLE `games_genre` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `games_names`
--

DROP TABLE IF EXISTS `games_names`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `games_names` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `game` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `games_names`
--

LOCK TABLES `games_names` WRITE;
/*!40000 ALTER TABLE `games_names` DISABLE KEYS */;
INSERT INTO `games_names` VALUES (1,'Crysis 3'),(2,'StarCraft 2  Legacy of the Void'),(3,'Battlefield 4'),(4,'Diablo 3 Reaper of Souls'),(5,'Assassin\'s Creed Syndicate'),(6,'Fallout 4'),(7,'Call of Duty Black Ops 3'),(8,'Need for Speed'),(9,'Grand Theft Auto V'),(10,'God of War 2'),(11,'ATV Offroad Fury 4'),(12,'Call of Duty 3'),(13,'Star Wars: The Force Unleashed'),(14,'Transformers Revenge of the Fallen'),(15,'WRC 5'),(16,'Batman: Arkham Origins - Blackgate'),(17,'Resistance: Burning Skies'),(18,'Killzone Mercenary'),(19,'Middle Earth Shadow of Mordor'),(20,'Far Cry 4'),(21,'Titanfall'),(22,'Mass Effect 3'),(23,'Assassin\'s Creed III'),(24,'Call of Duty Ghosts'),(25,'Battleship'),(26,'Asphalt 3D'),(27,'Need for Speed: The Run'),(28,'Assassin\'s Creed Chronicles');
/*!40000 ALTER TABLE `games_names` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `games_videos`
--

DROP TABLE IF EXISTS `games_videos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `games_videos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `video` varchar(255) NOT NULL,
  `game` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `games_videos`
--

LOCK TABLES `games_videos` WRITE;
/*!40000 ALTER TABLE `games_videos` DISABLE KEYS */;
INSERT INTO `games_videos` VALUES (1,'https://www.youtube.com/embed/fJDmP2crAlk','Crysis 3'),(2,'https://www.youtube.com/embed/M_XwzBMTJaM','StarCraft 2  Legacy of the Void'),(3,'https://www.youtube.com/embed/IEZhbV9s1Ag','Battlefield 4'),(4,'https://www.youtube.com/embed/zGp5dkJdi0w','Diablo 3 Reaper of Souls'),(5,'https://www.youtube.com/embed/FIeAPhJBR6w','Assassin\'s Creed Syndicate'),(6,'https://www.youtube.com/embed/Lnn2rJpjar4','Fallout 4'),(7,'https://www.youtube.com/embed/58Pspqx0XGs','Call of Duty Black Ops 3'),(8,'https://www.youtube.com/embed/hX_ke3GwLE0','Need for Speed'),(9,'https://www.youtube.com/embed/Vzue74y7A84','Grand Theft Auto V'),(10,'https://www.youtube.com/embed/CySMC05bk2k','God of War 2'),(11,'https://www.youtube.com/embed/PBXoXr_YP10','ATV Offroad Fury 4'),(12,'https://www.youtube.com/embed/KUJupLrk3YA','Call of Duty 3'),(13,'https://www.youtube.com/embed/YbFxuxOBdPs','Star Wars: The Force Unleashed'),(14,'https://www.youtube.com/embed/5K_sxQh8-qg','Transformers Revenge of the Fallen'),(15,'https://www.youtube.com/embed/8vpY5R37Q6k','WRC 5'),(16,'https://www.youtube.com/embed/o9wzMkU9Guw','Batman: Arkham Origins - Blackgate'),(17,'https://www.youtube.com/embed/8iq6SlA7ufQ','Resistance: Burning Skies'),(18,'https://www.youtube.com/embed/UCUA_Yw6ehU','Killzone Mercenary'),(19,'https://www.youtube.com/embed/D6-6-6Izfn4','Middle Earth Shadow of Mordor'),(20,'https://www.youtube.com/embed/keCb8-kDRqY','Far Cry 4'),(21,'https://www.youtube.com/embed/goe6IB1DLZU','Titanfall'),(22,'https://www.youtube.com/embed/AluTOOCVXVQ','Mass Effect 3'),(23,'https://www.youtube.com/embed/-pUhraVG7Ow','Assassin\'s Creed III'),(24,'https://www.youtube.com/embed/SumIZb6qMJw','Call of Duty Ghosts'),(25,'https://www.youtube.com/embed/Q8Go6t0qZkY','Battleship'),(26,'https://www.youtube.com/embed/NXpZxPRanRU','Asphalt 3D'),(27,'https://www.youtube.com/embed/v-4msZsoe18','Need for Speed: The Run'),(28,'https://www.youtube.com/embed/JapuE16BPrY','Assassin\'s Creed Chronicles');
/*!40000 ALTER TABLE `games_videos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `games_year`
--

DROP TABLE IF EXISTS `games_year`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `games_year` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `year` date NOT NULL,
  `game` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `games_year`
--

LOCK TABLES `games_year` WRITE;
/*!40000 ALTER TABLE `games_year` DISABLE KEYS */;
INSERT INTO `games_year` VALUES (1,'2012-02-22','Crysis 3'),(2,'2015-11-14','StarCraft 2  Legacy of the Void'),(3,'2015-10-12','Battlefield 4'),(4,'2012-06-07','Diablo 3 Reaper of Souls'),(5,'2015-11-18','Assassin\'s Creed Syndicate'),(6,'2015-11-18','Fallout 4'),(7,'2015-11-17','Call of Duty Black Ops 3'),(8,'2016-03-17','Need for Speed'),(9,'2015-05-13','Grand Theft Auto V'),(10,'2007-03-13','God of War 2'),(11,'2006-10-31','ATV Offroad Fury 4'),(12,'2006-11-07','Call of Duty 3'),(13,'2008-09-16','Star Wars: The Force Unleashed'),(14,'2009-01-09','Transformers Revenge of the Fallen'),(15,'2016-05-06','WRC 5'),(16,'2015-03-06','Batman: Arkham Origins - Blackgate'),(17,'2015-10-13','Resistance: Burning Skies'),(18,'2015-05-29','Killzone Mercenary'),(19,'2013-09-10','Middle Earth Shadow of Mordor'),(20,'2014-11-14','Far Cry 4'),(21,'2014-11-18','Titanfall'),(22,'2014-04-08','Mass Effect 3'),(23,'2012-03-06','Assassin\'s Creed III'),(24,'2012-10-30','Call of Duty Ghosts'),(25,'2013-11-05','Battleship'),(26,'2012-05-15','Asphalt 3D'),(27,'2011-03-22','Need for Speed: The Run'),(28,'2011-11-15','Assassin\'s Creed Chronicles');
/*!40000 ALTER TABLE `games_year` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_ID` varchar(255) NOT NULL,
  `customer_username` varchar(255) NOT NULL,
  `order_info` text NOT NULL,
  `order_amount` double(10,2) NOT NULL,
  `shipping` enum('0','1') NOT NULL DEFAULT '0',
  `customer_phone` varchar(255) NOT NULL,
  `customer_address` varchar(255) NOT NULL,
  `customer_email` varchar(255) NOT NULL,
  `payment_method` varchar(100) NOT NULL,
  `order_date` datetime NOT NULL,
  `status` enum('New','Sent') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (1,'0dc6e7b0f4fff5ee997ce050850c3279','Gregory235','Crysis 3 PC Quantity 1 Price 30.00\r Battlefield 4 PC Quantity 1 Price 35\r.00 Shipping - 15',80.00,'0','0895477998','Plovdiv , bul. Ruski 42 , etaj 2 ','greg@mail.com','On Delivery','2016-03-01 08:27:41','Sent'),(5,'7b52009b64fd0a2a49e6d8a939753077792b0554','meloni13','Crysis 3,Need for SpeedPC,PC1,130.99,30.75',61.74,'0','0895497989','Plovdiv,bul.Ruski 42','meloni12@mail.com','Credit Card','2015-09-01 11:36:43','Sent'),(6,'4d134bc072212ace2df385dae143139da74ec0ef','meloni13','God Of War 2 , Transformers Revenge of the FallenPS2 , PS2 1 , 1 , 12.45 , 14.65',47.10,'1','0895497989','Plovdiv,bul.Ruski 42','meloni12@mail.com','On Delivery','2016-03-08 10:41:46','Sent'),(7,'1b6453892473a467d07372d45eb05abc2031647a','meloni13','Crysis 3,God Of War 2 PC,PS2 1,1 30.99,12.45 ',63.44,'1','0895497989','Plovdiv,bul.Ruski 42','mimishtarbeva@gmail.com','On Delivery','2016-02-02 07:32:42','Sent'),(8,'bc33ea4e26e5e1af1408321416956113a4658763','meloni13','WRC 5,Killzone Mercenary PS Vita,PS Vita 1,1 45.65,25.50 ',71.15,'0','0895497989','Plovdiv,bul.Ruski 42','meloni12@mail.com','Credit Card','2016-05-17 06:37:41','Sent'),(13,'972a67c48192728a34979d9a35164c1295401b71','angel94','Call Of Duty 3,Fallout 4 PS2,Xbox One 1,1 10.00,50.99 ',60.99,'0','0895497989','Plovdiv,bul.Ruski 42','a.k.shtarbev93@gmail.com','Credit Card','2014-05-07 05:27:45','Sent'),(14,'0716d9708d321ffb6a00818614779e779925365c','angel94','Grand Theft Auto V,Fallout 4 PC,PC 1,1 40.75,30.99 ',71.74,'0','0895497989','Plovdiv,bul.Ruski 42','a.k.shtarbev93@gmail.com','Credit Card','2016-05-13 12:41:16','Sent'),(15,'761f22b2c1593d0bb87e0b606f990ba4974706de','meloni13','Titanfall,Battlefield 4 Xbox 360,PS4 2,2 17.56,40.99 ',117.10,'0','0895497989','Plovdiv,bul.Ruski 42','a.k.shtarbev93@gmail.com','On Delivery','2016-05-13 10:36:49','Sent'),(16,'761f22b2c1593d0bb87e0b606f990ba4974706de','Ivan89','Grand Theft Auto V PS3 2 55.65 ',111.30,'0','0895497998','Plovdiv,bul.Ruski 45','a.k.shtarbev93@gmail.com','On Delivery','2016-05-16 09:40:45','New');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `confirm_code` varchar(255) NOT NULL,
  `active` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'angel','angel','angel@gmail.com','Angel','1f1362ea41d1bc65be321c0a378a20159f9a26d0',1),(18,'wangel','1e5ad081cc2fd166fe517a168d59352a6a21be92','angel1@mail.com','Angellllo','1f1362ea41d1bc65be321c0a378a20159f9a26d0',1),(26,'angel234','fcd20600061e71843ce674994fb5aa8b497ab338','angel1@mail.com','Angel234','1f1362ea41d1bc65be321c0a378a20159f9a26d0',1),(32,'Gregory235','da39a3ee5e6b4b0d3255bfef95601890afd80709','gregory234@mail.com','Greg','1f1362ea41d1bc65be321c0a378a20159f9a26d0',1),(33,'angel94','e0e3c1cd7a1ff51863901606042f7dc0d5c6e219','a.k.shtarbev94@gmail.com','Angel94','1f1362ea41d1bc65be321c0a378a20159f9a26d0',1),(34,'angel45','a6c01a264ffdf04eac8a1b3b9ae0406a5fec85ba','a.k.shtarbev93@gmail.com','Angel67','1f1362ea41d1bc65be321c0a378a20159f9a26d0',1),(35,'meloni14','4d5efb048d4c4f46bbe34e4bf399847671a19637','a.k.shtarbev93@gmail.com','Meloni14','1f1362ea41d1bc65be321c0a378a20159f9a26d0',1),(36,'Ivan89','63e71779709503d0f02b6ede44110f5676f01b20','a.k.shtarbev93@gmail.com','Ivan','1f1362ea41d1bc65be321c0a378a20159f9a26d0',1),(37,'angel94','f576c01731fac61a9474953706105d94fc058036','a.k.shtarbev93@gmail.com','Angel','1f1362ea41d1bc65be321c0a378a20159f9a26d0',1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-06-18 13:25:50
