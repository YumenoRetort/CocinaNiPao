
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Cocina ni Pao</title>

	<link rel = "stylesheet" href="css/style.css">
</head>
<body>

    <form method="post" action="">
        Name: <input type="text" name="customer_name"><br>
        Email: <input type="text" name="email"><br>
        Password: <input type="password" name="password"><br>
        Confirm Password: <input type="password" name="confirm_password"><br>
        Mobile: <input type="text" name="mobile"><br>
        Address: <input type="text" name="address"><br>
        <input type="submit" value="Submit">
    </form>

    <?php
    include 'connect.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $customer_name = $_POST['customer_name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        $mobile = $_POST['mobile'];
        $address = $_POST['address'];

        // Check if password and confirm password match
        if ($password !== $confirm_password) {
            echo "Error: Passwords do not match.";
        } else {
            $insert_query = "INSERT INTO customer (customer_name, email, password, mobile, address) 
                            VALUES ('$customer_name', '$email', '$password', '$mobile', '$address')";
            
            if(mysqli_query($con, $insert_query)) {
                echo "Customer inserted successfully!";
            } else {
                echo "Error: " . mysqli_error($con);
            }
        }
    }
    ?>

	<script src="js/script.js"></script>
	
</body>
</html>


