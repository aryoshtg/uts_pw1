<?php
$db = new SQLite3('jamuku.db');

$nama = $_POST['nama_racikan'];
$bahan = implode(",", $_POST['bahan']);

$stmt = $db->prepare("
INSERT INTO racikan
(nama_racikan, isi_bahan)
VALUES (?,?)
");

$stmt->bindValue(1,$nama);
$stmt->bindValue(2,$bahan);

$stmt->execute();

echo "
<h2>Racikan berhasil disimpan!</h2>
<a href='lihat_racikan.php'>
Lihat Racikan
</a>
";
?>