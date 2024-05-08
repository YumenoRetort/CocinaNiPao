<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>

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

      .carousel-item img {
        max-height: 250px; /* Adjust the height as needed */
        object-fit: cover;
        display: block;
        margin: auto; /* Center the image */
      }

      .carousel-inner {
        width: 1000px; /* Set carousel width to 100% */
        border-radius: 15px;
      }

      body {
        background-image: url('images/bg.png');
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed;
      }

      .typog-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-top: 20px;
      }

      .typog-container img {
        max-width: 50%;
        max-height: 20%;
		margin-right: 500px;
      }

      .typog-container p {
        font-size: 20px;
        text-align: left;
        color: #474747;
		margin-right: 682px;
      }

      .typog-container a {
        margin-top: 20px;
      }
      
      .rect-button {
		position: absolute;
		bottom: 70px;
		right: 100px;
		color: #efeae3;
		background-color: #999B84;
		border-radius: 25px;
		border: 0; 
		padding: 8px 30px;
		width: 180px;
		height: 60px;
		text-align: center;
		line-height: 40px;
		transition: background-color 0.3s;
	  }

	   .rect-button:hover,
	   .rect-button:active {
			background-color: #474747;
			color: white;
		}


    </style>

</head>

<?php
include('header.php');
?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/script.js"></script>

<body>
  <div class="rect">
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-indicators" >
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="images/crsl.png" class="d-block w-100" alt="p1">
        </div>
        <div class="carousel-item">
          <img src="images/crsl2.png" class="d-block w-100" alt="p2">
        </div>
        <div class="carousel-item">
          <img src="images/crsl3.png" class="d-block w-100" alt="p2">
        </div>
      </div>
    </div>

    <div class="typog-container">
      <img src="images/CocinaLokal.png" alt="Typog">
      <p>Crafting Local Flavors, <br> Bringing Communities Together</p>
      <a class="nav-link btn-primary rect-button" href="order.php">Order Now</a>
    </div>


  </div>
</body>
</html>
