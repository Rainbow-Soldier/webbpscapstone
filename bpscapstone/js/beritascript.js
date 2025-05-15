let lastScrollTop = 0;
const navbar = document.querySelector('.navbar');

window.addEventListener('scroll', function () {
  let currentScroll = window.pageYOffset || document.documentElement.scrollTop;

  if (currentScroll > lastScrollTop && currentScroll > 50) {
    navbar.classList.add('hide');
  } else {
    navbar.classList.remove('hide');
  }

  lastScrollTop = currentScroll <= 0 ? 0 : currentScroll;
});

document.addEventListener("DOMContentLoaded", function () {
    let sections = document.querySelectorAll(".beritaresmi-section");

    let observer = new IntersectionObserver(function (entries, observer) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add("show");
                observer.unobserve(entry.target); // Unobserve supaya efek cuma sekali
            }
        });
    }, { threshold: 0.2 });

    sections.forEach(section => {
        observer.observe(section);
    });
});



document.getElementById('searchButton').addEventListener('click', function() {
    const keyword = document.getElementById('searchInput').value.toLowerCase();
    const cards = document.querySelectorAll('.beritaresmi-cards-container .card');

    cards.forEach(card => {
        const title = card.querySelector('.card-text h3').textContent.toLowerCase();
        const desc = card.querySelector('.card-description').textContent.toLowerCase();

        if (title.includes(keyword) || desc.includes(keyword)) {
            card.style.display = 'flex'; // Show card (visible)
            card.style.pointerEvents = 'all'; // Enable interaction
        } else {
            card.style.display = 'none'; // Hide card completely and remove it from layout
        }
    });
});

// Optional: Auto filter on input change
document.getElementById('searchInput').addEventListener('input', function() {
    const keyword = this.value.toLowerCase();
    const cards = document.querySelectorAll('.beritaresmi-cards-container .card');

    cards.forEach(card => {
        const title = card.querySelector('.card-text h3').textContent.toLowerCase();
        const desc = card.querySelector('.card-description').textContent.toLowerCase();

        if (title.includes(keyword) || desc.includes(keyword)) {
            card.style.display = 'flex'; // Show card (visible)
            card.style.pointerEvents = 'all'; // Enable interaction
        } else {
            card.style.display = 'none'; // Hide card completely and remove it from layout
        }
    });
});

