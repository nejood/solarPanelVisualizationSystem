
<!DOCTYPE html>
<html>
<head>
	<title>Sign-up page</title>
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
<img class="signupBackground" src="signup2.png">
	<form class="Sign-UpForm" method="post" action="<?=$_SERVER['PHP_SELF']?>" onsubmit="return(validate());">
		<fieldset class="Sign-UpField">
		<center>
		<div class="Sign-UpHeader">
		<br>	
		<label class="Sign-UpHeaderLabel"><b> Sign-Up </b> </label>
		</div>
	</center>
		<div class="Sign-UpDiv">
		<br>
		<br> 
      <label  class="singLable"><span class="star">* </span>First Name:</label>
    <input style="margin-left: 5%;" class="singinput" type="text" placeholder="Enter your first name" name="fname" required>
   
        <label style="margin-left: 6%;" class="singLable">Last Name:</label>
    <input style="margin-left: 8.5%;" class="singinput" type="text" placeholder="Enter your last name" name="lname">
    <br><br>
      <label class="singLable"><span class="star">* </span>Address:</label>
    <input style="margin-left: 8%;" class="singinput" type="text" placeholder="Enter your address" name="useraddress" required>
    <br><br>
    <label style="margin-left: 7%;"class="singLable">Phone Number:</label>
    <input style="margin-left: 1%;" class="singinput" id="num" type="number" placeholder="Start with 05"  name="usernumber">
    <br><br>
		<label class="singLable"><span class="star">* </span> Email:</label>
		<input style="margin-left: 10%;" class="singinput" id="NE"  type="email" placeholder="Enter Email" name="userEmail" required>

      <label style="margin-left: 4%;" class="singLable"><span class="star">* </span>Confirm Email:</label>
    <input style="margin-left: 4.8%;"class="singinput" id="CE" type="email" placeholder="Repeat Email" name="userEmailCs" required>
    <br><br>
		<label class="singLable"><span class="star">* </span>Password:</label>
		<input style="margin-left: 6.8%;"  class="singinput" type="password" placeholder="Enter Password" id="NP" name="psw" required>
	
		<label style="margin-left: 4%;" class="singLable"><span class="star">* </span>Confirm Password:</label>
		<input style="margin-left: 1%;" class="singinput" type="password" placeholder="Repeat Password" id="CP" name="conf" required>
        <br><br><br>
        <center>
        <input type="submit" name="submit" value="Creat account">
        </center>
        <br>
		<br> 
        </div>
        	<p style="color:#636363;">
         if you already registered <a href="login.php" target="_blank"> click here!</a>
        </p>


        </fieldset>
	</form>

</div>
 <!--=====================================-->
<?php
if(isset($_POST["submit"])){

$fn=$_POST['fname'];
$ln=$_POST['lname'];
$add=$_POST['useraddress'];
$num= $_POST['usernumber'];
$email = $_POST['userEmail'];
$confemail = $_POST['userEmailCs'];
$password=$_POST['psw'];
$confpass = $_POST['conf'];
require_once('connection.php');
$sql="SELECT email from user where email='$email' "; //get id
$check=mysqli_fetch_array(mysqli_query($conn,$sql));

if(isset($check)){ 
  echo "<script>alert('This email already registered');</script>";
     
    } //end if
else{
 
if($password == $confpass and $email == $confemail ){
	$sqli = "INSERT INTO user(email,password,first_name,last_name,address,Pnumber) 
        VALUES('$email','$password','$fn', '$ln','$add','$num')";
   if(mysqli_query($conn,$sqli)){
         $_SESSION["email"]=$check['email'];
header("location:userHomePage.php");
        } //end if
       }}



	mysqli_close($conn);}
?>
<!--=====================================-->
<script>
  //function to check the password entring
function validate() {
  //if new and confirm password not match
    if(document.getElementById("NP").value!=document.getElementById("CP").value){
    window.alert("password and confirm password not match ");
  document.getElementById("NP").style.background="Yellow";
   document.getElementById("CP").style.background="Yellow";
    document.getElementById("NP").value="";
        document.getElementById("CP").value="";
  return false;
    }
    // if new password null
        if(document.getElementById("NP").value==""){
    window.alert("please fill passowrd field ");
  document.getElementById("NP").style.background="Yellow";
    document.getElementById("NP").value="";
        document.getElementById("CP").value="";
  return false;
    }
    //if confirm password null
        if(document.getElementById("CP").value==""){
    window.alert("please fill confirm password field");
   document.getElementById("CP").style.background="Yellow";

  return false;
    }
      //if new and confirm email not match
    if(document.getElementById("NE").value!=document.getElementById("CE").value){
    window.alert("email and confirm email not match");
  document.getElementById("NE").style.background="Yellow";
   document.getElementById("CE").style.background="Yellow";
    document.getElementById("NE").value="";
        document.getElementById("CE").value="";
  return false;
    }
          //if phone number not start with 05 
    if(!document.getElementById("num").value.startsWith("05")){
    window.alert("the entered phone number does not start with 05");
  document.getElementById("num").style.background="Yellow";
  document.getElementById("num").value="";  
  return false;
    }
       //if phone number's length is < 10
    if(document.getElementById("num").value.length!=10){
    window.alert("the entered phone number must have 10 digits");
  document.getElementById("num").style.background="Yellow";
  document.getElementById("num").value="";  
  return false;
    }


    return true//if there is no error sumbit form
    }
</script>

</body>
</html>