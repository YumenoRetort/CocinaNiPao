<?php
// Include your database connection code
include('Admin/connect.php');

// Check if food_id and quantity are set
if(isset($_POST['food_id']) && isset($_POST['quantity'])) {
    // Sanitize inputs to prevent SQL injection
    $food_id = mysqli_real_escape_string($con, $_POST['food_id']);
    $quantity = mysqli_real_escape_string($con, $_POST['quantity']);

    // Log the received data
    error_log("Received food ID: $food_id, quantity: $quantity");

    // Update the quantity in the database
    $update_query = "UPDATE cart SET qty = '$quantity' WHERE food_id = '$food_id'";
    if(mysqli_query($con, $update_query)) {
        // Calculate total price based on the unit price of the item (replace $unit_price with your actual unit price retrieval method)
        $unit_price_query = "SELECT price FROM cart WHERE food_id = '$food_id'";
        $unit_price_result = mysqli_query($con, $unit_price_query);
        if ($unit_price_row = mysqli_fetch_assoc($unit_price_result)) {
            $unit_price = $unit_price_row['price'];
            $total_price = $quantity * $unit_price;
            echo $total_price; // Return the total price as the response
        } else {
            echo "Error: Unit price not found for food ID $food_id";
        }
    } else {
        $error_message = "Error updating quantity: " . mysqli_error($con);
        echo $error_message;
        // Log the error
        error_log($error_message);
    }
} else {
    echo "Invalid request.";
}

// Close the database connection
mysqli_close($con);
?>
