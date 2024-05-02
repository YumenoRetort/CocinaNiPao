<?php 
include 'Admin/connect.php';

// Check if the add to cart button is clicked and the user is logged in
if(isset($_POST['add_to_cart'])) {
    if(isset($_SESSION['uid'])) { // Check if user is logged in
        
        include 'create_order.php';

        $food_name = $_POST['food_name'];
        $food_price = $_POST['food_price'];
        $food_image = $_POST['food_image'];
        $food_id = $_POST['food_id'];
        $food_quantity = 1;

        $insert_products = mysqli_query($con,"INSERT INTO `cart` (food_id, order_id, name, qty, price, img) VALUES ('$food_id', '$order_id', '$food_name','$food_quantity', '$food_price','$food_image')");
        if($insert_products){
            // Get cart count after successful addition
            $query = "SELECT COUNT(*) AS count FROM cart WHERE order_id='$order_id'";
            $result = mysqli_query($con, $query);
            $cartCount = 0;
            if ($row = mysqli_fetch_assoc($result)) {
                $cartCount = $row['count'];
            }
            $_SESSION['cartCount'] = $cartCount; // Store cart count in session
            header("Location: ".$_SERVER['REQUEST_URI']); // Redirect to the same page
            exit();
        } else {
            echo "Error: " . mysqli_error($con);
        }
        
    } else {
        // If user is not logged in, prompt them to log in
        echo 'User must be logged in';
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Products</title>

    <link rel = "stylesheet" href="css/style.css">
</head>
<body>
    
    <h1>Products</h1>

    <?php 
    $query = "SELECT * FROM food_products";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
           
    ?>

    <form method="post">
        <div>
            <img src="images/<?php echo $row['food_image']?>" alt="">
            <h3><?php echo $row['food_name']?></h3>
            <div>Price:<?php echo $row['food_price']?></div>
            <input type="hidden" name="food_name" value="<?php echo $row['food_name']?>">
            <input type="hidden" name="food_price" value="<?php echo $row['food_price']?>">
            <input type="hidden" name="food_image" value="<?php echo $row['food_image']?>">
            <input type="hidden" name="food_id" value="<?php echo $row['food_id']?>">
            <input type="submit" class="submit_btn cart_btn" value="Add to Cart" name="add_to_cart">
        </div>
    </form>

    <?php 
        }} else {
            echo "No products found.";
        }

    mysqli_close($con);
    ?>
    
    <script src="js/script.js"></script>
    
</body>
</html>
