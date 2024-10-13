<?php
session_start();

if (!isset($_SESSION["id"])) {
    header("Location: adminDashboard.php?mes=Access Denied..");
    exit();
}

// Page content here
?>
