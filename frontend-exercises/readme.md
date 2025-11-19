# Milliardstore

Projet front-end développé sous XAMPP.
Première version : header (logo + menu + icônes) et hero “Élégance & précision”.

## Installation
- Copier le projet dans `C:/xampp/htdocs/milliardstore/`
- Lancer Apache depuis XAMPP Control Panel
- Ouvrir le site dans votre navigateur :

  - Avec VirtualHost : http://milliardstore.local/
  - Sans VirtualHost : http://localhost/milliardstore/

## Contenu
- `index.php`
- `assets/css/main.css`
- `assets/js/app.js` (pour le menu mobile)
- `assets/img

# Milliardstore – Front-end

Projet développé sous XAMPP.
Landing page vitrine (montres & accessoires).

## Stack
- PHP
- HTML/CSS, un peu de JS
- Images optimisées (WebP)

## Arborescence
assets/
  css/ main.css
  js/  app.js
  img/ (hero, catégories, collections, icônes,…)
  icons/ (credit-card.svg, paypal.svg, favicons…)
partials/
  head.php, header.php, footer.php
sections/
  hero.php, categories.php, collections.php, reassurance.php
404.php, 500.php
index.php
robots.txt
sitemap.xml

## Lancer en local
- Apache + PHP (ou MAMP/WAMP/XAMPP)
- VHost ex: `milliardstore.local` pointant sur le dossier du site
- Naviguer sur http://milliardstore.local/

## Build images WebP (conseil)
```bash
# macOS
brew install webp
cwebp -q 82 assets/img/hero-1600.jpg -o assets/img/hero-1600.webp

