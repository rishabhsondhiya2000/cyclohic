<?php 
require "PHPMailer\Exception.php";
require "PHPMailer\PHPMailer.php";
require "PHPMailer\SMTP.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// $otp="12345";
// $emailToSend="thelevel2000@gmail.com";
// echo send_mail($emailToSend,$otp);

function send_mail($email,$otp){
	$mail = new PHPMailer();
	$mail->IsSMTP(true);
	$mail->Host = 'smtp.gmail.com'; // not ssl://smtp.gmail.com
	$mail->SMTPAuth= true;
	$mail->Username='rishabhsondhiya2000@gmail.com';
	$mail->Password='IIT10953';
	$mail->Port = 465; // not 587 for ssl 
	// $mail->SMTPDebug = 2; 
	$mail->SMTPSecure = 'ssl';
	$mail->SetFrom('rishabhsondhiya2000@gmail.com', 'CYCLOHIC');
	$mail->AddAddress($email, 'USER');
	$mail->Subject = 'OTP confirmation';
	// $mail->Subject = "Here is the subject";
	$mail->Body    = "Your 5-didgit otp is : <b>$otp</b>";
	$mail->AltBody = "This is the body in plain text for non-HTML mail    clients";
	if(!$mail->Send()) {
	// echo 'Error : ' . $mail->ErrorInfo;
	return false;
	} else {
		// echo 'Ok!!';
		return true;
	} 
}



?>

