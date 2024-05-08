<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Header</title>

	<link rel = "stylesheet" href="css/style.css">
</head>
<body>

<header>
    <h1>Cocina ni Pao</h1>
    <nav>
        <a href="admin_homepage.php">Home</a> |
        <a href="add_product.php">Add Product</a> |
        <a href="add_staff.php">Add Staff</a> |
        <a href="view_orders.php">View Current Orders</a> |
        <a href="comp_orders.php">View Completed Orders</a> |
				<a href="admin_message.php">Messages</a> |
        <a href="../logout.php">Logout</a>
    </nav>

</header>

	<script src="js/script.js"></script>

</body>
</html>
