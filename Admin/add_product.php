<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="../js/script.js"></script>
    <style>
        body {
            background-color: #EFEAE4;
            font-family: 'Poppins', sans-serif;
        }
        .add-products-container {
            padding: 40px;
            margin-top: 50px;
            background-color: #fab438;
            border-radius: 35px;
            margin-right: 10px;
        }
        .all-products-container {
            padding: 40px;
            margin-top: 50px;
            background-color: #fab438;
            border-radius: 35px;
        }
        .input_fields[type="text"] {
            width: 100%;
            border-radius: 35px; 
            transition: all 0.3s; 
            padding: 10px;
            box-sizing: border-box; 
        }
        .input_fields[type="text"]:focus {
            transform: scale(1.05); 
            border-color: #474747; 
            box-shadow: 0 0 5px rgba(250, 180, 56, 0.5);
            outline: none; 
        }
        .btn-submit {
            border-radius: 35px;
            transition: all 0.3s;
            width: 100%;
            background-color: #474747;
            border: none;
            color: #fff;
        }
        .btn-submit:hover {
            transform: scale(1.05);
            background-color: #474747;
            font-weight: bold;
            border: none;
            color: #fff;
        }
        .table-custom {
            width: 100%;
            border-collapse: collapse;
            border: none;
        }
        .table-custom th {
            padding: 10px;
            background-color: #fab438;
            color: white;
            background-color: #474747;
            border: none;
        }
        .table-custom td {
            padding: 10px; 
        }   
        .table-custom tbody tr:nth-child(even) {
            background-color: #EFEAE4;
            color: #474747;
        }
        .btn-update {
            border-radius: 35px;
            transition: all 0.3s;
            width: 100%;
            background-color: #474747;
            border: none;
            color: #fff;
            margin-bottom: 10px;
        }
        .btn-update:hover {
            transform: scale(1.05);
            background-color: #474747;
            font-weight: bold;
            border: none;
            color: #fff;
        }
        .btn-delete {
            border-radius: 35px;
            transition: all 0.3s;
            width: 100%;
            background-color: #dc3545;
            border: none;
            color: #fff;
        }
        .btn-delete:hover {
            transform: scale(1.05);
            background-color: #dc3545;
            font-weight: bold;
            border: none;
            color: #fff;
        }
    </style>
</head>
<body>
    <?php include 'admin_header.php'; ?>
    <div class="container">
        <div class="row">
            <!-- Add Products Container -->
            <div class="col-md-6">
                <div class="add-products-container">
                    <h2>Add Products</h2>
                    <form method="post" enctype="multipart/form-data" action="">
                        <input type="text" name="food_name" class="input_fields form-control" required placeholder="Name"><br>
                        <input type="text" name="food_price" class="input_fields form-control" required placeholder="Price"><br>
                        <input type="text" name="food_description" class="input_fields form-control" required placeholder="Description"><br>
                        Image: <input type="file" name="food_image" class="input_fields form-control" required accept="image/png, image/jpg, image/jpeg"><br>
                        <input type="submit" value="Submit" class="btn btn-primary btn-submit">
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
                </div>
            </div>
            <!-- All Products Container -->
            <div class="col-md-6">
                <div class="all-products-container">
                    <h2>All Products</h2>
                    <table class="table table-custom">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Description</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
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
                echo "<td><button class='btn btn-update' onclick='openUpdatePopup(" . $row_all['food_id'] . ")'>Update</button>
                    <button class='btn btn-delete' onclick='openDeletePopup(" . $row_all['food_id'] . ")'>Delete</button>
                </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No products found.</td></tr>";
        }

    mysqli_close($con);
    ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>