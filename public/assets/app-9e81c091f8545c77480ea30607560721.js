import "./bootstrap.js";
import "./styles/app.css";

document.addEventListener("DOMContentLoaded", function () {
  var links = document.querySelectorAll(".nav-link");
  links.forEach(function (link) {
    link.addEventListener("click", function (e) {
      e.preventDefault();
      var target = this.getAttribute("data-target");
      var targetElement = document.getElementById(target);
      if (targetElement) {
        targetElement.scrollIntoView({
          behavior: "smooth",
        });
      }
    });
  });
});

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
        var showingCard = document.querySelector("div.card-project.show");
        showingCard.classList.remove("show");

        if (isShowing) {
          cards.classList.remove("showing");
        } else {
          this.style.zIndex = zindex;
          this.classList.add("show");
        }

        zindex++;
      } else {
        cards.classList.add("showing");
        this.style.zIndex = zindex;
        this.classList.add("show");

        zindex++;
      }
    });
  });
});

document.addEventListener("DOMContentLoaded", function () {
  var navbar = document.querySelector(".navbar-collapse");

  document.addEventListener("click", function (event) {
    var isClickInsideNavbar = navbar.contains(event.target);
    var isNavbarTogglerClicked = event.target.closest(".navbar-toggler");

    if (
      !isClickInsideNavbar &&
      !isNavbarTogglerClicked &&
      navbar.classList.contains("show")
    ) {
      document.querySelector(".navbar-toggler").click();
    }
  });
});
