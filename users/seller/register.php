<?php
    session_start();

    if (isset($_SESSION["seller_email"])) {
        header("Location: index.php");
    }
    include "../config/db_connect.php";

    $fullname = $seller_email = $phone = $business_name = $business_address = $account_number = $account_name = $bank_name = $password = $input_error = "";

    if (isset($_POST["register"])) {
        $fullname = mysqli_real_escape_string($conn, $_POST["fullname"]);
        $seller_email = mysqli_real_escape_string($conn, $_POST["email"]);
        $phone = mysqli_real_escape_string($conn, $_POST["phone"]);
        $business_name = mysqli_real_escape_string($conn, $_POST["business_name"]);
        $business_address = mysqli_real_escape_string($conn, $_POST["business_address"]);
        $account_number = mysqli_real_escape_string($conn, $_POST["account_number"]);
        $account_name = mysqli_real_escape_string($conn, $_POST["account_name"]);
        $bank_name = mysqli_real_escape_string($conn, $_POST["bank_name"]);
        $password = password_hash($_POST["password"],PASSWORD_DEFAULT);

        $result1 = mysqli_query($conn, "SELECT * FROM sellers WHERE email = '$seller_email'");
        if ($result1) {
            $row = mysqli_fetch_assoc($result1);
            if ($row["email"] == $seller_email) {
                $input_error = "Account exists already";
            } else {
                $sql = "INSERT INTO sellers (fullname, email, phone, business_name, business_address, account_number, account_name, bank_name, password) VALUES ('$fullname', '$seller_email', '$phone', '$business_name', '$business_address', '$account_number', '$account_name', '$bank_name', '$password')";
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
    <title>Ofto Emporium | Become a seller</title>
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
    <h2 style="text-align: center;">Become a seller</h2>
    <form action="" method="post">
        <p style="text-align: center; color: red;"><?php echo $input_error ?></p>
        <!-- Personal Information -->
        <label for="fullName">Full Name:</label>
        <input type="text" id="fullName" name="fullname" value="<?php echo htmlspecialchars($fullname) ?>" required>

        <label for="contactEmail">Contact Email:</label>
        <input type="email" id="contactEmail" name="email" value="<?php echo htmlspecialchars($seller_email) ?>" required>

        <label for="phone">Phone Number:</label>
        <input type="tel" id="phone" name="phone" value="<?php echo htmlspecialchars($phone) ?>" required>

        <!-- Business Information -->
        <label for="businessName">Business Name:</label>
        <input type="text" id="businessName" name="business_name" value="<?php echo htmlspecialchars($business_name) ?>" required>

        <label for="businessAddress">Business Address:</label>
        <input type="text" id="businessAddress" name="business_address" value="<?php echo htmlspecialchars($business_address) ?>" required>

        <!-- Banking Information -->
        <label for="bankAccountNumber">Bank Account Number:</label>
        <input type="number" id="bankAccountNumber" name="account_number" value="<?php echo htmlspecialchars($account_number) ?>" required>

        <label for="bankAccountName">Bank Account Name:</label>
        <input type="text" id="bankAccountName" name="account_name" value="<?php echo htmlspecialchars($account_name) ?>" required>

        <label for="bankName">Bank Name:</label>
        <input type="text" id="bankName" name="bank_name" value="<?php echo htmlspecialchars($bank_name) ?>" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" value="<?php echo htmlspecialchars($password) ?>" required>

        <button type="submit" name="register">Register</button>
        <p style="margin-top: 10px; text-align: center;">Already have an account? <a href="login.php">Login</a></p>
    </form>
</div>

</body>
</html>
