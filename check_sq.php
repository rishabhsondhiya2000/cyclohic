<?php 
     require('conn.php'); 
     session_start();
     $sq_code=$_POST['security'];
     $sq_ans=$_POST['ANS'];
     $id=$_GET['id'];
     $sql="SELECT NAME from all_cycle where id='$id' AND security='$sq_code' AND ANS='$sq_ans'";
     $res=mysqli_query($conn,$sql);
     $count = mysqli_num_rows($res);
     if($count==1){
         $_SESSION['otp_verify']="yes";
     }
     else{
         $_SESSION['otp_verify']="not";
     }
     header("location:forgetPass.php?id=$id");


?>