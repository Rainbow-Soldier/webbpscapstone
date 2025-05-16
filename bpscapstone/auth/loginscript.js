$('#loginForm').on('submit', function(e) {
    e.preventDefault();

    $.ajax({
        url: 'proses_login.php',
        type: 'POST',
        data: $(this).serialize(),
        success: function(res) {
            if (res == 'sukses') {
                window.location.href = '../admin/dashboardadmin.php';
            } else if (res == 'developer') {
                window.location.href = '../admin/dashboarddeveloper.php';
            } else if (res == 'menunggu') {
                $('#pesan').text('Menunggu persetujuan developer...');
                cekStatus(); 
            } else {
                $('#pesan').text('Username atau password salah!');
            }
        }
    });
});

function cekStatus() {
    setInterval(function() {
        $.ajax({
            url: '../auth/cek_status.php',
            method: 'GET',
            success: function(res) {
                if (res == 'sudah_login') {
                    window.location.href = '../admin/dashboardadmin.php';
                }
            }
        });
    }, 3000); 
}
