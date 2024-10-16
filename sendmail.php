<?php
include("connect.php");
ini_set('session.cookie_httponly', 1);
ini_set('session.cookie_secure', 1);
ini_set('session.use_only_cookies', 1);
session_start();

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

if(!isset($_SESSION["id"])){
    echo "<script>window.open('index.php?mes=Access Denied..','_self');</script>";
    exit;
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer/PHPMailer-master/src/SMTP.php';
require 'PHPMailer/PHPMailer-master/src/Exception.php';

$mail = new PHPMailer(true);

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com'; // SMTP server
        $mail->SMTPAuth   = true;
        $mail->Username   = 'bcpchiefregistrar00@gmail.com'; // SMTP username
        $mail->Password   = 'AdminChiefRegistrar00!!'; // SMTP password (use app password if 2FA is enabled)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // or PHPMailer::ENCRYPTION_SMTPS
        $mail->Port       = 587; // or 465 for SMTPS

        // Recipients
        $mail->setFrom('bcpchiefregistrar00@gmail.com', 'Mailer'); // Use your email
        $mail->addAddress($_POST['email'], $_POST['name']); // Recipient email and name

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Subject of the email';
        $mail->Body    = nl2br("Name: " . htmlspecialchars($_POST['name']) . "<br>Message: " . nl2br(htmlspecialchars($_POST['message'])));

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Contact Form</title>
</head>
<body>
    <div class="container">
        <h1>Contact Us</h1>
        <form id="contactForm" method="POST" action="">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="message">Message:</label>
            <textarea id="message" name="message" rows="5" required></textarea>

            <button type="submit">Send Message</button>
        </form>
    </div>

    <script src="script.js"></script>
    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    padding: 20px;
}

.container {
    max-width: 500px;
    margin: auto;
    background: white;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

h1 {
    text-align: center;
    color: #333;
}

label {
    display: block;
    margin: 10px 0 5px;
}

input, textarea {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

button {
    background-color: #5cb85c;
    color: white;
    border: none;
    padding: 10px 15px;
    border-radius: 4px;
    cursor: pointer;
}

button:hover {
    background-color: #4cae4c;
}

    </style>
</body>
</html>
