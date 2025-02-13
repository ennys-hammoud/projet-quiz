// generate_password_hash.php
<?php
// Exemple pour hacher un mot de passe
$password = '2y$10$SoWGbe54C1rRNA/SeJ12ceJrAogdZ61Y1Gr.v3LA1zsV0mD2w9FDu'; // Le mot de passe à hacher
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
echo $hashedPassword;
?>