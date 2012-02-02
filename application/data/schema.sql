
CREATE TABLE `farms` (
    `id` int unsigned AUTO_INCREMENT NOT NULL,
    `name` varchar(255),
    `description` text,
    `growerID` int unsigned,
    PRIMARY KEY (`id`),
    KEY `growerID` (`growerID`)
) ENGINE=MyISAM DEFAULT CHARSET=UTF8;

CREATE TABLE `growers` (
    `id` int unsigned NOT NULL AUTO_INCREMENT,
    `email` varchar(255),
    `password` varchar(32),
    PRIMARY KEY (`id`),
    KEY `email` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=UTF8;

CREATE TABLE `products` (
    `id` int unsigned AUTO_INCREMENT NOT NULL,
    `name` varchar(255),
    `categoryID` int unsigned,
    `price` float,
    `amount` int,
    `farmID` int unsigned,
    PRIMARY KEY(`id`),
    KEY `categoryID` (`categoryID`),
    KEY `farmID` (`farmID`)
) ENGINE=MyISAM DEFAULT CHARSET=UTF8;

CREATE TABLE `order_products` ( `id` int unsigned NOT NULL AUTO_INCREMENT,
    `productID` int unsigned,
    `orderID` int unsigned,
    `amount` int,
    PRIMARY KEY (`id`),
    KEY `productID` (`productID`),
    KEY `orderID` (`orderID`)
) ENGINE=MyISAM DEFAULT CHARSET=UTF8;

CREATE TABLE `orders` (
    `id` int unsigned NOT NULL AUTO_INCREMENT,
    `buyerID` int unsigned,
    `orderedOn` datetime,
    `confirmed` tinyint,
    `filled` tinyint,
    PRIMARY KEY (`id`),
    KEY `buyerID` (`buyerID`)
) ENGINE=MyISAM DEFAULT CHARSET=UTF8;

CREATE TABLE `buyers` (
    `id` int unsigned NOT NULL AUTO_INCREMENT,
    `email` varchar(255),
    `password` varchar(32),
    PRIMARY KEY (`id`),
    KEY `email` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=UTF8;

CREATE TABLE `categories` (
    `id` int unsigned NOT NULL AUTO_INCREMENT,
    `name` varchar(255),
    PRIMARY KEY (`id`),
    FULLTEXT `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=UTF8;

CREATE TABLE `images` (
    `id` int unsigned NOT NULL AUTO_INCREMENT,
    `height` int,
    `width` int,
    `growerID` int unsigned,
    PRIMARY KEY (`id`),
    KEY `growerID` (`growerID`)
) ENGINE=MyISAM DEFAULT CHARSET=UTF8;

CREATE TABLE `farm_images` (
    `id` int unsigned NOT NULL AUTO_INCREMENT,
    `imageID` int unsigned,
    `farmID` int unsigned,
    `primary` tinyint,
    PRIMARY KEY (`id`),
    KEY `imageID` (`imageID`),
    KEY `farmID` (`farmID`)
) ENGINE=MyISAM DEFAULT CHARSET=UTF8;

CREATE TABLE `product_images` (
    `id` int unsigned NOT NULL AUTO_INCREMENT,
    `imageID` int unsigned,
    `productID` int unsigned,
    `primary` tinyint,
    PRIMARY KEY (`id`),
    KEY `imageID` (`imageID`),
    KEY `productID` (`productID`)
) ENGINE=MyISAM DEFAULT CHARSET=UTF8;

CREATE TABLE `tags` (
    `id` int unsigned NOT NULL AUTO_INCREMENT,
    `name` varchar(255),
    `symbol` varchar(255), /* This will eventually be a path name.  For now, two characters. */
    PRIMARY KEY (`id`),
    KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=UTF8;

CREATE TABLE `product_tags` (
    `id` int unsigned NOT NULL AUTO_INCREMENT,
    `tagID` int unsigned,
    `productID` int unsigned,
    PRIMARY KEY (`id`),
    KEY `tagID` (`tagID`),
    KEY `productID` (`productID`)
) ENGINE=MyISAM DEFAULT CHARSET=UTF8;













