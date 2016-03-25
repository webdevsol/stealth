<?php 
session_start(); 
include("add_elrte.php");

$display = $_GET['n'];
$parent = $_GET['p'];
$status = $_GET['status'];

if($status == "err"){
$newcard_editor_text = $_GET['newcard_editor'];
$dispname = $_GET['dispname'];
$linktext = $_GET['linktext'];
}

?>
<html>
  <head>
   <script language="Javascript">

        function redirectToFB(){
            window.opener.location.href="http://wwww.facebook.com";
            self.close();
        }

    </script>
    <link href='http://fonts.googleapis.com/css?family=Tauri' rel='stylesheet' type='text/css'>
    <style>
     .required{ color:red; }
    </style>
  </head>
  <body>
    <div style="padding-top:10px; font-family:'Tauri'; text-align:center; font-weight:bold; font-size:22px;">Create New Child for Node: '<?php echo $display; ?>'</div>
    <div style="margin:20px 50px;">
      <?php if($status=="err") { echo "<div style=\"text-align:center;margin-bottom:10px;\">***Please fill out the fields indicated in <span style=\"color:red;\">RED</span> before saving***</div>"; }?>
      <table align="center">
        <tr>
          <td>
            <form method="post" action="http://www.wdsolutionsonline.com/elRTE/src/newcard_post.php">
              <div style="background-color:#E1E1E1; font-family:'Tauri'; padding:5px 10px; margin-bottom:10px;">
                <table style="width:100%; font-size:14px;">
                  <tr>
                    <td style="width:150px; padding:5px 0px;" <?php if($status=="err" && $dispname==NULL) { echo "class=\"required\">*"; } else { echo ">"; }?>Page Display Title:</td>
                    <td><input type="text" name="dispname" id="dispname" size="35" value="<?php if($dispname) { echo $dispname; } ?>"></td>
                  </tr>
                  <tr>
                    <td style="width:150px; padding:5px 0px;" <?php if($status=="err" && $linktext==NULL) { echo "class=\"required\">*"; } else { echo ">"; }?>Page Link Text:</td>
                    <td><input type="text" name="linktext" id="linktext" size="35" value="<?php if($linktext) { echo $linktext; } ?>"></td>
                    </tr>             
                </table>
              </div>
              <div id="newcard_editor"><?php if($newcard_editor_text) { echo $newcard_editor_text; } ?></div>
              <input type="hidden" name="parent" id="parent" value="<?php echo $parent; ?>">             
            </form> 
          </td>     
        </tr>
      </table>
    </div>     
  </body>
</html>