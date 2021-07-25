<?php
require("conn.php");
$email = "";
if (isset($_GET["id"])) {
  $id = $_GET["id"];
  $res = mysqli_query($conn, "select EMAIL_ID from all_cycle where id='$id'");
  if (mysqli_num_rows($res) == 1) {
    $row = mysqli_fetch_assoc($res);
    $emailid = $row["EMAIL_ID"];
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
  <title>UPDATE-CYCLOHIC-</title>
  <link rel="shortcut icon" href="favicon.jpg" type="image/x-icon">
  <link rel="stylesheet" href="css/delete5.css">
  <link rel="stylesheet" href="css/layout8.css">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500&family=Roboto:wght@500&display=swap" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="js/layout2.js"></script>
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


  <div id="box" class="boxs">
    <div class="left">
      <h2 class="title">ENTER EMAIL ID & PASSWORD !!</h2>
      <form class="form" action="" method="POST">
        <input type="email" name="email" value='<?php echo $emailid; ?>' readonly>
        <input required type="password" name="password" placeholder="Enter password" minlength="5">
        <button class="show" id="showPass" type="button" onclick="show()"><i class="far fa-eye"></i></button>
        <a href="forgetPass.php?id=<?php echo $id; ?> style="color : white">forget password?</a>

        <button name="done" class="btn">DONE</button>
      </form>
    </div>
    <div class="right">
      <?php

      if (isset($_REQUEST["done"])) {
        $password = $_REQUEST['password'];
        $sql1 = "SELECT * FROM all_cycle WHERE EMAIL_ID='$emailid'";
        $result = mysqli_query($conn, $sql1);
        $row = mysqli_fetch_assoc($result);
        $db_pass = $row['PASSWORD'];
        if (password_verify($password, $db_pass)) { ?>
          <script>
            let left = document.getElementsByClassName('left');
            left[0].style.display = 'none'
          </script>

      <?php
          echo "<h1 class='title'>CYCLE DETAILS:</h1>";
          echo "<form action='' class='form1' style='text-align: center;' method='POST' enctype='multipart/form-data'>";
          echo "
                          <table>
                            <tr>
                            <td><h2 class='subhead'>Email ID:</h2></td> 
                            <td><input readonly  required name='emailid' type='text' value='" . $row['EMAIL_ID'] . "'> </td>
                            </tr>";
          echo "
                            <tr>
                            <td><h2 class='subhead'>NAME:</h2></td> 
                            <td><input required name='name' type='text' value='$row[NAME]'> </td>
                            </tr>";

          echo "
                          <tr>
                          <td><h2 class='subhead'>HOSTEL:</h2></td> 
                          <td><input required name='hostel' type='text'  value='$row[HOSTEL]'> </td>
                          </tr>";

          echo "
                          <tr>
                          <td><h2 class='subhead'>MOBILE NO:</h2></td> 
                          <td><input required name='mobile' type='text'  maxlength='10' minlength='10' value='$row[MOBILE]'> </td>
                          </tr>";
          echo "
                          <tr>
                          <td><h2 class='subhead'>CYCLE AGE:</h2></td> 
                          <td><input name='age' type='number'  required value=$row[CYCLE_AGE]> </td>
                          </tr>";
          echo "
                          <tr>
                          <td><h2 class='subhead'>PRICE: </h2></td>
                          <td><input required name='price' type='number'  value=$row[PRICE]> </td>
                          </tr>";
          echo "
                          <tr>
                          <td><h2 class='subhead'>IMAGE:</h2></td> 
                          <td>
                          <div class='img_div'>
                          <img src='" . $row['IMAGE'] . "'/>
                          <input style='color:white' class='' name='file' type='file' value='". $row['IMAGE'] . "'>
                          </div>
                           </td>
                          </tr>";
          echo "
                          <tr>
                          <td></td>
                          <td><button  name='update' class='btn' type='sumbit'>UPDATE</button></td>
                          </tr> </table>";
          echo "</form>";
        } else {
          echo "<h2 class='msg'>WRONG PASSWORD!!</h2> ";
        }
      }
      ?>

      <?php

      if (isset($_REQUEST["update"])) {
        $name = $_FILES['file'];
        $file_name = $_FILES['file']['name'];
        $file_Temp = $_FILES['file']['tmp_name'];
        $file_size = $_FILES['file']['size'];
        $file_type = $_FILES['file']['type'];
        $file_error = $_FILES['file']['error'];
        $nam = $_POST['name'];
        $hostel = $_POST["hostel"];
        $mob = $_POST["mobile"];
        $age = $_POST["age"];
        $price = $_POST["price"];
        $email = $_POST["emailid"];

        if ($file_error == 4) {
          $res = mysqli_query($conn, "UPDATE all_cycle SET NAME='$nam',HOSTEL='$hostel',MOBILE='$mob', CYCLE_AGE='$age',PRICE='$price' WHERE EMAIL_ID='$email'");
          echo $res;
          if ($res) {
            echo "<h1 class='msg'>DATA UPDATED SUCCESSFULLY!!</h1> ";
          } else echo "<h1 class='msg'>ERROR IN UPDATING</h1> ";
        } else {
          $file_ext = explode('.', $file_name);
          $file_act_ext = strtolower(end($file_ext));

          $allowed_ext = array('png', 'jpg', 'jpeg');

          if (in_array($file_act_ext, $allowed_ext)) {
            if ($file_error === 0) {
              if ($file_size < 10000000) {
                $file_new_name = uniqid('', true) . "." . $file_act_ext;
                $file_destination = "uploads/" . $file_new_name;
                //$file_destination= "../try/".$file_new_name;

                move_uploaded_file($file_Temp, $file_destination);
                $row = mysqli_fetch_assoc(mysqli_query($conn, "select IMAGE from all_cycle where EMAIL_ID='$email'"));
                unlink($row['IMAGE']);
                $res = mysqli_query($conn, "UPDATE all_cycle SET NAME='$nam',HOSTEL='$hostel',MOBILE='$mob', CYCLE_AGE='$age',PRICE='$price',IMAGE='$file_destination' WHERE EMAIL_ID='$email'");
                echo "<h1 class='msg'>DATA UPDATED SUCCESSFULLY!!</h1> ";
              } else {
                echo "<h1 class='msg'>!! UPLOADED IMAGE SHOULD BE LESS THAN 10MB !!</h1> ";
              }
            } 
            else {
              echo "<h1 class='msg'>ERROR IN UPDATING</h1> ";
            }
          } else {
            echo "<h1 class='msg'>FILE EXTENSION MUST BE 'png' or 'jpg' or 'jpeg</h1> ";
          }
        }
      }
      ?>
    </div>
  </div>
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