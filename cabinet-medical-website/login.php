<?php
session_start(); // Démarrer la session pour stocker les informations d'authentification

// Vérifier si l'utilisateur est déjà connecté, rediriger vers une page sécurisée si c'est le cas
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php"); // Remplacez "dashboard.php" par votre page sécurisée
    exit;
}

// Vérifier si le formulaire de connexion a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les valeurs du formulaire
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Connexion à la base de donnée
    require_once 'partials/db.php';
    $email = $conn->real_escape_string($email);

    // Requête pour récupérer les informations de l'utilisateur à partir de la base de données
    $sql = "SELECT id, email, password FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows === 1) {
        // Utilisateur trouvé dans la base de données
        $row = $result->fetch_assoc();
        $hashedPassword = $row['password'];

        // Vérifier si le mot de passe est ok
        if (password_verify($password, $hashedPassword)) {
            // Authentification réussie
            $_SESSION['user_id'] = $row['id'];
            header("Location: dashboard.php"); // Remplacez "dashboard.php" par votre page sécurisée
            exit;
        } else {
            // Mot de passe incorrect
            $error = "Mot de passe incorrect";
        }
    } else {
        // Utilisateur non trouvé dans la base de données
        $error = "Nom d'utilisateur incorrect";
    }

    // Fermer la connexion
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Connexion</title>
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/styles.css">
</head>
<body>

<?php include 'partials/navbar.html'; ?>

<br><br><br><br><br><br>

    <h2>Connexion</h2>

    <!-- Formulaire de connexion -->
    <form method="POST" action="login.php">
        <label for="email">Adresse e-mail:</label>
        <input type="email" name="email" required><br><br>

        <label for="password">Mot de passe:</label>
        <input type="password" name="password" required><br><br>

        <input type="submit" value="Se connecter">
    </form>

    <!-- Bouton pour la création de compte -->
    <p>Vous n'avez pas de compte ? <a href="register.php">Créer un compte</a></p>
	
<?php include 'partials/footer.html'; ?>

</body>
</html>

