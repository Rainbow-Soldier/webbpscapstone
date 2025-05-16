let lastScrollTop = 0;
const navbar = document.querySelector('.navbar');

window.addEventListener('scroll', function() {
    let currentScroll = window.pageYOffset || document.documentElement.scrollTop;

    if (currentScroll > lastScrollTop) {
        navbar.classList.add('hide');
    } else {
        navbar.classList.remove('hide');
    }

    lastScrollTop = currentScroll <= 0 ? 0 : currentScroll;
});

document.addEventListener("DOMContentLoaded", function () {
    let profileSection = document.querySelector(".profile-section");

    let observer = new IntersectionObserver(function (entries, observer) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                profileSection.classList.add("show");
                observer.unobserve(profileSection);
            }
        });
    }, { threshold: 0.3 });

    observer.observe(profileSection);
});

document.addEventListener("DOMContentLoaded", function () {
    let sejarahSection = document.querySelector(".sejarah-section");

    let observer = new IntersectionObserver(function (entries, observer) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                sejarahSection.classList.add("show");
                observer.unobserve(sejarahSection);
            }
        });
    }, { threshold: 0.3 });

    observer.observe(sejarahSection);
});

function showSection(sectionId) {
  let sections = ['arti-logo', 'sejarah-bps'];

  sections.forEach(id => {
    let el = document.getElementById(id);
    el.style.display = 'none';
    el.classList.remove('show');
  });

  let selectedSection = document.getElementById(sectionId);
  selectedSection.style.display = 'block';

  void selectedSection.offsetWidth;

  selectedSection.classList.add('show');
}

document.addEventListener("DOMContentLoaded", function () {
    let flexContainer = document.querySelector(".profile-flex-container");

    let observer = new IntersectionObserver(function (entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                flexContainer.classList.add("show");
            } else {
                flexContainer.classList.remove("show");
            }
        });
    }, { threshold: 0.3 });

    observer.observe(flexContainer);
});

document.addEventListener("DOMContentLoaded", function () {
    let sejarahText = document.querySelector(".sejarah-text-container");

    let observer = new IntersectionObserver(function (entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                sejarahText.classList.add("show");
            } else {
                sejarahText.classList.remove("show");
            }
        });
    }, { threshold: 0.3 });

    observer.observe(sejarahText);
});

window.onload = function() {
    showSection('arti-logo');
};

document.querySelectorAll('.sidebar ul li a').forEach(link => {
    link.addEventListener('click', function() {
        document.querySelectorAll('.sidebar ul li a').forEach(link => link.classList.remove('clicked'));
        this.classList.add('clicked');
    });
});

document.addEventListener("DOMContentLoaded", function () {
  let layoutContainer = document.querySelector(".layout-container");
  let sidebar = document.querySelector(".sidebar");

  let observer = new IntersectionObserver(function (entries) {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add("show");
      }
    });
  }, { threshold: 0.3 });

  observer.observe(layoutContainer);
  observer.observe(sidebar);
});
