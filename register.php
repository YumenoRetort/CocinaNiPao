<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <title>Cocina ni Pao | Register</title>

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #fab438;
            margin: 0;
            padding: 0;
            font-family: "Poppins", sans-serif;
        }

        .container-custom {
            background-color: #efeae4;
            border-top-left-radius: 50px;
            border-bottom-left-radius: 50px;
            padding: 80px;
            margin-right: -15px;
        }

        .left-side {
            padding: 50px;
            box-sizing: border-box;
        }

        img {
            max-width: 25%;
            height: auto;
            display: block;
        }

        form {
            margin-top: 20px;
            padding-top: 38px;
            padding-right: 100px;
            padding-left: 40px;
            position: relative;
        }

        input[type="password"] {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-family: "Poppins", sans-serif;
        }

        input[type="text"] {
            width: 100%;
            margin-bottom: 10px;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-family: "Poppins", sans-serif;
        }

        input[type="submit"] {
            background-color: #999b85;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 25px;
            cursor: pointer;
            width: 100%;
            font-family: "Poppins", sans-serif;
            transition: transform 0.3s ease;
        }

        input[type="submit"]:hover {
            transform: scale(1.1);
            background-color: #999b85
        }

        h1 {
            margin-left: 15px;
            font-size: 75px;
        }

        .login-btn {
            color: #f03838;
            background-color: transparent;
            border: 2px solid #f03838;
            border-radius: 25px;
            width: 100%;
            font-family: "Poppins", sans-serif;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .login-btn:hover {
            background-color: #f03838;
            color: white; 
            border-color: transparent;
        }

        .line {
            border-bottom: 1px solid black;
            width: 50%;
            text-align: center;
            line-height: 0.1em;
            margin: 10px 0 20px;
        }

        .line span {
            background-color: #efeae4;
            padding: 0 10px;
        }
    </style>
</head>
<body>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 left-side">
                <img src="images/logohome.png" alt="Landscape Image">
                <br>
                <h1>Create your <br> account</h1>
            </div>
            <div class="col-md-6 d-flex justify-content-center align-items-center">
                <div class="container-custom">
                    <form method="post" action="">
                        <h2>Create Account</h2>
                        <br>
                        <div class="form-group">
                            <input type="text" class="form-control" name="customer_name" placeholder="Name">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="email" placeholder="Email">
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <input type="password" class="form-control" name="password" placeholder="Password">
                            </div>
                            <div class="form-group col-md-6">
                                <input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password">
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="mobile" placeholder="Mobile">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="address" placeholder="Address">
                        </div>
                        <br>
                        <input type="submit" class="btn btn-primary" value="Sign Up">
                        <br><br>
                        <center><div class="line"><span>Or</span></div></center>
                        <br>
                        <a type="button" class="btn login-btn" href="login.php">Login</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php
    include 'Admin/connect.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $customer_name = $_POST['customer_name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        $mobile = $_POST['mobile'];
        $address = $_POST['address'];

        // Check if any field is empty
        if (empty($customer_name) || empty($email) || empty($password) || empty($confirm_password) || empty($mobile) || empty($address)) {
            echo "<script>alert('Please fill in all fields.');</script>";
        } else {
            // Check if password and confirm password match
            if ($password !== $confirm_password) {
                echo "<script>alert('Error: Passwords do not match.');</script>";
            } else {
                $insert_query = "INSERT INTO customer (customer_name, email, password, mobile, address) 
                                VALUES ('$customer_name', '$email', '$password', '$mobile', '$address')";
                
                if(mysqli_query($con, $insert_query)) {
                    echo "<script>alert('Registration successful!'); window.location='login.php';</script>";
                } else {
                    echo "Error: " . mysqli_error($con);
                }
                
            }
        }
    }
    ?>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        // Client-side form validation
        document.querySelector('form').addEventListener('submit', function(event) {
            const inputs = this.querySelectorAll('input[type="text"], input[type="password"]');
            let isValid = true;

            inputs.forEach(function(input) {
                if (!input.value.trim()) {
                    isValid = false;
                    input.classList.add('is-invalid');
                } else {
                    input.classList.remove('is-invalid');
                }
            });

            if (!isValid) {
                event.preventDefault();
                return false;
            }
        });
    </script>
</body>
</html>
