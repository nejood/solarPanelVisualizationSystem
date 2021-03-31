<!--?php
require_once('connection.php');
$sql="SELECT * FROM project where email='ne@gmail.com'";
$result= mysqli_query($conn,$sql);


while($row = mysqli_fetch_array($result)) {

  echo '<img src="data:image/jpeg;base64,'. base64_encode($row['roof_image']) .' " />';
}

mysqli_close($conn);
?-->
<!----------------------------------------------------------------->
<!----------------------------------------------------------------->
<!--?php

function Report_Data()
{
  $output='';
 require_once('connection.php');
 $sql="SELECT * FROM project where email='ne@gmail.com'";
$result= mysqli_query($conn,$sql);

while($row = mysqli_fetch_array($result)) {

$output.= $row['energy'];

}
return "$output";
}
if (isset($_POST['show']))
{

 ob_start();
require_once('../web2/fpdf181/fpdf.php');
$frontpdf = new FPDF('P', 'mm', 'A4');
$frontpdf->AddPage();
$frontpdf->Image('logo.png',10,8,33 );
$frontpdf->SetLineWidth(1);
$frontpdf->SetDrawColor(99, 99, 99);
$frontpdf->Line(1, 20, 209, 20);
$frontpdf->SetFont('Arial','',12);
$frontpdf->Ln(218);
$frontpdf->Ln();
$frontpdf->Cell(110,6,date('d.m.Y'),0);
$frontpdf->Cell(26, 5, 'rtyu', 0, 0, 'C');
$cont='';
$cont= 'nejood PDF';
$cont = Report_Data(); 
$frontpdf->Output('your_data22.pdf', 'I');
ob_end_flush();
}
?-->
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
	<title>Delete Project</title>

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
  <a class="active" href="#">Delete Projects</a>
  <a href="cont.php"> Contact us</a>
  <a href="settings.php"> Profile Settings</a>
  <a href="logout.php">Log-out</a>
</div>
<!------------------------------------->
<!--===========================-->
<!--body-->

<center>

<table style="border: 3px solid #37c6ca; border-collapse: collapse;
   margin-left: 1.3%; margin-top: 3%; background-color: #ebf9fa;  width: 65%; height: 25%; z-index:-1;">
   <?php
     $email = $_SESSION['email'];     
require_once('connection.php');
$sql="SELECT * FROM project where email='$email'";
$result= mysqli_query($conn,$sql);
if (mysqli_num_rows($result) > 0) {
 
$project='';
while($row = mysqli_fetch_assoc($result)) {

$project.=$row['project_name'];


    echo '
           <tr>
            <td style="border: 2px solid #ba283e; border-collapse: collapse;color: red; float: center; width: 10%; ">
            <form action="" method="post">

            <label style="margin-left: 2.9%; cursor: pointer; padding-top:1.2%; font-weight:bold; color:#ff4965; font-size: 100%; z-index:2; position:absolute;" >Delete Project</label>

              <input style=" cursor: pointer; max-width:75%; box-shadow: 0 2px #999; border: 2px solid #636363; border-radius: 25px; margin-left:15%;  overflow-x:hidden; width:75%; height:50px; max-height:50px; color:#eaeaea; background-color:#eaeaea; z-index:0; " type="submit" class="nameOfP" 
            id="'.$row['project_name'].'" name="delete[]" value="'.$row['project_name'].'"> 

            </form>
             </td>
  
         <td style="border:2px solid #ba283e; border-collapse: collapse; color: #636363; font-weight: bold; padding:5%; width: 40%; overflow-x:auto; font-size: 110%;">
         Project Name:  
              '.$row['project_name'].' </td>
         </tr>

            ';

}
}
else{
  echo '<label style="margin-left: -8.26%; margin-top:5.4%; font-weight:bold; color:#ff4965; font-size: 140%; z-index:2; position:absolute;" >There is no created project yet!</label>';

}


      
      ?>
  
</table>
</center>

<!--==========================================================-->
<!--delete project-->
<?php
if (isset($_POST['delete']))
{
  require_once('connection.php');
$projectToDel = $_POST['delete'];
for ($i=0; $i<sizeof($projectToDel); $i++){
$sql="SELECT * FROM images where email='$email' and project_name ='$projectToDel[$i]' ";
$result= mysqli_query($conn,$sql);
if (mysqli_num_rows($result) > 0) {
 $del="DELETE FROM images where email='$email' and project_name ='$projectToDel[$i]' ";
$res= mysqli_query($conn,$del);
} //if

$delPro="DELETE FROM project where email='$email' and project_name ='$projectToDel[$i]' ";
$resPro= mysqli_query($conn,$delPro);


} //for lop
      echo "<script>
      alert('the project was delete');
      </script>";
      echo "<meta http-equiv='refresh' content='0'>";
  } //if
?>



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