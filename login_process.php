<?php
session_start();

require_once 'classes/Database.php';
require_once 'classes/User.php';

$db = new Database();
$user = new User($db);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $password = $_POST["password"];

    if ($user->login($username, $password)) {
        header("Location: admin.php");
        exit;
    } else {
        $_SESSION['login_error'] = "Identifiants incorrects.";
        header("Location: login.php");
        exit;
    }
}
?>