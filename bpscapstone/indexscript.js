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


async function loadCSVData() {
    try {
        const response = await fetch('./data/data_pln_encode.csv');
        if (!response.ok) throw new Error('CSV fetch failed');
        const data = await response.text();
        const rows = data.split('\n').slice(1);

        const labels = [];
        const values = [];

        rows.forEach(row => {
            const cols = row.split(',');
            const yearMonth = cols[6]; 
            const kwhSales = parseFloat(cols[8]); 

            if (yearMonth && !isNaN(kwhSales)) {
                labels.push(yearMonth);
                values.push(kwhSales);
            }
        });

        const ctx = document.getElementById('myChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'kWh Sales',
                    data: values,
                    backgroundColor: "rgba(0,0,255,1.0)", 
                    borderColor: "rgba(0,0,255,1.0)", 
                    borderWidth: 2,
                    pointRadius: 0, 
                    fill: false, 
                    tension: 0 
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'kWh'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Waktu (Year-Month)'
                        }
                    }
                }
            }
        });

    } catch (err) {
        console.error("Error loading or parsing CSV:", err);
    }
}
loadCSVData();


document.addEventListener("DOMContentLoaded", function () {
    let layananSection = document.querySelector(".layanan-section");
    layananSection.classList.add("show");
});


document.addEventListener("DOMContentLoaded", function () {
    let sections = document.querySelectorAll(".video-section, .profile-section, .layanan-section, .dokumentasi-section");

    let observer = new IntersectionObserver(function (entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add("show"); 
            } else {
                entry.target.classList.remove("show"); 
            }
        });
    }, {
        threshold: 0.2
    });

    sections.forEach(section => {
        observer.observe(section);
    });
});

document.addEventListener("DOMContentLoaded", function () {
    let sections = document.querySelectorAll(".berita-section");

    let observer = new IntersectionObserver(function (entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add("show"); 
            } else {
                entry.target.classList.remove("show"); 
            }
        });
    }, {
        threshold: 0.4
    }); 

    sections.forEach(section => {
        observer.observe(section);
    });
});





const track = document.querySelector('.slider-track');
const cards = document.querySelectorAll('.card');
const cardWidth = document.querySelector('.card').offsetWidth + 20;
let index = 0;


cards.forEach(card => {
    const clone = card.cloneNode(true);
    track.appendChild(clone);
});

function slide() {
    index++;
    track.style.transition = 'transform 0.5s ease';
    track.style.transform = 'translateX(' + (-index * cardWidth) + 'px)';

    if (index === cards.length) {
        setTimeout(() => {
            track.style.transition = 'none';
            track.style.transform = 'translateX(0px)';
            index = 0;
        }, 500);
    }
}

let interval = setInterval(slide, 3000);

function pauseSlide() {
    clearInterval(interval);
}

function resumeSlide() {
    clearInterval(interval);
    interval = setInterval(slide, 3000);
}

let isDown = false;
let startX;
let scrollLeft;
let isDragging = false;

track.addEventListener('mousedown', (e) => {
    pauseSlide();
    isDown = true;
    isDragging = false;
    track.style.cursor = 'grabbing';
    startX = e.pageX;
    scrollLeft = getTranslateX();
});

track.addEventListener('mouseleave', () => {
    if (isDown) snapToCard();
    isDown = false;
    track.style.cursor = 'grab';
    resumeSlide();
});

track.addEventListener('mouseup', () => {
    if (isDown) snapToCard();
    isDown = false;
    track.style.cursor = 'grab';
    resumeSlide();
});

track.addEventListener('mousemove', (e) => {
    if (!isDown) return;
    e.preventDefault();
    const x = e.pageX;
    const walk = x - startX;

    if (Math.abs(walk) > 5) {
        isDragging = true;
    }

    track.style.transition = 'none';
    track.style.transform = `translateX(${scrollLeft + walk}px)`;
});

track.addEventListener('touchstart', (e) => {
    pauseSlide();
    isDown = true;
    isDragging = false;
    startX = e.touches[0].pageX;
    scrollLeft = getTranslateX();
}, {
    passive: true
});

track.addEventListener('touchend', () => {
    if (isDown) snapToCard();
    isDown = false;
    resumeSlide();
});

track.addEventListener('touchmove', (e) => {
    if (!isDown) return;
    const x = e.touches[0].pageX;
    const walk = x - startX;

    if (Math.abs(walk) > 5) {
        isDragging = true;
    }

    track.style.transition = 'none';
    track.style.transform = `translateX(${scrollLeft + walk}px)`;
}, {
    passive: true
});

function snapToCard() {
    let currentX = getTranslateX();
    let newIndex = Math.round(-currentX / cardWidth);

    if (newIndex < 0) {
        newIndex = cards.length - 1;
        track.style.transition = 'none';
        track.style.transform = `translateX(${-newIndex * cardWidth}px)`;
        requestAnimationFrame(() => {
            track.style.transition = 'transform 0.3s ease';
            track.style.transform = `translateX(${-newIndex * cardWidth}px)`;
        });
    } else if (newIndex >= cards.length) {
        newIndex = 0;
        track.style.transition = 'none';
        track.style.transform = `translateX(0px)`;
        requestAnimationFrame(() => {
            track.style.transition = 'transform 0.3s ease';
            track.style.transform = `translateX(0px)`;
        });
    } else {
        track.style.transition = 'transform 0.3s ease';
        track.style.transform = `translateX(${-newIndex * cardWidth}px)`;
    }

    index = newIndex;
}

const allCards = document.querySelectorAll('.card');
allCards.forEach(card => {
    card.addEventListener('click', function (e) {
        if (isDragging) {
            e.preventDefault(); 
        }
    });
});

function getTranslateX() {
    const style = window.getComputedStyle(track);
    const matrix = new WebKitCSSMatrix(style.transform);
    return matrix.m41;
}
