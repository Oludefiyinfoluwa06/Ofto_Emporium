<?php
    include "./config/db_connect.php";

    $product_sql = "SELECT * FROM products";
    $product_result = mysqli_query($conn, $product_sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ofto Emporium | Products</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Quicksand:wght@300;400;500;600;700&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
            color: #0000ff;
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
            color: #0000ff;
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

        .product-listing {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .products {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-top: 20px;
        }

        .product-card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s;
            /* width: calc(33.33% - 20px); */
            margin-bottom: 20px;
        }

        .product-card:hover {
            transform: scale(1.05);
        }

        .product-card h2 {
            font-size: 18px;
            margin: 10px;
            color: #333;
        }

        .price {
            font-size: 16px;
            color: #0000ff;
            font-weight: bold;
            margin: 10px;
        }

        .product-image {
            width: 100%;
            height: 150px;
            object-fit: cover;
        }

        .buttons {
            display: flex;
            justify-content: space-between;
            padding: 10px;
            background-color: #f0f0f0;
            border-top: 1px solid #ccc;
        }

        .buttons button {
            padding: 8px 15px;
            border: none;
            cursor: pointer;
            transition: background 0.3s, color 0.3s;
        }

        .buttons button:hover {
            background: #0000ff;
            color: #fff;
        }

        .menu-icon, .close-icon {
            display: none;
        }

        @media (max-width: 480px) {
            .product-card {
                width: 100%;
            }
        }

        @media (max-width: 768px) {
            .footer-section {
                flex: 0 0 100%;
            }
            .products {
                justify-content: center;
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
            }
            .menu-icon {
                display: block;
            }
        }
    </style>
</head>
<body>
    <nav>
        <label><span style="color: #0000ff;">E</span>-Store</label>
        <ul>
            <li><a href="index.php" class="active">Home</a></li>
            <li><a href="products.php">Products</a></li>
            <li><a href="#">Categories</a></li>
            <li><a href="#">New Arrivals</a></li>
            <li><a href="#">My Account</a></li>
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

    <div class="product-listing">
        <h1>All Products</h1>
        <div class="products">
            <?php if (mysqli_num_rows($product_result) > 0): ?>
                <?php while ($product = mysqli_fetch_assoc($product_result)): ?>
                    <div class="product-card">
                    <h2><?php echo $product['product_name']; ?></h2>
                    <img src="<?php echo $product['product_img']; ?>" alt="<?php echo $product['product_name']; ?>" class="product-image">
                    <p class="price">₦ <?php echo $product['product_price']; ?></p>
                    <div class="buttons">
                        <a href="product_details.php?id=<?php echo $product['id']; ?>">
                            <button>View Details</button>
                        </a>
                        <a href="add_to_cart.php?id=<?php echo $product['id']; ?>">
                            <button>Add to Cart</button>
                        </a>
                    </div>
                </div>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </div>

    <footer>
        <div class="footer-content">
            <div class="footer-section">
                <img src="../assets/OFTO1.png" alt="Ofto Emporium" width="70">
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
                    <a href="#"><i class="fa fa-facebook"></i></a>
                    <a href="#"><i class="fa fa-twitter"></i></a>
                    <a href="#"><i class="fa fa-instagram"></i></a>
                    <a href="#"><i class="fa fa-linkedin"></i></a>
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
    </script>

</body>
</html>
