<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/profilestyle.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Space+Grotesk:wght@300..700&display=swap" rel="stylesheet">
    <link rel="icon" href="./img/logosolobps.png" type="image/png">
    <title>Document</title>
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
    <div class="sidebar">
        <h3>Profile BPS</h3>
        <ul>
          <li><a href="#" onclick="showSection('arti-logo')">Arti Logo BPS</a></li>
          <li><a href="#" onclick="showSection('sejarah-bps')">Sejarah BPS</a></li>
        </ul>
      </div>

    <div id="arti-logo" class="profile-section">
        <div class="section-header">
            <h2>Arti Logo BPS</h2>
        </div>
        <hr class="separator">
    

        <div class="profile-flex-container">
            <div class="profile-text-container">
                <p>Logo pada Badan Pusat Statistik memiliki warna biru, hijau dan orange dan disetiap warna memiliki arti khusus, yaitu :</p>
                <ul>
                    <li class="biru"><strong>Biru</strong><br>Melambangkan kegiatan sensus penduduk yang dilakukan sepuluh tahun sekali pada setiap tahun yang berakhiran angka 0 (nol).</li>
                    <li class="hijau"><strong>Hijau</strong><br>Melambangkan kegiatan sensus pertanian yang dilakukan sepuluh tahun sekali pada setiap tahun yang berakhiran angka 3 (tiga).</li>
                    <li class="orange"><strong>Orange</strong><br>Melambangkan kegiatan sensus ekonomi yang dilakukan sepuluh tahun sekali pada setiap tahun yang berakhiran angka 6 (enam).</li>
                </ul>
            </div>
    
            <div class="image-container">
                <img src="./img/logosolobps.png" alt="Logo BPS">
            </div>
        </div>
    </div>
    
    <div id="sejarah-bps" class="sejarah-section">
        <div class="section-header">
            <h2>Sejarah BPS</h2>
        </div>
        <hr class="separator">
        <div class="sejarah-text-container">
            <p>
                Kegiatan statistik di Indonesia sudah dilaksanakan sejak masa Pemerintahan Hindia Belanda oleh suatu lembaga yang didirikan oleh Direktur Pertanian, Kerajinan, dan Perdagangan (Directeur Van Landbouw Nijverheld en Handel) di Bogor. Pada Februari 1920, lembaga tersebut bertugas mengolah dan mempublikasikan data statistik. Pada 24 September 1924, kegiatan statistik pindah ke Jakarta dengan nama Centraal Kantoor Voor De Statistiek (CKS) dan melaksanakan Sensus Penduduk pertama di Indonesia pada tahun 1930. Pada masa Pemerintahan Jepang di Indonesia pada tahun 1942-1945, CKS berubah nama menjadi Shomubu Chosasitsu Gunseikanbu dengan kegiatan memenuhi kebutuhan perang/militer.
            </p>
            <p>
                Setelah Kemerdekaan Republik Indonesia (RI) diproklamasikan pada tanggal 17 Agustus 1945, lembaga tersebut dinasionalisasikan dengan nama Kantor Penyelidikan Perangkaan Umum Republik Indonesia (KAPPURI) dan dipimpin oleh Mr. Abdul Karim Pringgodigdo. Setelah adanya Surat Edaran Kementerian Kemakmuran tanggal 12 Juni 1950 Nomor 219/S.C., lembaga KAPPURI dan CKS dilebur menjadi Kantor Pusat Statistik (KPS) dibawah tanggung jawab Menteri Kemakmuran.
            </p>
            <p>
                Berdasarkan Surat Keputusan Menteri Perekonomian Nomor P/44, KPS bertanggungjawab kepada Menteri Perekonomian. Selanjutnya, melalui SK Menteri Perekonomian tanggal 24 Desember 1953 Nomor IB.099/M kegiatan KPS dibagi dalam dua bagian yaitu Afdeling A (Bagian Riset) dan Afdeling B (Bagian penyelenggaraan dan Tata Usaha). Berdasarkan Keppres X nomor 172 tanggal 1 Juni 1957, KPS berubah menjadi Biro Pusat Statistik dan bertanggungjawab langsung kepada Perdana Menteri.
            </p>
            <p>
                Sesuai dengan UU No.6/1960 tentang Sensus, BPS menyelenggarakan Sensus Penduduk serentak di pada tahun 1961. Sensus Penduduk tersebut merupakan Sensus Penduduk pertama setelah Indonesia merdeka. Sensus Penduduk di tingkat provinsi dilaksanakan oleh Kantor Gubernur, dan di tingkat Kabupaten/Kotamadya dilaksanakan oleh kantor Bupati/Walikota, sedangkan pada tingkat Kecamatan dibentuk bagian yang melaksanakan Sensus Penduduk. Selanjutnya Penyelenggara Sensus di Kantor Gubernur dan Kantor Bupati/Walikota ditetapkan menjadi Kantor Sensus dan Statistik Daerah berdasarkan Keputusan Presidium Kabinet Nomor Aa/C/9 Tahun 1965.
            </p>
            <p>
                Berdasarkan Peraturan Pemerintah No.16/1968 yang mengatur tentang Organisasi dan Tata Kerja BPS di Pusat dan Daerah serta perubahannya menjadi PP No.6/1980, menyebutkan bahwa perwakilan BPS di daerah adalah Kantor Satistik Provinsi dan Kantor Statistik Kabupaten atau Kotamadya. Tentang Organisasi BPS ditetapkan kembali pada PP No. 2 Tahun 1992 yang disahkan pada 9 Januari 1992. Selanjutnya, Kedudukan, Fungsi, Tugas, Susunan Organisasi, dan Tata Kerja BPS diatur dengan Keputusan Presiden Nomor 6 Tahun 1992.
            </p>
            <p>
                Pada tanggal 19 Mei 1997 ditetapkan UU Nomor 16 Tahun 1997 tentang Statistik, dimana Biro Pusat Statistik diubah namanya menjadi “Badan Pusat Statistik”. Pada Keputusan Presiden No.86 Tahun 1998 tentang Badan Pusat Statistik, menetapkan bahwa perwakilan BPS di daerah merupakan Instansi Vertikal dengan nama BPS Provinsi, BPS Kabupaten, dan BPS Kotamadya. Serta pada tanggal 26 Mei 1999, ditetapkan PP Nomor 51 tahun 1999 tentang Penyelenggaraan Statistik di Indonesia.
            </p>
        </div>
    </div>
</div>

<div class="footer-container">
        <footer class="footer">
            <div class="footer-content">
                <div class="footer-left">
                    <img src="./img/logobps.svg" alt="Logo BPS" class="footer-logo">
                    <p>Badan Pusat Statistik Kota Samarinda (Statistics Samarinda)<br>
                    Jl. KH Ahmad Dahlan No. 33 Samarinda 75117<br>
                    Telp. 0541-743661 Fax 0541-735762<br>
                    E-mail: bps6472@bps.go.id</p>
                </div>

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

            <hr class="footer-divider">

            <div class="footer-bottom">
                <p>Hak Cipta © 2023 Badan Pusat Statistik</p>
            </div>
        </footer>
    </div>

    <script src="./js/profilescript.js"></script>
</body>
</html>