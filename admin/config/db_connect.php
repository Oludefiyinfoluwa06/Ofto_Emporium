<?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "e-store";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        die("Error connecting to database". mysqli_connect_error());
    }

?>