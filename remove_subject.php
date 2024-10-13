<?php
include('connect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $studentID = $_POST['studentID'];
    $subjectCode = $_POST['subjectcode'];

    $fetchQuery = "SELECT subjectname, semester FROM student_subjects WHERE studentID = ? AND subjectcode = ?";
    $fetchStmt = $connect->prepare($fetchQuery);
    $fetchStmt->bind_param('is', $studentID, $subjectCode);
    $fetchStmt->execute();
    $fetchResult = $fetchStmt->get_result();

    if ($fetchResult->num_rows > 0) {
        $subject = $fetchResult->fetch_assoc();
        $subjectName = $subject['subjectname'];
        $semester = $subject['semester'];

        $stmt = $connect->prepare("DELETE FROM student_subjects WHERE studentID = ? AND subjectcode = ?");
        $stmt->bind_param('is', $studentID, $subjectCode);
        $stmt->execute();

        $insertStmt = $connect->prepare("INSERT INTO subject_removed (studentID, subjectcode, subjectname, semester) VALUES (?, ?, ?, ?)");
        $insertStmt->bind_param('isss', $studentID, $subjectCode, $subjectName, $semester);
        $insertStmt->execute();

        if ($stmt->affected_rows > 0) {
            echo "Subject removed successfully.";
        } else {
            echo "Error removing subject.";
        }
    } else {
        echo "Subject not found.";
    }

    // Close statements
    $fetchStmt->close();
    $stmt->close();
    $insertStmt->close();
}

$connect->close();
?>
