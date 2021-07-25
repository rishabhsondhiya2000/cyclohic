<?php
require("conn.php");
$num = $_POST["num"];
$per = 2;
$start = $per * ($num - 1);
$res = mysqli_query($conn, "SELECT id,EMAIL_ID,UPPER(NAME),UPPER(HOSTEL),MOBILE,CYCLE_AGE,PRICE,IMAGE from all_cycle  order by all_cycle.PRICE limit $start,$per");
$html = "";
while ($row = mysqli_fetch_assoc($res)) {
  $html .= "<div class='div'>
            <div  class='mydiv'>
               <h2> Name:<span> " . $row['UPPER(NAME)'] . "</span> <br>Price : Rs." . $row['PRICE'] . "</h2>
                <p>
                  <span>EMAIL ID:</span> " . $row['EMAIL_ID'] . "<br>
                  <span>Hostel:</span> " . $row['UPPER(HOSTEL)'] . "<br>
                  <span>Mobile:</span> " . "+91- " . $row['MOBILE'] . "<br>
                  <span>Cycle's Age:</span> " . $row['CYCLE_AGE'] . " Months <br>
                  <span>Image:</span> <a href='" . $row['IMAGE'] . "' target='_block'>view image</a>
                </p>
            </div><br> 
            <div class='edit_btn' >
                  <a href='delete.php?id=".$row['id']."' class='delete_btn'>DELETE</a>
                  <a href='update.php?id=".$row['id']."'class='update_btn'>UPDATE</a>

            </div>
            </div>";
}
$status = "yes";
echo json_encode(["status" => $status, "html" => $html]);
