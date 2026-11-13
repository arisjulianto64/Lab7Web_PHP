<?php
$judul = "Latihan 7 - Pengolahan Data Sederhana";

$error = null;
$barang = "";
$subtotal = null;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $barang      = trim($_POST["barang"] ?? "");
    $hargaInput  = $_POST["harga"] ?? "";
    $jumlahInput = $_POST["jumlah"] ?? "";

    if ($barang === "" || !is_numeric($hargaInput) ||
        !ctype_digit((string)$jumlahInput) ||
        (float)$hargaInput < 0 || (int)$jumlahInput < 1) {
        $error = "Periksa kembali nama barang, harga, dan jumlah.";
    } else {
        $harga    = (float)$hargaInput;
        $jumlah   = (int)$jumlahInput;
        $subtotal = $harga * $jumlah;
    }
}

include "includes/header.php";
?>
<form method="POST">
    <label>Nama barang <input name="barang" value="<?= e($_POST['barang'] ?? '') ?>" required></label>
    <label>Harga <input name="harga" type="number" min="0" step="0.01" value="<?= e($_POST['harga'] ?? '') ?>" required></label>
    <label>Jumlah <input name="jumlah" type="number" min="1" step="1" value="<?= e($_POST['jumlah'] ?? '') ?>" required></label>
    <button type="submit">Hitung</button>
</form>
<?php
if ($error !== null) {
    echo "<div class='error'>" . htmlspecialchars($error) . "</div>";
} elseif ($subtotal !== null) {
    echo "<div class='ok'>";
    echo "<p>Barang: " . htmlspecialchars($barang) . "</p>";
    echo "<p>Subtotal: " . formatRupiah($subtotal) . "</p>";
    echo "</div>";
}
?>
<p><small>Uji: harga desimal (mis. 2500.50), jumlah 0, jumlah negatif, dan data tidak sesuai. Validasi HTML hanya membantu pengguna; validasi PHP tetap pemeriksaan utama (coba nonaktifkan validasi lewat DevTools).</small></p>
<?php include "includes/footer.php"; ?>
