<?php
//start session in all pages we want to use the variable from the database
session_start();
?>

<?php

echo '<b>Please wait....</b>';

//remove variable
session_unset();
session_destroy();//close the session
echo ("<script> window.location.href = 'home.php'</script>");//direct the user to login page	
?>