-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 04-Out-2023 às 14:29
-- Versão do servidor: 10.1.38-MariaDB
-- versão do PHP: 7.1.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ctw`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `car`
--

CREATE TABLE `car` (
  `car_id` int(11) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `seats` int(11) NOT NULL,
  `licensePlate` varchar(20) NOT NULL,
  `engineType` enum('COMBUSTION','ELECTRIC','HYBRID') NOT NULL,
  `currentAutonomy` int(11) DEFAULT NULL,
  `image` blob
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `car`
--

INSERT INTO `car` (`car_id`, `brand`, `model`, `seats`, `licensePlate`, `engineType`, `currentAutonomy`, `image`) VALUES
(1, 'Toyota', 'Glanza', 4, 'EU', 'COMBUSTION', 30, 0x75706c6f6164732f546f796f74612d476c616e7a612e6a7067),
(2, 'Toyota', 'Etios Liva', 4, 'CZ', 'HYBRID', 50, 0x75706c6f6164732f546f796f74615f4574696f732e6a7067),
(4, 'Toyota', 'Yaris', 4, 'CZ', 'COMBUSTION', 40, 0x75706c6f6164732f746f796f74612079617269732e6a7067),
(5, 'Toyota', 'Yaris', 4, 'FR', 'COMBUSTION', 60, 0x75706c6f6164732f746f796f74612079617269732e6a7067),
(6, 'Toyota', 'Yaris', 4, 'PL', 'COMBUSTION', 30, 0x75706c6f6164732f746f796f74612079617269732e6a7067);

-- --------------------------------------------------------

--
-- Estrutura da tabela `driver`
--

CREATE TABLE `driver` (
  `driver_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `licenseNumber` varchar(20) NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `reservation`
--

CREATE TABLE `reservation` (
  `reservation_id` int(11) NOT NULL,
  `pickupDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `dropOffDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `car_id` int(11) DEFAULT NULL,
  `driver_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `reservation`
--

INSERT INTO `reservation` (`reservation_id`, `pickupDate`, `dropOffDate`, `car_id`, `driver_id`, `user_id`) VALUES
(1, '2023-10-02 16:29:00', '2023-10-03 16:29:00', 1, NULL, NULL),
(2, '2023-10-03 09:25:00', '2023-10-05 09:25:00', 1, NULL, NULL),
(3, '2023-10-03 10:17:00', '2023-10-08 10:17:00', 1, NULL, NULL),
(4, '2023-10-03 10:18:00', '2023-10-04 10:18:00', 1, NULL, NULL),
(5, '2023-10-01 10:26:00', '2023-10-06 06:26:00', 1, NULL, NULL),
(6, '2023-10-03 11:18:00', '2023-10-03 16:18:00', 1, NULL, NULL),
(7, '2023-10-03 11:39:00', '2023-10-04 11:39:00', 1, NULL, NULL),
(8, '2023-10-03 11:41:00', '2023-10-04 11:41:00', 2, NULL, NULL),
(9, '2023-10-03 11:43:00', '2023-10-05 11:43:00', 2, NULL, NULL),
(10, '2023-10-04 02:24:00', '2023-10-05 02:24:00', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `car`
--
ALTER TABLE `car`
  ADD PRIMARY KEY (`car_id`);

--
-- Indexes for table `driver`
--
ALTER TABLE `driver`
  ADD PRIMARY KEY (`driver_id`),
  ADD KEY `driver_ibfk_1` (`user_id`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`reservation_id`),
  ADD KEY `car_id` (`car_id`),
  ADD KEY `driver_id` (`driver_id`),
  ADD KEY `reservation_ibfk_3` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `car`
--
ALTER TABLE `car`
  MODIFY `car_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `driver`
--
ALTER TABLE `driver`
  MODIFY `driver_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `reservation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `driver`
--
ALTER TABLE `driver`
  ADD CONSTRAINT `driver_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Limitadores para a tabela `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`car_id`) REFERENCES `car` (`car_id`),
  ADD CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`driver_id`) REFERENCES `driver` (`driver_id`),
  ADD CONSTRAINT `reservation_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
