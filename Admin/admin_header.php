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
        a[href="../logout.php"] {
            color: red;
        }
        a[href="../logout.php"]:hover {
            font-weight: bold;
            color: red;
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
            transform: scale(1.1);
            text-decoration: none;
        }
        .cart {
        #navbarNav.collapse.navbar-collapse {
            text-align: right;
        }
    </style>
</head>
</head>
<body>

<header>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container" id="nav-container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>    
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li>
                    <h1>Admin</h1>
                    </li>
                    <li>
                        <a href="admin_homepage.php" class="nav-item">Home</a>
                    </li>
                    <li>
                        <a href="add_product.php" class="nav-item">Add Product</a>
                    </li>
                    <li>
                        <a href="add_staff.php" class="nav-item">Add Staff</a>
                    </li>
                    <li>
                        <a href="view_orders.php" class="nav-item">View Current Orders</a>
                    </li>
                    <li>
                        <a href="comp_orders.php" class="nav-item">View Completed Orders</a>
                    </li>
                    <li>
                        <a href="admin_message.php" class="nav-item">Messages</a>
                    </li>
                    <li>
                        <a href="../logout.php" class="nav-item">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<script src="js/script.js"></script>

</body>
</html>
