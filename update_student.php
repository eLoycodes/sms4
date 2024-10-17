<?php
include("connect.php");
ini_set('session.cookie_httponly', 1);
ini_set('session.cookie_secure', 1);
ini_set('session.use_only_cookies', 1);
session_start();

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_SESSION["id"])) {
    echo "<script>window.open('index.php?mes=Access Denied..','_self');</script>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    // Use null coalescing operator to avoid undefined index warnings
    $studentID = isset($_POST['studentID']) ? trim($_POST['studentID']) : '';
    $firstname = isset($_POST['firstname']) ? trim($_POST['firstname']) : '';
    $middlename = isset($_POST['middlename']) ? trim($_POST['middlename']) : '';
    $lastname = isset($_POST['lastname']) ? trim($_POST['lastname']) : '';
    $course = isset($_POST['course']) ? trim($_POST['course']) : '';
    $yearlevel = isset($_POST['yearlevel']) ? trim($_POST['yearlevel']) : '';
    $academicyear = isset($_POST['academicyear']) ? trim($_POST['academicyear']) : '';
    $semester = isset($_POST['semester']) ? trim($_POST['semester']) : '';
    $studenttype = isset($_POST['studenttype']) ? trim($_POST['studenttype']) : '';
    $status = isset($_POST['status']) ? trim($_POST['status']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';

    // Check for empty fields
    if (empty($studentID) || empty($firstname) || empty($middlename) || empty($lastname) || empty($course) || empty($yearlevel) || empty($academicyear) || empty($semester) || empty($studenttype) || empty($status) || empty($password)) {
        echo "All fields are required.";
        exit;
    }

    error_log("Student ID being searched: $studentID");

    // Retrieve email from newstudent, transferee, and returnee tables
    $email_tables = ['newstudent', 'transferee', 'returnee'];
    $email = null;

    foreach ($email_tables as $table) {
        $email_sql = "SELECT email FROM $table WHERE studentID = ?";
        if ($email_stmt = $connect->prepare($email_sql)) {
            $email_stmt->bind_param('s', $studentID);
            $email_stmt->execute();
            $email_stmt->bind_result($email_result);
            $email_stmt->fetch();
            $email_stmt->close();

            if ($email_result) {
                $email = $email_result;
                break; // Exit the loop if email is found
            }
        }
    }

    if ($email) {
        error_log("Email found: $email");
    } else {
        error_log("No email found for student ID: $studentID");
    }

    // Hash the password before storing it
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Existing logic for updating/moving student records
    $tables = ['firstyear', 'secondyear', 'thirdyear', 'forthyear', 'deactivate', 'deactivated', 'returnee'];
    $current_table = '';
    $updated = false;

    foreach ($tables as $table) {
        $check_sql = "SELECT * FROM $table WHERE studentID = ?";
        if ($check_stmt = $connect->prepare($check_sql)) {
            $check_stmt->bind_param('s', $studentID);
            error_log("Executing query: $check_sql with studentID: $studentID");
            $check_stmt->execute();
            $check_result = $check_stmt->get_result();

            error_log("Found " . $check_result->num_rows . " records in table: $table");

            if ($check_result && $check_result->num_rows > 0) {
                error_log("Found student ID in table: $table");
                $current_table = $table; 

                $insert_table = '';
                switch (trim($yearlevel)) {
                    case '4th':
                        $insert_table = 'forthyear';
                        break;
                    case '3rd':
                        $insert_table = 'thirdyear';
                        break;
                    case '2nd':
                        $insert_table = 'secondyear';
                        break;
                    case '1st':
                        $insert_table = 'firstyear';
                        break;
                    default:
                        echo "Invalid year level specified.";
                        error_log("Invalid year level: $yearlevel");
                        exit;
                }

                // If the student is being updated in the same table
                if ($current_table === $insert_table) {
                    // Update the existing record
                    $update_sql = "UPDATE $current_table SET firstname = ?, middlename = ?, lastname = ?, course = ?, yearlevel = ?, academicyear = ?, semester = ?, studenttype = ?, status = ?, password = ? WHERE studentID = ?";
                    if ($update_stmt = $connect->prepare($update_sql)) {
                        $update_stmt->bind_param('sssssssssss', $firstname, $middlename, $lastname, $course, $yearlevel, $academicyear, $semester, $studenttype, $status, $hashed_password, $studentID);
                        if ($update_stmt->execute()) {
                            echo "Student data updated successfully.";
                            echo "<script>alert('Student data updated successfully.');</script>";
                            echo "<script>window.open('admin-AddStudent-edit.php','_self');</script>";
                            $updated = true;
                        } else {
                            echo "Error updating record in $current_table: " . $update_stmt->error;
                        }
                        $update_stmt->close();
                    } else {
                        echo "Error preparing update statement for $current_table: " . $connect->error;
                    }
                } else {
                    // Insert into the new table
                    $insert_sql = "INSERT INTO $insert_table (studentID, firstname, middlename, lastname, course, yearlevel, academicyear, semester, studenttype, status, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                    error_log("Inserting into table for year level: '$insert_table'");

                    if ($insert_stmt = $connect->prepare($insert_sql)) {
                        $insert_stmt->bind_param('issssssssss', $studentID, $firstname, $middlename, $lastname, $course, $yearlevel, $academicyear, $semester, $studenttype, $status, $hashed_password);
                        if ($insert_stmt->execute()) {
                            $delete_sql = "DELETE FROM $current_table WHERE studentID = ?";
                            if ($delete_stmt = $connect->prepare($delete_sql)) {
                                $delete_stmt->bind_param('s', $studentID);
                                if ($delete_stmt->execute()) {
                                    echo "Student data moved successfully to $insert_table.";
                                    echo "<script>alert('Student data moved successfully.');</script>";
                                    echo "<script>window.open('admin-AddStudent-edit.php','_self');</script>";
                                    $updated = true;
                                } else {
                                    echo "Error deleting record from $current_table: " . $delete_stmt->error;
                                }
                                $delete_stmt->close();
                            } else {
                                echo "Error preparing delete statement for $current_table: " . $connect->error;
                            }
                        } else {
                            echo "Error inserting record into new table: " . $insert_stmt->error;
                        }
                        $insert_stmt->close();
                    } else {
                        echo "Error preparing insert statement for new table: " . $connect->error;
                    }
                }
                break; 
            }
            $check_stmt->close();
        }
    }

    if (!$updated) {
        echo "No records updated. Student ID not found in any table.";
    }
}
?>
