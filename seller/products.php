<?php
    session_start();

    $seller_email = $_SESSION["seller_email"];

    if (!isset($seller_email)) {
        header("Location: login.php");
        exit();
    }

    include "./config/db_connect.php";

    $sql = "SELECT * FROM products WHERE product_seller_email = '$seller_email' ORDER BY created_at DESC";
    $result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ofto Emporium | Seller's products</title>
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

        main {
            display: flex;
            /* align-items: center; */
            justify-content: flex-start;
        }

        aside {
            /* width: 200px; */
            background: #f8f8f8;
            height: calc(100vh - 85px);
        }

        aside .sidebar-links {
            display: flex;
            align-items: flex-start;
            justify-content: flex-start;
            flex-direction: column;
        }

        .sidebar-links a {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            padding: 20px 15px;
            gap: 0.5rem;
            width: 100%;
            cursor: pointer;
            color: #000;
        }

        .sidebar-links a:hover {
            background: #fff;
            color: #003399;
        }

        .sidebar-links a p {
            display: none;
        }

        #close-icon {
            display: none;
        }

        .active {
            background: #fff;
        }

        .active i, .active p {
            color: #003399;
        }

        main .main-content {
            width: 100%;
            padding: 30px;
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
            color: #003399;
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

        button {
            padding: 8px 15px;
            border: none;
            cursor: pointer;
            transition: background 0.3s, color 0.3s;
        }

        button:hover {
            background: #003399;
            color: #fff;
        }

        .main-content .title {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
    </style>
</head>
<body>
    <nav>
        <div class="right">
            <div class="logo">
                <img src="../assets/OFTO_Emporium1.png" alt="Logo" width="40">
            </div>

            <i class="fa fa-bars" id="menu-icon"></i>
            <i class="fa fa-close" id="close-icon"></i>
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

    <main>
        <aside>
            <div class="sidebar-links">
                <a href="index.php" title="Dashboard">
                    <i class="fa fa-dashboard"></i>
                    <p id="sidebar-title1">Dashboard</p>
                </a>
                <a href="products.php" title="Products" class="active">
                    <i class="fa fa-store"></i>
                    <p id="sidebar-title2">Products</p>
                </a>
                <a href="#" title="Orders">
                    <i class="fa fa-shopping-cart"></i>
                    <p id="sidebar-title3">Orders</p>
                </a>
                <a href="#" title="Statistics">
                    <i class="fa fa-bar-chart"></i>
                    <p id="sidebar-title4">Statistics</p>
                </a>
                <a href="#" title="Reviews">
                    <i class="fa fa-comment"></i>
                    <p id="sidebar-title5">Reviews</p>
                </a>
                <a href="#" title="Transaction">
                    <i class="fa fa-comment"></i>
                    <p id="sidebar-title6">Transactions</p>
                </a>
            </div>
        </aside>
        <section class="main-content">
            <div class="title">
                <h2>Your Products</h2>
                <a href="create_product.php">
                    <button>Create New <i class="fa fa-plus"></i></button>
                </a>
            </div>
            <div class="products">
                <?php if ($result):
                    if (mysqli_num_rows($result) > 0):
                        while ($product = mysqli_fetch_assoc($result)): ?>
                            <div class="product-card">
                                <h2><?php echo $product['product_name']; ?></h2>
                                <img src="../assets/uploads/product_images/<?php echo $product['product_img']; ?>" alt="<?php echo $product['product_name']; ?>" class="product-image">
                                <p class="price">₦ <?php echo $product['product_price']; ?></p>
                                <div class="buttons">
                                    <a href="view_product_detail.php?id=<?php echo $product['id']; ?>">
                                        <button><i class="fa fa-eye"></i> View</button>
                                    </a>
                                    <a href="edit_product.php?id=<?php echo $product['id']; ?>">
                                        <button><i class="fa fa-pencil"></i> Edit</button>
                                    </a>
                                    <a href="delete_product.php?id=<?php echo $product['id']; ?>">
                                        <button><i class="fa fa-trash"></i> Delete</button>
                                    </a>
                                </div>
                            </div>
                        <?php endwhile;
                    else: ?>
                        <p style="text-align: center; font-size: 30px;">You have no products</p>
                <?php
                    endif; 
                    endif;?>
            </div>
        </section>
    </main>

    <script>
        const menuIcon = document.getElementById('menu-icon');
        const closeIcon = document.getElementById('close-icon');
        const sidebarTitle1 = document.getElementById('sidebar-title1');
        const sidebarTitle2 = document.getElementById('sidebar-title2');
        const sidebarTitle3 = document.getElementById('sidebar-title3');
        const sidebarTitle4 = document.getElementById('sidebar-title4');
        const sidebarTitle5 = document.getElementById('sidebar-title5');
        const sidebarTitle6 = document.getElementById('sidebar-title6');
        const sideBar = document.querySelector('aside');

        menuIcon.addEventListener('click', () => {
            sidebarTitle1.style.display = 'block';
            sidebarTitle2.style.display = 'block';
            sidebarTitle3.style.display = 'block';
            sidebarTitle4.style.display = 'block';
            sidebarTitle5.style.display = 'block';
            sidebarTitle6.style.display = 'block';
            closeIcon.style.display = 'block';
            menuIcon.style.display = 'none';
        });
        closeIcon.addEventListener('click', () => {
            sidebarTitle1.style.display = 'none';
            sidebarTitle2.style.display = 'none';
            sidebarTitle3.style.display = 'none';
            sidebarTitle4.style.display = 'none';
            sidebarTitle5.style.display = 'none';
            sidebarTitle6.style.display = 'none';
            closeIcon.style.display = 'none';
            menuIcon.style.display = 'block';
        });
    </script>
</body>
</html>