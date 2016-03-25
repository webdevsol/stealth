<!DOCTYPE html>
<html>
<head>                
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<!--link rel="SHORTCUT ICON" href="images/ahq.png"-->
<?php
$page = $_GET['page'];
if($page==NULL){ $page="home"; }
include("functions.php"); 
$siteinfo = getSiteData();
$pagedisplay = getPageData($page);
?>
  <link href="css/bootstrap.css" rel="stylesheet">
	<link href="css/bootstrap-theme.css" rel="stylesheet">
	<link href="css/jquery-parallax.css" rel="stylesheet">
	<link href="css/font-awesome.min.css" rel="stylesheet">
	<!--[if IE 7]><link rel="stylesheet" href="assets/css/font-awesome-ie7.min.css"><![endif]-->
	<link href="css/core.css" rel="stylesheet">
  <link href='http://fonts.googleapis.com/css?family=Special+Elite' rel='stylesheet' type='text/css'>     
  <link href='http://fonts.googleapis.com/css?family=Racing+Sans+One' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Gruppo' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Roboto+Slab:400,300,100,700' rel='stylesheet' type='text/css'>

	<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]><script src="assets/js/html5shiv.js"></script><![endif]-->
  
  <LINK REL=StyleSheet HREF="css/styles.css" TYPE="text/css">
  
  <title>
  <?php 
  echo $siteinfo['name']; 
  if($page!="home") { echo " - ".$pagedisplay; }
  ?>
  </title>
    
</head>
<body>
<?php include_once "analyticstracking.php"; ?>
<div class="parallax-container">
  <div class="parallax-item parallax-size-cover" style="background-image: url(img/parallax_1.jpg); filter: url('data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\'><filter id=\'grayscale\'><feColorMatrix type=\'matrix\' values=\'0.3333 0.3333 0.3333 0 0 0.3333 0.3333 0.3333 0 0 0.3333 0.3333 0.3333 0 0 0 0 0 1 0\'/></filter></svg>#grayscale'); filter: gray; -webkit-filter: grayscale(100%); "></div>
  <div class="parallax-item parallax-repeat parallax-overlay"></div>
</div>

<div id="main-frame" class="wrap">
   <?php include('body.php'); ?>
</div>
                  
	<script src="js/jquery-1.10.2.min.js" type="text/javascript"></script>
	<script src="js/bootstrap.min.js" type="text/javascript"></script>
	<script src="js/jquery.parallax.js" type="text/javascript"></script>
	<script src="js/jquery.countdown.js" type="text/javascript"></script>
	<script src="js/core.js" type="text/javascript"></script>

</body>
</html>