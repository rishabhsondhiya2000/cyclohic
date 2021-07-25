<?php 
function check_email($conn,$email){
   $res=mysqli_query($conn,"SELECT * from all_cycle where EMAIL_ID='$email' ");
   $count=mysqli_num_rows($res);
   if($count==0){
       return "yes";
   }
   else return "no";
}

?>