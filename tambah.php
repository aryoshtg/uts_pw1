<?php
session_start();

$id = $_GET['id'];

if (isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}
if (isset($_SESSION['cart']['bahan'])) {
    $_SESSION['cart']['bahan'] = [];
}

if (isset($_SESSION['cart']['bahan'][$id])) {
    $_SESSION['cart']['bahan'][$id] = [
        'porsi' => 1
    ];
}

else {
    $_SESSION['cart']['bahan']['$id']['porsi']++;
}

header("Location: keranjang.php");
exit();
?>