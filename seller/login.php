<?php
    session_start();

    if (isset($_SESSION["seller_email"])) {
        header("Location: index.php");
        exit();
    } else {
        include "./config/db_connect.php";

        $seller_email = $password = $input_error = "";

        if (isset($_POST["login"])) {
            $seller_email = mysqli_real_escape_string($conn, $_POST["email"]);
            $password = mysqli_real_escape_string($conn, $_POST["password"]);

            $sql = "SELECT * FROM sellers WHERE email = '$seller_email'";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                $row = mysqli_fetch_assoc($result);
                if ($row && password_verify($password, $row["password"])) {
                    $_SESSION["seller_email"] = $seller_email;
                    header("Location: index.php");
                    exit();
                } else {
                    $input_error = "Incorrect email or password";
                }
            } else {
                $input_error = "Server Error";
            }
        }
    }

    mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ofto Emporium | Login</title>
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

        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
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

<div class="container">
    <h2 style="text-align: center;">Login</h2>
    <form action="" method="post">
        <p style="text-align: center; color: red;"><?php echo $input_error ?></p>

        <label for="contactEmail">Contact Email:</label>
        <input type="email" id="contactEmail" name="email" value="<?php echo htmlspecialchars($seller_email) ?>" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" value="<?php echo htmlspecialchars($password) ?>" required>

        <button type="submit" name="login">Login</button>
        <p style="margin-top: 10px; text-align: center;">Don't have an account? <a href="register.php">Register</a></p>
    </form>
</div>

</body>
</html>
