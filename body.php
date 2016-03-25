<?php 
include "../Mobile_Detect.php"; 
 $detect = new Mobile_Detect;
if($_GET['cd']==NULL){ $node=0;}
else { $node=$_GET['cd']; }
$con = connect();
?>
  <script>
  function goBack() {
      window.history.back()
  }
  </script>
  <style>
    .back {
      -webkit-border-radius: 5px;
      -moz-border-radius: 5px;
      border-radius: 5px;
      border: 2px solid white;
      color: white;
      font-size:14px;
      font-style:italic;
      background-color:#C00000;
    }
  </style>
 
  <div class="container">
    <div id="logo"></div>
    <div class="content">
      <div style="font-size: <?php if($node==0){ echo "36pt; text-align:center; font-weight:bold; font-family:'Gruppo';"; } else { echo "14pt; font-family:'Roboto Slab';"; }?>">
    <?php 
      $node_info = mysql_fetch_array(mysql_query("SELECT * FROM pages WHERE node=$node LIMIT 1"));
      
      include($node_info['page'].".php");
      echo "<br>";
            
      $children = mysql_query("SELECT * FROM adjacency WHERE parent=$node") or die(mysql_error());
      $childnum = mysql_num_rows($children);
      ?>
      </div>
      <table width="100%">
        <tr>
          <td>
      <?php       
      echo "<table style=\"width:100%\">\n\t<tr>";
      
      for($i=0;$i<$childnum;$i++){
        $child_node = mysql_result($children,$i,'node');
        $link = mysql_fetch_array(mysql_query("SELECT link FROM pages WHERE node=$child_node LIMIT 1"));
        echo "\n\t\t<td align=\"center\"><a href=\"?cd=$child_node&pn=$node\" style=\"font-family:'Racing Sans One';font-size:24pt;\">".strtoupper($link['link'])."</a>";
      }
      if($node==6.01){
        echo "\n\t\t<td align=\"center\"><a href=\"?cd=86.01&pn=6.01\" style=\"font-family:'Racing Sans One';font-size:24pt;\">SKIP AHEAD</a>";
      }                                                                                                                          
      
      echo "\n\t</tr>\n</table>";
    ?>
        </td>
      </tr>
      <?php if($node!=0 && $node!="") { ?>
      <tr>
        <td style="width:75px;"><button class="back" onclick="goBack()">Go Back</button></td>
      </tr>
      <?php } ?>
    </table>
    </div>
    <p style="margin-top:20px; text-align:center; color:black; font-size:40pt; font-family:'Special Elite'">DON'T TELL ANYONE!</p>
  </div>
  
<?php mysql_close($con); ?>