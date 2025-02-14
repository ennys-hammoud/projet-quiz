<?php
session_start();
session_unset();  // Effacer toutes les variables de session
session_destroy();  // Détruire la session
header("Location: login.php");  // Rediriger vers la page de connexion
exit;
?>