<?php
session_start();
$db = new SQLite3('jamuku.db');

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $bahan_dipilih = isset($_POST['bahan']) ? $_POST['bahan'] : [];
    $porsi = intval($_POST['porsi']);

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
    if (!isset($_SESSION['cart']['bahan'])) {
        $_SESSION['cart']['bahan'] = [];
    }

    foreach ($bahan_dipilih as $id_bahan) {
        $_SESSION['cart']['bahan'][$id_bahan] = [
            'porsi' => $porsi
        ];
    }

    header("Location: keranjang.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Jamuku</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<h1>Jamuku</h1>

<style>
    table {
        width: 100%;
        max-width: 600px;
        border-collapse: collapse;
        margin-bottom: 20px;
    }
    th, td {
        padding: 10px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }
    th {
        background-color: #f2f2f2;
    }
    .porsi-section {
        margin: 20px 0;
    }
    .porsi-section input {
        padding: 5px;
        width: 60px;
    }
    button {
        padding: 10px 20px;
        background-color: #4CAF50;
        color: white;
        border: none;
        cursor: pointer;
        border-radius: 4px;
    }
    button:hover {
        background-color: #45a049;
    }
</style>

<form method="POST">
    <table>
        <thead>
            <tr>
                <th width="8%" style="text-align: center;">Pilih</th>
                <th width="22%">Nama Bahan</th>
                <th width="40%">Khasiat / Deskripsi</th>
                <th width="15%">Harga</th>
                <th width="15%">Jenis</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $result = $db->query("SELECT * FROM bahan");
            while($row = $result->fetchArray()){
                echo "<tr>";
                // 1. Kolom Checkbox (Pilih)
                echo "<td align='center'><input type='checkbox' name='bahan[]' value='".$row['id']."'></td>";
                
                // 2. Kolom Nama Bahan
                echo "<td><b>" . $row['nama'] . "</b></td>";
                
                // 3. Kolom Deskripsi / Khasiat
                echo "<td><small>" . $row['deskripsi'] . "</small></td>";
                
                // 4. Kolom Harga
                echo "<td>Rp " . number_format($row['harga'], 0, ',', '.') . "</td>";
                
                // 5. Kolom Jenis
                echo "<td>" . $row['jenis'] . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>

    <div class="porsi-section">
        <label for="porsi"><b>Porsi:</b></label>
        <input type="number" id="porsi" name="porsi" value="1" min="1">
    </div>

    <button type="submit">Lihat Keranjang</button>
</form>

</body>
</html>