<?php
session_start(); // Démarrer la session pour stocker les informations d'authentification

// Vérifie si un utilisateur est déja connecté, redirige vers le tableau de bord si c'est le cas.
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php"); // Replace "dashboard.php" with your secure page
    exit;
}

// Vérifie si tous les champs du formulaire ont été saisis.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the form values
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];

    // Connexion à la base de donnée
    require_once 'partials/db.php';

    // Validation et stockage des données dans des variables
    $email = $conn->real_escape_string($email);
    $username = $conn->real_escape_string($username);
    $password = $conn->real_escape_string($password);
    $phone = $conn->real_escape_string($phone);

    // Sécurisation du mot de passe avec la fonction hash.
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insertion des données des 4 variables ci-dessus dans la base de donnée
    $sql = "INSERT INTO users (email, username, password, phone) VALUES ('$email', '$username', '$hashedPassword', '$phone')";
    if ($conn->query($sql) === true) {
        // Enregistrement réussi
        $_SESSION['user_id'] = $conn->insert_id; // Store the user ID in the session
        header("Location: dashboard.php"); // Replace "dashboard.php" with your secure page
        exit;
    } else {
        // Enregistrement échoué
        $error = "Registration failed. Please try again.";
    }

    // Fermeture de la connexion
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registration</title>
	<!-- Les liens des fichiers CSS  -->
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/styles.css">
</head>
<body>
<!-- Inclure la barre de navigation -->
<?php include 'partials/navbar.html'; ?>

<br><br><br><br><br><br>

    <h2>Registration</h2>
    <?php if (isset($error)) { ?>
        <p><?php echo $error; ?></p>
    <?php } ?>
    <form method="POST" action="register.php">
        <label for="email">Email:</label>
        <input type="email" name="email" required><br><br>

        <label for="username">Username:</label>
        <input type="text" name="username" required><br><br>

        <label for="password">Password:</label>
        <input type="password" name="password" required><br><br>

        <label for="phone">Phone:</label>
        <input type="text" name="phone" required><br><br>

        <input type="submit" value="Register">
    </form>
<!-- Include le pied de page -->
<?php include 'partials/footer.html'; ?>

</body>
</html>

