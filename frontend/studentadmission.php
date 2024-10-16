<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration Form</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #033683; /* Background color */
            color: white; /* Default text color */
        }
        .form-control {
            background-color: white; /* Input field background color */
            color: black; /* Input field text color */
        }
        .hidden { display: none; }
        h1, h2 {
            color: white; /* Heading color */
        }
        .btn-primary {
            background-color: white;
            color: black;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Student Registration Form</h1>
        <form id="registrationForm">
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
                    <label for="firstName">First Name:</label>
                    <input type="text" id="firstName" class="form-control" name="firstName" required>
                </div>
                <div class="form-group">
                    <label for="middleName">Middle Name:</label>
                    <input type="text" id="middleName" class="form-control" name="middleName">
                </div>
                <div class="form-group">
                    <label for="lastName">Last Name:</label>
                    <input type="text" id="lastName" class="form-control" name="lastName" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" class="form-control" name="email" required>
                </div>
                <div class="form-group">
                    <label for="yearLevel">Year Level:</label>
                    <select id="yearLevel" class="form-control" name="yearLevel">
                        <option value="1st">1st</option>
                    </select>
                </div>
            </div>

            <div id="transfereeFields" class="hidden">
                <h2>Transferee Student</h2>
                <div class="form-group">
                    <label for="firstNameTrans">First Name:</label>
                    <input type="text" id="firstNameTrans" class="form-control" name="firstNameTrans" required>
                </div>
                <div class="form-group">
                    <label for="middleNameTrans">Middle Name:</label>
                    <input type="text" id="middleNameTrans" class="form-control" name="middleNameTrans">
                </div>
                <div class="form-group">
                    <label for="lastNameTrans">Last Name:</label>
                    <input type="text" id="lastNameTrans" class="form-control" name="lastNameTrans" required>
                </div>
                <div class="form-group">
                    <label for="emailTrans">Email:</label>
                    <input type="email" id="emailTrans" class="form-control" name="emailTrans" required>
                </div>
                <div class="form-group">
                    <label for="lastSchool">Last School:</label>
                    <input type="text" id="lastSchool" class="form-control" name="lastSchool" required>
                </div>
                <div class="form-group">
                    <label for="previousCourse">Previous Course:</label>
                    <input type="text" id="previousCourse" class="form-control" name="previousCourse" required>
                </div>
                <div class="form-group">
                    <label for="previousYear">Previous Year:</label>
                    <select id="previousYear" class="form-control" name="previousYear">
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
                    <label for="previousStudentId">Previous Student ID:</label>
                    <input type="text" id="previousStudentId" class="form-control" name="previousStudentId" required>
                </div>
                <div class="form-group">
                    <label for="firstNameRet">First Name:</label>
                    <input type="text" id="firstNameRet" class="form-control" name="firstNameRet" required>
                </div>
                <div class="form-group">
                    <label for="middleNameRet">Middle Name:</label>
                    <input type="text" id="middleNameRet" class="form-control" name="middleNameRet">
                </div>
                <div class="form-group">
                    <label for="lastNameRet">Last Name:</label>
                    <input type="text" id="lastNameRet" class="form-control" name="lastNameRet" required>
                </div>
                <div class="form-group">
                    <label for="emailRet">Email:</label>
                    <input type="email" id="emailRet" class="form-control" name="emailRet" required>
                </div>
                <div class="form-group">
                    <label for="yearLevelRet">Year Level:</label>
                    <select id="yearLevelRet" class="form-control" name="yearLevelRet">
                        <option value="1st">1st</option>
                        <option value="2nd">2nd</option>
                        <option value="3rd">3rd</option>
                        <option value="4th">4th</option>
                    </select>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
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
