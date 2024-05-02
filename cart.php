<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="js/script.js"></script>
</head>
<body>
    <?php 
    include('header.php');

    // Establish database connection
    include('Admin/connect.php');

    // Fetch items in the cart for the current user
    $customer_id = $_SESSION["uid"];
    $one_hour_ago = date('Y-m-d H:i:s', strtotime('-1 hour'));

    $query = "SELECT cart.*, order_details.order_received 
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
    ?>
        <div>
            <img src="images/<?php echo $row['img']?>" alt="">
            <h3><?php echo $row['name']?></h3>
            <div>Price: <?php echo $row['price']?></div>
            <label for="quantity_<?php echo $row['food_id']?>">Quantity:</label>
            <input type="number" name="quantity" id="quantity_<?php echo $row['food_id']?>" value="<?php echo $row['qty']?>" min="1" max="10" onchange="updateQuantity(<?php echo $row['food_id']?>, this.value)">
            <!-- Display total price for the item -->
            <div id="total_price_<?php echo $row['food_id']?>">Total Price: <?php echo $total_item_price ?></div>
        </div>
    <?php 
        }} else {
            echo "No products found.";
        }
    mysqli_close($con);
    ?>

    <!-- Display overall total price -->
    <div id="overall_total_price">Total Price: <?php echo $total_price ?></div>

    <!-- Checkout button -->
    <form method="post" action="checkout.php">
        <button type="submit" name="checkout">Checkout</button>
    </form>

</body>
</html>
