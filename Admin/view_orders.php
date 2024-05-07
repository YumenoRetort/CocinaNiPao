<?php 
include('admin_header.php');
include('connect.php');

// Retrieve staff members and order statuses from the database
$staff_query = "SELECT * FROM staff";
$staff_result = mysqli_query($con, $staff_query);

$order_statuses = array("cooking", "completed");

$query = "SELECT cart.*, order_details.order_id, order_details.order_status, order_details.staff_id
            FROM cart 
            INNER JOIN order_details ON cart.order_id = order_details.order_id 
            WHERE order_details.order_status != 'completed' OR order_details.order_status IS NULL
            ORDER BY order_details.order_id ASC, cart.cart_id ASC
"; // Order by order_id, then cart_id

$result = mysqli_query($con, $query);

if (mysqli_num_rows($result) > 0) {
    $current_order_id = null; // Initialize current order ID
    echo '<table>';
    while ($row = mysqli_fetch_assoc($result)) {
        // Check if the order ID has changed
        if ($row['order_id'] != $current_order_id) {
            // If it has changed, print the order header
            if ($current_order_id !== null) {
                // Add dropdown inputs for staff members and order statuses at the end of each order
                echo '<tr>';
                echo '<td colspan="3"></td>'; 
                echo '<td>Staff</td>'; 
                echo '<td>Status</td>'; 
                echo '</tr>';
                echo '<tr>';
                echo '<td colspan="3"></td>'; 
                echo '<td>';
                echo '<select name="staff_id[]">';
                echo '<option value="">Select Staff</option>';
                while ($staff_row = mysqli_fetch_assoc($staff_result)) {
                    echo '<option value="' . $staff_row['staff_id'] . '"';
                    // Check if staff_id is set and matches current staff_id
                    if ($current_order_staff != null && $staff_row['staff_id'] == $current_order_staff) {
                        echo ' selected';
                    }
                    echo '>' . $staff_row['staff_name'] . '</option>';
                }
                echo '</select>';
                echo '</td>';
                echo '<td>';
                echo '<select name="order_status[]">';
                echo '<option value="">Select Status</option>';
                foreach ($order_statuses as $status) {
                    // Check if the status matches the one from the database
                    $selected = ($current_order_status == $status) ? 'selected' : '';
                    echo '<option value="' . $status . '" ' . $selected . '>' . $status . '</option>';
                }
                echo '</select>';
                echo '</td>';
                echo '</tr>';
                echo '</tbody>';
                // Add submit button for the current order
                echo '<tr><td colspan="5"><button type="submit" name="update_order">Update Order</button></td></tr>';
                echo '</table>';
                echo '<input type="hidden" name="order_id[]" value="' . $current_order_id . '">'; 
                echo '</form>';
            }
            echo "<h2>Order " . $row['order_id'] . ":</h2>";
            // Start form for the current order
            echo '<form method="POST" action="update_orders.php">';
            echo "<table>"; // Start a new table for the current order
            echo "<thead><tr><th>Name</th><th>Price</th><th>Quantity</th></tr></thead>";
            echo "<tbody>";
            $current_order_id = $row['order_id'];
            $current_order_status = $row['order_status']; // Set current order status
            $current_order_staff = $row['staff_id']; // Set current order staff
        }
?>
        <tr>
            <td><?php echo $row['name']?></td>
            <td><?php echo $row['price']?></td>
            <td><?php echo $row['qty']?></td>
        </tr>
<?php 
    }
    // Add dropdown inputs for staff members and order statuses at the end of the last order
    echo '<tr>';
    echo '<td colspan="3"></td>'; // Adjust colspan to match the number of columns before buttons
    echo '<td>Staff</td>'; // Header for staff
    echo '<td>Status</td>'; // Header for status
    echo '</tr>';
    echo '<tr>';
    echo '<td colspan="3"></td>'; // Adjust colspan to match the number of columns before buttons
    echo '<td>';
    echo '<select name="staff_id[]">';
    echo '<option value="">Select Staff</option>';
    mysqli_data_seek($staff_result, 0); // Reset the pointer to the beginning of the result set
    while ($staff_row = mysqli_fetch_assoc($staff_result)) {
        echo '<option value="' . $staff_row['staff_id'] . '"';
        // Check if staff_id is set and matches current staff_id
        if ($current_order_staff != null && $staff_row['staff_id'] == $current_order_staff) {
            echo ' selected';
        }
        echo '>' . $staff_row['staff_name'] . '</option>';
    }
    echo '</select>';
    echo '</td>';
    echo '<td>';
    echo '<select name="order_status[]">';
    echo '<option value="">Select Status</option>';
    foreach ($order_statuses as $status) {
        // Check if the status matches the one from the database
        $selected = ($current_order_status == $status) ? 'selected' : '';
        echo '<option value="' . $status . '" ' . $selected . '>' . $status . '</option>';
    }
    echo '</select>';
    echo '</td>';
    echo '</tr>';
    echo '</tbody>'; // Close tbody for the last order
    // Add submit button for the last order
    echo '<tr><td colspan="5"><button type="submit" name="update_order">Update Order</button></td></tr>';
    echo '<input type="hidden" name="order_id[]" value="' . $current_order_id . '">'; // Hidden input field for order_id
    echo '</table>'; // Close the table for the last order
    echo '</form>'; // Close form for the last order
} else {
    echo "No products found.";
}

mysqli_close($con);
?>
<script src="js/script.js"></script>
