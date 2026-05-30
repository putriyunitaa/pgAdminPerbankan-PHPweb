<?php
// Konfigurasi koneksi database
$host     = "localhost";
$port     = "5432";
$dbname   = "perbankan";
$user     = "postgres";
$password = "SQLputri8"; 
// Buat string koneksi
$conn_string = "host=$host port=$port dbname=$dbname user=$user password=$password";

// Coba koneksi
$conn = pg_connect($conn_string);

if (!$conn) {
    die("❌ Koneksi gagal: " . pg_last_error());
} else {
    // echo "✅ Koneksi berhasil ke database $dbname";
}
?>
