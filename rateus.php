<?php
require("conn.php");
session_start();
session_destroy();
?>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RATE US-CYCLOHIC</title>
    <link rel="shortcut icon" href="favicon.jpg" type="image/x-icon">
    <link rel="stylesheet" href="css/rateus4.css">
    <link rel="stylesheet" href="css/layout8.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500&family=Roboto:wght@500&display=swap" rel="stylesheet">
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

    <div class="container">
        <div class="left">
            <form action="" method="post">
                <h1 class="title">GIVE US YOUR FEEDBACK:-</h1>
                <table>
                    <tr>
                        <td>
                            <h2 class='heading'>EMAIL ID :</h2>
                        </td>
                        <td> <input class="input height" type="email" name="email" required placeholder="Email ID"> </td>
                    </tr>

                    <tr>
                        <td>
                            <h2 class='heading'>FEEDBACK :</h2>
                        </td>
                        <td> <textarea cols="31" rows="10" class="input" type="text" name="feedback" required placeholder="FEEDBACK"></textarea> </td>
                    </tr>

                    <tr>
                        <td></td>
                        <td> <input class="submit" type="submit" name="submit"> </td>
                    </tr>
                </table>
            </form>
            <?php
            if (isset($_REQUEST['submit'])) {
                $email = $_REQUEST['email'];
                $feedback = $_REQUEST['feedback'];
                $count1=mysqli_num_rows(mysqli_query($conn,"select EMAIL_ID from sold_cycle where EMAIL_ID ='$email'"));
                $count2=mysqli_num_rows(mysqli_query($conn,"select EMAIL_ID from all_cycle where EMAIL_ID ='$email'"));
                if($count1>0 || $count2>0){
                    $timestamp = time();
                    $insert = "INSERT INTO feedback(emailid,feedback,timestamp) values('$email','$feedback','$timestamp')";
                    mysqli_query($conn, $insert);
                    echo "<br><br><h1  class='title' >Thank You for your feedback !!!</h1>";
                }
                else{
                    echo "<br><br><h1  class='title' >You are not our user!😧</h1>";
                }
            }


            ?>


        </div>
        <div class="right">
            <h1 class="title">FEEDBACKS:-</h1>
            <div id="box">
            </div>
            <input id="load_btn" class="submit" type="button" onclick="load_data()" value="Load More..">
        </div>
    </div>

</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="js/layout2.js"></script>
<script>
    var count = 0;
    const load_data = () => {
        count += 4;
        jQuery.ajax({
            url: "load_data.php",
            data: "count=" + count,
            type: "post",
            success: (res) => {
                res = JSON.parse(res);
                if (res.status == "no") {
                    jQuery("#load_btn").hide();
                }
                jQuery("#box").append(res.html);
            }
        });
    };
    load_data();

    var title = document.title;
    var split_title = title.split(" ");
    console.log(split_title[0]);
    var m_split_title = split_title[0].toLowerCase();
    $("#" + split_title[0]).addClass("active");
    $("#" + m_split_title).addClass("active");
</script>

</html>