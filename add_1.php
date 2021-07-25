<?php
require("conn.php");
require("datamail.php");
require("check_email.php");
session_start();
// 🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕
$mode = "emailSignin";
// Temporary 💛
// $mode = "cycleDetails";

// 🔺 After submitting OTP->starts 🔺
if (isset($_SESSION["otp_verify"])) {
  if ($_SESSION["otp_verify"] == "yes") {
    $mode = "cycleDetails";
  } elseif ($_SESSION["otp_verify"] == "no") {
    $_SESSION['error'] = "Enter the correct OTP 😕";
    $mode = "otp";
  } elseif ($_SESSION["otp_verify"] == "expired") {
    $_SESSION['error'] = "Your session has been Expired 😞!<br> <a href='index.php'>Try Again</a>";
    $mode = "otp";
  }
  $_SESSION["otp_verify"] = "";
}
// 🔺 After submitting OTP->ends 🔺
// 🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕

// 🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕
// 🔺 After submitting Email iD->starts 🔺
if (isset($_REQUEST['submit'])) {
  $email = $_POST['EMAIL'];
  if (check_email($conn, $email) == "no") {
    $_SESSION["error"] = "Email Id is already registered 😭";
    //  header("location:add.php");
  } else {
    $mode = "otp";
    $_SESSION["email"] = $email;
    setcookie("isValidOTP", "yes", time() + 180, "/");
    $emailOTP = rand(10000, 99999);
    $_SESSION["otp"] = $emailOTP;
    if (!send_mail($email, $emailOTP)) {
      //  session_destroy();
      //  session_start();
      session_unset();
      $_SESSION['error'] = "Failed To send OTP...Check Your Email Id";
      header("location:add.php");
    } else {
      $_SESSION['error'] = "OTP sent to ✉️ $email";
    }
  }
}
// 🔺 After submitting Email iD->ends 🔺
//🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕

// 🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕
// 🔺 Error->starts 🔺
$error = "";
if (isset($_SESSION["error"])) {
  $error = $_SESSION["error"];
  $_SESSION['error'] = "";
}
// 🔺 Error->ends 🔺
// 🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕🚕

// 🔺 Google Login->starts 🔺
include('config.php');

$login_button = '';


if (isset($_GET["code"])) {

  $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);


  if (!isset($token['error'])) {

    $google_client->setAccessToken($token['access_token']);


    $_SESSION['access_token'] = $token['access_token'];


    $google_service = new Google_Service_Oauth2($google_client);


    $data = $google_service->userinfo->get();


    if (!empty($data['given_name'])) {
      $_SESSION['user_first_name'] = $data['given_name'];
    }

    if (!empty($data['family_name'])) {
      $_SESSION['user_last_name'] = $data['family_name'];
    }

    if (!empty($data['email'])) {
      $_SESSION['user_email_address'] = $data['email'];
    }

    if (!empty($data['gender'])) {
      $_SESSION['user_gender'] = $data['gender'];
    }

    if (!empty($data['picture'])) {
      $_SESSION['user_image'] = $data['picture'];
    }
  }
}


if (!isset($_SESSION['access_token'])) {

  $login_button = '<span class="label"> OR Sign in with:</span><a class="google"  href="' . $google_client->createAuthUrl() . '">
                              <div id="gSignInWrapper">
                                
                                   <div id="customBtn" class="customGPlusSignIn">
                                    <span class="icon"></span>
                                    <span class="buttonText">Google</span>
                                       </div>
                                           </div></a>';
}
// 🔺 Google Login->ends 🔺
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ADD DETAILS-CYCLOHIC</title>
  <link rel="stylesheet" href="css/add3.css">
  <link rel="stylesheet" href="css/layout8.css">
  <link rel="shortcut icon" href="favicon.jpg" type="image/x-icon">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500&family=Roboto:wght@500&display=swap" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="js/layout2.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <style>
    .googlelogin a {
      text-decoration: none;
      color: white;
      background-color: red;
    }
  </style>
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

  <div class="section1">
    <div class="left">
      <?php if ($mode == "cycleDetails") { ?>
        <form id="desktop" action="add_data.php" class="form1" method="POST" enctype="multipart/form-data">
          <h1 class="top">CYCLE DETAILS !!</h1>
          <label class="alert" for=""><b>⚠️ Don't Change the page! ⚠️</b></label><br>
          <table>
            <tr>
              <td class="heading">
                <h2>Name :</h2>
              </td>
              <td> <input class="input" style="text-transform: uppercase;" type="text" name="NAME" id="name" required placeholder=" FullName"> </td>
            </tr>

            <tr>
              <td class="heading">
                <h2>Hostel :</h2>
              </td>
              <td> <input class="input" style="text-transform: uppercase;" type="text" name="HOSTEL" id="hostel" required placeholder=" Hostel Name"></td>
            </tr>

            <tr>
              <td class="heading">
                <h2>Mobile No.:</h2>
              </td>
              <td> <input class="input" type="text" name="MOBILE" id="mobile1" maxlength="10" minlength="10" required placeholder=" CONATCT NO."> </td>
            </tr>

            <tr>
              <td class="heading">
                <h2>Cycle's Age :</h2>
              </td>
              <td> <input class="input" type="number" name="AGE" id="age" required placeholder=" Age in Months e.g.( 6 )"></td>
            </tr>

            <tr>
              <td class="heading">
                <h2>Price:</h2>
              </td>
              <td> <input class="input" type="number" name="PRICE" id="price" required placeholder=" Rs. Price e.g.( 2000 )"></td>
            </tr>

            <tr>
              <td class="heading">
                <h2>Image:</h2>
              </td>
              <td><label class="labelForFile submit" for="image">
                  <input type="file" name="file" id="image" required></label></td>
            </tr>

            <tr>
              <td class="heading">
                <h2>E-Mail id :</h2>
              </td>
              <td> <input class="input" type="email" name="EMAIL" id="email" value="<?php echo $_SESSION['email'] ?>" readonly></td>
            </tr>

            <tr>
              <td class="heading">
                <h2>Password :</h2>
              </td>
              <td> <input class="input" minlength="5" type="password" name="PASSWORD" id="pass" required placeholder=" Min-5 digit"> <button class="show" id="showPass" type="button" onclick="show()"><i class="far fa-eye"></i></button> </td>
            </tr>
            <tr>
            <tr>
              <td class="heading">
                <h2>Security :</h2>
              </td>
              <td> <select class="input" name="security" required placeholder="Select One">
                  <option value="1">What was your childhood nickname?</option>
                  <option value="2">What is your maternal grandmother's maiden name?</option>
                  <option value="3">What is your youngest brother’s birthday month and year?</option>
                  <option value="4">What was the name of your first stuffed animal?</option>
                  <option value="5">What is your oldest cousin's first and last name?</option>
                  <option value="6">What is the name of your favorite childhood friend?</option>
                  <option value="7">What street did you live on in third grade?</option>

                </select>
              </td>
            </tr>
            <tr>
            <tr>
              <td class="heading">
                <h2>Answer :</h2>
              </td>
              <td> <input class="input" type="text" name="ANS" required placeholder="Enter Answer of Question"> </td>
            </tr>
            <tr>
              <td></td>
              <td> <button name="BUTTON" class="submit" type="sumbit">Sumbit</button></td>
            </tr>
          </table>
        </form>
        <form id="mobile" action="add_data.php" class="form1" method="POST" enctype="multipart/form-data">
          <h1 class="top">CYCLE DETAILS !!</h1>
          <label class="alert" for=""><b>⚠️ Don't Change the page! ⚠️<b></label><br>
          <div class="heading">
            <h2>Name :</h2>
          </div>
          <input class="input" style="text-transform: uppercase;" type="text" name="NAME" id="name1" required placeholder=" FullName">



          <div class="heading">
            <h2>Hostel :</h2>
          </div>
          <input class="input" style="text-transform: uppercase;" type="text" name="HOSTEL" id="hostel1" required placeholder=" Hostel Name">



          <div class="heading">
            <h2>Mobile No.:</h2>
          </div>
          <input class="input" type="text" name="MOBILE" id="mobile2" maxlength="10" minlength="10" required placeholder=" CONATCT NO.">



          <div class="heading">
            <h2>Cycle's Age :</h2>
          </div>
          <input class="input" type="number" name="AGE" id="age1" required placeholder=" Age in Months e.g.( 6 )">

          <div class="heading">
            <h2>Price:</h2>
          </div>
          <input class="input" type="number" name="PRICE" id="price1" required placeholder=" Rs. Price e.g.( 2000 )">


          <div class="heading">
            <h2>Image:</h2>
          </div>
          <label class="labelForFile submit" for="image">
            <i class="fa fa-cloud-upload"></i>
            <input type="file" name="file" id="image1" required></label>



          <div class="heading">
            <h2>E-Mail id :</h2>
          </div>
          <input class="input" type="email" name="EMAIL" id="email1" required value="<?php echo $_SESSION['email'] ?>" readonly>

          <div class="heading">
            <h2>Password :</h2>
          </div>
          <input class="input" minlength="5" type="password" name="PASSWORD" id="pass1" required placeholder=" Min-5 digit"><button class="show" id="showPass1" type="button" onclick="show()"><i class="far fa-eye"></i></button>

          <div class="heading">
            <h2>Security :</h2>
          </div>
          <select class="input" name="security" required placeholder="Select One">
            <option value="1">What was your childhood nickname?</option>
            <option value="2">What is your maternal grandmother's maiden name?</option>
            <option value="3">What is your youngest brother’s birthday month and year?</option>
            <option value="4">What was the name of your first stuffed animal?</option>
            <option value="5">What is your oldest cousin's first and last name?</option>
            <option value="6">What is the name of your favorite childhood friend?</option>
            <option value="7">What street did you live on in third grade?</option>

          </select>
          <div class="heading">
            <h2>Answer :</h2>
          </div>
          <input class="input" type="text" name="ANS" required placeholder="Enter Answer of Question">

          <button name="BUTTON" class="submit" type="sumbit">Sumbit</button>

        </form>
      <?php } elseif ($mode == "otp") { ?>
        <form class="form1" action="check_otp.php" method="post">
          <h2 class="top">Enter 5-digit OTP :- </h2>
          <input type="text" name="otp" class="input" placeholder="Enter OTP" required autocomplete="off" minlength="5" maxlength="5">
          <input type="submit" class="submit" value="Submit" name="submitOTP"><br>
          <label class="alert" for=""><b>⚠️ This OTP is valid for 180 seconds ⏲️ ⚠️</b></label><br>
          <label class="alert" for=""><b>⚠️ Don't Change the page! ⚠️</b></label><br>
          <h2 class="top" id="timer"></h2>
        </form>
      <?php } elseif ($mode == "emailSignin") { ?>
        <form class="form1" action="" method="post">
          <h2 class="top">Enter The Email Id ✉️ :- </h2>
          <input type="email" id="eID" name="EMAIL" class="input" placeholder="Enter Email ID" required autocomplete="off"><br>
          <label for="eID" class="alert"> <b>⚠️ A verification OTP will be sent to this EmailId! ⚠️<b></label><br>
          <input type="submit" class="submit" value="Submit" name="submit">
        </form>
        <?php
        if ($login_button == '') {
          $image = $_SESSION["user_image"];
          $name = $_SESSION['user_first_name'] . " " . $_SESSION['user_last_name'];
          $email = $_SESSION['user_email_address'];
          if (check_email($conn, $email) == "no") {
            $_SESSION["error"] = "Email Id is already registered 😭";
            header("location:add_1.php");
          } else {
            $_SESSION["otp_verify"] = "yes";
            $_SESSION['email'] = $email;
            header("location:add_1.php");
          }
        } else {
          echo '<div align="center ">' . $login_button . '</div>';
        }
        ?>
      <?php } ?>
    </div>
    <div class="message">
      <h2 class="top"><?php echo $error; ?></h2>
    </div>
  </div>



</body>

<script>
  $(document).ready(function() {
    $(".input").keydown(function() {
      $(".input").css("background-color", "rgb(215, 223, 113)");
    });
    $(".input").keyup(function() {
      $(".input").css("background-color", "white");
    });
    var title = document.title;
    var split_title = title.split(" ");
    // console.log(split_title[0]);
    var m_split_title = split_title[0].toLowerCase();
    $("#" + split_title[0]).addClass("active");
    $("#" + m_split_title).addClass("active");
  });

  const show = () => {
    var pass = document.getElementsByName("PASSWORD");
    var btn = document.getElementsByClassName("show");
    var typo_desktop = pass[0].type;
    var typo_mobile = pass[1].type;
    if (typo_desktop == "password" || typo_mobile == "password") {
      pass[0].type = "text";
      pass[1].type = "text";
      btn[0].style.backgroundColor = "#0000ff";
      btn[1].style.backgroundColor = "#0000ff";
    } else {
      pass[0].type = "password";
      pass[1].type = "password";
      btn[0].style.background = "transparent";
      btn[1].style.background = "transparent";
    }
  };
</script>

<?php
mysqli_close($conn);
?>

</html>