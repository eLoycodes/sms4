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
        switch ($admissionType) {
            case "newRegular":
                $stmt = $connect->prepare("INSERT INTO newstudent (firstname, middlename, lastname, email, course, yearlevel) VALUES (?, ?, ?, ?, ?, ?)");
                echo "Executing: " . $stmt->queryString . "<br>"; // Debugging
                $stmt->execute([$firstname, $middlename, $lastname, $email, $course, $yearlevel]);
                break;

            case "transferee":
                $lastschool = $_POST['transferee_lastschool'] ?? '';
                $prevcourse = $_POST['transferee_prevcourse'] ?? '';
                $prevyear = $_POST['transferee_prevyear'] ?? '';

                $stmt = $connect->prepare("INSERT INTO transferee (firstname, middlename, lastname, email, course, lastschool, prevcourse, prevyear) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                echo "Executing: " . $stmt->queryString . "<br>"; // Debugging
                $stmt->execute([$firstname, $middlename, $lastname, $email, $course, $lastschool, $prevcourse, $prevyear]);
                break;

            case "returnee":
                $studentID = $_POST['returnee_studentID'] ?? '';

                $stmt = $connect->prepare("INSERT INTO returnee (studentID, firstname, middlename, lastname, email, course, yearlevel) VALUES (?, ?, ?, ?, ?, ?, ?)");
                echo "Executing: " . $stmt->queryString . "<br>"; // Debugging
                $stmt->execute([$studentID, $firstname, $middlename, $lastname, $email, $course, $yearlevel]);
                break;

            default:
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
