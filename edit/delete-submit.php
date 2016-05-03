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

   $title = $_POST['deleting_title'];
   $sid = $_POST['deleting_sid'];

   settype($sid,"integer");
   
   printf("Trying to delete %s which claimed SID is %s<br>",$title, $sid);

   $vsql = mysql_real_escape_string("SELECT * FROM `song_master` WHERE title_id = $sid");
   $vresult = mysql_query($vsql, $link) or die("Query failed trying to find that SID");
   
   $vitem = mysql_fetch_array($vresult, MYSQL_NUM);

   if(!$vitem) {
   die("Item does not exist<br>");
   }
   
   if($vitem[1] != $title) {
   die("That title does not agree with SID<br>");
   }

   echo("Item matched<br>");

   if(isset($_POST['verify']) && $_POST['verify'][0] == "Yes1" && $_POST['verify'][1] == "Yes2" && $_POST['verify'][2] == "Yes3")
   {
   echo("Successfully verified<br>");
   }
   else
   {
   die("Verification failed<br>");
   }


   // update data in mysql database 
   $sql = "DELETE FROM `song_master` WHERE title_id = $sid";
   $result=mysql_query($sql);
   
   // if successfully updated. 
   if($result){
   echo "Successful";
   echo "<BR>";
   printf("<a href=\"index.php\">Go back</a>",$sid);
   }
   
   else {
   die(mysql_error());
   }
?>
