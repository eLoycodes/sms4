<?php
include("connect.php");
session_start();

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_SESSION["id"]) || $_SESSION["type"] !== "admin") {
    header("Location: index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get common fields
    var_dump($_POST);
    $course = $_POST['course'] ?? '';
    $admissionType = $_POST['admissionType'] ?? '';

    // Debugging output
     

    if ($admissionType === "newRegular") {
        $firstname = $_POST['newRegular_firstname'] ?? '';
        $middlename = $_POST['newRegular_middlename'] ?? '';
        $lastname = $_POST['newRegular_lastname'] ?? '';
        $email = $_POST['newRegular_email'] ?? '';
        $yearlevel = $_POST['newRegular_yearlevel'] ?? '';

        // Insert the new regular student data into the database
        $sql = "INSERT INTO newstudent (firstname, middlename, lastname, email, course, yearlevel) 
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $connect->prepare($sql);
        $stmt->bind_param("ssssss", $firstname, $middlename, $lastname, $email, $course, $yearlevel);
        
    } elseif ($admissionType === "transferee") {
        $firstname = $_POST['transferee_firstname'] ?? '';
        $middlename = $_POST['transferee_middlename'] ?? '';
        $lastname = $_POST['transferee_lastname'] ?? '';
        $email = $_POST['transferee_email'] ?? '';
        $lastschool = $_POST['transferee_lastschool'] ?? '';
        $prevcourse = $_POST['transferee_prevcourse'] ?? '';
        $prevyear = $_POST['transferee_prevyear'] ?? '';

        // Insert the transferee data into the database
        $sql = "INSERT INTO transferee (firstname, middlename, lastname, email, course, lastschool, prevcourse, prevyear, status, password) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'Active', 'Active')";
        $stmt = $connect->prepare($sql);
        $stmt->bind_param("ssssssss", $firstname, $middlename, $lastname, $email, $course, $lastschool, $prevcourse, $prevyear);
        
    } elseif ($admissionType === "returnee") {
        $studentID = $_POST['returnee_studentID'] ?? '';
        $firstname = $_POST['returnee_firstname'] ?? '';
        $middlename = $_POST['returnee_middlename'] ?? '';
        $lastname = $_POST['returnee_lastname'] ?? '';
        $email = $_POST['returnee_email'] ?? '';
        $yearlevel = $_POST['returnee_yearlevel'] ?? '';

        // Insert the returnee data into the database
        $sql = "INSERT INTO returnee (studentID, firstname, middlename, lastname, email, course, yearlevel, status, password) 
                VALUES (?, ?, ?, ?, ?, ?, ?, 'Active', 'Active')";
        $stmt = $connect->prepare($sql);
        $stmt->bind_param("sssssss", $studentID, $firstname, $middlename, $lastname, $email, $course, $yearlevel);
    } else {
        echo "Invalid admission type.";
        exit();
    }

    // Execute the SQL query
    if ($stmt->execute()) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $connect->close();
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
    </div>
   <?php exit; ?>
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
