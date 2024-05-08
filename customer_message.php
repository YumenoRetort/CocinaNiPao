<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Floating Div</title>
    <style>


    .floating-div {
    position: fixed;
    top: 20px; /* Adjust as needed */
    right: 20px; /* Adjust as needed */
    z-index: 999; /* Ensure it appears above other content */
    background-color: #ffffff;
    border: 1px solid #cccccc;
    padding: 10px;
    border-radius: 5px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); /* Optional: Add shadow for better visibility */
    color:powderblue;
  }

    </style>
</head>
<body>

  <div class="floating-div">
    <div onclick="showContainer('message_container')">
      <h2>Messages</h2>
    </div>

    <div id="message_container" style="display:none;">
      <div style="height:200px; overflow:scroll;" id="previous_messages"><!--This is where previous messages will show up-->
      </div>

      <div style="position: relative;"><!--This is where new messages will post from-->
        <form method="POST">
          <textarea name="message" rows="4" cols="40" placeholder="Type your message here"></textarea><br>
          <input type="submit" value="Send Message" name="message_button">
        </form>
      </div>
    </div>
  </div>
  <?php
  if(isset($_POST["message_button"])){
    if(($_POST["message"] ?? null)) {
      $message = $_POST["message"];
      $uid = $_SESSION['uid'];
      $addIntineraryName = "INSERT INTO messages (customer_id, staff_id, message_content, from_who)
      VALUES ('$uid', 1, '$message', 'Customer')";
      mysqli_query($con, $addIntineraryName);

      echo "<script>var containerToShow = document.getElementById('message_container');
          containerToShow.style.display = 'block';</script>";
    }
  }

  $uid = $_SESSION['uid'];
  $get_old_message = "SELECT message_content, from_who FROM messages WHERE customer_id = '$uid' ORDER BY message_id ASC";
  $result = mysqli_query($con, $get_old_message);

  while ($row = mysqli_fetch_array($result)) {
    echo "<script>
    var component = document.createElement('div');

    // Set the content of the component using the provided data
    component.innerHTML = `
        <h4>From: {$row['from_who']}</h4>
        <p>{$row['message_content']}<br>
        --------------------------------</p>
    `;
    // Append the new component to the container
    document.getElementById('previous_messages').appendChild(component);



    </script>";
  }
  ?>
  <script>
    function showContainer(containerId) {
        // Hide all containers
        var containerToShow = document.getElementById(containerId);
        if (containerToShow.style.display === "none") {
            containerToShow.style.display = "block";
        } else {
            containerToShow.style.display = "none";
        }
    }

    var container = document.getElementById("previous_messages");
    // Scroll to the bottom when the content is loaded
    window.onload = function() {
      container.scrollTop = container.scrollHeight;
    };
  </script>

</body>
</html>
