<?php
// inisialisasi variabel untuk koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "perpustakaan";

// melakukan koneksi ke database
$conn = mysqli_connect($servername, $username, $password, $dbname);

// mengecek koneksi apabila terjadi error
if (!$conn) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}
