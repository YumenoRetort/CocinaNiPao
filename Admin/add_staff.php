<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>
    <link rel="stylesheet" href="css/style.css">

    <script src="../js/script.js"></script>
</head>
<body>

    <?php include 'admin_header.php'; ?>

    <h2>Add Staff</h2>
    <form method="post" action="">
        Name: <input type="text" name="staff_name"><br>
        Email: <input type="text" name="email"><br>
        Password: <input type="password" name="password"><br>
        Confirm Password: <input type="password" name="confirm_password"><br>
        Mobile: <input type="text" name="mobile"><br>
        <input type="submit" value="Submit">
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




