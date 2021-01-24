-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 09, 2016 at 05:30 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 7.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `imagespeak`
--

CREATE TABLE `imagespeak` (
  `id` int(11) NOT NULL,
  `prepare_time` int(11) NOT NULL,
  `recording_time` int(11) NOT NULL,
  `file_name` text NOT NULL,
  `file_ext` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `imagespeak`
--

INSERT INTO `imagespeak` (`id`, `prepare_time`, `recording_time`, `file_name`, `file_ext`) VALUES
(1, 5, 5, 'imagespeak', 'jpg'),
(2, 7, 7, 'imagespeak2', 'jpg');

-- --------------------------------------------------------

--
-- Table structure for table `imagespeakanswer`
--

CREATE TABLE `imagespeakanswer` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `type` text NOT NULL,
  `questionid` text NOT NULL,
  `answer` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `imagespeakanswer`
--

INSERT INTO `imagespeakanswer` (`id`, `username`, `type`, `questionid`, `answer`) VALUES
(1, 'demo', 'intro', '1', 'myphpuploaders/clientuploads/imagespeak/demo-2016-07-09-16-52-51.wav'),
(2, 'demo', 'intro', '2', 'myphpuploaders/clientuploads/imagespeak/demo-2016-07-09-16-53-32.wav');

-- --------------------------------------------------------

--
-- Table structure for table `intro`
--

CREATE TABLE `intro` (
  `id` int(11) NOT NULL,
  `prepare_time` text NOT NULL,
  `recording_time` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `intro`
--

INSERT INTO `intro` (`id`, `prepare_time`, `recording_time`) VALUES
(1, '5', '15'),
(2, '7', '7');

-- --------------------------------------------------------

--
-- Table structure for table `introanswer`
--

CREATE TABLE `introanswer` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `type` text NOT NULL,
  `answer` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `readaloud`
--

CREATE TABLE `readaloud` (
  `id` int(11) NOT NULL,
  `prepare_time` int(11) NOT NULL,
  `file_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `readaloud`
--

INSERT INTO `readaloud` (`id`, `prepare_time`, `file_name`) VALUES
(1, 5, 'readaloud'),
(2, 7, 'readaloud2');

-- --------------------------------------------------------

--
-- Table structure for table `readaloudanswer`
--

CREATE TABLE `readaloudanswer` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `type` text NOT NULL,
  `questionid` text NOT NULL,
  `answer` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `repeatsentence`
--

CREATE TABLE `repeatsentence` (
  `id` int(11) NOT NULL,
  `prepare_time` int(11) NOT NULL,
  `recording_time` int(11) NOT NULL,
  `file_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `repeatsentence`
--

INSERT INTO `repeatsentence` (`id`, `prepare_time`, `recording_time`, `file_name`) VALUES
(1, 5, 5, 'repeatsentence'),
(2, 7, 7, 'repeatsentence2');

-- --------------------------------------------------------

--
-- Table structure for table `repeatsentenceanswer`
--

CREATE TABLE `repeatsentenceanswer` (
  `id` int(11) NOT NULL,
  `Username` text NOT NULL,
  `type` text NOT NULL,
  `questionid` text NOT NULL,
  `answer` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `retelllecture`
--

CREATE TABLE `retelllecture` (
  `id` int(11) NOT NULL,
  `prepare_time` int(11) NOT NULL,
  `recording_time` int(11) NOT NULL,
  `audiofile_name` text NOT NULL,
  `imagefile_name` text NOT NULL,
  `imagefile_ext` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `retelllecture`
--

INSERT INTO `retelllecture` (`id`, `prepare_time`, `recording_time`, `audiofile_name`, `imagefile_name`, `imagefile_ext`) VALUES
(1, 5, 5, 'retelllecture', 'retelllecture', 'jpg'),
(2, 7, 7, 'retelllecture2', 'retelllecture2', 'jpg');

-- --------------------------------------------------------

--
-- Table structure for table `retelllectureanswer`
--

CREATE TABLE `retelllectureanswer` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `type` text NOT NULL,
  `questionid` text NOT NULL,
  `answer` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `shortanswer`
--

CREATE TABLE `shortanswer` (
  `id` int(11) NOT NULL,
  `prepare_time` int(11) NOT NULL,
  `recording_time` int(11) NOT NULL,
  `audiofile_name` text NOT NULL,
  `imagefile_name` text NOT NULL,
  `imagefile_ext` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shortanswer`
--

INSERT INTO `shortanswer` (`id`, `prepare_time`, `recording_time`, `audiofile_name`, `imagefile_name`, `imagefile_ext`) VALUES
(1, 5, 5, 'answershortquestion', 'answershortquestion', 'jpg'),
(2, 7, 7, 'answershortquestion2', 'answershortquestion2', 'jpg');

-- --------------------------------------------------------

--
-- Table structure for table `shortansweranswer`
--

CREATE TABLE `shortansweranswer` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `type` text NOT NULL,
  `questionid` text NOT NULL,
  `answer` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `Username` text NOT NULL,
  `Password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `Username`, `Password`) VALUES
(1, 'admin', 'pass123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `imagespeak`
--
ALTER TABLE `imagespeak`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `imagespeakanswer`
--
ALTER TABLE `imagespeakanswer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `intro`
--
ALTER TABLE `intro`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `introanswer`
--
ALTER TABLE `introanswer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `readaloud`
--
ALTER TABLE `readaloud`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `readaloudanswer`
--
ALTER TABLE `readaloudanswer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `repeatsentence`
--
ALTER TABLE `repeatsentence`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `repeatsentenceanswer`
--
ALTER TABLE `repeatsentenceanswer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `retelllecture`
--
ALTER TABLE `retelllecture`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `retelllectureanswer`
--
ALTER TABLE `retelllectureanswer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shortanswer`
--
ALTER TABLE `shortanswer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shortansweranswer`
--
ALTER TABLE `shortansweranswer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `imagespeak`
--
ALTER TABLE `imagespeak`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `imagespeakanswer`
--
ALTER TABLE `imagespeakanswer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `intro`
--
ALTER TABLE `intro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `introanswer`
--
ALTER TABLE `introanswer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `readaloud`
--
ALTER TABLE `readaloud`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `readaloudanswer`
--
ALTER TABLE `readaloudanswer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `repeatsentence`
--
ALTER TABLE `repeatsentence`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `repeatsentenceanswer`
--
ALTER TABLE `repeatsentenceanswer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `retelllecture`
--
ALTER TABLE `retelllecture`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `retelllectureanswer`
--
ALTER TABLE `retelllectureanswer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `shortanswer`
--
ALTER TABLE `shortanswer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `shortansweranswer`
--
ALTER TABLE `shortansweranswer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
