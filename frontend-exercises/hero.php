<?php // sections/hero.php ?>
<section class="hero" aria-labelledby="hero-title">
  <figure class="hero-media">
    <picture>
      <!-- JPG responsive -->
      <img class="hero-img"
          src="/assets/img/hero-800.jpg"
          srcset="/assets/img/hero-480.jpg 480w,
                  /assets/img/hero-800.jpg 800w,
                  /assets/img/hero-1600.jpg 1600w"
          sizes="100vw"
          alt="Montres élégantes en situation"
          width="1600" height="900"
          fetchpriority="high" decoding="async">
    </picture>
  </figure>

  <div class="hero-overlay container hero--center">
    <p class="eyebrow">ÉLÉGANCE & PRÉCISION</p>
    <h1>Montres sophistiquées pour chaque instant.</h1>
    <p class="season">Automne–Hiver 2024</p>
    <a class="btn btn-hero" href="#montres" aria-label="Découvrir">Découvrez →</a>
  </div>

  <button class="hero-arrow prev" aria-label="Précédent">❮</button>
  <button class="hero-arrow next" aria-label="Suivant">❯</button>

  <div class="hero-dots" role="tablist" aria-label="Slides">
    <button class="dot is-active" aria-label="Slide 1"></button>
    <button class="dot" aria-label="Slide 2"></button>
    <button class="dot" aria-label="Slide 3"></button>
  </div>
</section>
