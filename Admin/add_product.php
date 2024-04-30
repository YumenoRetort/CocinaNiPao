<form method="post" enctype="multipart/form-data" action="">
    Name: <input type="text" name="food_name" class="input_fields" required><br>
    Price: <input type="text" name="food_price" class="input_fields" required><br>
    Description: <input type="text" name="food_description" class="input_fields" required><br>
    Image: <input type="file" name="food_image" class="input_fields" required accept="image/png, image/jpg, image/jpeg"><br>
    <input type="submit" value="Submit">
</form>

<?php
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $food_name = $_POST['food_name'];
    $food_price = $_POST['food_price'];
    $food_description = $_POST['food_description'];
    $food_image = $_FILES['food_image']['name']; 
    $food_image_temp  = $_FILES['food_image']['tmp_name']; 
    $upload_dir = '../images/';

    if (move_uploaded_file($food_image_temp, $upload_dir . $food_image)) {
        echo "Image uploaded successfully. ";
    } else {
        echo "Failed to upload image.";
    }

    $insert_query = "INSERT INTO food_products (food_name, food_price, food_description, food_image) 
                     VALUES ('$food_name', '$food_price', '$food_description', '$food_image')";

    if(mysqli_query($con, $insert_query)) {
        echo "Food item inserted successfully!";
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
?>
