<?php
include('connect.php');

if(isset($_POST['update_order'])) {
    $staff_ids = $_POST['staff_id'];
    $order_statuses = $_POST['order_status'];
    $delivery_dates = $_POST['delivery_date']; // Retrieve delivery_dates from the form
    $order_ids = $_POST['order_id']; // Retrieve order_ids from the form
    
    // Loop through staff_ids, order_statuses, delivery_dates, and order_ids arrays simultaneously
    foreach(array_map(null, $staff_ids, $order_statuses, $delivery_dates, $order_ids) as list($staff_id, $status, $delivery_date, $order_id)) {
        $update_query = "UPDATE order_details SET staff_id = ?, order_status = ? WHERE order_id = ?";
        $stmt = mysqli_prepare($con, $update_query);
        mysqli_stmt_bind_param($stmt, "iss", $staff_id, $status, $order_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        
        // Check if shipment exists for the order
        $shipment_query = "SELECT * FROM shipments WHERE order_id = ?";
        $stmt = mysqli_prepare($con, $shipment_query);
        mysqli_stmt_bind_param($stmt, "i", $order_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        
        // If shipment exists, update delivery_date, otherwise insert a new row
        if(mysqli_num_rows($result) > 0) {
            $update_shipment_query = "UPDATE shipments SET delivery_date = ? WHERE order_id = ?";
            $stmt = mysqli_prepare($con, $update_shipment_query);
            mysqli_stmt_bind_param($stmt, "si", $delivery_date, $order_id);
            mysqli_stmt_execute($stmt);
        } else {
            $insert_shipment_query = "INSERT INTO shipments (order_id, delivery_date) VALUES (?, ?)";
            $stmt = mysqli_prepare($con, $insert_shipment_query);
            mysqli_stmt_bind_param($stmt, "is", $order_id, $delivery_date);
            mysqli_stmt_execute($stmt);
        }
        mysqli_stmt_close($stmt);
    }
    
    mysqli_close($con);
    
    // Redirect back to the page where the form was submitted from
    header("Location: ".$_SERVER['HTTP_REFERER']);
    exit();
} else {
    // If the form was not submitted properly, redirect back to the page where the form was submitted from
    header("Location: ".$_SERVER['HTTP_REFERER']);
    exit();
}

?>
