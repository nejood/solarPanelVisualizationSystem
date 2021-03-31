
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
<!--body-->

<div>
<center>

  <div>
    <p class="CompaniesTitle">
     Top Solar Panel Companies  
    </p>
  </div>

  <div>
    <table class="Companiestable">
    <thead class="Companiestable comhead">
  <tr >
    <th class="Companiestable">
      Rank
    </th>
           
    <th class="Companiestable">
      Company
    </th>
         <th class="Companiestable">
          Headquarters
         </th>
    <th class="Companiestable">
      Website Link
    </th>
  </tr>
  </thead>
   
   <tbody>
    
    <tr>
      <td class="Companiestable comptext"> 1</td>
      <td class="Companiestable comptext"> JinkoSolar</td>
      <td class="Companiestable comptext"> China</td>
      <td class="Companiestable comptext"> <a style="text-decoration:none" href="https://www.jinkosolar.com/" target="_blank">Click here!</a> </td>
    </tr>
        <tr>
      <td class="Companiestable comptext"> 2</td>
      <td class="Companiestable comptext"> Trina Solar</td>
      <td class="Companiestable comptext"> China</td>
      <td class="Companiestable comptext"> <a style="text-decoration:none" href="https://www.trinasolar.com/us" target="_blank">Click here!</a> </td>
    </tr>
        <tr>
      <td class="Companiestable comptext"> 3</td>
      <td class="Companiestable comptext"> Canadian Solar</td>
      <td class="Companiestable comptext"> Canada</td>
      <td class="Companiestable comptext"> <a style="text-decoration:none" href="https://www.canadiansolar.com/na" target="_blank">Click here!</a> </td>
    </tr>
          <tr>
      <td class="Companiestable comptext"> 4</td>
      <td class="Companiestable comptext"> JA Solar</td>
      <td class="Companiestable comptext"> China</td>
      <td class="Companiestable comptext"> <a style="text-decoration:none" href="http://www.jasolar.com/html/en/" target="_blank">Click here!</a> </td>
    </tr>
    <tr>
      <td class="Companiestable comptext"> 5</td>
      <td class="Companiestable comptext"> Hanwha Q CELLS</td>
      <td class="Companiestable comptext"> South Korea</td>
      <td class="Companiestable comptext"> <a style="text-decoration:none" href="https://www.hanwha-qcells.com/" target="_blank">Click here!</a> </td>
    </tr>
    <tr>
      <td class="Companiestable comptext"> 6</td>
      <td class="Companiestable comptext"> GCL-SI</td>
      <td class="Companiestable comptext"> Hong Kong</td>
      <td class="Companiestable comptext"> <a style="text-decoration:none" href="https://www.gclsi.com/" target="_blank">Click here!</a> </td>
    </tr>
        <tr>
      <td class="Companiestable comptext"> 7</td>
      <td class="Companiestable comptext"> LONGi Solar</td>
      <td class="Companiestable comptext"> China</td>
      <td class="Companiestable comptext"> <a style="text-decoration:none" href="http://en.longi-solar.com/" target="_blank">Click here!</a> </td>
    </tr>
      <tr>
      <td class="Companiestable comptext"> 8</td>
      <td class="Companiestable comptext"> Risen Energy</td>
      <td class="Companiestable comptext"> China</td>
      <td class="Companiestable comptext"> <a style="text-decoration:none" href="http://risenenergy.com/" target="_blank">Click here!</a> </td>
    </tr>
          <tr>
      <td class="Companiestable comptext"> 9</td>
      <td class="Companiestable comptext"> Shunfeng</td>
      <td class="Companiestable comptext"> China</td>
      <td class="Companiestable comptext"> <a style="text-decoration:none" href="http://sfcegroup.com/en/" target="_blank">Click here!</a> </td>
    </tr>
      <tr>
      <td class="Companiestable comptext"> 10</td>
      <td class="Companiestable comptext"> Yingli Green</td>
      <td class="Companiestable comptext"> China</td>
      <td class="Companiestable comptext"> <a style="text-decoration:none" href="http://www.yinglisolar.com/en/" target="_blank">Click here!</a> </td>
    </tr>
   </tbody>
    </table>
    <p class="Sourcetext"> <span class="star">*</span>Source:
    <a href="https://news.energysage.com/best-solar-panel-manufacturers-usa/" target="_blank">Energe Sage website</a>
    </p> 
  </div>

</center> 
</div>

</body>
</html>