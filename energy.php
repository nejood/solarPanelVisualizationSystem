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
	<title>Consumption Energy</title>

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

<label style="float: right; margin-top:-8%; font-size: 150%; font-weight:bold; color:#636363;"> 
  <?php echo $_SESSION["first_name"];
  echo " ";
  echo $_SESSION["last_name"];
?> 
</label>


<!--===========================-->
<!--menu-->
<div id="navbar">
  <a href="userHome.php" > Home Page</a>
  <a class="active" href="#"> Create Project</a>
  <a href="showProject.php">View Projects</a>
  <a href="cont.php"> Contact us</a>
  <a href="settings.php"> Profile Settings</a>
  <a href="logout.php">Log-out</a>
</div>
<!------------------------------------->
<!--=====================================-->
<!-- body-->
<a style="margin-top:5%; margin-left: 51.8%; z-index:1; position: absolute; font-size:115%;" href="https://www.se.com.sa/ar-sa/Pages/home.aspx" 
  target="_blank">Click here!</a>
<div>
<img src="step.PNG" style="height: 450px; width: 62%;  position:relative;">

</div>

 <!---------------------->
    <p style="margin-top:-34%; z-index:1; position: absolute; margin-left:70%; font-weight: bold; font-size: 29px; color: #ba283e;">
     Video shows the steps 
    </p>

<div class="energy">
    <center>
<iframe style="margin-top: 23.7%;" 
width="470" height="300" src="https://www.youtube.com/embed/-8Y47IAwMDQ" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"></iframe>
</center>
</div>
 <!--=====================================-->

<!--=====================================-->




</body>
</html>