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
 
   if($title == "" || $artist == "")
   {
   die("Title, Artist  are required!");
   }

   if(isset($_POST['highlight']) && $_POST['highlight'][0] == "Yes")
   {
   $highlightset = 1;
   }
   else
   {
   $highlightset = 0;
   }

   // update data in mysql database 
   $sql = "INSERT INTO song_master (title, artist, origin, joysound_wii, redkaraoke, highlight) VALUES ('$title', '$artist', '$origin', '$joysound_wii', '$redkaraoke', '$highlightset')";
   $result=mysql_query($sql);
   
   // if successfully updated. 
   if($result){
   echo "Successful";
   echo "<BR>";
   printf("<a href=\"index.php\">Go back</a>");
   }
   
   else {
   die(mysql_error());
   }
?>
