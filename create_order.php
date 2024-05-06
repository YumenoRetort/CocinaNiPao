<?php
include 'Admin/connect.php';

$current_time = date('Y-m-d H:i:s');
$one_hour_ago = date('Y-m-d H:i:s', strtotime('-1 hour'));

$customer_id = $_SESSION["uid"];

// Check if there's an existing order within the last hour for the same user
$query = "SELECT order_id FROM order_details WHERE customer_id = $customer_id AND order_received BETWEEN '$one_hour_ago' AND '$current_time'";
$result = mysqli_query($con, $query);

if (mysqli_num_rows($result) == 0) {
    // If no existing order within the last hour, create a new order
    $insert_query = "INSERT INTO order_details (customer_id, order_received) VALUES ('$customer_id', '$current_time')";
    if (mysqli_query($con, $insert_query)) {
        // Get the newly inserted order ID
        $_SESSION["order"] = mysqli_insert_id($con);
    } else {
        echo "Error creating order: " . mysqli_error($con);
    }
} else {
    // If an order exists within the last hour, use its order ID
    $order_row = mysqli_fetch_assoc($result);
    $_SESSION["order"] = $order_row['order_id'];
}

?>
