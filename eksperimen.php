<?php
$judul = "Eksperimen Mandiri";
include "includes/header.php";

/* ---------- 1. Rata-rata tiga komponen nilai ---------- */
function rataRata(array $nilai) {
    return count($nilai) ? array_sum($nilai) / count($nilai) : 0;
}

$hasilRata = null;
if (isset($_POST["hitung_rata"])) {
    $n1 = $_POST["n1"] ?? ""; $n2 = $_POST["n2"] ?? ""; $n3 = $_POST["n3"] ?? "";
    if (is_numeric($n1) && is_numeric($n2) && is_numeric($n3)) {
        $hasilRata = rataRata([(float)$n1, (float)$n2, (float)$n3]);
    } else {
        $errRata = "Ketiga nilai harus berupa angka.";
    }
}

/* ---------- 2. Cari nama dari array (GET) ---------- */
$dataMhs = ["Aris Yulianto", "Agus Bimantoro", "Kayla Putri", "Dani Saputra", "Eko Sulistio", "Fatur Rajib"];
$hasilCari = null;
$kata = trim($_GET["kata"] ?? "");
if (isset($_GET["kata"]) && $kata !== "") {
    $hasilCari = array_filter($dataMhs, fn($m) => stripos($m, $kata) !== false);
}

/* ---------- 4. Validasi NIM (angka saja, 8–12 digit) ---------- */
function validasiNIM($nim) {
    if ($nim === "") return "NIM wajib diisi.";
    if (!ctype_digit($nim)) return "NIM hanya boleh berisi angka.";
    if (strlen($nim) < 8 || strlen($nim) > 12) return "NIM harus 8–12 digit.";
    return null;
}
$pesanNIM = null; $nimOK = false;
if (isset($_POST["cek_nim"])) {
    $nimIn = trim($_POST["nim"] ?? "");
    $pesanNIM = validasiNIM($nimIn);
    $nimOK = $pesanNIM === null;
}
?>

<h2>1. Rata-rata Nilai</h2>
<form method="POST">
    <label>Nilai 1 <input name="n1" value="<?= e($_POST['n1'] ?? '') ?>"></label>
    <label>Nilai 2 <input name="n2" value="<?= e($_POST['n2'] ?? '') ?>"></label>
    <label>Nilai 3 <input name="n3" value="<?= e($_POST['n3'] ?? '') ?>"></label>
    <button name="hitung_rata" type="submit">Hitung Rata-rata</button>
</form>
<?php if ($hasilRata !== null): ?>
    <div class="ok">Rata-rata: <?= number_format($hasilRata, 2) ?> (Predikat <?= tentukanPredikat($hasilRata) ?>)</div>
<?php elseif (isset($errRata)): ?>
    <div class="error"><?= e($errRata) ?></div>
<?php endif; ?>

<hr>
<h2>2. Cari Nama Mahasiswa (GET)</h2>
<form method="GET">
    <label for="kata">Kata kunci nama</label>
    <input id="kata" name="kata" value="<?= e($kata) ?>">
    <button type="submit">Cari</button>
</form>
<?php if ($hasilCari !== null): ?>
    <?php if ($hasilCari): ?>
        <div class="ok">Ditemukan <?= count($hasilCari) ?> hasil:
            <ul><?php foreach ($hasilCari as $m): ?><li><?= e($m) ?></li><?php endforeach; ?></ul>
        </div>
    <?php else: ?>
        <div class="error">Tidak ada nama yang cocok dengan "<?= e($kata) ?>".</div>
    <?php endif; ?>
<?php endif; ?>

<hr>
<h2>3. Function Format Rupiah</h2>
<p>
    <?php foreach ([1500, 150000, 2750000, 1234567.89] as $h): ?>
        <?= e($h) ?> &rarr; <?= formatRupiah($h) ?><br>
    <?php endforeach; ?>
</p>

<hr>
<h2>4. Validasi NIM (angka saja, 8–12 digit)</h2>
<form method="POST">
    <label for="nim">NIM</label>
    <input id="nim" name="nim" value="<?= e($_POST['nim'] ?? '') ?>">
    <button name="cek_nim" type="submit">Cek NIM</button>
</form>
<?php if (isset($_POST["cek_nim"])): ?>
    <?php if ($nimOK): ?><div class="ok">NIM valid.</div>
    <?php else: ?><div class="error"><?= e($pesanNIM) ?></div><?php endif; ?>
<?php endif; ?>

<hr>
<h2>5. Tombol Reset vs Pemrosesan Ulang di Server</h2>
<form method="POST">
    <label for="contoh">Isi sesuatu lalu coba tombol di bawah</label>
    <input id="contoh" name="contoh" value="<?= e($_POST['contoh'] ?? '') ?>">
    <button type="submit" name="kirim_contoh">Kirim</button>
    <button type="reset">Reset</button>
</form>
<p><small>
    <strong>Reset</strong> hanya dijalankan di browser (client-side): mengembalikan input ke nilai awal HTML (<code>value</code> bawaan), tanpa mengirim request ke server. Karena input di atas diisi ulang oleh PHP (<code>value="..."</code>) setelah Kirim, Reset akan mengembalikannya ke nilai hasil kiriman terakhir, bukan mengosongkan.<br>
    <strong>Kirim ulang/refresh</strong> membuat browser mengirim request baru ke server sehingga PHP memproses ulang data (server-side).
</small></p>

<?php include "includes/footer.php"; ?>
