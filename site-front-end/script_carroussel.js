<script>
  !(function () {
    var e = document.getElementById("carouselControls");
    if (e) {
      // --- Si jQuery et le plugin carousel existent ---
      if (typeof jQuery !== "undefined" && jQuery.fn && jQuery.fn.carousel) {
        var t, n, o;
        var a = jQuery(e);

        function c(selector, action) {
          var el = e.querySelector(selector);
          if (el) {
            el.addEventListener(
              "click",
              function (event) {
                event.preventDefault();
                event.stopPropagation();
                a.carousel(action);
              },
              true
            );
          }
        }

        // Initialisation du carousel Bootstrap
        a.carousel({
          interval: 4000,
          pause: "hover",
          wrap: true,
          keyboard: true,
        });

        c(".carousel-control-prev", "prev");
        c(".carousel-control-next", "next");

        // --- Création des indicateurs si absents ---
        if (!e.querySelector(".carousel-indicators")) {
          var r = e.querySelectorAll(".carousel-inner .carousel-item");
          var i = document.createElement("ol");
          i.className = "carousel-indicators";

          r.forEach(function (item, index) {
            var li = document.createElement("li");
            li.setAttribute("data-target", "#carouselControls");
            li.setAttribute("data-slide-to", String(index));
            if (index === 0) li.className = "active";
            i.appendChild(li);
          });

          e.appendChild(i);

          // Gestion clic sur les indicateurs
          i.addEventListener(
            "click",
            function (event) {
              var target = event.target.closest("li");
              if (target) {
                event.preventDefault();
                event.stopPropagation();
                var n = Number(target.getAttribute("data-slide-to")) || 0;
                a.carousel(n);
              }
            },
            true
          );

          jQuery(e).on("slide.bs.carousel", function (event) {
            var to = event.to;
            var indicators = i.querySelectorAll("li");
            [].forEach.call(indicators, function (li) {
              li.classList.remove("active");
            });
            if (indicators[to]) indicators[to].classList.add("active");
          });
        }

        // --- Gestion du swipe tactile ---
        t = 0;
        n = 0;
        o = false;

        e.addEventListener(
          "touchstart",
          function (event) {
            if (event.touches && event.touches.length) {
              t = event.touches[0].clientX;
              n = 0;
              o = true;
            }
          },
          { passive: true }
        );

        e.addEventListener(
          "touchmove",
          function (event) {
            if (o && event.touches && event.touches.length) {
              n = event.touches[0].clientX - t;
            }
          },
          { passive: true }
        );

        e.addEventListener("touchend", function (event) {
          if (o) {
            o = false;
            if (Math.abs(n) > 50) {
              event.preventDefault();
              event.stopPropagation();
              a.carousel(n > 0 ? "prev" : "next");
            }
          }
        });

        // --- Pause / Reprise quand l’onglet change de visibilité ---
        document.addEventListener("visibilitychange", function () {
          document.hidden ? a.carousel("pause") : a.carousel("cycle");
        });
        return;
      }

      // --- Si jQuery n’est pas présent, fallback JS pur ---
      var r = [].slice.call(e.querySelectorAll(".carousel-item"));
      if (r.length) {
        var s = r.findIndex(function (item) {
          return item.classList.contains("active");
        });
        if (s < 0) s = 0;

        var l, u, d;
        var v = setInterval(nextSlide, 3000);
        var prev = e.querySelector(".carousel-control-prev");
        var next = e.querySelector(".carousel-control-next");

        if (prev)
          prev.addEventListener(
            "click",
            function (event) {
              event.preventDefault();
              event.stopPropagation();
              prevSlide();
            },
            true
          );

        if (next)
          next.addEventListener(
            "click",
            function (event) {
              event.preventDefault();
              event.stopPropagation();
              nextSlide();
            },
            true
          );

        e.addEventListener("mouseenter", function () {
          clearInterval(v);
        });

        e.addEventListener("mouseleave", function () {
          v = setInterval(nextSlide, 3000);
        });

        // --- Swipe tactile pour version sans jQuery ---
        l = 0;
        u = 0;
        d = false;

        e.addEventListener(
          "touchstart",
          function (event) {
            if (event.touches && event.touches.length) {
              l = event.touches[0].clientX;
              u = 0;
              d = true;
            }
          },
          { passive: true }
        );

        e.addEventListener(
          "touchmove",
          function (event) {
            if (d && event.touches && event.touches.length) {
              u = event.touches[0].clientX - l;
            }
          },
          { passive: true }
        );

        e.addEventListener("touchend", function (event) {
          if (d) {
            d = false;
            if (Math.abs(u) > 50) {
              event.preventDefault();
              event.stopPropagation();
              u > 0 ? prevSlide() : nextSlide();
            }
          }
        });

        document.addEventListener("visibilitychange", function () {
          document.hidden
            ? clearInterval(v)
            : (v = setInterval(nextSlide, 3000));
        });

        function goTo(index) {
          r[s].classList.remove("active");
          s = (index + r.length) % r.length;
          r[s].classList.add("active");
        }

        function nextSlide() {
          goTo(s + 1);
        }

        function prevSlide() {
          goTo(s - 1);
        }
      }
    }
  })();
</script>
