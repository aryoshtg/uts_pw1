<?php
session_start();

$id = $_GET['id'];

if (isset($_SESSION['cart']['bahan'][$id])) {
    
    $porsi_sekarang = $_SESSION['cart']['bahan'][$id]['porsi'];
    
    $porsi_baru = $porsi_sekarang - 1;
    
    if ($porsi_baru <= 0) {
        unset($_SESSION['cart']['bahan'][$id]);
    } else {
        $_SESSION['cart']['bahan'][$id]['porsi'] = $porsi_baru;
    }
}

header("Location: keranjang.php");
exit();
?>