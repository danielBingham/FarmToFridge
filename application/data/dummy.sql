
INSERT INTO `growers` (`email`, `password`) 
        VALUES ('dummy@theroadgoeson.com', 'dummyAccount'); /* 1 */

INSERT INTO `farms` (`name`, `description`, `growerID`) 
        VALUES ('Daniel\'s Dummy Farm', 'This is a test farm.  This is only a test.  Please disregard the test.', 1); /* 1 */

INSERT INTO `products` (`name`, `price`, `amount`, `farmID`, `categoryID`) 
        VALUES ('tomatoes', 4.00, '200', 1, 1), /* 1 */
                ('broccoli', 2.00, '300', 1, 2),/* 2 */
                ('cabbage', 2.00, '300', 1, 3), /* 3 */
                ('romain', 1.50, '200', 1, 4), /* 4 */
                ('deer tongue', 1.50, '200', 1, 4), /* 5 */
                ('red peppers', 2.00, '300', 1, 5), /* 6 */
                ('green peppers', 2.00, '300', 1, 5), /* 7 */
                ('potatoes', 1.00, '600', 1, 6); /* 8 */

INSERT INTO `categories` (`name`) 
        VALUES ('tomato'), /* 1 */
                ('brocolli'), /* 2 */ 
                ('cabbage'), /* 3 */
                ('lettuce'), /* 4 */
                ('pepper'), /* 5 */ 
                ('potato'); /* 6 */ 

INSERT INTO `tags` (`name`, `symbol`) 
        VALUES ('no-pesticides', 'np'), /* 1 */ 
                                    ('no-herbicides', 'nh'), /* 2 */
                                    ('no-fungicides', 'nf'), /* 3 */ 
                                    ('certified-organic', 'O'),  /* 4 */
                                    ('grass-fed', 'gf'), /* 5 */
                                    ('chemical-free', 'cf'), /* 6 */
                                    ('antibiotic-free', 'af'); /* 7 */

INSERT INTO `product_tags` (`productID`, `tagID`) 
        VALUES (1,6), (2, 2), (2, 3), (3, 6), (4, 1), (4, 3), (5, 6), (6, 6), (7, 1), (8, 2), (8, 4); 

INSERT INTO `images` (`width`, `height`, `growerID`)
        VALUES (1600, 1067, 1), /* tomato: 1 */
                (1600, 1067, 1), /* broccoli: 2 */
                (2428, 1095, 1), /* cabbage: 3 */
                (2526, 2136, 1), /* romaine: 4 */
                (1600, 1200, 1), /* deer tongue: 5 */
                (1600, 1067, 1), /* red pepper: 6 */
                (1452, 1062, 1), /* green pepper: 7 */
                (800, 520, 1); /* potato: 8 */

INSERT INTO `product_images` (`imageID`, `productID`, `primary`) 
        VALUES (1, 1, 1), (2, 2, 1), (3, 3, 1), (4, 4, 1), (5, 5, 1), (6, 6, 1), (7, 7, 1), (8, 8, 1);
