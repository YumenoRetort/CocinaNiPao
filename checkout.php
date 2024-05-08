<?php 
include('header.php');

// Establish database connection
include('Admin/connect.php');

// Initialize total price variable
$total_price = 0;

if(isset($_SESSION['order'])) {
    // Fetch items in the cart for the current user
    $customer_id = $_SESSION["uid"];
    $order_id = $_SESSION["order"];

    $query = "SELECT cart.*, order_details.order_id 
            FROM cart 
            INNER JOIN order_details ON cart.order_id = order_details.order_id 
            WHERE order_details.customer_id = $customer_id AND order_details.order_id = $order_id";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            // Calculate total price for each item
            $total_item_price = $row['price'] * $row['qty'];
            // Add total price for the item to overall total price
            $total_price += $total_item_price;
        }

        // Check if the form is submitted
        if(isset($_POST['confirm_payment'])) {
            // Insert into payment table
            $insert_query = "INSERT INTO payment (order_id, total_amount) VALUES ($order_id, $total_price)";
            mysqli_query($con, $insert_query);

            // Unset session variables
            unset($_SESSION["order"]);
            unset($_SESSION['cartCount']);

            // Show confirmation message
            echo "<script>alert('Your order was confirmed!'); window.location='homepage.php';</script>";
            exit; // Stop further execution
        }

    } else {
        echo "No products found.";
    }

    mysqli_free_result($result);
} else {
    echo "No products found.";
}

mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <script src="js/script.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #474747;
            font-family: "Poppins", sans-serif;
        }
        #payment-header {
            color: #474747;
            text-align: center;
            margin-bottom: 20px;
        }
        .container {
            margin-top: 100px;
            background-color: white;
            padding: 20px;
            border-radius: 35px;
            max-width: 550px;
            font-size: 35px;
        }
        #overall_total_price {
            color: #474747;
            text-align: center;
            margin-bottom: 20px;
        }
        button[type="submit"] {
            width: 100%;
            margin: 0 auto;
            display: block;
            transition: all 0.3s ease-in-out;
            border-radius: 35px;
            background-color: #FFD17F;
            border: none;
            color: #474747;
            padding-top: 15px;
            padding-bottom: 15px;
        }
        button[type="submit"]:hover {
            transform: scale(1.05);
            font-weight: bold;
            background-color: #FFD17F;
            color: #474747;
        }
        h2 {
            font-size: 50px;
            font-weight: bold;
        }
    </style>
</head>
<body>
<div class="container">
    <h2 id="payment-header">Payment</h2>
    <!-- Display overall total price -->
    <div id="overall_total_price">Total Price: ₱<b><?php echo $total_price ?></b></div>

    <!-- Confirm Payment button -->
    <form method="post" action="">
        <button type="submit" name="confirm_payment" class="btn btn-primary">Confirm Payment</button>
    </form>
</div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
