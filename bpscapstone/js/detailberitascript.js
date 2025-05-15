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
    let sections = document.querySelectorAll(".detail-berita-section, .saran-section");

    let observer = new IntersectionObserver(function (entries, observer) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add("show"); // Muncul
                observer.unobserve(entry.target); // Berhenti mengamati setelah muncul
            }
        });
    }, {
        threshold: 0.2  // Menentukan berapa banyak bagian elemen yang harus terlihat
    });

    sections.forEach(section => {
        observer.observe(section);
    });
});

