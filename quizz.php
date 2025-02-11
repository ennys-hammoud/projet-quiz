
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projet Quiz - Accueil</title>
    <link rel="stylesheet" href="quizz.CSS">
</head>
<body>

    <!-- HEADER -->
    <header>
        <div class="logo">Projet Quiz</div>
        <nav>
            <ul>
                <li><a href="#">Menu</a></li>
                <li><a href="quiz.php">Quiz</a></li>
                <li><a href="connexion.php">Connexion</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </nav>
    </header>

    <!-- SECTION D'ACCUEIL -->
    <section class="hero">
        <div class="hero-content">
            <h1>Bienvenue sur</h1><img src="quizz.jpg" alt="Logo Quiz" height="400" width="400">
            <p>Testez vos connaissances sur divers thèmes !</p>
        </div>
    </section>
    <main>
        <div class="quiz-container">
            <!-- Carte Football -->
            <div class="quiz-card" id="football">
                <h2>Football</h2>
                <p>Testez vos connaissances sur le football !</p>
                <a href="football.html" class="btn">Commencer</a>
                <br>

                <?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "quizz";
$bdd = new mysqli($servername, $username, $password, $dbname);
if ($bdd->connect_error) {
    die("Connection failed: " . $bdd->connect_error);
}
$sql = "SELECT * FROM football";
$result = $bdd->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo    $row["question"]. " - Réponse: " . "<br>";
    }
} else {
    echo "0 results";
}
$bdd->close();
?>
            </div>
            

            <!-- Carte Cuisine -->
            <div class="quiz-card" id="cuisine">
                <h2>Cuisine</h2>
                <p> la cuisine avec des quiz délicieux !</p>
                <a href="cuisine.html" class="btn">Commencer</a>
                <br>
                <?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "quizz";
$bdd = new mysqli($servername, $username, $password, $dbname);
if ($bdd->connect_error) {
    die("Connection failed: " . $bdd->connect_error);
}
$sql = "SELECT * FROM cuisine";
$result = $bdd->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo    $row["question"]. " - Réponse: " . "<br>";
    }
} else {
    echo "0 results";
}
$bdd->close();
?>
            </div>

            <!-- Carte Histoire -->
            <div class="quiz-card" id="histoire">
                <h2>Histoire</h2>
                <p>Plongez dans l'histoire et testez vos connaissances !</p>
                <a href="histoire.html" class="btn">Commencer</a>
                <br>
            <?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "quizz";
$bdd = new mysqli($servername, $username, $password, $dbname);
if ($bdd->connect_error) {
    die("Connection failed: " . $bdd->connect_error);
}
$sql = "SELECT * FROM histoire";
$result = $bdd->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo    $row["question"]. " - Réponse: " . "<br>";
    }
} else {
    echo "0 results";
}
$bdd->close();
?>
            </div>
            

            <!-- Carte Cinéma -->
            <div class="quiz-card" id="cinema">
                <h2>Cinéma</h2>
                <p>Devenez un expert en cinéma avec nos quiz !</p>
                <a href="cinema.html" class="btn">Commencer</a>
                <br>
                <?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "quizz";
$bdd = new mysqli($servername, $username, $password, $dbname);
if ($bdd->connect_error) {
    die("Connection failed: " . $bdd->connect_error);
}
$sql = "SELECT * FROM cinema";
$result = $bdd->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo    $row["question"]. " - Réponse: " . "<br>";
    }
} else {
    echo "0 results";
}
$bdd->close();
?>
            </div>
            <br>
            
            
        </div>
    </main>

    <!-- FOOTER -->
    <footer>
        <p>&copy; 2025  Quizz'APP - Tous droits réservés.</p>
    </footer>

</body>
</html>