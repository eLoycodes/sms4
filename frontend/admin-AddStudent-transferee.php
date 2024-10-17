<?php
include("connect.php");

session_start();
if (!isset($_SESSION["id"])) {
    echo "<script>window.open('index.php?mes=Access Denied..','_self');</script>";
}

$students = [];
$error_message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['studentID'])) {
    $student_ID_input = trim($_POST['studentID']);
    
    if (empty($student_ID_input)) {
        $error_message = "Student ID cannot be empty.";
    } elseif (!preg_match('/^[a-zA-Z0-9]+$/', $student_ID_input)) {
        $error_message = "Invalid Student ID format.";
    } else {
       
        $tables = [
            'transferee'    
        ];

        foreach ($tables as $table) {
            
            $columns_result = $connect->query("SHOW COLUMNS FROM $table");
            $existing_columns = [];
            while ($column = $columns_result->fetch_assoc()) {
                $existing_columns[] = $column['Field'];
            }

            $selected_columns = ['studentID']; // Always include studentID
            $possible_columns = ['firstname', 'middlename', 'lastname', 'course', 'yearlevel', 'academicyear', 'semester', 'status', 'studenttype'];

            foreach ($possible_columns as $column) {
                if (in_array($column, $existing_columns)) {
                    $selected_columns[] = $column;
                }
            }

            $selected_columns_str = implode(', ', $selected_columns);
            $sql = "SELECT '$table' AS source, $selected_columns_str FROM $table WHERE studentID = ?";

            if ($stmt = $connect->prepare($sql)) {
                $stmt->bind_param("s", $student_ID_input);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $students[] = $row; // Store results
                    }
                }

                $stmt->close();
            } else {
                $error_message = "Database error: " . $connect->error; // Handle potential errors
            }
        }
        if (empty($students)) {
            $error_message = "No student found with ID: " . htmlspecialchars($student_ID_input);
        }
    }
}
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
<body>
     <!-- navbar -->
     <?php include('navbar.php'); ?>
    <?php include('uppernav.php'); ?>
    <!-- end navbar -->

    <div class="transferees-frame1">
        <!-- dito ka mag simula-->
        <div class="transferees-frame2"><br><br>
          <span class="dashboardName"><b>Section Management</b></span><br>
          <h1 class="dashboardAnnouncement">Edit Transferee</h1>
        </div>


        <div class="edit-form">
    <form method="POST" action="">
        <div class="edit-search">
            <label class="deac-label">Search Student ID:</label>
            <input type="text" name="studentID" class="search-deac" required>
            <button type="submit" name="submit" class="search-deac-btn">Search</button>
            <button class="update-student-btn" id="open-modal" type="button" style="float: right;">Edit Student</button>
        </div>
    </form>



        <table class="transferees-table">
            <tr>
              <th class="rf">Student&nbspID</th>
              <th class="rf">Full&nbspName</th>
              <th class="rf">Course</th>
              <th class="rf">Year&nbspLevel</th>
              <th class="rf">Academic&nbspYear</th>
              <th class="rf">Student&nbspType</th>
            </tr>
            <tr class="reqf">
              <td class="req">1</td>
              <td class="req">Evaluation Grade</td>   
              <td class="req">Evaluation Grade</td>
              <td class="req">1</td>
              <td class="req">Evaluation Grade</td>
              <td class="req">200</td>
            </tr>
          </table>
        </div>

        <div class="transferees-form1">
          <tr>
            <td class="trans-td"><h3 class="edit-heading" style="font-size: 18px;">Select Subject that will credited</h3></td>
        </tr>
        <table class="transferees-table1">
          <tr>
            <th class="trans-th">Search Subject</th>
            <th class="trans-th">Subject Code</th>
            <th class="trans-th">Subject Name</th>
            <th class="trans-th">Action</th>
          </tr>
          <tr>
            <td class="trans-td">
              <input type="text" name="deac-search" class="search-deac">
              <button type="submit" name="submit" class="search-deac-btn">Search</button>
            </td>
            
            <td class="trans-td"></td>
            <td class="trans-td"></td>
            <td class="trans-td"></td>
            <td class="req"></td>
          </tr>
          <tr class="trans-tr">
            <td class="trans-td">-</td>  
            <td class="trans-td">DB1</td>
            <td class="trans-td">Database 1</td>
            <td class="req"><a href="#"><button class="reqform-btn">credit</button></a></td>
          </tr>
        </table>
      </div>

      <div class="transferees-form2">
        <tr>
          <td class="trans-td"><h3 class="edit-heading" style="font-size: 18px;">Select Subject that will retake</h3></td>
      </tr>
      <table class="transferees-table2">
        <tr>
          <th class="trans-th">Search Subject</th>
          <th class="trans-th">Subject Code</th>
          <th class="trans-th">Subject Name</th>
          <th class="trans-th">Semester</th>
          <th class="trans-th">Action</th>
        </tr>
        <tr>
          <td class="trans-td">
            <input type="text" name="deac-search" class="search-deac">
            <button type="submit" name="submit" class="search-deac-btn">Search</button>
          </td>
          
          <td class="trans-td"></td>
          <td class="trans-td"></td>
          <td class="trans-td"></td>
          <td class="req"></td>
        </tr>
        <tr class="trans-tr">
          <td class="trans-td">-</td>  
          <td class="trans-td">DB1</td>
          <td class="trans-td">Database 1</td>
          <td class="trans-td">1st</td>
          <td class="req"><a href="#"><button class="reqform-btn">retake</button></a></td>
        </tr>
      </table>
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
var i;

for (i = 0; i < dropdown.length; i++) {
  dropdown[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var dropdownContent = this.nextElementSibling;
    if (dropdownContent.style.display === "block") {
      dropdownContent.style.display = "none";
    } else {
      dropdownContent.style.display = "block";
    }
  });
}

var modal = document.getElementById('id01');

window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

    </script>
</body>
</html>
