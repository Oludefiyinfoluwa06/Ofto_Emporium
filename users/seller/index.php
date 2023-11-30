<?php
    session_start();

    $seller_email = $_SESSION["seller_email"];

    if (!isset($seller_email)) {
        header("Location: login.php");
        exit();
    }

    include "../config/db_connect.php";

    $sql = "SELECT * FROM sellers WHERE email = '$seller_email'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_array($result);
            $fullname = $row["fullname"];
            $business_name = $row["business_name"];
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ofto Emporium | Seller's Dashboard</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Quicksand:wght@300;400;500;600;700&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <style>
        * {
            margin: 0;
            padding: 0;
            list-style: none;
            text-decoration: none;
            box-sizing: border-box;
            font-family: 'Poppins';
        }

        body {
            background-color: #f8f8f8;
            color: #333;
        }

        nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px 30px;
            box-shadow: 2px 2px 10px #ccc;
        }

        nav .right {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            gap: 1.2rem;
        }

        .profile-noti {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 1.2rem;
        }

        .search-bar {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .search {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            gap: 0.6rem;
            border: 2px solid #555;
            border-radius: 5px;
            /* padding: 5px 0; */
        }

        .search input {
            border: none;
            background: none;
            outline: none;
            height: 100%;
        }

        .search i {
            margin: 7px 3px;
        }

        .search-bar button {
            padding: 7px 10px;
            margin-left: 10px;
            background: #003399;
            border: none;
            border-radius: 5px;
            color: #fff;
            text-transform: uppercase;
            cursor: pointer;
        }

        i {
            cursor: pointer;
            font-size: 20px;
        }
    </style>
</head>
<body>
    <nav>
        <div class="right">
            <div class="logo">
                <img src="../../assets/OFTO_Emporium1.png" alt="Logo" width="40">
            </div>

            <i class="fa fa-bars"></i>
        </div>
        <div class="search-bar">
            <div class="search">
                <i class="fa fa-search"></i>
                <input type="text" placeholder="Search">
            </div>
            <button>Search</button>
        </div>
        <div class="profile-noti">
            <i class="fa fa-bell"></i>
            <div class="profile">
                <i class="fa fa-user"></i>
                <i class="fa fa-angle-down"></i>
            </div>
        </div>
    </nav>
</body>
</html>