<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projet Quiz - Accueil</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <!-- HEADER -->
    <header>
        <div class="logo">Projet Quiz</div>
        <nav>
            <ul>
                <li><a href="connexion.php">Connexion</a></li>
            </ul>
        </nav>
    </header>

    <!-- SECTION D'ACCUEIL -->
    <section class="hero">
        <div class="hero-content">
            <h1>Bienvenue sur</h1>
            <img src="quizz.png" alt="Logo Quiz" height="400" width="400">
            <p>Testez vos connaissances sur divers thèmes !</p>
        </div>
    </section>

    <main>
        <div class="quiz-container">

            <!-- Carte Football -->
            <div class="quiz-card">
                <h2>Football</h2>
                <p>Testez vos connaissances sur le football !</p>
                <a href="quiz.php?id=football" class="btn">Commencer</a>
            </div>

            <!-- Carte Cuisine -->
            <div class="quiz-card">
                <h2>Cuisine</h2>
                <p>La cuisine avec des quiz délicieux !</p>
                <a href="quiz.php?id=cuisine" class="btn">Commencer</a>
            </div>

            <!-- Carte Histoire -->
            <div class="quiz-card">
                <h2>Histoire</h2>
                <p>Plongez dans l'histoire et testez vos connaissances !</p>
                <a href="quiz.php?id=histoire" class="btn">Commencer</a>
            </div>

            <!-- Carte Cinéma -->
            <div class="quiz-card">
                <h2>Cinéma</h2>
                <p>Devenez un expert en cinéma avec nos quiz !</p>
                <a href="quiz.php?id=cinema" class="btn">Commencer</a>
            </div>
            <!-- nouveau -->
            <div class="quiz-card">
                <h2>nouveau</h2>
                <p>Devenez un expert en cinéma avec nos quiz !</p>
                <a href="quiz.php?id=nouveau" class="btn">Commencer</a>
            </div>

        </div>
    </main>

    <!-- FOOTER -->
    <footer>
        <p>&copy; 2025 Quizz'APP - Tous droits réservés.</p>
    </footer>

</body>
</html>
