<?php
   require '../auth.php';
   
   mb_language("uni");
   mb_internal_encoding("utf-8"); // Changing internal code
   mb_http_input("auto");
   mb_http_output("utf-8");

   error_reporting(E_ALL);
   ini_set('display_errors', '1');

   // Connect
   $link = mysql_connect($url,$user,$pass) or die("Failed to connect");
   mysql_query(mysql_real_escape_string("SET NAMES utf8"),$link); // Query set to UTF8
   // Select database
   $sdb = mysql_select_db($db,$link) or die("Database doesn't exist!");

   $title = $_POST['title'];
   $artist = $_POST['artist'];
   $origin = $_POST['origin'];
   $joysound_wii = $_POST['joysound_wii'];
   $redkaraoke = $_POST['redkaraoke'];
   $sid = $_POST['sid'];
 
   if($title == "" || $artist == "" || $sid == "")
   {
   die("Title, Artist, SIDs are required!");
   }

   settype($sid, "integer");

   if($sid == 0)
   {
   die("Invalid SID");
   }


   //printf("Title: %s, Artist: %s, SID: %s",$title, $artist, $sid);

   if(isset($_POST['highlight']) && $_POST['highlight'][0] == "Yes")
   {
   $highlightset = 1;
   }
   else
   {
   $highlightset = 0;
   }
   
   settype($sid, "integer");

   // update data in mysql database 
   $sql = "UPDATE song_master SET title='$title', artist='$artist', origin='$origin', joysound_wii='$joysound_wii', redkaraoke='$redkaraoke', highlight = '$highlightset' WHERE title_id='$sid'";
   $result=mysql_query($sql);
   
   // if successfully updated. 
   if($result){
   echo "Successful";
   echo "<BR>";
   printf("<a href=\"view.php?sid=%s\">View result</a>",$sid);
   }
   
   else {
   die(mysql_error());
   }
?>
