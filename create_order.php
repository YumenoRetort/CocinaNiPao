<?php
include 'Admin/connect.php';

// Check if order ID is already set in the session
if(isset($_SESSION["order"])) {
    $order_id = $_SESSION["order"];
} else {
    // If order ID is not set, create a new order
    $customer_id = $_SESSION["uid"];
    $current_time = date('Y-m-d H:i:s');
    
    $insert_query = "INSERT INTO order_details (customer_id, order_received) VALUES ('$customer_id', '$current_time')";
    
    if (mysqli_query($con, $insert_query)) {
        // Get the newly inserted order ID
        $order_id = mysqli_insert_id($con);
        $_SESSION["order"] = $order_id; // Set order ID in session
    } else {
        echo "Error creating order: " . mysqli_error($con);
    }
}
?>
