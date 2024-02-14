import "./bootstrap.js";
/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
import "./styles/app.css";

document.addEventListener("DOMContentLoaded", function () {
  var zindex = 10;

  var cardProjects = document.querySelectorAll("div.card-project");
  cardProjects.forEach(function (cardProject) {
    cardProject.addEventListener("click", function (e) {
      e.preventDefault();

      var isShowing = false;

      if (this.classList.contains("show")) {
        isShowing = true;
      }

      var cards = document.querySelector("div.cards");

      if (cards.classList.contains("showing")) {
        // une carte est déjà affichée
        var showingCard = document.querySelector("div.card-project.show");
        showingCard.classList.remove("show");

        if (isShowing) {
          // cette carte était affichée - réinitialiser la grille
          cards.classList.remove("showing");
        } else {
          // cette carte n'est pas affichée - afficher la
          this.style.zIndex = zindex;
          this.classList.add("show");
        }

        zindex++;
      } else {
        // aucune carte affichée
        cards.classList.add("showing");
        this.style.zIndex = zindex;
        this.classList.add("show");

        zindex++;
      }
    });
  });
});
