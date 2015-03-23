
CREATE TABLE IF NOT EXISTS `estudiantes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_grado` int(10) unsigned NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `ci` varchar(12) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_grado` (`id_grado`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `grados` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `grado` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;


INSERT INTO `grados` (`id`, `grado`) VALUES
(1, 'Primer grado'),
(2, 'Segundo grado'),
(3, 'Tercer grado'),
(4, 'Cuarto grado'),
(5, 'Quinto grado'),
(6, 'Sexto grado');

CREATE TABLE IF NOT EXISTS `maestros` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_grado` int(10) unsigned NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `ci` varchar(12) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_grado_2` (`id_grado`),
  KEY `id_grado` (`id_grado`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;



CREATE TABLE IF NOT EXISTS `materias` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_grado` int(10) unsigned NOT NULL,
  `nombre` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_grado` (`id_grado`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;



CREATE TABLE IF NOT EXISTS `notas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_estudiante` int(10) unsigned NOT NULL,
  `id_materia` int(10) unsigned NOT NULL,
  `nota` float unsigned NOT NULL,
  `peso` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_estudiante` (`id_estudiante`,`id_materia`),
  KEY `id_materia` (`id_materia`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `promedios` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_estudiante` int(10) unsigned NOT NULL,
  `np` float unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_estudiante` (`id_estudiante`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


ALTER TABLE `estudiantes`
  ADD CONSTRAINT `estudiantes_ibfk_1` FOREIGN KEY (`id_grado`) REFERENCES `grados` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;


ALTER TABLE `maestros`
  ADD CONSTRAINT `maestros_ibfk_1` FOREIGN KEY (`id_grado`) REFERENCES `grados` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;


ALTER TABLE `materias`
  ADD CONSTRAINT `materias_ibfk_1` FOREIGN KEY (`id_grado`) REFERENCES `grados` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;


ALTER TABLE `notas`
  ADD CONSTRAINT `notas_ibfk_2` FOREIGN KEY (`id_materia`) REFERENCES `materias` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `notas_ibfk_1` FOREIGN KEY (`id_estudiante`) REFERENCES `estudiantes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;


ALTER TABLE `promedios`
  ADD CONSTRAINT `promedios_ibfk_1` FOREIGN KEY (`id_estudiante`) REFERENCES `estudiantes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

