<?php
    session_start();

    if (isset($_GET['id'])) {
        $productId = (int)$_GET['id'];

        include "./config/db_connect.php";

        $productQuery = "SELECT * FROM products WHERE id = $productId";
        $productResult = mysqli_query($conn, $productQuery);

        if ($productResult && $product = mysqli_fetch_assoc($productResult)) {
            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = [];
            }

            $existingItem = array_search($productId, array_column($_SESSION['cart'], 'id'));

            if ($existingItem !== false) {
                $_SESSION['cart'][$existingItem]['quantity']++;
            } else {
                $_SESSION['cart'][] = [
                    'id' => $productId,
                    'quantity' => 1,
                    'name' => $product['product_name'],
                    'price' => $product['product_price'],
                    'image' => $product['product_img']
                ];
            }

            header('Location: cart.php');
            exit();
        }
    }

    header('Location: products.php');
    exit();
?>
