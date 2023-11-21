<?php
    session_start();

    if (!isset($_SESSION['email'])) {
        header('Location: login.php');
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ofto Emporium | Buyer's Cart</title>
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

        .user-cart {
            width: 90%;
            margin: auto;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 10px;
        }

        .cart-item {
            padding: 10px;
            margin: 10px;
            display: flex;
            align-items: center;
            justify-content: flex-start;
            gap: 1rem;
        }

        img {
            width: 70px;
            height: 70px;
            border-radius: 50%;
        }

        .menu-icon, .close-icon {
            display: none;
        }

        p {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            gap: 1rem;
        }

        p:not(:last-child) {
            margin-bottom: 10px;
            margin-top: 8px;
        }

        p i {
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid black;
            padding: 7px 10px;
            border-radius: 2px;
            transition: .5s;
            cursor: pointer;
        }

        p i:hover {
            color: #fff;
            background: #000;
        }

        button {
            margin-top: 10px;
            background: #000;
            border: none;
            padding: 7px 13px;
            color: #fff;
            cursor: pointer;
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

    <?php 
    
        if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])): ?>
            <div>
                <h2 style="text-align: center; margin-top: 10px;">Your cart is empty</h2>
                <h4 style="text-align: center; margin-top: 5px;">Shop and <a href="products.php">add to cart</a></h4>
            </div>
        <?php else: ?>
            <h2 style="text-align: center; margin-top: 10px; margin-bottom: 10px;">Your cart</h2>
            <div class="user-cart">
                <?php foreach($_SESSION['cart'] as $item): ?>
                    <div class="cart-item">
                        <img src="<?php echo $item['image'] ?>" alt="<?php echo $item['name'] ?>" class="cart-item-image">
                        <div>
                            <div class="cart-item-desc">
                                <h3><?php echo $item['name'] ?></h3>
                                <p><b>Price:</b>₦ <?php echo $item['price'] ?></p>
                                <p><b>Quantity:</b><?php echo $item['quantity'] ?></p>
                            </div>
                            <a href="remove_from_cart.php?id=<?php echo $item['id']; ?>"><button>Remove <i class="fa fa-trash"></i></button></a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
    <?php endif; ?>

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
