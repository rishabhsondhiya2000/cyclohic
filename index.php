<?php
session_start();
session_destroy();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>HOME -CYCLOHIC</title>
  <link rel="shortcut icon" href="favicon.jpg" type="image/x-icon">
  <link rel="stylesheet" href="css/index4.css">
  <link rel="stylesheet" href="css/layout8.css">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500&family=Roboto:wght@500&display=swap" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

</head>

<body>
  <div id="mob_nav" class="mobile_nav">
    <h2 class="menu_head">Menu</h2>
    <ul>
      <li><a id="home" href="index.php">Home</a></li>

      <li><a id="add" href="add_1.php">Add Items</a></li>

      <li><a id="view" href="view.php">View Items</a></li>

      <li><a id="contact" href="contact.php">Contact Us</a></li>

      <li><a id="rate" href="rateus.php">Rate Us</a></li>
    </ul>
  </div>
  <div id="nav" class="navigation">
    <div id="main" class="nav-bar">

      <div class="logo">
        <a href="index.php"><img src="images/logo.jpg" alt="LOGO"></a>
      </div>

      <div class="menu">
        <a id="ADD" href="add_1.php">Add Item</a>
        <a id="VIEW" href="view.php">View Item</a>
        <a id="CONTACT" href="contact.php">Contact us</a>
        <a id="RATE" href="rateus.php">Rate us</a>
      </div>
    </div>


    <div class="burger">
      <button onclick="open_nav()">
        <h2>&#9776;</h2>
      </button>
    </div>

  </div>


  <div class="aboutus">
    <div class="heading">
      <h1 class="title">Welcome to <span>CYCLOHIC !</span></h1>
    </div>
    <div class="content">
      <p>This is a place where you can find a suitable bicycle as per your budget and desires.
        Here, students who are willing to sell their bicycle sumbit their items details, price and
        their contact details so that the concern one can contact them.
       </p>
    </div>

  </div>

  <footer class="footer">
    <p>&COPY; ALL RIGHT RESERVED</p>
  </footer>

</body>
<script src="js/layout2.js"></script>
<script>
  var title = document.title;
  var split_title = title.split(" ");
  console.log(split_title[0]);
  var m_split_title = split_title[0].toLowerCase();
  $("#" + split_title[0]).addClass("active");
  $("#" + m_split_title).addClass("active");
</script>

</html>