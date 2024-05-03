<?php 
include('header.php');

// Establish database connection
include('Admin/connect.php');

// Fetch items in the cart for the current user
$customer_id = $_SESSION["uid"];
$one_hour_ago = date('Y-m-d H:i:s', strtotime('-1 hour'));

$query = "SELECT cart.*, order_details.order_id 
        FROM cart 
        INNER JOIN order_details ON cart.order_id = order_details.order_id 
        WHERE order_details.customer_id = $customer_id AND order_details.order_received >= '$one_hour_ago'";
$result = mysqli_query($con, $query);

// Initialize total price variable
$total_price = 0;

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        // Calculate total price for each item
        $total_item_price = $row['price'] * $row['qty'];
        // Add total price for the item to overall total price
        $total_price += $total_item_price;

        // Check if the form is submitted
        if(isset($_POST['confirm_payment'])) {
            // Your payment confirmation logic here...

            // Show confirmation message
            echo "<script>alert('Your order was confirmed!'); window.location='homepage.php';</script>";
            exit; // Stop further execution
        }
    }
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
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <!-- Display overall total price -->
    <div id="overall_total_price">Total Price: <?php echo $total_price ?></div>

    <!-- Confirm Payment button -->
    <form method="post" action="">
        <button type="submit" name="confirm_payment">Confirm Payment</button>
    </form>

</body>
</html>
