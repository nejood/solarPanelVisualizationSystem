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
	<title>View Project</title>

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
  <a class="active" href="#">View Projects</a>
  <a href="cont.php"> Contact us</a>
  <a href="settings.php"> Profile Settings</a>
  <a href="logout.php">Log-out</a>
</div>
<!------------------------------------->
<!--===========================-->
<!--body-->
<table style="border: 3px solid #37c6ca; border-collapse: collapse; 
   margin-left: 18%; margin-top: 3%; background-color: #ebf9fa;  width: 65%; height: 25%; z-index:-1;">
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

            <label style="margin-left: 1.4%; cursor: pointer; padding-top:1.2%; font-weight:bold; color:#ff4965; font-size: 100%; z-index:2; position:absolute;" >Delete Project</label>

              <input style=" cursor: pointer; max-width:90%; box-shadow: 0 2px #999; border: 2px solid #636363; border-radius: 25px; margin-left:5%;  overflow-x:hidden; width:90%; height:50px; max-height:50px; color:#eaeaea; background-color:#eaeaea; z-index:0; " type="submit" class="nameOfP" 
            id="'.$row['project_name'].'" name="delete[]" value="'.$row['project_name'].'"> 

            </form>
             </td>

             <td style="border: 2px solid #ba283e; border-collapse: collapse; color: red; float: center; width: 10%; ">
            <form action="" method="post" >

             <label style="margin-left: 2.2%;  cursor: pointer;  padding-top:1.2%; font-weight:bold; color:green; font-size: 100%; z-index:2; position:absolute;" >View Report</label>

            <input style=" cursor: pointer; box-shadow: 0 2px #999; border: 2px solid #636363; border-radius: 25px; margin-left:15%; width:80%; max-width:80%; height:50px; max-height:50px; color:#eaeaea; background-color:#eaeaea; z-index:0; overflow-x:hidden; " type="submit" class="nameOfP" 
            id="'.$row['project_name'].'" name="show[]" value="'.$row['project_name'].'">

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
  echo '<label style="margin-left: 41.1%; margin-top:8.36%; font-weight:bold; color:#ff4965; font-size: 140%; z-index:2; position:absolute;" >There is no created project yet!</label>';

}

  ?>
  
</table>
</center>
<!-- show project in pdf ---------->
<?php

if (isset($_POST['show']))
{

  require_once('connection.php');
   $email = $_SESSION['email'];
ob_start();
$projects = $_POST['show'];
for ($i=0; $i<sizeof($projects); $i++){
require_once('../n/fpdf181/fpdf.php');
$pdf = new FPDF('P', 'mm', 'A4');
$pdf->AddPage();
$pdf->Image('logo.png',10,8,33 );
$pdf->SetLineWidth(1);
$pdf->SetDrawColor(99, 99, 99);
$pdf->Line(1, 20, 209, 20);
$pdf->SetCreator("GSPP");
$pdf->Ln(16);
//------------------------------------------
//title:
$pdf->SetFont('Arial','B',12);
$pdf->SetTextColor(255,73,101);
$pdf->SetFillColor(235, 249, 250);
$pdf->Cell(0,9 ,'Personal Information: ',0,1,'L',1);
$pdf->Ln(5);
//------------------------------------
//query:
$sql="SELECT * FROM project where email='$email' and project_name ='$projects[$i]' ";
$result= mysqli_query($conn,$sql);
$m= mysqli_fetch_array($result);
//------------------------------------------
//name: 
$sql="SELECT first_name FROM user where email='$email'";
$result= mysqli_query($conn,$sql);
$fname= mysqli_fetch_array($result);
$fnameP=$fname['first_name'];

$sql="SELECT last_name FROM user where email='$email'";
$result= mysqli_query($conn,$sql);
$lname= mysqli_fetch_array($result);
$lnameP=$lname['last_name'];


$pdf->SetFont('Arial','',11);
$pdf->SetTextColor(55,198,202);
$pdf->Cell(13, 1, 'Name:' ,0, 0,'L');
$pdf->SetTextColor(99,99,99);
$pdf->Cell(14, 1,$fnameP ,0, 0,'');
$pdf->Cell(3, 1,$lnameP ,0, 0,'L');
$pdf->Cell(70, 1,' ' ,0, 0,'C');
//------------------------------------------
//phone: 
$sql="SELECT Pnumber FROM user where email='$email'";
$result= mysqli_query($conn,$sql);
$Pnumber= mysqli_fetch_array($result);
$PnumberP=$Pnumber['Pnumber'];

$pdf->SetFont('Arial','',11);
$pdf->SetTextColor(55,198,202);
$pdf->Cell(3, 1, 'Phone:' ,0, 0,'R');
$pdf->SetTextColor(99,99,99);
$pdf->Cell(2, 1,'0' ,0, 0,'C');
$pdf->Cell(21, 1,$PnumberP ,0, 0,'R');
$pdf->Ln(7);
//------------------------------------------
//Email: 
$pdf->SetFont('Arial','',11);
$pdf->SetTextColor(55,198,202);
$pdf->Cell(13, 1, 'Email:' ,0, 0,'L');
$pdf->SetTextColor(99,99,99);
$pdf->Cell(14, 1,$email ,0, 0,'');
$pdf->Cell(76, 1,' ' ,0, 0,'C');
//------------------------------------------
//address: 
$sql="SELECT address FROM user where email='$email'";
$result= mysqli_query($conn,$sql);
$address= mysqli_fetch_array($result);
$addressP=$address['address'];

$pdf->SetFont('Arial','',11);
$pdf->SetTextColor(55,198,202);
$pdf->Cell(3, 1, 'Address:' ,0, 0,'R');
$pdf->SetTextColor(99,99,99);
$pdf->Cell(38, 1,$addressP ,0, 0,'R');
$pdf->Ln(8);
//------------------------------------------
//title:
$pdf->SetFont('Arial','B',12);
$pdf->SetTextColor(255,73,101);
$pdf->SetFillColor(235, 249, 250);
$pdf->Cell(0,9 ,'Project Information: ',0,1,'L',1);
$pdf->Ln(4);
//------------------------------------------
//paragraph: 

// cost:
$costq= "SELECT cost FROM project where project_name ='$projects[$i]' ";
$r= mysqli_query($conn,$costq);
$costqi= mysqli_fetch_array($r);
$costP=$costqi['cost'];

// per:
$plnper= "SELECT per FROM project where project_name ='$projects[$i]' ";
$rper= mysqli_query($conn,$plnper);
$perr= mysqli_fetch_array($rper);
$per=$perr['per'];

// payback:
$payb = "SELECT Payback FROM project where project_name ='$projects[$i]' ";
$paybb = mysqli_query($conn,$payb);
$paybbb = mysqli_fetch_array($paybb);
$payback = $paybbb['Payback'];

// bill:
$billl = "SELECT bill FROM project where project_name ='$projects[$i]' ";
$billll = mysqli_query($conn,$billl);
$billlll = mysqli_fetch_array($billll);
$bill = $billlll['bill'];

// panel bill:
$Pbilll = "SELECT Pbill FROM project where project_name ='$projects[$i]' ";
$Pbillll = mysqli_query($conn,$Pbilll);
$Pbilllll = mysqli_fetch_array($Pbillll);
$Pbill = $Pbilllll['Pbill'];




$pdf->SetFont('Arial','',11);
$pdf->SetTextColor(99,99,99);
$pdf->Write(5,'If you installed the proposed solar panel system in your house it will cost you'); 
$pdf->Cell(12, 5,$costP,0, 0,'R');
$pdf->Write(5,'SR to buy these panels. The benefit of a solar panel system will show after'); $pdf->Cell(7, 5,$payback,0, 0,'R');
$pdf->Write(5,'years, which means after'); 
$pdf->Cell(7, 5,$payback,0, 0,'R');
$pdf->Write(5,'years you will cover the solar panels costs and start to benefit from the system.'); 
$pdf->Ln(8);
$pdf->Write(5,'By estimation your electricity bill costs in a month nearly'); 
$pdf->Cell(17, 5,$bill,0, 0,'R');
$pdf->Write(5,'SR, but after installing the proposed panels system it will cost'); 
$pdf->Cell(17, 5,$Pbill,0, 0,'R');
$pdf->Write(5,'SR. In other words, you can save and reduce'); 
$pdf->Cell(13, 5,$per,0, 0,'R');
$pdf->Write(5,'% from your electricity bill which is a great choice to use solar panel system.'); 
$pdf->Ln(8);
$pdf->Write(5,'In the table below useful information will be displayed along with your rooftop image after installing solar panels on it.');
$pdf->Ln(12);

//------------------------------------------
//project: 
$pdf->SetFont('Arial','',11);
$pdf->SetTextColor(55,198,202);
$pdf->Cell(55, 1, 'Project Name:' ,0, 0,'L');
$pdf->SetTextColor(99,99,99);
$pdf->Cell(5, 1,$projects[$i] ,0, 0,'C');
$pdf->Ln(10);
//------------------------------------------
//image: 
$img= "SELECT panelimg FROM project where project_name ='$projects[$i]' ";
$imgw= mysqli_query($conn,$img);
$imgwa= mysqli_fetch_array($imgw);
$imgC=$imgwa['panelimg'];
$pic = 'data:image/png;base64,'.base64_encode($imgC);

list($x1, $y1) = getimagesize($pic);

$high= ((70 * $y1)/$x1);
$pdf->Image($pic, 70, 130, 70, $high, 'png');
$pdf->Ln(70);
$pdf->SetX(20);
//-------------------------
//city:
$nn=$m['city_KSA'];
$pdf->SetFont('Arial','',10);
$pdf->SetTextColor(55,198,202);
$pdf->Cell(49, 10, 'City:' ,1, 0,'L');
$pdf->SetTextColor(99,99,99);
$pdf->Cell(30, 10, $nn ,1, 0,'L'); 
//-------------------------
//energy:
$energy= "SELECT energy FROM project where project_name ='$projects[$i]' ";
$r= mysqli_query($conn,$energy);
$b= mysqli_fetch_array($r);
$w=$b['energy'];
$pdf->SetTextColor(55,198,202);
$pdf->Cell(59, 10,'Average of consumption energy:' ,1, 0,'L');
$pdf->SetTextColor(99,99,99);
$pdf->Cell(10, 10, $w ,'L T', 0,'L');
$pdf->Cell(20, 10, 'watt peak' ,'R T', 0,'L');
$pdf->Ln(10);
$pdf->SetX(20);
//-----------------------------------------------------------------------
// ** panel info:
//model number:
$pdf->SetTextColor(255,0,0);
$pdf->Cell(2, 10, "*" ,'L', 0,'L');
$pdf->SetTextColor(55,198,202);
$pdf->Cell(47, 10,'Panel model number:' ,'R', 0,'L');
$pdf->SetTextColor(99,99,99);
$pdf->Cell(30, 10,'P60/156-260' ,1, 0,'L');
//--------------
//power:
$pdf->SetTextColor(55,198,202);
$pdf->Cell(59, 10, "Production power of panels:" ,1, 0,'L');
$pdf->SetTextColor(99,99,99);
$pdf->Cell(30, 10,'260 watt' ,1, 0,'L');
$pdf->Ln(10);
$pdf->SetX(20);
//--------------
//number of panels:
$pln= "SELECT installP FROM project where project_name ='$projects[$i]' ";
$r= mysqli_query($conn,$pln);
$install= mysqli_fetch_array($r);
$installPs=$install['installP'];

$pdf->SetTextColor(55,198,202);
$pdf->Cell(49, 10, "Number of installed panels:" ,1, 0,'L');
$pdf->SetTextColor(99,99,99);
$pdf->Cell(30, 10,$installPs ,1, 0,'L');
//--------------
//remain:
$plnR= "SELECT remain FROM project where project_name ='$projects[$i]' ";
$r= mysqli_query($conn,$plnR);
$rem= mysqli_fetch_array($r);
$remainPs=$rem['remain'];

$pdf->SetTextColor(55,198,202);
$pdf->Cell(59, 10, "Remain panels:" ,1, 0,'L');
$pdf->SetTextColor(99,99,99);
$pdf->Cell(30, 10,$remainPs ,1, 0,'L');
$pdf->Ln(10);
$pdf->SetX(20);
//-------------------------
//tilt:
$tilt= "SELECT tilt FROM city where city_name = '$nn' ";
$res= mysqli_query($conn,$tilt);
$s= mysqli_fetch_array($res);
$kk=$s['tilt'];

$pdf->SetTextColor(55,198,202);
$pdf->Cell(49, 10, "Tilt of panels:" ,1, 0,'L');
$pdf->SetTextColor(99,99,99);
$pdf->Cell(30, 10,$kk ,1, 0,'L');
//--------------
//cost:
$pdf->SetTextColor(55,198,202);
$pdf->Cell(59, 10, "Panels cost:" ,1, 0,'L');
$pdf->SetTextColor(99,99,99);
$pdf->Cell(10, 10,$costP ,0, 0,'L');
$pdf->Cell(20, 10,'SR' ,'R', 0,'L');
$pdf->Ln(10);
$pdf->SetX(20);
//--------------
//cost bill before panel:
$pdf->SetTextColor(55,198,202);
$pdf->Cell(49, 10, "Bill cost before panels:" ,1, 0,'L');
$pdf->SetTextColor(99,99,99);
$pdf->Cell(15, 10,$bill ,0, 0,'L');
$pdf->Cell(15, 10,'SR',0, 0,'L');
//--------------
//cost bill after panel:
$pdf->SetTextColor(55,198,202);
$pdf->Cell(59, 10, "Bill cost after panels:" ,1, 0,'L');
$pdf->SetTextColor(99,99,99);
$pdf->Cell(15, 10,$Pbill ,'T', 0,'L');
$pdf->Cell(15, 10,'SR' ,'R T', 0,'L');
$pdf->Ln(10);
$pdf->SetX(20);
//--------------
//cost bill before panel:
$pdf->SetTextColor(55,198,202);
$pdf->Cell(49, 10, "Covered energy percent:" ,1, 0,'L');
$pdf->SetTextColor(99,99,99);
$pdf->Cell(10, 10,$per ,'T B', 0,'L');
$pdf->Cell(20, 10,'%' ,'T B', 0,'L');
//--------------
//cost bill after panel:
$pdf->SetTextColor(55,198,202);
$pdf->Cell(59, 10, "Payback period:" ,1, 0,'L');
$pdf->SetTextColor(99,99,99);
$pdf->Cell(5, 10,$payback ,'B T', 0,'L');
$pdf->Cell(25, 10,'year(s)' ,'R B T', 0,'L');
$pdf->Ln(9);
//-------------------------
//website link:
$pdf->SetTextColor(255,0,0);
$pdf->Cell(2, 10, "*" ,0, 0,'L');
$pdf->SetTextColor(0,0,0);
$pdf->Cell(60, 10, "you can find this model of solar panel" ,0, 0,'L');
$pdf->SetTextColor(0,0,255);
$pdf->Write(10,'here!','http://www.sunergsolar.com/en/prodotti/photovoltaic');
//-------------------------
$pdf->Output('../web2/your_project.pdf', 'I');
ob_end_flush();
}}
?>

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