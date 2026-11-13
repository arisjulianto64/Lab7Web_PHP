<?php
$judul = "Latihan 3 - Perulangan dan Array";
include "includes/header.php";

$mahasiswa = ["Aris Yulianto", "Agus Bimantoro", "Rasya Fadilah", "Dodi Rahmat", "Eko Sulistio", "Fajar Bustomi", "Gita Gutawa"]; // 3 nama tambahan: Eka, Fajar, Gita

echo "<h3>Daftar Mahasiswa</h3><ol>";
foreach ($mahasiswa as $nama) {
    echo "<li>" . htmlspecialchars($nama) . "</li>";
}
echo "</ol>";
echo "<p>Jumlah mahasiswa: " . count($mahasiswa) . "</p>";

include "includes/footer.php";
