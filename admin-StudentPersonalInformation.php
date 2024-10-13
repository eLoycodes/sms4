<?php
include("connect.php");
ini_set('session.cookie_httponly', 1);
ini_set('session.cookie_secure', 1);
ini_set('session.use_only_cookies', 1);
session_start();
session_regenerate_id(true);

// Check if user is logged in
if (!isset($_SESSION["id"])) {
    echo "<script>window.open('index.php?mes=Access Denied..','_self');</script>";
    exit(); // Ensure to stop script execution
}

$student_ID = null; 
$error_message = "";

if (isset($_POST['studentID'])) {
    $student_ID_input = trim($_POST['studentID']);
    if (empty($student_ID_input)) {
        $error_message = "Student ID cannot be empty.";
    } elseif (!preg_match('/^[a-zA-Z0-9]+$/', $student_ID_input)) {
        $error_message = "Invalid Student ID format.";
    } else {
        $student_ID = [];
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
          $columns_result = $connect->query("SHOW COLUMNS FROM $table");
          $existing_columns = [];
      
          while ($column = $columns_result->fetch_assoc()) {
              $existing_columns[] = $column['Field'];
          }
          $selected_columns = ['studentID']; 
          $possible_columns = [
              'firstname',
              'middlename',
              'lastname',
              'suffixname',
              'email',
              'gender',
              'dob',
              'age',
              'contactnum',
              'course',
              'yearlevel',
              'section',
              'academicyear',
              'status',
              'studenttype'
          ];
       
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
                    $student_ID = $row; 
                }
              }
              $stmt->close();
          } else {
              $error_message = "Database error: " . $connect->error; 
        }
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
    <link rel="stylesheet" href="css/styles.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
</head>

<body>
   <!-- navbar -->
   <?php include('navbar.php'); ?>
   <!-- end navbar -->
<!-- start -->

        <div class="studentInformation-frame">
            <div class="frame2"><br><br>
                <span class="dashboardName"><b>Student Information</b></span><br>
                <h1 class="dashboardAnnouncement">Student Personal Information</h1>
              </div>


              <div class="frames">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                <div class="form one">
                    <div class="details personal">
                        <div class="admission1">
                            <label class="SSI">Search&nbspStudent&nbspID:</label>
                            <input type="text" name="studentID" class="form-control" placeholder="Enter Student ID">
                            <button type="submit" class="btn btn-primary mt-2">Search</button><br><br>
                        </div>
                    </div>
                </div>
            </form>
            <?php if (!empty($student_ID)): ?>
                <div class="callout callout-info">
                    <div class="fields1">
                        <div class="input-field1">
                            <label>Student ID *</label>
                            <input type="text" class="form-control" value="<?php echo htmlspecialchars($student_ID['studentID'] ?? ''); ?>" readonly>
                        </div>
                        <div class="input-field1">
                            <label>First Name *</label>
                            <input type="text" class="form-control" value="<?php echo htmlspecialchars($student_ID['firstname'] ?? ''); ?>" readonly>
                        </div>
                        <div class="input-field1">
                            <label>Middle Name *</label>
                            <input type="text" class="form-control" value="<?php echo htmlspecialchars($student_ID['middlename'] ?? ''); ?>" readonly>
                        </div>
                        <div class="input-field1">
                            <label>Last Name *</label>
                            <input type="text" class="form-control" value="<?php echo htmlspecialchars($student_ID['lastname'] ?? ''); ?>" readonly>
                        </div>
                        <div class="input-field1">
                            <label>Suffix Name *</label>
                            <input type="text" class="form-control" value="<?php echo htmlspecialchars($student_ID['suffixname'] ?? ''); ?>" readonly>
                        </div>
                        <div class="input-field1">
                            <label>Email *</label>
                            <input type="text" class="form-control" value="<?php echo htmlspecialchars($student_ID['email'] ?? ''); ?>" readonly>
                        </div>
                        <div class="input-field1">
                            <label>Gender *</label>
                            <input type="text" class="form-control" value="<?php echo htmlspecialchars($student_ID['gender'] ?? ''); ?>" readonly>
                        </div>
                        <div class="input-field1">
                            <label>Date of Birth *</label>
                            <input type="date" class="form-control" value="<?php echo htmlspecialchars($student_ID['dob'] ?? ''); ?>" readonly>
                        </div>
                        <div class="input-field1">
                            <label>Age *</label>
                            <input type="text" class="form-control" value="<?php echo htmlspecialchars($student_ID['age'] ?? ''); ?>" readonly>
                        </div>
                        <div class="input-field1">
                            <label>Contact Number *</label>
                            <input type="number" class="form-control" value="<?php echo htmlspecialchars($student_ID['contactnum'] ?? ''); ?>" readonly>
                        </div>
                        <div class="input-field1">
                            <label>Course *</label>
                            <input type="text" class="form-control" value="<?php echo htmlspecialchars($student_ID['course'] ?? ''); ?>" readonly>
                        </div>
                        <div class="input-field1">
                            <label>Year Level *</label>
                            <input type="text" class="form-control" value="<?php echo htmlspecialchars($student_ID['yearlevel'] ?? ''); ?>" readonly>
                        </div>
                        <div class="input-field1">
                            <label>Section *</label>
                            <input type="text" class="form-control" value="<?php echo htmlspecialchars($student_ID['section'] ?? ''); ?>" readonly>
                        </div>
                        <div class="input-field1">
                            <label>Academic Year *</label>
                            <input type="text" class="form-control" value="<?php echo htmlspecialchars($student_ID['academicyear'] ?? ''); ?>" readonly>
                        </div>
                        <div class="input-field1">
                            <label>Status *</label>
                            <input type="text" class="form-control" value="<?php echo htmlspecialchars($student_ID['status'] ?? ''); ?>" readonly>
                        </div>
                        <div class="input-field1">
                            <label>Student Type *</label>
                            <input type="text" class="form-control" value="<?php echo htmlspecialchars($student_ID['studenttype'] ?? ''); ?>" readonly>
                        </div>
                    </div>
                </div>
            <?php elseif ($error_message): ?>
                <div class="callout callout-danger">
                    <p><?php echo htmlspecialchars($error_message); ?></p>
                </div>
            <?php endif; ?>

        </div>
<!-- end -->
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
    </script>


<style>
  .callout {
      background-color: #d1ecf1;
      border-color: #bee5eb;
      border-radius: 5px;
      padding: 20px;
      margin: 20px 0;
  }

  .fields1 {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 15px; 
  }

  .input-field1 {
      display: flex;
      flex-direction: column;
  }

  .input-field1 label {
      margin-bottom: 5px; 
  }
</style>
</body>
</html>
