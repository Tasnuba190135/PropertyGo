<?php

use PHPMailer\PHPMailer\PHPMailer;

require_once '../php-mail/PHPMailer.php';
require_once '../php-mail/Exception.php';
require_once '../php-mail/SMTP.php';

$mail = new PHPMailer(true);
$mail->isSMTP();                                            //Send using SMTP
$mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
$mail->Username   = '190122.cse@student.just.edu.bd';                     //SMTP username
$mail->Password   = 'dkge jrzq tkun zzye';                               //SMTP password
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
$mail->Port       = 587;

//Recipients
//$mail->setFrom('180103.cse@student.just.edu.bd', 'Mailer');
$mail->addAddress('tasnim.arisha1823@gmail.com');     //Add a recipient

//Content
$mail->isHTML(true);                                  //Set email format to HTML
$mail->Subject = 'Pay due amount.';
$mail->Body    = "Hi,At first take salam. We inform you that you have a due amount for Safe Deposit Box. Please Pay it as soon as possible.<br><br><b>Your due amount is: 100 </b><br><br><br>With Best Regards<br>Bank of JUST<br>";

$mail->send();

if (!$mail->Send()) {
    echo "<script> alert('Submission failed!!') </script>";
} else {
    echo "<script> alert('Email has been sent successfully!!') </script>";
}



?>

<!-- end -->