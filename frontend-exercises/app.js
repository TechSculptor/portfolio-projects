// assets/js/app.js

// Ouvre/ferme la navigation du menu mobile.
document.addEventListener("DOMContentLoaded", () => {
  const btn = document.getElementById("menuToggle");
  const nav = document.getElementById("mainNav");

  if (btn && nav) {
    btn.addEventListener("click", () => {
      const open = nav.classList.toggle("open");
      btn.setAttribute("aria-expanded", open ? "true" : "false");
    });
  }
});

// Fermer le menu mobile quand on clique ailleurs.
document.addEventListener("click", (e) => {
  const btn = document.getElementById("menuToggle");
  const nav = document.getElementById("mainNav");
  if (!btn || !nav) return;
  const clickedInside = nav.contains(e.target) || btn.contains(e.target);
  if (!clickedInside) nav.classList.remove("open");
});

// Pour empêcher le scroll de fond quand le menu mobile est ouvert.
(() => {
  const btn = document.getElementById('menuToggle');
  const nav = document.getElementById('mainNav');
  if (btn && nav) {
    btn.addEventListener('click', () => {
      const open = nav.classList.toggle('open');
      document.body.style.overflow = open ? 'hidden' : '';
      btn.setAttribute('aria-expanded', open ? 'true' : 'false');
    });
  }

  // Brancher au slider si on ajoute plusieurs slides.
  const dots = document.querySelectorAll('.hero-dots .dot');
  if (dots.length) {
    dots.forEach((d) => d.addEventListener('click', () => {
      dots.forEach(x => x.classList.remove('is-active'));
      d.classList.add('is-active');
    }));
  }
})();

// Pour que les flèches du hero n’attrapent pas le clic.
document.querySelectorAll('.hero-arrow').forEach(b=>{
  b.addEventListener('click', e => e.preventDefault());
});

document.querySelectorAll('.hero-dots .dot').forEach((b,i,all)=>{
  b.addEventListener('click',()=>{
    all.forEach(x=>x.classList.remove('is-active'));
    b.classList.add('is-active');
  });
});



