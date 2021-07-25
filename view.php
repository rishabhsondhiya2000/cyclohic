<?php
require("conn.php");
session_start();
session_destroy();
$per_page = 2;
$record = mysqli_num_rows(mysqli_query($conn, "select * from all_cycle"));
$pagi = ceil($record / $per_page);


?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>VIEW CYCLES -CYCLOHIC</title>
  <link rel="stylesheet" href="css/view8.css">
  <link rel="stylesheet" href="css/layout8.css">
  <link rel="shortcut icon" href="favicon.jpg" type="image/x-icon">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500&family=Roboto:wght@500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="js/layout2.js"></script>
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


  <div class="contain">
    <div class="sold_no">
      <?php
      $sql1 = "SELECT * FROM sold_cycle";
      $res = mysqli_query($conn, $sql1);
      echo "<h2> NUMBER OF CYCLES SOLD : " . mysqli_num_rows($res) . " !!</h2>";
      ?>
    </div>
    <div class="search">
      <input type="text" id="myinput" name="search" placeholder="&#x1F50D; Search by Name" onkeyup="search()">
    </div>
    <h1 class="title">CYCLE'S DETAILS:-</h1>
    <div class="content">
      <div id="box">
        <h4>LOADING...</h4>
      </div>
      <div id="pages">
        <?php
        for ($i = 1; $i <= $pagi; $i++) {
          echo "<b><button id='page" . $i . "' class='page_no' onclick='load_data($i)'>" . $i . "</button><b>";
        }
        ?>
      </div>

    </div>
  </div>

  <?php
  mysqli_close($conn);
  ?>

</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
  function search() {
    let filter = document.getElementById('myinput').value.toUpperCase();
    let div = document.getElementsByClassName('div');
    for (var i = 0; i < div.length; i++) {
      let name = div[i].getElementsByTagName('span');
      if (name[1].textContent.indexOf(filter) > -1) {
        div[i].style.display = '';
      } else {
        div[i].style.display = 'none';
      }
    }
  }

  const load_data = (num) => {
    $(".page_no").removeClass("active_page");
    $("#page" + num).addClass("active_page");
    jQuery.ajax({
      url: "pagination.php",
      data: "num=" + num,
      type: "post",
      success: (res) => {
        res = JSON.parse(res);
        jQuery("#box").html(res.html);
        $(function() {
          $(".mydiv").accordion({
            collapsible: true,
            event: "click",
            animate: 500,
            active: "1",
            heightStyle: false,
          });
        });
      }
    });
  };
  load_data(1);

  var title = document.title;
  var split_title = title.split(" ");
  console.log(split_title[0]);
  var m_split_title = split_title[0].toLowerCase();
  $("#" + split_title[0]).addClass("active");
  $("#" + m_split_title).addClass("active");
</script>

</html>