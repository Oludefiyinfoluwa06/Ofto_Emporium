<?php
    session_start();

    if (isset($_GET['id'])) {
        $productId = (int)$_GET['id'];

        $_SESSION['cart'] = array_values(array_filter($_SESSION['cart'], function ($item) use ($productId) {
            return $item['id'] !== $productId;
        }));

        header('Location: cart.php');
        exit();
    }

    header('Location: products.php');
    exit();
?>
