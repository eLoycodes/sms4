<?php
include("connect.php");

?>
 
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
            <span class="droplinks_name">Admin Profile</span>
            <i class="fa fa-caret-down"></i>
          </button>
          <div class="dropdown-container">
            <a class="dropdown-a" href="#"><span class="droplinks_name">Account</span></a>
            <a class="dropdown-a" href="#"><span class="droplinks_name">Security</span></a>
            <a class="dropdown-a" href="#"><span class="droplinks_name">Additional Information</span></a>
            <a class="dropdown-a" href="index.php"><span class="droplinks_name">Log Out</span></a>
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
            <a class="dropdown-a" href="admin-StudentPersonalInformation.php"><span class="droplinks_name">Student Personal Information</span></a>
            <a class="dropdown-a" href="admin-DeactivateList.php"><span class="droplinks_name">Deactivate List</span></a> 
            <a class="dropdown-a" href="admin-PendingStudent.php"><span class="droplinks_name">Pending Student</span></a> 
            <a class="dropdown-a" href="admin-RequestInformation.php"><span class="droplinks_name">Request Information</span></a> 
          </div>
          </div>

          <div class="dropdownSectionManagement">
            <button class="dropdown-btn"> <i class='bx bx-user' ></i>
              <span class="droplinks_name">Section Management</span>
              <i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-container">
              <a class="dropdown-a" href="admin-AddStudent.php"><span class="droplinks_name">Add Student</span></a>
              <a class="dropdown-a" href="admin-SectionList.php"><span class="droplinks_name">Section List</span></a>
              <a class="dropdown-a" href="admin-MasterList.php"><span class="droplinks_name">Master List</span></a> 
              <a class="dropdown-a" href="admin-ManageClass.php"><span class="droplinks_name">Manage Class</span></a> 
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
          <a class="dropdown-a" href="admin-DocumentRequest.php"><span class="droplinks_name">Document Request</span></a>
          <a class="dropdown-a" href="admin-DocumentSubmit.php"><span class="droplinks_name">Document Submit</span></a>
          <a class="dropdown-a" href="admin-PayLater.php"><span class="droplinks_name">Pay Later</span></a>
          <a class="dropdown-a" href="admin-ReleaseHistory.php"><span class="droplinks_name">release history</span></a>    
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
            <a class="dropdown-a" href="admin-Course.php"><span class="droplinks_name">Courses</span></a>   
          </div>
          </div>

        <table class="otherService"><br><br>
          <span class="main"><b>OTHER SERVICES</b></span><br>
          <tr>
            <td>
              <ul class="nav-links">
              <li>
                <a href="sendmail.php">
                  <i class='bx bx-file' ></i>
                  <span class="links_name">Email</span>
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
    <style>
      /* Base styles for the upper navigation */
#uppernav {
    background-color: #333; /* Background color */
    padding: 10px; /* Padding around the nav */
}

.upnav {
    display: flex; /* Use flexbox for alignment */
    justify-content: space-between; /* Space between items */
    align-items: center; /* Center vertically */
}

.openbtn {
    background-color: #555; /* Button background */
    color: white; /* Button text color */
    border: none; /* No border */
    padding: 10px 15px; /* Padding inside the button */
    cursor: pointer; /* Pointer cursor on hover */
    border-radius: 4px; /* Rounded corners */
}

/* Media queries for responsiveness */

/* Extra Small Devices (phones, less than 321px) */
@media (max-width: 320px) {
    #uppernav {
        padding: 5px; /* Adjust padding */
    }

    .openbtn {
        width: 100%; /* Full width button */
        padding: 8px; /* Adjust padding */
        font-size: 14px; /* Smaller font size */
    }
}

/* Small Devices (phones, 321px to 750px) */
@media (min-width: 321px) and (max-width: 750px) {
    #uppernav {
        padding: 5px; /* Adjust padding */
    }

    .openbtn {
        padding: 8px 12px; /* Adjust button padding */
        font-size: 14px; /* Smaller font size */
    }
}

/* Medium Devices (tablets, 751px to 1024px) */
@media (min-width: 751px) and (max-width: 1024px) {
    #uppernav {
        padding: 10px; /* Standard padding */
    }

    .openbtn {
        padding: 10px 15px; /* Standard button padding */
        font-size: 16px; /* Standard font size */
    }
}

/* Large Devices (desktops, 1025px and above) */
@media (min-width: 1025px) {
    #uppernav {
        padding: 10px; /* Standard padding */
    }

    .openbtn {
        padding: 10px 20px; /* Larger button padding */
        font-size: 18px; /* Larger font size */
    }
}

      </style>