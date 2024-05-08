<?php 
include 'Admin/connect.php';

// Check if the add to cart button is clicked and the user is logged in
if(isset($_POST['add_to_cart'])) {
    if(isset($_SESSION['uid'])) { // Check if user is logged in
        
        include 'create_order.php';

        $food_name = $_POST['food_name'];
        $food_price = $_POST['food_price'];
        $food_image = $_POST['food_image'];
        $food_id = $_POST['food_id'];
        $food_quantity = 1;
        $order_id = $_SESSION["order"];

        $query = "SELECT * FROM cart WHERE order_id = '$order_id' AND food_id = '$food_id'";
        $result = mysqli_query($con, $query);

        if (mysqli_num_rows($result) == 0){
            $insert_products = mysqli_query($con,"INSERT INTO `cart` (food_id, order_id, name, qty, price, img) VALUES ('$food_id', '$order_id', '$food_name','$food_quantity', '$food_price','$food_image')");
            if($insert_products){
                // Get cart count after successful addition
                $query = "SELECT COUNT(*) AS count FROM cart WHERE order_id='$order_id'";
                $result = mysqli_query($con, $query);
                $cartCount = 0;
                if ($row = mysqli_fetch_assoc($result)) {
                    $cartCount = $row['count'];
                }
                $_SESSION['cartCount'] = $cartCount; // Store cart count in session
                header("Location: ".$_SERVER['REQUEST_URI']); // Redirect to the same page
                exit();
            } else {
                echo "Error: " . mysqli_error($con);
            }
        } else{
            echo 'Item already in cart';
        }

        
        
    } else {
        // If user is not logged in, prompt them to log in
        echo 'User must be logged in';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Products</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link rel = "stylesheet" href="css/style.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap');
        body {
            background-color: #efeae4;
            font-family: "DM Sans", sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        h1 {
            font-size: 60px;
            font-weight: bold;
        }

        .card {
            border-radius: 36px;
            background-color: #fab438;
            border: none;
        }

        .container-fluid {
            max-width: 80%;
            margin: 0 auto;
        }

        .card-img-top {
            object-fit: cover;
            height: 450px;
            width: 100%;
            border-radius: 36px;
            padding: 20px;
        }

        .card-title{
            font-weight: bold;
            font-size: 40px;
            padding:  0 20px;
            margin: 0;
        }

        .card-body {
            margin: 0 10px;
            padding: 10px;
            font-size: 24px
        }

        .submit_btn {
            background-color: #474747;
            color: #f0eeee;
            border: none;
            font-weight: medium;
            margin: 10px 0;
            width: 100%;
            padding: 10px;
            border-radius: 32px;
        }

        .submit_btn:hover {
            background-color:#333333;
            font-weight: bold;
            transform: scale(1.1);
            transition: all 0.3s
        }

        .card-price {
            margin: 5px;
        }
    </style>
</head>
<body>
    
    <div class="container-fluid" width="80%">
        <h1>Products</h1>

        <div class="row gx-2 gx-lg-5 row-cols-1 row-cols-md-2 row-cols-lg-2 row-cols-xl-3 justify-content-center">
            <?php 
            $query = "SELECT * FROM food_products";
            $result = mysqli_query($con, $query);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                
            ?>

            <div class="col my-3">
                <form method="post">
                
                <div class="card shadow h-100">
                    <img src="images/<?php echo $row['food_image']?>" alt="" class="card-img-top">
                    <h3 class="card-title"><?php echo $row['food_name']?></h3>
                    <div class="card-body">
                        <div class="card-price">Price:<?php echo $row['food_price']?></div>
                        <input type="hidden" name="food_name" value="<?php echo $row['food_name']?>">
                        <input type="hidden" name="food_price" value="<?php echo $row['food_price']?>">
                        <input type="hidden" name="food_image" value="<?php echo $row['food_image']?>">
                        <input type="hidden" name="food_id" value="<?php echo $row['food_id']?>">
                        <input type="submit" class="submit_btn cart_btn text-center" value="Add to Cart" name="add_to_cart">
                    </div>
                </div>
                </form>
            </div>
    
            <?php 
                }} else {
                    echo "No products found.";
                }

            mysqli_close($con);
            ?>
        </div>
    </div>
    
    <script src="js/script.js"></script>
    
</body>
</html>
