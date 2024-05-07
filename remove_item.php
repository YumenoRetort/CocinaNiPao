<?php
session_start();

// Check if the food ID is provided
if(isset($_POST['food_id'])) {
    // Establish database connection
    include('Admin/connect.php');

    $food_id = $_POST['food_id'];
    $order_id = $_SESSION['order']; // Assuming you're storing order ID in session

    // Prepare and execute SQL to remove item from cart
    $query = "DELETE FROM cart WHERE food_id = $food_id AND order_id = $order_id";
    $result = mysqli_query($con, $query);

    // Check if deletion was successful
    if($result) {
        // Redirect back to the cart page after item removal
        unset($_SESSION['cartCount']);
        header("Location: cart.php");
        exit();
    } else {
        // If deletion failed, display an error message
        echo "Failed to remove item from cart.";
    }

    mysqli_close($con);
} else {
    // If food ID is not provided, display an error message
    echo "Food ID not provided.";
}
?>
