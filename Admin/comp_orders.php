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
    echo '<table>';
    while ($row = mysqli_fetch_assoc($result)) {
        // Check if the order ID has changed
        if ($row['order_id'] != $current_order_id) {
            // If it has changed, print the order header
            if ($current_order_id !== null) {
                echo '</tbody>'; // Close tbody for the current order
                echo '</table>'; // Close the table for the current order
            }
            echo "<h2>Order " . $row['order_id'] . ":</h2>";
            // Start table for the current order
            echo "<table>"; 
            echo "<thead><tr><th>Name</th><th>Price</th><th>Quantity</th></tr></thead>";
            echo "<tbody>"; // Start tbody for the current order
            // Display staff name from the staff table
            echo '<tr>';
            echo '<td colspan="3"></td>'; // Adjust colspan to match the number of columns before text
            echo '<td>Staff: ';
            // Retrieve staff name from the staff table based on staff_id
            $staff_id = $row['staff_id'];
            $staff_name_query = "SELECT staff_name FROM staff WHERE staff_id = $staff_id";
            $staff_name_result = mysqli_query($con, $staff_name_query);
            $staff_name_row = mysqli_fetch_assoc($staff_name_result);
            echo $staff_name_row['staff_name'];
            echo '</td>'; 
            echo '<td>Status: ';
            echo $row['order_status']; // Display status as text
            echo '</td>';
            echo '</tr>';
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
} else {
    echo "No products found.";
}

mysqli_close($con);
?>
<script src="js/script.js"></script>
