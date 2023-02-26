INSERT INTO `categories` (`cat_id`, `cat_name`, `cat_desc`) VALUES
(1, 'Vehicles', 'Cars, trucks, motocycles, bicycles.'),
(2, 'Jobs', 'Employment matters.');

INSERT INTO `classifieds` (`cla_id`, `cla_title`, `cla_summary`, `cla_text`, `cla_date`, `cla_person`, `cla_email`, `cla_tel`) VALUES
(1, 'Banana Bike For Sale', 'It\'s yellow and it\'s fast.', '<p>Is post each that just leaf no. He connection interested so we an sympathize advantages. To said is it shed want do. Occasional middletons everything so to. Have spot part for his quit may. Enable it is square my an regard. Often merit stuff first oh up hills as he. Servants contempt as although addition dashwood is procured. Interest in yourself an do of numerous feelings cheerful confined.<br><br>Frankness applauded by supported ye household. Collected favourite now for for and rapturous repulsive consulted. An seems green be wrote again. She add what own only like. Tolerably we as extremity exquisite do commanded. Doubtful offended do entrance of landlord moreover is mistress in. Nay was appear entire ladies. Sportsman do allowance is september shameless am sincerity oh recommend. Gate tell man day that who.</p>', '2077-01-01 14:28:07', 'Job', 'job@doe.om', '12345678'),
(2, 'Zombie Proof Truck', 'Well used. Not breached by zombies.', '<p>Living valley had silent eat merits esteem bed. In last an or went wise as left. Visited civilly am demesne so colonel he calling. So unreserved do interested increasing sentiments. Vanity day giving points within six not law. Few impression difficulty his use has comparison decisively.<br><br>Months on ye at by esteem desire warmth former. Sure that that way gave any fond now. His boy middleton sir nor engrossed affection excellent. Dissimilar compliment cultivated preference eat sufficient may. Well next door soon we mr he four. Assistance impression set insipidity now connection off you solicitude. Under as seems we me stuff those style at. Listening shameless by abilities pronounce oh suspected is affection. Next it draw in draw much bred.</p>', '2077-01-01 14:30:06', 'Joy Doe', 'joy@doe.com', '87654321'),
(3, 'Chili Tester', 'Hot job for a hot person.', '<p>Surrounded affronting favourable no mr. Lain knew like half she yet joy. Be than dull as seen very shot. Attachment ye so am travelling estimating projecting is. Off fat address attacks his besides. Suitable settling mr attended no doubtful feelings. Any over for say bore such sold five but hung.</p>\r\n<p>Arrived compass prepare an on as. Reasonable particular on my it in sympathize. Size now easy eat hand how. Unwilling he departure elsewhere dejection at. Heart large seems may purse means few blind. Exquisite newspaper attending on certainty oh suspicion of. He less do quit evil is. Add matter family active mutual put wishes happen.</p>', '2077-01-01 14:30:37', 'Joe Doe', 'joe@doe.com', '87654321'),
(4, 'IT Sales Person', 'Must be willing to time travel.', '<p>When be draw drew ye. Defective in do recommend suffering. House it seven in spoil tiled court. Sister others marked fat missed did out use. Alteration possession dispatched collecting instrument travelling he or on. Snug give made at spot or late that mr.<br><br>Not him old music think his found enjoy merry. Listening acuteness dependent at or an. Apartments thoroughly unsatiable terminated sex how themselves. She are ten hours wrong walls stand early. Domestic perceive on an ladyship extended received do. Why jennings our whatever his learning gay perceive. Is against no he without subject. Bed connection unreserved preference partiality not unaffected. Years merit trees so think in hoped we as.</p>', '2077-01-01 14:31:43', 'Jon Doe', 'jon@doe.om', '12345678');

INSERT INTO `cla_images` (`cla_id`, `slot_id`, `img_file`) VALUES
(1, 1, 'ad-banana.webp'),
(2, 1, 'ad-truck.webp'),
(3, 1, 'ad-chili.webp'),
(4, 1, 'ad-laptop.webp');

INSERT INTO `cla_to_cat` (`cla_id`, `cat_id`) VALUES
(1, 1),
(2, 1),
(3, 2),
(4, 2);