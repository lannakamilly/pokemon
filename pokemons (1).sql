-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 29-Jul-2025 às 16:28
-- Versão do servidor: 10.4.27-MariaDB
-- versão do PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `pokemons_db`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `pokemons`
--

CREATE TABLE `pokemons` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `localizacao` varchar(150) DEFAULT NULL,
  `data_registro` date NOT NULL,
  `hp` int(11) DEFAULT NULL,
  `ataque` int(11) DEFAULT NULL,
  `defesa` int(11) DEFAULT NULL,
  `observacoes` text DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `pokemons`
--

INSERT INTO `pokemons` (`id`, `nome`, `tipo`, `localizacao`, `data_registro`, `hp`, `ataque`, `defesa`, `observacoes`, `foto`) VALUES
(3, 'pikachu', 'Elétrico', 'parks', '2025-07-01', 234, 2345, 333, '432', 'uploads/bf953419d76bf747cba69b55e6e03957.jpg'),
(4, 'Greninja', 'Água', 'Kalos region', '2025-07-30', 72, 7, 6, ' Borrifada de Lama', 'uploads/images.png'),
(5, 'Charmander', 'Fogo', 'cidade', '2025-07-28', 43, 100, 300, 'Ember, Scratch, Growl, Smokescreen, Dragon Rage, Scary Face, Fire Fang, Flame Burst, Slash, Flamethrower, e Fire Spin', 'uploads/Charmander_AG_anime.webp');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `pokemons`
--
ALTER TABLE `pokemons`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `pokemons`
--
ALTER TABLE `pokemons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
