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
        <input type="text" id="course" class="form-control" name="course" value="<?php echo htmlspecialchars($_GET['course']); ?>" readonly>
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
        <h3>New Regular Student</h3>
        <div class="form-group">
            <label for="newRegular_firstname">First Name:</label>
            <input type="text" id="newRegular_firstname" class="form-control" name="newRegular_firstname" required>
        </div>
        <div class="form-group">
            <label for="newRegular_middlename">Middle Name:</label>
            <input type="text" id="newRegular_middlename" class="form-control" name="newRegular_middlename">
        </div>
        <div class="form-group">
            <label for="newRegular_lastname">Last Name:</label>
            <input type="text" id="newRegular_lastname" class="form-control" name="newRegular_lastname" required>
        </div>
        <div class="form-group">
            <label for="newRegular_email">Email:</label>
            <input type="email" id="newRegular_email" class="form-control" name="newRegular_email" required>
        </div>
        <div class="form-group">
            <label for="newRegular_yearlevel">Year Level:</label>
            <select id="newRegular_yearlevel" class="form-control" name="newRegular_yearlevel">
                <option value="1st">1st</option>
            </select>
        </div>
    </div>

    <div id="transfereeFields" class="hidden">
        <h3>Transferee Student</h3>
        <div class="form-group">
            <label for="transferee_firstname">First Name:</label>
            <input type="text" id="transferee_firstname" class="form-control" name="transferee_firstname" required>
        </div>
        <div class="form-group">
            <label for="transferee_middlename">Middle Name:</label>
            <input type="text" id="transferee_middlename" class="form-control" name="transferee_middlename">
        </div>
        <div class="form-group">
            <label for="transferee_lastname">Last Name:</label>
            <input type="text" id="transferee_lastname" class="form-control" name="transferee_lastname" required>
        </div>
        <div class="form-group">
            <label for="transferee_email">Email:</label>
            <input type="email" id="transferee_email" class="form-control" name="transferee_email" required>
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
        <h3>Returnee Student</h3>
        <div class="form-group">
            <label for="returnee_studentID">Previous Student ID:</label>
            <input type="text" id="returnee_studentID" class="form-control" name="returnee_studentID" required>
        </div>
        <div class="form-group">
            <label for="returnee_firstname">First Name:</label>
            <input type="text" id="returnee_firstname" class="form-control" name="returnee_firstname" required>
        </div>
        <div class="form-group">
            <label for="returnee_middlename">Middle Name:</label>
            <input type="text" id="returnee_middlename" class="form-control" name="returnee_middlename">
        </div>
        <div class="form-group">
            <label for="returnee_lastname">Last Name:</label>
            <input type="text" id="returnee_lastname" class="form-control" name="returnee_lastname" required>
        </div>
        <div class="form-group">
            <label for="returnee_email">Email:</label>
            <input type="email" id="returnee_email" class="form-control" name="returnee_email" required>
        </div>
        <div class="form-group">
            <label for="returnee_yearlevel">Year Level:</label>
            <select id="returnee_yearlevel" class="form-control" name="returnee_yearlevel">
                <option value="1st">1st</option>
                <option value="2nd">2nd</option>
                <option value="3rd">3rd</option>
                <option value="4th">4th</option>
            </select>
        </div>
    </div>

    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
</form>

<script>
 
    function showFields() {
        const admissionType = document.getElementById("admissionType").value;
        const fields = ["newRegularFields", "transfereeFields", "returneeFields"];
        
        // Hide all fields initially
        fields.forEach(field => {
            document.getElementById(field).classList.add("hidden");
        });

        // Show the relevant field based on admission type
        if (admissionType === "newRegular") {
            document.getElementById("newRegularFields").classList.remove("hidden");
        } else if (admissionType === "transferee") {
            document.getElementById("transfereeFields").classList.remove("hidden");
        } else if (admissionType === "returnee") {
            document.getElementById("returneeFields").classList.remove("hidden");
        }
    }

    // Validate form before submission
    document.getElementById("registrationForm").addEventListener("submit", function(event) {
        const admissionType = document.getElementById("admissionType").value;

        if (admissionType === "newRegular") {
            if (!document.getElementById("newRegular_firstname").value || 
                !document.getElementById("newRegular_lastname").value ||
                !document.getElementById("newRegular_email").value) {
                alert("Please fill in all required fields for New Regular.");
                event.preventDefault(); // Prevent form submission
            }
        } else if (admissionType === "transferee") {
            if (!document.getElementById("transferee_firstname").value || 
                !document.getElementById("transferee_lastname").value ||
                !document.getElementById("transferee_email").value ||
                !document.getElementById("transferee_lastschool").value ||
                !document.getElementById("transferee_prevcourse").value) {
                alert("Please fill in all required fields for Transferee.");
                event.preventDefault(); // Prevent form submission
            }
        } else if (admissionType === "returnee") {
            if (!document.getElementById("returnee_studentID").value || 
                !document.getElementById("returnee_firstname").value ||
                !document.getElementById("returnee_lastname").value ||
                !document.getElementById("returnee_email").value) {
                alert("Please fill in all required fields for Returnee.");
                event.preventDefault(); // Prevent form submission
            }
        }
    });



</script>

<style>
    .hidden {
        display: none;
    }
</style>


</body>
</html>
