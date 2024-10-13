<?php
include('connect.php');

$course = isset($_GET['course']) ? $_GET['course'] : null;
$year = isset($_GET['year']) ? $_GET['year'] : null;

if ($course) {
    $s = "SELECT * FROM section WHERE course = ? AND yearlevel = ?";
    $stmt = $connect->prepare($s);
    $stmt->bind_param('ss', $course, $year);
} else {
    $s = "SELECT * FROM section WHERE yearlevel = ?";
    $stmt = $connect->prepare($s);
    $stmt->bind_param('s', $year);
}

$stmt->execute();
$res = $stmt->get_result();

if ($res->num_rows > 0) {
    while ($r = $res->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . htmlspecialchars($r['course']) . '</td>';
        echo '<td>' . htmlspecialchars($r['yearlevel']) . '</td>';
        echo '<td>' . htmlspecialchars($r['section']) . '</td>';
        echo '<td>' . htmlspecialchars($r['semester']) . '</td>';
        echo '<td>' . htmlspecialchars($r['academicyear']) . '</td>';
        echo '<td>' . $r['total_students'] . '</td>'; // Adjust according to your field name
        echo '<td><button class="btn btn-primary btn-sm">View</button></td>';
        echo '</tr>';
    }
} else {
    echo "<tr><td colspan='7' align='center'>No Record Found</td></tr>";
}
?>
