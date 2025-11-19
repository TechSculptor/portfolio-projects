<header class="site-header">
  <div class="container header-inner">
    <!-- 1 LOGO -->
    <a class="brand" href="/" aria-label="Accueil Milliardstore">
      <img class="brand-icon" src="/assets/img/logo1.png" alt="" width="64" height="64">
    </a>

    <!-- 2 MENU (desktop) -->
    <nav id="mainNav" class="main-nav" aria-label="Navigation principale">
      <ul class="nav" role="list">
        <li><a href="#">ACCUEIL</a></li>
        <li><a href="#montres">MONTRES</a></li>
        <li><a href="#bijoux">BIJOUX ACCESSOIRES</a></li>
        <li><a href="#apropos">À PROPOS</a></li>
      </ul>
    </nav>

    <!-- 3 HAMBURGER (mobile) -->
    <button id="menuToggle" class="hamburger"
            aria-expanded="false" aria-controls="mainNav" aria-label="Ouvrir le menu">☰</button>

    <!-- 4 ICONES -->
    <div class="actions" aria-label="Actions">
      <a class="icon-btn" href="#" aria-label="Rechercher" title="Rechercher">
        <?php include __DIR__ . '/../assets/icons/search.svg'; ?>
      </a>
      <a class="icon-btn" href="#" aria-label="Panier" title="Panier">
        <?php include __DIR__ . '/../assets/icons/bag.svg'; ?>
      </a>
      <a class="icon-btn" href="#" aria-label="Mon compte" title="Mon compte">
        <?php include __DIR__ . '/../assets/icons/person.svg'; ?>
      </a>
    </div>
  </div>

  <script src="/assets/js/app.js" defer></script>

</header>
