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


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #033683; 
            color: white;
        }
        .form-control {
            background-color: white;
            color: black;
        }
        .hidden { display: none; }
        h1, h2 {
            color: white;
        }
        .btn-primary {
            background-color: white;
            color: black;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Bestlink College of the Philippines</h1>
        <form id="registrationForm" method="POST" action="studentadmission.php">
            <div class="form-group">
                <label for="course">Course:</label>
                <input type="text" id="course" class="form-control" name="course" readonly>
            </div>
            <div class="form-group">
                <label for="admissionType">Admission Type:</label>
                <select id="admissionType" class="form-control" name="admissionType" onchange="showFields()">
                    <option value="">Select Admission Type</option>
                    <option value="newRegular">New Regular</option>
                    <option value="transferee">Transferee</option>
                    <option value="returnee">Returnee</option>
                </select>
            </div>

            <div id="newRegularFields" class="hidden">
                <h2>New Regular Student</h2>
                <div class="form-group">
                    <label for="newRegular_firstname">First Name:</label>
                    <input type="text" id="newRegular_firstname" class="form-control" name="firstname" required>
                </div>
                <div class="form-group">
                    <label for="newRegular_middlename">Middle Name:</label>
                    <input type="text" id="newRegular_middlename" class="form-control" name="middlename">
                </div>
                <div class="form-group">
                    <label for="newRegular_lastname">Last Name:</label>
                    <input type="text" id="newRegular_lastname" class="form-control" name="lastname" required>
                </div>
                <div class="form-group">
                    <label for="newRegular_email">Email:</label>
                    <input type="email" id="newRegular_email" class="form-control" name="email" required>
                </div>
                <div class="form-group">
                    <label for="newRegular_yearlevel">Year Level:</label>
                    <select id="newRegular_yearlevel" class="form-control" name="yearlevel">
                        <option value="1st">1st</option>
                    </select>
                </div>
            </div>

            <div id="transfereeFields" class="hidden">
                <h2>Transferee Student</h2>
                <div class="form-group">
                    <label for="transferee_firstname">First Name:</label>
                    <input type="text" id="transferee_firstname" class="form-control" name="firstname" required>
                </div>
                <div class="form-group">
                    <label for="transferee_middlename">Middle Name:</label>
                    <input type="text" id="transferee_middlename" class="form-control" name="middlename">
                </div>
                <div class="form-group">
                    <label for="transferee_lastname">Last Name:</label>
                    <input type="text" id="transferee_lastname" class="form-control" name="lastname" required>
                </div>
                <div class="form-group">
                    <label for="transferee_email">Email:</label>
                    <input type="email" id="transferee_email" class="form-control" name="email" required>
                </div>
                <div class="form-group">
                    <label for="transferee_lastschool">Last School:</label>
                    <input type="text" id="transferee_lastschool" class="form-control" name="transferee_lastschool" required>
                </div>
                <div class="form-group">
                    <label for="transferee_prevcourse">Previous Course:</label>
                    <input type="text" id="transferee_prevcourse" class="form-control" name="transferee_prevcourse" required>
                </div>
                <div class="form-group">
                    <label for="transferee_prevyear">Previous Year:</label>
                    <select id="transferee_prevyear" class="form-control" name="transferee_prevyear">
                        <option value="1st">1st</option>
                        <option value="2nd">2nd</option>
                        <option value="3rd">3rd</option>
                        <option value="4th">4th</option>
                    </select>
                </div>
            </div>

            <div id="returneeFields" class="hidden">
                <h2>Returnee Student</h2>
                <div class="form-group">
                    <label for="returnee_studentID">Previous Student ID:</label>
                    <input type="text" id="returnee_studentID" class="form-control" name="returnee_studentID" required>
                </div>
                <div class="form-group">
                    <label for="returnee_firstname">First Name:</label>
                    <input type="text" id="returnee_firstname" class="form-control" name="firstname" required>
                </div>
                <div class="form-group">
                    <label for="returnee_middlename">Middle Name:</label>
                    <input type="text" id="returnee_middlename" class="form-control" name="middlename">
                </div>
                <div class="form-group">
                    <label for="returnee_lastname">Last Name:</label>
                    <input type="text" id="returnee_lastname" class="form-control" name="lastname" required>
                </div>
                <div class="form-group">
                    <label for="returnee_email">Email:</label>
                    <input type="email" id="returnee_email" class="form-control" name="email" required>
                </div>
                <div class="form-group">
                    <label for="returnee_yearlevel">Year Level:</label>
                    <select id="returnee_yearlevel" class="form-control" name="yearlevel">
                        <option value="1st">1st</option>
                        <option value="2nd">2nd</option>
                        <option value="3rd">3rd</option>
                        <option value="4th">4th</option>
                    </select>
                </div>
            </div>
            <button  class="btn btn-primary">Submit</button>
        </form>
    </div>

    <script>
        // Get course from URL
        const urlParams = new URLSearchParams(window.location.search);
        const course = urlParams.get('course');
        document.getElementById('course').value = course;

        function showFields() {
            const admissionType = document.getElementById("admissionType").value;
            document.getElementById("newRegularFields").classList.add("hidden");
            document.getElementById("transfereeFields").classList.add("hidden");
            document.getElementById("returneeFields").classList.add("hidden");

            if (admissionType === "newRegular") {
                document.getElementById("newRegularFields").classList.remove("hidden");
            } else if (admissionType === "transferee") {
                document.getElementById("transfereeFields").classList.remove("hidden");
            } else if (admissionType === "returnee") {
                document.getElementById("returneeFields").classList.remove("hidden");
            }
        }
    </script>
</body>
</html>
