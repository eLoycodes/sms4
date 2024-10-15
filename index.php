<?php
include("connect.php");
session_start();

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_SESSION["id"])) {
    echo "<script>window.open('index.php?mes=Access Denied..','_self');</script>";
}

$identifier = $password = "";
$identifier_error = $password_error = "";

if (isset($_POST['submit'])) {
    if (empty($_POST["identifier"])) {
        $identifier_error = "Email or Student Number is required!";
    } else {
        $identifier = $_POST["identifier"];
    }

    if (empty($_POST["password"])) {
        $password_error = "Password is required!";
    } else {
        $password = $_POST["password"];
    }

    if (empty($identifier_error) && empty($password_error)) {
        // Check if the identifier is an email or student number
        if (filter_var($identifier, FILTER_VALIDATE_EMAIL)) {
            // It's an email for admin
            $sql = "SELECT * FROM admin WHERE username='$identifier'"; 
        } else {
            // It's a student number
            $sql = "
                SELECT * FROM deactivate WHERE studentID='$identifier'
                UNION ALL
                SELECT * FROM deactivated WHERE studentID='$identifier'
                UNION ALL
                SELECT * FROM firstyear WHERE studentID='$identifier'
                UNION ALL
                SELECT * FROM secondyear WHERE studentID='$identifier'
                UNION ALL
                SELECT * FROM thirdyear WHERE studentID='$identifier'
                UNION ALL
                SELECT * FROM forthyear WHERE studentID='$identifier'
                UNION ALL
                SELECT * FROM returnee WHERE studentID='$identifier'";
        }

        $res = $connect->query($sql);
        if ($res->num_rows > 0) {
            $ro = $res->fetch_assoc();
            if (filter_var($identifier, FILTER_VALIDATE_EMAIL)) {
                // Admin login
                if (password_verify($password, $ro['password'])) {
                    $_SESSION["id"] = $ro["id"];
                    $_SESSION["username"] = $ro["username"];
                    $_SESSION["role"] = 'admin';
                    header("Location: adminDashboard.php");
                    exit();
                } else {
                    echo "Invalid admin credentials.";
                }
            } else {
                // Student login
                if (password_verify($password, $ro['password'])) {
                    $_SESSION["id"] = $ro["id"];
                    $_SESSION["username"] = $ro["username"];
                    $_SESSION["role"] = 'student';
                    header("Location: studentDashboard.php");
                    exit();
                } else {
                    echo "Invalid student credentials.";
                }
            }
        } else {
            echo "No user found.";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bestlink College - Login</title>
    <link rel="stylesheet" href="css/login.css">
</head>

<body>
<div class="login-container">
    <div class="login-box">
        <img src="image/bcplogo-mini.png" alt="Bestlink College" class="logo">
        <h2><b>Sign in</b></h2>
        <form method="POST">
            <div class="input-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username">
                <span class='error'><?php echo $username_error; ?></span>
            </div>
            <div class="input-group">
                <input type="password" id="password" name="password" placeholder="Password">
                <span class='error'><?php echo $password_error; ?></span>
                <div class="show-password">
                    <input type="checkbox" id="showPassword" onclick="togglePassword()">
                    <label for="showPassword" style="margin-left: 5px;"></label>
                </div>
            </div>
            <div class="input-group">
                <button type="submit" class="submit-button" name="submit">Sign in</button>
                <br><br>
                <a href="option.php" class="submit-button admission-button">Student Admission</a>
            </div>
        </form>
    </div>
</div>

<script>
    function togglePassword() {
        const passwordField = document.getElementById("password");
        const showPasswordCheckbox = document.getElementById("showPassword");
        passwordField.type = showPasswordCheckbox.checked ? "text" : "password";
    }
</script>
<style>

.show-password {
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translateY(-50%);
    display: flex;
    align-items: center;
}

.show-password input {
     margin-left: 5px;
}
    
.error{
    color: red;
    text-align: center;
}

/* new css for button */
.submit-button, .admission-button {
    display: inline-block; /* Ensures the buttons are treated as blocks for width */
    width: 100%; /* Makes both buttons take full width */
    padding: 10px; /* Same padding for both buttons */
    text-align: center; /* Center the text */
    background-color: #003366; /* Consistent background color */
    color: white; /* Text color */
    border: none; /* Remove borders */
    border-radius: 5px; /* Same border radius */
    cursor: pointer; /* Cursor change on hover */
    transition: background-color 0.3s; /* Transition for hover effect */
}

.admission-button {
    text-decoration: none; /* Remove underline from link */
}

.submit-button:hover, .admission-button:hover {
    background-color: #002244; /* Darker background on hover */
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background-color: #033683; /* Updated background color */
    animation: fadeIn 1s ease-in-out;
}

@keyframes fadeIn {
    from {
        opacity: 0;
    }

    to {
        opacity: 1;
    }
}

.login-container {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    height: 80%;
    flex-direction: column; /* Stack items vertically */
}

.login-box {
    background-color: #ffffff;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.1);
    text-align: center;
    width: 300px;
    box-shadow: 5px 5px 10px #888888;
    animation: fadeInBox 1s ease-in-out;
}

@keyframes fadeInBox {
    from {
        opacity: 0;
        transform: translateY(20px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.logo {
    width: 100px;
    margin-bottom: 15px;
    opacity: 0;
    animation: fadeInBox 1s ease-in-out forwards;
}

h1 {
    color: white; /* Change to white for visibility */
    margin-bottom: 20px;
    font-size: 24px;
}

h2 {
    color: #28282b;
    margin-bottom: 15px;
    font-size: 23px;
    opacity: 0;
    animation: fadeInBox 1s ease-in-out forwards;
}

.input-group {
    margin-bottom: 15px;
    text-align: left;
    opacity: 0;
    animation: fadeInBox 1s ease-in-out forwards;
    position: relative;
}

.input-group label {
    display: block;
    font-size: 14px;
    color: #333333;
    margin-bottom: 5px;
}

.input-group input {
    width: 100%;
    padding: 10px;
    border: 1px solid #dddddd;
    border-radius: 5px;
    transition: border-color 0.3s ease, box-shadow 0.3s ease;
}

.input-group input:focus {
    border-color: #003366;
    box-shadow: 0 0 5px rgba(0, 51, 102, 0.2);
}

.input-group button {
    width: 100%;
    padding: 10px;
    background-color: #003366;
    color: #ffffff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    transition: background-color 0.3s ease, transform 0.2s ease, box-shadow 0.2s ease;
}

.input-group button:hover {
    background-color: #002244;
    box-shadow: 0 4px 15px rgba(0, 34, 68, 0.2);
}

.input-group button:active {
    transform: scale(0.98);
}

.footer {
    margin-top: 20px;
    font-size: 12px;
    color: #777;
    opacity: 0;
    animation: fadeInBox 1s ease-in-out forwards;
}

.footer a {
    color: #003366;
    text-decoration: none;
}

.footer a:hover {
    color: #002244;
}
    </style>   
</body>

</html>
