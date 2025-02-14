<!-- header.php -->
<header>
    <h1>Quizz'APP</h1>
    <!-- Navbar -->
    <nav>
        <ul>
            <li><a href="index.php">Accueil</a></li>
            <li><a href="quiz.php">Quiz</a></li>
            <?php if (isset($_SESSION['user_id'])): ?>
                <li><a href="admin.php">Admin</a></li>
                <li><a href="logout.php">Déconnexion</a></li>
            <?php else: ?>
                <li><a href="login.php">Connexion</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>