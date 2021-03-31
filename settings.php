
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
	<title>Solar Panel Companies</title>

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
  <a href="createProject.php"> Create Project</a>
  <a href="showProject.php">View Projects</a>
  <a href="cont.php"> Contact us</a>
  <a class="active" href="#"> Profile Settings</a>
  <a href="logout.php">Log-out</a>
</div>
<!------------------------------------->

<div class="settinsDiv">
<form method="post" action="#" onsubmit="return(validate());">
  <fieldset class="name">
    <br>  
    <legend>Name:</legend>
    <label class="changeLable">First name:</label>
    <input class="changeinput" type="text" placeholder="change your first name" name="fname" >
    <br>  <br>
    <label class="changeLable"> Last name:</label>
    <input class="changeinput" type="text" placeholder="change your last name"  name="lname">
    <br>  <br>
  </fieldset>
  <br>  
  <!------------------------------------->
  <fieldset class="add_num">
    <br>  
    <legend>Address and Phone number:</legend>
        <label class="changeLable">Address:</label>
    <input class="changeinput" type="text" placeholder="change your address" name="address" >
    <br>  <br>
    <label class="changeLable"> Phone number:</label>
    <input class="changeinput" type="number" placeholder="change your number" name="pname">
    <br>  <br>
  </fieldset>
  <br>  
  <!------------------------------------->
  <fieldset class="pass">
    <br>  
    <legend>Password:</legend>
    <label class="changeLable">Current password:</label>
    <input class="changeinput" type="password" placeholder="enter current password" name="oldpsw" >
    <br>  <br>
    <label class="changeLable"> New Password:</label>
    <input class="changeinput" type="password" placeholder="enter new password" id="NP"  name="newpsw">
    <br>  <br>
    <label class="changeLable">Confirmation:</label>
    <input class="changeinput" type="password" placeholder="repeat new password" id="CP" name="confpsw" >
    <br>  <br>
  </fieldset>
    <br>  
    <center>
        <input type="reset" value="Reset">
        <input style="margin-left:2%;" type="submit" name="submit"  value="Change">
        </center>
        <br>
</form>
</div>


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
<?php
  require_once('connection.php');
     $email = $_SESSION['email'];
   $sql = "select * from user where email='$email'";
   $check = mysqli_fetch_array(mysqli_query($conn,$sql));

//if the codes matched 
if(isset($check)){
   if(isset($_POST['submit'])) {
$test='';  
$firstn= $_POST['fname'];
$lastn=$_POST['lname'];
$addr=$_POST['address'];
$phonen=$_POST['pname'];  
$oldp=$_POST['oldpsw'];
$newp= $_POST['newpsw'];
$confp= $_POST['confpsw'];

if($firstn != $test){
$sqlF="UPDATE user set first_name='$firstn' where email='$email' ";
if(mysqli_query($conn,$sqlF)){
  echo "<script>alert('the first name was changed successfully');</script>";
   $_SESSION["first_name"]=$firstn;
    echo "<meta http-equiv='refresh' content='0'>";
}
}
if($lastn != $test){
$sqlF="UPDATE user set last_name='$lastn' where email='$email' ";

if(mysqli_query($conn,$sqlF)){
  echo "<script>alert('the last name was changed successfully');</script>";
  $_SESSION["last_name"]=$lastn;
   echo "<meta http-equiv='refresh' content='0'>";
}
}
if($addr != $test){
$sqlF="UPDATE user set address='$addr' where email='$email' ";
if(mysqli_query($conn,$sqlF)){
  echo "<script>alert('the address was changed successfully');</script>";
}
}
if($phonen != $test){
$sqlF="UPDATE user set Pnumber='$phonen' where email='$email' ";
if(mysqli_query($conn,$sqlF)){
  echo "<script>alert('the phone number was changed successfully');</script>";
}
}
if($oldp != $test and $newp != $test and $confp != $test and $confp == $newp ){
$pass=  "SELECT password from user where password='$oldp' and email='$email'";
if(mysqli_query($conn,$pass)) {
$sqlF="UPDATE user set password='$newp' where email='$email' ";
if(mysqli_query($conn,$sqlF)){
  echo "<script>alert('the password was changed successfully');</script>";
}
}
}
}}
  ?>
<script>
  //function to check the password entring
function validate() {
  //if new and confirm password not match
    if(document.getElementById("NP").value!=document.getElementById("CP").value){
    alert("new password and confirm password not match ");
  document.getElementById("NP").style.background="Yellow";
   document.getElementById("CP").style.background="Yellow";
    document.getElementById("NP").value="";
        document.getElementById("CP").value="";
  return false;
    }
    return true//if there is no error sumbit form
    }
</script>
</body>
</html>