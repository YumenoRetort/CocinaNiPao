
<form method="post" action="">
    Name: <input type="text" name="food_name"><br>
    Price: <input type="text" name="food_price"><br>
    Description: <input type="text" name="food_description"><br>
    <input type="submit" value="Submit">
</form>


<?php
include 'connect.php';

// Assuming you have received product details via POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Extracting product details from the POST data
    $food_name        = $_POST['food_name'];
    $food_price       = $_POST['food_price'];
    $food_description = $_POST['food_description'];

    // Inserting product details into the database
    $insert_query = "INSERT INTO food_products (food_name, food_price, food_description) 
                     VALUES ('$food_name', '$food_price', '$food_description')";
    
    // Running the insert query
    if(mysqli_query($con, $insert_query)) {
        echo "Food item inserted successfully!";
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
?>
