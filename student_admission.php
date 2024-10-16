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
    // Debugging: Print POST data
    echo '<pre>';
    var_dump($_POST);
    echo '</pre>';

    // Get fields
    $admissionType = $_POST['admissionType'] ?? '';

    // Handle new regular student registration
    if ($admissionType === "newRegular") {
        $firstname = $_POST['newRegular_firstname'] ?? '';
        $lastname = $_POST['newRegular_lastname'] ?? '';
        $email = $_POST['newRegular_email'] ?? '';
        $course = $_POST['course'] ?? '';
        $yearlevel = $_POST['newRegular_yearlevel'] ?? '';

        $stmt = $connect->prepare("INSERT INTO newstudent (firstname, lastname, email, course, yearlevel) VALUES (?, ?, ?, ?, ?)");
        if ($stmt === false) {
            die("Prepare failed: " . $connect->error);
        }

        $stmt->bind_param("sssss", $firstname, $lastname, $email, $course, $yearlevel);
        
        if ($stmt->execute()) {
            echo "New Regular Registration successful!<br>";
        } else {
            echo "New Regular Registration failed: " . $stmt->error . "<br>";
        }
        $stmt->close();
    }

    // Handle transferee student registration
    elseif ($admissionType === "transferee") {
        $firstname = $_POST['transferee_firstname'] ?? '';
        $lastname = $_POST['transferee_lastname'] ?? '';
        $email = $_POST['transferee_email'] ?? '';
        $course = $_POST['course'] ?? '';
        $lastschool = $_POST['transferee_lastschool'] ?? '';

        $stmt = $connect->prepare("INSERT INTO transferee (firstname, lastname, email, course, lastschool) VALUES (?, ?, ?, ?, ?)");
        if ($stmt === false) {
            die("Prepare failed: " . $connect->error);
        }

        $stmt->bind_param("sssss", $firstname, $lastname, $email, $course, $lastschool);
        
        if ($stmt->execute()) {
            echo "Transferee Registration successful!<br>";
        } else {
            echo "Transferee Registration failed: " . $stmt->error . "<br>";
        }
        $stmt->close();
    }

    // Handle returnee student registration
    elseif ($admissionType === "returnee") {
        $studentID = $_POST['returnee_studentID'] ?? '';
        $firstname = $_POST['returnee_firstname'] ?? '';
        $lastname = $_POST['returnee_lastname'] ?? '';
        $email = $_POST['returnee_email'] ?? '';
        $course = $_POST['course'] ?? '';

        $stmt = $connect->prepare("INSERT INTO returnee (studentID, firstname, lastname, email, course) VALUES (?, ?, ?, ?, ?)");
        if ($stmt === false) {
            die("Prepare failed: " . $connect->error);
        }

        $stmt->bind_param("sssss", $studentID, $firstname, $lastname, $email, $course);
        
        if ($stmt->execute()) {
            echo "Returnee Registration successful!<br>";
        } else {
            echo "Returnee Registration failed: " . $stmt->error . "<br>";
        }
        $stmt->close();
    } else {
        echo "Invalid admission type.<br>";
    }

    // Close the connection
    $connect->close(); 
}
?>
