<?php
include("connect.php");
session_start();

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);
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
        <form id="registrationForm" method="POST" action="student_admission.php">
            <div class="form-group">
                <label for="course">Course:</label>
                <input type="text" id="course" class="form-control" name="course" value="<?php echo htmlspecialchars($student_ID['course'] ?? ''); ?>" readonly>
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

           
        
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
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
