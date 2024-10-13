<?php
include('connect.php');

$course = $_GET['course'] ?? '';
$yearlevel = $_GET['yearlevel'] ?? '';

$s = "SELECT * FROM firstyear WHERE course = ? AND yearlevel = ?";
$stmt = $connect->prepare($s);
$stmt->bind_param('ss', $course, $yearlevel);
$stmt->execute();
$res = $stmt->get_result();

if ($res->num_rows > 0) {
    while ($student = $res->fetch_assoc()) {
        echo "<tr>
                <td>" . htmlspecialchars($student['student_id']) . "</td>
                <td>" . htmlspecialchars($student['name']) . "</td>
                <td>" . htmlspecialchars($student['email']) . "</td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='3'>No students found.</td></tr>";
}
?>
