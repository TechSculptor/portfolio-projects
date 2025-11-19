<?php
http_response_code(404);
require __DIR__ . '/partials/head.php';
require __DIR__ . '/partials/header.php';
?>
<main class="section">
  <div class="container" style="text-align:center;max-width:720px">
    <h1>Page introuvable (404)</h1>
    <p>Désolé, cette page n’existe plus ou a été déplacée.</p>
    <p><a class="btn" href="/">← Retour à l’accueil</a></p>
  </div>
</main>
<?php require __DIR__ . '/partials/footer.php'; ?>
