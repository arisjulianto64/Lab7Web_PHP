<?php
$judul = "Latihan 2 - Variabel, Operator, dan Percabangan";
include "includes/header.php";

$nama  = "Aris";
$tugas = 89;
$uts   = 87;
$uas   = 90;

$nilaiAkhir = ($tugas * 0.30) + ($uts * 0.30) + ($uas * 0.40);
$predikat   = tentukanPredikat($nilaiAkhir);

echo "<h3>Data Utama</h3>";
echo "Nama: " . htmlspecialchars($nama) . "<br>";
echo "Tugas: $tugas | UTS: $uts | UAS: $uas<br>";
echo "Nilai akhir: " . number_format($nilaiAkhir, 2) . "<br>";
echo "Predikat: " . $predikat;

// Uji beberapa kombinasi nilai
$uji = [
    ["Jaki",  90, 90, 96],
    ["Arya", 86, 79, 86],
    ["Saipul",  76, 60, 62],
    ["Rahwan",   40, 60, 35],
];
echo "<h3>Uji Kombinasi Nilai</h3>";
echo "<table><tr><th>Nama</th><th>Tugas</th><th>UTS</th><th>UAS</th><th>Nilai Akhir</th><th>Predikat</th></tr>";
foreach ($uji as [$n, $t, $u, $a]) {
    $akhir = ($t * 0.30) + ($u * 0.30) + ($a * 0.40);
    echo "<tr><td>" . htmlspecialchars($n) . "</td><td>$t</td><td>$u</td><td>$a</td><td>"
        . number_format($akhir, 2) . "</td><td>" . tentukanPredikat($akhir) . "</td></tr>";
}
echo "</table>";

include "includes/footer.php";
