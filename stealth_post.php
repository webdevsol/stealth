<?php
session_start();
include ("../../stealth/functions.php");

if (isset($_GET['debug'])) {
    echo '<pre>';
	print_r($_POST);
} else {
  // for customers
  if($_SESSION['custdir']!="root"){ $filename="../../".$_SESSION['custdir']."/temp/".$_POST['pv'].".php"; } // REMOVE temp 
  // for webdev solutions
  else { $filename="../../".$_POST['pv'].".php"; }
 
	file_put_contents($filename,stripslashes($_POST['editor'])) ;
    
    // Save other data
    
    $con = connect();
    mysql_query($con,"UPDATE pages SET link='$_POST[linktext]', display='$_POST[dispname]' WHERE node='$_POST[node]') or die(mysql_error());
    
    mysql_close($con);
    
  $redirect='Location: http://dashboard.wdsolutionsonline.com/useradmin.php?page=stealth/stealth_admin&node='.$_POST['node'];
  echo $redirect;
} 

//header($redirect);
?>
	
    
