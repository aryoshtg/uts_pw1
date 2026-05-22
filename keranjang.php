<?php
session_start();
$db = new SQLite3('jamuku.db');

$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
$total = 0;

echo "<h1>Keranjang Belanja</h1>";

if (!empty($cart['bahan'])) {
    foreach ($cart['bahan'] as $id => $item) {
        
        $result = $db->querySingle("SELECT * FROM bahan WHERE id=$id", true);

        if ($result) {
            $porsi = $item['porsi'];
            $subtotal = $result['harga'] * $porsi;
            $total += $subtotal;

            echo $result['nama'] . " (" . $porsi . " porsi) - Rp " . $subtotal;
            
            echo " <a href='tambah.php?id=" . $id . "'>[Tambah]</a>";
            echo " <a href='hapus.php?id=" . $id . "'>[Hapus]</a>";
            echo "<br><br>";
        }
    }
} else {
    echo "Keranjang kosong<br><br>";
}

echo "<h2>Total: Rp " . $total . "</h2>";
echo "<a href='index.php'>Kembali</a>";
?>

<h3>Simpan Racikan</h3>
<form action="simpan_racikan.php" method="POST">
    <input type="text" name="nama_racikan" placeholder="Nama racikan..." required>
    
    <?php
    if (!empty($cart['bahan'])) {
        foreach ($cart['bahan'] as $id => $item) {
            echo "<input type='hidden' name='bahan[]' value='" . $id . "'>";
        }
    }
    ?>
    
    <button type="submit">Simpan Racikan</button>
</form>
<br>
<a href="lihat_racikan.php">Lihat Semua Racikan</a>