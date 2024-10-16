<?php
$mail->SMTPDebug = 2; // Mag-set ng 1 para sa client messages, 2 para sa client at server messages
$mail->Debugoutput = 'html';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer/PHPMailer-master/src/SMTP.php';
require 'PHPMailer/PHPMailer-master/src/Exception.php';


$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com'; // SMTP server
    $mail->SMTPAuth   = true;
    $mail->Username   = 'bcpchiefregistrar00@gmail.com'; // SMTP username
    $mail->Password   = 'AdminChiefRegistrar00!!'; // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // o PHPMailer::ENCRYPTION_SMTPS
    $mail->Port       = 587; // 465 para sa SMTPS

   
    // Recipients
    $mail->setFrom('from@example.com', 'Mailer');
    $mail->addAddress('recipient@example.com', 'Recipient Name');

    // Content
    $mail->isHTML(true);
    $mail->Subject = 'Subject of the email';
    $mail->Body    = 'HTML content of the email';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>

