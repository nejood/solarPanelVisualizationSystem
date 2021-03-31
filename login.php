<?php
ob_start();
session_start();

?>
<!DOCTYPE html>
<html>
<head>
	<title>Log-in page</title>

	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="HandheldFriendly" content="true">
<link rel="icon" href="logoIcon.png">
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<!--header-->
<div>
	<img class="logo_style" src="logo.png">
	<hr class="header_line" >

</div>
<!--=====================================-->
<!-- body-->
<div>
	<img class="loginBackground" src="loginC.jpg">
	<form class="log-inForm" action="<?=$_SERVER['PHP_SELF']?>" method="POST">
		<fieldset class="log-inField">
			<center>
		<div class="log-inHeader">
		<br>	
		<label class="log-inHeaderLabel"><b> Log-in </b> </label>
		</div>
	
		<div class="log-inDiv">
		<br>
		<br> 
		<label class="loginLable">Email:</label>
		<input class="logininput" type="email" placeholder="Enter Email" name="userEmail_login" required>
		<br><br>
		<label class="loginLable">Password:</label>
		<input class="logininput" type="password" placeholder="Enter Password"  name="psw_login" required>
		<br><br>
        <input type="submit" name="submit" value="Log-in">
        <br>
		<br> 
        </div>
              <p style="color:#636363;">
                     if you have not account <a href="signup.php" target="_blank"> click here!</a>
                   </p>
                 </div>
        	</center>
        </fieldset>
	</form>
     <div>
             

</div>

<!--=====================================-->
<?php
if(isset($_POST["submit"])){
$email = $_POST['userEmail_login'];
$password=$_POST['psw_login'];
require_once('connection.php');
$sql="select * from user where email='$email' and password='$password'";
$check=mysqli_fetch_array(mysqli_query($conn,$sql));

if(isset($check))
{
$_SESSION["email"]=$check['email'];
$_SESSION["first_name"]=$check['first_name'];
$_SESSION["last_name"]=$check['last_name'];
header("location:userHomePage.php");	
}
else
{
	echo"<p style='color:red;font-size:18px;'>Invalid Email or password! please try again</p>";
}
mysqli_close($conn);
}
?>
</body>
</html>