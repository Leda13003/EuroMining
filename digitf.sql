-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 05 juin 2024 à 22:34
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `digitf`
--

-- --------------------------------------------------------

--
-- Structure de la table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `total`, `created_at`) VALUES
(1, 1, 71000.00, '2024-06-05 14:40:23'),
(2, 1, 31000.00, '2024-06-05 14:43:49'),
(3, 1, 31000.00, '2024-06-05 14:44:23'),
(4, 1, 3000.00, '2024-06-05 14:48:02'),
(5, 1, 99500.00, '2024-06-05 15:00:31'),
(6, 1, 51000.00, '2024-06-05 15:38:23');

-- --------------------------------------------------------

--
-- Structure de la table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_name`, `product_price`) VALUES
(1, 1, 'NVidia RTX 4090', 1500.00),
(2, 1, 'IBelink KSMAX', 20000.00),
(3, 1, 'BitMain Hydro S21', 9500.00),
(4, 1, 'IBelink KSMAX', 20000.00),
(5, 1, 'IBelink KSMAX', 20000.00),
(6, 2, 'IBelink KSMAX', 20000.00),
(7, 2, 'BitMain Hydro S21', 9500.00),
(8, 2, 'NVidia RTX 4090', 1500.00),
(9, 3, 'NVidia RTX 4090', 1500.00),
(10, 3, 'IBelink KSMAX', 20000.00),
(11, 3, 'BitMain Hydro S21', 9500.00),
(12, 4, 'NVidia RTX 4090', 1500.00),
(13, 4, 'NVidia RTX 4090', 1500.00),
(14, 5, 'IBelink KSMAX', 20000.00),
(15, 5, 'IBelink KSMAX', 20000.00),
(16, 5, 'NVidia RTX 4090', 1500.00),
(17, 5, 'IBelink KSMAX', 20000.00),
(18, 5, 'BitMain Hydro S21', 9500.00),
(19, 5, 'BitMain Hydro S21', 9500.00),
(20, 5, 'BitMain Hydro S21', 9500.00),
(21, 5, 'BitMain Hydro S21', 9500.00),
(22, 6, 'IBelink KSMAX', 20000.00),
(23, 6, 'NVidia RTX 4090', 1500.00),
(24, 6, 'IBelink KSMAX', 20000.00),
(25, 6, 'BitMain Hydro S21', 9500.00);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES
(1, '1', 'ionita.iulian215@gmail.com', '$2y$10$.WqHgLqR943DNwO6Zpbqd.sltMT3ieKjqSCX0uDldnaj/23e1hkXe');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
