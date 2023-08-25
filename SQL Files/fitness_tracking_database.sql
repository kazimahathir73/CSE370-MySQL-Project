-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 24, 2023 at 07:03 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fitness_tracking_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `achievement`
--

CREATE TABLE `achievement` (
  `Challenge_id` int(11) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `Task_name` varchar(255) DEFAULT NULL,
  `Point` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `activity`
--

CREATE TABLE `activity` (
  `goal_id` int(11) DEFAULT NULL,
  `Activity_id` int(11) NOT NULL,
  `Activity_type` varchar(255) DEFAULT NULL,
  `Client_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `Admin_ID` int(11) NOT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `Name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`Admin_ID`, `Email`, `Password`, `Name`) VALUES
(1, 'admin1@example.com', 'adminpass1', 'Admin One'),
(2, 'admin2@example.com', 'adminpass2', 'Admin Two'),
(3, 'admin3@example.com', 'adminpass3', 'Admin Three');

-- --------------------------------------------------------

--
-- Table structure for table `admin_can_change_doctor`
--

CREATE TABLE `admin_can_change_doctor` (
  `Admin_id` int(11) DEFAULT NULL,
  `Doctor_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admin_changes_trainer`
--

CREATE TABLE `admin_changes_trainer` (
  `Admin_id` int(11) DEFAULT NULL,
  `Trainer_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `breakfast_items`
--

CREATE TABLE `breakfast_items` (
  `diet_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `Nut_info` varchar(255) DEFAULT NULL,
  `calories` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `challenges`
--

CREATE TABLE `challenges` (
  `Challenge_id` int(11) NOT NULL,
  `Task_name` varchar(255) DEFAULT NULL,
  `Deadline` date DEFAULT NULL,
  `Point` int(11) DEFAULT NULL,
  `Type` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `challenges`
--

INSERT INTO `challenges` (`Challenge_id`, `Task_name`, `Deadline`, `Point`, `Type`) VALUES
(1, 'Challenge 1', '2023-07-15', 100, 'Physical'),
(2, 'Challenge 2', '2023-09-20', 150, 'Mental'),
(3, 'Challenge 3', '2023-08-30', 120, 'Physical'),
(4, 'Challenge 4', '2023-10-05', 180, 'Nutrition'),
(5, 'Challenge 5', '2023-09-10', 130, 'Physical');

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `Client_ID` int(11) NOT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `Age` int(11) DEFAULT NULL,
  `Gender` varchar(255) DEFAULT NULL,
  `Height` float DEFAULT NULL,
  `Weight` float DEFAULT NULL,
  `Trainer` int(11) DEFAULT NULL,
  `Medical` int(11) DEFAULT NULL,
  `Workout_id` int(11) DEFAULT NULL,
  `doctor_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`Client_ID`, `Email`, `Password`, `Name`, `Age`, `Gender`, `Height`, `Weight`, `Trainer`, `Medical`, `Workout_id`, `doctor_id`) VALUES
(1, 'email1@example.com', 'password1', 'John Doe', 30, 'Male', 175.5, 70.2, 3, NULL, NULL, 1),
(2, 'email2@example.com', 'password2', 'Jane Smith', 25, 'Female', 162.3, 58.7, NULL, NULL, NULL, NULL),
(3, 'email3@example.com', 'password3', 'Michael Johnson', 28, 'Male', 180, 80.5, NULL, NULL, NULL, NULL),
(4, 'email4@example.com', 'password4', 'Emily Williams', 22, 'Female', 158.9, 52.1, NULL, NULL, NULL, NULL),
(5, 'email5@example.com', 'password5', 'Alex Brown', 35, 'Male', 170.2, 75.8, NULL, NULL, NULL, NULL),
(6, 'email6@example.com', 'password6', 'Olivia Davis', 29, 'Female', 167.4, 61.3, NULL, NULL, NULL, NULL),
(7, 'email7@example.com', 'password7', 'Daniel Taylor', 27, 'Male', 185.7, 88.2, NULL, NULL, NULL, NULL),
(8, 'email8@example.com', 'password8', 'Sophia Clark', 24, 'Female', 160.1, 55.9, NULL, NULL, NULL, NULL),
(9, 'email9@example.com', 'password9', 'Ethan Lee', 31, 'Male', 178.8, 72.6, NULL, NULL, NULL, NULL),
(10, 'email10@example.com', 'password10', 'Ava Garcia', 26, 'Female', 163.5, 59.4, NULL, NULL, NULL, NULL),
(11, 'client000@example.com', 'password000', 'Mac mac', 20, 'shemale', 10, 10, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `client_complains_to_admin`
--

CREATE TABLE `client_complains_to_admin` (
  `admin_id` int(11) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `Comment` varchar(3000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `client_rates_trainer`
--

CREATE TABLE `client_rates_trainer` (
  `client_id` int(11) DEFAULT NULL,
  `trainer_id` int(11) DEFAULT NULL,
  `rating` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `client_rates_trainer`
--

INSERT INTO `client_rates_trainer` (`client_id`, `trainer_id`, `rating`) VALUES
(1, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `diet`
--

CREATE TABLE `diet` (
  `diet_id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `trainer_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dinner_items`
--

CREATE TABLE `dinner_items` (
  `diet_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `Nut_info` varchar(255) DEFAULT NULL,
  `calories` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `doctor_id` int(11) NOT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `patient_number` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`doctor_id`, `Email`, `Password`, `Name`, `patient_number`) VALUES
(1, 'doctor1@example.com', 'password1', 'Doctor1', 0),
(2, 'doctor2@example.com', 'password2', 'doctor2', 0);

-- --------------------------------------------------------

--
-- Table structure for table `doctor_creates_med_history`
--

CREATE TABLE `doctor_creates_med_history` (
  `doctor_id` int(11) DEFAULT NULL,
  `Medical_hist_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `exercise`
--

CREATE TABLE `exercise` (
  `workout_id` int(11) DEFAULT NULL,
  `Exersice_name` varchar(255) DEFAULT NULL,
  `Sets` int(11) DEFAULT NULL,
  `Reps` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `friendship`
--

CREATE TABLE `friendship` (
  `client1` int(11) DEFAULT NULL,
  `client2` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `friend_request`
--

CREATE TABLE `friend_request` (
  `sender_id` int(11) DEFAULT NULL,
  `receiver_id` int(11) DEFAULT NULL,
  `status` enum('pending','accepted','rejected') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `goal`
--

CREATE TABLE `goal` (
  `Goal_id` int(11) NOT NULL,
  `Target` varchar(255) DEFAULT NULL,
  `Goal_type` varchar(255) DEFAULT NULL,
  `Start` date DEFAULT NULL,
  `End` date DEFAULT NULL,
  `Achieved` tinyint(1) DEFAULT NULL,
  `Client_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `goal`
--

INSERT INTO `goal` (`Goal_id`, `Target`, `Goal_type`, `Start`, `End`, `Achieved`, `Client_id`) VALUES
(1, 'Upper body', 'Gain muscle', '2023-08-23', '2023-09-01', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `leaderboard`
--

CREATE TABLE `leaderboard` (
  `Challenge_id` int(11) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `Position` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lunch_items`
--

CREATE TABLE `lunch_items` (
  `diet_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `Nut_info` varchar(255) DEFAULT NULL,
  `calories` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `matric`
--

CREATE TABLE `matric` (
  `tech_id` int(11) DEFAULT NULL,
  `speed` int(11) DEFAULT NULL,
  `duration` time DEFAULT NULL,
  `distance` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `medical_history`
--

CREATE TABLE `medical_history` (
  `medical_hist_id` int(11) NOT NULL,
  `Bp` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `client_id` int(11) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `status` enum('paid','unpaid') DEFAULT 'unpaid',
  `month` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`client_id`, `amount`, `status`, `month`) VALUES
(1, 1000, 'paid', 'June'),
(1, 1000, 'paid', 'August'),
(2, 1500, 'paid', 'June'),
(3, 1200, 'unpaid', 'July'),
(4, 1800, 'paid', 'July'),
(5, 1300, 'unpaid', 'August'),
(5, 1300, 'unpaid', 'September');

-- --------------------------------------------------------

--
-- Table structure for table `tracking_tech`
--

CREATE TABLE `tracking_tech` (
  `Tech_id` int(11) NOT NULL,
  `Activity_id` int(11) DEFAULT NULL,
  `Tech_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `trainer`
--

CREATE TABLE `trainer` (
  `Trainer_id` int(11) NOT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `Specialization` varchar(255) DEFAULT NULL,
  `Experience` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `trainer`
--

INSERT INTO `trainer` (`Trainer_id`, `Email`, `Password`, `Name`, `Specialization`, `Experience`) VALUES
(1, 'trainer1111@example.com', 'password1111', 'Messi', 'swimming', 5),
(2, 'trainer2@example.com', 'password2', 'Ronaldo', 'Football', 10),
(3, 'trainer3@example.com', 'password3', 'Harry', 'Running', 2),
(4, 'trainer4@example.com', 'password4', 'Miss Sara', 'Legs', 4);

-- --------------------------------------------------------

--
-- Table structure for table `trainer_submit_issue_to_doctor`
--

CREATE TABLE `trainer_submit_issue_to_doctor` (
  `Trainer_id` int(11) DEFAULT NULL,
  `Doctor_id` int(11) DEFAULT NULL,
  `Client_id` int(11) DEFAULT NULL,
  `Issue` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `workout_routine`
--

CREATE TABLE `workout_routine` (
  `workout_id` int(11) NOT NULL,
  `trainer_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `achievement`
--
ALTER TABLE `achievement`
  ADD KEY `client_id` (`client_id`);

--
-- Indexes for table `activity`
--
ALTER TABLE `activity`
  ADD PRIMARY KEY (`Activity_id`),
  ADD KEY `goal_id` (`goal_id`),
  ADD KEY `Client_id` (`Client_id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`Admin_ID`);

--
-- Indexes for table `admin_can_change_doctor`
--
ALTER TABLE `admin_can_change_doctor`
  ADD KEY `Admin_id` (`Admin_id`),
  ADD KEY `Doctor_id` (`Doctor_id`);

--
-- Indexes for table `admin_changes_trainer`
--
ALTER TABLE `admin_changes_trainer`
  ADD KEY `Admin_id` (`Admin_id`),
  ADD KEY `Trainer_id` (`Trainer_id`);

--
-- Indexes for table `breakfast_items`
--
ALTER TABLE `breakfast_items`
  ADD KEY `diet_id` (`diet_id`);

--
-- Indexes for table `challenges`
--
ALTER TABLE `challenges`
  ADD PRIMARY KEY (`Challenge_id`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`Client_ID`),
  ADD KEY `Trainer` (`Trainer`),
  ADD KEY `Medical` (`Medical`),
  ADD KEY `Workout_id` (`Workout_id`),
  ADD KEY `doctor_id` (`doctor_id`);

--
-- Indexes for table `client_complains_to_admin`
--
ALTER TABLE `client_complains_to_admin`
  ADD KEY `admin_id` (`admin_id`),
  ADD KEY `client_id` (`client_id`);

--
-- Indexes for table `client_rates_trainer`
--
ALTER TABLE `client_rates_trainer`
  ADD KEY `client_id` (`client_id`),
  ADD KEY `trainer_id` (`trainer_id`);

--
-- Indexes for table `diet`
--
ALTER TABLE `diet`
  ADD PRIMARY KEY (`diet_id`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `trainer_id` (`trainer_id`);

--
-- Indexes for table `dinner_items`
--
ALTER TABLE `dinner_items`
  ADD KEY `diet_id` (`diet_id`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`doctor_id`);

--
-- Indexes for table `doctor_creates_med_history`
--
ALTER TABLE `doctor_creates_med_history`
  ADD KEY `doctor_id` (`doctor_id`),
  ADD KEY `Medical_hist_id` (`Medical_hist_id`);

--
-- Indexes for table `exercise`
--
ALTER TABLE `exercise`
  ADD KEY `workout_id` (`workout_id`);

--
-- Indexes for table `friendship`
--
ALTER TABLE `friendship`
  ADD KEY `client1` (`client1`),
  ADD KEY `client2` (`client2`);

--
-- Indexes for table `friend_request`
--
ALTER TABLE `friend_request`
  ADD KEY `sender_id` (`sender_id`),
  ADD KEY `receiver_id` (`receiver_id`);

--
-- Indexes for table `goal`
--
ALTER TABLE `goal`
  ADD PRIMARY KEY (`Goal_id`),
  ADD KEY `Client_id` (`Client_id`);

--
-- Indexes for table `leaderboard`
--
ALTER TABLE `leaderboard`
  ADD KEY `Challenge_id` (`Challenge_id`),
  ADD KEY `client_id` (`client_id`);

--
-- Indexes for table `lunch_items`
--
ALTER TABLE `lunch_items`
  ADD KEY `diet_id` (`diet_id`);

--
-- Indexes for table `matric`
--
ALTER TABLE `matric`
  ADD KEY `tech_id` (`tech_id`);

--
-- Indexes for table `medical_history`
--
ALTER TABLE `medical_history`
  ADD PRIMARY KEY (`medical_hist_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD KEY `client_id` (`client_id`);

--
-- Indexes for table `tracking_tech`
--
ALTER TABLE `tracking_tech`
  ADD PRIMARY KEY (`Tech_id`),
  ADD KEY `Activity_id` (`Activity_id`);

--
-- Indexes for table `trainer`
--
ALTER TABLE `trainer`
  ADD PRIMARY KEY (`Trainer_id`);

--
-- Indexes for table `trainer_submit_issue_to_doctor`
--
ALTER TABLE `trainer_submit_issue_to_doctor`
  ADD KEY `Trainer_id` (`Trainer_id`),
  ADD KEY `Doctor_id` (`Doctor_id`);

--
-- Indexes for table `workout_routine`
--
ALTER TABLE `workout_routine`
  ADD PRIMARY KEY (`workout_id`),
  ADD KEY `trainer_id` (`trainer_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity`
--
ALTER TABLE `activity`
  MODIFY `Activity_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `Admin_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `challenges`
--
ALTER TABLE `challenges`
  MODIFY `Challenge_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `Client_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `diet`
--
ALTER TABLE `diet`
  MODIFY `diet_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `doctor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `goal`
--
ALTER TABLE `goal`
  MODIFY `Goal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `medical_history`
--
ALTER TABLE `medical_history`
  MODIFY `medical_hist_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tracking_tech`
--
ALTER TABLE `tracking_tech`
  MODIFY `Tech_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trainer`
--
ALTER TABLE `trainer`
  MODIFY `Trainer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `workout_routine`
--
ALTER TABLE `workout_routine`
  MODIFY `workout_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `achievement`
--
ALTER TABLE `achievement`
  ADD CONSTRAINT `achievement_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `client` (`Client_ID`);

--
-- Constraints for table `activity`
--
ALTER TABLE `activity`
  ADD CONSTRAINT `activity_ibfk_1` FOREIGN KEY (`goal_id`) REFERENCES `goal` (`Goal_id`),
  ADD CONSTRAINT `activity_ibfk_2` FOREIGN KEY (`Client_id`) REFERENCES `client` (`Client_ID`);

--
-- Constraints for table `admin_can_change_doctor`
--
ALTER TABLE `admin_can_change_doctor`
  ADD CONSTRAINT `admin_can_change_doctor_ibfk_1` FOREIGN KEY (`Admin_id`) REFERENCES `admin` (`Admin_ID`),
  ADD CONSTRAINT `admin_can_change_doctor_ibfk_2` FOREIGN KEY (`Doctor_id`) REFERENCES `doctor` (`doctor_id`);

--
-- Constraints for table `admin_changes_trainer`
--
ALTER TABLE `admin_changes_trainer`
  ADD CONSTRAINT `admin_changes_trainer_ibfk_1` FOREIGN KEY (`Admin_id`) REFERENCES `admin` (`Admin_ID`),
  ADD CONSTRAINT `admin_changes_trainer_ibfk_2` FOREIGN KEY (`Trainer_id`) REFERENCES `doctor` (`doctor_id`);

--
-- Constraints for table `breakfast_items`
--
ALTER TABLE `breakfast_items`
  ADD CONSTRAINT `breakfast_items_ibfk_1` FOREIGN KEY (`diet_id`) REFERENCES `diet` (`diet_id`);

--
-- Constraints for table `client`
--
ALTER TABLE `client`
  ADD CONSTRAINT `client_ibfk_1` FOREIGN KEY (`Trainer`) REFERENCES `trainer` (`Trainer_id`),
  ADD CONSTRAINT `client_ibfk_2` FOREIGN KEY (`Medical`) REFERENCES `medical_history` (`medical_hist_id`),
  ADD CONSTRAINT `client_ibfk_3` FOREIGN KEY (`Workout_id`) REFERENCES `workout_routine` (`workout_id`),
  ADD CONSTRAINT `client_ibfk_4` FOREIGN KEY (`doctor_id`) REFERENCES `doctor` (`doctor_id`);

--
-- Constraints for table `client_complains_to_admin`
--
ALTER TABLE `client_complains_to_admin`
  ADD CONSTRAINT `client_complains_to_admin_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`Admin_ID`),
  ADD CONSTRAINT `client_complains_to_admin_ibfk_2` FOREIGN KEY (`client_id`) REFERENCES `client` (`Client_ID`);

--
-- Constraints for table `client_rates_trainer`
--
ALTER TABLE `client_rates_trainer`
  ADD CONSTRAINT `client_rates_trainer_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `client` (`Client_ID`),
  ADD CONSTRAINT `client_rates_trainer_ibfk_2` FOREIGN KEY (`trainer_id`) REFERENCES `trainer` (`Trainer_id`);

--
-- Constraints for table `diet`
--
ALTER TABLE `diet`
  ADD CONSTRAINT `diet_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `client` (`Client_ID`),
  ADD CONSTRAINT `diet_ibfk_2` FOREIGN KEY (`trainer_id`) REFERENCES `trainer` (`Trainer_id`);

--
-- Constraints for table `dinner_items`
--
ALTER TABLE `dinner_items`
  ADD CONSTRAINT `dinner_items_ibfk_1` FOREIGN KEY (`diet_id`) REFERENCES `diet` (`diet_id`);

--
-- Constraints for table `doctor_creates_med_history`
--
ALTER TABLE `doctor_creates_med_history`
  ADD CONSTRAINT `doctor_creates_med_history_ibfk_1` FOREIGN KEY (`doctor_id`) REFERENCES `doctor` (`doctor_id`),
  ADD CONSTRAINT `doctor_creates_med_history_ibfk_2` FOREIGN KEY (`Medical_hist_id`) REFERENCES `medical_history` (`medical_hist_id`);

--
-- Constraints for table `exercise`
--
ALTER TABLE `exercise`
  ADD CONSTRAINT `exercise_ibfk_1` FOREIGN KEY (`workout_id`) REFERENCES `workout_routine` (`workout_id`);

--
-- Constraints for table `friendship`
--
ALTER TABLE `friendship`
  ADD CONSTRAINT `friendship_ibfk_1` FOREIGN KEY (`client1`) REFERENCES `client` (`Client_ID`),
  ADD CONSTRAINT `friendship_ibfk_2` FOREIGN KEY (`client2`) REFERENCES `client` (`Client_ID`);

--
-- Constraints for table `friend_request`
--
ALTER TABLE `friend_request`
  ADD CONSTRAINT `friend_request_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `client` (`Client_ID`),
  ADD CONSTRAINT `friend_request_ibfk_2` FOREIGN KEY (`receiver_id`) REFERENCES `client` (`Client_ID`);

--
-- Constraints for table `goal`
--
ALTER TABLE `goal`
  ADD CONSTRAINT `goal_ibfk_1` FOREIGN KEY (`Client_id`) REFERENCES `client` (`Client_ID`);

--
-- Constraints for table `leaderboard`
--
ALTER TABLE `leaderboard`
  ADD CONSTRAINT `leaderboard_ibfk_1` FOREIGN KEY (`Challenge_id`) REFERENCES `challenges` (`Challenge_id`),
  ADD CONSTRAINT `leaderboard_ibfk_2` FOREIGN KEY (`client_id`) REFERENCES `client` (`Client_ID`);

--
-- Constraints for table `lunch_items`
--
ALTER TABLE `lunch_items`
  ADD CONSTRAINT `lunch_items_ibfk_1` FOREIGN KEY (`diet_id`) REFERENCES `diet` (`diet_id`);

--
-- Constraints for table `matric`
--
ALTER TABLE `matric`
  ADD CONSTRAINT `matric_ibfk_1` FOREIGN KEY (`tech_id`) REFERENCES `tracking_tech` (`Tech_id`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `client` (`Client_ID`);

--
-- Constraints for table `tracking_tech`
--
ALTER TABLE `tracking_tech`
  ADD CONSTRAINT `tracking_tech_ibfk_1` FOREIGN KEY (`Activity_id`) REFERENCES `activity` (`Activity_id`);

--
-- Constraints for table `trainer_submit_issue_to_doctor`
--
ALTER TABLE `trainer_submit_issue_to_doctor`
  ADD CONSTRAINT `trainer_submit_issue_to_doctor_ibfk_1` FOREIGN KEY (`Trainer_id`) REFERENCES `trainer` (`Trainer_id`),
  ADD CONSTRAINT `trainer_submit_issue_to_doctor_ibfk_2` FOREIGN KEY (`Doctor_id`) REFERENCES `doctor` (`doctor_id`);

--
-- Constraints for table `workout_routine`
--
ALTER TABLE `workout_routine`
  ADD CONSTRAINT `workout_routine_ibfk_1` FOREIGN KEY (`trainer_id`) REFERENCES `trainer` (`Trainer_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
