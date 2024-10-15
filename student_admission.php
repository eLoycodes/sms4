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
            // Prepare the SQL statement with correct field names
            $stmt = $connect->prepare("INSERT INTO newstudent (firstname, middlename, lastname, email, course, yearlevel) VALUES (?, ?, ?, ?, ?, ?)");

            // Execute the statement with provided data
            $stmt->execute([$firstname, $middlename, $lastname, $email, $course, $yearlevel]);

            // Check if the registration was successful
            if ($stmt->rowCount() > 0) {
                echo "Registration successful!";
            } else {
                echo "Registration failed, please try again.";
            }
        } else {
            echo "Invalid admission type.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    // Close the connection
    $connect = null; 
}
?>
