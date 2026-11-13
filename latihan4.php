<?php
$judul = "Latihan 4 - Membuat Function";
include "includes/header.php";

function hitungDiskon($harga, $persen) {
    $potongan = $harga * ($persen / 100);
    return $harga - $potongan;
}

// Function tambahan
function hitungLuasPersegiPanjang($panjang, $lebar) {
    return $panjang * $lebar;
}

function tentukanKelulusan($nilai) {
    return $nilai >= 60 ? "LULUS" : "TIDAK LULUS";
}

$hargaAkhir = hitungDiskon(200000, 15);
echo "<p>Harga setelah diskon 15% dari Rp200.000: Rp" . number_format($hargaAkhir, 0, ",", ".") . "</p>";
echo "<p>Luas persegi panjang 8 x 4 = " . hitungLuasPersegiPanjang(12, 6) . "</p>";
echo "<p>Nilai 80 : " . tentukanKelulusan(80) . "</p>";
echo "<p>Nilai 40 : " . tentukanKelulusan(40) . "</p>";

include "includes/footer.php";
