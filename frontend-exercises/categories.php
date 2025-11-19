<?php // sections/categories.php
$categories = [
  ["slug"=>"femmes",     "title"=>"Montres pour femme",      "url"=>"#femmes",     "img"=>"/assets/img/cat-femmes.jpg",     "alt"=>"Montres pour femmes"],
  ["slug"=>"hommes",     "title"=>"Montres pour homme",      "url"=>"#hommes",     "img"=>"/assets/img/cat-hommes.jpg",     "alt"=>"Montres pour hommes"],
  ["slug"=>"enfants",    "title"=>"Montres pour enfant",     "url"=>"#enfants",    "img"=>"/assets/img/cat-enfants.jpg",    "alt"=>"Montres pour enfants"],
  ["slug"=>"connectees", "title"=>"Montres connectées", "url"=>"#connectees", "img"=>"/assets/img/cat-connectees.jpg", "alt"=>"Montres connectées"],
  ["slug"=>"speciales",  "title"=>"Montres spéciales",  "url"=>"#speciales",  "img"=>"/assets/img/cat-speciales.jpg",  "alt"=>"Montres spéciales"],
];
?>
<section id="montres" class="section categories" aria-labelledby="cat-title">
  <div class="container">
    <h2 id="cat-title">Votre grossiste de montres en ligne</h2>
    <br>
    <p class="intro">
      Sur milliardstore.com, explorez plus de 30 000 montres et accessoires pour
      célébrer vos moments les plus précieux : fiançailles, mariage, naissance ou
      baptême. Trouvez la montre parfaite, ainsi que des bagues, bracelets, colliers et
      pendentifs.
    </p>
    <br><br><br><br>

    <ul class="cats" role="list">
      <?php foreach ($categories as $c): ?>
        <li class="card <?= 'cat-'.htmlspecialchars($c['slug']) ?>">
          <a class="card-link" href="<?= htmlspecialchars($c['url']) ?>">
            <figure class="card-media">
              <img src="<?= htmlspecialchars($c['img']) ?>"
                   alt="<?= htmlspecialchars($c['alt']) ?>" loading="lazy">
            </figure>
            <h3 class="card-title"><?= htmlspecialchars($c['title']) ?></h3>
            <span class="card-arrow" aria-hidden>→</span>
          </a>
        </li>
      <?php endforeach; ?>
    </ul>
  </div>
</section>
