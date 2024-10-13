<?php
session_start();
include("connect.php");

// Check if user is logged in
if (!isset($_SESSION["id"])) {
    header("Location: login.php?mes=Access Denied..");
    exit(); // Ensure to stop script execution
}

// Your protected content
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Protected Page</title>
</head>
<body>
    <h1>Welcome to the Protected Page</h1>
    <p>You have successfully accessed this page!</p>
    <p>Your User ID: <?php echo htmlspecialchars($_SESSION["id"]); ?></p>
    <a href="logout.php">Logout</a>
</body>
</html>
