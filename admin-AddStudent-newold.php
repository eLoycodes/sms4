<?php

include("connect.php");
session_start();
if(!isset($_SESSION["id"])){
		echo"<script>window.open('index.php?mes=Access Denied..','_self');</script>";
	}	

  $sql="SELECT * FROM newstudent WHERE newstudent_id=newstudent_id";
  $res=$connect->query($sql);

  if($res->num_rows>0)
  {
    $r=$res->fetch_assoc();
  }	

?>

<?php 
include("connect.php");
if (isset($_POST['submit'])) {
    ini_set("display_errors", 0);
    require_once("connect.php");
$newstudent_id = null;
   
    if ($_POST["newstudent_id"] != "" && $_POST["studentID"] != "" && $_POST["firstname"] != "" && $_POST["middlename"] != "" && $_POST["lastname"] != "" && $_POST["course"] != "" && 
        $_POST["yearlevel"] != "" && $_POST["semester"] != "" && $_POST["academicyear"] != "" && 
        $_POST["studenttype"] != "") {

        $newstudent_id = $_POST["newstudent_id"]; 
        $studentID = $_POST["studentID"];
        $firstname = $_POST["firstname"];
        $middlename = $_POST["middlename"];
        $lastname = $_POST["lastname"];
        $course = $_POST["course"];
        $yearlevel = $_POST["yearlevel"];
        $semester = $_POST["semester"];
        $academicyear = $_POST["academicyear"];
        $studenttype = $_POST["studenttype"];

        $table = "";
        switch ($yearlevel) {
            case '1st':
                $table = 'firstyear';
                break;
            case '2nd':
                $table = 'secondyear';
                break;
            case '3rd':
                $table = 'thirdyear';
                break;
            case '4th':
                $table = 'forthyear';
                break;
            default:
                echo "<script>alert('Invalid year level');</script>";
                exit;
        }

        // Prepare the SQL statement for insertion
        $sql = "INSERT INTO $table (studentID, firstname, middlename, lastname, course, yearlevel, semester, academicyear, studenttype)  
                VALUES ('$studentID', '$firstname', '$middlename', '$lastname', '$course', '$yearlevel', '$semester', '$academicyear', '$studenttype')";

        if ($connect->query($sql) === TRUE) {
            // After successful registration, delete from newstudent table
            $delete_sql = "DELETE FROM newstudent WHERE newstudent_id='$newstudent_id'";
            if ($connect->query($delete_sql) === TRUE) {
                echo "<script>
                        alert('Successfully Registered and removed from new student list');
                        window.location.href = 'admin-AddStudent-newold.php';
                      </script>";
            } else {
                echo "Error deleting record: " . $connect->error;
            }
        } else {
            echo "Error: " . $sql . "<br>" . $connect->error;
        }
    } else {
        echo "<script>alert('Please fill all the fields');</script>";
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
    <!-- end navbar -->

    <div class="newold-frame1">
        <div class="newold-frame2"><br><br>
          <span class="dashboardName"><b>Section Management</b></span><br>
          <h1 class="dashboardAnnouncement">Add Student</h1>
        </div>

        <div class="newold-form">
          <div class="edit-search">
            <h3 class="edit-heading" style="font-size: 18px; margin-top: -4%;">New Student</h3>
        
          </div>
        <table class="newold-table">
            <tr>
           
              <th class="rf">First Name</th>
              <th class="rf">Middle Name</th>
              <th class="rf">Last Name</th>
              <th class="rf">Course</th>
              <th class="rf">Year&nbspLevel</th>   
              <th class="rf">Action</th>    
            </tr>
            <?php
        
            include('connect.php'); 
              $s="SELECT * from newstudent";
              $res=$connect->query($s);
              if($res->num_rows>0){
              $i=0;
              while($r=$res->fetch_assoc()){
                $i++;
             echo"
              <tr>
               
                <td>{$r["firstname"]}</td>
                <td>{$r["middlename"]}</td>
                <td>{$r["lastname"]}</td>
                <td>{$r["course"]}</td>  
                <td>{$r["yearlevel"]}</td>  
                 <td><button><a href='admin-addStudent-newold.php?userid={$r["newstudent_id"]}'>Copy</a></button></td>	 
                </tr>
                "; 
          }
        }
        else{   
            echo "No Record Found";
        }
        ?>     
          </table>
        </div>

       
        <?php
        include('connect.php'); 
   
        if(isset($_GET["userid"])){
          $_SESSION['userid'] = $_GET["userid"];
      }
      
      $userid = isset($_SESSION['userid']) ? $_SESSION['userid'] : null;
      
      if ($userid) {
          $userrow = $connect->query("SELECT * FROM newstudent WHERE newstudent_id ='$userid'");
          $userfetch = $userrow->fetch_assoc();
      }
      ?>
      
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
          <div class="add-form" style="margin-top: 22%;">
              <div class="add-container">
                  <button type="button" class="add-button" onclick="addFn()">Add New Input</button>
                  <div id="inputFields" class="inputclass">
                      <input type="hidden" name="newstudent_id" value="<?php echo isset($userfetch['newstudent_id']) ? $userfetch['newstudent_id'] : ''; ?>">
                      
                      <div class="grid-container">
                          <label class="add-label">Student ID
                              <input type="text" placeholder="" class="input-field" name="studentID">
                          </label>
                          <label class="add-label">First Name
                              <input type="text" name="firstname" value="<?php echo isset($userfetch['firstname']) ? $userfetch['firstname'] : ''; ?>" placeholder="" class="input-field">
                          </label>
                          <label class="add-label">Middle Name
                              <input type="text" name="middlename" value="<?php echo isset($userfetch['middlename']) ? $userfetch['middlename'] : ''; ?>" placeholder="" class="input-field">
                          </label>
                          <label class="add-label">Last Name
                              <input type="text" name="lastname" value="<?php echo isset($userfetch['lastname']) ? $userfetch['lastname'] : ''; ?>" placeholder="" class="input-field">
                          </label>
                          <label class="add-label">Course
                              <select name="course" class="input-field">
                                  <option disabled selected></option>
                                  <option <?php echo (isset($userfetch['course']) && $userfetch['course'] == 'BsIT') ? 'selected' : ''; ?>>BsIT</option>
                                  <option <?php echo (isset($userfetch['course']) && $userfetch['course'] == 'BsCrim') ? 'selected' : ''; ?>>BsCrim</option>
                                  <option <?php echo (isset($userfetch['course']) && $userfetch['course'] == 'BsP') ? 'selected' : ''; ?>>BsP</option>
                                  <option <?php echo (isset($userfetch['course']) && $userfetch['course'] == 'BsCpE') ? 'selected' : ''; ?>>BsCpE</option>
                              </select>
                          </label>
                          <label class="add-label">Year Level
                              <select name="yearlevel" class="input-field">
                                  <option disabled selected></option>
                                  <option <?php echo (isset($userfetch['yearlevel']) && $userfetch['yearlevel'] == '1st') ? 'selected' : ''; ?>>1st</option>
                                  <option <?php echo (isset($userfetch['yearlevel']) && $userfetch['yearlevel'] == '2nd') ? 'selected' : ''; ?>>2nd</option>
                                  <option <?php echo (isset($userfetch['yearlevel']) && $userfetch['yearlevel'] == '3rd') ? 'selected' : ''; ?>>3rd</option>
                                  <option <?php echo (isset($userfetch['yearlevel']) && $userfetch['yearlevel'] == '4th') ? 'selected' : ''; ?>>4th</option>
                              </select>
                          </label>
                          <label class="add-label">Semester
                              <select name="semester" class="input-field">
                                  <option disabled selected></option>
                                  <option <?php echo (isset($userfetch['semester']) && $userfetch['semester'] == '1st') ? 'selected' : ''; ?>>1st</option>
                                  <option <?php echo (isset($userfetch['semester']) && $userfetch['semester'] == '2nd') ? 'selected' : ''; ?>>2nd</option>
                              </select>
                          </label>
                          <label class="add-label">Acad Year
                              <select name="academicyear" class="input-field">
                                  <option disabled selected></option>
                                  <option <?php echo (isset($userfetch['academicyear']) && $userfetch['academicyear'] == '2023-2024') ? 'selected' : ''; ?>>2023-2024</option>
                                  <option <?php echo (isset($userfetch['academicyear']) && $userfetch['academicyear'] == '2024-2025') ? 'selected' : ''; ?>>2024-2025</option>
                              </select>
                          </label>
                          <label class="add-label">Student Type
                              <select name="studenttype" class="input-field">
                                  <option disabled selected></option>
                                  <option <?php echo (isset($userfetch['studenttype']) && $userfetch['studenttype'] == 'Freshmen') ? 'selected' : ''; ?>>Freshmen</option>
                                  <option <?php echo (isset($userfetch['studenttype']) && $userfetch['studenttype'] == 'Returnee') ? 'selected' : ''; ?>>Returnee</option>
                                  <option <?php echo (isset($userfetch['studenttype']) && $userfetch['studenttype'] == 'Transferee') ? 'selected' : ''; ?>>Transferee</option>
                                  <option <?php echo (isset($userfetch['studenttype']) && $userfetch['studenttype'] == 'Octoberian') ? 'selected' : ''; ?>>Octoberian</option>
                              </select>
                          </label>
                      </div>
                  </div>           
                  <button type="submit" name="submit" class="addinput-btn">Add Student</button>
              </div>
          </div>
      </form>
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

    //add new and old student
    function addFn() {
    const divEle = document.getElementById("inputFields");
    divEle.innerHTML += `
        <div class="grid-container">
            <label class="add-label">Student ID
                <input type="text" placeholder="" class="input-field" name="studentID">
            </label>
            <label class="add-label">First Name
                <input type="text" name="firstname" placeholder="" class="input-field">
            </label>
            <label class="add-label">Middle Name
                <input type="text" name="middlename" placeholder="" class="input-field">
            </label>
            <label class="add-label">Last Name
                <input type="text" name="lastname" placeholder="" class="input-field">
            </label>
            <label class="add-label">Course
                <select name="course" class="input-field">
                    <option disabled selected></option>
                    <option>BsIT</option>
                    <option>BsCrim</option>
                    <option>BsP</option>
                    <option>BsCpE</option>
                </select>
            </label>
            <label class="add-label">Year Level
                <select name="yearlevel" class="input-field">
                    <option disabled selected></option>
                    <option>1st</option>
                    <option>2nd</option>
                    <option>3rd</option>
                    <option>4th</option>
                </select>
            </label>
            <label class="add-label">Semester
                <select name="semester" class="input-field">
                    <option disabled selected></option>
                    <option>1st</option>
                    <option>2nd</option>
                </select>
            </label>
            <label class="add-label">Acad Year
                <select name="academicyear" class="input-field">
                    <option disabled selected></option>
                    <option>2023-2024</option>
                    <option>2024-2025</option>
                </select>
            </label>
            <label class="add-label">Student Type
                <select name="studenttype" class="input-field">
                    <option disabled selected></option>
                    <option>Freshmen</option>
                    <option>Transferee</option>
                    <option>Octoberian</option>
                </select>
            </label>
        </div>
    `;
}

    </script>

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
a{
  text-decoration: none;
  color: black;
}

.grid-container {
    display: grid;
    grid-template-columns: repeat(5, 1fr); /* 5 equal columns */
    gap: -10px; /* Space between columns */
}

.add-label {
    display: flex;
    flex-direction: column; /* Align label and input vertically */
}

.input-field {
    width: 70%; /* Make the input fields take full width */
    padding: 12px; /* Optional: add padding for input fields */
}

select {
    width: 70%; /* Match the width of select fields to input fields */
    padding: 10px; /* Optional: add padding for select fields */
}

</style>
</body>
</html>
