<?php
include 'connect.php';

// Check if a product ID is provided in the URL
if(isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // Fetch the details of the selected product from the database
    $query = "SELECT * FROM food_products WHERE id='$product_id'";
    $result = mysqli_query($con, $query);

    if(mysqli_num_rows($result) > 0) {
        // Fetch the product details
        $row = mysqli_fetch_assoc($result);
        $food_name = $row['food_name'];
        $food_price = $row['food_price'];
        $food_description = $row['food_description'];
        // Add more fields as needed
        
        // Display the update form with the fetched product details
?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Update Product</title>
            <link rel="stylesheet" href="css/style.css">
        </head>
        <body>
            <h1>Update Product</h1>
            <form method="post" enctype="multipart/form-data" action="update_process.php">
                <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                Name: <input type="text" name="food_name" class="input_fields" required value="<?php echo $food_name; ?>"><br>
                Price: <input type="text" name="food_price" class="input_fields" required value="<?php echo $food_price; ?>"><br>
                Description: <input type="text" name="food_description" class="input_fields" required value="<?php echo $food_description; ?>"><br>
                <!-- Add more fields for other product details -->
                <input type="submit" value="Update">
            </form>
        </body>
        </html>
<?php
    } else {
        echo "Product not found.";
    }
} else {
    echo "Product ID not provided.";
}

mysqli_close($con);
?>
