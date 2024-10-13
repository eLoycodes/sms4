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
<style>
  a{
    text-decoration: none;
    color: black;
  }
</style>
<body>
    <!-- navbar -->
    <?php include('navbar.php'); ?>
   <!-- end navbar -->

    <div class="pending-frame1">
        <div class="pending-frame2"><br><br>
          <span class="dashboardName"><b>Student Information</b></span><br>
          <h1 class="dashboardAnnouncement">Returnee Tracking</h1>
        </div><br>
        <div class="deactivatelistForm-frame">
        <div class="deactivate-form">
            <label class="deac-label">Search Student ID:</label>
            <input type="text" name="deac-search" class="search-deac">
            <button type="submit" name="submit" class="search-deac-btn">Search</button>
        </div>
        <table class="deactform-table">
            <tr>
              <th class="rf">Track ID</th>
              <th class="rf">Student ID</th>
              <th class="rf">Full Name</th>
              <th class="rf">Status</th>
              <th class="rf">Action</th>
            </tr>
            <?php
        
            include('connect.php'); 
              $s="SELECT * from returnee";
              $res=$connect->query($s);
              if($res->num_rows>0){
              $i=0;
              while($r=$res->fetch_assoc()){
                $i++;
             echo"
              <tr>
                <td>{$r["trackID"]}</td>
                <td>{$r["studentID"]}</td> 
                <td>{$r["firstname"]}  {$r["middlename"]}  {$r["lastname"]}</td>
                <td>{$r["status"]}</td>  
                <td><button onclick='id01'><a href='admin-PendingStudent.php?userid={$r["returnee_id"]}'>View</a></button></td>	
                </tr>
                "; 
          }
        }
        else{   
            echo "No Record Found";
        }
        ?>     
            <!--<tr class="reqf">
              <td class="req">200</td>
              <td class="req">1</td>
              <td class="req">Evaluation Grade</td>
              <td class="req">200</td>
              <td class="req"><a href="#"><button class="reqform-btn" onclick="document.getElementById('id01').style.display='block'">Deactivate</button></a></td>
            </tr>-->
          </table>
        </div>
          <!-- Deactivated List -->

          <div class="requestForm-frame3"><br><br>
            <h1 class="dashboardAnnouncement">Transferee Tracking</h1>
          <div class="deactivated-form">
            <label class="deac-label">Search Track ID:</label>
            <input type="text" name="deac-search" class="search-deac">
            <button type="submit" name="submit" class="search-deac-btn">Search</button>
        </div>
          <table class="requestform-table1">
              <tr>
                <th class="rf">Track ID</th>
                <th class="rf">Last Name</th>
                <th class="rf">First Name</th>
                <th class="rf">Last School</th>
                <th class="rf">Prev Course</th>
                <th class="rf">Prev Year</th>
                <th class="rf">Date Submitted</th>
                <th class="rf">Status</th>
                <th class="rf">Action</th>
              </tr>
              <?php
        
            include('connect.php'); 
              $s="SELECT * from transferee";
              $res=$connect->query($s);
              if($res->num_rows>0){
              $i=0;
              while($r=$res->fetch_assoc()){
                $i++;
             echo"
              <tr>
                <td>{$r["trackID"]}</td>
                <td>{$r["lastname"]}</td>
                <td>{$r["firstname"]}</td> 
                <td>{$r["lastschool"]}</td>              
                <td>{$r["prevcourse"]}</td> 
                <td>{$r["prevyear"]}</td>  
                <td>{$r["datesubmitted"]}</td>  
                <td>{$r["status"]}</td>  
                <td><button onclick='id01'><a href='admin-PendingStudent.php?userid={$r["transferee_id"]}'>View</a></button></td>	
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
          <div id="id01" class="modal">
            <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal"></span>
            <form class="modal-content" action="/action_page.php">
              <div class="deactivate-container">
                <h1>Deactivate Account</h1>
                <p>Are you sure you want to deactivate this account?</p>
          
                <div class="clearfix">
                  <button type="button" class="cancelbtn">Cancel</button>
                  <button type="button" class="deletebtn">Delete</button>
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
