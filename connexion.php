<html>
<head>
    <title>Connexion</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="quizz.css">
</head>
<body>
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
    </header><br><br><br>

<section class="co">
    <div class="formulaire">
        <form method="post" action="connexion.php">
            <label for="pseudo">Pseudo</label>
            <input type="text" name="pseudo" id="pseudo" autocomplete="off">
            <label for="mdp">Mot de passe</label>
            <input type="password" name="mdp" id="mdp" autocomplete="off">
            <input type="submit" value="Se connecter">
        </form>
    </div>
    <?php
        session_start();
        $bdd = new PDO('mysql:host=localhost;dbname=quizz', 'root', '');
        if(isset($_POST['pseudo']) && isset($_POST['mdp'])){
            $pseudo = htmlspecialchars($_POST['pseudo']);
            $mdp = htmlspecialchars($_POST['mdp']);

            $req = $bdd->prepare('SELECT * FROM connexion WHERE pseudo = ? AND mdp = ?');
            $req->execute(array($pseudo, $mdp));
            $resultat = $req->fetch();
            
            if(!$resultat){
                echo 'Mauvais identifiant ou mot de passe !';
            }else{
                $_SESSION['id'] = $resultat['id'];
                $_SESSION['pseudo'] = $pseudo;
                echo 'Vous êtes connecté !';
                header('Location: quizz.php');
            }
        }
        ?>
</section><br><br><br>
<footer>
        <p>&copy; 2025  Quizz'APP - Tous droits réservés.</p>
    </footer>
</body>
</html>