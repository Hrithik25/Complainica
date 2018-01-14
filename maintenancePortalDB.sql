-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 08, 2017 at 04:45 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `maintenanceportaldb`
--

-- --------------------------------------------------------

--
-- Table structure for table `complaininfo`
--

DROP TABLE IF EXISTS `complaininfo`;
CREATE TABLE `complaininfo` (
  `complainId` int(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `area` varchar(15) NOT NULL,
  `type` varchar(20) NOT NULL,
  `subject` varchar(70) NOT NULL,
  `particulars` varchar(320) NOT NULL,
  `need` varchar(15) NOT NULL,
  `date` date NOT NULL,
  `startTime` varchar(15) NOT NULL,
  `endTime` varchar(15) NOT NULL,
  `status` varchar(15) NOT NULL,
  `resolvedDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `complaininfo`
--

INSERT INTO `complaininfo` (`complainId`, `email`, `area`, `type`, `subject`, `particulars`, `need`, `date`, `startTime`, `endTime`, `status`, `resolvedDate`) VALUES
(12, 'jatin7@gmail.com', 'Hostel', 'Electrical', 'BULB', 'NOt working properly', 'Repaired', '2017-04-08', '11:00 am', '05:00 pm', 'Pending', '0000-00-00'),
(13, 'banslahimanshu@gmail.com', 'Hostel', 'Green Campus', 'Machhar', 'Yaar bahut machhar he kuchh karo.\r\nMar dalenge ye', 'NA', '2017-04-08', '05:00 pm', '02:00 am', 'Resolved', '2017-04-08'),
(14, 'banslahimanshu@gmail.com', 'Hostel', 'Green Campus', 'fdsfsdfsdffs', 'dsfsfsdfsf', 'NA', '2017-04-08', '12:00 am', '06:00 pm', 'Pending', '0000-00-00'),
(15, 'jyot@gmail.com', 'Hostel', 'Green Campus', 'abc', 'def', 'NA', '2017-04-08', '12:00 am', '06:00 pm', 'Pending', '0000-00-00'),
(16, 'banslahimanshu@gmail.com', 'Academics', 'Green Campus', 'abc', 'def', 'NA', '2017-04-08', '12:00 am', '11:00 am', 'Pending', '0000-00-00'),
(17, 'chapaniyash@gmail.com', 'Academics', 'Civil', 'ieuifuaoifuaaaaaagbg h h aaaaaahjfajghafhfgsaaaaaaaaaaaaaaaa', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 'Repaired', '2017-04-08', '12:00 am', '04:00 pm', 'Resolved', '2017-04-08');

-- --------------------------------------------------------

--
-- Table structure for table `employeeinfo`
--

DROP TABLE IF EXISTS `employeeinfo`;
CREATE TABLE `employeeinfo` (
  `email` varchar(100) NOT NULL,
  `employeeId` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `firstName` varchar(100) NOT NULL,
  `lastName` varchar(100) NOT NULL,
  `department` varchar(100) NOT NULL,
  `post` varchar(100) NOT NULL,
  `year` int(10) NOT NULL,
  `mobileNo` varchar(10) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `address` varchar(300) NOT NULL,
  `isAdmin` varchar(10) DEFAULT 'no',
  `division` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employeeinfo`
--

INSERT INTO `employeeinfo` (`email`, `employeeId`, `password`, `firstName`, `lastName`, `department`, `post`, `year`, `mobileNo`, `gender`, `address`, `isAdmin`, `division`) VALUES
('abc@gmail.com', '123', '12345678', 'abc', '', 'CSE', 'prof', 2014, '1234567890', 'male', 'mnnit', 'no', NULL),
('admin_civil@gmail.com', '1civil', 'civiladmin', 'civil', 'admin', 'Civil', 'Professor', 1990, '9087654321', 'male', 'mnnit', 'yes', 'Civil'),
('admin_electrical@gmail.com', '1electrical', 'eleadmin', 'electrical', 'admin', 'Electrical', 'Professor', 1985, '9807654321', 'male', 'mnnit', 'yes', 'Electrical'),
('admin_green@gmail.com', '1green', 'greenadmin', 'green', 'admin', 'Environmental', 'Professor', 1995, '9870654321', 'male', 'mnnit', 'yes', 'Green Campus'),
('aa@gmail.com', 'hkdsfd', '12345678', 'abcdhasg', 'hkjdhakjfs', 'hjhfksjh', 'vxmvn', 2003, '1023456789', 'female', 'jbnbm', 'no', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `studentinfo`
--

DROP TABLE IF EXISTS `studentinfo`;
CREATE TABLE `studentinfo` (
  `email` varchar(100) NOT NULL,
  `regNo` varchar(10) NOT NULL,
  `password` varchar(100) NOT NULL,
  `firstName` varchar(100) NOT NULL,
  `lastName` varchar(100) NOT NULL,
  `program` varchar(10) NOT NULL,
  `branch` int(10) NOT NULL,
  `year` int(10) NOT NULL,
  `mobileNo` varchar(10) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `hostel` varchar(20) NOT NULL,
  `roomNo` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `studentinfo`
--

INSERT INTO `studentinfo` (`email`, `regNo`, `password`, `firstName`, `lastName`, `program`, `branch`, `year`, `mobileNo`, `gender`, `hostel`, `roomNo`) VALUES
('lol@gmail.com', '20124521', 'jatinlala', 'Jatin', 'Lala', 'B.Tech', 3, 1, '7854127859', 'male', 'SVBH', '602'),
('banslahimanshu@gmail.com', '20154068', '@Aa123567', 'Himanshu', 'Bansla', 'B.Tech', 3, 2, '9457223746', 'male', 'Tagore Hostel', '4'),
('jatin7@gmail.com', '20154130', '12345678', 'Jatin', 'Tayal', 'B.Tech', 3, 1, '1238797654', 'male', 'SVBH', '12'),
('chapaniyash@gmail.com', '20154131', 'yash', 'Yash', 'Chapani', 'B.Tech', 3, 2, '8866336199', 'male', 'Tagore Hostel', '3'),
('pulkitgulati@gmail.com', '20154134', 'pulkitgulati', 'Pulkit', 'gulati', 'B.Tech', 3, 2, '9837081128', 'male', 'Tagore Hostel', '12'),
('jyot@gmail.com', '20154135', 'kool', 'Jyot', 'Mehta', 'B.Tech', 3, 2, '7235857289', 'male', 'Tagore Hostel', '3'),
('jatin@gmail.com', '20154140', 'lol', 'Jatin', 'Tayal', 'B.Tech', 3, 2, '9997580873', 'male', 'Tagore Hostel', '3'),
('abc@yahoo.com', '23551511', '12345678', 'jashjgh', 'nzklxnbnk', 'MCA', 0, 1, '9874563210', 'male', 'Raman Hostel', '45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `complaininfo`
--
ALTER TABLE `complaininfo`
  ADD PRIMARY KEY (`complainId`);

--
-- Indexes for table `employeeinfo`
--
ALTER TABLE `employeeinfo`
  ADD PRIMARY KEY (`employeeId`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `mobileNo` (`mobileNo`);

--
-- Indexes for table `studentinfo`
--
ALTER TABLE `studentinfo`
  ADD PRIMARY KEY (`regNo`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `mobileNo` (`mobileNo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `complaininfo`
--
ALTER TABLE `complaininfo`
  MODIFY `complainId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
