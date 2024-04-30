<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php
    include 'connect.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $food_id = $_POST['food_id'];
        $food_name = $_POST['food_name'];
        $food_price = $_POST['food_price'];
        $food_description = $_POST['food_description'];
        
        $update_query = "UPDATE food_products SET 
                        food_name='$food_name', 
                        food_price='$food_price', 
                        food_description='$food_description' 
                        WHERE food_id='$food_id'";

        if(mysqli_query($con, $update_query)) {
            echo "Food item updated successfully!";
        } else {
            echo "Error: " . mysqli_error($con);
        }
    } else {
        $food_id = $_GET['id'];
        $query = "SELECT * FROM food_products WHERE food_id='$food_id'";
        $result = mysqli_query($con, $query);
        $row = mysqli_fetch_assoc($result);
    ?>
    
    <h2>Update Product</h2>
    <form method="post" enctype="multipart/form-data" action="">
        <input type="hidden" name="food_id" value="<?php echo $row['food_id']; ?>">
        Name: <input type="text" name="food_name" class="input_fields" value="<?php echo $row['food_name']; ?>" required><br>
        Price: <input type="text" name="food_price" class="input_fields" value="<?php echo $row['food_price']; ?>" required><br>
        Description: <input type="text" name="food_description" class="input_fields" value="<?php echo $row['food_description']; ?>" required><br>
        <input type="submit" value="Update">
    </form>

    <?php
    }
    mysqli_close($con);
    ?>
</body>
</html>
