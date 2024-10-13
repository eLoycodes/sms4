<?php
include("connect.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   
    if (isset($_FILES['announcementFile']) && $_FILES['announcementFile']['error'] == 0) {
       
        $fileName = $_FILES['announcementFile']['name'];
        $fileTmpPath = $_FILES['announcementFile']['tmp_name'];
        $fileSize = $_FILES['announcementFile']['size'];
        $fileType = $_FILES['announcementFile']['type'];
      
        $uploadDir = 'uploads/'; 
        $destPath = $uploadDir . basename($fileName); 
       
        if ($fileSize > 2000000) { // 2MB limit
            echo "File size must be less than 2MB.";
            exit;
        }

        if (move_uploaded_file($fileTmpPath, $destPath)) {
            $stmt = $connect->prepare("INSERT INTO announcements (fileName, filePath) VALUES (?, ?)");
            $stmt->bind_param("ss", $fileName, $destPath);
            
            if ($stmt->execute()) {
                echo 
                "<script>
                            alert('File uploaded and database updated successfully.');
                         </script>";
						echo "<script>window.open('adminDashboard.php','_self');</script>";
            } else {
                echo "Database error: " . $connect->error;
            }
            $stmt->close();
        } else {
            echo "Error moving the uploaded file.";
        }
    } else {
        echo "No file uploaded or there was an upload error.";
    }
}

$connect->close();
?>