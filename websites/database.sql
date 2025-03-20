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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cart_items`
--

LOCK TABLES `cart_items` WRITE;
/*!40000 ALTER TABLE `cart_items` DISABLE KEYS */;
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
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`cart_id`),
  UNIQUE KEY `user_id_UNIQUE` (`user_id`),
  CONSTRAINT `user_idz` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carts`
--

LOCK TABLES `carts` WRITE;
/*!40000 ALTER TABLE `carts` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (4,'Chicken'),(5,'Pasta'),(6,'Pizza'),(7,'Bowls');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employees`
--

LOCK TABLES `employees` WRITE;
/*!40000 ALTER TABLE `employees` DISABLE KEYS */;
INSERT INTO `employees` VALUES (1,'admin','$2y$12$EWdLNytud.iqsoNqULVYXuezwZlLhv5X3kP0BqiVA4Sxrg.mG6GZe'),(4,'employee1','$2y$12$D.OcPzgtIeq325VCmItFZOQM0oRdc/M5Q20xg0zURl6cNAOBm7jbi');
/*!40000 ALTER TABLE `employees` ENABLE KEYS */;
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
  `order_status` enum('Pending','Completed','Failed','Cancelled') NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`order_id`),
  KEY `user_id_idx` (`user_id`),
  CONSTRAINT `user_idy` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payments`
--

LOCK TABLES `payments` WRITE;
/*!40000 ALTER TABLE `payments` DISABLE KEYS */;
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
  PRIMARY KEY (`productid`),
  KEY `category_id_idx` (`category_id`),
  CONSTRAINT `category_id` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`) ON DELETE SET NULL ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (8,'Chicken Tikka Masala','Tender, marinated chicken pieces are grilled to perfection and simmered in a rich, creamy tomato sauce infused with aromatic spices, garlic, and a hint of smoky paprika. Served with fragrant basmati rice and warm buttered naan, this dish offers a perfect balance of bold flavors and creamy indulgence.',5.99,4,'../images/chichen.jpg',70),(9,'Classic Italian Pasta','A timeless classic, our Italian pasta is made with the finest durum wheat and crafted to perfection. Served with your choice of rich tomato sauce, creamy Alfredo, or a flavorful pesto, each bite is a harmonious blend of tradition and taste. Topped with fresh herbs, grated Parmesan, and a drizzle of olive oil, this dish delivers an authentic taste of Italy in every mouthful.',4.99,5,'../images/pasta.jpg',6),(10,'Fresh Greek Salad','A refreshing and vibrant blend of crisp cucumbers, juicy tomatoes, Kalamata olives, and red onions, topped with creamy feta cheese and drizzled with aromatic extra virgin olive oil. Finished with a sprinkle of dried oregano and a splash of lemon, this light and flavorful salad offers a true taste of Greece, perfect as a side or a light meal.',2.99,7,'../images/menuitem.jpg',5),(11,'Garlic Herb Chicken','Succulent chicken breasts marinated in a fragrant blend of garlic, olive oil, and fresh herbs, then seared to perfection. Served with a rich, savory garlic sauce that complements the tender chicken, this dish is both aromatic and flavorful. Paired with your choice of sides, it’s a simple yet satisfying meal for garlic lovers.',4.55,4,'../images/garlic chicken.png',2),(12,'Chicken Burrito Bowl','A hearty and flavorful dish featuring tender grilled chicken served over a bed of fluffy rice, fresh black beans, and crisp lettuce. Topped with vibrant salsa, creamy guacamole, and a sprinkle of shredded cheese, this bowl is a perfect combination of bold flavors and satisfying textures. Drizzled with a zesty lime dressing, it’s a delicious and customizable meal that brings the taste of Mexican comfort food to your table.',7.99,7,'../images/ChickenBurritoBowl.jpg',30),(13,'Vegetable Pizza Slice','A delicious and healthy option, our vegetable pizza is topped with a colorful array of fresh, seasonal vegetables including bell peppers, mushrooms, red onions, olives, and spinach. Layered with rich tomato sauce, melted mozzarella cheese, and a sprinkle of aromatic herbs, this pizza offers a perfect balance of flavors and textures in every bite. A satisfying choice for vegetarians and pizza lovers alike.',10.42,6,'../images/bestveggiepizza.jpg',42),(14,'Chicken Bacon Ranch Pizza','A mouthwatering combination of tender grilled chicken, crispy bacon, and melted mozzarella cheese, all drizzled with a creamy ranch dressing. This pizza is topped with fresh tomatoes and a hint of herbs, creating a perfect balance of savory, smoky, and creamy flavors. Whether you\'re craving a hearty meal or a comfort food fix, this pizza is sure to satisfy.',12.99,6,'../images/chickenbaconranchpizza.jpg',20),(15,'Classic Cheese Pizza','A timeless favorite, our Classic Cheese Pizza features a perfectly baked, golden crust topped with rich tomato sauce and a generous layer of melted mozzarella cheese. Simple yet satisfying, this pizza is a celebration of bold, cheesy goodness with every bite. Ideal for any occasion, it’s the perfect choice for cheese lovers.',12.99,6,'../images/classiccheesepizza.jpg',12),(16,'Coconut Chicken Rice Bowl','A flavorful and creamy dish featuring tender chicken marinated in a coconut milk blend, then grilled to perfection. Served over a bed of fluffy jasmine rice, this bowl is complemented by a light coconut sauce and a hint of lime for added freshness. Topped with fresh cilantro and a sprinkle of toasted sesame seeds, this dish offers a perfect balance of creamy, savory, and aromatic flavors.',6.75,7,'../images/CoconutChickenRiceBowl.jpg',20),(17,'Garlic Skillet Chicken','Tender chicken breasts cooked to perfection in a rich and savory garlic butter sauce. Infused with aromatic garlic, fresh herbs, and a hint of lemon, this dish is a delicious balance of creamy, buttery flavors with a touch of zest. Served with your choice of sides, it’s a comforting and flavorful meal that will satisfy your cravings with every bite.perfection in a sizzling skillet, infused with rich garlic butter and fresh herbs. Each bite is bursting with savory, aromatic flavors, complemented by a touch of lemon for added brightness. Served with your choice of sides, this dish is simple yet full of bold, comforting taste. Perfect for garlic lovers and anyone seeking a deliciously satisfying meal.',15.00,4,'../images/creamygarlicskilletchickenwithspinach.jpg',10),(18,'Garlic Butter Chicken','Garlic Butter chicken',20.02,4,'../images/GarlicButterChicken.jpg',10),(19,'Greek Vegetable Pizza','A Mediterranean-inspired delight, our Greek pizza features a crispy crust topped with tangy tomato sauce, creamy feta cheese, Kalamata olives, and a medley of fresh vegetables including cucumbers, red onions, and ripe tomatoes. Finished with a sprinkle of oregano and a drizzle of extra virgin olive oil, this pizza offers a perfect balance of bold, savory, and refreshing flavors. A must-try for those who enjoy vibrant and unique tastes.',15.44,6,'../images/greekpizza.jpg',20),(20,'Korean Fried Chicken','Crispy, golden fried chicken coated in a sweet and spicy Korean glaze. Each piece is perfectly crunchy on the outside, while tender and juicy on the inside. The glaze, made with a blend of soy sauce, garlic, ginger, and a touch of heat, adds a bold and irresistible flavor. Served with pickled vegetables or your choice of sides, this dish brings the bold and vibrant flavors of Korea to your plate.',30.00,4,'../images/koreanfriedchicken.jpg',14),(21,'Margherita Cheese Pizza','A classic Italian favorite, our Margherita pizza features a perfectly thin, crispy crust topped with rich tomato sauce, fresh mozzarella cheese, and a handful of aromatic basil leaves. Drizzled with a touch of extra virgin olive oil, this simple yet delicious pizza highlights the freshest ingredients and offers a perfect balance of flavors. A true representation of Italian tradition in every bite.',22.22,6,'../images/margherita.jpg',40),(22,'Mediterranean Veggy Pasta','A vibrant and flavorful pasta dish featuring al dente noodles tossed with a colorful mix of Mediterranean vegetables such as bell peppers, zucchini, cherry tomatoes, and olives. Tossed in a light, garlicky olive oil dressing and topped with crumbled feta cheese, this dish is bursting with fresh, earthy flavors. A sprinkle of oregano and a squeeze of lemon bring it all together, making this a satisfying and healthy choice for vegetable lovers.',23.22,5,'../images/mediterraneanveggypasta.jpg',12),(23,'Broccoli Pasta Dish','A simple yet delicious dish featuring al dente pasta tossed with tender broccoli florets, garlic, and a light olive oil or butter sauce. Finished with a sprinkle of Parmesan cheese and a touch of lemon zest, this dish offers a perfect balance of savory flavors and fresh, vibrant vegetables. It’s a comforting, wholesome meal that’s both satisfying and full of flavor.',2.22,5,'../images/PastawithBroccoli.jpg',2),(24,'Vegan Stir-fry Pasta','A vibrant and healthy stir fry featuring al dente pasta tossed with a medley of crisp, colorful vegetables like bell peppers, broccoli, and snap peas. Stir-fried in a savory soy-based sauce with garlic, ginger, and a hint of sesame oil, this dish is packed with bold flavors and wholesome goodness. Topped with sesame seeds and fresh herbs, it’s a delicious, plant-based meal that’s both satisfying and full of flavor.',1.99,5,'../images/quickveganpastavegetablestirfrywithgingerandgarlic.jpg',1),(25,'Sticky Chicken and Fries','Juicy, tender chicken pieces glazed in a sweet and savory sticky sauce, perfectly paired with crispy golden fries. The rich, flavorful glaze combines hints of honey, soy sauce, and spices, creating a deliciously irresistible coating. Served with a side of crispy fries, this dish offers a comforting and satisfying combination of savory, sweet, and crunchy. Perfect for a casual meal that’s both hearty and full of flavor.',4.99,4,'../images/Stickychickenandfries.jpg',20);
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
  `shipped_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`shipping_id`),
  UNIQUE KEY `order_id_UNIQUE` (`order_id`),
  UNIQUE KEY `tracking_number_UNIQUE` (`tracking_number`),
  CONSTRAINT `order_idy` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shippings`
--

LOCK TABLES `shippings` WRITE;
/*!40000 ALTER TABLE `shippings` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transactions`
--

LOCK TABLES `transactions` WRITE;
/*!40000 ALTER TABLE `transactions` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `useraccounts`
--

LOCK TABLES `useraccounts` WRITE;
/*!40000 ALTER TABLE `useraccounts` DISABLE KEYS */;
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'crazyuser1','iamcrazyuser1@gmail.com','$2y$12$c5K3MEE/.8xwBDZR7yvzdOu/0yw7uCxFp3e8rFDvmaKAC2nffSxZC'),(2,'user','user@gmail.com','$2y$12$x4a7r53rKbn9.3t0WI7/c.4uhOAIvkTBDaAwmw0I1dKixiotLZV4W'),(3,'user1','user1@gmail.com','$2y$12$gVqJGvhmTYV4cUK1JqXE2upf.80ugkR/yyF7mSKUVEtHK944zQbei'),(4,'user2','user2@gmail.com','$2y$12$i8FVDy3G4oSERdahqYrodeCe9vFVonWaWcw5tBi27jduttWO5xIeC');
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

-- Dump completed on 2025-03-20 23:01:46
