<?php
require("conn.php");
session_start();
$file_name = $_FILES['file']['name'];
$file_Temp = $_FILES['file']['tmp_name'];
$file_size = $_FILES['file']['size'];
$file_type = $_FILES['file']['type'];
$file_error = $_FILES['file']['error'];

$file_ext = explode('.', $file_name);
$file_act_ext = strtolower(end($file_ext));

$allowed_ext = array('png', 'jpg', 'jpeg');

if (in_array($file_act_ext, $allowed_ext)) {
  if ($file_error === 0) {
    if ($file_size < 10000000) {
      $file_new_name = uniqid('', true) . "." . $file_act_ext;
      $file_destination = "uploads/" . $file_new_name;

      move_uploaded_file($file_Temp, $file_destination);
      $id=time();
      $new_id=password_hash($id,PASSWORD_BCRYPT);
      $name = $_POST['NAME'];
      $hostel = $_POST['HOSTEL'];
      $mobile = $_POST['MOBILE'];
      $age = $_POST['AGE'];
      $price = $_POST['PRICE'];
      $email = $_POST['EMAIL'];
      $password = $_POST['PASSWORD'];
      $new_password = password_hash($password, PASSWORD_BCRYPT);
      $security=$_POST['security'];
      $ans=$_POST['ANS'];
      $sql = "INSERT INTO all_cycle(id,EMAIL_ID,PASSWORD,NAME,HOSTEL,MOBILE,CYCLE_AGE,PRICE,IMAGE,SECURITY,ANS)
                VALUES('$new_id','$email','$new_password','$name', '$hostel','$mobile', '$age', '$price','$file_destination','$security','$ans') ";
      if (mysqli_query($conn, $sql)) {
        // session_unset();  
        $_SESSION["error"]= "Successfully Sumbitted!!!";
        header("location:add_1.php");
      } else {
        // session_unset();
        $_SESSION["error"]= "THIS EMAIL ID IS ALREADY EXIST!!";
        header("location:add_1.php");
      }
    } else {
    //   session_unset();
      $_SESSION["error"]= "YOUR IMAGE SIZE IS TOO BIG!";
      header("location:add_1.php");
    }
  } else {
    // session_unset(); 
    $_SESSION["error"]= "ERROR IN UPLOADING IMAGE!";
    header("location:add_1.php");
  }
} else {
    // session_unset(); 
  $_SESSION["error"]= "YOU CANNOT UPLAOD THIS IMAGE EXTENSION.!";
  header("location:add_1.php");
}

?>