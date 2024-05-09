<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <style>

    body {
      background-color: #EFEAE4;
      font-family: 'Poppins', sans-serif;
    }
    h2 {
      font-size: 35px;
      font-weight: bold;
    }

      .rect {
        position: relative;
        width: 75%;
        height: 40%;
        background-color: #FAB438;
        border-radius: 25px;
        margin: 45px auto;
        padding: 40px; /* Adjust the space for the card */
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
      }
      </style>
    </head>
    <body>

<?php
include('admin_header.php');
include('create_shipment.php');
include('connect.php');

// Retrieve staff members and order statuses from the database
$staff_query = "SELECT * FROM staff";
$staff_result = mysqli_query($con, $staff_query);

$order_statuses = array("cooking", "completed");

$query = "SELECT cart.*, order_details.order_id, order_details.order_status, order_details.staff_id, shipments.delivery_date
            FROM cart
            INNER JOIN order_details ON cart.order_id = order_details.order_id
            LEFT JOIN shipments ON order_details.order_id = shipments.order_id
            WHERE order_details.order_status != 'completed' OR order_details.order_status IS NULL
            ORDER BY order_details.order_id ASC, cart.cart_id ASC
";

$result = mysqli_query($con, $query);

if (mysqli_num_rows($result) > 0) {
    $current_order_id = null;
    $current_order_staff = null;
    $current_delivery_date = null;

    echo '<div class="rect">';
    echo '<table>';

    echo '<form method="POST" action="update_orders.php">';

    while ($row = mysqli_fetch_assoc($result)) {

        if ($row['order_id'] != $current_order_id) {
            if ($current_order_id !== null) {
                echo '<tr>';
                echo '<td colspan="3"></td>';
                echo '<td>Staff</td>';
                echo '<td>Status</td>';
                echo '<td>Delivery Date</td>'; // Added Delivery Date column
                echo '</tr>';
                echo '<tr>';
                echo '<td colspan="3"></td>';
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
                echo '<td><input type="date" name="delivery_date[]" id="delivery_date" value="' . $current_delivery_date . '" min="' . date('Y-m-d') . '"></td>'; // Input field for Delivery Date
                echo '</tr>';
                echo '</tbody>';

                echo '<tr><td colspan="5"><button type="submit" name="update_order">Update Order</button></td></tr>';
                echo '</table>';
                echo '<input type="hidden" name="order_id[]" value="' . $current_order_id . '">';
                echo '</form>';
            }
            echo "<h2>Order " . $row['order_id'] . ":</h2>";
            // Start form for the current order
            echo '<table>';
            echo "<thead><tr><th>Name</th><th>Price</th><th>Quantity</th></tr></thead>";
            echo "<tbody>";
            $current_order_id = $row['order_id'];
            $current_order_status = $row['order_status'];
            $current_order_staff = $row['staff_id'];
            $current_delivery_date = $row['delivery_date'];
        }
?>
        <tr>
            <td><?php echo $row['name']?></td>
            <td><?php echo $row['price']?></td>
            <td><?php echo $row['qty']?></td>
        </tr>
<?php
    }
    // After the loop ends, include the last set of form elements
    echo '<tr>';
    echo '<td colspan="3"></td>';
    echo '<td>Staff</td>';
    echo '<td>Status</td>';
    echo '<td>Delivery Date</td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td colspan="3"></td>';
    echo '<td>';
    echo '<select name="staff_id[]">';
    echo '<option value="">Select Staff</option>';
    mysqli_data_seek($staff_result, 0);
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
    echo '<td><input type="date" name="delivery_date[]" id="delivery_date" value="' . $current_delivery_date . '" min="' . date('Y-m-d') . '"></td>'; // Input field for Delivery Date
    echo '</tr>';
    echo '</tbody>';
    echo '</table>';
    echo '</div>';
}
?>
<script>
    // Get the input element for delivery date
    var deliveryDateInput = document.getElementById('delivery_date');

    // Set the minimum date to today
    deliveryDateInput.min = new Date().toISOString().split("T")[0];
</script>
</body>
</html>
