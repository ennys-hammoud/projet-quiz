<?php
session_start();
require_once __DIR__ . '/Config/Database.php';
require_once 'classes/User.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $db = new Database();
    $user = new User($db);

    // Vérifier l'utilisateur
    if ($user->login($username, $password)) {
        // Vérifier si l'utilisateur est autorisé à accéder à l'admin
        if ($username == "ennys" || $username == "raoul") {
            $_SESSION['username'] = $username;
            header('Location: admin.php');  // Rediriger vers admin
            exit;
        } else {
            // Si l'utilisateur n'est pas "ennys" ou "raoul", déconnexion et message d'erreur
            session_unset();
            session_destroy();
            $_SESSION['login_error'] = 'Vous n\'êtes pas autorisé à accéder à l\'administration.';
            header('Location: login.php');  // Rediriger vers login avec message d'erreur
            exit;
        }
    } else {
        $_SESSION['login_error'] = 'Identifiants incorrects';
        header('Location: login.php');  // Rediriger vers login si échec
        exit;
    }
}