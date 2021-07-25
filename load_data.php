<?php
$conn = mysqli_connect('localhost', 'root', '', 'my_db');
if (!$conn) die("Server connection lost");
$per=4;
$count = $_POST['count']-$per;
$html="";
$res = mysqli_query($conn, "SELECT * from feedback order by timestamp desc LIMIT $count,$per");
while ($row = mysqli_fetch_assoc($res)) {
    $html.= "<div class='feedback'>
    <h2> &rightarrow;" . $row['emailid'] . " </h2>
    <p>&rightarrow;" . $row['feedback'] . "</p>
    </div>";
}
$status="";
$count+=$per;
if(mysqli_num_rows(mysqli_query($conn,"SELECT * from feedback LIMIT $count,1")) > 0){
    $status="yes";
}
else{
    $status="no";
}
echo json_encode(["status"=>$status,"html"=>$html]);
?>