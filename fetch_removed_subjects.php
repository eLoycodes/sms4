<?php
include('connect.php');

$studentID = $_GET['studentID'] ?? '';

if (isset($_GET['studentID'])) {
    $studentID = $_GET['studentID'];

    $s = "SELECT * FROM subject_removed WHERE studentID = ?";
    $stmt = $connect->prepare($s);
    $stmt->bind_param('s', $studentID);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res->num_rows > 0) {
        while ($r = $res->fetch_assoc()) {
            echo '<tr class="reqf">
                    <td class="req">' . htmlspecialchars($r['subjectcode']) . '</td>
                    <td class="req">' . htmlspecialchars($r["subjectname"]) . '</td>
                    <td class="req">' . htmlspecialchars($r["semester"]) . '</td>
                  </tr>';
        }
    } else {
        echo '<tr><td colspan="3"><p align="center">No Record Found</p></td></tr>';
    }

    $stmt->close();
} else {
    echo '<tr><td colspan="3"><p align="center">Invalid Student ID</p></td></tr>';
}

$connect->close();
?>

