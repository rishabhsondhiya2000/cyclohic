<?php
require("conn.php");
$email = "";
$id="";
if (isset($_GET["id"])) {
  $id = $_GET["id"];
  $res = mysqli_query($conn, "select EMAIL_ID from all_cycle where id='$id'");
  if (mysqli_num_rows($res) == 1) {
    $row = mysqli_fetch_assoc($res);
    $emailid = $row["EMAIL_ID"];
  }
  else{
    header("location:view.php");
  }
}
else{
  header("location:view.php");
}

?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DELTETE-CYCLOHIC</title>
  <link rel="shortcut icon" href="favicon.jpg" type="image/x-icon">
  <link rel="stylesheet" href="css/delete7.css">
  <link rel="stylesheet" href="css/layout8.css">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500&family=Roboto:wght@500&display=swap" rel="stylesheet">
  <script src="js/layout2.js"></script>
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
  <div id="mob_nav" class="mobile_nav">
    <h2 class="menu_head">Menu</h2>
    <ul>
      <li><a id="HOME" href="index.php">Home</a></li>

      <li><a id="ADD" href="add_1.php">Add Items</a></li>

      <li><a id="VIEW" href="view.php">View Items</a></li>

      <li><a id="CONTACT" href="contact.php">Contact Us</a></li>

      <li><a id="RATE" href="rateus.php">Rate Us</a></li>
    </ul>
  </div>
  <div id="nav" class="navigation">
    <div id="main" class="nav-bar">

      <div class="logo">
        <a href="index.php"><img src="images/logo.jpg" alt="LOGO"></a>
      </div>

      <div class="menu">
        <a href="add_1.php">Add Item</a>
        <a href="view.php">View Item</a>
        <a href="contact.php">Contact us</a>
        <a href="rateus.php">Rate us</a>
      </div>
    </div>


    <div class="burger">
      <button onclick="open_nav()">
        <h2>&#9776;</h2>
      </button>
    </div>

  </div>



  <div class="box">
    <div class="left">

      <h2 class="title">ENTER EMAIL ID & PASSWORD !!</h2>
      <form class="form" action="" method="POST">
        <input type="email" name="email" value='<?php echo $emailid; ?>' readonly>
        <input type="password" name="password" placeholder="Enter Password" required minlength="5">
        <button class="show" id="showPass" type="button" onclick="show()"><i class="far fa-eye"></i></button>
        <a href="forgetPass.php?id=<?php echo $id; ?>" style="color: white;">forget password?</a>
        <button name="done" class="btn">DONE</button>
      </form>
    </div>

    <div class="right">
      <?php
      if (isset($_REQUEST["done"])) {

        $password = $_REQUEST['password'];
        $sql1 = "SELECT * FROM all_cycle WHERE EMAIL_ID='$emailid'";
        $result = mysqli_query($conn, $sql1);
        $count = mysqli_num_rows($result);
        if ($count) {
          $email_password = mysqli_fetch_assoc($result);
          $db_pass = $email_password['PASSWORD'];
          $image=$email_password["IMAGE"];
          if (password_verify($password, $db_pass)) {
            // echo "LOGIN";
            $sql2 = "INSERT sold_cycle SELECT EMAIL_ID,NAME,HOSTEL,PRICE,CYCLE_AGE,MOBILE  FROM all_cycle WHERE all_cycle.EMAIL_ID='$emailid'";
            if (mysqli_query($conn, $sql2)) {
              $sql3 = "DELETE FROM all_cycle WHERE EMAIL_ID='$emailid'";
              if (mysqli_query($conn, $sql3)) {
                unlink($image);
                header("Location: view.php?sucessfullydeleted");
              } else {
                echo "<h2 class='msg'>UNABLE TO DELETE!!</h2> ";
              }
            } else {
              echo "<h2 class='msg'>UNABLE TO DELETE!!</h2> ";
            }
          } else {
            echo "<h2 class='msg'>INCORRECT PASSWORD!!</h2> ";
            // sleep(5);
            // header("Location: view.php");
          }
        }
      }

      ?>

    </div>
  </div>
  <br>
  <?php
  mysqli_close($conn);
  ?>
  <script >
   const show = () => {
    var pass = document.getElementsByName("password");
    var btn = document.getElementById("showPass");
    var typo_desktop = pass[0].type;
    if (typo_desktop == "password") {
      pass[0].type = "text";
      btn.style.backgroundColor = "#0000ff";
    } else {
      pass[0].type = "password";
      btn.style.background = "transparent";
    }
  };
  </script>
</body>

</html>