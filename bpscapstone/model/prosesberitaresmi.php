<?php
include 'db.php';

class BeritaResmiModel {
    private $conn;

    public function __construct($dbConn) {
        $this->conn = $dbConn;
    }

    public function getRecentBerita($limit = 6) {
        $query = "SELECT * FROM beritaresmi ORDER BY tgl_terbit DESC LIMIT ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $limit);
        $stmt->execute();
        $result = $stmt->get_result();
        
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getAllBerita() {
        $sql = "SELECT * FROM beritaresmi ORDER BY tgl_terbit DESC";
        $result = $this->conn->query($sql);

        $beritaList = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $beritaList[] = $row;
            }
        }

        return $beritaList;
    }

    public function getBeritaById($id) {
        if (!is_numeric($id) || $id <= 0) {
            throw new Exception("ID tidak valid");
        }

        $sql = "SELECT * FROM beritaresmi WHERE id_beritaresmi = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function getRandomBerita($excludeId, $limit = 5) {
        if (!is_numeric($excludeId) || $excludeId <= 0) {
            throw new Exception("ID yang dikecualikan tidak valid");
        }

        $sql = "SELECT * FROM beritaresmi WHERE id_beritaresmi != ? ORDER BY RAND() LIMIT ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $excludeId, $limit);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function updateBerita($id, $judul, $deskripsi, $tgl_terbit, $file_gambar) {
        if (!is_numeric($id) || $id <= 0 || empty($judul) || empty($deskripsi) || empty($tgl_terbit)) {
            throw new Exception("Input tidak valid");
        }

        if ($file_gambar && !in_array(pathinfo($file_gambar, PATHINFO_EXTENSION), ['svg'])) {
            $filePath = '../uploads/news/' . $file_gambar;

            if (!file_exists($filePath)) {
                throw new Exception("File gambar tidak ditemukan: " . $filePath);
            }

            if (in_array(pathinfo($file_gambar, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif'])) {
                if (!getimagesize($filePath)) {
                    throw new Exception("File gambar tidak valid.");
                }
            }
        }

        $sql = "UPDATE beritaresmi SET judul = ?, deskripsi = ?, tgl_terbit = ?, file_gambar = ? WHERE id_beritaresmi = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssssi", $judul, $deskripsi, $tgl_terbit, $file_gambar, $id);
        return $stmt->execute();
    }

    public function deleteBerita($id) {
        if (!is_numeric($id) || $id <= 0) {
            throw new Exception("ID tidak valid");
        }

        $sql = "DELETE FROM beritaresmi WHERE id_beritaresmi = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>
