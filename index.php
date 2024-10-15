<?php

include("connect.php");

session_start();
$username = $password = "";
$username_error = $password_error = "";
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
        $sql = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
        $res = $connect->query($sql);
        if ($res->num_rows > 0) {
            $ro = $res->fetch_assoc();
            $_SESSION["id"] = $ro["id"];
            $_SESSION["username"] = $ro["username"];
            $_SESSION["password"] = $ro["password"];

            echo "<script>
                alert('Successfully Login');
            </script>";
            echo "<script>window.open('adminDashboard.php','_self');</script>";
        }
    }
}

if (isset($_GET["mes"])) {
    echo "<div class='error'>{$_GET["mes"]}</div>";
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
        <h1>Bestlink College of the Philippines</h1><br>
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
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password">
                    <span class='error'><?php echo $password_error; ?></span>
                </div>
                <div class="input-group">
                    <button type="submit" class="submit-button" name="submit">Sign in</button>
                    <br><br>
                    <a href="option.php" class="submit-button">Student Admission</a>
                </div>
            </form>
        </div>
    </div>
<style>
    
.error {
    color: red;
    text-align: center;
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
    width: 280px;
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
