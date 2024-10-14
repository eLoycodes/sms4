<?php
include("connect.php");
session_start();

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_SESSION["id"])) {
    echo "<script>window.open('index.php?mes=Access Denied..','_self');</script>";
}

$studentData = []; // Initialize the array to hold student data
$error_message = "";

// Fetch all dropped students from specified tables
$tables = [
    'deactivate',
    'firstyear',
    'secondyear',
    'thirdyear',
    'forthyear',
    'returnee'
];

foreach ($tables as $table) {
    $sql = "SELECT * FROM $table WHERE status = 'dropped'";
    
    if ($stmt = $connect->prepare($sql)) {
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $studentData[] = $row; // Store each student's data
            }
        }
        $stmt->close();
    } else {
        $error_message = "Database error: " . $connect->error; 
    }
}

// Deactivation process
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['studentID'])) {
    $studentID = $_POST['studentID'];

    // Fetch the student's data from all relevant tables
    $found = false;
    foreach ($tables as $table) {
        $stmt = $connect->prepare("SELECT * FROM $table WHERE studentID = ?");
        $stmt->bind_param("s", $studentID);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $studentData = $result->fetch_assoc();
            $found = true;
            break; // Stop searching once we find the student
        }

        $stmt->close();
    }

    if ($found) {
        // Set fields and handle missing values
        $firstname = $studentData['firstname'] ?? '';
        $middlename = $studentData['middlename'] ?? '';
        $lastname = $studentData['lastname'] ?? '';
        $course = $studentData['course'] ?? '';
        $yearlevel = $studentData['yearlevel'] ?? '';
        $academicyear = $studentData['academicyear'] ?? '';
        $status = $studentData['status'] ?? '';

        // Insert into the deactivated table
        $insertStmt = $connect->prepare("INSERT INTO deactivated (studentID, firstname, middlename, lastname, course, yearlevel, academicyear, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $insertStmt->bind_param("sssssssss", 
            $studentID, 
            $firstname, 
            $middlename, 
            $lastname, 
            $course, 
            $yearlevel, 
            $academicyear, 
            $status
        );

        if ($insertStmt->execute()) {
            // Delete from the original table where the student was found
            $deleteStmt = $connect->prepare("DELETE FROM " . $table . " WHERE studentID = ?");
            $deleteStmt->bind_param("s", $studentID);
            $deleteStmt->execute();
            $deleteStmt->close();
            echo "Student deactivated successfully.";
        } else {
            echo "Failed to deactivate student: " . $insertStmt->error;
        }

        $insertStmt->close();
    } else {
        echo "Student not found.";
    }
}

$connect->close();
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <title>Sms4</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
</head>
<style>
    a {
        text-decoration: none;
        color: black;
    }
</style>
<body>
    <!-- navbar -->
    <?php include('navbar.php'); ?>
    <!-- end navbar -->

    <div class="deactivatelist-frame1">
        <div class="deactivatelist-frame2"><br><br>
            <span class="dashboardName"><b>Student Information</b></span><br>
            <h1 class="dashboardAnnouncement">Deactivate List</h1>
        </div><br>
        <div class="deactivatelistForm-frame">
            <table class="deactform-table">
                <tr>
                    <th class="rf">Student ID</th>
                    <th class="rf">Last Name</th>
                    <th class="rf">First Name</th>
                    <th class="rf">Middle Name</th>
                    <th class="rf">Course</th>
                    <th class="rf">Year Level</th>
                    <th class="rf">Academic Year</th>
                    <th class="rf">Status</th>
                    <th class="rf">Action</th>
                </tr>
                <?php
                if (!empty($studentData)) {
                    foreach ($studentData as $r) { ?>
                        <tr class="reqf">
                            <td class="req"><?php echo htmlspecialchars($r['studentID']); ?></td>
                            <td class="req"><?php echo htmlspecialchars($r['lastname']); ?></td>
                            <td class="req"><?php echo htmlspecialchars($r['firstname']); ?></td>
                            <td class="req"><?php echo htmlspecialchars($r['middlename']); ?></td>
                            <td class="req"><?php echo htmlspecialchars($r['course']); ?></td>
                            <td class="req"><?php echo htmlspecialchars($r['yearlevel']); ?></td>
                            <td class="req"><?php echo htmlspecialchars($r['academicyear']); ?></td>
                            <td class="req"><?php echo htmlspecialchars($r['status']); ?></td>
                            <td class="req">
                                <a href='#' onclick="openDeactivateModal('<?php echo $r['studentID']; ?>', '<?php echo $r['firstname']; ?>', '<?php echo $r['lastname']; ?>')">
                                    <button class="reqform-btn">Deactivate</button>
                                </a>
                            </td>
                        </tr>
                    <?php }
                } else {   
                    echo "<tr><td colspan='10'>No Record Found</td></tr>";
                }
                ?> 
            </table>
        </div>

        <!-- Deactivated List -->
        <div class="requestForm-frame3"><br><br>
            <h1 class="dashboardAnnouncement">Deactivated List</h1>
            <table class="requestform-table1">
                <tr>
                    <th class="rf">Student ID</th>
                    <th class="rf">Last Name</th>
                    <th class="rf">First Name</th>
                    <th class="rf">Middle Name</th>
                    <th class="rf">Course</th>
                    <th class="rf">Year Level</th>
                    <th class="rf">Academic Year</th>
                    <th class="rf">Status</th>
                </tr>
                <?php
                $s = "SELECT * from deactivated";
                $res = $connect->query($s);
                if ($res->num_rows > 0) {
                    while ($r = $res->fetch_assoc()) {
                        echo "<tr>
                                <td>{$r["studentID"]}</td>
                                <td>{$r["lastname"]}</td>
                                <td>{$r["firstname"]}</td>
                                <td>{$r["middlename"]}</td>
                                <td>{$r["course"]}</td>              
                                <td>{$r["yearlevel"]}</td> 
                                <td>{$r["academicyear"]}</td>  
                                <td>{$r["status"]}</td>  
                              </tr>"; 
                    }
                } else {   
                    echo "<tr><td colspan='9'>No Record Found</td></tr>";
                }
                ?>     
            </table>
        </div>

        <div id="id01" class="modal">
            <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal"></span>
            <form class="modal-content" action="admin-DeactivateList.php" method="post">
                <div class="deactivate-container">
                    <h1>Deactivate Account</h1>
                    <p>Are you sure you want to deactivate the account of <span id="deactivateName"></span>?</p>
                    <input type="hidden" id="deactivateStudentID" name="studentID">
                    <div class="clearfix">
                        <button type="button" class="cancelbtn" onclick="document.getElementById('id01').style.display='none'">Cancel</button>
                        <button type="submit" class="deletebtn">Deactivate</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
// SideNav
function toggleNav() {
    const sidenav = document.getElementById("sidenav");
    const uppernav = document.getElementById("uppernav");

    if (sidenav.style.left === "0px") {
        sidenav.style.left = "-280px";
        uppernav.style.marginLeft = "0";
    } else {
        sidenav.style.left = "0";
        uppernav.style.marginLeft = "280px";
    }
}

// Dropdown
var dropdown = document.getElementsByClassName("dropdown-btn");
for (var i = 0; i < dropdown.length; i++) {
    dropdown[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var dropdownContent = this.nextElementSibling;
        dropdownContent.style.display = dropdownContent.style.display === "block" ? "none" : "block";
    });
}

var modal = document.getElementById('id01');

window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

// Deactivate
function openDeactivateModal(studentID, firstName, lastName) {
    document.getElementById('deactivateStudentID').value = studentID;
    document.getElementById('deactivateName').innerText = firstName + " " + lastName;
    document.getElementById('id01').style.display = 'block';
}
</script>
</body>
</html>
