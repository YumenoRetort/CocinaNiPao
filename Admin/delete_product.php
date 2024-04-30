<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Product</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php
    include 'connect.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $food_id = $_POST['food_id'];
        
        $delete_query = "DELETE FROM food_products WHERE food_id='$food_id'";

        if(mysqli_query($con, $delete_query)) {
            echo "Food item deleted successfully!";
        } else {
            echo "Error: " . mysqli_error($con);
        }
    } else {
        $food_id = $_GET['id'];
        $query = "SELECT * FROM food_products WHERE food_id='$food_id'";
        $result = mysqli_query($con, $query);
        $row = mysqli_fetch_assoc($result);
    ?>
    
    <h2>Delete Product</h2>
    <form method="post" action="">
        <input type="hidden" name="food_id" value="<?php echo $row['food_id']; ?>">
        Are you sure you want to delete the product "<?php echo $row['food_name']; ?>"?<br><br>
        <input type="submit" value="Delete">
    </form>

    <?php
    }
    mysqli_close($con);
    ?>
</body>
</html>
