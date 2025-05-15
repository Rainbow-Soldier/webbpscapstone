<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Layanan Statistik</title>
  <link rel="stylesheet" href="./style/layananstyle.css" />
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/papaparse@5.4.1/papaparse.min.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Space+Grotesk:wght@300..700&display=swap" rel="stylesheet">
  <link rel="icon" href="./img/logosolobps.png" type="image/png">
</head>
<body>

  <div class="navbar-wrapper">
    <nav class="navbar">
      <img src="./img/logobps.svg" alt="Logo BPS">
      <div class="nav-links">
                <a href="Beranda">Beranda</a>
            <a href="Profile">Profile</a>
            <a href="Layanan">Layanan</a>
            <a href="Berita">Berita</a>
      </div>
    </nav>
  </div>

  <div class="layout-container">
    <!-- Sidebar -->
    <div class="sidebar">
      <h3>Menu Layanan</h3>
      <ul>
        <li><a href="#" onclick="showSection('content-statistik')">Layanan Statistik</a></li>
        <li><a href="#" onclick="showSection('content-prediksi')">Prediksi Penjualan</a></li>
      </ul>
    </div>
  
    <!-- Konten -->
    <div class="main-content">
      <!-- Statistik -->
      <div id="content-statistik" class="content-section">
  <h1>Statistik Interaktif</h1>
  <hr class="separator">
  <div class="chart-container">
    <!-- Controls -->
    <div class="controls">
      <div class="control-item">
        <label for="chartSelect">Pilih Grafik:</label>
        <select id="chartSelect" class="select-chart" onchange="updateChart()">
          <option value="produksi">Tren Produksi dan Listrik Terjual</option>
          <option value="efisiensi">Tren Efisiensi Sistem</option>
          <option value="susut">Analisis Susut Listrik</option>
          <option value="pelanggan">Pertumbuhan Pelanggan vs Konsumsi</option>
        </select>
      </div>
      <div class="control-item">
        <label for="yearSelect">Pilih Tahun:</label>
        <select id="yearSelect" class="select-year" onchange="updateChart()">
          <option value="all">Semua</option>
          <option value="2002">2002</option>
          <option value="2003">2003</option>
          <option value="2004">2004</option>
          <option value="2005">2005</option>
          <option value="2006">2006</option>
          <option value="2007">2007</option>
          <option value="2008">2008</option>
          <option value="2009">2009</option>
          <option value="2010">2010</option>
          <option value="2011">2011</option>
          <option value="2012">2012</option>
          <option value="2013">2013</option>
          <option value="2014">2014</option>
          <option value="2015">2015</option>
          <option value="2016">2016</option>
          <option value="2018">2018</option>
          <option value="2019">2019</option>
          <option value="2020">2020</option>
          <option value="2021">2021</option>
          <option value="2022">2022</option>
        </select>
      </div>

      <!-- Button Download -->
      <div class="control-item">
        <label>&nbsp;</label> <!-- Supaya sejajar -->
        <a href="./data/data_pln_encode.csv" download class="download-btn">Download Data</a>
      </div>
    </div>

    <canvas id="chartCanvas"></canvas>
  </div>
</div>

  
      <div id="content-prediksi" class="content-section">
        <h1>Prediksi Penjualan</h1>
        <hr class="separator">
        <div class="predict-container">
          <form id="predictForm" onsubmit="showResult(event)">
            <div class="form-row">
              <div class="form-group">
                <div class="input-container">
                  <input type="number" step="any" name="Produksi_kWh" required placeholder=" ">
                  <label>Produksi (kWh)</label>
                </div>
              </div>
              <div class="form-group">
                <div class="input-container">
                  <input type="number" step="any" name="Kesusutan_kWh" required placeholder=" ">
                  <label>Kesusutan (kWh)</label>
                </div>
              </div>
              <div class="form-group">
                <div class="input-container">
                  <input type="number" step="any" name="Persentase_" required placeholder=" ">
                  <label>Persentase (%)</label>
                </div>
              </div>
              <div class="form-group">
                <div class="input-container">
                  <input type="number" step="any" name="Efficiency_" required placeholder=" ">
                  <label>Efficiency</label>
                </div>
              </div>
              <div class="form-group">
                <div class="input-container">
                  <input type="number" step="any" name="Energy_Loss_kWh" required placeholder=" ">
                  <label>Energy Loss kWh</label>
                </div>
              </div>
              <div class="form-group">
                <div class="input-container">
                  <input type="number" step="any" name="Customer_Growth_Rate" required placeholder=" ">
                  <label>Customer Growth Rate</label>
                </div>
              </div>
              <div class="form-group">
                <div class="input-container">
                  <input type="number" step="any" name="Quarter_Q1" required placeholder=" ">
                  <label>Quarter Q1</label>
                </div>
              </div>
              <div class="form-group">
                <div class="input-container">
                  <input type="number" step="any" name="Quarter_Q2" required placeholder=" ">
                  <label>Quarter Q2</label>
                </div>
              </div>
              <div class="form-group">
                <div class="input-container">
                  <input type="number" step="any" name="Quarter_Q3" required placeholder=" ">
                  <label>Quarter Q3</label>
                </div>
              </div>
              <div class="form-group">
                <div class="input-container">
                  <input type="number" step="any" name="Quarter_Q4" required placeholder=" ">
                  <label>Quarter Q4</label>
                </div>
              </div>
            </div>

            <button type="submit">Prediksi</button>
          </form>
        </div>
        <div id="hasilSection">
          <h2>Hasil Prediksi</h2>
          <hr class="separator">
          <div class="result-container">
            <div id="hasil"></div>
          </div>
        </div>
      </div>
    </div>
  </div>


  <div class="footer-container">
    <footer class="footer">
        <div class="footer-content">
            <!-- Kiri: Logo & Alamat -->
            <div class="footer-left">
                <img src="./img/logobps.svg" alt="Logo BPS" class="footer-logo">
                <p>Badan Pusat Statistik Kota Samarinda (Statistics Samarinda)<br>
                Jl. KH Ahmad Dahlan No. 33 Samarinda 75117<br>
                Telp. 0541-743661 Fax 0541-735762<br>
                E-mail: bps6472@bps.go.id</p>
            </div>

            <!-- Kanan: Tentang Kelompok -->
            <div class="footer-right">
                <h4>Anggota Kelompok Kami</h4>
                <ul>
                    <li>Ikmul😎🫰</li>
                    <li>Luntang🥵</li>
                    <li>Wawan😓🥀💔</li>
                    <li>Zaksal🥰</li>
                    <li>ASSnan💩</li>
                    <li>Pipin🤓☝️</li>
                </ul>
            </div>
        </div>
        
        <!-- Garis Pemisah -->
        <hr class="footer-divider">

        <!-- Teks Hak Cipta -->
        <div class="footer-bottom">
            <p>Hak Cipta © 2023 Badan Pusat Statistik</p>
        </div>
    </footer>
</div>



  <script src="./js/layananscript.js"></script>
</body>
</html>
