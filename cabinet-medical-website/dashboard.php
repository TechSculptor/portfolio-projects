<?php
session_start();

// Vérifier si l'utilisateur est connecté, rediriger vers la page de connexion si non connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Inclure le fichier de connexion à la base de données (db.php)
require_once "partials/db.php";

// Récupérer l'ID de l'utilisateur connecté
$userId = $_SESSION['user_id'];

// Récupérer les informations de l'utilisateur à partir de la base de données
$sql = "SELECT * FROM users WHERE id = '$userId'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
}

// Récupérer les rendez-vous de l'utilisateur authentifié depuis la base de données
$sql = "SELECT * FROM rendezvous WHERE patient_id = '$userId'";
$result = $conn->query($sql);

// Tableau des couleurs pour les rendez-vous de l'utilisateur authentifié
$colors = [
    '#ffcccc', '#ff9999', '#ff6666', '#ff3333', '#ff0000',
];

// Compteur pour les couleurs
$colorIndex = 0;

// Fonction pour récupérer la prochaine couleur du tableau
function getNextColor($colors, &$colorIndex) {
    $color = $colors[$colorIndex];
    $colorIndex = ($colorIndex + 1) % count($colors);
    return $color;
}

// Récupérer les rendez-vous pris par l'utilisateur connecté
$sql = "SELECT * FROM rendezvous";
$result = $conn->query($sql);

// Traitement de la soumission du formulaire d'annulation de rendez-vous
if (isset($_POST['cancel_rendezvous_id'])) {
    $rendezVousId = $_POST['cancel_rendezvous_id'];

    // Vérifier si le rendez-vous appartient à l'utilisateur connecté
    $sqlCheck = "SELECT * FROM rendezvous WHERE id = '$rendezVousId' AND patient_id = '$userId'";
    $checkResult = $conn->query($sqlCheck);

    if ($checkResult->num_rows === 1) {
        // Supprimer le rendez-vous de la base de données
        $sqlDelete = "DELETE FROM rendezvous WHERE id = '$rendezVousId'";
        $conn->query($sqlDelete);
    }
    
    // Rediriger vers la page de tableau de bord
    header("Location: dashboard.php");
    exit;
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Tableau de Bord - Cabinet Médical</title>
    <!-- CSS -->
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/styles.css">
	<style>
        .highlighted-row {
            background-color: <?php echo getNextColor($colors, $colorIndex); ?>;
        }
    </style>
</head>
<body>

<?php include 'partials/navbar.html'; ?>

<br><br><br><br><br><br>

<h2>Tableau de Bord - Cabinet Médical</h2>

<h3>Bienvenue, <?php echo $user['username']; ?></h3>

<h4>Horaires d'ouverture du cabinet:</h4>
<p>Lundi au Vendredi: 9h00 - 12h00 et 13h00 - 16h00</p>

<br>

<!-- Lien vers la page de prise de rendez-vous -->
<?php
// Vérifier si l'utilisateur est un patient (ID différent de 1)
if ($_SESSION['user_id'] !== "1") {
    // Afficher le lien "Prendre rendez-vous" uniquement pour les patients
    echo '<p><a class="take-appointment-link" href="prendre_rendezvous.php">Prendre rendez-vous</a></p>';
}
?>

<br>

<!-- Afficher les rendez-vous des clients dans un tableau -->
<table>
    <thead>
        <tr>
            <th>Date</th>
            <th>Heure</th>
            <th>Motif</th>
            <th>Premier Rendez-vous</th>
            <th class="cancel-button">Annuler</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $result->fetch_assoc()) : ?>
		<?php
		// Vérifier si le rendez-vous appartient à l'utilisateur authentifié
		$isUserAppointment = $row['patient_id'] == $userId;
		$rowClass = $isUserAppointment ? 'highlighted-row' : '';
		?>
            <tr class="<?php echo $rowClass; ?>">
                <td><?php echo $row['date']; ?></td>
                <td><?php echo $row['heure']; ?></td>
                <td><?php echo $row['motif']; ?></td>
                <td><?php echo $row['premier_rdv'] ? 'Oui' : 'Non'; ?></td>
                <td class="cancel-button">
                    <!-- Formulaire d'annulation de rendez-vous -->
                    <form method="post" action="dashboard.php">
                        <input type="hidden" name="cancel_rendezvous_id" value="<?php echo $row['id']; ?>">
                        <button type="submit" class="cancel-button">Annuler</button>
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>
if ($_SESSION['user_id'] !== "1") {
    // Afficher le lien "Prendre rendez-vous" uniquement pour les patients
    echo '<h4>Les rendez-vous que vous avez pris sont affichés en rouge.</h4>';
}
?>

<br>

<!-- Lien pour déconnexion -->
<p><a class="take-appointment-link" href="logout.php">Déconnexion</a></p> <!-- Ajoutez le lien de déconnexion approprié -->

<?php include 'partials/footer.html'; ?>

</body>
</html>


