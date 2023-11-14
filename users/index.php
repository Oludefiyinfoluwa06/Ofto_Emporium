<?php

    include "./config/db_connect.php";

    $cat_sql = "SELECT * FROM categories LIMIT 6";
    $cat_result = mysqli_query($conn, $cat_sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ofto E-Store | Homepage</title>
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

        nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px 30px;
            gap: 2rem;
        }

        nav ul {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 2rem;
            text-transform: uppercase;
        }

        nav ul li a {
            color: black;
        }

        nav ul li a:hover {
            color: rgb(0, 200, 0);
            transition: .5s;
        }
        
        nav ul li:hover {
            color: rgb(0, 200, 0);
            cursor: pointer;
        }

        .active {
            color: rgb(0, 200, 0);
        }

        .prof-cart {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1rem;
        }

        .prof-cart i {
            cursor: pointer;
        }

        .hero {
            width: 100%;
            height: 350px;
            background: linear-gradient(rgba(0,0,0,0.75),rgba(0,0,0,0.75)), url('../assets/shopping.jpg') center/cover no-repeat;
            color: white;
            padding: 30px;
            text-align: center;
            position: relative;
        }

        .hero .hero-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            display: flex;
            align-items: center;
            flex-direction: column;
            gap: 10px;
        }

        .f-categories {
            padding: 20px 30px;
        }

        .f-categories h1 {
            text-align: center;
        }

        .f-categories .categories {
            width: 150px;
        }

        .categories img {
            width: 100%;
            object-fit: cover;
            object-position: center;
            border-radius: 10px 10px 0 0;
        }

        .categories p {
            text-align: center;
        }

        .p-categories {
            display: flex;
            justify-content: center;
            gap: 3rem;
            margin-top: 13px;
        }
    </style>
</head>
<body>
    <nav>
        <label><span style="color: rgb(0, 200, 0);">E</span>-Store</label>
        <ul>
            <li><a href="#" class="active">Home</a></li>
            <li><a href="#">About</a></li>
            <li>Categories <i class="fa fa-angle-down"></i></li>
            <li><a href="#">New Arrivals</a></li>
            <li><a href="#">Contact</a></li>
        </ul>
        <div class="prof-cart">
            <div class="search">
                <i class="fa fa-search"></i>
            </div>
            <div class="cart">
                <i class="fa fa-shopping-cart"></i>
            </div>
            <div class="cart">
                <i class="fa fa-user"></i>
            </div>
        </div>
    </nav>

    <div class="hero">
        <div class="hero-text">
            <h1>Discover, Shop, Enjoy!</h1>
            <p>Welcome to Ofto E-store, where your shopping experience is elevated to new heights. Discover a world of quality products curated just for you. Explore our collections and let your shopping journey begin</p>
        </div>
    </div>

    <div class="f-categories">
        <h1>Featured Categories</h1>
        <div class="p-categories">
            <?php if (mysqli_num_rows($cat_result) > 0): ?>
                <?php while ($row = mysqli_fetch_array($cat_result)): ?>
                    <div class="categories">
                        <img src="<?php echo $row["cat_image"] ?>" alt="<?php echo $row["cat_title"] ?>">
                        <p><?php echo $row["cat_title"] ?></p>
                    </div>
                <?php endwhile ?>
            <?php endif ?>
        </div>
    </div>
</body>
</html>