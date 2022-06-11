-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 09, 2022 at 05:33 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hurgada-grnd-hotel`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log`
(
    `timestamp`   timestamp    NOT NULL DEFAULT current_timestamp(),
    `owner`       int(11)      NOT NULL,
    `actiontype`  varchar(100) NOT NULL,
    `description` text         NOT NULL,
    `transaction` decimal(10, 0)        DEFAULT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;

--
-- Dumping data for table `activity_log`
--

INSERT INTO `activity_log` (`timestamp`, `owner`, `actiontype`, `description`, `transaction`)
VALUES ('2022-04-14 07:25:30', 1, 'Login', 'Logged in', NULL),
       ('2022-06-07 21:40:42', 1, 'Room Reservation Request',
        'Client 1 \r\n        reserved room number 2 \r\n        from 2022-08-09 to 2022-08-17 \r\n        for 2 adults and 0 children.',
        '3960'),
       ('2022-06-07 21:47:58', 27, 'Room Reservation Request',
        'Client 27 \r\n        reserved room number 1 \r\n        from 2022-11-15 to 2022-12-01 \r\n        for 2 adults and 1 children.',
        '10880');

-- --------------------------------------------------------

--
-- Table structure for table `contactus_suggestions`
--

CREATE TABLE `contactus_suggestions`
(
    `suggestion_id` int(11) NOT NULL,
    `email`         varchar(40) DEFAULT NULL,
    `review`        text        DEFAULT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `dependants`
--

CREATE TABLE `dependants`
(
    `dependent_id`   int(11)      NOT NULL,
    `dependent_name` varchar(40)  NOT NULL,
    `relationship`   varchar(50)  NOT NULL,
    `identification` varchar(150) NOT NULL,
    `child`          tinyint(1)   NOT NULL,
    `parent_id`      int(11)      NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations`
(
    `reservation_id`    int(11)        NOT NULL,
    `client_id`         int(11)        NOT NULL,
    `room_no`           int(11)                 DEFAULT NULL,
    `start_date`        date           NOT NULL,
    `end_date`          date           NOT NULL,
    `numberof_adults`   int(11)        NOT NULL,
    `numberof_children` int(11)        NOT NULL,
    `price`             decimal(10, 0) NOT NULL,
    `is_checked_in`     tinyint(1)     NOT NULL DEFAULT 0,
    `extra_bed`         int(11)                 DEFAULT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`reservation_id`, `client_id`, `room_no`, `start_date`, `end_date`, `numberof_adults`,
                            `numberof_children`, `price`, `is_checked_in`, `extra_bed`)
VALUES (21, 1, 1, '2022-05-04', '2022-05-05', 3, 0, '640', 0, NULL),
       (22, 1, 1, '2022-06-30', '2022-08-03', 2, 0, '3200', 0, NULL),
       (23, 1, 1, '2022-05-28', '2022-06-21', 1, 1, '16000', 0, NULL),
       (24, 1, 1, '2022-07-28', '2022-06-21', 1, 1, '5120', 0, NULL),
       (25, 1, 1, '2022-04-15', '2022-03-31', 1, 0, '10240', 0, NULL),
       (26, 1, 1, '2022-04-01', '2022-03-27', 1, 0, '3840', 0, NULL),
       (27, 1, 1, '2022-04-07', '2022-03-28', 1, 0, '7040', 0, NULL),
       (28, 1, 1, '2022-04-08', '2022-03-27', 1, 0, '8320', 0, NULL),
       (34, 3, 2, '2022-07-01', '2022-07-07', 2, 0, '3080', 0, NULL),
       (35, 1, 2, '2022-08-09', '2022-08-17', 2, 0, '3960', 0, NULL),
       (36, 27, 1, '2022-11-15', '2022-12-01', 2, 1, '10880', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms`
(
    `room_id`         int(11)    NOT NULL,
    `room_type_id`    int(11)    NOT NULL,
    `occupied`        tinyint(1) NOT NULL,
    `room_view`       int(11)    NOT NULL,
    `room_patio`      tinyint(1) NOT NULL,
    `room_base_price` int(11)    NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`room_id`, `room_type_id`, `occupied`, `room_view`, `room_patio`, `room_base_price`)
VALUES (1, 2, 0, 1, 1, 640),
       (2, 1, 0, 2, 0, 440);

-- --------------------------------------------------------

--
-- Table structure for table `room_reviews`
--

CREATE TABLE `room_reviews`
(
    `client_id`           int(11)        NOT NULL,
    `room_id`             int(11)        NOT NULL,
    `overall-rating`      decimal(10, 0) NOT NULL,
    `view_rating`         decimal(10, 0) NOT NULL,
    `comfort_rating`      decimal(10, 0) NOT NULL,
    `facilities_rating`   decimal(10, 0) NOT NULL,
    `room_service_rating` decimal(10, 0) NOT NULL,
    `comments`            text           NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;

--
-- Dumping data for table `room_reviews`
--

INSERT INTO `room_reviews` (`client_id`, `room_id`, overall_rating, `view_rating`, `comfort_rating`,
                            `facilities_rating`, `room_service_rating`, `comments`)
VALUES (1, 1, '7', '6', '8', '3', '5', 'Loved it!');

-- --------------------------------------------------------

--
-- Table structure for table `room_types`
--

CREATE TABLE `room_types`
(
    `type_id`       int(11)      NOT NULL,
    `room_category` varchar(100) NOT NULL,
    `room_max_cap`  int(11)      NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;

--
-- Dumping data for table `room_types`
--

INSERT INTO `room_types` (`type_id`, `room_category`, `room_max_cap`)
VALUES (1, 'Standard Room', 4),
       (2, 'Chalet', 6),
       (3, 'Beachside Villa', 8),
       (4, 'Duplex', 5),
       (5, 'Apartment-like', 5);

-- --------------------------------------------------------

--
-- Table structure for table `room_views`
--

CREATE TABLE `room_views`
(
    `room_view_id`          int(11)     NOT NULL,
    `room_view_title`       varchar(40) NOT NULL,
    `room_view_description` text DEFAULT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;

--
-- Dumping data for table `room_views`
--

INSERT INTO `room_views` (`room_view_id`, `room_view_title`, `room_view_description`)
VALUES (1, 'Sea View', 'A room that overlooks the sea'),
       (2, 'Mountain View', 'A room by the mountain side'),
       (3, 'Garden View', 'A room overlooking the vast gardens in the center of the hotel'),
       (4, 'Pool View', 'A room just next to the pool');

-- --------------------------------------------------------

--
-- Table structure for table `security`
--

CREATE TABLE `security`
(
    `pin` varchar(4) NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;

--
-- Dumping data for table `security`
--

INSERT INTO `security` (`pin`)
VALUES ('503');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services`
(
    `service_id`          int(11)      NOT NULL,
    `service_name`        varchar(100) NOT NULL,
    `service_add_price`   tinyint(1)   NOT NULL DEFAULT 0,
    `service_price`       float                 DEFAULT NULL,
    `service_description` text                  DEFAULT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `service_reviews`
--

CREATE TABLE `service_reviews`
(
    `client_id`      int(11)        NOT NULL,
    `service_id`     int(11)        NOT NULL,
    `overall_rating` decimal(10, 0) NOT NULL,
    `comments`       text           NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users`
(
    `user_id`                 int(11)      NOT NULL,
    `email`                   varchar(60)  NOT NULL,
    `first_name`              varchar(40)  NOT NULL,
    `last_name`               varchar(40)  NOT NULL,
    `password`                varchar(60)  NOT NULL,
    `national_id_photo`       varchar(150) NOT NULL,
    `user_pic`                varchar(150) NOT NULL,
    `user_type`               int(11)      NOT NULL DEFAULT 3,
    `receptionist_enabled`    tinyint(1)            DEFAULT NULL,
    `receptionist_qc_comment` text                  DEFAULT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `email`, `first_name`, `last_name`, `password`, `national_id_photo`, `user_pic`,
                     `user_type`, `receptionist_enabled`, `receptionist_qc_comment`)
VALUES (1, 'belal@gmail.com', 'Belal', 'Elsabbagh', '123', '', '', 3, NULL, NULL),
       (26, 'harry@gmail.com', 'Harry', 'Potter', '123', 'harr@gmail.com.jpg', 'harr@gmail.com.jpg', 2, 1, ''),
       (27, 'ali@gmail.com', 'Ali', 'Emad', '123', 'ali@gmail.com.png', 'ali@gmail.com.png', 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE `user_type`
(
    `utype_id`    int(11)     NOT NULL,
    `utype_title` varchar(40) NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`utype_id`, `utype_title`)
VALUES (1, 'Quality Control Manager'),
       (2, 'Receptionist'),
       (3, 'Guest');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_log`
--
ALTER TABLE `activity_log`
    ADD PRIMARY KEY (`timestamp`),
    ADD KEY `owner` (`owner`);

--
-- Indexes for table `contactus_suggestions`
--
ALTER TABLE `contactus_suggestions`
    ADD PRIMARY KEY (`suggestion_id`),
    ADD UNIQUE KEY `contactus_suggestions_suggestion_id_uindex` (`suggestion_id`);

--
-- Indexes for table `dependants`
--
ALTER TABLE `dependants`
    ADD PRIMARY KEY (`dependent_id`),
    ADD KEY `parent_id` (`parent_id`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
    ADD PRIMARY KEY (`reservation_id`),
    ADD KEY `client_id` (`client_id`, `room_no`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
    ADD PRIMARY KEY (`room_id`),
    ADD KEY `room_type_id` (`room_type_id`),
    ADD KEY `room_view` (`room_view`);

--
-- Indexes for table `room_reviews`
--
ALTER TABLE `room_reviews`
    ADD KEY `client_id` (`client_id`),
    ADD KEY `room_id` (`room_id`);

--
-- Indexes for table `room_types`
--
ALTER TABLE `room_types`
    ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `room_views`
--
ALTER TABLE `room_views`
    ADD PRIMARY KEY (`room_view_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
    ADD PRIMARY KEY (`service_id`);

--
-- Indexes for table `service_reviews`
--
ALTER TABLE `service_reviews`
    ADD KEY `client_id` (`client_id`),
    ADD KEY `service_id` (`service_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
    ADD PRIMARY KEY (`user_id`),
    ADD UNIQUE KEY `email` (`email`),
    ADD KEY `user_type` (`user_type`);

--
-- Indexes for table `user_type`
--
ALTER TABLE `user_type`
    ADD PRIMARY KEY (`utype_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contactus_suggestions`
--
ALTER TABLE `contactus_suggestions`
    MODIFY `suggestion_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dependants`
--
ALTER TABLE `dependants`
    MODIFY `dependent_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
    MODIFY `reservation_id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 37;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
    MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 3;

--
-- AUTO_INCREMENT for table `room_types`
--
ALTER TABLE `room_types`
    MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 6;

--
-- AUTO_INCREMENT for table `room_views`
--
ALTER TABLE `room_views`
    MODIFY `room_view_id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 5;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
    MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
    MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 28;

--
-- AUTO_INCREMENT for table `user_type`
--
ALTER TABLE `user_type`
    MODIFY `utype_id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activity_log`
--
ALTER TABLE `activity_log`
    ADD CONSTRAINT `activity_log_ibfk_1` FOREIGN KEY (`owner`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `dependants`
--
ALTER TABLE `dependants`
    ADD CONSTRAINT `dependants_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
    ADD CONSTRAINT `reservations_ibfk_2` FOREIGN KEY (`room_no`) REFERENCES `rooms` (`room_id`);

--
-- Constraints for table `rooms`
--
ALTER TABLE `rooms`
    ADD CONSTRAINT `rooms_ibfk_1` FOREIGN KEY (`room_type_id`) REFERENCES `room_types` (`type_id`),
    ADD CONSTRAINT `rooms_ibfk_2` FOREIGN KEY (`room_view`) REFERENCES `room_views` (`room_view_id`);

--
-- Constraints for table `room_reviews`
--
ALTER TABLE `room_reviews`
    ADD CONSTRAINT `room_reviews_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `users` (`user_id`),
    ADD CONSTRAINT `room_reviews_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`room_id`);

--
-- Constraints for table `service_reviews`
--
ALTER TABLE `service_reviews`
    ADD CONSTRAINT `service_reviews_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `users` (`user_id`),
    ADD CONSTRAINT `service_reviews_ibfk_2` FOREIGN KEY (`service_id`) REFERENCES `services` (`service_id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
    ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`user_type`) REFERENCES `user_type` (`utype_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT = @OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS = @OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
