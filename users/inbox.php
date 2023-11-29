<?php
    session_start();

    if (!isset($_SESSION['email'])) {
        header('Location: login.php');
        exit();
    }

    include "./config/db_connect.php";

    $email = $_SESSION['email'];
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $row = mysqli_fetch_array($result);
        $fullname = $row["fullname"];
        $email = $row["email"];
        $phone = $row["phone"];
        $state = $row["state"];
        $city = $row["city"];
        $address = $row["address"];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ofto Emporium | Buyer's Account</title>
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
            gap: 2rem;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        nav ul {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 2rem;
            text-transform: uppercase;
        }

        nav ul li a, nav ul li {
            color: #333;
            transition: color 0.5s;
        }

        nav ul li:hover a, nav ul li.active a {
            color: #003399;
        }

        .prof-cart {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            flex-direction: row;
            gap: 1rem;
        }

        .prof-cart i {
            cursor: pointer;
            color: #333;
            transition: color 0.5s;
        }

        .prof-cart i:hover {
            color: #003399;
        }

        .menu-icon, .close-icon {
            display: none;
        }

        #angleUp {
            display: none;
        }

        .main-content {
            display: flex;
            justify-content: flex-start;
            gap: 1.5rem;
            padding-right: 20px;
        }

        .main-content .sidebar {
            padding: 20px 0;
            border-right: 2px solid #ccc;
            height: calc(100vh - 75px);
            width: 350px;
        }

        .sidebar li {
            padding: 20px 15px;
            /* border-radius: 10px; */
            cursor: pointer;
        }

        .sidebar li:hover {
            background: #ccc;
            transition: .5s;
        }

        .sidebar li.active {
            background: #ccc;
        }

        .sidebar li.active a {
            color: #003399;
        }

        .sidebar li a {
            color: #000;
        }

        .sidebar li:hover a {
            color: #003399;
            transition: .5s;
        }

        .sidebar-content {
            background: #fff;
            width: 100%;
            margin: 20px 10px;
            border-radius: 20px;

        }

        .sidebar-content h2 {
            width: 100%;
            padding: 15px;
            border-bottom: 2px solid #ddd;
        }
        
        .sidebar-content .content {
            padding: 20px;
            overflow-y: auto;
        }

        .profile p, .address-book p, .address-book b {
            padding: 7px 14px;
        }

        .top-content {
            display: flex;
            justify-content: space-between;
        }

        .profile, .address-book {
            border: 2px solid #ccc;
            border-radius: 20px;
        }

        .profile h3, .address-book h3 {
            border-bottom: 2px solid #ccc;
            padding: 10px;
        }

        @media (max-width: 817px) {
            .sidebar-link-text {
                display: none;
            }
            .main-content .sidebar {
                width: 60px;
            }
            .sidebar li a {
                margin-left: 5px;
            }
        }

        @media (max-width: 1000px) {
            nav ul {
                flex-direction: column;
                text-align: center;
                position: absolute;
                top: -100%;
                left: 0;
                width: 100%;
                background-color: #fff;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                z-index: 1;
                transition: .5s;
                padding: 20px 8px;
            }
            .menu-icon {
                display: block;
            }
        }
    </style>
</head>
<body>
    <nav>
        <img src="../assets/OFTO_Emporium1.png" alt="Logo" width="40" height="35">
        <ul>
            <li><a href="index.php" class="active">Home</a></li>
            <li><a href="products.php">Products</a></li>
            <li><a href="#">Categories</a></li>
            <li><a href="#">New Arrivals</a></li>
        </ul>
        <div class="prof-cart">
            <div class="search">
                <i class="fa fa-search"></i>
            </div>
            <a href="cart.php" class="cart">
                <i class="fa fa-shopping-cart"></i>
            </a>
            <div class="menu-icon">
                <i class="fa fa-bars"></i>
            </div>
            <div class="close-icon">
                <i class="fa fa-close"></i>
            </div>
        </div>
    </nav>

    <section class="main-content">
        <ul class="sidebar">
            <li title="Account overview"><a href="buyer_account.php"><i class="fa fa-user" style="margin-right: 10px"></i></a><a href="buyer_account.php" class="sidebar-link-text">Account Overview</a></li>
            <li title="Orders"><a href="orders.php"><i class="fa-solid fa-cart-shopping" style="margin-right: 10px"></i></a></i><a href="orders.php" class="sidebar-link-text">Orders</a></li>
            <li class="active" title="Inbox"><a href="inbox.php"><i class="fa fa-envelope" style="margin-right: 10px"></i></a><a href="inbox.php" class="sidebar-link-text">Inbox</a></li>
            <li title="Address book"><a href="address.php"><i class="fa fa-address-card" style="margin-right: 10px"></i></a><a href="address.php" class="sidebar-link-text">Address Book</a></li>
            <li title="Account management"><a href="account_management.php"><i class="fa fa-user-pen" style="margin-right: 10px"></i></a><a href="account_management.php" class="sidebar-link-text">Account Management</a></li>
            <li title="Logout"><a href="logout.php"><i class="fa fa-sign-out" style="margin-right: 10px"></i></a><a href="logout.php" class="sidebar-link-text">Logout</a></li>
        </ul>
        <div class="sidebar-content">
            <h2>Inbox</h2>
            <div class="content">
                
            </div>
        </div>
    </section>

    <script>
        const menuIcon = document.querySelector('.menu-icon');
        const closeIcon = document.querySelector('.close-icon');
        const navLinks = document.querySelector('nav ul');
        menuIcon.addEventListener('click', () => {
            menuIcon.style.display = 'none';
            closeIcon.style.display = 'block';
            navLinks.style.top = '60px';
        });
        closeIcon.addEventListener('click', () => {
            menuIcon.style.display = 'block';
            closeIcon.style.display = 'none';
            navLinks.style.top = '-100%';
        });

        const angleUp = document.querySelector('#angleUp');
        const angleDown = document.querySelector('#angleDown');
        const accountContainer = document.querySelector('#accountContainer');

        angleDown.addEventListener('click', () => {
            accountContainer.style.display = 'block';
            angleUp.style.display = 'block';
            angleDown.style.display = 'none';
        });

        angleUp.addEventListener('click', () => {
            accountContainer.style.display = 'none';
            angleUp.style.display = 'none';
            angleDown.style.display = 'block';
        });
    </script>
</body>
</html>