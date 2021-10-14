-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--


SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "-03:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `libreria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para las tablas
--
CREATE TABLE `genero` (
  `id_genero` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `libro` (
  `id_libro` int(11) NOT NULL,
  `titulo` varchar(50) NOT NULL,
  `sinopsis` varchar(200) NOT NULL,
  `cant_pag` int NOT NULL,
  `id_genero` int(11) NOT NULL 
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `pass` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos
--

INSERT INTO `genero` (`id_genero`, `nombre`) VALUES
(1, 'Terror'),
(2, 'Suspenso'),
(3, 'Romance');

INSERT INTO `libro` (`id_libro`, `titulo`, `sinopsis`, `cant_pag`, `id_genero`) VALUES
(1, 'Battle Royal', 'Un grupo de estudiantes son arrojados a un campo de combate para que se asesinen entre ellos', 300, 1),
(2, 'La Niña que Soñaba con un Cerillo y un Bidón de Gasolina', 'Una genio es recluida en un hospital psiquiátrico y queda a cargo de su padre. Ella deberá escapar antes de que sea demasiado tarde', 1200, 2),
(3, 'Crepúsculo', 'Una adolescente se enamora de un vampiro', 500, 3);

INSERT INTO `usuario` (`id_usuario`, `email`, `pass`) VALUES
(1, 'admin@web2.com', '$2y$10$wFO3LGHuNpv6RPKPXASmI..fgim4JtaD2IfUYSbadkHRWrtlRF./m');


--
-- Índices para tablas volcadas
--

ALTER TABLE `libro`
  ADD PRIMARY KEY (`id_libro`),
  ADD UNIQUE KEY `id_libro` (`id_libro`);

ALTER TABLE `genero`
  ADD PRIMARY KEY (`id_genero`),
  ADD UNIQUE KEY `id_genero` (`id_genero`);

ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `id_usuario` (`id_usuario`);




--
-- AUTO_INCREMENT de las tablas volcadas
--


ALTER TABLE `libro`
  MODIFY `id_libro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `genero`
  MODIFY `id_genero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `libro`
  ADD CONSTRAINT `libro_idfk1` FOREIGN KEY (`id_genero`) REFERENCES `genero` (`id_genero`);

  COMMIT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


