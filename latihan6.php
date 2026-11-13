<?php $judul = "Latihan 6 - Memproses Form dengan POST"; include "includes/header.php"; ?>
<form method="POST" action="">
    <label for="nama">Nama:</label>
    <input id="nama" name="nama" type="text" required>
    <label for="prodi">Program Studi:</label>
    <input id="prodi" name="prodi" type="text" required>
    <button type="submit" name="kirim">Kirim Data</button>
</form>
<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nama  = trim($_POST["nama"] ?? "");
    $prodi = trim($_POST["prodi"] ?? "");

    if ($nama === "" || $prodi === "") {
        echo "<div class='error'>Semua kolom wajib diisi.</div>";
    } else {
        echo "<div class='ok'><h3>Data diterima</h3>";
        echo "Nama: " . htmlspecialchars($nama, ENT_QUOTES, "UTF-8") . "<br>";
        echo "Program Studi: " . htmlspecialchars($prodi, ENT_QUOTES, "UTF-8") . "</div>";
    }
}
?>
<p><small>Uji dengan input kosong (spasi saja) serta karakter seperti <code>"</code> dan <code>&lt;b&gt;tebal&lt;/b&gt;</code>.</small></p>
<?php include "includes/footer.php"; ?>
