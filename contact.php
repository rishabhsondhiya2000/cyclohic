<?php
session_start();
session_destroy();
?>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CONTACT US-CYCLOHIC</title>
  <link rel="shortcut icon" href="favicon.jpg" type="image/x-icon">
  <link rel="stylesheet" href="css/layout8.css">
  <link rel="stylesheet" href="css/contact2.css">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500&family=Roboto:wght@500&display=swap" rel="stylesheet">
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


  <div class="details">
    <h1>CONTACT DETAILS:-</h1> <br><br>
    <h2>
      <span>Email:</span> rishabhsondhiya2000@gmail.com <br>
      <br><span>Contact No:</span> 6264727962 <br> <br>
      <span>Room No.</span>68,Vishwakarma Hostel, <br> <br>
      IIT (BHU) Varanasi,UP,India. <br> <br>
    </h2> <br>

  </div>

  <footer class="footer">
    <p>&COPY; ALL RIGHT RESERVED</p>
  </footer>

</body>
<script src="js/layout2.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
  var title = document.title;
  var split_title = title.split(" ");
  console.log(split_title[0]);
  var m_split_title= split_title[0].toLowerCase();
  $("#" + split_title[0]).addClass("active");
  $("#" + m_split_title).addClass("active");
</script>

</html>