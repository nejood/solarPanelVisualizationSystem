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
	<title>change password</title>

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
	<img class="signupBackground" src="change.jpg">
	
	<form class="changeForm" method="post" action="#" onsubmit="return(validate());">
		<fieldset class="changeField">
				<center>
		<div class="changeHeader">
		<br>	
		<label class="changeHeaderLabel"><b> Change Password </b> </label>
		</div>
	
		<div class="changeDiv">
		<br>
		<br> 
		<label class="changeLable">Current password:</label>
		<input class="changeinput" type="password" placeholder="Enter Current password" name="oldpsw" required>
		<br><br>
		<label class="changeLable"> New Password:</label>
		<input class="changeinput" type="password" placeholder="Enter new Password" id="NP"  name="newpsw" required>
		<br><br>
		<label class="changeLable">Confirmation:</label>
		<input class="changeinput" type="password" placeholder="Repeat new Password" id="CP" name="confpsw" required>
        <br><br>
        <input type="reset" value="Reset">
        <input style="margin-left:2%;" type="submit" name="submit"  value="Change">
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
   $sql = "select * from user where email='$email'";
   $check = mysqli_fetch_array(mysqli_query($conn,$sql));

//if the codes matched 
if(isset($check)){
	 if(isset($_POST['submit'])) {
$oldp=$_POST['oldpsw'];
$newp= $_POST['newpsw'];
$confp= $_POST['confpsw'];
if($newp == $confp)
{

$pass=	"select password from user where password='$oldp'";
$result= mysqli_query($conn,$pass);

if (mysqli_num_rows($result) > 0) {
$query = mysqli_query($conn,"update user set password='$newp' where email='$email'")
or die(mysqli_error($conn));
echo '<script language="javascript">';
echo 'alert("Your password Updated successfully")';
echo '</script>';	
}
else{
echo '<script language="javascript">';
echo 'alert("The current password you entered is not correct")';
echo '</script>';	
}
}

}}
mysqli_close($conn);
?>
<!--=====================================-->
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
    // if new password null
        if(document.getElementById("NP").value==""){
    alert("please fill new passowrd field ");
  document.getElementById("NP").style.background="Yellow";
    document.getElementById("NP").value="";
        document.getElementById("CP").value="";
  return false;
    }
    //if confirm password null
        if(document.getElementById("CP").value==""){
    alert("please fill confirm password field");
   document.getElementById("CP").style.background="Yellow";

  return false;
    }
    return true//if there is no error sumbit form
    }
</script>



</body>
</html>