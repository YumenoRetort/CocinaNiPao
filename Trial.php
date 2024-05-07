<?php 
include('header.php');

// Establish database connection
include('Admin/connect.php');

// Initialize total price variable
$total_price = 0;

// if(isset($_SESSION['order'])) {
//     // Fetch items in the cart for the current user
//     $customer_id = $_SESSION["uid"];
//     $order_id = $_SESSION["order"];

//     $query = "SELECT cart.*, order_details.order_id 
//             FROM cart 
//             INNER JOIN order_details ON cart.order_id = order_details.order_id 
//             WHERE order_details.customer_id = $customer_id AND order_details.order_id = $order_id";
//     $result = mysqli_query($con, $query);

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
