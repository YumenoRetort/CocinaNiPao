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

        echo '<h1 style="font-size: 60px;font-weight: bold;text-align:center; font-size: 96px; color: #474747">My Cart</h1>';
        
        if (!$result || mysqli_num_rows($result) <= 0){
            echo '<div class="alert alert-danger" role="alert">Your cart is empty.</div>';
        } else {
            // If there are items in the cart, display them
            while ($row = mysqli_fetch_assoc($result)) {
                // Calculate total price for each item
                $total_item_price = $row['price'] * $row['qty'];
                // Add total price for the item to overall total price
                $total_price += $total_item_price;
        ?>
                <!-- Bootstrap CSS -->
                <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
                <style>
                    @import url('https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap');
                    body {
                        background-color: #999B85;
                        font-family: "DM Sans", sans-serif;
                        margin: 0;
                        padding: 0;
                        box-sizing: border-box;
                    }

                    .container-fluid {
                        max-width: 90%;
                        margin: 0 auto;
                    }

                    .row {
                        max-width: 100%;
                        margin: 10px auto;
                    }

                    .fixed-width {
                        max-width: 800px;
                        margin: 10px auto;
                    }

                    .main {
                        background-color: #f5f5f5;
                        padding: 20px;
                        border-radius: 14px;
                        width: 80%;
                        margin: 0 auto;
                    }
                    
                    .row-price {
                        background-color: #f5f5f5;
                        padding: 20px;
                        border-radius: 5px;
                    }

                    .remove-btn, .checkout-btn {
                        border: none;
                        background-color: #474747;
                        color: white;
                        border-radius: 53px;
                        font-weight: medium;
                        margin: 10px 0;
                        width: 100%;
                        padding: 10px;
                    }

                    .remove-btn:hover, .checkout-btn:hover{
                        background-color:#333333;
                        font-weight: bold;
                        transform: scale(1.1);
                        transition: all 0.3s
                    }

                    .checkout-btn {
                        width: 80%; 
                        margin: 0 auto;
                    }

                    .img-fluid {
                        border-radius: 7px;

                    }

                    h3 {
                        font-weight: bold;
                        font-size: 40px;
                        color: black;
                    }

                    .alert {
                        font-size:18px;
                        padding: 10px;
                        border-radius: 5px;
                        margin: 1rem 12rem;
                    }

                    .alert-danger {
                        background-color: #f8d7da;
                    }

                </style>

            <div class="container-fluid">
                <div class="row fluid-width">
                    <div class="col ">
                        <div class="row">
                            <div class="row main align-items-center">
                                <div class="col-2"><img src="images/<?php echo $row['img']?>" alt="" class="img-fluid"></div>
                                <div class="col">
                                    <div class="row text-muted"><h3><?php echo $row['name']?></h3></div>
                                </div>
                                <div class="col" style="text-align: center">
                                    <label for="quantity_<?php echo $row['food_id']?>">Quantity:</label>
                                    <input type="number" name="quantity" id="quantity_<?php echo $row['food_id']?>" value="<?php echo $row['qty']?>" min="1" max="10" onchange="updateQuantity(<?php echo $row['food_id']?>, this.value)">
                                </div>
                                <div class="col">
                                    <!-- Display total price for the item -->
                                    <div id="total_price_<?php echo $row['food_id']?>">Total Price: <?php echo $total_item_price ?></div>
                                </div>
                                <div class="col">
                                    <form method="post" action="remove_item.php">
                                        <input type="hidden" name="food_id" value="<?php echo $row['food_id']?>">
                                        <button type="submit" name="remove_item" class="remove-btn">Remove</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <?php 
            }

            // Display overall total price

            echo '<div class="container-fluid">';
                echo '<div class="row justify-content-center fluid-width">';
                    echo '<div class="col">';
                        echo '<div class="row">';
                            echo '<div class="row main-align-items-center" style="width:100%">';
                                echo '<div id="overall_total_price" class="main" style="font-size: 24px; font-weight: medium">Total Price: ' . $total_price . '</div>';
                            echo '</div>';
                        echo '</div>';
                        echo '<div class="text-center">';
                            echo '<div style="width: 100%">';
                            echo '<form method="post" action="checkout.php">';
                            echo '<input type="hidden" name="overallprice" value="' . $total_price . '">';
                            echo '<button type="submit" class="checkout-btn" name="checkout">Checkout</button>';
                            echo '</form>';
                            echo '</div>';
                        echo '</div>';
                    echo '<div>';
                echo '</div>';
            echo '</div>';
        }

        mysqli_close($con);
    } else {
        // No order_Id
        echo "Your cart is empty.";
    }
} else {
    // Prompt to log in
    echo "Please log in to view your cart.";
}
?>
