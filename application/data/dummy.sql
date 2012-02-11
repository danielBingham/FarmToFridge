
INSERT INTO `users` (`email`, `password`, `isGrower`) 
        VALUES ('grower@theroadgoeson.com', MD5('dummyAccount'), 1), /* 1 */
                ('buyer@theroadgoeson.com', MD5('anotherdummy'), 0); /* 2 */

INSERT INTO `farms` (`name`, `description`, `userID`) 
        VALUES (
                'Nottareal Farm', 
                'This farm is nestled on ten acres of beautiful hill country in Donottaexist, Indiana.  Run by the team of 
                Wishi Wasreal and Ifi Wasreal using only sustainable growing practices that build soil for long term fertility.
                The ten acres support a wide variety of food crops, all of which are entirely chemical free.

                Also available are eggs and soup hens.', 1), /* 1 */
                ('Mitabeen Farm',
                'A farm that might have sprung up on a beautiful 5 acres just south west of Bloomington, Indiana, had circumstances
                been right.  In some alternate universe farmers Coulda Woulda and Shoulda Woulda are growing beautiful heirloom vegetables
                with only minimal application of some organic fertilizers and natural pesticides.  Sadly, that alternate universe is not
                this one.

                And yet, by some fluke of space and time, their produce is available in our online market.', 1); /* 2 */

INSERT INTO `categories` (`name`) 
        VALUES ('tomato'), /* 1 */
                ('brocolli'), /* 2 */ 
                ('cabbage'), /* 3 */
                ('lettuce'), /* 4 */
                ('pepper'), /* 5 */ 
                ('potato'); /* 6 */ 

INSERT INTO `units` (`name`, `abbreviation`)
        VALUES ('pound', 'lb'), /* 1 */
                ('head', 'hd'), /* 2 */
                ('each', 'ea'); /* 3 */

INSERT INTO `tags` (`name`, `symbol`) 
        VALUES ('no-pesticides', 'np'), /* 1 */ 
                                    ('no-herbicides', 'nh'), /* 2 */
                                    ('no-fungicides', 'nf'), /* 3 */ 
                                    ('certified-organic', 'O'),  /* 4 */
                                    ('grass-fed', 'gf'), /* 5 */
                                    ('chemical-free', 'cf'), /* 6 */
                                    ('antibiotic-free', 'af'); /* 7 */

