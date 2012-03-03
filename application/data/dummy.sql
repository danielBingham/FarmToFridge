INSERT INTO `categories` 
        VALUES (1,'tomato'),
                (2,'brocolli'),
                (3,'cabbage'),
                (4,'lettuce'),
                (5,'pepper'),
                (6,'potato'),
                (7,'greens'),
                (8,'bean'),
                (9,'beet');

INSERT INTO `farms` 
        VALUES 
            (1,
            'Nottareal Farm',
            'This farm is nestled on ten acres of beautiful hill country in Donottaexist, Indiana.  Run by the team of \n                Wishi Wasreal and Ifi Wasreal using only sustainable growing practices that build soil for long term fertility.\n                The ten acres support a wide variety of food crops, all of which are entirely chemical free.\n\n                Also available are eggs and soup hens.',
            1),
            (2,
            'Mitabeen Farm',
            'A farm that might have sprung up on a beautiful 5 acres just south west of Bloomington, Indiana, had circumstances\n                been right.  In some alternate universe farmers Coulda Woulda and Shoulda Woulda are growing beautiful heirloom vegetables\n                with only minimal application of some organic fertilizers and natural pesticides.  Sadly, that alternate universe is not\n                this one.\n\n                And yet, by some fluke of space and time, their produce is available in our online market.',
            1);

INSERT INTO `images` 
        VALUES 
            (1,250,250,1),
            (2,250,250,1),
            (3,250,250,1),
            (4,250,250,1),
            (5,768,768,1),
            (6,768,768,1),
            (7,250,250,1),
            (8,683,1024,1),
            (9,768,576,1),
            (10,682,1024,1),
            (11,768,768,1),
            (12,768,768,1),
            (13,682,1024,1),
            (14,768,1024,1),
            (15,768,1024,1);

INSERT INTO `product_images` 
        VALUES (1,8,1,0),
                (2,8,1,1),
                (3,9,2,1),
                (4,10,3,1),
                (5,11,4,1),
                (6,12,5,1),
				(7,13,6,1),
				(8,14,7,1),
				(9,15,8,1);
INSERT INTO `product_tags` 
        VALUES (1,6,0),
				(2,6,1),
				(3,6,0),
				(4,6,2),
				(5,6,0),
				(6,6,3),
				(7,6,0),
				(8,6,0),
				(9,6,0),
				(10,4,0),
				(11,6,0),
				(12,6,0);

INSERT INTO `products` 
        VALUES (1,'Arugula','Some greens.',7,1.5,500,4,1),
				(2,'Sylvetta Arugula','',7,1.75,500,4,1),
				(3,'Bountiful Green Bean','',8,2,300,1,1),
				(4,'French Climbing Bean','',8,1.25,200,1,1),
				(5,'Chioggia Beet ','',9,3,600,1,1),
				(6,'Detroit Dark Red Beet','',9,2.5,500,1,1),
				(7,'Broccoli','',2,2,500,4,1),
				(8,'Brandywine Tomato','',1,2,500,1,1);

INSERT INTO `tags` 
        VALUES (1,'no-pesticides','np'),
				(2,'no-herbicides','nh'),
				(3,'no-fungicides','nf'),
				(4,'certified-organic','O'),
				(5,'grass-fed','gf'),
				(6,'chemical-free','cf'),
				(7,'antibiotic-free','af');

INSERT INTO `units` 
        VALUES (1,'pound','lb'),
				(2,'head','hd'),
				(3,'each','ea'),
				(4,'bunch','bch');

INSERT INTO `users` 
        VALUES (1,'grower@theroadgoeson.com','665a786152eff481cbbc1802228242d3',1),
				(2,'buyer@theroadgoeson.com','3be928357bda6967870bcd8afb400365',0),
				(3,'dbingham@theroadgoeson.com','340511c3c30e3e06e28257e6980af6e9',1);

INSERT INTO `configurations`
        VALUES (1, 'paypal_username', '', 'string'), /* blank for commitment purposes */
                (2, 'paypal_password', '', 'string'), /* blank for commitment purposes */
                (3, 'paypal_signature', '', 'string'), /* blank for commitment purposes */
                (4, 'paypal_version', '86.0', 'string'),
                (5, 'paypal_test', 'true', 'boolean'),
                (6, 'register_customerRequreMembershipFee', 'true', 'boolean'),
                (7, 'register_customerMembershipFee', '', 'float');
