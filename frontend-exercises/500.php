<?php
http_response_code(500);
require __DIR__ . '/partials/head.php';
require __DIR__ . '/partials/header.php';
?>
<main class="section">
  <div class="container" style="text-align:center;max-width:720px">
    <h1>Erreur interne (500)</h1>
    <p>Un incident est survenu. Réessaie dans quelques instants.</p>
    <p><a class="btn" href="/">← Retour à l’accueil</a></p>
  </div>
</main>
<?php require __DIR__ . '/partials/footer.php'; ?>
