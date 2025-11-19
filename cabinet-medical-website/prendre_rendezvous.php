<?php
session_start();

// Vérifier si l'utilisateur est connecté, rediriger vers la page de connexion si ce n'est pas le cas
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Remplacez "login.php" par la page de connexion de votre site
    exit;
}

// Inclure le fichier de connexion à la base de données (db.php)
require_once "partials/db.php";

// Vérifier si le formulaire de prise de rendez-vous est soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $date = $_POST['date'];
    $heure = $_POST['heure'];
    $motif = $_POST['motif'];
    $premierRdv = isset($_POST['premier_rdv']) ? 1 : 0;

    // Vérifier si la date sélectionnée est un samedi ou dimanche
    $selectedDay = date('N', strtotime($date));
    if ($selectedDay === '6' || $selectedDay === '7') {
        // Rediriger avec un message d'erreur si la date est un samedi ou dimanche
        header("Location: prendre_rendezvous.php?error=invalid_date");
        exit;
    }

    // Récupérer l'ID du patient à partir de la session
    $patientId = $_SESSION['user_id'];

    // Insérer le rendez-vous dans la base de données
    $sql = "INSERT INTO rendezvous (patient_id, date, heure, motif, premier_rdv) VALUES ('$patientId', '$date', '$heure', '$motif', '$premierRdv')";
    $result = $conn->query($sql);

    // Rediriger vers le tableau de bord avec un message de succès
    header("Location: dashboard.php?success=appointment_added");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Prendre rendez-vous</title>
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/styles.css">
</head>
<body>
<?php include 'partials/navbar.html'; ?>

<br><br><br><br><br><br>

    <h2>Prendre rendez-vous</h2>
    <?php if (isset($errorMessage)) { ?>
        <p><?php echo $errorMessage; ?></p>
    <?php } elseif (isset($successMessage)) { ?>
        <p><?php echo $successMessage; ?></p>
    <?php } ?>
    <form method="POST" action="prendre_rendezvous.php">
        <label for="date">Date du rendez-vous:</label>
        <input type="date" name="date" required><br><br>

        <label for="heure">Heure du rendez-vous:</label>
        <select id="heure" name="heure" required>
                <option value="">Sélectionner une heure</option>
                <option value="09:00">09:00</option>
                <option value="09:30">09:30</option>
                <option value="10:00">10:00</option>
                <option value="10:30">10:30</option>
                <option value="11:00">11:00</option>
                <option value="11:30">11:30</option>
                <option value="13:00">13:00</option>
                <option value="13:30">13:30</option>
                <option value="14:00">14:00</option>
                <option value="14:30">14:30</option>
                <option value="15:00">15:00</option>
                <option value="15:30">15:30</option>
                <option value="16:00">16:00</option>
            </select><br><br>

        <label for="motif">Motif du rendez-vous:</label>
        <textarea name="motif" rows="4" cols="50" required></textarea><br><br>

        <label for="premier_rdv">Premier rendez-vous:</label>
        <input type="checkbox" name="premier_rdv"><br><br>

        <input type="submit" value="Prendre rendez-vous">
    </form>
	
<!-- Afficher un message d'erreur si la date est invalide -->
<?php if (isset($_GET['error']) && $_GET['error'] === 'invalid_date') : ?>
	<p>Vous ne pouvez pas prendre rendez-vous les week-ends.</p>
<?php endif; ?>
	
<?php include 'partials/footer.html'; ?>
</body>
</html>
