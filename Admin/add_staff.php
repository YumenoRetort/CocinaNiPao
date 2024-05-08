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
<?php include 'admin_header.php'; ?>
<body>
    <style>
    body {
        background-color: #EFEAE4;
        font-family: 'Poppins', sans-serif;
    }
    .form-container {
        width: 35%;
        margin: 0 auto;
        padding: 40px;
        border-radius: 35px;
        background-color: #fab438;
        text-align: center;
        margin-top: 50px;
    }
    .input_fields[type="text"], .input_fields[type="password"], .btn-submit {
        width: 75%;
        border-radius: 35px;
        transition: all 0.3s;
        padding: 10px;
        box-sizing: border-box;
        margin-top: 10px;
        margin: 0 auto;
    }
    .input_fields[type="text"]:focus, .input_fields[type="password"]:focus {
        transform: scale(1.05);
        border-color: #474747;
        box-shadow: 0 0 5px rgba(250, 180, 56, 0.5);
        outline: none;
    }
    .btn-submit {
        border-radius: 35px;
        transition: all 0.3s;
        width: 75%;
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
</style>
<div class="form-container">
    <h2>Add Staff</h2>
    <form method="post" action="">
        <div class="form-group">
            <input type="text" name="staff_name" class="input_fields form-control" placeholder="Name">
        </div>
        <div class="form-group">
            <input type="text" name="email" class="input_fields form-control" placeholder="Email">
        </div>
        <div class="form-group">
            <input type="password" name="password" class="input_fields form-control" placeholder="Password">
        </div>
        <div class="form-group">
            <input type="password" name="confirm_password" class="input_fields form-control" placeholder="Confirm Password">
        </div>
        <div class="form-group">
            <input type="text" name="mobile" class="input_fields form-control" placeholder="Mobile">
        </div>
        <div class="form-group">
            <input type="submit" value="Submit" class="btn btn-submit">
        </div>
    </form>

    <?php
    include 'connect.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $staff_name = $_POST['staff_name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        $mobile = $_POST['mobile'];

        // Check if password and confirm password match
        if ($password !== $confirm_password) {
            echo "Error: Passwords do not match.";
        } else {
            $insert_query = "INSERT INTO staff (staff_name, staff_email, staff_password, staff_mobile) 
                            VALUES ('$staff_name', '$email', '$password', '$mobile')";
            
            if(mysqli_query($con, $insert_query)) {
                echo "Staff inserted successfully!";
            } else {
                echo "Error: " . mysqli_error($con);
            }
        }
    }
    ?>

</body>
</html>




