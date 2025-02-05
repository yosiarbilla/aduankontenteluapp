<?php
try {
    $conn = new PDO("mysql:host=localhost;dbname=aduanapp", "root", "");
    echo "Koneksi berhasil!";
} catch(PDOException $e) {
    echo "Koneksi gagal: " . $e->getMessage();
}
?>