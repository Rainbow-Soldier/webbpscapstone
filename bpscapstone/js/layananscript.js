document.getElementById("predictForm").addEventListener("submit", async function(e) {
  e.preventDefault();

  const formData = new FormData(e.target);
  const data = Object.fromEntries(formData.entries());
  Object.keys(data).forEach(key => data[key] = parseFloat(data[key]));

  try {
    const res = await fetch("https://bpsfastapi-production.up.railway.app/predict", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify(data)
    });

    if (!res.ok) {
      throw new Error(`Server error: ${res.status}`);
    }

    const result = await res.json();
    document.getElementById("hasilSection").classList.add("show");
    document.getElementById("hasil").innerText = "Prediksi Penjualan: " + result.prediksi_penjualan;
  } catch (err) {
    document.getElementById("hasil").innerText = "Error: " + err;
  }
});

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

let chartInstance;

async function fetchData() {
  const response = await fetch('./data/data_pln_encode.csv');
  const text = await response.text();
  return Papa.parse(text, { header: true, dynamicTyping: true }).data;
}

function updateChartType(data, type) {
  const labels = data.map(row => row["YearMonth"]);

  if (chartInstance) chartInstance.destroy();

  let datasets = [];

  switch (type) {
    case 'produksi':
      datasets = [
        { label: 'Produksi (kWh)', data: data.map(r => r["Produksi (kWh)"]), borderColor: 'blue', fill: false },
        { label: 'Terjual (kWh)', data: data.map(r => r["Terjual (kWh)"]), borderColor: 'green', fill: false }
      ];
      break;

    case 'efisiensi':
      datasets = [
        { label: 'Efisiensi (%)', data: data.map(r => r["Efficiency (%)"]), borderColor: 'orange', fill: false }
      ];
      break;

    case 'susut':
      datasets = [
        { label: 'Susut (kWh)', data: data.map(r => r["Kesusutan (kWh)"]), backgroundColor: 'rgba(255,99,132,0.5)', type: 'bar', yAxisID: 'y' },
        { label: 'Persentase (%)', data: data.map(r => r["Persentase (%)"]), borderColor: 'red', fill: false, yAxisID: 'y2' }
      ];
      break;

    case 'pelanggan':
      datasets = [
        { label: 'Pertumbuhan Pelanggan', data: data.map(r => r["Customer Growth Rate"]), borderColor: 'purple', fill: false },
        { label: 'Konsumsi per Pelanggan', data: data.map(r => r["Terjual (kWh)"] / r["Pelanggan"]), type: 'bar', backgroundColor: 'rgba(0,123,255,0.5)' }
      ];
      break;
  }

  chartInstance = new Chart(document.getElementById('chartCanvas'), {
    type: 'line',
    data: { labels, datasets },
    options: {
      responsive: true,
      scales: {
        y: { beginAtZero: true },
        y2: {
          type: 'linear',
          position: 'right',
          beginAtZero: true,
          grid: { drawOnChartArea: false }
        }
      }
    }
  });
}

async function updateChart() {
  const type = document.getElementById('chartSelect').value;
  const year = document.getElementById('yearSelect').value;
  let data = await fetchData();

  if (year !== "all") {
    data = data.filter(row => new Date(row["YearMonth"]).getFullYear().toString() === year);
  }

  updateChartType(data, type);
}

document.addEventListener("DOMContentLoaded", function () {
  updateChart();
});

document.addEventListener("DOMContentLoaded", function () {
  let contentStatistik = document.querySelector("#content-statistik");
  let contentPrediksi = document.querySelector("#content-prediksi");

  let statistikObserver = new IntersectionObserver(function (entries, observer) {
      entries.forEach(entry => {
          if (entry.isIntersecting) {
              contentStatistik.classList.add("show");
              statistikObserver.unobserve(contentStatistik);
          }
      });
  }, { threshold: 0.3 });

  let prediksiObserver = new IntersectionObserver(function (entries, observer) {
      entries.forEach(entry => {
          if (entry.isIntersecting) {
              contentPrediksi.classList.add("show");
              prediksiObserver.unobserve(contentPrediksi);
          }
      });
  }, { threshold: 0.3 });

  statistikObserver.observe(contentStatistik);
  prediksiObserver.observe(contentPrediksi);
});

function showSection(sectionId) {
  let sections = ['content-statistik', 'content-prediksi'];

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

window.onload = function() {
  showSection('content-statistik');
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
