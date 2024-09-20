<?php

include("connect.php");
session_start();
$email = $password = "";
$email_error = $password_error = "";

if (isset($_POST['submit'])){
    if(empty($_POST["email"])){
		$email_error=" Email is Required!";
	}
    else{
		$email=$_POST["email"];
	}	

  if(empty($_POST["password"])){
		$password_error=" Password is Required!";
	}
    else{
		$password=$_POST["password"];
	}
}

if(isset($_POST["submit"])){
					$sql="select * from admin where email='{$_POST["email"]}' and password='{$_POST["password"]}'";
					$res=$connect->query($sql);
					if($res->num_rows>0){
						$ro=$res->fetch_assoc();
						$_SESSION["id"]=$ro["id"];
                        $_SESSION["firstname"]=$ro["firstname"];
                        $_SESSION["email"]=$ro["email"];
                        $_SESSION["password"]=$ro["password"];
                      
                        echo "<script>
                            alert('Successfully Login');
                         </script>";
						echo "<script>window.open('dash.php','_self');</script>";
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
                    <span class='error' > <?php echo $email_error; ?></span>
                </div>
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="input-group">
                    <a href="dashboard" class="submit-button">Sign in</a>

                </div>

            </form>
        </div>
    </div>

</body>

</html>