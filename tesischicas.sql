
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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caf_person`
--

CREATE TABLE `caf_person` (
  `person_Code` int(11) NOT NULL,
  `person_Name` varchar(100) NOT NULL,
  `person_LastName` varchar(100) NOT NULL,
  `person_BirthDate` date DEFAULT NULL,
  `person_Dni` varchar(30) NOT NULL,
  `person_sex` int(11) NOT NULL COMMENT '1 masculino- 2 femenino',
  `person_Cellphone` varchar(30) DEFAULT NULL,
  `person_Email` varchar(60) DEFAULT NULL,
  `person_Photo` varchar(200) DEFAULT NULL,
  `person_State` int(11) NOT NULL,
  `person_Edad` int(11) NOT NULL,
  `person_LastName2` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `caf_person`
--

INSERT INTO `caf_person` (`person_Code`, `person_Name`, `person_LastName`, `person_BirthDate`, `person_Dni`, `person_sex`, `person_Cellphone`, `person_Email`, `person_Photo`, `person_State`, `person_Edad`, `person_LastName2`) VALUES
(1, 'admin', 'apellido1', '2017-04-19', '7777777', 1, '999999999', 'admin@gmail.com', 'admin.jpg', 1, 0, 'apellido2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caf_room`
--

CREATE TABLE `caf_room` (
  `room_Code` int(11) NOT NULL,
  `tcuarto_Codigo` int(11) NOT NULL,
  `room_Number` int(11) NOT NULL,
  `room_Floor` int(11) NOT NULL,
  `room_Size` float DEFAULT NULL,
  `room_Bath` int(11) NOT NULL,
  `room_AguaCaliente` int(11) NOT NULL,
  `room_Cable` int(11) NOT NULL,
  `room_Internet` int(11) NOT NULL,
  `room_Description` varchar(500) DEFAULT NULL,
  `room_Date` date NOT NULL,
  `room_Price` float NOT NULL,
  `room_Occupied` int(11) NOT NULL COMMENT '1ocupado 0 desocupado',
  `room_State` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caf_tcuarto`
--

CREATE TABLE `caf_tcuarto` (
  `tcuarto_Codigo` int(11) NOT NULL,
  `tcuarto_Descripcion` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caf_tenant`
--

CREATE TABLE `caf_tenant` (
  `tnt_Code` int(11) NOT NULL,
  `person_Code` int(11) NOT NULL,
  `tnt_State` int(11) NOT NULL,
  `tnt_RegistrationDate` timestamp NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
(1, 'admin', 'admin', 1, 1, '2017-05-29 05:10:55');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dom_alquiler`
--

CREATE TABLE `dom_alquiler` (
  `alquiler_Code` int(11) NOT NULL,
  `room_Code` int(11) NOT NULL,
  `alquiler_tDocumento` char(2) NOT NULL,
  `alquiler_Serie` int(11) NOT NULL,
  `alquiler_Numero` int(11) NOT NULL,
  `inquilino_Code` int(11) NOT NULL,
  `inquilino_FechaInicio` datetime NOT NULL,
  `inquilino_FechaFin` datetime NOT NULL,
  `alquiler_detalle` varchar(200) NOT NULL,
  `alquiler_SubTotal` float NOT NULL,
  `alquiler_Descuento` float NOT NULL,
  `alquiler_aumento` float NOT NULL COMMENT 'por inconvenientes',
  `alquiler_Total` float NOT NULL,
  `alquiler_pendiente` int(11) NOT NULL COMMENT '0:anulado 1 pendiente- 2 confirmado',
  `alquiler_FechaRegistro` date NOT NULL,
  `alquiler_State` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
-- Indices de la tabla `caf_tcuarto`
--
ALTER TABLE `caf_tcuarto`
  ADD PRIMARY KEY (`tcuarto_Codigo`);

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
-- Indices de la tabla `dom_alquiler`
--
ALTER TABLE `dom_alquiler`
  ADD PRIMARY KEY (`alquiler_Code`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `caf_cobros`
--
ALTER TABLE `caf_cobros`
  MODIFY `cob_Code` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `caf_person`
--
ALTER TABLE `caf_person`
  MODIFY `person_Code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `caf_room`
--
ALTER TABLE `caf_room`
  MODIFY `room_Code` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `caf_tcuarto`
--
ALTER TABLE `caf_tcuarto`
  MODIFY `tcuarto_Codigo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `caf_tenant`
--
ALTER TABLE `caf_tenant`
  MODIFY `tnt_Code` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `caf_user`
--
ALTER TABLE `caf_user`
  MODIFY `user_Code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `dom_alquiler`
--
ALTER TABLE `dom_alquiler`
  MODIFY `alquiler_Code` int(11) NOT NULL AUTO_INCREMENT;
