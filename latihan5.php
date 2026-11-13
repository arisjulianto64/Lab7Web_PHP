<?php $judul = "Latihan 5 - Memproses Form dengan GET"; include "includes/header.php"; ?>
<form method="GET" action="">
    <label for="kata">Kata kunci:</label>
    <input id="kata" name="kata" type="text">
    <button type="submit">Cari</button>
</form>
<?php
if (isset($_GET["kata"])) {
    $kata = trim($_GET["kata"]);
    echo "<p>Kata kunci: " . htmlspecialchars($kata, ENT_QUOTES, "UTF-8") . "</p>";
}
?>
<p><small>Amati URL setelah form dikirim (muncul <code>?kata=...</code>). Jangan gunakan GET untuk kata sandi atau data sensitif.</small></p>
<?php include "includes/footer.php"; ?>
