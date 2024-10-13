<?php
include('connect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $studentID = $_POST['studentID'];
    $subjects = $_POST['subjects'] ?? [];

    if (!empty($subjects)) {
        foreach ($subjects as $subjectCode) {
            // Fetch the subject details based on the subject code
            $stmt = $connect->prepare("SELECT subjectname, semester FROM subject WHERE subjectcode = ?");
            $stmt->bind_param('s', $subjectCode);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($row = $result->fetch_assoc()) {
                $subjectname = $row['subjectname'];
                $semester = $row['semester'];

                // Now insert into student_subjects
                $insertStmt = $connect->prepare("INSERT INTO student_subjects (studentID, subjectcode, subjectname, semester) VALUES (?, ?, ?, ?)");
                $insertStmt->bind_param('isss', $studentID, $subjectCode, $subjectname, $semester);
                $insertStmt->execute();
            } else {
                echo "Subject code {$subjectCode} not found.";
            }
        }
        echo "Subjects added successfully.";
    } else {
        echo "No subjects selected.";
    }
}
?>
