<?php 
include('header.php');

// Initialize total price variable
$total_price = 0;

// Check if the $_SESSION['uid'] variable is set
if(isset($_SESSION['uid'])) {
    // Check if the "order" session variable is set
    if(isset($_SESSION['order'])) {
        // Establish database connection
        include('Admin/connect.php');

        // Fetch items in the cart for the current user
        $customer_id = $_SESSION["uid"];
        $order_id = $_SESSION["order"];

        $query = "SELECT cart.*, order_details.order_received 
                FROM cart 
                INNER JOIN order_details ON cart.order_id = order_details.order_id 
                WHERE order_details.customer_id = $customer_id AND order_details.order_id = $order_id";
        $result = mysqli_query($con, $query);
        
        if (!$result){
            echo "No items in the cart";
        } else {
            if (mysqli_num_rows($result) > 0) {
                // If there are items in the cart, display them
                while ($row = mysqli_fetch_assoc($result)) {
                    // Calculate total price for each item
                    $total_item_price = $row['price'] * $row['qty'];
                    // Add total price for the item to overall total price
                    $total_price += $total_item_price;
            ?>
                    <div>
                        <img src="images/<?php echo $row['img']?>" alt="">
                        <h3><?php echo $row['name']?></h3>
                        <div>Price: <?php echo $row['price']?></div>
                        <label for="quantity_<?php echo $row['food_id']?>">Quantity:</label>
                        <input type="number" name="quantity" id="quantity_<?php echo $row['food_id']?>" value="<?php echo $row['qty']?>" min="1" max="10" onchange="updateQuantity(<?php echo $row['food_id']?>, this.value)">
                        <!-- Display total price for the item -->
                        <div id="total_price_<?php echo $row['food_id']?>">Total Price: <?php echo $total_item_price ?></div>
                        <!-- Remove button for each item -->
                        <form method="post" action="remove_item.php">
                            <input type="hidden" name="food_id" value="<?php echo $row['food_id']?>">
                            <button type="submit" name="remove_item">Remove</button>
                        </form>
                    </div>
            <?php 
                }
            } else {
                // If there are no items in the cart, display a message
                echo "Your cart is empty.";
            }
        }

        mysqli_close($con);
    } else {
        // If "order" session variable is not set, display a message indicating an empty cart
        echo "Your cart is empty.";
    }
} else {
    // If the user is not logged in, prompt them to log in
    echo "Please log in to view your cart.";
}
?>

<!-- Display overall total price -->
<div id="overall_total_price">Total Price: <?php echo $total_price ?></div>

<!-- Checkout button -->
<form method="post" action="checkout.php">
    <input type="hidden" name="overallprice" value="<?php echo $total_price?>">
    <button type="submit" name="checkout">Checkout</button>
</form>
