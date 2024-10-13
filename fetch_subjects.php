<?php
include('connect.php'); 

if (isset($_GET['studentID'])) {
    $studentID = $_GET['studentID'];
    $s = "SELECT * FROM student_subjects WHERE studentID = ?";
    $stmt = $connect->prepare($s);
    $stmt->bind_param('s', $studentID);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res->num_rows > 0) {
        while ($r = $res->fetch_assoc()) {
            echo '<tr>
                    <td>' . htmlspecialchars($r['subjectcode']) . '</td>
                    <td>' . htmlspecialchars($r['subjectname']) . '</td>
                    <td>' . htmlspecialchars($r['semester']) . '</td>
                    <td>
                        <form method="POST" action="remove_subject.php" class="remove-form">
                            <input type="hidden" name="studentID" value="' . htmlspecialchars($studentID) . '">
                            <input type="hidden" name="subjectcode" value="' . htmlspecialchars($r['subjectcode']) . '">
                            <button type="submit">Remove</button>
                        </form>
                    </td>
                </tr>';
        }
    } else {
        echo '<tr><td colspan="4">No Record Found</td></tr>';
    }

    $stmt->close();
} else {
    echo '<tr><td colspan="4">Invalid Student ID</td></tr>';
}

$connect->close();
?>

