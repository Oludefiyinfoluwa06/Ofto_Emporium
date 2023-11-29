<?php
    session_start();

    if (isset($_SESSION["email"])) {
        header("Location: index.php");
    }

    include "./config/db_connect.php";

    $fullname = $email = $phone = $state = $city = $address = $password = $input_error = "";

    if (isset($_POST["register"])) {
        $fullname = mysqli_real_escape_string($conn, $_POST["fullname"]);
        $email = mysqli_real_escape_string($conn, $_POST["email"]);
        $phone = mysqli_real_escape_string($conn, $_POST["phone"]);
        $state = mysqli_real_escape_string($conn, $_POST["state"]);
        $city = mysqli_real_escape_string($conn, $_POST["city"]);
        $address = mysqli_real_escape_string($conn, $_POST["address"]);
        $password = password_hash($_POST["password"],PASSWORD_DEFAULT);

        $result1 = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");
        if ($result1) {
            $row = mysqli_fetch_assoc($result1);
            if ($row["email"] == $email) {
                $input_error = "Account exists already";
            } else {
                $sql = "INSERT INTO users (fullname, email, phone, state, city, address, password) VALUES ('$fullname', '$email', '$phone', '$state', '$city', '$address', '$password')";
                $result = mysqli_query($conn, $sql);
                if ($result) {
                    header("Location: login.php");
                    exit();
                } else {
                    $input_error = "There's an error registering. Try again";
                }
            }
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ofto Emporium | Register</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Quicksand:wght@300;400;500;600;700&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
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
        <h1>Register Here</h1>
        <p style="text-align: center; color: red;"><?php echo $input_error ?></p>
        <div class="input-box">
            <i class="fa fa-user"></i>
            <input type="text" name="fullname" id="fullname" placeholder="Enter your full name" value="<?php echo htmlspecialchars($fullname) ?>" required>
        </div>
        <div class="input-box">
            <i class="fa fa-envelope"></i>
            <input type="email" name="email" id="email" placeholder="Enter your email address" value="<?php echo htmlspecialchars($email) ?>" required>
        </div>
        <div class="input-box">
            <i class="fa fa-phone"></i>
            <input type="tel" name="phone" id="phone" placeholder="Enter your phone number" value="<?php echo htmlspecialchars($phone) ?>" required>
        </div>
        <div class="input-box">
            <i class="fa fa-city"></i>
            <input type="text" name="state" id="state" placeholder="Enter your State" value="<?php echo htmlspecialchars($state) ?>" required>
        </div>
        <div class="input-box">
            <i class="fa fa-city"></i>
            <input type="text" name="city" id="city" placeholder="Enter your city" value="<?php echo htmlspecialchars($city) ?>" required>
        </div>
        <div class="input-box">
            <i class="fa fa-home"></i>
            <input type="text" name="address" id="address" placeholder="Enter your address" value="<?php echo htmlspecialchars($address) ?>" required>
        </div>
        <div class="input-box">
            <i class="fa fa-lock"></i>
            <input type="password" name="password" id="password" placeholder="Create a password" value="<?php echo htmlspecialchars($password) ?>" required>
        </div>
        <button name="register">Register</button>
        <p>Already registered? <a href="login.php">Login here</a></p>
    </form>
</body>
</html>
