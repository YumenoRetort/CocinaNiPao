<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cocina ni Pao - Login</title>

    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <h2>Login</h2>

    <form method="post" action="login.php">
        Email: <input type="text" name="email"><br>
        Password: <input type="password" name="password"><br>
        <input type="submit" value="Login">
    </form>

    <!-- Make a button -->
    <a href="register.php" class="button">Signup</a>

    <?php
    include 'Admin/connect.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $query = "SELECT * FROM customer WHERE email='$email' AND password='$password'";
        $result = mysqli_query($con, $query);

        if (mysqli_num_rows($result) == 1) {
            //user redirect
            header("Location: index.php");
            exit();
        } else {
            echo "Invalid email or password. Please try again.";
        }
    }
    ?>

    <script src="js/script.js"></script>
    
</body>
</html>
