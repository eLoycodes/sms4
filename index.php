<?php

include("connect.php");
session_start();
$username = $password = "";
$username_error = $password_error = "";

if (isset($_POST['submit'])){
    if(empty($_POST["username"])){
		$username_error=" Username is Required!";
	}
    else{
		$username=$_POST["username"];
	}	

  if(empty($_POST["password"])){
		$password_error=" Password is Required!";
	}
    else{
		$password=$_POST["password"];
	}
}
if(isset($_POST["submit"])){
					$sql="select * from admin where username='{$_POST["username"]}' and password='{$_POST["password"]}'";
					$res=$connect->query($sql);
					if($res->num_rows>0){
						$ro=$res->fetch_assoc();
						$_SESSION["id"]=$ro["id"];
                        $_SESSION["username"]=$ro["username"];
                        $_SESSION["password"]=$ro["password"];
                      
                        echo "<script>
                            alert('Successfully Login');
                         </script>";
						echo "<script>window.open('adminDashboard.php','_self');</script>";
					}
					
				}
				if(isset($_GET["mes"])){
					echo "<div class='error'>{$_GET["mes"]}</div>";
				}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bestlink College - Login</title>
    <link rel="stylesheet" href="css/login.css">

</head>

<style>
    .error{
        color: red;
        text-align: center;
    }
</style>

<body>

    <div class="login-container">

        <div class="login-box">
            <img src="image/bcplogo-mini.png" alt="Bestlink College" class="logo">

            <h2><b>Sign in</b></h2>

            <form method="POST">
                <div class="input-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username">
                    <span class='error' > <?php echo $username_error; ?></span>
                </div>
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password">
                    <span class='error' > <?php echo $password_error; ?></span>
                </div>
                <div class="input-group">
                <button type="submit" class="submit-button" name ="submit">Sign in</button>

                </div>

            </form>
        </div>
    </div>

</body>

</html>