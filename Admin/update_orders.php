<?php
include('connect.php');

if(isset($_POST['update_order'])) {
    $staff_ids = $_POST['staff_id'];
    $order_statuses = $_POST['order_status'];
    $order_ids = $_POST['order_id']; // Retrieve order_ids from the form
    
    // Loop through staff_ids, order_statuses, and order_ids arrays simultaneously
    foreach(array_map(null, $staff_ids, $order_statuses, $order_ids) as list($staff_id, $status, $order_id)) {
        // Prepare and execute the query to update order_details table
        $update_query = "UPDATE order_details SET staff_id = ?, order_status = ? WHERE order_id = ?";
        $stmt = mysqli_prepare($con, $update_query);
        mysqli_stmt_bind_param($stmt, "iss", $staff_id, $status, $order_id);
        mysqli_stmt_execute($stmt);
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
