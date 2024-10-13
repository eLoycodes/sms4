<?php
include("connect.php");
ini_set('session.cookie_httponly', 1);
ini_set('session.cookie_secure', 1); // Use if HTTPS
ini_set('session.use_only_cookies', 1);
session_start();
session_regenerate_id(true); // Regenerate session ID

if (!isset($_SESSION["id"])) {
    echo "<script>window.open('index.php?mes=Access Denied..','_self');</script>";
}

$students = [];
$error_message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['studentID'])) {
    $student_ID_input = trim($_POST['studentID']);
    
    // Validate input
    if (empty($student_ID_input)) {
        $error_message = "Student ID cannot be empty.";
    } elseif (!preg_match('/^[a-zA-Z0-9]+$/', $student_ID_input)) {
        $error_message = "Invalid Student ID format.";
    } else {
        // Define the tables to search
        $tables = [
            'deactivate',
            'deactivated',
            'firstyear',
            'secondyear',
            'thirdyear',
            'forthyear',
            'returnee'    
        ];

        foreach ($tables as $table) {
            // Prepare to check existing columns
            $columns_result = $connect->query("SHOW COLUMNS FROM $table");
            $existing_columns = [];
            while ($column = $columns_result->fetch_assoc()) {
                $existing_columns[] = $column['Field'];
            }

            // Define the selected columns based on existing columns
            $selected_columns = ['studentID']; // Always include studentID
            $possible_columns = ['firstname', 'middlename', 'lastname', 'course', 'yearlevel', 'academicyear', 'status', 'studenttype'];

            foreach ($possible_columns as $column) {
                if (in_array($column, $existing_columns)) {
                    $selected_columns[] = $column;
                }
            }

            // Build the SQL query
            $selected_columns_str = implode(', ', $selected_columns);
            $sql = "SELECT '$table' AS source, $selected_columns_str FROM $table WHERE studentID = ?";
            
            // Prepare and execute the query
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

        // Check if we found any students
        if (empty($students)) {
            $error_message = " No student found with ID: " . htmlspecialchars($student_ID_input);
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
<style>
  .add-form{
  background: white;
  height: 60vh;
  width: calc(100% - 100px);
  margin-left: 2.5%;
  margin-top: 8%;
  box-shadow: 0 8px 12px rgba(0, 0, 0, 0.1);
  border: 1px solid rgb(226, 225, 225);
  position: absolute; 
  left:0px; right:0;
  top:50px; bottom:0px;
  overflow: auto;
  
}

.add-container{
  display: block;
  text-align: center;
  margin-top: 20px;
  min-height: 20vh;
}

.input-field,select{
  width: 160px;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 5px;
  margin: 10px auto;
  margin-left: 30%;
  margin-top: 1%;
}

.add-label{
 font-size: 15px;
 display: inline-block;
  margin-top: 20px;
}

.inputclass{
  margin-left: -5%;
  text-align: center;
  padding: 10px;
}
.add-button{
  padding: 8px 20px;
  border-radius: 5px;
  cursor: pointer;
  margin-left: -85%;
}

.addinput-btn{
  padding: 8px 20px;
  border-radius: 5px;
  cursor: pointer;
  float: right;
  margin-top: 1%;
  margin-right: 5%;
}

.callout {
      background-color: white;
      border-color: #bee5eb;
      border-radius: 5px;
      padding: 20px;
      margin: 20px 0;
  }
</style>
<body>
    <div id="sidenav" class="sidenav">
        <img src="image/bcplogo-mini.png" alt="img" class="bcplogo">
        <ul class="nav-link">
            <li class="bellNotiff">
            <a href="#" class="active">
                <i class='bx bx-bell'></i>
            </a>
            </li>
            <li class="userProfile">
            <a href="#">
                 <i class='bx bx-user'></i>
            </a>
            </li>
            <img src="image/avatar.jpg" alt="avatar" class="avatar"><br><br>
            <table class="user-profile">
              <tr>
                <td><span class="user-name"><b>Admin@gmail.com</b></span></td>
              </tr>
              <tr>
                  <td> <span class="user-mail">Admin</span></td>    
              </tr>
            </table>        
        </ul><br><br>

        <table class="dashboard">
          <tr>
            <td>
              <ul class="nav-links">
              <li>
                <a href="adminDashboard.html">
                  <i class='bx bx-grid-alt' ></i>
                  <span class="links_name">Dashboard</span>
                </a>
              </li>
            </ul>   
            </td>
          </tr>            
        </table>

        <div class="dropdownSmsprofile">
          <button class="dropdown-btn"> <i class='bx bx-user' ></i>
            <span class="droplinks_name">Admin Profile</span>
            <i class="fa fa-caret-down"></i>
          </button>
          <div class="dropdown-container">
            <a class="dropdown-a" href="#"><span class="droplinks_name">Account</span></a>
            <a class="dropdown-a" href="#"><span class="droplinks_name">Security</span></a>
            <a class="dropdown-a" href="#"><span class="droplinks_name">Additional Information</span></a>
            <a class="dropdown-a" href="#"><span class="droplinks_name">Log Out</span></a>
          </div>
          </div>

        <br><br>
          <span class="main"><b>ADMISSION</b></span><br>
          <span class="sub"><b>Student Admission</b></span>
        <br><br><br>

        <div class="dropdownStudentInformation">
          <button class="dropdown-btn"> <i class='bx bx-user' ></i>
            <span class="droplinks_name">Student Information</span>
            <i class="fa fa-caret-down"></i>
          </button>
          <div class="dropdown-container">
            <a class="dropdown-a" href="admin-StudentPersonalInformation.html"><span class="droplinks_name">Student Personal Information</span></a>
            <a class="dropdown-a" href="admin-DeactivateList.html"><span class="droplinks_name">Deactivate List</span></a> 
            <a class="dropdown-a" href="admin-PendingStudent.html"><span class="droplinks_name">Pending Student</span></a> 
            <a class="dropdown-a" href="admin-RequestInformation.html"><span class="droplinks_name">Request Information</span></a> 
          </div>
          </div>

          <div class="dropdownSectionManagement">
            <button class="dropdown-btn"> <i class='bx bx-user' ></i>
              <span class="droplinks_name">Section Management</span>
              <i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-container">
              <a class="dropdown-a" href="admin-AddStudent.html"><span class="droplinks_name">Add Student</span></a>
              <a class="dropdown-a" href="admin-SectionList.html"><span class="droplinks_name">Section List</span></a>
              <a class="dropdown-a" href="admin-MasterList.html"><span class="droplinks_name">Master List</span></a> 
              <a class="dropdown-a" href="admin-ManageClass.html"><span class="droplinks_name">Manage Class</span></a> 
            </div>
            </div><br><br>

        <div class="dropdownDocumentManangement">
        <span class="main"><b>Document Manangement</b></span><br>
        <span class="sub"><b>Document Details</b></span><br><br><br>
        <button class="dropdown-btn"> <i class='bx bx-money' ></i>
          <span class="droplinks_name">Document</span>
          <i class="fa fa-caret-down"></i>
        </button>
        <div class="dropdown-container">
          <a class="dropdown-a" href="admin-DocumentRequest.html"><span class="droplinks_name">Document Request</span></a>
          <a class="dropdown-a" href="admin-DocumentSubmit.html"><span class="droplinks_name">Document Submit</span></a>
          <a class="dropdown-a" href="admin-PayLater.html"><span class="droplinks_name">Pay Later</span></a>
          <a class="dropdown-a" href="admin-ReleaseHistory.html"><span class="droplinks_name">release history</span></a>    
        </div>
        </div><br><br>

        <div class="dropdownCurriculum">
          <span class="main"><b>Curriculum</b></span><br>
          <span class="sub"><b>School Curriculum</b></span><br><br><br>
          <button class="dropdown-btn"> <i class='bx bx-file' ></i>
            <span class="droplinks_name">Curriculum</span>
            <i class="fa fa-caret-down"></i>
          </button>
          <div class="dropdown-container">    
            <a class="dropdown-a" href="admin-Course.html"><span class="droplinks_name">Courses</span></a>   
          </div>
          </div>

        <table class="otherService"><br><br>
          <span class="main"><b>OTHER SERVICES</b></span><br>
          <tr>
            <td>
              <ul class="nav-links">
              <li>
                <a href="#">
                  <i class='bx bx-file' ></i>
                  <span class="links_name">Non Academic Affairs</span>
                </a>
              </li>
              <li>
                <a href="#">
                  <i class='bx bx-file' ></i>
                  <span class="links_name">Appointment</span>
                </a>
              </li>
            </ul>   
            </td>
          </tr>            
        </table><br><br><br>
        
       
    </div>

    <div id="uppernav">
        <div class="upnav">
        <button class="openbtn" onclick="toggleNav()">☰</button>
    </div>

    <div class="edit-frame1">
        <div class="edit-frame2"><br><br>
          <span class="dashboardName"><b>Section Management</b></span><br>
          <h1 class="dashboardAnnouncement">Edit Student</h1>
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

    <?php if (!empty($students)): ?>
    <div class="callout callout-info">
        <table class="edit-table">
            <tr>
                <th class="rf">Student ID</th>
                <th class="rf">Name</th>
                <th class="rf">Course</th>
                <th class="rf">Year Level</th>
                <th class="rf">Academic Year</th>
                <th class="rf">Type</th>
                <th class="rf">Status</th>
            </tr>
            <?php foreach ($students as $student): ?>
            <tr>
                <td><?php echo htmlspecialchars($student['studentID']); ?></td>
                <td><?php echo htmlspecialchars($student['firstname'] . ' ' . $student['middlename'] . ' ' . $student['lastname']); ?></td>
                <td><?php echo htmlspecialchars($student['course'] ?? 'N/A'); ?></td>
                <td><?php echo htmlspecialchars($student['yearlevel'] ?? 'N/A'); ?></td>
                <td><?php echo htmlspecialchars($student['academicyear'] ?? 'N/A'); ?></td>
                <td><?php echo htmlspecialchars($student['studenttype'] ?? 'N/A'); ?></td>
                <td><?php echo htmlspecialchars($student['status'] ?? 'N/A'); ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
  
    <?php elseif (!empty($error_message)): ?>
        <div class="error-message"><?php echo htmlspecialchars($error_message); ?></div>
    <?php endif; ?>
    
</div>

<div class="edit-form2">
        <tr>
          <td class="trans-td"><h3 class="edit-heading" style="font-size: 18px;"><td><?php echo htmlspecialchars($student['firstname'] ?? 'N/A'); ?></td>Subjects</h3></td>
      </tr>
      <table class="edit-table2">
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
          <td class="req"><button type="submit" class="reqform-btn" name="submit">remove</button></td>
        </tr>
      </table>
    </div>



    

    </div>
   <?php if (!empty($students)): ?> 
      <div class="callout callout-info">
      <div class="edit-form1">
    <tr>
        <td class="trans-td"><h3 class="edit-heading" style="font-size: 18px;">Select Subject that will retake</h3></td>
    </tr>
    <table class="edit-table1">
        <tr>
            <th class="trans-th">Search Subject</th>
            <th class="trans-th">Subject Code</th>
            <th class="trans-th">Subject Name</th>
            <th class="trans-th">Semester</th>
            <th class="trans-th">Action</th>
        </tr>
        <tr>
            <td class="trans-td">
                <form method="POST" action="">
                    <input type="text" name="deac-search" class="search-deac">
                    <button type="submit" name="search-submit" class="search-deac-btn">Search</button>
                </form>
            </td>
            <td class="trans-td"></td>
            <td class="trans-td"></td>
            <td class="trans-td"></td>
            <td class="req"></td>
        </tr>
        <?php
            include('connect.php'); 
            
            // Handle the search functionality
            $searchQuery = "";
            if (isset($_POST['search-submit'])) {
                $searchQuery = trim($_POST['deac-search']);
                // Use a prepared statement to prevent SQL injection
                $s = "SELECT * FROM subject WHERE subjectname LIKE ?";
                $stmt = $connect->prepare($s);
                $likeSearch = "%" . $searchQuery . "%";
                $stmt->bind_param('s', $likeSearch);
                $stmt->execute();
                $res = $stmt->get_result();
            } else {
                $s = "SELECT * FROM subject";
                $res = $connect->query($s);
            }

            if($res->num_rows > 0) {
                while($r = $res->fetch_assoc()) {
                    ?>
                    <tr class="reqf">
                        <td class="req">-</td>
                        <td class="req"><?php echo htmlspecialchars($r['subjectcode']); ?></td>
                        <td class="req"><?php echo htmlspecialchars($r["subjectname"]); ?></td>
                        <td class="req"><?php echo htmlspecialchars($r["semester"]); ?></td>
                        <td class="req">
                            <form method="POST" action="add_subject.php">
                                <input type="hidden" name="studentID" value="<?php echo htmlspecialchars($studentID); ?>"> <!-- Ensure $studentID is set -->
                                <input type="hidden" name="subjectCode" value="<?php echo htmlspecialchars($r['subjectcode']); ?>">
                                <button type="submit" class="reqform-btn" name="submit">Retake</button>
                            </form>
                        </td>
                    </tr>
                    <?php  
                }
            } else {   
                echo "<tr><td colspan='5'>No Record Found</td></tr>";
            }
        ?> 
    </table>
</div>

      <div class="edit-form2">
        <tr>
          <td class="trans-td"><h3 class="edit-heading" style="font-size: 18px;">Select Subject that will remove</h3></td>
      </tr>
      <table class="edit-table2">
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
          <td class="req"><button type="submit" class="reqform-btn" name="submit">remove</button></td>
        </tr>
      </table>
    </div>

    <div class="modal-overlay hide">
    <div class="modal-wrapper">
        <div class="close-btn-wrapper">
            <button class="close-modal-btn">X</button>
        </div>
        <div class="customization-frame">
            <form method="POST" action="update_student.php"> <!-- Specify the action here -->
                <div id="inputFields" class="inputclass">
                    <label class="add-label" style="color: white;">Student ID
                        <input type="text" placeholder="" class="input-field" name="studentID" required>
                    </label>
                    <label class="add-label" style="color: white;">Firstname
                        <input type="text" placeholder="" class="input-field" name="firstname" required>
                    </label>
                    <label class="add-label" style="color: white;">Middlename
                        <input type="text" placeholder="" class="input-field" name="middlename">
                    </label>
                    <label class="add-label" style="color: white;">Last Name
                        <input type="text" placeholder="" class="input-field" name="lastname" required>
                    </label>
                    <label class="add-label" style="color: white;">Course
                        <select name="course" required>
                            <option disabled selected></option>
                            <option>BsIT</option>
                            <option>BsCrim</option>
                            <option>BsP</option>
                            <option>BsCpE</option>
                        </select>
                    </label>
                    <label class="add-label" style="color: white;">Year Level
                        <select name="yearlevel" required>
                            <option disabled selected></option>
                            <option>1st</option>
                            <option>2nd</option>
                            <option>3rd</option>
                            <option>4th</option>
                        </select>
                    </label>
                    <label class="add-label" style="color: white;">Acad Year
                        <select name="academicyear" required>
                            <option disabled selected></option>
                            <option>2023-2024</option>
                            <option>2024-2025</option>
                        </select>
                    </label>
                    <label class="add-label" style="color: white;">Type
                        <select name="studenttype" required>
                            <option disabled selected></option>
                            <option>Freshmen</option>
                            <option>Old</option>
                            <option>Transferee</option>
                            <option>Octoberian</option>
                        </select>
                    </label>
                    <label class="add-label" style="color: white;">Status
                        <select name="status" required>
                            <option disabled selected></option>
                            <option>Regular</option>
                            <option>Irregular</option>
                            <option>Dropped</option>
                        </select>
                    </label>
                </div>
                <button type="submit" name="submit" class="apply-buttons">Update</button>
            </form>
        </div>
    </div>
</div>
 
<?php elseif (!empty($error_message)): ?>
        <div class="error-message"><?php echo htmlspecialchars($error_message); ?></div>
    <?php endif; ?>
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


const openBtn = document.querySelector(".update-student-btn");
        const modal = document.querySelector(".modal-overlay");
        const closeBtn = document.querySelector(".close-modal-btn");

        function openModal() {
            modal.classList.remove("hide");
        }

        function closeModal(e, clickedOutside) {
            if (clickedOutside) {
                if (e.target.classList.contains("modal-overlay"))
                    modal.classList.add("hide");
            } else modal.classList.add("hide");
        }

        openBtn.addEventListener("click", openModal);
        modal.addEventListener("click", (e) => closeModal(e, true));
        closeBtn.addEventListener("click", closeModal);


    </script>
</body>
</html>
