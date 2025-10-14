-- --------------------------------------------------------
-- Database: `login`
-- --------------------------------------------------------

CREATE DATABASE IF NOT EXISTS `login` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `login`;

-- --------------------------------------------------------
-- Tabelstructuur voor tabel `user`
-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `user` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `gebruikersnaam` VARCHAR(50) NOT NULL UNIQUE,
  `wachtwoord` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- Voorbeeldgegevens (optioneel)
-- --------------------------------------------------------

INSERT INTO `user` (`gebruikersnaam`, `wachtwoord`) VALUES
('test1', '$2y$10$5imA2LbpDkaJ4K89xQ1jweO.xE0u5FNdsfrpUKFv7VIZvA74flNum');
