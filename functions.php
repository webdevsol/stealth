<?php
function connect(){
  $host="srunning.db.10498072.hostedresource.com";     // Host name 
  $username="srunning"; // Mysql username 
  $password="jUw!I8479NGg"; // Mysql password 
  $db_name="srunning";  // Database name 
  
  // Connect to server and select databse.
  $con=mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
  mysql_select_db("$db_name")or die("cannot select DB");
  
  return $con;
}

function getSiteData(){
  $con = connect();
  $result = mysql_query("SELECT * FROM sitedata LIMIT 1") or die(mysql_error());
  $siteinfo = mysql_fetch_array($result);
  
  mysql_close($con);

  return $siteinfo;
}

function getPageData($page){
  $con = connect();
  $result = mysql_query("SELECT display FROM pages WHERE page='$page'") or die(mysql_error());
  $pagearray = mysql_fetch_array($result);
  $pagename = $pagearray['display'];
  
  mysql_close($con);
  
  return $pagename;
}
?>