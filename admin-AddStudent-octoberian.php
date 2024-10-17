<?php
include("connect.php");

session_start();
if (!isset($_SESSION["id"])) {
    echo "<script>window.open('index.php?mes=Access Denied..','_self');</script>";
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


    <div class="octoberian-frame1">
        <div class="octoberian-frame2"><br><br>
          <span class="dashboardName"><b>Section Management</b></span><br>
          <h1 class="dashboardAnnouncement">Edit Octoberian</h1>
        </div>


        <div class="octoberian-form">
          <div class="octoberian-search">
            <label class="deac-label">Search Student ID:</label>
            <input type="text" name="deac-search" class="search-deac">
            <button type="submit" name="submit" class="search-deac-btn">Search</button>
          </div>
        <table class="octoberian-table">
            <tr>
              <th class="rf">Student&nbspID</th>
              <th class="rf">Name</th>
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

        <div class="octoberian-form1">
          <tr>
            <td class="trans-td"><h3 class="edit-heading" style="font-size: 18px;">Select Subject that will take</h3></td>
        </tr>
        <table class="octoberian-table1">
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

        <!--

        <div class="transferee-form">
            <label class="deac-label">Search Student ID:</label>
            <input type="text" name="deac-search" class="search-deac">
            <button type="submit" name="submit" class="search-deac-btn">Search</button>
        </div>
        <table class="requestform-table">
            <tr>
              <th class="rf">Student&nbspID</th>
              <th class="rf">Name</th>
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
            <tr>
                <td class="req">1</td>
                <td class="req">Evaluation Grade</td>    
                <td class="req">Evaluation Grade</td>               
                <td class="req">1</td>
                <td class="req">Evaluation Grade</td>
                <td class="req">200</td>
                
            </tr>
            <tr class="reqf">
                <td class="req">1</td>
                <td class="req">Evaluation Grade</td>    
                <td class="req">Evaluation Grade</td>
                <td class="req">1</td>
                <td class="req">Evaluation Grade</td>
                <td class="req">200</td>
            </tr>
            <tr>
                <td class="req">1</td>
                <td class="req">Evaluation Grade</td>
                <td class="req">Evaluation Grade</td>              
                <td class="req">1</td>
                <td class="req">Evaluation Grade</td>
                <td class="req">200</td>
                
            </tr>
          </table>

         
          <table class="transferee-table">
            <tr>
                <td class="trans-td"><h3 class="trans-heading">Select Subject that will take</h3></td>
            </tr>
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
                
                <td class="trans-td">DB1</td>
                <td class="trans-td">Database 1</td>
                <td class="trans-td">1st</td>
                <td class="req"><a href="#"><button class="reqform-btn">Add</button></a></td>
            </tr>
            <tr class="trans-tr">
                <td class="trans-td">-</td>  
                <td class="trans-td">DB1</td>
                <td class="trans-td">Database 1</td>
                <td class="trans-td">1st</td>
                
            </tr>
          </table>  -->
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
