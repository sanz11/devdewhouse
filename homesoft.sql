-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-05-2017 a las 23:38:32
-- Versión del servidor: 5.6.17
-- Versión de PHP: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `homesoft`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caf_cobros`
--

CREATE TABLE IF NOT EXISTS `caf_cobros` (
  `cob_Code` int(11) NOT NULL AUTO_INCREMENT,
  `room_Code` int(11) NOT NULL,
  `cob_DatePay` date NOT NULL,
  `cob_Total` float NOT NULL,
  `cob_State` int(11) NOT NULL,
  PRIMARY KEY (`cob_Code`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Volcado de datos para la tabla `caf_cobros`
--

INSERT INTO `caf_cobros` (`cob_Code`, `room_Code`, `cob_DatePay`, `cob_Total`, `cob_State`) VALUES
(1, 7, '2017-03-23', 500.3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caf_floor`
--

CREATE TABLE IF NOT EXISTS `caf_floor` (
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

CREATE TABLE IF NOT EXISTS `caf_person` (
  `person_Code` int(11) NOT NULL AUTO_INCREMENT,
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
  `person_State` int(11) NOT NULL,
  PRIMARY KEY (`person_Code`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=69 ;

--
-- Volcado de datos para la tabla `caf_person`
--

INSERT INTO `caf_person` (`person_Code`, `person_Name`, `person_LastName`, `person_LastName2`, `person_BirthDate`, `person_Dni`, `person_sex`, `person_Cellphone`, `person_Cellphone2`, `person_Email`, `person_DirectionOc`, `person_Photo`, `person_State`) VALUES
(1, 'Cheka', 'Apellido1', 'Apellido2', '2017-04-19', '70241454', 1, '987698', '9866565', 'cheka@gmail.com', 'sunat', '', 1),
(2, 'Abel', 'Ricra', 'Sanchez', '2017-04-19', '70241454', 1, '987698385', '', 'abel@gmai.com', 'direcc', 'admin.jpg', 1),
(63, 'sa', 'sa', 'sa', NULL, '70241454', 0, '23', NULL, NULL, NULL, NULL, 1),
(64, 'sa', 'sa', 'sa', NULL, '70241454', 0, '23', NULL, NULL, NULL, NULL, 1),
(65, 'saw', 'saw', 'saw', NULL, '70241454', 0, '8654', NULL, NULL, NULL, NULL, 1),
(66, 'dian', 'dnia', 'dina', '2017-04-19', '98', 2, '987', '', 'dinaa@gmail.com', '', 'pagina.PNG', 1),
(67, 'mari', 'maria', 'maria', '2017-04-19', '9823456', 1, '987123', NULL, NULL, NULL, NULL, 1),
(68, 'diana', 'sana', 'easeu', NULL, '9876', 2, '865433', NULL, NULL, NULL, NULL, 1),
(49, 'marlith', 'huill', 'moina', NULL, '70241454', 0, '987654', NULL, NULL, NULL, NULL, 1),
(48, 'hola', 'sara', 'sar', NULL, '70241454', 1, '776', NULL, NULL, NULL, NULL, 1),
(47, 'hola', 'sara', 'sar', NULL, '70241454', 1, '776', NULL, NULL, NULL, NULL, 1),
(46, 'sara', 'ara', 'ar', NULL, '70241454', 1, '765', NULL, NULL, NULL, NULL, 1),
(34, 'admin', 'admin', 'admin', '2017-04-19', '12345', 1, '12345', '', 'admin@gmil.com', '', 'phono.png', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caf_room`
--

CREATE TABLE IF NOT EXISTS `caf_room` (
  `room_Code` int(11) NOT NULL AUTO_INCREMENT,
  `room_Number` int(11) NOT NULL,
  `room_Floor` int(11) NOT NULL,
  `room_Size` float DEFAULT NULL,
  `room_Bath` int(11) NOT NULL,
  `room_Laundry` int(11) NOT NULL,
  `room_Cable` int(11) NOT NULL,
  `room_Internet` int(11) NOT NULL,
  `room_Description` varchar(500) DEFAULT NULL,
  `room_Date` date NOT NULL,
  `room_Price` float NOT NULL,
  `room_Occupied` int(11) NOT NULL,
  `room_State` int(11) NOT NULL,
  `room_DatePay` date DEFAULT NULL,
  PRIMARY KEY (`room_Code`),
  UNIQUE KEY `room_Number` (`room_Number`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Volcado de datos para la tabla `caf_room`
--

INSERT INTO `caf_room` (`room_Code`, `room_Number`, `room_Floor`, `room_Size`, `room_Bath`, `room_Laundry`, `room_Cable`, `room_Internet`, `room_Description`, `room_Date`, `room_Price`, `room_Occupied`, `room_State`, `room_DatePay`) VALUES
(9, 208, 2, 7.5, 1, 0, 0, 1, 'con vista a la calle', '2017-04-02', 360, 0, 1, '0000-00-00'),
(10, 109, 1, 10, 1, 0, 1, 0, 'en buen estado nico', '2017-04-02', 150, 0, 1, '2017-04-06'),
(11, 0, 0, 0, 1, 1, 1, 1, '', '0000-00-00', 0, 0, 1, '0000-00-00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caf_tenant`
--

CREATE TABLE IF NOT EXISTS `caf_tenant` (
  `tnt_Code` int(11) NOT NULL AUTO_INCREMENT,
  `person_Code` int(11) NOT NULL,
  `room_Code` int(11) NOT NULL,
  `tnt_State` int(11) NOT NULL,
  `tnt_RegistrationDate` timestamp NOT NULL,
  PRIMARY KEY (`tnt_Code`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Volcado de datos para la tabla `caf_tenant`
--

INSERT INTO `caf_tenant` (`tnt_Code`, `person_Code`, `room_Code`, `tnt_State`, `tnt_RegistrationDate`) VALUES
(14, 68, 0, 1, '2017-05-20 15:54:59'),
(13, 67, 0, 1, '2017-05-19 16:23:59');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caf_user`
--

CREATE TABLE IF NOT EXISTS `caf_user` (
  `user_Code` int(11) NOT NULL AUTO_INCREMENT,
  `user_User` varchar(50) NOT NULL,
  `user_Password` varchar(8) NOT NULL,
  `person_Code` int(11) NOT NULL,
  `user_State` int(11) NOT NULL,
  `user_RegistrationDate` timestamp NOT NULL,
  PRIMARY KEY (`user_Code`),
  UNIQUE KEY `user_User` (`user_User`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Volcado de datos para la tabla `caf_user`
--

INSERT INTO `caf_user` (`user_Code`, `user_User`, `user_Password`, `person_Code`, `user_State`, `user_RegistrationDate`) VALUES
(1, 'chk', '1234', 1, 1, '2017-03-26 06:44:58'),
(9, 'admin', 'admin', 34, 1, '2017-05-15 21:53:39'),
(10, 'dian', 'dian', 66, 1, '2017-05-19 15:48:14'),
(8, 'jjf', 'klñk', 33, 1, '2017-04-29 01:24:28');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
