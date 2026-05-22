<?php
$db = new SQLite3('jamuku.db');

echo "<h1>Daftar Racikan</h1>";

$result = $db->query("
SELECT * FROM racikan
");

while($row = $result->fetchArray()){

    echo "<h3>".$row['nama_racikan']."</h3>";

    $ids = explode(",",$row['isi_bahan']);

    foreach($ids as $id){

        $bahan = $db->querySingle(
          "SELECT nama FROM bahan
           WHERE id=$id"
        );

        echo "- ".$bahan."<br>";
    }

    echo "<hr>";
}
?>