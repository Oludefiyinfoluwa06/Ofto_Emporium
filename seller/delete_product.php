<?php

    include "./config/db_connect.php";
    
    $id = $_GET["id"];

    $result = mysqli_query($conn, "DELETE FROM products WHERE id = '$id'");

    if ($result) {
        header("Location: products.php?product_deletion_successful");
        exit();
    } else {
        header("Location: products.php?product_deletion_unsuccessful");
        exit();
    }

?>