<?php
include("connect.php");
session_start();

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check database connection
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get fields
    $admissionType = $_POST['admissionType'] ?? '';
    $message = ""; // Initialize message variable
    $redirect = "index.php"; // Set the redirect location

    // Handle new regular student registration
    if ($admissionType === "newRegular") {
        $firstname = $_POST['newRegular_firstname'] ?? '';
        $middlename = $_POST['newRegular_middlename'] ?? '';
        $lastname = $_POST['newRegular_lastname'] ?? '';
        $email = $_POST['newRegular_email'] ?? '';
        $course = $_POST['course'] ?? '';
        $yearlevel = $_POST['newRegular_yearlevel'] ?? '';

        $stmt = $connect->prepare("INSERT INTO newstudent (firstname, middlename, lastname, email, course, yearlevel) VALUES (?, ?, ?, ?, ?, ?)");
        if ($stmt === false) {
            die("Prepare failed: " . $connect->error);
        }

        $stmt->bind_param("ssssss", $firstname, $middlename, $lastname, $email, $course, $yearlevel);
        
        if ($stmt->execute()) {
            $message = "New Regular Registration successful!";
        } else {
            $message = "New Regular Registration failed: " . $stmt->error;
        }
        $stmt->close();
    }
    // Handle transferee student registration
    elseif ($admissionType === "transferee") {
        $firstname = $_POST['transferee_firstname'] ?? '';
        $middlename = $_POST['transferee_middlename'] ?? '';
        $lastname = $_POST['transferee_lastname'] ?? '';
        $email = $_POST['transferee_email'] ?? '';
        $course = $_POST['course'] ?? '';
        $lastschool = $_POST['transferee_lastschool'] ?? '';
        $prevcourse = $_POST['transferee_prevcourse'] ?? '';
        $prevyear = $_POST['transferee_prevyear'] ?? '';
        $datesubmitted = date('Y-m-d H:i:s'); // Current timestamp
        $status = NULL; // Default status
        $password = NULL; // Default password

        $stmt = $connect->prepare("INSERT INTO transferee (firstname, middlename, lastname, email, course, lastschool, prevcourse, prevyear, datesubmitted, status, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        if ($stmt === false) {
            die("Prepare failed: " . $connect->error);
        }

        $stmt->bind_param("sssssssssss", $firstname, $middlename, $lastname, $email, $course, $lastschool, $prevcourse, $prevyear, $datesubmitted, $status, $password);
        
        if ($stmt->execute()) {
            $message = "Transferee Registration successful!";
        } else {
            $message = "Transferee Registration failed: " . $stmt->error;
        }
        $stmt->close();
    }
    // Handle returnee student registration
    elseif ($admissionType === "returnee") {
        $studentID = $_POST['returnee_studentID'] ?? '';
        $firstname = $_POST['returnee_firstname'] ?? '';
        $middlename = $_POST['returnee_middlename'] ?? '';
        $lastname = $_POST['returnee_lastname'] ?? '';
        $email = $_POST['returnee_email'] ?? '';
        $course = $_POST['course'] ?? '';
        $yearlevel = $_POST['returnee_yearlevel'] ?? '';
        $status = NULL; // Default status
        $password = NULL; // Default password

        $stmt = $connect->prepare("INSERT INTO returnee (studentID, firstname, middlename, lastname, email, course, yearlevel, status, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        if ($stmt === false) {
            die("Prepare failed: " . $connect->error);
        }

        $stmt->bind_param("issssssss", $studentID, $firstname, $middlename, $lastname, $email, $course, $yearlevel, $status, $password);
        
        if ($stmt->execute()) {
            $message = "Returnee Registration successful!";
        } else {
            $message = "Returnee Registration failed: " . $stmt->error;
        }
        $stmt->close();
    } else {
        $message = "Invalid admission type.";
    }

    // Close the connection
    $connect->close(); 

    // Redirect to index.php with alert message
    echo "<script>alert('$message');</script>";
    echo "<script>window.open('$redirect', '_self');</script>";
    exit(); // Prevent further execution
}
?>
