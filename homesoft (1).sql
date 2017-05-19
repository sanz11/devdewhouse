-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-05-2017 a las 21:46:49
-- Versión del servidor: 5.7.14
-- Versión de PHP: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `homesoft`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caf_cobros`
--

CREATE TABLE `caf_cobros` (
  `cob_Code` int(11) NOT NULL,
  `room_Code` int(11) NOT NULL,
  `cob_DatePay` date NOT NULL,
  `cob_Total` float NOT NULL,
  `cob_State` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `caf_cobros`
--

INSERT INTO `caf_cobros` (`cob_Code`, `room_Code`, `cob_DatePay`, `cob_Total`, `cob_State`) VALUES
(1, 7, '2017-03-23', 500.3, 1),
(2, 5, '2017-04-28', 508.5, 1),
(9, 7, '2017-04-27', 500.2, 1),
(10, 8, '2017-04-29', 0, 1),
(13, 4, '2017-04-29', 530.6, 1),
(14, 7, '2017-05-01', 635, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caf_floor`
--

CREATE TABLE `caf_floor` (
  `floor_Code` int(11) NOT NULL,
  `floor_Number` int(11) NOT NULL,
  `floor_Bath` int(11) NOT NULL,
  `floor_Laundry` int(11) NOT NULL,
  `floor_RoomNumbers` int(11) NOT NULL,
  `floor_Description` varchar(500) DEFAULT NULL,
  `floor_Image` varchar(300) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caf_person`
--

CREATE TABLE `caf_person` (
  `person_Code` int(11) NOT NULL,
  `person_Name` varchar(100) NOT NULL,
  `person_LastName` varchar(100) NOT NULL,
  `person_LastName2` varchar(100) NOT NULL,
  `person_BirthDate` date DEFAULT NULL,
  `person_Dni` varchar(30) NOT NULL,
  `person_sex` int(11) NOT NULL,
  `person_Cellphone` varchar(30) DEFAULT NULL,
  `person_Cellphone2` varchar(30) DEFAULT NULL,
  `person_Email` varchar(60) DEFAULT NULL,
  `person_DirectionOc` varchar(150) DEFAULT NULL,
  `person_Photo` varchar(200) DEFAULT NULL,
  `person_State` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `caf_person`
--

INSERT INTO `caf_person` (`person_Code`, `person_Name`, `person_LastName`, `person_LastName2`, `person_BirthDate`, `person_Dni`, `person_sex`, `person_Cellphone`, `person_Cellphone2`, `person_Email`, `person_DirectionOc`, `person_Photo`, `person_State`) VALUES
(1, 'Cheka', 'Apellido1', 'Apellido2', '2017-04-19', '70241454', 1, '987698', '9866565', 'cheka@gmail.com', 'sunat', '', 1),
(2, 'Abel', 'Ricra', 'Sanchez', '2017-04-19', '70241454', 1, '987698385', '', 'abel@gmai.com', 'direcc', 'admin.jpg', 1),
(3, 'Marlith', 'Huillca ', 'Moina', '2017-04-19', '70761094', 0, '973164676', '973164676', 'marlith@gmmail.com', 'casa', 'admin.jpg', 1),
(4, 'admin', 'admin1', 'admin2', '2017-04-19', '70459685', 1, '987695656', '', 'admin@gmail.com', '', 'admin.jpg', 1),
(5, 'cke', 'admin1', 'admin2', '2017-04-19', '70459685', 1, '987695656', '', 'admin@gmail.com', '', '18159548_1922516614661223_317937198_o.png', 1),
(6, 'Pedro', 'Requelme', 'Rivaz', '2017-04-19', '702418696', 1, '45465465465', '5695', '', '', 'admin.jpg', 1),
(7, 'Pedro', 'Requelme', 'Rivaz', '2017-04-19', '702418696', 1, '45465465465', '', '', '', 'admin.jpg', 1),
(8, 'Pedro', 'Requelme', 'Rivaz', '2017-04-19', '702418696', 1, '45465465465', '', '', '', 'admin.jpg', 1),
(9, 'Pedro', 'Requelme', 'Rivaz', '2017-04-19', '702418696', 1, '45465465465', '', '', '', 'admin.jpg', 1),
(10, 'Pedro', 'Requelme', 'Rivaz', '2017-04-19', '702418696', 1, '45465465465', '', '', '', 'admin.jpg', 1),
(11, 'juan', 'meneces', 'riquemas', '2017-04-19', '44546546546', 1, '78787', '', '', '', 'admin.jpg', 1),
(12, 'angela', 'lkj', 'll', '2017-04-19', '70241455', 0, '5465', '', '', '', 'admin.jpg', 1),
(13, 'juanchokk', 'ricra', 'sanchez', '2017-04-19', '8686868', 1, '9865', '', 'abel@gfmail.com', '', 'admin.jpg', 1),
(14, 'uancho', 'kjlk', 'lkj', '2017-04-19', '70244548', 1, '6846', '546', '665', '5464', 'admin.jpg', 1),
(16, '54', '654', '65', '2017-04-19', '45646', 1, '4654', '65', '465', '465', 'admin.jpg', 1),
(17, '5465', '654', '564', '2017-04-19', '46546', 0, '654', '65', '5465', '46', 'admin.jpg', 1),
(18, 'junita', 'h', 'kjh', '2017-04-19', '65564654', 0, 'kj', 'kjhk', 'kjh', 'jhk', 'admin.jpg', 1),
(25, '55', '55', '55', '2017-04-19', '75986895', 1, '55', '', '5', '', 'amigos.jpg', 1),
(19, 'Cheka', 'Apellido1', 'Apellido2', '2017-04-19', '70241454', 2, '987698', '', 'cheka@gmail.com', '', '', 1),
(20, 'Cheka', 'Apellido1', 'Apellido2', '2017-04-19', '70241454', 1, '987698', '', 'cheka@gmail.com', '', '', 1),
(21, 'Cheka', 'Apellido1', 'Apellido2', '2017-04-19', '70241454', 1, '987698', '', 'cheka@gmail.com', '', '', 1),
(22, 'Cheka', 'Apellido1', 'Apellido2', '2017-04-19', '70241454', 1, '987698', '', 'cheka@gmail.com', '', '', 1),
(23, 'Cheka', 'Apellido1', 'Apellido2', '2017-04-19', '70241454', 1, '987698', '', 'cheka@gmail.com', '', '', 1),
(24, 'Cheka', 'Apellido1', 'Apellido2', '2017-04-19', '70241454', 1, '987698', '', 'cheka@gmail.com', '', '', 1),
(26, '55', '55', '55', '2017-04-19', '75986895', 1, '55', '', '5', '', NULL, 1),
(27, '55', '55', '55', '2017-04-19', '75986895', 1, '55', '', '5', '', NULL, 1),
(28, '55', '55', '55', '2017-04-19', '75986895', 1, '55', '', '5', '', NULL, 1),
(29, 'k', 'kk', 'k', '2017-04-19', 'kk', 1, 'k', '', 'k', '', 'profe.jpg', 1),
(30, 'kl', 'kl', 'kl', '2017-04-19', 'lkll', 1, 'kl', '', 'k', '', NULL, 1),
(31, 'kjl', 'kj', 'lkj', '2017-04-19', 'kjlkj', 1, 'lkjl', '', 'kjlk', '', 'admin.jpg', 1),
(32, 'kjl', 'kj', 'lkj', '2017-04-19', 'kjlkj', 1, 'lkjl', '', 'kjlk', '', 'admin.jpg', 1),
(33, 'kjl', 'kj', 'lkj', '2017-04-19', '4564', 1, 'lkjl', '', 'kjlk', '', '15337577_714822078687512_5668816334458832210_n.jpg', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caf_room`
--

CREATE TABLE `caf_room` (
  `room_Code` int(11) NOT NULL,
  `room_Number` int(11) NOT NULL,
  `room_Floor` int(11) NOT NULL,
  `room_Size` float DEFAULT NULL,
  `room_Bath` int(11) NOT NULL,
  `room_Laundry` int(11) NOT NULL,
  `room_Cable` int(11) NOT NULL,
  `room_Internet` int(11) NOT NULL,
  `room_Floors` int(11) NOT NULL,
  `room_Description` varchar(500) DEFAULT NULL,
  `room_Date` date NOT NULL,
  `room_Price` float NOT NULL,
  `room_Occupied` int(11) NOT NULL,
  `room_State` int(11) NOT NULL,
  `room_DatePay` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `caf_room`
--

INSERT INTO `caf_room` (`room_Code`, `room_Number`, `room_Floor`, `room_Size`, `room_Bath`, `room_Laundry`, `room_Cable`, `room_Internet`, `room_Floors`, `room_Description`, `room_Date`, `room_Price`, `room_Occupied`, `room_State`, `room_DatePay`) VALUES
(1, 101, 1, 12.6, 1, 0, 1, 1, 1, 'en buen estado', '2017-03-01', 450, 0, 0, '2017-04-11'),
(2, 102, 1, 7.6, 1, 1, 1, 1, 1, 'en buen estado', '2017-04-01', 500, 1, 1, '2017-04-12'),
(3, 103, 1, 7.6, 1, 1, 1, 1, 1, 'en buen estado', '2017-05-01', 400, 0, 0, '2017-04-11'),
(4, 201, 2, 8, 1, 1, 1, 1, 1, 'en buen estado', '2017-04-08', 60, 1, 1, '2017-05-25'),
(5, 202, 2, 9, 1, 1, 1, 1, 1, 'en buen estado', '2017-04-15', 300, 1, 1, '2017-04-12'),
(6, 203, 2, 12, 1, 1, 1, 1, 1, 'en buen estado', '2017-12-05', 500, 0, 1, '2017-04-05'),
(7, 204, 2, 5, 1, 1, 1, 1, 1, 'en buen estado', '2017-06-01', 600, 1, 1, '2017-05-01'),
(8, 301, 3, 7, 1, 1, 1, 1, 2, 'en buen estado', '2017-07-01', 800, 1, 1, '0000-00-00'),
(9, 208, 2, 7.5, 1, 0, 0, 1, 1, 'con vista a la calle', '2017-04-02', 360, 0, 1, '0000-00-00'),
(10, 109, 1, 10, 1, 0, 1, 0, 2, 'en buen estado nico', '2017-04-02', 150, 0, 1, '2017-04-06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caf_tenant`
--

CREATE TABLE `caf_tenant` (
  `tnt_Code` int(11) NOT NULL,
  `person_Code` int(11) NOT NULL,
  `room_Code` int(11) NOT NULL,
  `tnt_State` int(11) NOT NULL,
  `tnt_RegistrationDate` timestamp NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `caf_tenant`
--

INSERT INTO `caf_tenant` (`tnt_Code`, `person_Code`, `room_Code`, `tnt_State`, `tnt_RegistrationDate`) VALUES
(1, 2, 8, 0, '2017-04-10 01:55:17'),
(2, 3, 7, 1, '2017-04-11 10:16:03'),
(3, 6, 4, 0, '2017-04-14 20:40:51'),
(4, 7, 4, 0, '2017-04-14 20:41:13'),
(5, 10, 4, 0, '2017-04-14 20:45:56'),
(6, 11, 8, 0, '2017-04-14 20:48:19'),
(7, 12, 8, 1, '2017-04-14 20:50:12'),
(8, 13, 7, 1, '2017-04-17 04:39:51'),
(9, 14, 4, 1, '2017-04-19 21:10:24'),
(10, 16, 4, 1, '2017-04-19 21:17:07'),
(11, 17, 2, 1, '2017-04-19 21:48:59'),
(12, 18, 5, 1, '2017-04-19 21:49:46');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caf_user`
--

CREATE TABLE `caf_user` (
  `user_Code` int(11) NOT NULL,
  `user_User` varchar(50) NOT NULL,
  `user_Password` varchar(8) NOT NULL,
  `person_Code` int(11) NOT NULL,
  `user_State` int(11) NOT NULL,
  `user_RegistrationDate` timestamp NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `caf_user`
--

INSERT INTO `caf_user` (`user_Code`, `user_User`, `user_Password`, `person_Code`, `user_State`, `user_RegistrationDate`) VALUES
(1, 'cheka', '1234', 1, 1, '2017-03-26 06:44:58'),
(2, 'admin', 'admin', 5, 1, '2017-04-13 23:57:24'),
(3, 'abel', '1234', 25, 1, '2017-04-28 12:41:26'),
(4, 'abello', '123', 27, 1, '2017-04-28 12:42:43'),
(5, '5', '5', 29, 1, '2017-04-28 18:42:49'),
(6, 'l', 'l', 30, 1, '2017-04-29 00:44:46'),
(7, 'lklLKÑLKñ', 'klñk', 31, 1, '2017-04-29 01:23:51'),
(8, 'jjf', 'klñk', 33, 1, '2017-04-29 01:24:28');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `caf_cobros`
--
ALTER TABLE `caf_cobros`
  ADD PRIMARY KEY (`cob_Code`);

--
-- Indices de la tabla `caf_person`
--
ALTER TABLE `caf_person`
  ADD PRIMARY KEY (`person_Code`);

--
-- Indices de la tabla `caf_room`
--
ALTER TABLE `caf_room`
  ADD PRIMARY KEY (`room_Code`),
  ADD UNIQUE KEY `room_Number` (`room_Number`);

--
-- Indices de la tabla `caf_tenant`
--
ALTER TABLE `caf_tenant`
  ADD PRIMARY KEY (`tnt_Code`);

--
-- Indices de la tabla `caf_user`
--
ALTER TABLE `caf_user`
  ADD PRIMARY KEY (`user_Code`),
  ADD UNIQUE KEY `user_User` (`user_User`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `caf_cobros`
--
ALTER TABLE `caf_cobros`
  MODIFY `cob_Code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT de la tabla `caf_person`
--
ALTER TABLE `caf_person`
  MODIFY `person_Code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT de la tabla `caf_room`
--
ALTER TABLE `caf_room`
  MODIFY `room_Code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `caf_tenant`
--
ALTER TABLE `caf_tenant`
  MODIFY `tnt_Code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `caf_user`
--
ALTER TABLE `caf_user`
  MODIFY `user_Code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
