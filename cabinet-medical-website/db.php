<?php
$servername = "localhost"; // Nom du serveur MySQL
$db_username = "root"; // Nom d'utilisateur MySQL
$password = ""; // Mot de passe MySQL
$dbname = "cabinet_medical"; // Nom de la base de données

// Connexion à la base de données
$conn = new mysqli($servername, $db_username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Erreur de connexion à la base de données : " . $conn->connect_error);
}
?>
