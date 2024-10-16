<?php
include("connect.php");
session_start();

if (!isset($_SESSION["id"])) {
    echo "<script>window.open('index.php?mes=Access Denied..','_self');</script>";
}

$total_students = 0; // Variable to hold total number of students
$firsyeartotal_students = 0;
$secondyeartotal_students = 0;
$thirdyeartotal_students = 0;
$forthyeartotal_students = 0;

// Query to count total number of students in each year based on their sections
$count_query = "
    SELECT 
        (SELECT COUNT(*) FROM firstyear) AS firsyeartotal,
        (SELECT COUNT(*) FROM secondyear) AS secondyeartotal,
        (SELECT COUNT(*) FROM thirdyear) AS thirdyeartotal,
        (SELECT COUNT(*) FROM forthyear) AS forthyeartotal
";

$count_result = $connect->query($count_query);
if ($count_result && $count_result->num_rows > 0) {
    $row = $count_result->fetch_assoc();
    $firsyeartotal_students = $row['firsyeartotal'];
    $secondyeartotal_students = $row['secondyeartotal'];
    $thirdyeartotal_students = $row['thirdyeartotal'];
    $forthyeartotal_students = $row['forthyeartotal'];

    // Calculate total number of students across all years
    $total_students = $firsyeartotal_students + $secondyeartotal_students + $thirdyeartotal_students + $forthyeartotal_students;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <title>Sms4</title>
    <link rel="stylesheet" href="css/styles.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
    
    <!--datatable-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    
</head>

<body>
     <!-- navbar -->
     <?php include('navbar.php'); ?>
     <?php include('uppernav.php'); ?>
     <!-- end navbar -->

    <div class="requestForm-frame1">
        <div class="requestForm-frame2"><br><br>
          <span class="dashboardName"><b>Section Management</b></span><br>
          <h1 class="dashboardAnnouncement">Section List</h1>
        </div>

    <div class="container mt-7">
    <div class="row">
    <div class="col-md-12" style="margin-left: -5%;">
        <form id="dataForm1" class="form-card">
            <h2 style="font-size: 22px; float: right;">1st year</h2>

            <div class="form-group">
                <label for="firstyear-course">Select Course:</label>
                <select id="firstyear-course" name="firstyear" class="form-control">
                    <option value="">All Courses</option>
                    <option value="BSCRIM" <?php echo (isset($_GET['firstyear']) && $_GET['firstyear'] == 'BSCRIM') ? 'selected' : ''; ?>>BSCRIM</option>
                    <option value="BSIT" <?php echo (isset($_GET['firstyear']) && $_GET['firstyear'] == 'BSIT') ? 'selected' : ''; ?>>BSIT</option>
                    <option value="BSCPE" <?php echo (isset($_GET['firstyear']) && $_GET['firstyear'] == 'BSCPE') ? 'selected' : ''; ?>>BSCPE</option>
                    <option value="BSP" <?php echo (isset($_GET['firstyear']) && $_GET['firstyear'] == 'BSP') ? 'selected' : ''; ?>>BSP</option>
                </select>
            </div>

            <table id="formfirst" class="display table table-bordered">
                <thead>
                    <tr>
                        <th>Course</th>
                        <th>Year Level</th>
                        <th>Section</th>
                        <th>Semester</th>
                        <th>Academic Year</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="firstyear-results">
                    <!-- Results will be populated here by AJAX -->
                    <?php
            include('connect.php');
            $firstYearCourse = isset($_GET['firstyear']) ? $_GET['firstyear'] : null;

            if ($firstYearCourse) {
                $s = "SELECT * FROM section WHERE course = ? AND yearlevel = '1st'";
                $stmt = $connect->prepare($s);
                $stmt->bind_param('s', $firstYearCourse);
            } else {
                $s = "SELECT * FROM section WHERE yearlevel = '1st'";
                $stmt = $connect->prepare($s);
            }

            $stmt->execute();
            $res = $stmt->get_result();

            if ($res->num_rows > 0) {
                while ($r = $res->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?php echo htmlspecialchars($r['course']); ?></td>
                        <td><?php echo htmlspecialchars($r['yearlevel']); ?></td>
                        <td><?php echo htmlspecialchars($r['section']); ?></td>
                        <td><?php echo htmlspecialchars($r['semester']); ?></td>
                        <td><?php echo htmlspecialchars($r['academicyear']); ?></td>
                        <td><?php echo $firsyeartotal_students; ?></td>
                        <td><button class="btn btn-primary btn-sm">View</button></td>
                    </tr>
                    <?php
                }
            } else {
                echo "<tr><td colspan='7' align='center'>No Record Found</td></tr>";
            }
            ?>
                </tbody>
            </table>
        </form>
    </div>

    <!-- Repeat similar forms for 2nd, 3rd, and 4th year -->
    <div class="col-md-12" style="margin-left: -5%;">
        <form id="dataForm2" class="form-card">
            <h2 style="font-size: 22px; float: right;">2nd year</h2>

            <div class="form-group">
                <label for="secondyear-course">Select Course:</label>
                <select id="secondyear-course" name="secondyear" class="form-control">
                    <option value="">All Courses</option>
                    <option value="BSCRIM" <?php echo (isset($_GET['secondyear']) && $_GET['secondyear'] == 'BSCRIM') ? 'selected' : ''; ?>>BSCRIM</option>
                    <option value="BSIT" <?php echo (isset($_GET['secondyear']) && $_GET['secondyear'] == 'BSIT') ? 'selected' : ''; ?>>BSIT</option>
                    <option value="BSCPE" <?php echo (isset($_GET['secondyear']) && $_GET['secondyear'] == 'BSCPE') ? 'selected' : ''; ?>>BSCPE</option>
                    <option value="BSP" <?php echo (isset($_GET['secondyear']) && $_GET['secondyear'] == 'BSP') ? 'selected' : ''; ?>>BSP</option>
                </select>
            </div>

            <table id="formsecond" class="display table table-bordered">
                <thead>
                    <tr>
                        <th>Course</th>
                        <th>Year Level</th>
                        <th>Section</th>
                        <th>Semester</th>
                        <th>Academic Year</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="secondyear-results">
                    <!-- Results will be populated here by AJAX -->
                    <?php
            include('connect.php');
            $secondYearCourse = isset($_GET['secondyear']) ? $_GET['secondyear'] : null;

            if ($secondYearCourse) {
                $s = "SELECT * FROM section WHERE course = ? AND yearlevel = '2nd'";
                $stmt = $connect->prepare($s);
                $stmt->bind_param('s', $secondYearCourse);
            } else {
                $s = "SELECT * FROM section WHERE yearlevel = '2nd'";
                $stmt = $connect->prepare($s);
            }

            $stmt->execute();
            $res = $stmt->get_result();

            if ($res->num_rows > 0) {
                while ($r = $res->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?php echo htmlspecialchars($r['course']); ?></td>
                        <td><?php echo htmlspecialchars($r['yearlevel']); ?></td>
                        <td><?php echo htmlspecialchars($r['section']); ?></td>
                        <td><?php echo htmlspecialchars($r['semester']); ?></td>
                        <td><?php echo htmlspecialchars($r['academicyear']); ?></td>
                        <td><?php echo $secondyeartotal_students; ?></td>
                        <td><button class="btn btn-primary btn-sm">View</button></td>
                    </tr>
                    <?php
                }
            } else {
                echo "<tr><td colspan='7' align='center'>No Record Found</td></tr>";
            }
            ?>
            </tbody>
            </table>
        </form>
    </div>

    <div class="col-md-12" style="margin-left: -5%;">
        <form id="dataFormThird" class="form-card">
            <h2 style="font-size: 22px; float: right;">3rd year</h2>

            <div class="form-group">
                <label for="thirdyear-course">Select Course:</label>
                <select id="thirdyear-course" name="thirdyear" class="form-control">
                    <option value="">All Courses</option>
                    <option value="BSCRIM" <?php echo (isset($_GET['thirdyear']) && $_GET['thirdyear'] == 'BSCRIM') ? 'selected' : ''; ?>>BSCRIM</option>
                    <option value="BSIT" <?php echo (isset($_GET['thirdyear']) && $_GET['thirdyear'] == 'BSIT') ? 'selected' : ''; ?>>BSIT</option>
                    <option value="BSCPE" <?php echo (isset($_GET['thirdyear']) && $_GET['thirdyear'] == 'BSCPE') ? 'selected' : ''; ?>>BSCPE</option>
                    <option value="BSP" <?php echo (isset($_GET['thirdyear']) && $_GET['thirdyear'] == 'BSP') ? 'selected' : ''; ?>>BSP</option>
                </select>
            </div>

            <table id="formthird" class="display table table-bordered">
                <thead>
                    <tr>
                        <th>Course</th>
                        <th>Year Level</th>
                        <th>Section</th>
                        <th>Semester</th>
                        <th>Academic Year</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="thirdyear-results">
                    <!-- Results will be populated here by AJAX -->
                    <?php
            include('connect.php');
            $thirdYearCourse = isset($_GET['thirdyear']) ? $_GET['thirdyear'] : null;

            if ($thirdYearCourse) {
                $s = "SELECT * FROM section WHERE course = ? AND yearlevel = '3rd'";
                $stmt = $connect->prepare($s);
                $stmt->bind_param('s', $thirdYearCourse);
            } else {
                $s = "SELECT * FROM section WHERE yearlevel = '3rd'";
                $stmt = $connect->prepare($s);
            }

            $stmt->execute();
            $res = $stmt->get_result();

            if ($res->num_rows > 0) {
                while ($r = $res->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?php echo htmlspecialchars($r['course']); ?></td>
                        <td><?php echo htmlspecialchars($r['yearlevel']); ?></td>
                        <td><?php echo htmlspecialchars($r['section']); ?></td>
                        <td><?php echo htmlspecialchars($r['semester']); ?></td>
                        <td><?php echo htmlspecialchars($r['academicyear']); ?></td>
                        <td><?php echo $thirdyeartotal_students; ?></td>
                        <td><button class="btn btn-primary btn-sm">View</button></td>
                    </tr>
                    <?php
                }
            } else {
                echo "<tr><td colspan='7' align='center'>No Record Found</td></tr>";
            }
            ?>  
                </tbody>
            </table>
        </form>
    </div>

    <div class="col-md-12" style="margin-left: -5%;">
        <form id="dataFormFourth" class="form-card">
            <h2 style="font-size: 22px; float: right;">4th year</h2>

            <div class="form-group">
                <label for="fourthyear-course">Select Course:</label>
                <select id="fourthyear-course" name="fourthyear" class="form-control">
                    <option value="">All Courses</option>
                    <option value="BSCRIM" <?php echo (isset($_GET['fourthyear']) && $_GET['fourthyear'] == 'BSCRIM') ? 'selected' : ''; ?>>BSCRIM</option>
                    <option value="BSIT" <?php echo (isset($_GET['fourthyear']) && $_GET['fourthyear'] == 'BSIT') ? 'selected' : ''; ?>>BSIT</option>
                    <option value="BSCPE" <?php echo (isset($_GET['fourthyear']) && $_GET['fourthyear'] == 'BSCPE') ? 'selected' : ''; ?>>BSCPE</option>
                    <option value="BSP" <?php echo (isset($_GET['fourthyear']) && $_GET['fourthyear'] == 'BSP') ? 'selected' : ''; ?>>BSP</option>
                </select>
            </div>

            <table id="formforth" class="display table table-bordered">
                <thead>
                    <tr>
                        <th>Course</th>
                        <th>Year Level</th>
                        <th>Section</th>
                        <th>Semester</th>
                        <th>Academic Year</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="fourthyear-results">
                    <!-- Results will be populated here by AJAX -->
                    <?php
            include('connect.php');
            $fourthYearCourse = isset($_GET['fourthyear']) ? $_GET['fourthyear'] : null;

            if ($fourthYearCourse) {
                $s = "SELECT * FROM section WHERE course = ? AND yearlevel = '4th'";
                $stmt = $connect->prepare($s);
                $stmt->bind_param('s', $fourthYearCourse);
            } else {
                $s = "SELECT * FROM section WHERE yearlevel = '4th'";
                $stmt = $connect->prepare($s);
            }

            $stmt->execute();
            $res = $stmt->get_result();

            if ($res->num_rows > 0) {
                while ($r = $res->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?php echo htmlspecialchars($r['course']); ?></td>
                        <td><?php echo htmlspecialchars($r['yearlevel']); ?></td>
                        <td><?php echo htmlspecialchars($r['section']); ?></td>
                        <td><?php echo htmlspecialchars($r['semester']); ?></td>
                        <td><?php echo htmlspecialchars($r['academicyear']); ?></td>
                        <td><?php echo $forthyeartotal_students; ?></td>
                        <td><button class="btn btn-primary btn-sm">View</button></td>
                    </tr>
                    <?php
                }
            } else {
                echo "<tr><td colspan='7' align='center'>No Record Found</td></tr>";
            }
            ?>
                </tbody>
            </table>
        </form>
    </div>
</div>

<script>
$(document).ready(function() {
    // Function to load data based on selected course
    function loadData(formId, year) {
        let selectedCourse = $(formId + ' select').val();
        
        $.ajax({
            url: 'fetchcourse_data.php', // Create this file to handle AJAX requests
            method: 'GET',
            data: { course: selectedCourse, year: year },
            success: function(data) {
                $(formId + ' tbody').html(data);
            }
        });
    }

    // Event listeners for course selection
    $('#firstyear-course').change(function() {
        loadData('#dataForm1', '1st');
    });

    $('#secondyear-course').change(function() {
        loadData('#dataForm2', '2nd');
    });

    $('#thirdyear-course').change(function() {
        loadData('#dataFormThird', '3rd');
    });

    $('#fourthyear-course').change(function() {
        loadData('#dataFormFourth', '4th');
    });
});
</script>



<script>
$(document).ready(function() {
    $('#formfirst, #formsecond, #formthird, #formforth').DataTable({
        language: {
            lengthMenu: "_MENU_",
            info: ""
        }
    });
});
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

        
    </div>
</div><br>
<style>
        .form-card{
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px; /* Add space between forms */
        }
        table{
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }
        th{
            background-color: #007BFF;
            color: white;
        }
        .dataTables_filter input{
            margin-left: 0.5em;
            padding: 6px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
    </style>
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
