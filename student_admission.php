<?php
include("connect.php");
session_start();

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get common fields
    $firstname = $_POST['firstname'] ?? '';
    $middlename = $_POST['middlename'] ?? '';
    $lastname = $_POST['lastname'] ?? '';
    $email = $_POST['email'] ?? '';
    $course = $_POST['course'] ?? '';
    $yearlevel = $_POST['yearlevel'] ?? '';
    $admissionType = $_POST['admissionType'] ?? '';

    try {
        if ($admissionType === "newRegular") {
            // Insert New Regular Student
            $stmt = $connect->prepare("INSERT INTO newstudent (firstname, middlename, lastname, email, course, yearlevel) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->execute([$firstname, $middlename, $lastname, $email, $course, $yearlevel]);

        } elseif ($admissionType === "transferee") {
            // Get transferee-specific fields
            $lastschool = $_POST['transferee_lastschool'] ?? '';
            $prevcourse = $_POST['transferee_prevcourse'] ?? '';
            $prevyear = $_POST['transferee_prevyear'] ?? '';

            // Insert Transferee Student
            $stmt = $connect->prepare("INSERT INTO transferee (firstname, middlename, lastname, email, course, lastschool, prevcourse, prevyear) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$firstname, $middlename, $lastname, $email, $course, $lastschool, $prevcourse, $prevyear]);

        } elseif ($admissionType === "returnee") {
            // Get returnee-specific fields
            $studentID = $_POST['returnee_studentID'] ?? '';

            // Insert Returnee Student
            $stmt = $connect->prepare("INSERT INTO returnee (studentID, firstname, middlename, lastname, email, course, yearlevel) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$studentID, $firstname, $middlename, $lastname, $email, $course, $yearlevel]);

        } else {
            echo "Invalid admission type.";
            exit();
        }

        echo "Registration successful!";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    $connect = null; // Close the connection
}
?>