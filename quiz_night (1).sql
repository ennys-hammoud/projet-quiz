-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : mar. 25 fév. 2025 à 14:50
-- Version du serveur : 8.0.40
-- Version de PHP : 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `quiz_night`
--

-- --------------------------------------------------------

--
-- Structure de la table `answers`
--

CREATE TABLE `answers` (
  `id` int NOT NULL,
  `question_id` int NOT NULL,
  `answer_text` varchar(255) NOT NULL,
  `is_correct` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `answers`
--

INSERT INTO `answers` (`id`, `question_id`, `answer_text`, `is_correct`) VALUES
(1, 1, 'Lionel Messi', 1),
(2, 1, 'Cristiano Ronaldo', 0),
(3, 1, 'Pelé', 0),
(7, 3, 'Vélodrome', 1),
(8, 3, 'Parc des Princes', 0),
(9, 3, 'Allianz Riviera', 0),
(10, 4, 'Parasite', 1),
(11, 4, 'Joker', 0),
(12, 4, '1917', 0),
(13, 5, 'Leonardo DiCaprio', 1),
(14, 5, 'Brad Pitt', 0),
(15, 5, 'Tom Hanks', 0),
(16, 6, 'Pirates des Caraïbes', 1),
(17, 6, 'Indiana Jones', 0),
(18, 6, 'Gladiator', 0),
(19, 7, 'Michael Jackson', 1),
(20, 7, 'Prince', 0),
(21, 7, 'Elvis Presley', 0),
(22, 8, 'Paul Van Haver', 1),
(23, 8, 'Jean-Jacques Goldman', 0),
(24, 8, 'David Guetta', 0),
(25, 9, 'Queen', 1),
(26, 9, 'The Beatles', 0),
(27, 9, 'Rolling Stones', 0),
(32, 20, '1.	Brésil', 0),
(33, 20, '2 France', 0),
(34, 20, '3 Allemagne', 0);

-- --------------------------------------------------------

--
-- Structure de la table `questions`
--

CREATE TABLE `questions` (
  `id` int NOT NULL,
  `quiz_id` int NOT NULL,
  `question_text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `questions`
--

INSERT INTO `questions` (`id`, `quiz_id`, `question_text`) VALUES
(1, 1, 'Quel joueur a remporté le plus de Ballons d\'Or ?'),
(3, 1, 'Quel est le surnom du stade de l\'OM ?'),
(4, 2, 'Quel film a remporté l\'Oscar du meilleur film en 2020 ?'),
(5, 2, 'Qui joue le rôle principal dans \"Titanic\" ?'),
(6, 2, 'Dans quel film trouve-t-on le personnage Jack Sparrow ?'),
(7, 3, 'Quel chanteur a sorti l\'album \"Thriller\" en 1982 ?'),
(8, 3, 'Quel est le vrai nom de Stromae ?'),
(9, 3, 'Quel groupe a chanté \"Bohemian Rhapsody\" ?'),
(20, 1, 'Qui a remporté la Coupe du Monde de la FIFA 2018 ?');

-- --------------------------------------------------------

--
-- Structure de la table `quizzes`
--

CREATE TABLE `quizzes` (
  `id` int NOT NULL,
  `title` varchar(100) NOT NULL,
  `category` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `quizzes`
--

INSERT INTO `quizzes` (`id`, `title`, `category`, `created_at`) VALUES
(1, 'Quiz Football', 'Football', '2025-02-12 09:06:16'),
(2, 'Quiz Cinéma', 'Cinéma', '2025-02-12 09:06:16'),
(3, 'Quiz Musique', 'Musique', '2025-02-12 09:06:16');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'raoul', '$2y$10$NVzUVUJpEbVtkwf0SQpA0uTmfrMWB2H2Cdq3Yy.KRMYqsrQukg94y '),
(2, 'ennys', '$2y$10$EQiEaqmUD7Y3wSfwjWaMSO3e4TCXJzIISu3.KBfbhisEXrB8Nf1hK');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_id` (`question_id`);

--
-- Index pour la table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quiz_id` (`quiz_id`);

--
-- Index pour la table `quizzes`
--
ALTER TABLE `quizzes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `answers`
--
ALTER TABLE `answers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT pour la table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT pour la table `quizzes`
--
ALTER TABLE `quizzes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `answers_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
