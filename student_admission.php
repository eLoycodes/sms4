<?php
include("connect.php");
session_start();

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get fields with unique names
    $firstname = $_POST['firstname'] ?? '';
    $middlename = $_POST['middlename'] ?? '';
    $lastname = $_POST['lastname'] ?? '';
    $email = $_POST['email'] ?? '';
    $course = $_POST['course'] ?? '';
    $yearlevel = $_POST['yearlevel'] ?? '';
    $admissionType = $_POST['admissionType'] ?? '';

    // Additional fields for transferee
    $transferee_lastschool = $_POST['transferee_lastschool'] ?? '';
    $transferee_prevcourse = $_POST['transferee_prevcourse'] ?? '';
    $transferee_prevyear = $_POST['transferee_prevyear'] ?? '';

    // Additional fields for returnee
    $returnee_studentID = $_POST['returnee_studentID'] ?? '';

    // Debugging: Print POST data
    echo '<pre>';
    var_dump($_POST);
    echo '</pre>';

    // Handle different admission types
    if ($admissionType === "newRegular") {
        $stmt = $connect->prepare("INSERT INTO newstudent (firstname, middlename, lastname, email, course, yearlevel) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $firstname, $middlename, $lastname, $email, $course, $yearlevel);
        
        if ($stmt->execute()) {
            echo "New Regular Registration successful!";
        } else {
            echo "New Regular Registration failed: " . $stmt->error;
        }
        $stmt->close();
    } elseif ($admissionType === "transferee") {
        $datesubmitted = date('Y-m-d H:i:s'); // Current timestamp
        $status = NULL; // Default status
        $password = NULL; // Default password

        $stmt = $connect->prepare("INSERT INTO transferee (firstname, middlename, lastname, email, course, lastschool, prevcourse, prevyear, datesubmitted, status, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssssssss", $firstname, $middlename, $lastname, $email, $course, $transferee_lastschool, $transferee_prevcourse, $transferee_prevyear, $datesubmitted, $status, $password);
        
        if ($stmt->execute()) {
            echo "Transferee Registration successful!";
        } else {
            echo "Transferee Registration failed: " . $stmt->error;
        }
        $stmt->close();
    } elseif ($admissionType === "returnee") {
        $status = NULL; // Default status
        $password = NULL; // Default password

        $stmt = $connect->prepare("INSERT INTO returnee (studentID, firstname, middlename, lastname, email, course, yearlevel, status, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssssss", $returnee_studentID, $firstname, $middlename, $lastname, $email, $course, $yearlevel, $status, $password);
        
        if ($stmt->execute()) {
            echo "Returnee Registration successful!";
        } else {
            echo "Returnee Registration failed: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Invalid admission type.";
    }
}

// Close the connection
$connect->close();
?>
