<?php
include 'connect.php';

// SQL query to insert shipments for orders that don't have one
$sql = "
    INSERT INTO shipments (order_id, delivery_date)
    SELECT o.order_id, CURDATE()
    FROM `order_details` o
    LEFT JOIN shipments s ON o.order_id = s.order_id
    WHERE s.shipment_id IS NULL;
";

// Execute SQL query
if ($con->query($sql) === TRUE) {
} else {
    echo "Error creating shipments: " . $con->error;
}

// Close connection
$con->close();
?>
