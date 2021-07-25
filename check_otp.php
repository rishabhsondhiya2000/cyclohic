<?php
session_start();
if(isset($_COOKIE["isValidOTP"])){
    echo "<h2>OTP is Valid</h2>";
    $userOTP=$_POST["otp"];
    $ourOTP=$_SESSION["otp"];
    if($userOTP==$ourOTP){
        $_SESSION["otp_verify"]="yes";
    }
    else{
        $_SESSION["otp_verify"]="no";
    }
}
else{
    $_SESSION["otp_verify"]="expired";
}

if(isset($_GET['m'])){
    if($_GET['m']=="fp"){
        $id=$_POST['id'];
        header("location:forgetPass.php?id=$id");
    }
}else{
    header("location:add_1.php");
}
?> 