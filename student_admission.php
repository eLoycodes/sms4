<?php
include("connect.php");
session_start();

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get fields
    $admissionType = $_POST['admissionType'] ?? '';
    $course = $_POST['course'] ?? '';

    // Debugging: Print POST data
    echo '<pre>';
    var_dump($_POST);
    echo '</pre>';

    // Handle new regular student registration
    if ($admissionType === "newRegular") {
        $firstname = $_POST['newRegular_firstname'] ?? '';
        $middlename = $_POST['newRegular_middlename'] ?? '';
        $lastname = $_POST['newRegular_lastname'] ?? '';
        $email = $_POST['newRegular_email'] ?? '';
        $yearlevel = $_POST['newRegular_yearlevel'] ?? '';

        $stmt = $connect->prepare("INSERT INTO newstudent (firstname, middlename, lastname, email, course, yearlevel) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $firstname, $middlename, $lastname, $email, $course, $yearlevel);
        if ($stmt->execute()) {
            echo "New Regular Registration successful!";
        } else {
            echo "New Regular Registration failed, please try again.";
        }
        $stmt->close();
    }

    // Handle transferee student registration
    elseif ($admissionType === "transferee") {
        $firstname = $_POST['transferee_firstname'] ?? '';
        $middlename = $_POST['transferee_middlename'] ?? '';
        $lastname = $_POST['transferee_lastname'] ?? '';
        $email = $_POST['transferee_email'] ?? '';
        $lastschool = $_POST['transferee_lastschool'] ?? '';
        $prevcourse = $_POST['transferee_prevcourse'] ?? '';
        $prevyear = $_POST['transferee_prevyear'] ?? '';
        $datesubmitted = date('Y-m-d H:i:s'); // Current timestamp
        $status = NULL; // Default status
        $password = NULL; // Default password

        $stmt = $connect->prepare("INSERT INTO transferee (firstname, middlename, lastname, email, course, lastschool, prevcourse, prevyear, datesubmitted, status, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssssssss", $firstname, $middlename, $lastname, $email, $course, $lastschool, $prevcourse, $prevyear, $datesubmitted, $status, $password);
        if ($stmt->execute()) {
            echo "Transferee Registration successful!";
        } else {
            echo "Transferee Registration failed, please try again.";
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
        $yearlevel = $_POST['returnee_yearlevel'] ?? '';
        $status = NULL; // Default status
        $password = NULL; // Default password

        $stmt = $connect->prepare("INSERT INTO returnee (studentID, firstname, middlename, lastname, email, course, yearlevel, status, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssssss", $studentID, $firstname, $middlename, $lastname, $email, $course, $yearlevel, $status, $password);
        if ($stmt->execute()) {
            echo "Returnee Registration successful!";
        } else {
            echo "Returnee Registration failed, please try again.";
        }
        $stmt->close();
    } else {
        echo "Invalid admission type.";
    }

    // Close the connection
    $connect->close(); 
}
?>
