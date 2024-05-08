<?php include 'admin_header.php';
include 'connect.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages</title>
    <style>
    .major_container {
      width: 50%;
      float: left;
    }
    </style>
</head>
<body>

  <div id="left_container" class="major_container">
    <h2>Customers</h2>
    <div id="user_container">
    </div>

    <form method="post" class="form-selection">
      <select name="select_user" class="select_user">'; <!--Shows the itineraries to select from for editing-->
      echo '<option value="">Select User</option>
        <?php
        $get_customers = "SELECT customer_name, customer_id FROM customer";
        $customer_result = mysqli_query($con, $get_customers);

        if(!$customer_result){

        } else{
          while($row = mysqli_fetch_assoc($customer_result)) {
            $easyName = $row['customer_name']; //Adds each select option
            $easyId = $row['customer_id'];
            echo '<option value="' .$easyId . '">' . $easyName . '</option>';
          }
        }
        ?>
        </select>
      <input type="submit" value = "Message" name="user_button">
    </form>
    <?php
    if(isset($_POST["user_button"])){
      if(($_POST["select_user"] ?? null)) {
        $_SESSION['customer_message_id'] = $_POST["select_user"];
      } else {
        echo "Select valid User";
      }
    }
    ?>

  </div>

  <div id="right_container" class="major_container">
    <h2 id="current_customer">Messages</h2>
    <div style="height:400px; overflow:scroll;" id="previous_messages"><!--This is where previous messages will show up-->
    </div>
    <div style="position: relative;"><!--This is where new messages will post from-->
      <form method="POST">
        <textarea name="message" rows="4" cols="40" placeholder="Type your message here"></textarea><br>
        <input type="submit" value="Send Message" name="message_button">
      </form>
    </div>
  </div>

  <?php
  if(isset($_POST["message_button"])){
    if(($_POST["message"] ?? null)) {
      $message = $_POST["message"];
      $customer_message_id = $_SESSION['customer_message_id'];
      $addIntineraryName = "INSERT INTO messages (customer_id, staff_id, message_content, from_who)
      VALUES ('$customer_message_id', 1, '$message', 'Staff')";
      mysqli_query($con, $addIntineraryName);

      echo "<script>var containerToShow = document.getElementById('message_container');
          containerToShow.style.display = 'block';</script>";
    }
  }

    $customer_message_id = $_SESSION['customer_message_id'];
    $get_old_message = "SELECT messages.message_content, messages.from_who, customer.customer_name
     FROM messages LEFT JOIN customer ON messages.customer_id = customer.customer_id
    WHERE messages.customer_id = '$customer_message_id' ORDER BY message_id ASC";
    $result = mysqli_query($con, $get_old_message);
    if (!$result){
      echo "Error: " . mysqli_error($con);
    }
  while ($row = mysqli_fetch_array($result)) {
    if ($row['from_who'] == "Customer"){
      echo "<script>
      var component = document.createElement('div');

      // Set the content of the component using the provided data
      component.innerHTML = `
          <h4>From: {$row['customer_name']}</h4>
          <p>{$row['message_content']}<br>
          --------------------------------</p>
      `;
      // Append the new component to the container
      document.getElementById('previous_messages').appendChild(component);

      </script>";

    } else {
      echo "<script>
      var component = document.createElement('div');

      // Set the content of the component using the provided data
      component.innerHTML = `
          <h4>From: You</h4>
          <p>{$row['message_content']}<br>
          --------------------------------</p>
      `;
      // Append the new component to the container
      document.getElementById('previous_messages').appendChild(component);

      </script>";
    }
  }

  if ($_SESSION['customer_message_id']!=null){
    $customer_message_id = $_SESSION['customer_message_id'];
    $get_messaging_name = "SELECT customer_name FROM customer WHERE customer_id = '$customer_message_id'";
    $get_name = mysqli_query($con, $get_messaging_name);
    while($row = mysqli_fetch_array($get_name)){
      $_SESSION['customer_message_name'] = $row['customer_name'];
    }

  }

  $get_customers = "SELECT customer_name, customer_id FROM customer";
  $customer_result = mysqli_query($con, $get_customers);

  while ($row = mysqli_fetch_assoc($customer_result)) {

    echo "<script>
    var component = document.createElement('div');

    // Set the content of the component using the provided data
    component.innerHTML = `
        <h4>{$row['customer_name']}</h4>
    `;
    // Append the new component to the container
    document.getElementById('user_container').appendChild(component);

    </script>";
  }

  ?>

  <script>
  //Shows itinerary currently being edited
  var showCurrentItinEdit = document.getElementById('current_customer');
  showCurrentItinEdit.innerHTML = "<?php echo $_SESSION['customer_message_name'];?>'s Messages";

  var container = document.getElementById("previous_messages");
  // Scroll to the bottom when the content is loaded
  window.onload = function() {
    container.scrollTop = container.scrollHeight;
  };

  </script>

</body>
</html>
