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
  /* ====================*/
/* links:*/
.links_div{
  background-color: #eaeaea;
  float: right;
  margin-top: -0.01%;
  width: 28%;
  max-width: 28%;
  height: 490px;
  max-height: 490px;
  
}
.titleLinks{
  color: #ba283e;
   font-size: 20px;
}
/* ====================*/
/* welcome:*/
.welcomeDiv{
float: left;
  margin-top: -39.28%;
}
.welcomeImg{
  width: 86.45%;
   height:490px; 
}
/* ====================*/
/* what:*/
.what{
  border-color: #ff4965;
  margin-top:  39.5%;
  border-radius: 5px;
  border-style: dashed;
   border-width: 4px;
   background-color: #fff7f8;
}
.Q{
  margin-top: 10%;
  font-size:24px;
  color: #37c6ca;
  margin-left: 2%;
  margin-bottom: 1%;
}
.Ans{
margin-left: 2%;
font-size:20px; 
color:#636363;
}
.video{
  margin-left:53%;
  margin-top: -20.5%;
}
/* ====================*/
/* benefit:*/
.benefit{
  margin-top: 3%;
    width: 70%;
   height:290px;
}
</style>
</head>
<body>
<!--header-->
<div>
	<img class="logo_style" src="logo.png">
	<hr class="header_line" >

</div>
<!--===========================-->
<!--login & signUp-->
<!--===========================-->
<!--user name-->
<label style="float: right; margin-top:-8%; font-size: 150%; font-weight:bold; color:#636363;"> 
  <?php echo $_SESSION["first_name"];
  echo " ";
  echo $_SESSION["last_name"];
?> </label>

<!--===========================-->
<div id="navbar">
  <a class="active" href="#"> Home Page</a>
  <a href="createProject.php"> Create Project</a>
  <a href="showProject.php">View Projects</a>
  <a href="cont.php"> Contact us</a>
  <a href="settings.php"> Profile Settings</a>
  <a href="logout.php">Log-out</a>
</div>
<!--===========================-->
<!--body-->


<!------------------------------------->
	<div class="links_div"> 
	 <center> <p class="titleLinks"><b>Quick Links </b></p> 
	 <hr class="header_line" > 

	  <a style="text-decoration:none; font-weight: bold;" class="links_style" 
     href="https://www.greenmatch.co.uk/blog/2015/09/types-of-solar-panels" 
     target="_blank">Types of Solar Panels</a>
        <hr class="linsHR">

   <a style="text-decoration:none; font-weight: bold;" class="links_style" 
     href="PVcompanies.php" 
     target="_blank">Top Solar Panel Companies</a>
     <hr class="linsHR"> 

     <a style="text-decoration:none; font-weight: bold;" class="links_style" 
     href="https://www.wikihow.com/Choose-Solar-Panels" 
     target="_blank">How to Choose Solar Panels</a>
     <hr class="linsHR">

                  <a style="text-decoration:none; font-weight: bold;" class="links_style" 
     href="https://www.lgenergy.com.au/faq/did-you-know/what-is-a-solar-power-system" 
     target="_blank">What is a solar panel system?</a>
        <hr class="linsHR">

          <a style="text-decoration:none; font-weight: bold;" class="links_style" 
     href="https://coastalsolar.com/many-solar-panels-will-need/" 
     target="_blank">How many solar panels you need?</a>
        <hr class="linsHR">

          <a style="text-decoration:none; font-weight: bold;" class="links_style" 
     href="https://www.solarquotes.com.au/blog/solar-panel-size-is-bigger-better/" 
     target="_blank">Solar Panel Size: Is Bigger Better?</a>
        <hr class="linsHR">
         <a style="text-decoration:none; font-weight: bold;" class="links_style" 
     href="https://www.solarpowerrocks.com/solar-basics/which-direction-should-solar-panels-face/" 
     target="_blank">Which direction should solar panels face?</a>
        <hr class="linsHR">
       
            <a style="text-decoration:none; font-weight: bold;" class="links_style" 
     href="https://www.solartechnology.co.uk/support-centre/calculating-your-solar-requirments" 
     target="_blank">Calculating your solar power requirements</a>
        <hr class="linsHR">

       <a style="text-decoration:none; font-weight: bold;" class="links_style" 
     href="https://www.greenmatch.co.uk/blog/2014/08/5-advantages-and-5-disadvantages-of-solar-energy" 
     target="_blank">Advantages and Disadvantages of Solar Panels</a>
        <hr class="linsHR">
     
            <a style="text-decoration:none; font-weight: bold;" class="links_style" 
     href="https://www.solarreviews.com/blog/what-equipment-do-you-need-for-a-solar-power-system"target="_blank">What equipment do you need for a PV system?</a>
        


</center>
	</div>
<!------------------------------------->

<!------------------------------------->
	<div class="welcomeDiv">
		<img class="welcomeImg"src="welc.PNG">
	</div>
<!------------------------------------->

<!------------------------------------->
	<div class="what">
	<p class="Q"> What is a <b>"Solar panel" </b> ? </p>

    <p class="Ans">
    	Solar panels (also known as "PV panels") are used to convert <br> light from the sun, 
    	which is composed of particles of energy called "photons",<br> into electricity that can be used to power electrical loads.
    </p>
		

<iframe class="video" width="560" height="315" src="https://www.youtube.com/embed/xKxrkht7CpY" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
	</div>
<!------------------------------------->

<!------------------------------------->
<center>
	<div>
		<img class="benefit" src="benefits.png">
	</div>
</center>
<!------------------------------------->
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