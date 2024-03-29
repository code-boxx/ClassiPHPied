-- (A) SETTINGS
CREATE TABLE `settings` (
  `setting_name` varchar(255) NOT NULL,
  `setting_description` varchar(255) DEFAULT NULL,
  `setting_value` varchar(255) NOT NULL,
  `setting_group` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `settings`
  ADD PRIMARY KEY (`setting_name`),
  ADD KEY `setting_group` (`setting_group`);

INSERT INTO `settings` (`setting_name`, `setting_description`, `setting_value`, `setting_group`) VALUES
  ('APP_VER', 'App version', '1', 0),
  ('EMAIL_FROM', 'System email from', 'sys@site.com', 1),
  ('PAGE_PER', 'Number of entries per page', '20', 1),
  ('CLA_IMAGES', 'Max images per ad.', '3', 1),
  ('D_LONG', 'MYSQL date format (long)', '%e %M %Y', 1),
  ('D_SHORT', 'MYSQL date format (short)', '%Y-%m-%d', 1),
  ('DT_LONG', 'MYSQL date time format (long)', '%e %M %Y %l:%i:%S %p', 1),
  ('DT_SHORT', 'MYSQL date time format (short)', '%Y-%m-%d %H:%i:%S', 1);

-- (B) USERS
CREATE TABLE `users` (
  `user_id` bigint(20) NOT NULL,
  `user_level` varchar(1) NOT NULL DEFAULT 'U',
  `user_name` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_email` (`user_email`),
  ADD KEY `user_name` (`user_name`),
  ADD KEY `user_level` (`user_level`);

ALTER TABLE `users`
  MODIFY `user_id` bigint(20) NOT NULL AUTO_INCREMENT;

-- (C) SHARED USERS HASH
CREATE TABLE `users_hash` (
  `user_id` bigint(20) NOT NULL,
  `hash_for` varchar(1) NOT NULL,
  `hash_code` varchar(64) NOT NULL,
  `hash_time` datetime NOT NULL,
  `hash_tries` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `users_hash`
  ADD PRIMARY KEY (`user_id`, `hash_for`);

-- (D) CATEGORIES
CREATE TABLE `categories` (
  `cat_id` bigint(20) NOT NULL,
  `parent_id` bigint(20) NOT NULL DEFAULT 0,
  `cat_name` varchar(255) NOT NULL,
  `cat_desc` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`),
  ADD KEY `parent_id` (`parent_id`),
  ADD KEY `cat_name` (`cat_name`),
  ADD KEY `cat_desc` (`cat_desc`);

ALTER TABLE `categories`
  MODIFY `cat_id` bigint(20) NOT NULL AUTO_INCREMENT;

-- (E) CLASSIFIEDS
CREATE TABLE `classifieds` (
  `cla_id` bigint(20) NOT NULL,
  `cla_title` varchar(255) NOT NULL,
  `cla_summary` varchar(255) NOT NULL,
  `cla_text` text NOT NULL,
  `cla_date` datetime NOT NULL DEFAULT current_timestamp(),
  `cla_end` DATETIME DEFAULT NULL,
  `cla_person` varchar(255) NOT NULL,
  `cla_email` varchar(255) NOT NULL,
  `cla_tel` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `classifieds`
  ADD PRIMARY KEY (`cla_id`),
  ADD KEY `cla_title` (`cla_title`),
  ADD KEY `cla_summary` (`cla_summary`),
  ADD FULLTEXT KEY `cla_text` (`cla_text`),
  ADD KEY `cla_date` (`cla_date`),
  ADD KEY `cla_end` (`cla_end`),
  ADD KEY `cla_person` (`cla_person`),
  ADD KEY `cla_email` (`cla_email`);

ALTER TABLE `classifieds`
  MODIFY `cla_id` bigint(20) NOT NULL AUTO_INCREMENT;

-- (F) CLASSIFIED IMAGES
CREATE TABLE `cla_images` (
  `cla_id` bigint(20) NOT NULL,
  `slot_id` bigint(20) NOT NULL,
  `img_file` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `cla_images`
  ADD PRIMARY KEY (`cla_id`,`slot_id`) USING BTREE;

-- (G) CLASSIFIED TO CATEGORY
CREATE TABLE `cla_to_cat` (
  `cla_id` bigint(20) NOT NULL,
  `cat_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `cla_to_cat`
  ADD PRIMARY KEY (`cla_id`,`cat_id`);