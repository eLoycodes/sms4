<?php
include("connect.php");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
$username = $password = "";
$username_error = $password_error = "";
$user_type = ""; // Para malaman kung admin o student

if (isset($_POST['submit'])) {
    if (empty($_POST["username"])) {
        $username_error = "Username is Required!";
    } else {
        $username = $_POST["username"];
    }

    if (empty($_POST["password"])) {
        $password_error = "Password is Required!";
    } else {
        $password = $_POST["password"];
    }

    if (empty($username_error) && empty($password_error)) {
        // Una, tingnan kung admin (dapat may @gmail.com)
        if (strpos($username, '@gmail.com') !== false) {
            $sql = "SELECT * FROM admin WHERE username='$username'";
            $res = $connect->query($sql);
            if ($res->num_rows > 0) {
                $ro = $res->fetch_assoc();
                // Directly compare passwords
                if ($password === $ro["password"]) {
                    $_SESSION["id"] = $ro["id"];
                    $_SESSION["username"] = $ro["username"];
                    $_SESSION["type"] = "admin";
                    echo "<script>alert('Successfully Logged In as Admin');</script>";
                    echo "<script>window.open('adminDashboard.php','_self');</script>";
                    exit();
                }
            }
        }
        // tingnan kung student (dapat may s)
        if (strpos($username, 'studentID') === 0) {
            $sql = "
                SELECT firstyear_id AS id, studentID, password FROM firstyear WHERE studentID='$username'
                UNION ALL
                SELECT secondyear_id AS id, studentID, password FROM secondyear WHERE studentID='$username'
                UNION ALL
                SELECT thirdyear_id AS id, studentID, password FROM thirdyear WHERE studentID='$username'
                UNION ALL
                SELECT forthyear_id AS id, studentID, password FROM forthyear WHERE studentID='$username'
                UNION ALL
                SELECT deactivate_id AS id, studentID, password FROM deactivate WHERE studentID='$username'
                UNION ALL
                SELECT deactivated_id AS id, studentID, password FROM deactivated WHERE studentID='$username'
                UNION ALL
                SELECT returnee_id AS id, studentID, password FROM returnee WHERE studentID='$username'";
        
            $res = $connect->query($sql);
            if ($res->num_rows > 0) {
                $ro = $res->fetch_assoc();
                // Directly compare passwords
                if ($password === $ro["password"]) {
                    $_SESSION["id"] = $ro["id"];
                    $_SESSION["studentID"] = $ro["studentID"];
                    $_SESSION["type"] = "student";
                    echo "<script>alert('Successfully Logged In as Student');</script>";
                    echo "<script>window.open('studentDashboard.php','_self');</script>";
                    exit();
                }
            }
        }
        
        // Kung walang match, mag-error
        echo "<script>alert('Invalid Username or Password');</script>";
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
                <label for="username">Email or Student ID</label>
                <input type="text" id="username" name="username" required>
                <span class='error'><?php echo $username_error; ?></span>
            </div>
            <div class="input-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
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

.input-group {
    position: relative; /* Position relative for absolute positioning of checkbox */
}

input[type="password"] {
    padding-right: 40px; /* Add padding to the right to make space for the checkbox */
}

.show-password {
    position: absolute; /* Position the checkbox absolutely */
    right: 10px; /* Position it to the right inside the input */
    top: 70%; /* Align it vertically */
    transform: translateY(-50%); /* Center the checkbox vertically */
    display: flex; /* Use flexbox for centering */
    align-items: center; /* Center checkbox vertically */
}

input[type="checkbox"] {
    cursor: pointer; /* Change cursor to pointer when hovering over checkbox */
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
