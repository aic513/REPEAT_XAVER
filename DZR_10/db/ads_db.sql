#SXD20|20011|50525|50313|2016.11.17 15:33:41|ads_db|0|4|72|
#TA advertisement`0`16384|categories`63`2824|cities`9`236|photo`0`16384
#EOH

#	TC`advertisement`utf8_general_ci	;
CREATE TABLE `advertisement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `private` int(11) DEFAULT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(20) DEFAULT NULL,
  `allow_mails` varchar(10) DEFAULT NULL,
  `phone` varchar(12) DEFAULT NULL,
  `location` int(11) DEFAULT NULL,
  `category` int(11) DEFAULT NULL,
  `title` varchar(20) NOT NULL,
  `description` text,
  `price` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8	;
#	TC`categories`utf8_general_ci	;
CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(30) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=117 DEFAULT CHARSET=utf8	;
#	TD`categories`utf8_general_ci	;
INSERT INTO `categories` VALUES 
(1,'Транспорт',\N),
(2,'Недвижимость',\N),
(3,'Работа',\N),
(4,'Услуги',\N),
(5,'Личные вещи',\N),
(6,'Для дома и дачи',\N),
(7,'Бытовая электроника',\N),
(8,'Хобби и отдых',\N),
(9,'Животные',\N),
(10,'Для бизнеса',\N),
(12,'Автомобили с пробегом',1),
(109,'Новые автомобили',1),
(14,'Мотоциклы и мототехника',1),
(81,'Грузовики и спецтехника',1),
(11,'Водный транспорт',1),
(13,'Запчасти и аксессуары',1),
(24,'Квартиры',2),
(23,'Комнаты',2),
(25,'Дома, дачи, коттеджи',2),
(26,'Земельные участки',2),
(85,'Гаражи и машиноместа',2),
(42,'Коммерческая недвижимость',2),
(86,'Недвижимость за рубежом',2),
(111,'Вакансии',3),
(112,'Резюме',3),
(114,'Предложения услуг',4),
(115,'Запросы на услуги',4),
(27,'Одежда, обувь, аксессуары',5),
(29,'Детская одежда и обувь',5),
(30,'Товары для детей и игрушки',5),
(28,'Часы и украшения',5),
(88,'Красота и здоровье',5),
(21,'Бытовая техника',6),
(20,'Мебель и интерьер',6),
(87,'Посуда и товары для кухни',6),
(82,'Продукты питания',6),
(19,'Ремонт и строительство',6),
(106,'Растения',6),
(32,'Аудио и видео',7),
(97,'Игры, приставки и программы',7),
(31,'Настольные компьютеры',7),
(98,'Ноутбуки',7),
(99,'Оргтехника и расходники',7),
(96,'Планшеты и электронные книги',7),
(84,'Телефоны',7),
(101,'Товары для компьютера',7),
(105,'Фототехника',7),
(33,'Билеты и путешествия',8),
(34,'Велосипеды',8),
(83,'Книги и журналы',8),
(36,'Коллекционирование',8),
(38,'Музыкальные инструменты',8),
(102,'Охота и рыбалка',8),
(39,'Спорт и отдых',8),
(103,'Знакомства',8),
(89,'Собаки',9),
(90,'Кошки',9),
(91,'Птицы',9),
(92,'Аквариум',9),
(93,'Другие животные',9),
(94,'Товары для животных',9),
(116,'Готовый бизнес',10),
(40,'Оборудование для бизнеса',10)	;
#	TC`cities`utf8_general_ci	;
CREATE TABLE `cities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `city` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=641791 DEFAULT CHARSET=utf8	;
#	TD`cities`utf8_general_ci	;
INSERT INTO `cities` VALUES 
(641490,'Барабинск'),
(641510,'Бердск'),
(641600,'Искитим'),
(641630,'Колывань'),
(641680,'Колывань'),
(641710,'Куйбышев'),
(641760,'Мошково'),
(641780,'Новосибирск'),
(641790,'Обь')	;
#	TC`photo`utf8_general_ci	;
CREATE TABLE `photo` (
  `id_image` int(11) NOT NULL AUTO_INCREMENT,
  `mime_type` varchar(20) NOT NULL,
  `watches` int(11) NOT NULL,
  PRIMARY KEY (`id_image`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8	;
