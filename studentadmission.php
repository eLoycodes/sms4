<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Admission Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .hidden { display: none; }
    </style>
</head>
<body>
<div class="container">
    <h1>Student Admission Form</h1>
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
            <h2>New Regular Student</h2>
            <div class="form-group">
                <label for="newRegular_firstname">First Name:</label>
                <input type="text" id="newRegular_firstname" class="form-control" name="newRegular_firstname" required>
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
                    <option value="2nd">2nd</option>
                    <option value="3rd">3rd</option>
                    <option value="4th">4th</option>
                </select>
            </div>
        </div>

        <div id="transfereeFields" class="hidden">
            <h2>Transferee Student</h2>
            <div class="form-group">
                <label for="transferee_firstname">First Name:</label>
                <input type="text" id="transferee_firstname" class="form-control" name="transferee_firstname" required>
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
        </div>

        <div id="returneeFields" class="hidden">
            <h2>Returnee Student</h2>
            <div class="form-group">
                <label for="returnee_studentID">Previous Student ID:</label>
                <input type="text" id="returnee_studentID" class="form-control" name="returnee_studentID" required>
            </div>
            <div class="form-group">
                <label for="returnee_firstname">First Name:</label>
                <input type="text" id="returnee_firstname" class="form-control" name="returnee_firstname" required>
            </div>
            <div class="form-group">
                <label for="returnee_lastname">Last Name:</label>
                <input type="text" id="returnee_lastname" class="form-control" name="returnee_lastname" required>
            </div>
            <div class="form-group">
                <label for="returnee_email">Email:</label>
                <input type="email" id="returnee_email" class="form-control" name="returnee_email" required>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<script>
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
