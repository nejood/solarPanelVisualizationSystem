<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
?>
<?php if(!isset($_SESSION['email']))
{
    // not logged in
    header('Location:login.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Contact us</title>

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
<!--===========================-->
<!--user name-->
<label style="float: right; margin-top:-8%; font-size: 150%; font-weight:bold; color:#636363;"> 
  <?php echo $_SESSION["first_name"];
  echo " ";
  echo $_SESSION["last_name"];
?> </label>

<!--===========================-->
<!--menu-->
<div id="navbar">
  <a href="userHome.php" > Home Page</a>
  <a href="createProject.php"> Create Project</a>
  <a href="showProject.php">View Projects</a>
  <a class="active" href="#"> Contact us</a>
  <a href="settings.php"> Profile Settings</a>
  <a href="logout.php">Log-out</a>
</div>
<!------------------------------------->

<!--=====================================-->
<!-- body-->
<div>
	<img class="contBackground" src="contact.jpg">
	
	<form class="contForm" method="post" action="#">
		<fieldset class="contField">
				<center>
		<div class="contHeader">
		<br>	
		<label class="contHeaderLabel"><b> Contact-us </b> </label>
		</div>
		<div class="contDiv">
		<br>
		<br> 
		<label style="font-size: 110%; float: left; margin-left: 3%; margin-top:-6%; color: #ffe593;"> <b> Need to contact us? </b> </label>
		<br>
    <label style="font-size: 100%; float: left; margin-left: 16%; margin-top:-6%; color:#99ddff;" >we are always here for you</label>
		
		<label class="contLable"> Subject:</label> <br> <br>
		<input class="continput" type="text" placeholder="subject of message" name="subject" required>
		<br>
		<label class="contLable">Message:</label>
    <br> <br>
		<textarea required name="message" style="width:300px; height:120px;" placeholder="type your message here"></textarea>
        <br><br>
        <input style="margin-left:2%;" type="submit" name="submit"  value="Send">
        <br>
		<br> 
        </div>
        	</center>
        </fieldset>
	</form>

</div>
 <!--=====================================-->
<?php
  require_once('connection.php');
   $email = $_SESSION['email'];
	 if(isset($_POST['submit'])) {
$sub=$_POST['subject'];
$mess= $_POST['message'];

$sql=	"INSERT into  contact (subject,message,email) values ('$sub', '$mess','$email')";

if (mysqli_query($conn,$sql)) {
echo '<script language="javascript">';
echo 'alert("your message was sent successfully, thank you")';
echo '</script>';	
}
else{
echo '<script language="javascript">';
echo 'alert("Try again!")';
echo '</script>';	
}

}
mysqli_close($conn);
?>
<!--=====================================-->




</body>
</html>