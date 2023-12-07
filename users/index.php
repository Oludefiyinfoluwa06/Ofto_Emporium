<?php

    session_start();

    include "./config/db_connect.php";

    $cat_sql = "SELECT * FROM categories LIMIT 6";
    $cat_result = mysqli_query($conn, $cat_sql);

    $product_sql = "SELECT * FROM products LIMIT 6";
    $product_result = mysqli_query($conn, $product_sql);

    $arrival_sql = "SELECT * FROM products ORDER BY created_at ASC LIMIT 6";
    $arrival_result = mysqli_query($conn, $arrival_sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ofto Emporium | Homepage</title>
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

        .hero {
            width: 100%;
            height: 350px;
            background: linear-gradient(rgba(0,0,0,0.75), rgba(0,0,0,0.75)), url('../assets/shopping.jpg') center/cover no-repeat;
            color: white;
            padding: 30px;
            text-align: center;
            position: relative;
        }

        .hero-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            display: flex;
            align-items: center;
            flex-direction: column;
            gap: 10px;
            width: 80%;
        }

        .f-categories {
            padding: 20px 30px;
            position: relative;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .f-categories h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        .categories {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 20px;
            margin-top: 13px;
            position: relative;
        }

        .category {
            width: calc(33.33% - 20px);
            height: 200px;
            overflow: hidden;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }

        .category:hover {
            transform: scale(1.05);
        }

        .category img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 10px 10px 0 0;
        }

        .category p {
            text-align: center;
            padding: 10px;
            background-color: #fff;
            color: #333;
            margin: 0;
            border-radius: 0 0 10px 10px;
        }

        .f-categories button {
            font-size: 20px;
            background: #ccc;
            color: #fff;
            border-radius: 50%;
            padding: 11px 20px;
            border: none;
            display: none;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
        }

        .f-categories #prevBtn {
            left: 20px;
        }

        .f-categories #nextBtn {
            right: 20px;
        }

        .f-categories button:hover {
            background: #003399;
        }

        .f-products {
            padding: 20px;
            margin-bottom: 20px;
        }

        .f-products h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .products {
            display: flex;
            justify-content: space-around;
            gap: 20px;
            flex-wrap: wrap;
        }

        .product {
            width: calc(33.33% - 20px);
            overflow: hidden;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
            margin-bottom: 20px;
        }

        .product:hover {
            transform: scale(1.05);
        }

        .product img {
            width: 100%;
            height: 70%;
            object-fit: cover;
            object-position: center;
            border-radius: 10px 10px 0 0;
        }

        .product p {
            text-align: center;
            margin: 10px 0 5px;
            color: #333;
        }

        .product p:last-child {
            font-size: 20px;
            font-weight: bold;
        }

        .about-section {
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .about-section h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        .about-text {
            text-align: center;
            color: #333;
        }

        .miss-vis {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 20px;
            margin-top: 30px;
        }

        .mission, .vision {
            width: 300px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 20px;
            background-color: #fff;
            color: #333;
        }

        .cta {
            padding: 30px;
            background: linear-gradient(rgba(0,0,0,0.75), rgba(0,0,0,0.75)), url('../assets/shopping.jpg') center/cover no-repeat;
            color: #fff;
            margin-top: 20px;
            text-align: center;
            border-radius: 10px 10px 0 0;
        }

        .cta h1 {
            color: #fff;
            margin-bottom: 20px;
        }

        .cta p {
            color: #fff;
            margin-bottom: 20px;
        }

        .cta a button {
            color: #fff;
            background: transparent;
            padding: 10px 20px;
            border: 2px solid #fff;
            border-radius: 50px;
            cursor: pointer;
            transition: background 0.5s, border 0.5s;
        }

        .cta a button:hover {
            background: #003399;
            border: 2px solid #003399;
        }

        footer {
            background-color: #333;
            color: #fff;
            padding: 30px 20px;
            text-align: center;
        }

        .footer-content {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }

        .footer-section {
            flex: 1;
            margin-bottom: 20px;
        }

        .footer-section h2,
        .footer-section img {
            color: #fff;
            font-size: 1.5rem;
            margin-bottom: 15px;
        }

        .footer-section p {
            font-size: 0.9rem;
            line-height: 1.5;
            color: #ccc;
        }

        .footer-links {
            display: flex;
            justify-content: center;
            flex-direction: column;
            margin-top: 20px;
        }

        .footer-links a {
            color: #fff;
            margin: 0 15px;
            text-decoration: none;
            transition: color 0.3s;
        }

        .footer-links a:hover {
            color: #00f;
        }

        .footer-social {
            margin-top: 20px;
        }

        .footer-social i {
            font-size: 1.5rem;
            color: #fff;
            margin: 0 15px;
            transition: color 0.3s;
        }

        .footer-social i:hover {
            color: #00f;
        }

        .footer-disclaimer {
            margin-top: 20px;
            font-size: 0.8rem;
            color: #ccc;
        }

        .menu-icon, .close-icon {
            display: none;
        }

        .account-container {
            display: none;
            position: absolute;
            top: 80px;
            right: 20px;
            z-index: 100;
            padding: 20px;
            background: #fff;
            color: #000;
            border-radius: 10px;
            width: 250px;
        }

        .account-container button {
            width: 100%;
            padding: 10px;
            background: #003399;
            color: #fff;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            margin-top: 10px;
        }

        #angleUp {
            display: none;
        }

        .user {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            gap: .3rem;
        }

        .account-list li {
            padding: 10px;
            border-radius: 10px;
            cursor: pointer;
        }

        .account-list li:hover {
            background: #ccc;
        }

        @media (max-width: 768px) {
            .category {
                width: calc(50% - 10px);
            }
            .product {
                width: calc(50% - 20px);
            }
            .footer-section {
                flex: 0 0 100%;
            }
        }

        @media (max-width: 480px) {
            .category {
                width: 100%;
            }
            .product {
                width: 100%;
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

            .categories {
                justify-content: flex-start;
            }

            .f-categories button {
                display: flex;
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
            <div class="user">
                <i class="fa fa-user"></i> <i class="fa fa-angle-down" id="angleDown"></i> <i class="fa fa-angle-up" id="angleUp"></i>
            </div>
            <div class="menu-icon">
                <i class="fa fa-bars"></i>
            </div>
            <div class="close-icon">
                <i class="fa fa-close"></i>
            </div>
        </div>
    </nav>

    <div class="account-container" id="accountContainer">
        <ul class="account-list">
            <li><a href="buyer_account.php" style="color: #000;"><i class="fa fa-user" style="margin-right: 10px"></i>My account</a></li>
            <li><a href="../seller/register.php" style="color: #000;"><i class="fa fa-store" style="margin-right: 10px"></i>Become a seller</a></li>
        </ul>
        <?php if (!isset($_SESSION["email"])): ?>
            <a href="login.php"><button style="text-transform:uppercase;">Login</button></a>
        <?php else: ?>
            <a href="logout.php"><button style="text-transform:uppercase;">Logout</button></a>
        <?php endif ?>
    </div>

    <div class="hero">
        <div class="hero-text">
            <h1>Discover, Shop, Enjoy!</h1>
            <p>Welcome to Ofto Emporium, where your shopping experience is elevated to new heights. Discover a world of quality products curated just for you. Explore our collections and let your shopping journey begin</p>
        </div>
    </div>

    <div class="f-categories">
        <h1>Featured Categories</h1>
        <div class="categories">
            <?php if (mysqli_num_rows($cat_result) > 0): ?>
                <?php while ($row = mysqli_fetch_array($cat_result)): ?>
                    <div class="category">
                        <img src="<?php echo $row["cat_image"] ?>" alt="<?php echo $row["cat_title"] ?>">
                        <p><?php echo $row["cat_title"] ?></p>
                    </div>
                <?php endwhile ?>
            <?php endif ?>
        </div>
    </div>

    <?php if (mysqli_num_rows($product_result) > 0): ?>
        <div class="f-products">
            <h1>Featured products</h1>
            <div class="products">
                <?php while ($row = mysqli_fetch_array($product_result)): ?>
                    <div class="product">
                        <img src="../assets/uploads/product_images/<?php echo $row["product_img"] ?>" alt="<?php echo $row["product_name"] ?>">
                        <p><?php echo $row["product_name"] ?></p>
                        <p style="font-size: 20px; font-weight: bold;">₦ <?php echo $row["product_price"] ?></p>
                    </div>
                <?php endwhile ?>
            </div>
        </div>
    <?php endif ?>

    <?php if (mysqli_num_rows($arrival_result) > 0): ?>
        <div class="f-products">
            <h1>New Arrivals</h1>
            <div class="products">
                <?php while ($row = mysqli_fetch_array($arrival_result)): ?>
                    <div class="product">
                        <img src="../assets/uploads/product_images/<?php echo $row["product_img"] ?>" alt="<?php echo $row["product_name"] ?>">
                        <p><?php echo $row["product_name"] ?></p>
                        <p style="font-size: 20px; font-weight: bold;">₦ <?php echo $row["product_price"] ?></p>
                    </div>
                <?php endwhile ?>
            </div>
        </div>
    <?php endif ?>

    <div class="about-section">
        <h1>About us</h1>
        <div class="about">
            <div class="about-text">
                <p>Welcome to Ofto Emporium, where passion meets quality in every product we offer. At Ofto Emporium, we are dedicated to providing our customers with a seamless online shopping experience, curated selections, and exceptional customer service</p>
            </div>
            <div class="miss-vis">
                <div class="mission">
                    <!-- <i class="fa fa-bullseye"></i> -->
                    <h2>Our Mission</h2>
                    <p>At the core of Ofto Emporium's mission is the belief that shopping should be an enjoyable and personalized experience. We strive to offer a carefully curated collection of products that embody the latest trends, timeless classics, and innovative designs.</p>
                </div>
                <div class="vision">
                    <!-- <i class="fa fa-eye"></i> -->
                    <h2>Our Vision</h2>
                    <p>At Ofto Emporium, our vision is to be the go-to destination for quality products and delightful shopping experiences. We aspire to create a platform where every customer finds convenience and satisfaction in their online journey with us.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="cta">
        <h1>Join our community</h1>
        <p>Ready to elevate your shopping experience? Explore our curated collection now and discover the perfect blend of quality, style, and convenience. Happy shopping!</p>
        <a href="register.php"><button>Signup</button></a>
    </div>

    <footer>
        <div class="footer-content">
            <div class="footer-section">
                <img src="../assets/OFTO_Emporium1.png" alt="Logo" width="70" height="65">
                <p>Welcome to Ofto Emporium - your premier destination for an unparalleled online shopping experience. We pride ourselves on curating a diverse collection of high-quality products, ensuring you find exactly what you're looking for.</p>
            </div>
            <div class="footer-section">
                <h2>Quick Links</h2>
                <div class="footer-links">
                    <a href="index.php">Home</a>
                    <a href="products.php">Products</a>
                    <a href="#">Categories</a>
                    <a href="#">New Arrivals</a>
                    <a href="#">Contact</a>
                </div>
            </div>
            <div class="footer-section">
                <h2>Connect with Us</h2>
                <div class="footer-social">
                    <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#"><i class="fa-brands fa-twitter"></i></a>
                    <a href="#"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#"><i class="fa-brands fa-linkedin"></i></a>
                </div>
            </div>
        </div>
        <div class="footer-disclaimer">
            <p>&copy; 2023 Ofto Emporium. All rights reserved | Designed by <a href="https://oludefiyin.web.app" style="color: white;">Ofto Technologies</a></p>
        </div>
    </footer>
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