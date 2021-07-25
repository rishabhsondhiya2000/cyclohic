<?php
require("conn.php");
require("datamail.php");
require("check_email.php");
$emailid = "";
$id = "";
session_start();
if (isset($_GET["id"])) {
  $id = $_GET["id"];
  $res = mysqli_query($conn, "select EMAIL_ID from all_cycle where id='$id'");
  if (mysqli_num_rows($res) == 1) {
    $row = mysqli_fetch_assoc($res);
    $emailid = $row["EMAIL_ID"];
  } else {
    header("location:view.php");
  }
} else {
  header("location:view.php");
}
// ------------------------------------------//
$mode = "sendOTP";
if (isset($_REQUEST['sendOTP'])) {
  setcookie("isValidOTP", "yes", time() + 60, "/");
  $emailOTP = rand(10000, 99999);
  $_SESSION["otp"] = $emailOTP;
  if (!send_mail($emailid, $emailOTP)) {
    session_unset();
    $_SESSION['error'] = "Failed To send OTP...Check Your Email Id";
    header("location:add.php");
  } else {
    $mode = "checkOTP";
  }
}
//----------------------------------------------//
if (isset($_SESSION["otp_verify"])) {
  if ($_SESSION["otp_verify"] == "yes") {
    $mode = "changePass";
  } elseif ($_SESSION["otp_verify"] == "no") {
    $_SESSION['error'] = "Enter the correct OTP 😕";
    $mode = "checkOTP";
  } elseif ($_SESSION["otp_verify"] == "expired") {
    $_SESSION['error'] = "Your session has been Expired 😞!<br> <a href='view.php'>Try Again</a>";
    $mode = "checkOTP";
  }
  elseif($_SESSION["otp_verify"] == "not"){
    $_SESSION['error'] = "Wrong Security Que/Ans 😕";
    $mode = "sendOTP";
  }
  $_SESSION["otp_verify"] = "";
}
//----------------------------------------------//
$error = "";
if (isset($_SESSION["error"])) {
  $error = $_SESSION["error"];
  $_SESSION['error'] = "";
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PASSWORD RESET-CYCLOHIC</title>
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
      <?php if ($mode == "sendOTP") { ?>
        <h2 class="title">* An OTP will be send to ✉️ <?php echo $emailid; ?></h2>
        <form class="form" action="" method="POST">
          <button name="sendOTP" type="submit" class="btn">SEND OTP</button>
        </form>
        <h1 class="title">OR</h1>
        <h2 class="title">* Select Your Security Question & Answer</h2>
        <form class="form" action="check_sq.php?id=<?php echo $id; ?>" method="POST">
          <select class="input security_ques" name="security" required placeholder="Select One">
            <option value="1">What was your childhood nickname?</option>
            <option value="2">What is your maternal grandmother's maiden name?</option>
            <option value="3">What is your youngest brother’s birthday month and year?</option>
            <option value="4">What was the name of your first stuffed animal?</option>
            <option value="5">What is your oldest cousin's first and last name?</option>
            <option value="6">What is the name of your favorite childhood friend?</option>
            <option value="7">What street did you live on in third grade?</option>

          </select>
          <input class="input" type="text" name="ANS" required placeholder="Enter Answer of Question">    
          <button name="security_check" type="submit" class="btn">Submit</button>
        </form>
      <?php } elseif ($mode == "checkOTP") { ?>
        <h2 class="title">Enter 5 Digit OTP:</h2>
        <form class="form" action="check_otp.php?m=fp" method="POST">
          <input type="text" name="otp" placeholder="Enter OTP" required minlength="5" maxlength="5">
          <input type="text" name="id" value="<?php echo $id; ?>" required hidden>
          <button name="checkOTP" type="submit" class="btn">SUBMIT</button>
        </form>
      <?php } elseif ($mode == "changePass") { ?>
        <h2 class="title">Enter New Password:</h2>
        <form class="form" method="POST">
          <input type="password" name="newPass" placeholder="Minimum 5 characters " required minlength="5" maxlength="5">
          <button class="show" id="showPass" type="button" onclick="show()"><i class="far fa-eye"></i></button>
          <button name="done" type="submit" class="btn">DONE</button>
        </form>
      <?php } ?>

    </div>

    <div class="right">
      <h2 class='title'><?php echo $error; ?></h2>
      <?php
      if (isset($_REQUEST["done"])) {
        $password = $_REQUEST['newPass'];
        $new_password = password_hash($password, PASSWORD_BCRYPT);
        $sql = "UPDATE all_cycle set PASSWORD='$new_password' where EMAIL_ID='$emailid'";
        $res = mysqli_query($conn, $sql);
        if ($res) {
          echo "<h2 class='title'>Password Updated Successfully! 😏</h2>";
        } else {
          echo "<h2 class='title'>Some Problem Occurred! 😞</h2>";
        }
      }

      ?>

    </div>
  </div>
  <br>
  <?php
  mysqli_close($conn);
  ?>
  <script>
    const show = () => {
      var pass = document.getElementsByName("newPass");
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