<?php
include 'Admin/connect.php';
if(isset($_POST['add_to_cart'])){
    $food_name=$POST['food_name'];
    $food_price=$POST['food_price'];
    $food_image=$POST['food_image'];
    $food_quantity=1;

    $insert_products=mysqli_query($con,"insert into 'cart' (name, qty, price, image) value ('$food_name','$food_quantity', '$food_price','$food_image')");
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
            <input type="hidden" name="food_name" <?php echo $row['food_name']?>>
            <input type="hidden" name="food_price" <?php echo $row['food_price']?>>
            <input type="hidden" name="food_image" <?php echo $row['food_image']?>>
            <input type="submit" class="submit_btn cart_btn" value="Add to Cart" name="add to_cart">
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

