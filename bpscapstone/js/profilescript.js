
// navbar hide on scroll
let lastScrollTop = 0; // Keeps track of the last scroll position
const navbar = document.querySelector('.navbar'); // Select the navbar element

window.addEventListener('scroll', function() {
    let currentScroll = window.pageYOffset || document.documentElement.scrollTop; // Get the current scroll position

    if (currentScroll > lastScrollTop) {
        // Scrolling down
        navbar.classList.add('hide'); // Hide the navbar
    } else {
        // Scrolling up
        navbar.classList.remove('hide'); // Show the navbar
    }

    lastScrollTop = currentScroll <= 0 ? 0 : currentScroll; // Prevent negative values
});

// popup section
document.addEventListener("DOMContentLoaded", function () {
    let profileSection = document.querySelector(".profile-section");

    let observer = new IntersectionObserver(function (entries, observer) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                profileSection.classList.add("show"); // Muncul
                observer.unobserve(profileSection); // Berhenti observe supaya gak muncul-hilang lagi
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
                sejarahSection.classList.add("show"); // Muncul
                observer.unobserve(sejarahSection); // Berhenti observe supaya gak muncul-hilang lagi
            }
        });
    }, { threshold: 0.3 });

    observer.observe(sejarahSection);
});


function showSection(sectionId) {
  // Semua section
  let sections = ['arti-logo', 'sejarah-bps'];

  sections.forEach(id => {
    let el = document.getElementById(id);
    el.style.display = 'none';
    el.classList.remove('show'); // Hapus efek show dulu
  });

  // Tampilkan yang dipilih
  let selectedSection = document.getElementById(sectionId);
  selectedSection.style.display = 'block';

  // Paksa browser reflow supaya animasi popup ulang
  void selectedSection.offsetWidth;

  // Tambahkan lagi class show (biar animasinya jalan ulang)
  selectedSection.classList.add('show');
}

document.addEventListener("DOMContentLoaded", function () {
    let flexContainer = document.querySelector(".profile-flex-container");

    let observer = new IntersectionObserver(function (entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                flexContainer.classList.add("show"); // Muncul
            } else {
                flexContainer.classList.remove("show"); // Hilang lagi
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
                sejarahText.classList.add("show"); // Muncul
            } else {
                sejarahText.classList.remove("show"); // Hilang lagi
            }
        });
    }, { threshold: 0.3 });

    observer.observe(sejarahText);
});

  // Default yang ditampilkan pertama kali (arti logo)
  window.onload = function() {
    showSection('arti-logo');
  };


  document.querySelectorAll('.sidebar ul li a').forEach(link => {
    link.addEventListener('click', function() {
        // Hapus kelas 'clicked' dari semua link
        document.querySelectorAll('.sidebar ul li a').forEach(link => link.classList.remove('clicked'));

        // Tambahkan kelas 'clicked' pada link yang diklik
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