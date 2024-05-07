<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <title>Cocina ni Pao | Login</title>

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
            margin-right: -60px;
            padding-bottom: 225px;
            padding-left: 200px;
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
            margin-top: 75px;
            position: relative;
            padding-right: 80px;
        }

        input[type="password"] {
            width: 100%;
            padding-left: 25px;
            padding-right: 100px;
            padding-top: 10px;
            padding-bottom: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-family: "Poppins", sans-serif;
        }

        input[type="text"] {
            width: 100%;
            margin-bottom: 10px;
            padding-left: 25px;
            padding-right: 100px;
            padding-top: 10px;
            padding-bottom: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-family: "Poppins", sans-serif;
        }

        input[type="submit"] {
            background-color: #f03838;
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
            background-color: #f03838
        }

        h1 {
            margin-left: 15px;
            font-size: 75px;
        }

        .signup-btn {
            color: #999b85;
            background-color: transparent;
            border: 2px solid #999b85;
            border-radius: 25px;
            width: 100%;
            font-family: "Poppins", sans-serif;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .signup-btn:hover {
            background-color: #999b85;
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
                <h1>Log into your<br> account</h1>
            </div>
            <div class="col-md-6 d-flex justify-content-center align-items-center">
                <div class="container-custom">
                    <form method="post" action="">
                        <h2>Login</h2>
                        <br>
                        <div class="form-group">
                            <input type="text" class="form-control" name="email" placeholder="Email">
                        </div>
                        <div class="form-group">
                        <input type="password" class="form-control" name="password" placeholder="Password">
                        </div>
                        <br>
                        <input type="submit" class="btn btn-primary" value="Login">
                        <br><br>
                        <center><div class="line"><span>Or</span></div></center>
                        <br>
                        <button type="button" class="btn signup-btn" href="login.php">Sign Up</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php
    include 'Admin/connect.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $query = "SELECT * FROM customer WHERE email='$email' AND password='$password'";
        $result = mysqli_query($con, $query);
        $row = mysqli_fetch_array($result);
            $_SESSION["uid"] = $row["customer_id"];
            $_SESSIOn["name"] = $row["customer_name"];


        if (mysqli_num_rows($result) == 1) {
            //user redirect
            header("Location: index.php");
            exit();
        } else {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $query = "SELECT * FROM staff WHERE staff_email='$email' AND staff_password='$password'";
            $result = mysqli_query($con, $query);
                $row = mysqli_fetch_array($result);
                $_SESSION["uid"] = $row["staff_id"];
                $_SESSIOn["name"] = $row["staff_name"];

            if (mysqli_num_rows($result) == 1) {
                //user redirect
                header("Location: Admin/admin_homepage.php");
                exit();
            }
            else{
                echo "Invalid email or password. Please try again.";
            }
        }
    }
    ?>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>