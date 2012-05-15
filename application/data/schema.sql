
CREATE TABLE `farms` (
    `id` int unsigned AUTO_INCREMENT NOT NULL,
    `name` varchar(255),
    `description` text,
    `phone` varchar(16),
    `email` varchar(255),
    `address` text,
    `website` varchar(255),
    `userID` int unsigned,
    PRIMARY KEY (`id`),
    KEY `userID` (`userID`)
) ENGINE=MyISAM DEFAULT CHARSET=UTF8;

CREATE TABLE `users` (
    `id` int unsigned NOT NULL AUTO_INCREMENT,
    `email` varchar(255),
    `password` varchar(64),
    `name` varchar(255),
    `address` varchar(1024),
    `phone` varchar(16),
    `type` ENUM('INACTIVE', 'CUSTOMER', 'GROWER', 'ADMIN'),
    PRIMARY KEY (`id`),
    KEY `email` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=UTF8;


CREATE TABLE `products` (
    `id` int unsigned AUTO_INCREMENT NOT NULL,
    `name` varchar(255),
    `description` text,
    `categoryID` int unsigned,
    `price` float,
    `amount` int,
    `unitID` int unsigned,
    `farmID` int unsigned,
    PRIMARY KEY(`id`),
    KEY `categoryID` (`categoryID`),
    KEY `farmID` (`farmID`)
) ENGINE=MyISAM DEFAULT CHARSET=UTF8;

CREATE TABLE `units` (
    `id` int unsigned AUTO_INCREMENT NOT NULL,
    `name` varchar(32),
    `abbreviation` varchar(16),
    PRIMARY KEY (`id`)
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
    `userID` int unsigned,
    `orderedOn` datetime,
    `state` ENUM('unconfirmed', 'confirmed', 'paid', 'assembled', 'filled'), 
    PRIMARY KEY (`id`),
    KEY `userID` (`userID`)
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
    `userID` int unsigned,
    PRIMARY KEY (`id`),
    KEY `userID` (`userID`)
) ENGINE=MyISAM DEFAULT CHARSET=UTF8;

CREATE TABLE `farm_images` (
    `id` int unsigned NOT NULL AUTO_INCREMENT,
    `imageID` int unsigned,
    `farmID` int unsigned,
    `main` tinyint,
    PRIMARY KEY (`id`),
    KEY `imageID` (`imageID`),
    KEY `farmID` (`farmID`)
) ENGINE=MyISAM DEFAULT CHARSET=UTF8;

CREATE TABLE `product_images` (
    `id` int unsigned NOT NULL AUTO_INCREMENT,
    `imageID` int unsigned,
    `productID` int unsigned,
    `main` tinyint,
    PRIMARY KEY (`id`),
    KEY `imageID` (`imageID`),
    KEY `productID` (`productID`)
) ENGINE=MyISAM DEFAULT CHARSET=UTF8;

CREATE TABLE `category_images` (
    `id` int unsigned NOT NULL AUTO_INCREMENT,
    `imageID` int unsigned,
    `categoryID` int unsigned,
    `main` tinyint,
    PRIMARY KEY (`id`),
    KEY `imageID` (`imageID`),
    KEY `categoryID` (`categoryID`) 
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

CREATE TABLE `configurations` (
    `id` int unsigned NOT NULL AUTO_INCREMENT,
    `name` varchar(255),
    `displayName` varchar(255),
    `value` varchar(1024),
    `type` varchar(255),
    PRIMARY KEY (`id`),
    KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=UTF8;











