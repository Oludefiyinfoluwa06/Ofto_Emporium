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

        .user-cart {
            width: 90%;
            margin: auto;
            margin-bottom: 10px;
        }
        
        .cart-item {
            padding: 10px;
            margin: 10px;
            display: flex;
            align-items: center;
            justify-content: flex-start;
            gap: 1rem;
            border: 1px solid #ccc;
            border-radius: 10px;
        }

        .user-cart img {
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
            background: #003399;
            border: none;
            border-radius: 10px;
            padding: 7px 13px;
            color: #fff;
            cursor: pointer;
        }

        .empty-cart {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            gap: 1rem;
            min-height: calc(100vh - 100px);
        }

        .empty-cart .img {
            background: #fff;
            padding: 40px;
            border-radius: 50%;
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
            <li><a href="./seller/register.php" style="color: #000;"><i class="fa fa-store" style="margin-right: 10px"></i>Become a seller</a></li>
        </ul>
        <?php if (!isset($_SESSION["email"])): ?>
            <a href="login.php"><button style="text-transform:uppercase;">Login</button></a>
        <?php else: ?>
            <a href="logout.php"><button style="text-transform:uppercase;">Logout</button></a>
        <?php endif ?>
    </div>

    <?php 
    
        if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])): ?>
            <div class="empty-cart">
                <div class="img">
                    <img src="../assets/OFTO_Emporium1.png" alt="Empty cart" width="100">
                </div>
                <h2 style="text-align: center; margin-top: 10px;">Your cart is empty</h2>
                <a href="products.php"><button style="background: #003399; border-radius: 10px; padding: 10px 15px">Start shopping</button></a>
            </div>
        <?php else: ?>
            <h2 style="text-align: center; margin-top: 10px; margin-bottom: 10px;">Your cart</h2>
            <div class="user-cart">
                <?php foreach($_SESSION['cart'] as $item): ?>
                    <div class="cart-item">
                        <img src="../assets/uploads/product_images/<?php echo $item['image'] ?>" alt="<?php echo $item['name'] ?>" class="cart-item-image">
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
