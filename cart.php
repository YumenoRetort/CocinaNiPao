<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>HomePage</title>

	<link rel = "stylesheet" href="css/style.css">
</head>
<body>
	
    <?php 
    include('header.php');
	?>

    <?php 

    $one_hour_ago = date('Y-m-d H:i:s', strtotime('-1 hour'));
    $customer_id = $_SESSION["uid"];

    // Query to select food items ordered within the last hour
    $query = "SELECT cart.*, order_details.order_received 
            FROM cart 
            INNER JOIN order_details ON cart.order_id = order_details.order_id 
            WHERE order_details.customer_id = $customer_id AND order_details.order_received >= '$one_hour_ago'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {

    ?>

    <form method="post">
        <div>
            <img src="images/<?php echo $row['img']?>" alt="">
            <h3><?php echo $row['name']?></h3>
            <div>Price:<?php echo $row['price']?></div>
            <div>Quantity:<?php echo $row['qty']?></div>
            <input type="hidden" name="food_name" value="<?php echo $row['name']?>">
            <input type="hidden" name="food_price" value="<?php echo $row['price']?>">
            <input type="hidden" name="food_image" value="<?php echo $row['img']?>">
            <input type="hidden" name="food_id" value="<?php echo $row['food_id']?>">
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

