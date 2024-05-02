<?php
// Include your database connection code
include('admin/connect.php');

// Check if food_id and quantity are set
if(isset($_POST['food_id']) && isset($_POST['quantity'])) {
    // Sanitize inputs to prevent SQL injection
    $food_id = mysqli_real_escape_string($con, $_POST['food_id']);
    $quantity = mysqli_real_escape_string($con, $_POST['quantity']);

    // Update the quantity in the database
    $update_query = "UPDATE cart SET qty = '$quantity' WHERE food_id = '$food_id'";
    if(mysqli_query($con, $update_query)) {
        echo "Quantity updated successfully.";
    } else {
        echo "Error updating quantity: " . mysqli_error($con);
    }
} else {
    echo "Invalid request.";
}

// Close the database connection
mysqli_close($con);
?>
