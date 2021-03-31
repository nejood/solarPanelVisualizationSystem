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
	<title>Home Page</title>

	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="HandheldFriendly" content="true">
<link rel="icon" href="logoIcon.png">
<link rel="stylesheet" type="text/css" href="style.css">
<style>
/* The dots/bullets/indicators */
.dot {
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color:#eaeaea;
  border-radius: 50%;
  display: inline-block;
  transition: background-color 0.6s ease;
}
.mySlides {display: none;}
img {vertical-align: middle;}

/* Slideshow container */
.slideshow-container {
  max-width: 70%;
  position: relative;
margin-top: 5%;
}

.active {
  background-color: #37c6ca;
}

.fade {
  -webkit-animation-name: fade;
  -webkit-animation-duration: 1.5s;
  animation-name: fade;
  animation-duration: 1.5s;
}

@-webkit-keyframes fade {
  from {opacity: .4} 
  to {opacity: 1}
}

@keyframes fade {
  from {opacity: .4} 
  to {opacity: 1}
}

/* On smaller screens, decrease text size */
@media only screen and (max-width: 300px) {
  .text {font-size: 11px}
}
</style>
</head>
<body>


<!--header-->
<div>
	<img class="logo_style" src="logo.png">
	<hr style="text-decoration:none;" class="header_line">

</div>
<!--===========================-->
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
  <a href="cont.php"> Contact us</a>
  <a href="settings.php"> Profile Settings</a>
  <a href="logout.php">Log-out</a>
</div>
<!------------------------------------->
<center>
<div class="slideshow-container">

<div class="mySlides fade">
  <img src="1.PNG" style="width:90%; height: 460px;">
</div>

<div class="mySlides fade">
  <img src="2.PNG" style="width:90%; height: 460px;">
</div>

<div class="mySlides fade">
  <img src="3.PNG" style="width:90%; height: 460px;">
</div>

<div class="mySlides fade">
  <img src="4.png" style="width:90%; height: 460px;">
</div>

<div class="mySlides fade">
  <img src="5.png" style="width:90%; height: 460px;">
</div>

<div class="mySlides fade">
  <img src="6.png" style="width:90%; height: 460px;">
</div>

<div class="mySlides fade">
  <img src="7.png" style="width:90%; height: 460px;">
</div>

</div>
<br>

<div style="text-align:center">
  <span class="dot"></span> 
  <span class="dot"></span> 
  <span class="dot"></span> 
  <span class="dot"></span> 
  <span class="dot"></span> 
  <span class="dot"></span> 
  <span class="dot"></span> 
</div>
</center>
<!----------------------------------------------------->
<script>
var slideIndex = 0;
showSlides();

function showSlides() {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";  
  }
  slideIndex++;
  if (slideIndex > slides.length) {slideIndex = 1}    
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
  setTimeout(showSlides, 9900); // Change image every 2 seconds
}
</script>
<!--===========================-->
<!--footer-->
<div>
	<footer>
	<img class="footer_style" src="footer.png">
		<div class="footer_text">
			<center>
		<p> <b>
			This website for "Solar Panel Visualization" senior project <br>
            computer scince department <br>
              faculty of computing and information technology <br>
                       king abdulaziz university <br>
       </b></p>
       </center>
	</div>
	</footer>
</div>
<!--===========================-->
</body>
</html>