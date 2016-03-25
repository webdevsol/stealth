<?php
session_start();
$node = $_GET['node'];
$fnct = $_GET['fnct'];
$par = $_GET['par'];

  $con = connect("cust");
  
  switch($fnct){
    case del:
      $pg_qry = "SELECT * from pages WHERE node = '$node' LIMIT 1";
      $pg_info = mysql_fetch_array(mysql_query($pg_qry));
        
      $del_adj_qry = "DELETE from adjacency WHERE node='$node'";
      $del_pg_qry = "DELETE from pages WHERE node = '$node'";
      
      //echo $del_adj_qry."<br>";
      //echo $del_pg_qry."<br><br>";
          
      mysql_query($del_adj_qry) or die(mysql_error());
      mysql_query($del_pg_qry) or die(mysql_error());
         
      // delete file from file system
      $unlinkfile = $_SESSION['custdir']."/temp/".$pg_info['page'].".php"; // remove temp
      
      if(file_exists($unlinkfile)){
        unlink($unlinkfile);
      }
      
      //echo $unlinkfile."<br><br>"; 
      
      break;
    default:
      break;
  }
  
  mysql_close($con);

  $redirect = "Location: http://dashboard.wdsolutionsonline.com/useradmin.php?page=stealth/stealth_admin&node=".$par;

  header($redirect);

?>