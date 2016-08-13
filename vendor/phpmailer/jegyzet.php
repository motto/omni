<?php
//require 'class.phpmailer.php';

$mail = new PHPMailer;
$mail->isSendmail();                                      // Mail küldés Sendmail használatával
$mail->SMTPAuth = true;                                   // SMTP autentikáció
$mail->Username = 'webmaster@testdomain.hu';              // SMTP felhasználónév
$mail->Password = 'password';                             // SMTP jelszó
$mail->setFrom('webmaster@testdomain.hu', 'Webmaster');   // Küldő cím
$mail->addAddress('user@example.com', 'User');            // Címzett
$mail->Subject = 'PHPMailer teszt';                       // A levél tárgya
$mail->Body    = 'Teszt';                                 // A levél törzse

if(!$mail->send()) {
    echo 'A levél nem küldhető el.';
    echo 'PHPMailer hiba: ' . $mail->ErrorInfo;
} else {
    echo 'A levél elküldve.';
}