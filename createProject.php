
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
	<title>craete project</title>

	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="HandheldFriendly" content="true">
 <meta charset="UTF-8"> 
 <link rel="icon" href="logoIcon.png">
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<!--header-->
<div>
	<img class="logo_style" src="logo.png">
	<hr style="text-decoration:none;" class="header_line">

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
  <a class="active" href="#"> Create Project</a>
  <a href="showProject.php">View Projects</a>
  <a href="cont.php"> Contact us</a>
  <a href="settings.php"> Profile Settings</a>
  <a href="logout.php">Log-out</a>
</div>
<!------------------------------------->

<!--=====================================-->
<!-- body-->

<div class="createDiv">
  <form action="" method="post" enctype="multipart/form-data">
      <fieldset class="CreateProject">
        <div> 
        <img src="earth.png" style="height: 25px;width: 25px;">
        <label  
        class="creartetext">Project name:
        </label>
        <input style="margin-left:2%;" type="text" name="Pname">
        </div>

        <br> <br>

                <div>
                   <img src="earth.png" style="height: 25px;width: 25px;">
                <label class="creartetext" for="city_name"> City:
                <select name="city_name" id="1" style="margin-left:2%;" >
                  <option value="Abha"> Abha </option>
                  <option value="Al-Ahsa"> Al-Ahsa </option>
                  <option value="Al-Khobar"> Al-Khobar </option>
                  <option value="Baha"> Baha </option>
                  <option value="Dammam"> Dammam </option>
                  <option value="Dhahran"> Dhahran </option>
                  <option value="Hail"> Hail </option>
                  <option value="Jeddah"> Jeddah </option>
                  <option value="Jizan"> Jizan </option>
                  <option value="Jouf"> Jouf  </option>
                  <option value="Jubail"> Jubail  </option>
                  <option value="Madinah"> Madinah </option>
                  <option value="Makkah"> Makkah  </option>
                    <option value="Najran"> Najran  </option>
                    <option value="Qassem"> Qassem  </option>
                    <option value="Qatif"> Qatif  </option>
                    <option value="Riyadh"> Riyadh   </option>
                    <option value="Tabouk"> Tabouk   </option>
                    <option value="Taif"> Taif   </option>
                    <option value="Yanbu"> Yanbu   </option>
                </select>
                </label>
                </div>

                <br> <br>

                <div>
                <img src="earth.png" style="height: 25px;width: 25px;">
                <label class="creartetext">Rooftop area in square metre:</label>
                <input style="margin-left:2%;" type="number" name="area_name" step="any" placeholder="in m²" required>
                </div>

                <br><br>

                <div>
                 <img src="earth.png" style="height: 25px;width: 25px;">
                <label class="creartetext">Average of consumption energy in kilowatthours:</label>
                 <input style="margin-left:2%;" type="number" name="average" step="any" placeholder="in kWh" required>
                 </div>
                 <div>
                   <p style="color:#636363; margin-left: 5%;">
                     if you do not know what is your consumption energy <a href="energy.php" target="_blank"> Click here!</a>
                   </p>
                 </div>
                 <br>
               <div>
                   <img src="earth.png" style="height: 25px;width: 25px;">
                <label class="creartetext" for="capacity"> Capacity of your breaker:
                <select name="capacity" id="2" style="margin-left:2%;" >
                  <option value="10"> Between 20 and 99 </option>
                  <option value="15"> Between 100 and 199 </option>
                  <option value="21"> Between 200 and 299 </option>
                  <option value="22"> Between 300 and 399 </option>
                  <option value="25"> Equal 400 </option>
                  <option value="30"> More than 400 </option>
                </select>
                </label>
                </div>
                <br><br>

                <div>
                 <img src="earth.png" style="height: 25px;width: 25px;">
                <label class="creartetext">Your rooftop image:</label>
                  <input style="margin-left:2%;" type="file" name="imageToUpload" required>
                 </div> 
                  <br> <br>
                <p style="color:#636363;">
                  <b>You have to follow the instructions below to get the correct result:</b>
                  <br> <br>
                     1. Upload image file with any format (PNG or JPEG). <br>
                    2. It must include only your rooftop as shown in the pictures below. <br>
                    3. The image must be satellite image (you can take it from <a href="https://www.google.com/earth/" target="_blank"> Google Earth</a>  ). <br>
                    <br>
                   <center>
                   <img  style="width:25%; "src="wrongPic.PNG">
                   <img style="width:25.5%; " src="correctPic.PNG">

                   <br>
                    <label style="margin-left:1%;">wrong image</label>

                   <label style="margin-left:15%;">correct image</label>
                   </center>
                </p>
              
        <br><br>
        <center>
        <input type="reset" value="Reset" name="reset">
        <input style="margin-left:2%;" type="submit" value="Create" name="submit">
               </center>
      </fieldset>
    </form>
</div>
 <!--=====================================-->

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
<!----------------------------------------------------------------------------->
<?php

require_once('connection.php'); //index.php
if($_POST){ //start post

if(isset($_POST['submit'])){ 

 $email = $_SESSION['email'];
$projectName=$_POST['Pname'];

 if(isset($_POST['city_name'])){
  if(isset($_POST['capacity'])){
    $capacity = $_POST['capacity'];
  $CityName=$_POST['city_name'];
$AreaVal=$_POST['area_name'];
$EnergyCon=$_POST['average'];
$imgContent = addslashes (file_get_contents($_FILES['imageToUpload']['tmp_name']));
$allowed =  array('png','jpg','PNG','jpeg');
$imgtype = $_FILES['imageToUpload']['name'];
$ext = pathinfo($imgtype, PATHINFO_EXTENSION);
if(!in_array($ext,$allowed) ) {
   echo  "<script>alert('Please enter an image!');</script>";
}
else

{


$test = "SELECT project_name from project where email ='$email' and project_name = '$projectName' ";
$check=mysqli_fetch_array(mysqli_query($conn,$test));

if(isset($check)){ 
  echo "<script>alert('Please enter an unique project name');</script>";
     
    } //end if
else{
$sql="INSERT INTO project (email,project_name,city_KSA,area,energy,breaker,roof_image,status)
VALUES('$email','$projectName','$CityName','$AreaVal','$EnergyCon','$capacity','$imgContent','0')"; 

 if(mysqli_query($conn,$sql)){
          //if the query is done correctly:
  $insert_email="INSERT INTO session (email_session) VALUES('$email') ";
   if(mysqli_query($conn,$insert_email)){
    echo "<script> 
     alert('The project $projectName was created successfully.');
     </script>";
     exec("python K-mean4-draw6-database.py");
    echo ("<script> window.location.href ='showProject.php'</script>");
   }
//------------------------------------
      }
      else{  
echo "<script>alert('Opps! try again');</script>";

} //end else
    }
}


  mysqli_close($conn);  //close connion
  } // end city 
}
 } } //if post 
?>



</body>
</html>