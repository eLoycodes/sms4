<?php
include('connect.php');

$studentID = $_GET['studentID'];

$s = "SELECT ss.subjectcode, s.subjectname, s.semester 
      FROM student_subjects ss 
      JOIN subject s ON ss.subjectcode = s.subjectcode 
      WHERE ss.studentID = ?";
$stmt = $connect->prepare($s);
$stmt->bind_param('i', $studentID);
$stmt->execute();
$res = $stmt->get_result();

$output = '';
while ($row = $res->fetch_assoc()) {
    $output .= '<tr class="trans-tr">';
    $output .= '<td class="trans-td">' . htmlspecialchars($row['subjectcode']) . '</td>';
    $output .= '<td class="trans-td">' . htmlspecialchars($row['subjectname']) . '</td>';
    $output .= '<td class="trans-td">' . htmlspecialchars($row['semester']) . '</td>';
    $output .= '<td>
                    <form method="POST" action="remove_subject.php" class="remove-form">
                        <input type="hidden" name="studentID" value="' . htmlspecialchars($studentID) . '">
                        <input type="hidden" name="subjectCode" value="' . htmlspecialchars($row['subjectcode']) . '">
                        <button type="submit" class="reqform-btn" name="submit">Remove</button>
                    </form>
                </td>';
    $output .= '</tr>';
}

echo $output;
?>
