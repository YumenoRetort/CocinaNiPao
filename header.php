<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header</title>

    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php
include "Admin/connect.php";
if (isset($_SESSION["uid"])) {
    $sql = "SELECT customer_name FROM customer WHERE customer_id='$_SESSION[uid]'";
    $query = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($query);

    echo '
            <header>
                <h1>Cocina ni Pao</h1>
                <nav>
                    <a href="homepage.php">Home</a> |
                    <a href="about.php">About</a> |
                    <a href="order.php">Order</a> |
                    <a href="help_support.php">Contact</a> |
                    <a>'. $row["customer_name"] . '</a> |
                    <a href="logout.php">Logout</a> |
                </nav>
                <!-- Shopping Cart Icon -->
                <a href="" class="cart"><i class="fa-solid fa-cart-shopping" style="width: 50px; height: 50px;"></i><sup>4</sup></a>
            </header>';

} else {
    echo '
            <header>
                <h1>Cocina ni Pao</h1>
                <nav>
                    <a href="homepage.php">Home</a> |
                    <a href="about.php">About</a> |
                    <a href="order.php">Order</a> |
                    <a href="help_support.php">Contact</a> |
                    <a href="login.php">Login</a>
                </nav>

                <!-- Shopping Cart Icon -->
                <a href="" class="cart"><i class="fa-solid fa-cart-shopping" style="width: 50px; height: 50px;"></i><sup>4</sup></a>
            </header>
            ';
}
?>

<script src="js/script.js"></script>

</body>
</html>
