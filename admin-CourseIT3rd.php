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
    <div class="requestForm-frame1">
        <div class="requestForm-frame2"><br><br>
          <span class="dashboardName"><b>Section Management</b></span><br>
          <h1 class="dashboardAnnouncement">Subject List</h1>
        </div>
        <div class="filtercourse-frame">
          <h6 class="filtername">BS - Information Technology (Third Year)</h6>
          <h1 class="dashboardAnnouncement" style="font-size: 18px;">Year Level
            <select required onchange="location = this.value;" class="filterbox">
                <option disabled selected></option>
                <option value=admin-CourseIT.html>First Year</option>
                <option value=admin-CourseIT2nd.html>Second Year</option>
                <option value=admin-CourseIT3rd.html>Third Year</option>
                <option value=admin-CourseIT4th.html>Forth Year</option>
            </select>
          </h1>
        </div>
        <div class="sectionlist-container">
            <div class="sectionlistinfo-header">
                <h1 class="requestinfo" style="font-size: 18px;">1st Sem</h1>

            <table class="request-table">
              <tr>
                <th class="requestcon">NO.</th>
                <th class="requestcon">&nbsp&nbsp</th>
                <th class="requestcon">&nbsp&nbsp</th>
                <th class="requestcon">Subject Code</th>
                <th class="requestcon">Subject Name</th>
              </tr>
              <tr>   
                <td class="reqdata">01</td>
                <td class="reqdata"></td>
                <td class="reqdata"></td>
                <td class="reqdata">Juan Dela Cruz</td>
                <td class="reqdata">BSIT</td>
              </tr>
              <tr>
                <td class="reqdata">02</td>
                <td class="reqdata"></td>
                <td class="reqdata"></td>
                <td class="reqdata">Pedro Puyat</td>
                <td class="reqdata">BSIT</td>
              </tr>
            </table><br>
        </div>
    </div>

    <!--Section List Container 2-->

    <div class="sectionlist-container1">
        <div class="sectionlistinfo-header1">
            <h1 class="requestinfo" style="font-size: 18px;">2nd Sem</h1>

            <table class="request-table">
                <tr>
                  <th class="requestcon">NO.</th>
                  <th class="requestcon">&nbsp&nbsp</th>
                  <th class="requestcon">&nbsp&nbsp</th>
                  <th class="requestcon">Subject Code</th>
                  <th class="requestcon">Subject Name</th>
                </tr>
                <tr>   
                  <td class="reqdata">01</td>
                  <td class="reqdata"></td>
                  <td class="reqdata"></td>
                  <td class="reqdata">Juan Dela Cruz</td>
                  <td class="reqdata">BSIT</td>
                </tr>
                <tr>
                  <td class="reqdata">01</td>
                  <td class="reqdata"></td>
                  <td class="reqdata"></td>
                  <td class="reqdata">Pedro Puyat</td>
                  <td class="reqdata">BSIT</td>
                </tr>
              </table><br>
    </div>
</div>
        
    </div>
</div><br>




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
