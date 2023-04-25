INSERT INTO `categories` (`cat_id`, `parent_id`, `cat_name`, `cat_desc`) VALUES
(1, 0, 'Vehicles', 'Cars, trucks, motocycles, bicycles.'),
(2, 0, 'Jobs', 'Employment matters.'),
(3, 1, 'Bikes', 'Two wheels.'),
(4, 1, 'Trucks', '4 wheels or more.');

INSERT INTO `classifieds` (`cla_id`, `cla_title`, `cla_summary`, `cla_text`, `cla_date`, `cla_person`, `cla_email`, `cla_tel`) VALUES
(1, 'Enchanted Bicycle', 'May fly at times.', '<p>Is post each that just leaf no. He connection interested so we an sympathize advantages.</p>', '2077-01-01 14:28:07', 'Joa Doe', 'joa@doe.com', '12345678'),
(2, 'Magic Bike For Sale', 'Drives on mana.', '<p>To said is it shed want do. Occasional middletons everything so to.</p>', '2077-01-01 14:30:06', 'Job Doe', 'job@doe.com', '23456789'),
(3, 'Zombie Proof Truck', 'Well used. Not breached by zombies.', '<p>Have spot part for his quit may. Enable it is square my an regard.</p>', '2077-01-01 14:30:06', 'Joe Doe', 'joe@doe.com', '98765432'),
(4, 'Golden Truck', 'Very bright. Will turn heads.', '<p> Often merit stuff first oh up hills as he. Servants contempt as although addition dashwood is procured.</p>', '2077-01-01 14:31:43', 'Jon Doe', 'jon@doe.com', '12348765'),
(5, 'Chili Tester', 'Hot job for a hot person.', '<p>Interest in yourself an do of numerous feelings cheerful confined. Frankness applauded by supported ye household.</p>', '2077-01-01 14:30:37', 'Joh Doe', 'joh@doe.com', '87654321'),
(6, 'Bed Tester', 'Must be willing to slepp.', '<p>When be draw drew ye. Defective in do recommend suffering.</p>', '2077-01-01 14:31:43', 'Joy Doe', 'joy@doe.com', '43215678');

INSERT INTO `cla_images` (`cla_id`, `slot_id`, `img_file`) VALUES
(1, 1, 'classiphpied-1.webp'),
(2, 1, 'classiphpied-2.webp'),
(3, 1, 'classiphpied-3.webp'),
(4, 1, 'classiphpied-4.webp'),
(5, 1, 'classiphpied-5.webp'),
(6, 1, 'classiphpied-6.webp');

INSERT INTO `cla_to_cat` (`cla_id`, `cat_id`) VALUES
(1, 3),
(2, 3),
(3, 4),
(4, 4),
(5, 2),
(6, 2);