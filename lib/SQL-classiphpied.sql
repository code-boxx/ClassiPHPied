CREATE TABLE `categories` (
  `cat_id` bigint(20) NOT NULL,
  `cat_name` varchar(255) NOT NULL,
  `cat_desc` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `classifieds` (
  `cla_id` bigint(20) NOT NULL,
  `cla_title` varchar(255) NOT NULL,
  `cla_summary` varchar(255) NOT NULL,
  `cla_text` text NOT NULL,
  `cla_date` datetime NOT NULL DEFAULT current_timestamp(),
  `cla_person` varchar(255) NOT NULL,
  `cla_email` varchar(255) DEFAULT NULL,
  `cla_tel` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `cla_images` (
  `cla_id` bigint(20) NOT NULL,
  `slot_id` bigint(20) NOT NULL,
  `img_file` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `cla_to_cat` (
  `cla_id` bigint(20) NOT NULL,
  `cat_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `users` (
  `user_id` bigint(20) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`),
  ADD KEY `cat_name` (`cat_name`),
  ADD KEY `cat_desc` (`cat_desc`);

ALTER TABLE `classifieds`
  ADD PRIMARY KEY (`cla_id`),
  ADD KEY `cla_title` (`cla_title`),
  ADD KEY `cla-date` (`cla_date`),
  ADD KEY `cla_email` (`cla_email`),
  ADD KEY `cla_person` (`cla_person`),
  ADD KEY `cla_summary` (`cla_summary`);
ALTER TABLE `classifieds` ADD FULLTEXT KEY `cla_text` (`cla_text`);

ALTER TABLE `cla_images`
  ADD PRIMARY KEY (`cla_id`,`slot_id`) USING BTREE;

ALTER TABLE `cla_to_cat`
  ADD PRIMARY KEY (`cla_id`,`cat_id`);

ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_email` (`user_email`),
  ADD KEY `user_name` (`user_name`);

ALTER TABLE `categories`
  MODIFY `cat_id` bigint(20) NOT NULL AUTO_INCREMENT;

ALTER TABLE `classifieds`
  MODIFY `cla_id` bigint(20) NOT NULL AUTO_INCREMENT;

ALTER TABLE `users`
  MODIFY `user_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
