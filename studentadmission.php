<?php
// Initialize variables
$course = $admissionType = $firstname = $middlename = $lastname = $email = $yearlevel = '';
$lastschool = $prevcourse = $prevyear = $studentID = '';

// Process form when submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $course = htmlspecialchars($_POST['course']);
    $admissionType = htmlspecialchars($_POST['admissionType']);
    
    // Common fields
    $firstname = htmlspecialchars($_POST[$admissionType . '_firstname']);
    $middlename = htmlspecialchars($_POST[$admissionType . '_middlename']);
    $lastname = htmlspecialchars($_POST[$admissionType . '_lastname']);
    $email = htmlspecialchars($_POST[$admissionType . '_email']);
    $yearlevel = htmlspecialchars($_POST[$admissionType . '_yearlevel']);
    
    // Specific fields based on admission type
    if ($admissionType == 'transferee') {
        $lastschool = htmlspecialchars($_POST['transferee_lastschool']);
        $prevcourse = htmlspecialchars($_POST['transferee_prevcourse']);
        $prevyear = htmlspecialchars($_POST['transferee_prevyear']);
    } elseif ($admissionType == 'returnee') {
        $studentID = htmlspecialchars($_POST['returnee_studentID']);
    }

    // Here, you would typically insert the data into a database
    // For demonstration, we'll just echo the values
    echo "<h2>Registration Successful!</h2>";
    echo "<p>Course: $course</p>";
    echo "<p>Admission Type: $admissionType</p>";
    echo "<p>Name: $firstname $middlename $lastname</p>";
    echo "<p>Email: $email</p>";
    echo "<p>Year Level: $yearlevel</p>";

    if ($admissionType == 'transferee') {
        echo "<p>Last School: $lastschool</p>";
        echo "<p>Previous Course: $prevcourse</p>";
        echo "<p>Previous Year: $prevyear</p>";
    } elseif ($admissionType == 'returnee') {
        echo "<p>Previous Student ID: $studentID</p>";
    }
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
        <form id="registrationForm" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                <label for="course">Course:</label>
                <input type="text" id="course" class="form-control" name="course" value="<?php echo htmlspecialchars($_GET['course'] ?? ''); ?>" readonly>
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
                <h2>Transferee Student</h2>
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
                    <select id="returnee_yearlevel" class="form-control" name="returnee_yearlevel" required>
                        <option value="1st">1st</option>
                        <option value="2nd">2nd</option>
                        <option value="3rd">3rd</option>
                        <option value="4th">4th</option>
                    </select>
                </div>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
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
