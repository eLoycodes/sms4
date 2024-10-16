<?php

include("connect.php");
session_start();
if(!isset($_SESSION["id"])){
		echo"<script>window.open('index.php?mes=Access Denied..','_self');</script>";
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

    <div class="requestForm-frame1">
        <!-- dito ka mag simula-->
        <div class="requestForm-frame2"><br><br>
          <span class="dashboardName"><b>Section Management</b></span><br>
          <h1 class="dashboardAnnouncement">Add Student</h1>
        </div>

        <div class="fields">
          <div class="box-fields">
            <label class="fields-label">New Student</label>
            <a href="admin-AddStudent-newold.php"><button type="submit" name="submit" class="addStud-btn">Add Student</button></a>
          </div>
          <div class="box-fields">
            <label class="fields-label">Transferee Student</label>
            <a href="admin-AddStudent-transferee.php"><button type="submit" name="submit" class="addStud-btn">Add Student</button></a>
          </div>
          <div class="box-fields">
            <label class="fields-label">Edit Student</label>
            <a href="admin-AddStudent-edit.php"><button type="submit" name="submit" class="addStud-btn">Add Student</button></a>
          </div>
          <div class="box-fields">
            <label class="fields-label">Octoberian Student</label>
            <a href="admin-AddStudent-octoberian.php"><button type="submit" name="submit" class="addStud-btn">Add Student</button></a>
          </div>
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
