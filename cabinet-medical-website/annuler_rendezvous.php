<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Inclure le fichier de connexion à la base de données (db.php)
require_once "partials/db.php";

// Vérifier si l'ID du rendez-vous est présent dans la requête GET
if (!isset($_GET['rendezvous_id'])) {
    // Rediriger vers la page de dashboard si l'ID du rendez-vous est manquant
    header("Location: dashboard.php");
    exit;
}

// Récupérer l'ID du rendez-vous à annuler
$rendezvousId = $_GET['rendezvous_id'];

// Vérifier si l'ID du rendez-vous est valide
if (!is_numeric($rendezvousId)) {
    // Rediriger vers la page de dashboard si l'ID du rendez-vous est invalide
    header("Location: dashboard.php");
    exit;
}

// Récupérer l'ID de l'utilisateur connecté
$userId = $_SESSION['user_id'];

// Vérifier si le rendez-vous appartient à l'utilisateur connecté
$sql = "SELECT * FROM rendezvous WHERE id = '$rendezvousId' AND patient_id = '$userId'";
$result = $conn->query($sql);

if ($result->num_rows === 1) {
    // Supprimer le rendez-vous de la base de données
    $sqlDelete = "DELETE FROM rendezvous WHERE id = '$rendezvousId'";
    $conn->query($sqlDelete);
}

// Rediriger vers la page de dashboard
header("Location: dashboard.php");
exit;
?>


