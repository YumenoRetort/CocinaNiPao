<!DOCTYPE html>
<html lang="en">
<head>
<?php include 'admin_header.php'; ?>
<?php 
    $_SESSION['customer_message_id'] = null;
?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Homepage</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            background-color: #EFEAE4;
            font-family: 'Poppins', sans-serif;
        }
		.btn-primary {
			width: 100%;
			background-color: #999b85;
			color: #fff;
			border: none;
			border-radius: 35px;
			padding: 10px;
			transition: all 0.3s;
		}

		.btn-primary:hover {
			transform: scale(1.1);
			background-color: #999b85;
            font-weight: bold;
		}

        .buttoncont {
            width: 45%;
            margin: 0 auto;
            padding: 40px;
            border-radius: 35px;
            background-color: #FAB438;
            text-align: center;
            margin-top: 50px;
        }
        h2 {
            font-size: 35px;
            font-weight: bold;
        }
		.btn {
            border-radius: 35px;
        }

    </style>
</head>
<body>

<div class="buttoncont">
    <div class="container">
        <h2>Welcome back! What are we feeling today?</h2>
        <div class="buttons">
            <a href="add_product.php" class="btn btn-primary mt-2 rounded-pill">Add Product</a>
            <a href="add_staff.php" class="btn btn-primary mt-3 rounded-pill">Add Staff</a>
            <a href="view_orders.php" class="btn btn-primary mt-3 rounded-pill">View Orders</a>
            <a href="comp_orders.php" class="btn btn-primary mt-3 rounded-pill">Completed Orders</a>
            <a href="admin_message.php" class="btn btn-primary mt-3 rounded-pill">Admin Messages</a>
        </div>
    </div>
</div>

<script src="js/script.js"></script>

</body>
</html>
