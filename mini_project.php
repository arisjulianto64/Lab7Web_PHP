<?php
/* ===== BAGIAN PEMROSESAN DATA (logika) ===== */
$data  = null;
$error = [];

// nilai awal form (agar input tidak hilang jika ada error)
$nama = $nim = $prodi = $semesterInput = $email = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nama          = trim($_POST["nama"] ?? "");
    $nim           = trim($_POST["nim"] ?? "");
    $prodi         = trim($_POST["prodi"] ?? "");
    $semesterInput = trim($_POST["semester"] ?? "");
    $email         = trim($_POST["email"] ?? "");

    if ($nama === "")  $error[] = "Nama wajib diisi.";
    if ($nim === "")   $error[] = "NIM wajib diisi.";
    if ($prodi === "") $error[] = "Program studi wajib diisi.";

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error[] = "Format email tidak valid.";
    }

    if (!ctype_digit((string)$semesterInput) ||
        (int)$semesterInput < 1 || (int)$semesterInput > 14) {
        $error[] = "Semester harus berupa angka 1–14.";
    }

    if (!$error) {
        $data = compact("nama", "nim", "prodi", "email");
        $data["semester"] = (int)$semesterInput;
    }
}

/* ===== BAGIAN TAMPILAN (HTML) ===== */
$judul = "Mini Project - Formulir Data Mahasiswa";
include "includes/header.php";
?>

<?php if ($error): ?>
    <div class="error">
        <strong>Terdapat kesalahan:</strong>
        <ul>
            <?php foreach ($error as $pesan): ?>
                <li><?= e($pesan) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<?php if ($data): ?>
    <div class="ok">
        <h3>Data Mahasiswa Diterima</h3>
        <table>
            <tr><th>Nama</th><td><?= e($data["nama"]) ?></td></tr>
            <tr><th>NIM</th><td><?= e($data["nim"]) ?></td></tr>
            <tr><th>Program Studi</th><td><?= e($data["prodi"]) ?></td></tr>
            <tr><th>Semester</th><td><?= e($data["semester"]) ?></td></tr>
            <tr><th>Email</th><td><?= e($data["email"]) ?></td></tr>
        </table>
    </div>
<?php endif; ?>

<form method="POST" action="">
    <label for="nama">Nama</label>
    <input id="nama" name="nama" type="text" value="<?= e($nama) ?>">

    <label for="nim">NIM</label>
    <input id="nim" name="nim" type="text" value="<?= e($nim) ?>">

    <label for="prodi">Program Studi</label>
    <input id="prodi" name="prodi" type="text" value="<?= e($prodi) ?>">

    <label for="semester">Semester (1–14)</label>
    <input id="semester" name="semester" type="text" value="<?= e($semesterInput) ?>">

    <label for="email">Email</label>
    <input id="email" name="email" type="text" value="<?= e($email) ?>">

    <button type="submit">Kirim</button>
</form>
<p><small>Sengaja tanpa atribut <code>required</code>/<code>type=email</code> agar validasi server-side bisa diuji langsung.</small></p>

<?php include "includes/footer.php"; ?>
