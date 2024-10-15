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

    // Debugging: Print POST data
    echo '<pre>';
    var_dump($_POST);
    echo '</pre>';
    
    try {
        // Focus on newRegular admission type
        if ($admissionType === "newRegular") {
            $stmt = $connect->prepare("INSERT INTO newstudent (firstname, middlename, lastname, email, course, yearlevel) VALUES (?, ?, ?, ?, ?, ?)");
            echo "Executing: " . $stmt->queryString . "<br>"; // Debugging
            $stmt->execute([$firstname, $middlename, $lastname, $email, $course, $yearlevel]);

            echo "Registration successful!";
        } else {
            echo "Invalid admission type.";
            exit();
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    $connect = null; // Close the connection
}
?>
