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
    include 'Admin/connect.php';

    $query = "SELECT * FROM food_products";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<div>";
            echo "<p>Name: " . $row['food_name'] . "</p>";
            echo "<p>Price: " . $row['food_price'] . "</p>";
            echo "<p>Description: " . $row['food_description'] . "</p>";
            echo "<img src='images/images.jpg' alt='Product Image' style='width: 200px; height: 200px;'>";
            echo "<input type='submit'value='add to cart'>";
            echo "</div>";
        }
    } else {
        echo "No products found.";
    }

    mysqli_close($con);
    ?>
	
	<script src="js/script.js"></script>
	
</body>
</html>

