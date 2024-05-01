<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>
    <link rel="stylesheet" href="css/style.css">

    <script src="../js/script.js"></script>
</head>
<body>

    <?php include 'admin_header.php'; ?>

    <h2>Add Products</h2>
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

    <h2>All Products</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Price</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>

    
        <?php
        // Fetch all products from the database
        $query_all = "SELECT * FROM food_products";
        $result_all = mysqli_query($con, $query_all);

        if(mysqli_num_rows($result_all) > 0) {
            // Loop through each product and display it in the table
            while ($row_all = mysqli_fetch_assoc($result_all)) {
                echo "<tr>";
                echo "<td>" . $row_all['food_id'] . "</td>";
                echo "<td>" . $row_all['food_name'] . "</td>";
                echo "<td>" . $row_all['food_price'] . "</td>";
                echo "<td>" . $row_all['food_description'] . "</td>";
                echo "<td><button onclick='openUpdatePopup(" . $row_all['food_id'] . ")'>Update</button>
                    <button onclick='openDeletePopup(" . $row_all['food_id'] . ")'>Delete</button>
                </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No products found.</td></tr>";
        }

    mysqli_close($con);
    ?>
    </table>
</body>
</html>




