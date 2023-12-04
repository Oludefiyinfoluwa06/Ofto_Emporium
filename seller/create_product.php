<?php
    session_start();

    $seller_email = $_SESSION["seller_email"];

    if (!isset($seller_email)) {
        header("Location: login.php");
        exit();
    }

    include "./config/db_connect.php";

    // $sql = "SELECT * FROM sellers WHERE email = '$seller_email'";
    // $result = mysqli_query($conn, $sql);

    // if ($result) {
    //     if (mysqli_num_rows($result) > 0) {
    //         $row = mysqli_fetch_array($result);
    //         $fullname = $row["fullname"];
    //         $business_name = $row["business_name"];
    //     }
    // }

    $product_name = $product_price = $product_desc = $category = $input_error = "";

    if (isset($_POST["create_product"])) {
        // $product_image = mysqli_real_escape_string($conn, $_POST["product_image"]);
        $product_name = mysqli_real_escape_string($conn, $_POST["product_name"]);
        $product_price = mysqli_real_escape_string($conn, $_POST["product_price"]);
        $product_desc = mysqli_real_escape_string($conn, $_POST["product_desc"]);
        $category = mysqli_real_escape_string($conn, $_POST["category"]);

        if (empty($product_name)|| empty($product_price)|| empty($product_desc)|| empty($category)) {
            $input_error = "Input fields cannot be empty";
        }

        if (isset($_FILES["product_image"])) {
            $img_name = $_FILES["product_image"]["name"];
            //$img_type = $_FILES["product_image"]["type"];
            $tmp_name = $_FILES["product_image"]["tmp_name"];

            $img_explode = explode(".", $img_name);
            $img_ext = end($img_explode);

            $extensions = ["jpg", "png", "jpeg"];

            if (in_array($img_ext, $extensions) === true) {
                $time = time();
                $new_img_name = $time . $img_name;
                if (move_uploaded_file($tmp_name, "../assets/uploads/product_images/" . $new_img_name)) {
                    if (empty($input_error)) {
                        $sql = "INSERT INTO products (product_seller_email, product_img, product_name, product_category, product_price, product_description) VALUES ('$seller_email', '$new_img_name', '$product_name', '$category', '$product_price', '$product_desc')";

                        $query = mysqli_query($conn, $sql);

                        if ($query) {
                            header("Location: products.php");
                            exit();
                        } else {
                            $input_error = "There's an error creating product. Try again";
                        }

                    }
                }
            } else {
                $input_error = "Please select an image file - jpg, jpeg, png";
            }
        } else {
            $input_error = "Please select an image file";
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

        form label {
            display: block;
            margin-bottom: 8px;
        }

        form input, form textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        form textarea {
            max-width: 100%;
            min-width: 100%;
            max-height: 100px;
            min-height: 100px;
        }

        form button {
            background-color: #003399;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            width: 100%;
            cursor: pointer;
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
                <a href="index.php" title="Dashboard" class="active">
                    <i class="fa fa-dashboard"></i>
                    <p id="sidebar-title1">Dashboard</p>
                </a>
                <a href="products.php" title="Products">
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
            <h2 style="text-align: center;">Become a seller</h2>
            <form action="" method="post" enctype="multipart/form-data">
                <p style="text-align: center; color: red;"><?php echo $input_error ?></p>

                <label for="product_image">Product image:</label>
                <input type="file" id="product_image" name="product_image" value="<?php echo htmlspecialchars($product_image) ?>" required>

                <label for="product_name">Product name:</label>
                <input type="text" id="product_name" name="product_name" value="<?php echo htmlspecialchars($product_name) ?>" required>

                <label for="product_price">Product price:</label>
                <input type="number" id="product_price" name="product_price" value="<?php echo htmlspecialchars($product_price) ?>" required>

                <label for="product_desc">Product description:</label>
                <textarea type="text" id="product_desc" name="product_desc" value="<?php echo htmlspecialchars($product_desc) ?>" required></textarea>

                <label for="category">Product category:</label>
                <input type="text" id="category" name="category" value="<?php echo htmlspecialchars($category) ?>" required>

                <button type="submit" name="create_product">Create Product</button>
            </form>
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