<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projet Quiz - Accueil</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <!-- HEADER -->
    <header>
        <div class="logo">Projet Quiz</div>
        <nav>
            <ul>
                <li><a href="#">Menu</a></li>
                <li><a href="quiz.php">Quiz</a></li>
                <li><a href="#">Connexion</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </nav>
    </header>

    <!-- SECTION D'ACCUEIL -->
    <section class="hero">
        <div class="hero-content">
            <h1>Bienvenue sur  Quizz'APP</h1>
            <p>Testez vos connaissances sur divers thèmes !</p>
            <a href="quiz.php" class="btn">Commencer un quiz</a>
        </div>
    </section>
    <main>
        <div class="quiz-container">
            <!-- Carte Football -->
            <div class="quiz-card" id="football">
                <h2>Football</h2>
                <p>Testez vos connaissances sur le football !</p>
                <a href="football.html" class="btn">Commencer</a>
            </div>

            <!-- Carte Cuisine -->
            <div class="quiz-card" id="cuisine">
                <h2>Cuisine</h2>
                <p>Explorez le monde de la cuisine avec des quiz délicieux !</p>
                <a href="cuisine.html" class="btn">Commencer</a>
            </div>

            <!-- Carte Histoire -->
            <div class="quiz-card" id="histoire">
                <h2>Histoire</h2>
                <p>Plongez dans l'histoire et testez vos connaissances !</p>
                <a href="histoire.html" class="btn">Commencer</a>
            </div>

            <!-- Carte Cinéma -->
            <div class="quiz-card" id="cinema">
                <h2>Cinéma</h2>
                <p>Devenez un expert en cinéma avec nos quiz !</p>
                <a href="cinema.html" class="btn">Commencer</a>
            </div>
        </div>
    </main>



    <!-- FOOTER -->
    <footer>
        <p>&copy; 2025  Quizz'APP - Tous droits réservés.</p>
    </footer>

</body>
</html>