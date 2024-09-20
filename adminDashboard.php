<?php

include("connect.php");
session_start();
if(!isset($_SESSION["id"])){
		echo"<script>window.open('login.php?mes=Access Denied..','_self');</script>";
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
                <td><span class="user-name"><b>Lexi Crempie Lore</b></span></td>
              </tr>
              <tr>
                  <td> <span class="user-mail">20156548@bcp.edu.ph</span></td>    
              </tr>
            </table>        
        </ul><br>

        <table class="dashboard">
          <tr>
            <td>
              <ul class="nav-links">
              <li>
                <a href="adminDashboard.php">
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
            <span class="droplinks_name">Sms Profile</span>
            <i class="fa fa-caret-down"></i>
          </button>
          <div class="dropdown-container">
            <a class="dropdown-a" href="#"><span class="droplinks_name">Account</span></a>
            <a class="dropdown-a" href="#"><span class="droplinks_name">Security</span></a>
            <a class="dropdown-a" href="#"><span class="droplinks_name">Additional Information</span></a>
          </div>
          </div><br>

        <table class="administrative"><br><br>
          <span class="main"><b>ADMINISTRATIVE</b></span><br>
          <span class="sub"><b>Administrative Control</b></span>
          <tr>
            <td>
              <ul class="nav-links">
              <li>
                <a href="#">
                  <i class='bx bx-user' ></i>
                  <span class="links_name">Administration</span>
                </a>
              </li>
            </ul>   
            </td>
          </tr>            
        </table>

        <table class="admission"><br><br>
          <span class="main"><b>ADMISSION</b></span><br>
          <span class="sub"><b>Student Admission</b></span>
          <tr>
            <td>
              <ul class="nav-links">
              <li>
                <a href="#">
                  <i class='bx bx-file' ></i>
                  <span class="links_name">Student Download</span>
                </a>
              </li>
            </ul>   
            </td>
          </tr>            
        </table>

        <div class="dropdownrequestForm">
          <button class="dropdown-btn"> <i class='bx bx-user' ></i>
            <span class="droplinks_name">Pay Later</span>
            <i class="fa fa-caret-down"></i>
          </button>
          <div class="dropdown-container">
            <a class="dropdown-a" href="adminRequestForm.php"><span class="droplinks_name">Request Form</span></a>
            <a class="dropdown-a" href="adminStudentRequestedForm.php"><span class="droplinks_name">Student Requested Form</span></a>
            <a class="dropdown-a" href="#"><span class="droplinks_name">History</span></a> 
          </div>
          </div><br>

        <div class="dropdownCashier">
        <span class="main"><b>CASHIERING</b></span><br>
        <span class="sub"><b>Cashiering Action</b></span><br><br><br>
        <button class="dropdown-btn"> <i class='bx bx-money' ></i>
          <span class="droplinks_name">Cashiering</span>
          <i class="fa fa-caret-down"></i>
        </button>
        <div class="dropdown-container">
          <a class="dropdown-a" href="#"><span class="droplinks_name">Receipt Tracker</span></a>
          <a class="dropdown-a" href="#"><span class="droplinks_name">Class Loading</span></a>
          <a class="dropdown-a" href="#"><span class="droplinks_name">Registrar Grade</span></a>
          <a class="dropdown-a" href="#"><span class="droplinks_name">Approval</span></a>    
        </div>
        </div><br>

        <div class="dropdownEnrollment">
          <span class="main"><b>ENROLLMENT</b></span><br>
          <span class="sub"><b>Enrollment Information</b></span><br><br><br>
          <button class="dropdown-btn"> <i class='bx bx-file' ></i>
            <span class="droplinks_name">Enrollment</span>
            <i class="fa fa-caret-down"></i>
          </button>
          <div class="dropdown-container">
            <a class="dropdown-a" href="#"><span class="droplinks_name">Create&nbspStudent&nbspRecord</span></a>
            <a class="dropdown-a" href="#"><span class="droplinks_name">Enroll Student</span></a>
            <a class="dropdown-a" href="#"><span class="droplinks_name">Student Subject</span></a>
            <a class="dropdown-a" href="#"><span class="droplinks_name">Pending Student</span></a>   
            <a class="dropdown-a" href="#"><span class="droplinks_name">Student Records</span></a>    
            <a class="dropdown-a" href="#"><span class="droplinks_name">Student AD</span></a>   
            <a class="dropdown-a" href="#"><span class="droplinks_name">Student Withdrawal</span></a>   
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

    <div class="frame1">
        <!-- dito ka mag simula-->
        <div class="frame2"><br><br>
          <span class="dashboardName"><b>Dashboard</b></span><br>
          <h1 class="dashboardAnnouncement">Announcements</h1>
        </div>

        <div class="dashboardContent">
          <div class="box">
          <form class="studentInfo"><br>
                <i style="color: black; font-size: 24px"  class='bx bx-user'></i> <span class="studentName">Lexi Creampie Lore</span><br><br>
                <p class="studentInfo1"><b>Course: Bachelor of Science in Information Technology</b></p>
                <p class="studentInfo1"><b>Admission Type: Continuing</b></p>
                <p class="studentInfo1"><b>School ID: 21041526</b></p>
                <p class="studentInfo1"><b>4th Year College</b></p>
          </form>
          </div>
          
        </div>
        <div class="dashboardContent">
          <div class="box1">
          <form class="adviserInfo"><br>
                <i style="color: black; font-size: 24px"  class='bx bx-user'></i> <span class="adviserName">ADVISER</span><br><br>
                <p class="studentInfo1"><b>Name: Mia Khalifa</b></p>
                <p class="studentInfo1"><b>My Section: 4102</b></p>
          </form>
          </div>
        </div>

        <div class="announcementContent">
          <div class="box2">
          <form class="announcementInfo">
                <i style="color: black; font-size: 24px"  class='bx bx-bell'></i> <span class="announcementName">Announcement</span><br><br>

          <!-- Pagination -->
          <section class="gallery">
            <div class="containers">
              <div class="gallery-items">
                <div class="item">
                  <img src="image/announce1.png" alt="gallery" />
                </div>

                <div class="item">
                  <img src="image/announce.png" alt="gallery" />
                </div>

                <div class="item">
                  <img src="image/lockers.jpg" alt="gallery" />
                </div>

                <div class="item">
                  <img src="image/lex.jpg" alt="gallery" />
                </div>

              </div>
              <div class="pagination">
                <div class="prev">Prev</div>
                <div class="page">Page <span class="page-num"></span></div>
                <div class="next">Next</div>
              </div>
            </div>
          </section>
          </form>
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
