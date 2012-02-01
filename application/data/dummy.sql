
INSERT INTO `growers` (`email`, `password`) VALUES ('dummy@theroadgoeson.com', 'dummyAccount');

INSERT INTO `farms` (`name`, `description`, `growerID`) VALUES ('Daniel\'s Dummy Farm', 'This is a test farm.  This is only a test.  Please disregard the test.', 1);

INSERT INTO `products` (`name`, `price`, `amount`, `farmID`, `categoryID`) 
        VALUES ('tomatoes', 4.00, '200', 1, 1),
                ('broccoli', 2.00, '300', 1, 2),
                ('cabbage', 2.00, '300', 1, 3),
                ('romain', 1.50, '200', 1, 4),
                ('deer tongue', 1.50, '200', 1, 4),
                ('red peppers', 2.00, '300', 1, 5),
                ('green peppers', 2.00, '300', 1, 5),
                ('potatoes', 1.00, '600', 1, 6);

INSERT INTO `categories` (`name`) VALUES ('tomato'), ('brocolli'), ('cabbage'), ('lettuce'), ('pepper'), ('potato'); 
