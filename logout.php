<?php
session_start(); // Démarrer la session

// Supprimer toutes les variables de session
session_unset();

// Détruire la session
session_destroy();

// Redirection vers la page de connexion après la déconnexion
header("Location: login.php");
exit;
?>