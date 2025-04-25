-- MariaDB dump 10.19  Distrib 10.5.19-MariaDB, for Linux (x86_64)
--
-- Host: mysql    Database: thehighway
-- ------------------------------------------------------
-- Server version	11.7.2-MariaDB-ubu2404

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Current Database: `thehighway`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `thehighway` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_uca1400_ai_ci */;

USE `thehighway`;

--
-- Table structure for table `addresses`
--

DROP TABLE IF EXISTS `addresses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `addresses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `address_line1` varchar(255) DEFAULT NULL,
  `address_line2` varchar(255) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `postcode` varchar(20) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id_idx` (`user_id`),
  CONSTRAINT `user_idx` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `addresses`
--

LOCK TABLES `addresses` WRITE;
/*!40000 ALTER TABLE `addresses` DISABLE KEYS */;
INSERT INTO `addresses` VALUES (1,7,'31','Connaught Street','Northampton','NN1 3BP','UK'),(3,3,'22','Brampton Street','Northampton','NN2 4AQ','UK'),(4,2,'','','','','');
/*!40000 ALTER TABLE `addresses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cart_items`
--

DROP TABLE IF EXISTS `cart_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cart_items` (
  `cart_item_id` int(11) NOT NULL AUTO_INCREMENT,
  `cart_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`cart_item_id`),
  KEY `cart_id_idx` (`cart_id`),
  KEY `product_id_idx` (`product_id`),
  CONSTRAINT `cart_id` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`cart_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`productid`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cart_items`
--

LOCK TABLES `cart_items` WRITE;
/*!40000 ALTER TABLE `cart_items` DISABLE KEYS */;
INSERT INTO `cart_items` VALUES (1,1,9,1),(2,1,13,1),(3,1,9,1),(4,1,14,1),(5,1,19,1),(6,1,13,1),(7,1,33,1),(8,1,33,1),(9,1,22,1),(10,1,21,1),(11,1,21,1),(12,1,23,1),(13,1,15,1),(14,1,26,1),(15,1,17,1),(16,1,25,1),(17,1,21,1),(18,13,31,1),(19,14,21,1),(20,15,26,1),(21,16,37,1),(22,16,12,1),(23,16,27,1),(24,16,35,1),(25,17,13,1),(26,18,43,1),(27,20,9,1),(28,23,9,1),(29,24,12,5),(30,25,14,1),(31,26,14,1),(32,27,15,1),(33,28,17,1),(34,29,44,1),(35,30,14,1),(36,30,15,1),(37,31,22,1),(38,31,9,1),(39,31,8,1),(40,32,14,1),(41,33,29,1),(42,34,18,1),(43,34,11,1),(44,35,21,1),(45,36,19,1),(46,37,17,1),(47,38,17,1),(48,39,15,1),(49,40,9,1),(50,41,14,1),(51,42,10,3),(52,43,14,1),(53,44,23,1),(54,45,22,1),(55,46,26,1),(56,47,14,1),(57,48,15,1),(58,49,14,1),(59,50,19,1),(60,51,18,1),(61,52,23,1),(62,53,15,1),(63,54,10,1),(64,55,15,1),(65,56,32,1),(66,57,10,1),(67,58,22,1),(68,59,18,1),(69,60,37,1),(70,61,22,1),(71,62,10,1),(72,64,11,1),(73,65,15,1),(74,66,15,1),(75,68,14,1),(76,69,11,1),(77,70,10,1),(78,71,10,1);
/*!40000 ALTER TABLE `cart_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `carts`
--

DROP TABLE IF EXISTS `carts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `carts` (
  `cart_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`cart_id`),
  KEY `user_idz` (`user_id`),
  CONSTRAINT `user_idz` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carts`
--

LOCK TABLES `carts` WRITE;
/*!40000 ALTER TABLE `carts` DISABLE KEYS */;
INSERT INTO `carts` VALUES (1,7,NULL),(7,7,NULL),(8,7,NULL),(9,7,95),(10,7,96),(11,7,97),(12,7,98),(13,7,99),(14,7,100),(15,7,101),(16,7,102),(17,7,103),(18,7,104),(19,7,105),(20,7,106),(21,7,107),(22,7,108),(23,7,109),(24,7,110),(25,7,111),(26,7,112),(27,7,113),(28,7,114),(29,7,115),(30,7,116),(31,7,117),(32,7,118),(33,7,119),(34,3,120),(35,3,121),(36,3,122),(37,3,123),(38,3,124),(39,3,125),(40,2,126),(41,7,127),(42,7,128),(43,7,129),(44,7,130),(45,7,131),(46,7,132),(47,7,133),(48,7,134),(49,7,135),(50,7,136),(51,7,137),(52,7,138),(53,7,139),(54,7,140),(55,7,141),(56,7,142),(57,7,143),(58,7,144),(59,7,145),(60,7,146),(61,7,147),(62,7,148),(63,7,149),(64,7,150),(65,7,151),(66,7,152),(67,7,153),(68,7,154),(69,7,155),(70,7,156),(71,7,157);
/*!40000 ALTER TABLE `carts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (4,'Chicken'),(5,'Pasta'),(6,'Pizza'),(7,'Bowls'),(10,'Kids Menu'),(13,'Drinks'),(14,'Desserts'),(15,'Burgers');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `communication`
--

DROP TABLE IF EXISTS `communication`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `communication` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `contact` varchar(45) DEFAULT NULL,
  `subject` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT 'pending',
  `date` timestamp NULL DEFAULT current_timestamp(),
  `response` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `communication`
--

LOCK TABLES `communication` WRITE;
/*!40000 ALTER TABLE `communication` DISABLE KEYS */;
INSERT INTO `communication` VALUES (1,'Pete','Hi, I need help cancelling a duplicate order','kedogosospeter36@gmail.com','Duplicate Order Cancellation','pending','2025-04-17 23:00:04',NULL),(2,'Jill','I need a FULL REFUND ASAP for the food i ordered which got delivered on time and I ate it.','j@mail.com','Refund, NOW!!!','completed','2025-04-18 00:43:56','We cannot do that sir!!!'),(3,'Jill','I need a FULL REFUND ASAP for the food i ordered which got delivered on time and I ate it.','j@mail.com','Refund, NOW!!!','pending','2025-04-18 01:31:55',NULL),(4,'pete','I need help making an order please!!!','p@gmail.com','Need Help!!!','completed','2025-04-22 16:54:39','Sorry mate, no help here!');
/*!40000 ALTER TABLE `communication` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `deliveries`
--

DROP TABLE IF EXISTS `deliveries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `deliveries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `driver_id` int(11) NOT NULL,
  `time` timestamp NULL DEFAULT current_timestamp(),
  `status` varchar(45) DEFAULT 'Success',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `deliveries`
--

LOCK TABLES `deliveries` WRITE;
/*!40000 ALTER TABLE `deliveries` DISABLE KEYS */;
/*!40000 ALTER TABLE `deliveries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employees`
--

DROP TABLE IF EXISTS `employees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `employees` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employees`
--

LOCK TABLES `employees` WRITE;
/*!40000 ALTER TABLE `employees` DISABLE KEYS */;
INSERT INTO `employees` VALUES (1,'admin','$2y$12$EWdLNytud.iqsoNqULVYXuezwZlLhv5X3kP0BqiVA4Sxrg.mG6GZe'),(5,'Abdul','$2y$12$Q0hPM3ZqBeUzDx/uQP.sMuKNLSpB5JwBtuhYEbZefYL6zouLbGwjG');
/*!40000 ALTER TABLE `employees` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ingredients`
--

DROP TABLE IF EXISTS `ingredients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ingredients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) DEFAULT NULL,
  `type` enum('base','protein','vegetable','sauce') DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ingredients`
--

LOCK TABLES `ingredients` WRITE;
/*!40000 ALTER TABLE `ingredients` DISABLE KEYS */;
INSERT INTO `ingredients` VALUES (1,'Steamed Rice','base'),(2,'Beef Strips','protein'),(3,'Pasta','base'),(4,'Fries','base'),(5,'Pizza Dough','base'),(6,'Carrots','vegetable'),(7,'Grilled Chicken','protein'),(8,'Fish Fillet','protein'),(9,'Broccoli','vegetable'),(10,'Carrots','vegetable'),(11,'Teriyaki','sauce'),(12,'Curry','sauce'),(13,'Garlic Butter','sauce'),(14,'Bell peppers','vegetable'),(15,'Tomatoes','vegetable'),(16,'Onions','vegetable'),(17,'Curry','sauce');
/*!40000 ALTER TABLE `ingredients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `order_status` varchar(50) NOT NULL DEFAULT 'pending',
  `total_amount` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `driver_id` varchar(45) DEFAULT '1',
  PRIMARY KEY (`order_id`),
  KEY `user_id_idx` (`user_id`),
  CONSTRAINT `user_idy` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=158 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (100,7,'completed',24.89,'2025-04-21 23:18:59','1'),(101,7,'completed',2.23,'2025-04-21 23:19:52','1'),(102,7,'completed',15.85,'2025-04-21 23:57:03','1'),(103,7,'completed',11.67,'2025-04-22 00:16:56','1'),(104,7,'completed',0.56,'2025-04-22 00:53:13','1'),(106,7,'completed',5.59,'2025-04-22 01:01:23','1'),(109,7,'completed',5.59,'2025-04-22 01:04:33','1'),(110,7,'completed',44.74,'2025-04-22 01:28:52','1'),(111,7,'completed',14.55,'2025-04-22 01:41:46','1'),(112,7,'completed',14.55,'2025-04-22 01:44:38','1'),(113,7,'completed',14.55,'2025-04-22 01:45:22','1'),(114,7,'completed',16.80,'2025-04-22 01:46:41','1'),(115,7,'completed',2.23,'2025-04-22 02:16:32','1'),(116,7,'pending',29.10,'2025-04-22 16:48:52','1'),(117,7,'completed',38.30,'2025-04-22 16:50:52','1'),(118,7,'pending',14.55,'2025-04-22 18:45:16','1'),(119,7,'pending',3.85,'2025-04-22 18:49:48','1'),(120,3,'ready for pick up',27.52,'2025-04-22 19:22:24','1'),(121,3,'completed',24.89,'2025-04-23 03:04:07','1'),(122,3,'completed',17.29,'2025-04-23 03:06:31','1'),(123,3,'pending',16.80,'2025-04-23 03:13:34','1'),(124,3,'pending',16.80,'2025-04-23 03:15:53','1'),(125,3,'pending',14.55,'2025-04-23 03:18:12','1'),(126,2,'completed',5.59,'2025-04-24 22:54:14','1'),(127,7,'pending',14.55,'2025-04-25 01:49:59','1'),(128,7,'pending',3.35,'2025-04-25 01:53:49','1'),(129,7,'pending',14.55,'2025-04-25 01:59:01','1'),(130,7,'pending',2.49,'2025-04-25 02:00:36','1'),(131,7,'pending',26.01,'2025-04-25 02:05:04','1'),(132,7,'pending',2.23,'2025-04-25 02:07:08','1'),(133,7,'pending',14.55,'2025-04-25 02:08:43','1'),(134,7,'pending',14.55,'2025-04-25 02:10:25','1'),(135,7,'pending',14.55,'2025-04-25 02:20:29','1'),(136,7,'pending',17.29,'2025-04-25 02:25:14','1'),(137,7,'pending',22.42,'2025-04-25 02:36:26','1'),(138,7,'pending',2.49,'2025-04-25 02:41:15','1'),(139,7,'pending',14.55,'2025-04-25 02:46:19','1'),(140,7,'pending',3.35,'2025-04-25 02:47:42','1'),(141,7,'pending',14.55,'2025-04-25 02:49:39','1'),(142,7,'pending',1.00,'2025-04-25 02:49:57','1'),(143,7,'pending',3.35,'2025-04-25 02:54:20','1'),(144,7,'pending',26.01,'2025-04-25 03:01:51','1'),(145,7,'pending',22.42,'2025-04-25 03:13:11','1'),(146,7,'pending',4.97,'2025-04-25 03:14:06','1'),(147,7,'pending',26.01,'2025-04-25 03:14:32','1'),(148,7,'pending',3.35,'2025-04-25 03:15:40','1'),(149,7,'pending',0.00,'2025-04-25 03:18:10','1'),(150,7,'pending',5.10,'2025-04-25 03:18:32','1'),(151,7,'pending',14.55,'2025-04-25 03:20:50','1'),(152,7,'pending',14.55,'2025-04-25 03:24:21','1'),(153,7,'pending',0.00,'2025-04-25 03:25:13','1'),(154,7,'pending',14.55,'2025-04-25 03:28:12','1'),(155,7,'pending',5.10,'2025-04-25 03:29:21','1'),(156,7,'pending',3.35,'2025-04-25 03:30:19','1'),(157,7,'pending',3.35,'2025-04-25 03:31:07','1');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL,
  `payment_status` enum('Pending','Completed','Failed') NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  PRIMARY KEY (`payment_id`),
  UNIQUE KEY `order_id_UNIQUE` (`order_id`),
  CONSTRAINT `order_id` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payments`
--

LOCK TABLES `payments` WRITE;
/*!40000 ALTER TABLE `payments` DISABLE KEYS */;
INSERT INTO `payments` VALUES (1,122,'Completed',17.29),(2,123,'Completed',16.80),(3,124,'Completed',16.80),(4,125,'Completed',14.55),(5,126,'Completed',5.59),(6,127,'Completed',14.55),(7,128,'Completed',3.35),(8,129,'Completed',14.55),(9,130,'Completed',2.49),(10,131,'Completed',26.01),(11,132,'Completed',2.23),(12,133,'Completed',14.55),(13,134,'Completed',14.55),(14,135,'Completed',14.55),(15,136,'Completed',17.29),(16,137,'Completed',22.42),(17,138,'Completed',2.49),(18,139,'Completed',14.55),(19,140,'Completed',3.35),(20,141,'Completed',14.55),(21,142,'Completed',1.00),(22,143,'Completed',3.35),(23,144,'Completed',26.01),(24,145,'Completed',22.42),(25,146,'Completed',4.97),(26,147,'Completed',26.01),(27,148,'Completed',3.35),(28,149,'Completed',3.35),(29,150,'Completed',5.10),(30,151,'Completed',14.55),(31,152,'Completed',14.55),(32,153,'Completed',14.55),(33,154,'Completed',14.55),(34,155,'Completed',5.10),(35,156,'Completed',3.35),(36,157,'Completed',3.35);
/*!40000 ALTER TABLE `payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `productid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `rating` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`productid`),
  KEY `category_id_idx` (`category_id`),
  CONSTRAINT `category_id` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`) ON DELETE SET NULL ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (8,'Chicken Tikka','Tender, marinated chicken pieces are grilled to perfection and simmered in a rich, creamy tomato sauce infused with aromatic spices, garlic, and a hint of smoky paprika. Served with fragrant basmati rice and warm buttered naan, this dish offers a perfect balance of bold flavors and creamy indulgence.',5.99,4,'../images/chichen.jpg',57,'5'),(9,'Classic Italian Pasta','A timeless classic, our Italian pasta is made with the finest durum wheat and crafted to perfection. Served with your choice of rich tomato sauce, creamy Alfredo, or a flavorful pesto, each bite is a harmonious blend of tradition and taste. Topped with fresh herbs, grated Parmesan, and a drizzle of olive oil, this dish delivers an authentic taste of Italy in every mouthful.',4.99,5,'../images/pasta.jpg',17,'3'),(10,'Fresh Greek Salad','A refreshing and vibrant blend of crisp cucumbers, juicy tomatoes, Kalamata olives, and red onions, topped with creamy feta cheese and drizzled with aromatic extra virgin olive oil. Finished with a sprinkle of dried oregano and a splash of lemon, this light and flavorful salad offers a true taste of Greece, perfect as a side or a light meal.',2.99,7,'../images/menuitem.jpg',1,'4'),(11,'Garlic Herb Chicken','Succulent chicken breasts marinated in a fragrant blend of garlic, olive oil, and fresh herbs, then seared to perfection. Served with a rich, savory garlic sauce that complements the tender chicken, this dish is both aromatic and flavorful. Paired with your choice of sides, it’s a simple yet satisfying meal for garlic lovers.',4.55,4,'../images/garlic chicken.png',17,'5'),(12,'Chicken Burrito Bowl','A hearty and flavorful dish featuring tender grilled chicken served over a bed of fluffy rice, fresh black beans, and crisp lettuce. Topped with vibrant salsa, creamy guacamole, and a sprinkle of shredded cheese, this bowl is a perfect combination of bold flavors and satisfying textures. Drizzled with a zesty lime dressing, it’s a delicious and customizable meal that brings the taste of Mexican comfort food to your table.',7.99,7,'../images/ChickenBurritoBowl.jpg',23,'5'),(13,'Vegetable Pizza Slice','A delicious and healthy option, our vegetable pizza is topped with a colorful array of fresh, seasonal vegetables including bell peppers, mushrooms, red onions, olives, and spinach. Layered with rich tomato sauce, melted mozzarella cheese, and a sprinkle of aromatic herbs, this pizza offers a perfect balance of flavors and textures in every bite. A satisfying choice for vegetarians and pizza lovers alike.',10.42,6,'../images/bestveggiepizza.jpg',22,'5'),(14,'Chicken Bacon Ranch Pizza','A mouthwatering combination of tender grilled chicken, crispy bacon, and melted mozzarella cheese, all drizzled with a creamy ranch dressing. This pizza is topped with fresh tomatoes and a hint of herbs, creating a perfect balance of savory, smoky, and creamy flavors. Whether you\'re craving a hearty meal or a comfort food fix, this pizza is sure to satisfy.',12.99,6,'../images/chickenbaconranchpizza.jpg',4,'5'),(15,'Classic Cheese Pizza','A timeless favorite, our Classic Cheese Pizza features a perfectly baked, golden crust topped with rich tomato sauce and a generous layer of melted mozzarella cheese. Simple yet satisfying, this pizza is a celebration of bold, cheesy goodness with every bite. Ideal for any occasion, it’s the perfect choice for cheese lovers.',12.99,6,'../images/classiccheesepizza.jpg',0,'4'),(16,'Coconut Chicken Rice Bowl','A flavorful and creamy dish featuring tender chicken marinated in a coconut milk blend, then grilled to perfection. Served over a bed of fluffy jasmine rice, this bowl is complemented by a light coconut sauce and a hint of lime for added freshness. Topped with fresh cilantro and a sprinkle of toasted sesame seeds, this dish offers a perfect balance of creamy, savory, and aromatic flavors.',6.75,7,'../images/CoconutChickenRiceBowl.jpg',19,'3'),(17,'Garlic Skillet Chicken','Tender chicken breasts cooked to perfection in a rich and savory garlic butter sauce. Infused with aromatic garlic, fresh herbs, and a hint of lemon, this dish is a delicious balance of creamy, buttery flavors with a touch of zest. Served with your choice of sides, it’s a comforting and flavorful meal that will satisfy your cravings with every bite.perfection in a sizzling skillet, infused with rich garlic butter and fresh herbs. Each bite is bursting with savory, aromatic flavors, complemented by a touch of lemon for added brightness. Served with your choice of sides, this dish is simple yet full of bold, comforting taste. Perfect for garlic lovers and anyone seeking a deliciously satisfying meal.',15.00,4,'../images/creamygarlicskilletchickenwithspinach.jpg',1,'4'),(18,'Garlic Butter Chicken','Garlic Butter chicken',20.02,4,'../images/GarlicButterChicken.jpg',3,'2'),(19,'Greek Vegetable Pizza','A Mediterranean-inspired delight, our Greek pizza features a crispy crust topped with tangy tomato sauce, creamy feta cheese, Kalamata olives, and a medley of fresh vegetables including cucumbers, red onions, and ripe tomatoes. Finished with a sprinkle of oregano and a drizzle of extra virgin olive oil, this pizza offers a perfect balance of bold, savory, and refreshing flavors. A must-try for those who enjoy vibrant and unique tastes.',15.44,NULL,'../images/greekpizza.jpg',7,'4'),(20,'Korean Fried Chicken','Crispy, golden fried chicken coated in a sweet and spicy Korean glaze. Each piece is perfectly crunchy on the outside, while tender and juicy on the inside. The glaze, made with a blend of soy sauce, garlic, ginger, and a touch of heat, adds a bold and irresistible flavor. Served with pickled vegetables or your choice of sides, this dish brings the bold and vibrant flavors of Korea to your plate.',30.00,4,'../images/koreanfriedchicken.jpg',14,'5'),(21,'Margherita Cheese Pizza','A classic Italian favorite, our Margherita pizza features a perfectly thin, crispy crust topped with rich tomato sauce, fresh mozzarella cheese, and a handful of aromatic basil leaves. Drizzled with a touch of extra virgin olive oil, this simple yet delicious pizza highlights the freshest ingredients and offers a perfect balance of flavors. A true representation of Italian tradition in every bite.',22.22,6,'../images/margherita.jpg',32,'4'),(22,'Mediterranean Veggy Pasta','A vibrant and flavorful pasta dish featuring al dente noodles tossed with a colorful mix of Mediterranean vegetables such as bell peppers, zucchini, cherry tomatoes, and olives. Tossed in a light, garlicky olive oil dressing and topped with crumbled feta cheese, this dish is bursting with fresh, earthy flavors. A sprinkle of oregano and a squeeze of lemon bring it all together, making this a satisfying and healthy choice for vegetable lovers.',23.22,5,'../images/mediterraneanveggypasta.jpg',2,'3'),(23,'Broccoli Pasta Dish','A simple yet delicious dish featuring al dente pasta tossed with tender broccoli florets, garlic, and a light olive oil or butter sauce. Finished with a sprinkle of Parmesan cheese and a touch of lemon zest, this dish offers a perfect balance of savory flavors and fresh, vibrant vegetables. It’s a comforting, wholesome meal that’s both satisfying and full of flavor.',2.22,5,'../images/PastawithBroccoli.jpg',8,'4'),(24,'Vegan Stir-fry Pasta','A vibrant and healthy stir fry featuring al dente pasta tossed with a medley of crisp, colorful vegetables like bell peppers, broccoli, and snap peas. Stir-fried in a savory soy-based sauce with garlic, ginger, and a hint of sesame oil, this dish is packed with bold flavors and wholesome goodness. Topped with sesame seeds and fresh herbs, it’s a delicious, plant-based meal that’s both satisfying and full of flavor.',1.99,5,'../images/quickveganpastavegetablestirfrywithgingerandgarlic.jpg',10,'2'),(25,'Sticky Chicken and Fries','Juicy, tender chicken pieces glazed in a sweet and savory sticky sauce, perfectly paired with crispy golden fries. The rich, flavorful glaze combines hints of honey, soy sauce, and spices, creating a deliciously irresistible coating. Served with a side of crispy fries, this dish offers a comforting and satisfying combination of savory, sweet, and crunchy. Perfect for a casual meal that’s both hearty and full of flavor.',4.99,4,'../images/Stickychickenandfries.jpg',13,'3'),(26,'Small Fries','Small Fries',1.99,10,'../images/2.jpeg',6,'1'),(27,'Chocolate Chip Cookies','Chocolate Chip Cookies',0.50,10,'../images/3.jpg',18,'5'),(28,'Chocolate Cookies','Chocolate Cookies',0.20,10,'../images/4.jpg',5,'5'),(29,'Sphagetti Meatballs','Sphagetti Meatballs',3.44,5,'../images/6.jpg',7,'5'),(30,'Vanilla Milkshake','Vanilla Milkshake',1.22,13,'../images/7.jpg',10,'2'),(31,'Fanta','carbonated soft drink',0.55,13,'../images/8.jpg',49,'3'),(32,'7 Up','carbonated soft drink',0.89,13,'../images/9.jpg',31,'4'),(33,'Lipton Peach Flavour','Lipton Peach Flavour',1.34,4,'../images/12.jpeg',10,'5'),(34,'Chocolate Milkshake','Chocolate Milkshake',2.22,13,'../images/13.jpg',10,'5'),(35,'Tropicana orange Juice','Tropicana orange Juice',1.22,13,'../images/14.jpg',10,'5'),(36,'Red Velvet Slice','Red Velvet Slice',3.56,14,'../images/16.jpg',8,'3'),(37,'Ice Cream Sundae','Ice Cream Sundae',4.44,14,'../images/17-ice-cream-sundaes-in-a-pink-bowl-with-sprinkles.jpg',8,'2'),(38,'Beef Burger','Beef Burger',3.45,15,'../images/21.jpg',11,'4'),(39,'Buffalo Chicken Burger','Buffalo Chicken Burger',3.99,15,'../images/22-Buffalo-Chicken-Burger-square-FS-2.jpg',32,'5'),(40,'Veggie Burger','Veggie Burger',1.55,15,'../images/23-veggie-burgers-6.jpg',30,'3'),(41,'Chocolate Cake','Chocolate Cake',3.30,14,'../images/banner-img.jpeg',20,'5'),(42,'Bacon Cheeseburger','Caramelized Onion Bacon Cheeseburger',3.19,15,'../images/25Caramelized-Onion-Bacon-Cheeseburger-Recipe-768x1024.jpg',5,'5'),(43,'Churros','churros',0.50,14,'../images/19-churros.jpg',0,'4'),(44,'Tiramisu Dessert','Tiramisu Dessert',1.99,14,'../images/20-tiramisu-dessert-easy-vegan.jpg',27,'4');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shippings`
--

DROP TABLE IF EXISTS `shippings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shippings` (
  `shipping_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `tracking_number` varchar(255) DEFAULT NULL,
  `shipped_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`shipping_id`),
  UNIQUE KEY `order_id_UNIQUE` (`order_id`),
  UNIQUE KEY `tracking_number_UNIQUE` (`tracking_number`),
  CONSTRAINT `order_idy` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shippings`
--

LOCK TABLES `shippings` WRITE;
/*!40000 ALTER TABLE `shippings` DISABLE KEYS */;
INSERT INTO `shippings` VALUES (2,106,'31 Connaught Street, Northampton, NN1 3BP UK','106',NULL),(6,121,'22 Brampton Street, Northampton, NN2 4AQ UK','121','2025-04-23 03:05:34'),(7,122,'22 Brampton Street, Northampton, NN2 4AQ UK','122','2025-04-23 03:06:53'),(9,109,'31 Connaught Street, Northampton, NN1 3BP UK','109','2025-04-23 03:19:11'),(10,110,'31 Connaught Street, Northampton, NN1 3BP UK','110','2025-04-23 03:19:16'),(11,126,' , ,  ','126','2025-04-25 01:04:17');
/*!40000 ALTER TABLE `shippings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transactions` (
  `transaction_id` int(11) NOT NULL AUTO_INCREMENT,
  `payment_id` int(11) DEFAULT NULL,
  `transaction_date` timestamp NULL DEFAULT current_timestamp(),
  `status` enum('Success','Failed','Pending') NOT NULL,
  PRIMARY KEY (`transaction_id`),
  UNIQUE KEY `payment_id_UNIQUE` (`payment_id`),
  CONSTRAINT `payment_id` FOREIGN KEY (`payment_id`) REFERENCES `payments` (`payment_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transactions`
--

LOCK TABLES `transactions` WRITE;
/*!40000 ALTER TABLE `transactions` DISABLE KEYS */;
INSERT INTO `transactions` VALUES (1,4,'2025-04-23 03:18:12','Success'),(2,5,'2025-04-24 22:54:14','Success'),(3,6,'2025-04-25 01:49:59','Success'),(4,7,'2025-04-25 01:53:49','Success'),(5,8,'2025-04-25 01:59:01','Success'),(6,9,'2025-04-25 02:00:36','Success'),(7,10,'2025-04-25 02:05:04','Success'),(8,11,'2025-04-25 02:07:08','Success'),(9,12,'2025-04-25 02:08:43','Success'),(10,13,'2025-04-25 02:10:25','Success'),(11,14,'2025-04-25 02:20:29','Success'),(12,15,'2025-04-25 02:25:14','Success'),(13,16,'2025-04-25 02:36:26','Success'),(14,17,'2025-04-25 02:41:15','Success'),(15,18,'2025-04-25 02:46:19','Success'),(16,19,'2025-04-25 02:47:42','Success'),(17,20,'2025-04-25 02:49:39','Success'),(18,21,'2025-04-25 02:49:57','Success'),(19,22,'2025-04-25 02:54:20','Success'),(20,23,'2025-04-25 03:01:51','Success'),(21,24,'2025-04-25 03:13:11','Success'),(22,25,'2025-04-25 03:14:06','Success'),(23,26,'2025-04-25 03:14:32','Success'),(24,27,'2025-04-25 03:15:40','Success'),(25,28,'2025-04-25 03:18:10','Success'),(26,29,'2025-04-25 03:18:32','Success'),(27,30,'2025-04-25 03:20:50','Success'),(28,31,'2025-04-25 03:24:21','Success'),(29,32,'2025-04-25 03:25:13','Success'),(30,33,'2025-04-25 03:28:12','Success'),(31,34,'2025-04-25 03:29:21','Success'),(32,35,'2025-04-25 03:30:19','Success'),(33,36,'2025-04-25 03:31:07','Success');
/*!40000 ALTER TABLE `transactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `useraccounts`
--

DROP TABLE IF EXISTS `useraccounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `useraccounts` (
  `account_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`account_id`),
  UNIQUE KEY `username_UNIQUE` (`username`),
  UNIQUE KEY `user_id_UNIQUE` (`user_id`),
  CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `useraccounts`
--

LOCK TABLES `useraccounts` WRITE;
/*!40000 ALTER TABLE `useraccounts` DISABLE KEYS */;
INSERT INTO `useraccounts` VALUES (2,9,'','$2y$12$Q0VR2wLCwk3KZrFbprcEWOqvM29WqBj8IpzvfGQhiRb763/UoCXdS');
/*!40000 ALTER TABLE `useraccounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `address` int(11) DEFAULT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username_UNIQUE` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'crazyuser1','iamcrazyuser1@gmail.com','$2y$12$c5K3MEE/.8xwBDZR7yvzdOu/0yw7uCxFp3e8rFDvmaKAC2nffSxZC',NULL,NULL,NULL),(2,'user','user@gmail.com','$2y$12$x4a7r53rKbn9.3t0WI7/c.4uhOAIvkTBDaAwmw0I1dKixiotLZV4W',4,NULL,NULL),(3,'user1','user1@gmail.com','$2y$12$gVqJGvhmTYV4cUK1JqXE2upf.80ugkR/yyF7mSKUVEtHK944zQbei',3,'user','one'),(4,'user2','user2@gmail.com','$2y$12$i8FVDy3G4oSERdahqYrodeCe9vFVonWaWcw5tBi27jduttWO5xIeC',NULL,NULL,NULL),(5,'ess','ess@gmail.com','$2y$12$eSRDctk.Mr91xJT8b8z5z.46hA3FbBX/KaXCDwT8OJrQPQhsTC3OG',NULL,NULL,NULL),(6,'peter','k@gmail.com','$2y$12$9/bDdZHzoAITRuBss.LmWuCXQXEsI8SEFsTcBPrYqAK24pfyjaR6i',NULL,NULL,NULL),(7,'pete','kedogosospeter36@gmail.com','$2y$12$CZFSg9EvmGejYkF9tc.UFuFIiOHTW5gpqRVA32jLZ3mMezodKMvSS',1,'sospeter','kedogo'),(9,'','','$2y$12$Q0VR2wLCwk3KZrFbprcEWOqvM29WqBj8IpzvfGQhiRb763/UoCXdS',NULL,'','');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'thehighway'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-04-25  3:44:23
