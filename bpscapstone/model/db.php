<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "bpscapstone";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
