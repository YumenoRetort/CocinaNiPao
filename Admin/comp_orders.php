<?php 
include('admin_header.php');
include('connect.php');

// Retrieve staff members and order statuses from the database
$staff_query = "SELECT * FROM staff";
$staff_result = mysqli_query($con, $staff_query);

$query = "SELECT cart.*, order_details.order_id, order_details.order_status, order_details.staff_id
        FROM cart 
        INNER JOIN order_details ON cart.order_id = order_details.order_id 
        WHERE order_details.order_status = 'completed'
        ORDER BY order_details.order_id ASC, cart.cart_id ASC"; // Order by order_id, then cart_id

$result = mysqli_query($con, $query);

if (mysqli_num_rows($result) > 0) {
    $current_order_id = null; // Initialize current order ID
    while ($row = mysqli_fetch_assoc($result)) {
        // Check if the order ID has changed
        if ($row['order_id'] != $current_order_id) {
            // If it has changed, print the order header
            if ($current_order_id !== null) {
                echo '</tbody>'; // Close tbody for the current order
                echo '</table>'; // Close the table for the current order
                // Display staff name and order status as text beneath the table for the current order
                echo "<div class='order-status'>";
                echo "<p>Staff: " . $staff_name_row['staff_name'] . "</p>";
                echo "<p>Status: " . $order_status . "</p>";
                echo "</div>";
                echo '</div>';   // Close the div for the current order
            }
            echo "<div class='order-container'>";
            echo "<h2>Order " . $row['order_id'] . ":</h2>";
            // Start table for the current order
            echo "<table class='center'>"; 
            echo "<thead><tr><th>Name</th><th>Price</th><th>Quantity</th></tr></thead>";
            echo "<tbody>"; // Start tbody for the current order
            
            // Retrieve and store staff name for the current order
            $staff_id = $row['staff_id'];
            $staff_name_query = "SELECT staff_name FROM staff WHERE staff_id = $staff_id";
            $staff_name_result = mysqli_query($con, $staff_name_query);
            $staff_name_row = mysqli_fetch_assoc($staff_name_result);
            
            // Store order status for the current order
            $order_status = $row['order_status'];
            
            $current_order_id = $row['order_id'];
        }
?>
        <tr>
            <td><?php echo $row['name']?></td>
            <td><?php echo $row['price']?></td>
            <td><?php echo $row['qty']?></td>
        </tr>
<?php 
    }
    echo '</tbody>'; // Close tbody for the last order
    echo '</table>'; // Close the table for the last order
    // Display staff name and order status as text beneath the table for the last order
    echo "<div class='order-status'>";
    echo "<p>Staff: " . $staff_name_row['staff_name'] . "</p>";
    echo "<p>Status: " . $order_status . "</p>";
    echo "</div>";
    echo '</div>';   // Close the div for the last order
} else {
    echo "No products found.";
}

mysqli_close($con);
?>
<script src="js/script.js"></script>

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
    <link rel="stylesheet" href="css/style.css">

    <script src="../js/script.js"></script>
</head>
<body>
    <style>
    body {
        background-color: #EFEAE4;
        font-family: 'Poppins', sans-serif;
    }
    .order-container{
        width: 45%;
        margin: 0 auto;
        padding: 40px;
        border-radius: 35px;
        background-color: #fab438;
        text-align: center;
        margin-top: 50px;
    }
    h2 {
        font-size: 35px;
        font-weight: bold;
    }
    .order-status {
        width: 65%;
        margin: 0 auto;
        padding: 20px;
        border-radius: 25px;
        background-color: #EFEAE4;
        text-align: center;
        margin-top: 10px;
    }
    .center {
        margin: 0 auto;
    }

    </style>
</body>