<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Course</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #033683;
        }
        .course-box {
            border: 1px solid white;
            border-radius: 5px;
            padding: 20px;
            text-align: center;
            margin-bottom: 20px;
            transition: transform 0.2s;
        }
        .course-box:hover {
            transform: scale(1.05);
        }
        .btn-primary {
            background-color: white;
            color: black;
        }
    </style>
</head>
<body>
    <div class="container mt-5"><br><br>
        <h1 class="text-center" style="color: white;">Bestlink College of the Philippines</h1><br><br><br>
        <br>
        <div class="row">
            <div class="col-md-3">
                <div class="course-box">
                    <h3 style="color: white;">BSIT</h3>
                    <p style="color: white;">Bachelor of Science in Information Technology</p>
                    <button class="btn btn-primary" onclick="proceed('BSIT')">Proceed</button>
                </div>
            </div>
            <div class="col-md-3">
                <div class="course-box">
                    <h3 style="color: white;">BSCRIM</h3>
                    <p style="color: white;">Bachelor of Science in Criminology</p>
                    <button class="btn btn-primary" onclick="proceed('BSCRIM')">Proceed</button>
                </div>
            </div>
            <div class="col-md-3">
                <div class="course-box">
                    <h3 style="color: white;">BSP</h3>
                    <p style="color: white;">Bachelor of Science in Psychology</p>
                    <button class="btn btn-primary" onclick="proceed('BSP')">Proceed</button>
                </div>
            </div>
            <div class="col-md-3">
                <div class="course-box">
                    <h3 style="color: white;">BSCPE</h3>
                    <p style="color: white;">Bachelor of Science in Computer Engineering</p>
                    <button class="btn btn-primary" onclick="proceed('BSCPE')">Proceed</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function proceed(course) {
            window.location.href = `studentadmission.php?course=${course}`;
        }
    </script>
</body>
</html>
