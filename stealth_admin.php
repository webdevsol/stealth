<?php
session_start();
if($_GET['node']) {
$node = $_GET['node'];
$abs_par = $_GET['abs_par'];
} else { $node = 0; }
                       
include("add_jqmodal.php");
include("add_elrte.php");

$page = "stealth/stealth_admin";
$level = floor($node);
$con = connect("cust");
$plevel = $level-1;
$glevel = $level+1;

$cards = mysql_query("SELECT * FROM pages");
                                                                                 
$parents = mysql_query("SELECT parent FROM adjacency WHERE node=$node") or die(mysql_error());
$grandchildren = mysql_query("SELECT node FROM adjacency WHERE parent=$node ORDER BY node") or die(mysql_error());

$p_num = mysql_num_rows($parents);
$g_num = mysql_num_rows($grandchildren);

?>

<style type="text/css">
.custAdminBtn {
	-moz-box-shadow:inset 0px 1px 0px 0px #97c4fe;
	-webkit-box-shadow:inset 0px 1px 0px 0px #97c4fe;
	box-shadow:inset 0px 1px 0px 0px #97c4fe;
	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #3d94f6), color-stop(1, #1e62d0) );
	background:-moz-linear-gradient( center top, #3d94f6 5%, #1e62d0 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#3d94f6', endColorstr='#1e62d0');
	background-color:#3d94f6;
	-webkit-border-top-left-radius:10px;
	-moz-border-radius-topleft:10px;
	border-top-left-radius:10px;
	-webkit-border-top-right-radius:10px;
	-moz-border-radius-topright:10px;
	border-top-right-radius:10px;
	-webkit-border-bottom-right-radius:10px;
	-moz-border-radius-bottomright:10px;
	border-bottom-right-radius:10px;
	-webkit-border-bottom-left-radius:10px;
	-moz-border-radius-bottomleft:10px;
	border-bottom-left-radius:10px;
	text-indent:0;
	border:1px solid #337fed;
	display:inline-block;
	color:#ffffff;
	font-family:Arial;
	font-size:12px;
	font-weight:bold;
	font-style:normal;
	height:16px;
	line-height:16px;
	width:112px;
	text-decoration:none;
	text-align:center;
	text-shadow:1px 1px 0px #1570cd;
}
.custAdminBtn:hover {
	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #1e62d0), color-stop(1, #3d94f6) );
	background:-moz-linear-gradient( center top, #1e62d0 5%, #3d94f6 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#1e62d0', endColorstr='#3d94f6');
	background-color:#1e62d0;
}.custAdminBtn:active {
	position:relative;
	top:1px;
}
.custAdminBtnDis {
    -moz-box-shadow:inset 0px 1px 0px 0px #D2D2D2;
	-webkit-box-shadow:inset 0px 1px 0px 0px #D2D2D2;
	box-shadow:inset 0px 1px 0px 0px #D2D2D2;
	background-color:#B4B4B4;
	-webkit-border-top-left-radius:10px;
	-moz-border-radius-topleft:10px;
	border-top-left-radius:10px;
	-webkit-border-top-right-radius:10px;
	-moz-border-radius-topright:10px;
	border-top-right-radius:10px;
	-webkit-border-bottom-right-radius:10px;
	-moz-border-radius-bottomright:10px;
	border-bottom-right-radius:10px;
	-webkit-border-bottom-left-radius:10px;
	-moz-border-radius-bottomleft:10px;
	border-bottom-left-radius:10px;
	text-indent:0;
	border:1px solid #878787;
	display:inline-block;
	color:#ffffff;
	font-family:Arial;
	font-size:12px;
	font-weight:bold;
	font-style:normal;
	height:16px;
	line-height:16px;
	width:112px;
	text-decoration:none;
	text-align:center;
	text-shadow:1px 1px 0px #878787;
    cursor:help;
}
.circle {
	width: 100px;
	height: 50px;
	background: #D4FFAA;
	-moz-border-radius: 50%;
	-webkit-border-radius: 50%;
	border-radius: 50%;
  border:1px solid black;
  text-align:center;
}
.parent{                 
  color: #969696;          
  border:1px solid #969696;
	background: #E1E1E1;
}
.grandchild{              
  color: #969696;
  border:1px solid #969696;
	background: #E1E1E1;
}
    
.tooltip {
    display:none;
    background:transparent url(https://dl.dropboxusercontent.com/u/25819920/tooltip/black_arrow.png);
    font-size:12px;
    height:70px;
    width:160px;
    padding:25px;
    color:#fff;
}
</style>
  
  <?php if($_GET['status']!=NULL){ 
      switch ($_GET['status']){
        case saved:
    ?>
          <script type="text/javascript">
              $(document).ready(function(){
                // jNotify();
                // jError();
                jSuccess( 
                  'Page successfully saved!',
                	{
            		  autoHide : true, // added in v2.0
            		  clickOverlay : false, // added in v2.0
            		  MinWidth : 250,
            		  TimeShown : 2000,
            		  ShowTimeEffect : 1000,
            		  HideTimeEffect : 1000,
            		  LongTrip :20,
            		  HorizontalPosition : 'center',
            		  VerticalPosition : 'top',
            		  ShowOverlay : false,
               		  ColorOverlay : '#000',
            		  OpacityOverlay : 0.0,
            		  onClosed : function(){ // added in v2.0
            		   
            		  },
            		  onCompleted : function(){ // added in v2.0
            		   
            		  }
            		});
              });
            </script> 
    <?php
          break;
        case error:
    ?>
          <script type="text/javascript">
              $(document).ready(function(){
                // jNotify();
                // jSuccess(); 
                jError(
                  'There was an error in saving your page, please try again.',
            		{
            		  autoHide : true, // added in v2.0
            		  clickOverlay : false, // added in v2.0
            		  MinWidth : 250,
            		  TimeShown : 2000,
            		  ShowTimeEffect : 1000,
            		  HideTimeEffect : 1000,
            		  LongTrip :20,
            		  HorizontalPosition : 'center',
            		  VerticalPosition : 'top',
            		  ShowOverlay : false,
               		  ColorOverlay : '#000',
            		  OpacityOverlay : 0.0,
            		  onClosed : function(){ // added in v2.0
            		   
            		  },
            		  onCompleted : function(){ // added in v2.0
            		   
            		  }
            		});
              });
            </script>
    <?php
          break;
        case deleted:
    ?>
          <script type="text/javascript">
              $(document).ready(function(){
                // jNotify();
                // jError(); 
                jSuccess(
                  'Page successfully deleted!',
                	{
            		  autoHide : true, // added in v2.0
            		  clickOverlay : false, // added in v2.0
            		  MinWidth : 250,
            		  TimeShown : 2000,
            		  ShowTimeEffect : 1000,
            		  HideTimeEffect : 1000,
            		  LongTrip :20,
            		  HorizontalPosition : 'center',
            		  VerticalPosition : 'top',
            		  ShowOverlay : false,
               		  ColorOverlay : '#000',
            		  OpacityOverlay : 0.0,
            		  onClosed : function(){ // added in v2.0
            		   
            		  },
            		  onCompleted : function(){ // added in v2.0
            		   
            		  }
            		});
              });
            </script>
    <?php
          break; 
        case child:
    ?>
          <script type="text/javascript">
              $(document).ready(function(){
                // jNotify();
                // jError(); 
                jSuccess(
                  'New child successfully created!',
                	{
            		  autoHide : true, // added in v2.0
            		  clickOverlay : false, // added in v2.0
            		  MinWidth : 250,
            		  TimeShown : 2000,
            		  ShowTimeEffect : 1000,
            		  HideTimeEffect : 1000,
            		  LongTrip :20,
            		  HorizontalPosition : 'center',
            		  VerticalPosition : 'top',
            		  ShowOverlay : false,
               		  ColorOverlay : '#000',
            		  OpacityOverlay : 0.0,
            		  onClosed : function(){ // added in v2.0
            		   
            		  },
            		  onCompleted : function(){ // added in v2.0
            		   
            		  }
            		});
              });
              
              
            </script>       
    <?php
          break;
        default:               
          break;
      }
    } ?>
    
    <script language="javascript" type="text/javascript">
      function popup(url) {
        window.name = "parent";
      	newwindow = window.open(url,'name','height=550,width=550');
      	if (window.focus) {newwindow.focus()}
      	return false;
      };
      function confirmDeleteCard(){
        return confirm("Are you sure you want to delete this card?");
      };
    </script>
        
    <script type="text/javascript">
    $("[title]").tooltip();
    </script>


<!-- TUTORIAL -->
<div style="font-weight:200; width:700px; text-align: center; border:1px solid #E1E1E1; font-family:'Yanone Kaffeesatz'; font-size:26px; padding:10px; margin:0px auto 10px auto;">
<img src="images/lightbulb_icon&32.png" style="vertical-align:text-bottom; border:0px; margin-right:20px;">Need help learning how to use this page?  Click <a href="javascript:void(0)" onclick="window.open('http://www.wdsolutionsonline.com/tutorials/sr-admin-tutorial.html','newWin','width=1300,height=740')">here</a> to watch a tutorial!</div>

    
<div style="background-color:#ECECEC; border-bottom:1px solid #D2D2D2; padding:15px 0px;">
  <table align="center">
    <tr>
      <?php
        if($level!=0){ 
          for($i=0;$i<$p_num;$i++){
            $parent= mysql_result($parents,$i,'parent');
            $parent_info = mysql_fetch_array(mysql_query("SELECT * FROM pages WHERE node=$parent LIMIT 1"));
            echo "<td class=\"circle parent\"><a href=\"?page=".$page."&node=".$parent."\">".$parent_info['display']."</a></td>"; 
          }
        } else { echo "<td></td>"; }
      ?>
    </tr>
  </table>
      
  <table align="center">
    <tr>
      <?php 
          $node_info = mysql_fetch_array(mysql_query("SELECT * FROM pages WHERE node=$node LIMIT 1"));
          echo "<td class=\"circle\">".$node_info['display']."</td>"; 
      ?>
    </tr>
  </table>
             
  <table align="center">
    <tr>
      <?php 
        for($i=0;$i<$g_num;$i++){
          $gc= mysql_result($grandchildren,$i,'node');
          $gc_info = mysql_fetch_array(mysql_query("SELECT * FROM pages WHERE node=$gc LIMIT 1"));
          echo "<td class=\"circle grandchild\"><a href=\"?page=".$page."&node=".$gc."&abs_par=".$node."\">".$gc_info['display']."</a></td>"; 
        }
      ?>
    </tr>
  </table>
</div>
              
  <p style="text-align:right;margin-right:40px;">
    Jump to Card:
    <select id="jumpcard">
      <?php 
        for($i = 0; $i < mysql_num_rows($cards); $i++){
          echo "<option";
          if($node==mysql_result($cards,$i,'node')){ echo " selected"; }
          echo " value=".mysql_result($cards,$i,'node').">".mysql_result($cards,$i,'display')."</option>";
        }
      ?> 
    </select> 
    <script>                        
      var urlmenu = document.getElementById( 'jumpcard' );
      urlmenu.onchange = function() {
        var url = "http://dashboard.wdsolutionsonline.com/useradmin.php?page=stealth/stealth_admin&node=" +  this.options[ this.selectedIndex ].value;
        window.open( url, '_self');
      };
    </script>
  </p>
  
<div style="margin:20px 50px;">
    <table align="center">
      <tr>
        <td>          
                <?php           
                    if($_SESSION['custdir']=="root"){
                      chdir("./../");
                    } else {
                      chdir("./../".$_SESSION['custdir']);
                    }
                ?>
                                                    
                    <form method="post" action="http://www.wdsolutionsonline.com/elRTE/src/stealth_post.php">
                      <div style="background-color:#E1E1E1; font-family:'Tauri'; padding:5px 10px; margin-bottom:10px;">
                        <table style="width:100%; font-size:14px;">
                          <tr>
                            <td style="width:425px; padding:5px 0px">Page Display Title: <input type="text" name="dispname" id="dispname" size="40" value="<?php echo $node_info['display']; ?>"></td>
                            <td></td>
                            <td align="right">
                            <?php if($g_num>0 || $node==0) { ?>
                            <a href="#" class="custAdminBtnDis" title="You cannot delete a card with children.">
                            <?php } else { ?>
                            <a href="?page=stealth/card_edit&fnct=del&node=<?php echo $node; ?>&par=<?php echo $abs_par; ?>" class="custAdminBtn" onclick="return confirmDeleteCard()">
                            <?php } ?>
                            Delete Card</a></td>
                          </tr>
                          <tr>
                            <td style="width:425px; padding:5px 0px;">Page Link Text: <input type="text" name="linktext" id="linktext" size="40" value="<?php echo $node_info['link']; ?>"></td>
                            <td></td>
                            <td align="right"><a href="http://www.wdsolutionsonline.com/stealth/new_card.php?n=<?php echo $node_info['display']; ?>" onclick="return popup('http://www.wdsolutionsonline.com/stealth/new_card.php?n=<?php echo $node_info['display']; ?>&p=<?php echo $node_info['node']; ?>')" class="custAdminBtn nptrigger">Create New Child</a></td>
                          </tr>
                        </table>
                      </div>
                      <div id="stealth_editor">
                        <?php 
                        
                        $link = $node_info['page'].".php";
                        
                        if(file_exists($link)){
                          include($link);
                        }
                        ?>        
                      </div>                                                  
                      <input type="hidden" id="pv" name="pv" value="<?php echo $node_info['page']; ?>">  
                      <input type="hidden" id="dir" name="dir" value="<?php echo $_SESSION['custdir']; ?>"> 
                      <input type="hidden" id="node" name="node" value="<?php echo $node; ?>">
                    </form>                                                         
                    
                    <div style="background-color:#E1E1E1; font-family:'Tauri'; padding:5px 10px; margin-top:10px;">
                      <table style="width:100%; font-size:14px;">
                        <tr>
                          <td>Children: <ul style="margin:0px;">
                            <?php
                              for($i=0;$i<$g_num;$i++){
                                $gc= mysql_result($grandchildren,$i,'node');
                                $gc_info = mysql_fetch_array(mysql_query("SELECT * FROM pages WHERE node=$gc LIMIT 1"));
                                echo "<li><a href=\"?page=".$page."&node=".$gc."\">".$gc_info['display']."</a></li>"; 
                              } 
                              if($g_num==0){ echo "<li><i>There are no children for this node</i></li>"; }
                            ?> 
                           </ul>
                          </td>
                        </tr>
                      </table>
                    </div>
              </td>     
            </tr>
          </table> 
</div>

<?php mysql_close($con); ?>

