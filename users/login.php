<?php
    session_start();

    if (isset($_SESSION["email"])) {
        header("Location: index.php");
        exit();
    } else {
        include "./config/db_connect.php";

        $email = $password = $input_error = "";

        if (isset($_POST["login"])) {
            $email = mysqli_real_escape_string($conn, $_POST["email"]);
            $password = mysqli_real_escape_string($conn, $_POST["password"]);

            $sql = "SELECT * FROM users WHERE email = '$email'";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                $row = mysqli_fetch_assoc($result);
                if ($row && password_verify($password, $row["password"])) {
                    $_SESSION["email"] = $email;
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
    <style>
        body {
            font-family: 'Poppins';
            text-align: center;
            margin-top: 50px;
        }

        form {
            width: 400px;
            padding: 20px;
            border-radius: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        form .input-box {
            width: 95%;
            border: 2px solid #ccc;
            border-radius: 50px;
            padding: 6px 8px;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            justify-content: flex-start;
            gap: 6px;
        }

        form .input-box input {
            border: none;
            width: 100%;
            outline: none;
        }

        form .input-box input::placeholder {
            font-size: 14px;
        }

        form .input-box i {
            color: #ccc;
        }

        form button {
            width: 100%;
            padding: 9px;
            border-radius: 50px;
            border: none;
            text-transform: uppercase;
            color: #fff;
            background: #003399;
            cursor: pointer;
        }
    </style>
</head>
<body>   
    <form action="" method="post">
        <h1>Login Here</h1>
        <p style="text-align: center; color: red;"><?php echo $input_error ?></p>
        <div class="input-box">
            <i class="fa fa-envelope"></i>
            <input type="email" name="email" id="email" placeholder="Enter your email address" value="<?php echo htmlspecialchars($email) ?>" required>
        </div>
        <div class="input-box">
            <i class="fa fa-lock"></i>
            <input type="password" name="password" id="password" placeholder="Enter your password" value="<?php echo htmlspecialchars($password) ?>" required>
        </div>
        <button name="login">Login</button>
        <p>Not registered? <a href="register.php">Register here</a></p>
    </form>

</body>
</html>
