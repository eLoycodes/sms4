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
                  <td><span class="user-mail">20156548@bcp.edu.ph</span></td>    
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

    <div class="requestForm-frame1">
        <!-- dito ka mag simula-->
        <div class="requestForm-frame2"><br><br>
          <span class="dashboardName"><b>Request Form</b></span><br>
          <h1 class="dashboardAnnouncement">Student Request Form List</h1>
        </div><br>

        <table class="requestform-table">
            <tr>
              <th class="rf">No.</th>
              <th class="rf">Student Number</th>
              <th class="rf">Student Name</th>
              <th class="rf">Action</th>
            </tr>
            <tr class="reqf">
              <td class="req">1</td>
              <td class="req">21141596</td>
              <td class="req">Illumi</td>
              <td class="req"><a href="#"><button class="reqform-btn" onclick="document.getElementById('sf01').style.display='block'">Send&nbspRequest</button></a></td>
            </tr>
            <tr>
              <td class="req">2</td>
              <td class="req">21344685</td>
              <td class="req">Nami</td>
              <td class="req"><a href="#"><button class="reqform-btn" onclick="document.getElementById('sf01').style.display='block'">Send&nbspRequest</button></a></td>
            </tr>
            <tr class="reqf">
              <td class="req">3</td>
              <td class="req">21411542</td>
              <td class="req">Kaido</td>
              <td class="req"><a href="#"><button class="reqform-btn" onclick="document.getElementById('sf01').style.display='block'">Send&nbspRequest</button></a></td>
            </tr>
            <tr>
              <td class="req">4</td>
              <td class="req">21055496</td>
              <td class="req">Shanks</td>
              <td class="req"><a href="#"><button class="reqform-btn" onclick="document.getElementById('sf01').style.display='block'">Send&nbspRequest</button></a></td>
          </tr>
          </table>

          <div id="sf01" class="modal">
            <span onclick="document.getElementById('sf01').style.display='none'" class="close" title="Close Modal"></span>
            <form class="modal-content" action="/action_page.php">
              <div class="modal-container">
                <h1>Send Form</h1>
                <hr>
                <label for="email"><b>Student Number</b></label>
                <input type="text" placeholder="Enter Student Number" name="studentNum" required>
          
                <label for="psw"><b>Student Name</b></label>
                <input type="text" placeholder="Student Name" name="studentName" required>
          
                <label for="psw-repeat"><b>Price</b></label>
                <input type="text" placeholder="200" name="formPrice" required> 
                <div class="clearfix">
                  <button type="button" onclick="document.getElementById('sf01').style.display='none'" class="cancelbtn">Cancel</button>
                  <button class="sendF" type="submit" class="signup">Send Form</button>
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

  var modal = document.getElementById('sf01');
  window.onclick = function(event){
    if (event.target == modal) {
        modal.style.display = "none";
    }
}





    </script>
</body>
</html>
