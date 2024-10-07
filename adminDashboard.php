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
            <span class="droplinks_name">Admnin Profile</span>
            <i class="fa fa-caret-down"></i>
          </button>
          <div class="dropdown-container">
            <a class="dropdown-a" href="#"><span class="droplinks_name">Account</span></a>
            <a class="dropdown-a" href="#"><span class="droplinks_name">Security</span></a>
            <a class="dropdown-a" href="#"><span class="droplinks_name">Additional Information</span></a>
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
              <div class="number">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp--</div>
              <div class="indicator">
                     
              </div>
            </div>
            
          </div>
          <div class="box">
            <div class="right-side">
              <div class="box-topic">2nd Year</div><br>
              <div class="number">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp--</div>
              <div class="indicator">
              </div>
            </div>
            
          </div>
          <div class="box">
            <div class="right-side">
              <div class="box-topic">3rd Year</div><br>
              <div class="number">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp--</div>
              <div class="indicator">
               </div>
            </div>
          </div>
          <div class="box">
            <div class="right-side">
              <div class="box-topic">4th Year</div><br>
              <div class="number">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp--</div>       
              <div class="indicator">           
              </div>
            </div>
          </div>
        </div>
          <div class="report-container">
            <div class="report-header">
                <h1 class="new">New Enrolled Students</h1>
                <button class="view">View All</button>
            </div>

            <table class="repcon">  
              <tr>
                <th class="rcon">Student ID</th>
                <th class="rcon">Name</th>
                <th class="rcon">Course</th>
                <th class="rcon">Section</th>
                <th class="rcon">Action</th>
              </tr>
              <?php
                
              include('connect.php'); 
              $s="SELECT * from student";
              $res=$connect->query($s);
              if($res->num_rows>0){
              $i=0;
              while($r=$res->fetch_assoc()){
              $i++;
              echo"
              <tr>
              <td>{$r["studentid"]}</td>
              <td>{$r["firstname"]} {$r["lastname"]}</td>  
              <td>{$r["course"]}</td>               
              <td>{$r["section"]}</td> 
              <td><button><a href='#?userid={$r["sid"]}'>View</a></button></td>	
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
            <div class="announcement-btn">
              <button type="file" class="announcement-button">Upload File</button>
            </div>
            <ul class="top-sales-details">
              
          </div><br><br>
        </div>
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

// Pagination

const galleryItems=document.querySelector(".gallery-items").children;
 const prev=document.querySelector(".prev");
 const next=document.querySelector(".next");
 const page=document.querySelector(".page-num");
 const maxItem=1;
 let index=1;
  
  const pagination=Math.ceil(galleryItems.length/maxItem);
  console.log(pagination)

  prev.addEventListener("click",function(){
    index--;
    check();
    showItems();
  })
  next.addEventListener("click",function(){
  	index++;
  	check();
    showItems();  
  })

  function check(){
  	 if(index==pagination){
  	 	next.classList.add("disabled");
  	 }
  	 else{
  	   next.classList.remove("disabled");	
  	 }

  	 if(index==1){
  	 	prev.classList.add("disabled");
  	 }
  	 else{
  	   prev.classList.remove("disabled");	
  	 }
  }

  function showItems() {
  	 for(let i=0;i<galleryItems.length; i++){
  	 	galleryItems[i].classList.remove("show");
  	 	galleryItems[i].classList.add("hide");


  	    if(i>=(index*maxItem)-maxItem && i<index*maxItem){
  	 	  // if i greater than and equal to (index*maxItem)-maxItem;
  		  // means  (1*8)-8=0 if index=2 then (2*8)-8=8
          galleryItems[i].classList.remove("hide");
          galleryItems[i].classList.add("show");
  	    }
  	    page.innerHTML=index;
  	 }

  	 	
  }

  window.onload=function(){
  	showItems();
  	check();
  }

    </script>
</body>
</html>
