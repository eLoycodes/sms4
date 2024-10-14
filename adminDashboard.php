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
    echo "<script>window.open('index.php?mes=Access Denied..','_self');</script>";
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
    <!-- navbar -->
    <?php include('navbar.php'); ?>
    <!-- end navbar -->
    
    <section class="home-section">
        <div class="container mt-4">
            <div class="text-center">
                <span class="dashboardName"><b>Dashboard</b></span><br>
                <h1 class="dashboardAnnouncement">Admin Dashboard</h1>
            </div>
            <div class="row home-content">
                <div class="col-md-3 mb-4">
                    <div class="card text-center">
                        <div class="card-body">
                            <div class="box-topic">1st Year</div>
                            <div class="number"><?php echo $firsyeartotal_students; ?></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card text-center">
                        <div class="card-body">
                            <div class="box-topic">2nd Year</div>
                            <div class="number"><?php echo $secondyeartotal_students; ?></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card text-center">
                        <div class="card-body">
                            <div class="box-topic">3rd Year</div>
                            <div class="number"><?php echo $thirdyeartotal_students; ?></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card text-center">
                        <div class="card-body">
                            <div class="box-topic">4th Year</div>
                            <div class="number"><?php echo $forthyeartotal_students; ?></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="report-container mt-4">
                <div class="d-flex justify-content-between align-items-center">
                    <h1 class="new">Pending Students</h1>
                    <button class="btn btn-primary">View All</button>
                </div>

                <table class="table table-bordered mt-3">  
                    <thead>
                        <tr>
                            <th class="rcon">First Name</th>
                            <th class="rcon">Middle Name</th>
                            <th class="rcon">Last Name</th>
                            <th class="rcon">Course</th>
                            <th class="rcon">Year Level</th>
                            <th class="rcon">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include('connect.php'); 
                        $s="SELECT * from newstudent";
                        $res=$connect->query($s);
                        if($res->num_rows>0){
                            while($r=$res->fetch_assoc()){
                                echo "
                                <tr>
                                    <td>{$r["firstname"]}</td>
                                    <td>{$r["middlename"]}</td>
                                    <td>{$r["lastname"]}</td>  
                                    <td>{$r["course"]}</td>  
                                    <td>{$r["yearlevel"]}</td>
                                    <td><button class='btn btn-success'><a href='admin-AddStudent-newold.php?userid={$r["newstudent_id"]}' class='text-white'>Add Student</a></button></td>
                                </tr>
                                ";	
                            }
                        }
                        ?>     
                    </tbody>
                </table>
            </div>

            <div class="sales-boxes mt-4">
                <div class="card">
                    <div class="card-header">Announcement</div>
                    <div class="card-body">
                        <form action="upload.php" method="post" enctype="multipart/form-data" id="uploadForm">
                            <div class="announcement-btn mb-3">
                                <input type="file" name="announcementFile" class="announcement-button" required id="fileInput" style="display: none;">
                                <button type="button" id="uploadButton" class="btn btn-secondary">Choose File</button>
                                <button type="submit" id="submitButton" class="btn btn-primary" style="display: none;">Upload File</button>
                            </div>
                        </form>
                        <ul class="top-sales-details list-unstyled text-center" id="fileList"></ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

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
            dropdownContent.style.display = dropdownContent.style.display === "block" ? "none" : "block";
        });
    }

    // Announcement
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
        a {
            text-decoration: none;
            color: black;
        }

        .announcement-btn {
            position: relative;
        }

        .top-sales-details img {
            display: block; 
            margin: 0 auto; 
            max-width: 130px; 
            height: auto; 
        }
    </style>
</body>
</html>
