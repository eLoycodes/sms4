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
        $mail->Password   = 'xkgc ilkq izmd lysk'; // SMTP password (use app password if 2FA is enabled)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // or PHPMailer::ENCRYPTION_STARTTLS
        $mail->Port       = 465; // or 587 for SMTPS

        // Recipients
        $mail->setFrom('bcpchiefregistrar00@gmail.com', 'Chief Registrar'); // Use your email
        $mail->addAddress($_POST['email'], $_POST['name']); // Recipient email and name

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Subject of the email';
        $mail->Body    = nl2br("Name: " . htmlspecialchars($_POST['name']) . "<br>Message: " . nl2br(htmlspecialchars($_POST['message'])));

        $mail->send();
        echo "<script>alert('Message has been sent');</script>";
        echo "<script>window.open('sendmail.php','_self');</script>";
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
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <title>Sms4</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
</head>
<body>
    <!-- navbar -->
    <?php include('navbar.php'); ?>
    <!-- end navbar --><br><br>

    <div class="email-container">
        <h1>Email</h1>
        <form id="contactForm" method="POST" action="">
            <div class="form-group">
                <label for="name">To:</label>
                <input type="text" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="message">Message:</label>
                <textarea id="message" name="message" rows="5" required></textarea>
            </div>

            <button type="submit" class="emailbtn" name="submit">Send Message</button>
        </form>
    </div>

    <script type="text/javascript">
        // SideNav
        function toggleNav() {
            const sidenav = document.getElementById("sidenav");
            const uppernav = document.getElementById("uppernav");

            if (sidenav.style.left === "0px") {
                sidenav.style.left = "-280px";
                uppernav.style.marginLeft = "0";
            } else {
                sidenav.style.left = "0";
                uppernav.style.marginLeft = "280px";
            }
        }

        // Dropdown
        var dropdown = document.getElementsByClassName("dropdown-btn");
        var i;

        for (i = 0; i < dropdown.length; i++) {
            dropdown[i].addEventListener("click", function() {
                this.classList.toggle("active");
                var dropdownContent = this.nextElementSibling;
                if (dropdownContent.style.display === "block") {
                    dropdownContent.style.display = "none";
                } else {
                    dropdownContent.style.display = "block";
                }
            });
        }
    </script>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0; /* Reset default margin */
            justify-content: center; /* Centering the container */
            align-items: center; /* Centering vertically */
            min-height: calc(100vh - 100px); /* Full height for centering while considering navbar */
        }

        .email-container {
            width: 100%; /* Full width */
            max-width: 600px; /* Maximum width for larger screens */
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            box-sizing: border-box; /* Ensure padding is included in width */
            margin: auto; /* Center the container */
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input, textarea {
            width: 100%; /* Full width */
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box; /* Include padding in width */
        }

        .emailbtn {
            background-color: #5cb85c;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            width: 100%; /* Full width */
            margin: 10px 0; /* Margin for spacing */
        }

        .emailbtn:hover {
            background-color: #4cae4c;
        }

        /* Media Queries for Responsive Design */
        @media (max-width: 768px) {
            body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0; /* Reset default margin */
            justify-content: center; /* Centering the container */
            align-items: center; /* Centering vertically */
            min-height: calc(100vh - 100px); /* Full height for centering while considering navbar */
        }
            .email-container {
                width: 90%; /* Adjust width for smaller screens */
                padding: 15px; /* Adjust padding */
            }

            input, textarea {
                padding: 8px; /* Adjust padding for smaller screens */
            }
        }

        @media (max-width: 576px) {
            body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0; /* Reset default margin */
            justify-content: center; /* Centering the container */
            align-items: center; /* Centering vertically */
            min-height: calc(100vh - 100px); /* Full height for centering while considering navbar */
        }
            h1 {
                font-size: 1.5em; /* Slightly smaller heading */
            }
            .email-container {
                width: 90%; /* Adjust width for smaller screens */
                padding: 15px; /* Adjust padding */
            }

            input, textarea {
                padding: 8px; /* Adjust padding for smaller screens */
            }
        }

          
        

        @media (max-width: 400px) {
            body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0; /* Reset default margin */
            justify-content: center; /* Centering the container */
            align-items: center; /* Centering vertically */
            min-height: calc(100vh - 100px); /* Full height for centering while considering navbar */
        }
            .email-container {
                width: 90%; /* Adjust width for smaller screens */
                padding: 15px; /* Adjust padding */
            }

            input, textarea {
                padding: 6px; /* Further adjust padding for very small screens */
            }

           
        }
    </style>
</body>
</html>




