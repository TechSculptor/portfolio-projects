<section class="newsletter-bar" aria-labelledby="nl-title">
  <div class="container nl-inner">
    <h3 id="nl-title">NEWSLETTER :</h3>
    <form class="nl-form" action="#" method="post">
      <input id="nl-email" type="email" placeholder="Entrez votre email" required>
      <button type="submit">Rejoignez-nous</button>
    </form>
  </div>
</section>

<footer class="site-footer" role="contentinfo">
  <div class="container footer-grid">
    <!-- COL 1 — Marque -->
    <section class="footer-brand">
      <img class="brand-logo" src="/assets/img/logo1.png" alt="Milliardstore" width="232" height="232">
      <p class="brand-desc">
        Découvrez l’élégance intemporelle de Milliardstore et laissez-vous séduire par
        notre collection exclusive de montres.
      </p>
    </section>

    <!-- COL 2 — Nos produits -->
    <nav class="footer-col center" aria-label="Nos produits">
      <h5>NOS PRODUITS</h5>
      <ul>
        <li><a href="#femmes">Montres pour femmes</a></li>
        <li><a href="#hommes">Montres pour hommes</a></li>
        <li><a href="#enfants">Montres pour enfants</a></li>
        <li><a href="#connectees">Montres connectées</a></li>
        <li><a href="#speciales">Montres spéciales</a></li>
      </ul>
    </nav>

    <!-- COL 3 — Informations -->
    <nav class="footer-col center" aria-label="Informations">
      <h5>INFORMATIONS</h5>
      <ul>
        <li><a href="/a-propos">À propos de nous</a></li>
        <li><a href="/faq">FAQ</a></li>
        <li><a href="/contact">Contactez nous</a></li>
        <li><a href="/cgv">CGV</a></li>
        <li><a href="/confidentialite">Politique de Confidentialité</a></li>
        <li><a href="/cookies">Politique de Cookies</a></li>
      </ul>
    </nav>

    <!-- COL 4 — Contact et horaires -->
    <address class="footer-contact">
      <h5>CONTACT</h5>
      <p>204 Rue de la Haie-Coq<br>93300 Aubervilliers</p>
      <p><strong>Horaires</strong><br>
        Lun–Ven : 9h00–19h00<br>
        Sam : 10h00–13h00<br>
        Dim : fermé
      </p>
      <p>Tél : <a href="tel:+3301316151">+33 01 31 61 51</a><br>
         E-mail : <a href="mailto:service.easystore@gmail.com">service.easystore@gmail.com</a>
      </p>
    </address>
  </div>

  <!-- Texte légalité + moyens de paiement à droite -->
  <div class="container legal">
    <p class="legal-text">
      © <span id="y"></span> Milliardstore ·
      <a href="/mentions-legales">Mentions légales</a> ·
      <a href="/confidentialite">Confidentialité</a> ·
      <a href="/cgv">CGV</a>
    </p>
    <div class="pay">
      <span class="pay-btn" aria-label="Carte bancaire">
        <img src="/assets/icons/credit-card.svg" alt="">
      </span>
      <span class="pay-btn" aria-label="PayPal">
        <img src="/assets/icons/paypal.svg" alt="">
      </span>
    </div>
  </div>
  <script>document.getElementById('y').textContent=(new Date()).getFullYear();</script>
</footer>

<script>document.getElementById('y').textContent=(new Date()).getFullYear();</script>
<script src="/assets/js/app.js" defer></script>
