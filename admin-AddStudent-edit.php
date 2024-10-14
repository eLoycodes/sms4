<?php
include("connect.php");

session_start();
if (!isset($_SESSION["id"])) {
    echo "<script>window.open('index.php?mes=Access Denied..','_self');</script>";
}

$students = [];
$error_message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['studentID'])) {
    $student_ID_input = trim($_POST['studentID']);
    
    if (empty($student_ID_input)) {
        $error_message = "Student ID cannot be empty.";
    } elseif (!preg_match('/^[a-zA-Z0-9]+$/', $student_ID_input)) {
        $error_message = "Invalid Student ID format.";
    } else {
       
        $tables = [
            'deactivate',
            'deactivated',
            'firstyear',
            'secondyear',
            'thirdyear',
            'forthyear',
            'returnee'    
        ];

        foreach ($tables as $table) {
            
            $columns_result = $connect->query("SHOW COLUMNS FROM $table");
            $existing_columns = [];
            while ($column = $columns_result->fetch_assoc()) {
                $existing_columns[] = $column['Field'];
            }

            $selected_columns = ['studentID']; // Always include studentID
            $possible_columns = ['firstname', 'middlename', 'lastname', 'course', 'yearlevel', 'academicyear', 'semester', 'status', 'studenttype'];

            foreach ($possible_columns as $column) {
                if (in_array($column, $existing_columns)) {
                    $selected_columns[] = $column;
                }
            }

            $selected_columns_str = implode(', ', $selected_columns);
            $sql = "SELECT '$table' AS source, $selected_columns_str FROM $table WHERE studentID = ?";

            if ($stmt = $connect->prepare($sql)) {
                $stmt->bind_param("s", $student_ID_input);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $students[] = $row; // Store results
                    }
                }

                $stmt->close();
            } else {
                $error_message = "Database error: " . $connect->error; // Handle potential errors
            }
        }
        if (empty($students)) {
            $error_message = "No student found with ID: " . htmlspecialchars($student_ID_input);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <title>Sms4</title>
    <link rel="stylesheet" href="css/styles.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>
<body>
    <!-- navbar -->
    <?php include('navbar.php'); ?>
    <!-- end navbar -->

    <div class="edit-frame1">
        <div class="edit-frame2"><br><br>
          <span class="dashboardName"><b>Section Management</b></span><br>
          <h1 class="dashboardAnnouncement">Edit Student</h1>
        </div>

        <div class="edit-form">
    <form method="POST" action="">
        <div class="edit-search">
            <label class="deac-label">Search Student ID:</label>
            <input type="text" name="studentID" class="search-deac" required>
            <button type="submit" name="submit" class="search-deac-btn">Search</button>
            <button class="update-student-btn" id="open-modal" type="button" style="float: right;">Edit Student</button>
        </div>
    </form>

    <?php if (!empty($students)): ?>
    <div class="callout callout-info">
        <table class="edit-table">
            <tr>
                <th class="rf">Student ID</th>
                <th class="rf">Name</th>
                <th class="rf">Course</th>
                <th class="rf">Year Level</th>
                <th class="rf">Academic Year</th>
                <th class="rf">Semester</th>
                <th class="rf">Type</th>
                <th class="rf">Status</th>
            </tr>
            <?php foreach ($students as $student): ?>
            <tr>
                <td><?php echo htmlspecialchars($student['studentID']); ?></td>
                <td><?php echo htmlspecialchars($student['firstname'] . ' ' . $student['middlename'] . ' ' . $student['lastname']); ?></td>
                <td><?php echo htmlspecialchars($student['course'] ?? 'N/A'); ?></td>
                <td><?php echo htmlspecialchars($student['yearlevel'] ?? 'N/A'); ?></td>
                <td><?php echo htmlspecialchars($student['academicyear'] ?? 'N/A'); ?></td>
                <td><?php echo htmlspecialchars($student['semester'] ?? 'N/A'); ?></td>
                <td><?php echo htmlspecialchars($student['studenttype'] ?? 'N/A'); ?></td>
                <td><?php echo htmlspecialchars($student['status'] ?? 'N/A'); ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
  
    <?php elseif (!empty($error_message)): ?>
        <div class="error-message" style="margin-left: 7%; color: red; margin-top: 6%;"><?php echo htmlspecialchars($error_message); ?></div>
    <?php endif; ?>
</div>

<div class="edit-form0">
    <div class="trans-td">
        <h3 class="edit-heading" style="font-size: 16px; margin-top: 2%;">
            <?php echo htmlspecialchars($student['firstname'] ?? 'N/A'); ?> Subjects
        </h3>
        <button class="update-student-btn" type="button" id="add-subject-btn" style="float: right; margin-right: 3%; margin-top: 1.5%;">Add Subject</button>
        <button id="refreshSubjectsBtn" class="update-student-btn" style="float: right; margin-right: .5%; margin-top: 1.5%;">Refresh Subjects</button>
    </div>

    <table class="edit-table0">
        <tr>
            <th class="trans-th">Subject Code</th>
            <th class="trans-th">Subject Name</th>
            <th class="trans-th">Semester</th>
            <th class="trans-th">Action</th>
        </tr>
        <tbody id="subjectsTableBody">
        <?php
            include('connect.php'); 
            if (isset($student['studentID'])) {
                $studentID = $student['studentID'];
                $s = "SELECT * FROM student_subjects WHERE studentID = ?";
                $stmt = $connect->prepare($s);
                $stmt->bind_param('s', $studentID);
                $stmt->execute();
                $res = $stmt->get_result();

                if ($res->num_rows > 0) {
                    while ($r = $res->fetch_assoc()) {
                        ?>
                        <tr class="reqf">
                            <td class="req"><?php echo htmlspecialchars($r['subjectcode']); ?></td>
                            <td class="req"><?php echo htmlspecialchars($r['subjectname']); ?></td>
                            <td class="req"><?php echo htmlspecialchars($r['semester']); ?></td>
                            <td class="req">
                                <form method="POST" action="remove_subject.php" class="remove-form">
                                    <input type="hidden" name="studentID" value="<?php echo htmlspecialchars($studentID); ?>">
                                    <input type="hidden" name="subjectcode" value="<?php echo htmlspecialchars($r['subjectcode']); ?>">
                                    <button class="update-student-btn remove-button" name="submit" type="submit">Remove</button>
                                </form>
                            </td>
                        </tr>
                        <?php  
                    }
                } else {   
                    echo "<tr><td colspan='4' align='center'>No Record Found</td></tr>";
                }
            } else {
                echo "<tr><td colspan='4' align='center'>No Student Selected</td></tr>";
            }
        ?>
        </tbody>
    </table>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
    // Define the studentID variable from PHP
    var studentID = '<?php echo htmlspecialchars($student['studentID'] ?? ''); ?>';

    // Function to refresh subjects
    function refreshSubjects() {
        $.ajax({
            type: 'GET',
            url: 'fetch_subjects.php',
            data: { studentID: studentID },
            success: function(response) {
                $('#subjectsTableBody').html(response); 
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error fetching subjects:', textStatus, errorThrown);
                alert('Error fetching subjects: ' + textStatus);
            }
        });
    }

    $('#refreshSubjectsBtn').on('click', function() {
        refreshSubjects(); 
    });

    // Handle removing a subject
    $(document).on('submit', '.remove-form', function(e) {
        e.preventDefault();

        var form = $(this);
        $.ajax({
            type: 'POST',
            url: 'remove_subject.php',
            data: form.serialize(), 
            success: function(response) {
                form.closest('tr').remove();
                alert('Subject removed successfully.');
            },
            error: function() {
                alert('Error removing subject.');
            }
        });
    });
});
</script>

<div id="edit-form1" style="display: none;"> 
    <div class="callout callout-info">
    <div class="edit-form1">
    <div class="trans-td">
        <h3 class="edit-heading" style="font-size: 16px; margin-top: 5%;">Subjects</h3>
    </div>
    <form id="subjectForm">
        <table class="edit-table1">
            <tr>
                <th class="trans-th">Subject Code</th>
                <th class="trans-th">Subject Name</th>
                <th class="trans-th">Semester</th>
                <th class="trans-th">Action</th>
            </tr>
            <?php
            include('connect.php');

            // Handle the search functionality
            $searchQuery = "";
            if (isset($_POST['search-submit'])) {
                $searchQuery = trim($_POST['deac-search']);
                $s = "SELECT * FROM subject WHERE subjectname LIKE ?";
                $stmt = $connect->prepare($s);
                $likeSearch = "%" . $searchQuery . "%";
                $stmt->bind_param('s', $likeSearch);
                $stmt->execute();
                $res = $stmt->get_result();
            } else {
                $s = "SELECT * FROM subject";
                $res = $connect->query($s);
            }

            if ($res->num_rows > 0) {
                while ($r = $res->fetch_assoc()) {
                    ?>
                    <tr class="reqf">
                        <td class="req"><?php echo htmlspecialchars($r['subjectcode']); ?></td>
                        <td class="req"><?php echo htmlspecialchars($r["subjectname"]); ?></td>
                        <td class="req"><?php echo htmlspecialchars($r["semester"]); ?></td>
                        <td class="req">
                            <input type="checkbox" name="subjects[]" value="<?php echo htmlspecialchars($r['subjectcode']); ?>">
                        </td>
                    </tr>
                    <?php
                }
            } else {
                echo "<tr><td colspan='4'><p align='center'>No Record Found</td></tr>";
            }
            ?>
        </table>
        <input type="hidden" name="studentID" value="<?php echo htmlspecialchars($studentID); ?>">
        <button type="submit" id="addSubjectBtn" class="update-student-btn" style="float: right; margin-right: 3%; margin-top: 3%;">Add Subject</button>
    </form>
    <div id="responseMessage" style="margin-top: 10px;"></div> <!-- For displaying success/error messages -->
</div>

<script>
$(document).ready(function() {
    $('#subjectForm').on('submit', function(e) {
        e.preventDefault(); // Prevent the default form submission

        $.ajax({
            type: 'POST',
            url: 'add_subject.php', // Your PHP file to handle the request
            data: $(this).serialize(), // Serialize the form data
            success: function(response) {
                $('#responseMessage').html(response); // Display the response
                // Optionally, you can also clear the checkboxes or update the table without refreshing
            },
            error: function() {
                $('#responseMessage').html('Error adding subjects.'); // Handle errors
            }
        });
    });
});
</script>

<div class="edit-form2">
    <tr>
        <td class="trans-td"><h3 class="edit-heading" style="font-size: 16px; margin-top: 5%;">Subject removed</h3></td>
        <button id="refreshRemoveSubjectsBtn" class="update-student-btn" style="float: right; margin-right: 5%; margin-top: 4.5%;">Refresh Subjects</button>
    </tr>
    <table class="edit-table2">
        <tr>
            <th class="trans-th">Subject Code</th>
            <th class="trans-th">Subject Name</th>
            <th class="trans-th">Semester</th>
        </tr>
        <tbody id="removedSubjectsTableBody">
        <?php
            include('connect.php');
            $studentID = $student['studentID'] ?? null;

            if ($studentID) {
                $s = "SELECT * FROM subject_removed WHERE studentID = ?";
                $stmt = $connect->prepare($s);
                $stmt->bind_param('s', $studentID);
                $stmt->execute();
                $res = $stmt->get_result();

                if ($res->num_rows > 0) {
                    while ($r = $res->fetch_assoc()) {
                        ?>
                        <tr class="reqf">
                            <td class="req"><?php echo htmlspecialchars($r['subjectcode']); ?></td>
                            <td class="req"><?php echo htmlspecialchars($r["subjectname"]); ?></td>
                            <td class="req"><?php echo htmlspecialchars($r["semester"]); ?></td>
                        </tr>
                        <?php
                    }
                } else {
                    echo "<tr><td colspan='3'><p align='center'>No Record Found</p></td></tr>";
                }

                $stmt->close();
            } else {
                echo "<tr><td colspan='3'><p align='center'>No Student Selected</p></td></tr>";
            }
        ?>
        </tbody>
    </table>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
    var studentID = '<?php echo htmlspecialchars($student['studentID'] ?? ''); ?>';

    // Function to refresh the removed subjects table
    function refreshRemovedSubjects() {
        $.ajax({
            type: 'GET',
            url: 'fetch_removed_subjects.php', // Adjust the URL to point to the correct PHP file
            data: { studentID: studentID },
            success: function(response) {
                $('#removedSubjectsTableBody').html(response); // Update the table body with new data
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error fetching removed subjects:', textStatus, errorThrown);
                alert('Error fetching removed subjects: ' + textStatus);
            }
        });
    }

    // Event handler for the refresh button
    $('#refreshRemoveSubjectsBtn').on('click', function() {
        refreshRemovedSubjects(); // Call the function to refresh the table
    });
});
</script>


  </div>
</div>

<?php if (!empty($error_message)): ?>
<?php endif; ?>

<script>
    document.getElementById('add-subject-btn').onclick = function() {
        var form1 = document.getElementById('edit-form1');
        if (form1.style.display === "none") {
            form1.style.display = "block";
        } else {
            form1.style.display = "none";
        }
    };
</script>

    <div class="modal-overlay hide">
    <div class="modal-wrapper">
        <div class="close-btn-wrapper">
            <button class="close-modal-btn">X</button>
        </div>
        <div class="customization-frame">
            <form method="POST" action="update_student.php"> <!-- Specify the action here -->
                <div id="inputFields" class="inputclass">
                    <label class="add-label" style="color: white;">Student ID
                        <input type="text" placeholder="" class="input-field" name="studentID" required>
                    </label>
                    <label class="add-label" style="color: white;">Firstname
                        <input type="text" placeholder="" class="input-field" name="firstname" required>
                    </label>
                    <label class="add-label" style="color: white;">Middlename
                        <input type="text" placeholder="" class="input-field" name="middlename">
                    </label>
                    <label class="add-label" style="color: white;">Last Name
                        <input type="text" placeholder="" class="input-field" name="lastname" required>
                    </label>
                    <label class="add-label" style="color: white;">Course
                        <select name="course" required>
                            <option disabled selected></option>
                            <option>BsIT</option>
                            <option>BsCrim</option>
                            <option>BsP</option>
                            <option>BsCpE</option>
                        </select>
                    </label>
                    <label class="add-label" style="color: white;">Year Level
                        <select name="yearlevel" required>
                            <option disabled selected></option>
                            <option>1st</option>
                            <option>2nd</option>
                            <option>3rd</option>
                            <option>4th</option>
                        </select>
                    </label>
                    <label class="add-label" style="color: white;">Acad Year
                        <select name="academicyear" required>
                            <option disabled selected></option>
                            <option>2023-2024</option>
                            <option>2024-2025</option>
                        </select>
                    </label>
                    <label class="add-label" style="color: white;">Semester
                        <select name="status" required>
                            <option disabled selected></option>
                            <option>1st</option>
                            <option>2nd</option>
                        </select>
                    </label>
                    <label class="add-label" style="color: white;">Type
                        <select name="studenttype" required>
                            <option disabled selected></option>
                            <option>Freshmen</option>
                            <option>Old</option>
                            <option>Transferee</option>
                            <option>Octoberian</option>
                        </select>
                    </label>
                    <label class="add-label" style="color: white;">Status
                        <select name="status" required>
                            <option disabled selected></option>
                            <option>Regular</option>
                            <option>Irregular</option>
                            <option>Dropped</option>
                        </select>
                    </label>
                </div>
                <button type="submit" name="submit" class="apply-buttons">Update</button>
            </form>
        </div>
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

const openBtn = document.querySelector(".update-student-btn");
        const modal = document.querySelector(".modal-overlay");
        const closeBtn = document.querySelector(".close-modal-btn");

        function openModal() {
            modal.classList.remove("hide");
        }

        function closeModal(e, clickedOutside) {
            if (clickedOutside) {
                if (e.target.classList.contains("modal-overlay"))
                    modal.classList.add("hide");
            } else modal.classList.add("hide");
        }

        openBtn.addEventListener("click", openModal);
        modal.addEventListener("click", (e) => closeModal(e, true));
        closeBtn.addEventListener("click", closeModal);

    </script>
</div>
</body>
</html>