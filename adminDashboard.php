<?php

include("connect.php");
ini_set('session.cookie_httponly', 1);
ini_set('session.cookie_secure', 1);
ini_set('session.use_only_cookies', 1);
session_start();

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

if(!isset($_SESSION["id"])){
		echo"<script>window.open('index.php?mes=Access Denied..','_self');</script>";
	}	

  $total_students = 0; // Variable to hold total number of students
  $firsyeartotal_students = 0;
  $secondyeartotal_students = 0;
  $thirdyeartotal_students = 0;
  $forthyeartotal_students = 0;
  
  // Query to count total number of students in each year
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
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
</head>

<body>
   <!-- navbar -->
   <?php include('navbar.php'); ?>
   <!-- end navbar -->
    
    <section class="home-section">
      <div class="frame2"><br><br>
        <span class="dashboardName"><b>Dashboard</b></span><br>
        <h1 class="dashboardAnnouncement">Admin Dashboard</h1>
      </div>
      <div class="home-content">
        <div class="overview-boxes">
          <div class="box">
            <div class="right-side">
              <div class="box-topic">1st Year</div><br>
              <div class="number">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<?php echo $firsyeartotal_students; ?></div>
              <div class="indicator">
                     
              </div>
            </div>
            
          </div>
          <div class="box">
            <div class="right-side">
              <div class="box-topic">2nd Year</div><br>
              <div class="number">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<?php echo $secondyeartotal_students; ?></div>
              <div class="indicator">
              </div>
            </div>
            
          </div>
          <div class="box">
            <div class="right-side">
              <div class="box-topic">3rd Year</div><br>
              <div class="number">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<?php echo $thirdyeartotal_students; ?></div>
              <div class="indicator">
               </div>
            </div>
          </div>
          <div class="box">
            <div class="right-side">
              <div class="box-topic">4th Year</div><br>
              <div class="number">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<?php echo $forthyeartotal_students; ?></div>     
              <div class="indicator">           
              </div>
            </div>
          </div>
        </div>
          <div class="report-container">
            <div class="report-header">
                <h1 class="new">Pending Students</h1>
                <button class="view">View All</button>
            </div>

            <table class="repcon">  
              <tr>
                <th class="rcon">First Name</th>
                <th class="rcon">Middle Name</th>
                <th class="rcon">Last Name</th>
                <th class="rcon">Course</th>
                <th class="rcon">Year Level</th>
                <th class="rcon">Action</th>
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
             
              <td><button><a href='admin-AddStudent-newold.php?userid={$r["newstudent_id"]}'>Add Student</a></button></td>	
              </tr>
              ";	
                  }
              }
              ?>     
            </table><br><br>
      
        </div><br>
        <div class="sales-boxes">
    <div class="top-sales box">
        <div class="title">Announcement</div>
        <form action="upload.php" method="post" enctype="multipart/form-data" id="uploadForm">
            <div class="announcement-btn">
                <input type="file" name="announcementFile" class="announcement-button" required id="fileInput" style="display: none;">
                <button type="button" id="uploadButton">Choose File</button>
                <button type="submit" id="submitButton" style="display: none;">Upload File</button>
            </div>
        </form>
        <ul class="top-sales-details" id="fileList">
            <!-- Optional: Display uploaded files or announcements here -->
        </ul>
    </div><br><br>
</div>

    </section>
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


//announcement

const fileInput = document.getElementById('fileInput');
    const uploadButton = document.getElementById('uploadButton');
    const submitButton = document.getElementById('submitButton');
    const fileList = document.getElementById('fileList');

    uploadButton.addEventListener('click', function() {
        fileInput.click(); 
    });

    fileInput.addEventListener('change', function() {
 
        fileList.innerHTML = '';

   
        const file = this.files[0];
        if (file) {

            const listItem = document.createElement('li');
            listItem.textContent = file.name;

            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                listItem.appendChild(img);
            };
            reader.readAsDataURL(file);

            fileList.appendChild(listItem);
            submitButton.style.display = 'inline-block';
        }
    });
</script>

<style>
    a{
        text-decoration: none;
        color: black;
    }
    
    .announcement-btn {
        position: relative;
    }

    #uploadButton {
        background-color: rgb(78, 78, 78); /* Green */
        color: white;
        border: none;
        padding: 10px 20px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        cursor: pointer;
    }

    #submitButton {
        background-color: #007BFF; /* Blue */
        color: white;
        border: none;
        padding: 10px 20px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        cursor: pointer;
        margin-left: 10px; 
    }

    .top-sales-details {
        list-style: none; 
        padding: 0; 
        text-align: center; 
    }

    .top-sales-details li {
        margin: 10px 0; 
    }

    .top-sales-details img {
        display: block; 
        margin: 0 auto; 
        max-width: 130px; 
        height: auto; 
    }


/* Base styles for body and containers */
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f8f9fa; /* Light background for contrast */
}

.home-section {
    padding: 20px;
}

/* Navbar */
.navbar {
    background-color: #343a40;
    color: white;
}

/* Dashboard Title */
.dashboardName {
    font-size: 24px;
}

.dashboardAnnouncement {
    font-size: 32px;
    font-weight: bold;
}

/* Overview Boxes */
.overview-boxes {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    margin-bottom: 20px;
}

.box {
    background-color: #f4f4f4;
    padding: 20px;
    margin: 10px;
    flex: 1 1 200px; /* Flexbox allows growth and shrink */
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.box-topic {
    font-size: 18px;
    font-weight: bold;
}

.number {
    font-size: 24px;
}

/* Report Container */
.report-container {
    margin-top: 20px;
}

.report-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.repcon {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
}

.rcon {
    padding: 10px;
    text-align: left;
    background-color: #e9ecef;
}

/* Sales Box */
.sales-boxes {
    display: flex;
    flex-direction: column;
    margin-top: 20px;
}

.top-sales {
    background-color: #ffffff;
    padding: 20px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.announcement-btn {
    display: flex;
    align-items: center;
    margin-top: 10px;
}

/* Buttons */
button {
    cursor: pointer;
    border: none;
    color: white;
    padding: 10px 20px;
}

#uploadButton {
    background-color: rgb(78, 78, 78); /* Dark gray */
}

#submitButton {
    background-color: #007BFF; /* Blue */
    margin-left: 10px;
}

/* Top Sales Details */
.top-sales-details {
    list-style: none;
    padding: 0;
    text-align: center;
}

.top-sales-details li {
    margin: 10px 0;
}

.top-sales-details img {
    display: block;
    margin: 0 auto;
    max-width: 130px;
    height: auto;
}

/* Responsive styles */
@media (max-width: 768px) {
    .overview-boxes {
        flex-direction: column;
        align-items: center;
    }

    .box {
        width: 100%; /* Full width for smaller screens */
        margin: 5px 0; /* Reduce margins */
    }

    .report-container, .sales-boxes {
        margin: 0; /* Remove extra margins */
    }
}

@media (max-width: 480px) {
    .dashboardName {
        font-size: 20px; /* Smaller title for mobile */
    }

    .dashboardAnnouncement {
        font-size: 24px; /* Smaller announcement for mobile */
    }

    .number {
        font-size: 20px; /* Smaller numbers for mobile */
    }

    #uploadButton, #submitButton {
        width: 100%; /* Full width buttons */
        margin: 5px 0; /* Space between buttons */
    }

    .top-sales-details img {
        max-width: 100px; /* Smaller images */
    }
}

    
</style>
</body>
</html>
