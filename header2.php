<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header</title>

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="css/style.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap');

        header {
            font-family: "DM Sans", sans-serif;
        }

        .navbar {
            background-color: #efeae3;;
            height: 150px;
        }

        .navbar-nav {
            margin-left: 4rem;
        }

        .nav-item {
            color: black;
            font-weight: medium;
            font-size: 18px;
            transition: color 0.2s ease-in-out;
        }

        .nav-item:hover, .cart:hover {
            color: #5a5a5a; 
        }

        .navbar-nav {
            gap: 3rem;
        }

        .nav-item {
            font-weight: medium;
            font-size: 18px;
            transition: all 0.3s;
        }
        .nav-item:hover {
            font-weight: bold;
            transform: scale(1.5);
            text-decoration: none;
        }

        .cart {
            background-color: #999B85;
            color: #efeae3;
            padding: 10px 20px;
            border-radius: 53px;
            transition: all 0.3s;
        }
        .cart:hover {
            font-weight: bold;
            transform: scale(1.2);
            text-decoration: none;
            color: #fff;
        }
        a[href="logout.php"] {
            color: red;
        }
        a[href="logout.php"]:hover {
            font-weight: bold;
            color: red;
        }
    </style>
</head>
<body>

<?php
include "Admin/connect.php";
if (isset($_SESSION["uid"])) {
    $sql = "SELECT customer_name FROM customer WHERE customer_id='$_SESSION[uid]'";
    $query = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($query);

    // Check if $_SESSION['cartCount'] is set
    $cartCount = isset($_SESSION['cartCount']) ? $_SESSION['cartCount'] : 0;

    echo '
            <header>
                <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container" id="nav-container">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <h1>Cocina ni Pao</h1>
                    <div class="collapse navbar-collapse" id="navbarNav" style="wdith:100%">
                        <ul class="navbar-nav">
                            <li>
                                <a href="homepage.php" class="nav-item">Home</a>
                            </li>
                            <li>
                                <a href="about.php" class="nav-item">About</a>
                            </li>
                            <li>
                                <a href="order.php" class="nav-item">Order</a>
                            </li>
                            <li>
                                <a href="help_support.php" class="nav-item">Contact</a>
                            </li>
                            <li>
                                <a style="font-size: 18px">Hello, '. $row["customer_name"] . '!</a>
                            </li>
                            <li>
                                <a href="logout.php" class="nav-item">Logout</a>
                            </li>
                            <li>
                            
                            </li>
                        </ul>
                    </div>

                    <!-- Shopping Cart Icon -->
                    <a href="cart.php" class="cart"><i class="fa-solid fa-cart-shopping" style="width: 50px; height: 50px;"></i>My Cart <sup>'. $cartCount .'</sup></a>

                </div>
                </nav>          
            </header>';
} else {
    echo '
            <header>
                <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container" id="nav-container" style="text-align:right;">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <h1>Cocina ni Pao</h1>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav" style="gap:5rem">
                            <li>
                                <a href="homepage.php" class="nav-item">Home</a>
                            </li>
                            <li>
                                <a href="about.php" class="nav-item">About</a>
                            </li>
                            <li>
                                <a href="order.php" class="nav-item">Order</a>
                            </li>
                            <li>
                                <a href="help_support.php" class="nav-item">Contact</a>
                            </li>
                            <li>
                                <a href="login.php" class="nav-item">Login</a>
                            </li>
                            <li>
                                <a href="register.php" class="cart"><i class="fa-solid fa-cart-shopping" style="width: 50px; height: 50px;"></i>Sign Up<sup></sup></a>
                            </li>
                        </ul>
                    </div>
                </div>
                </nav>          
            </header>';
}
?>

<script src="js/script.js"></script>

</body>
</html>
