<?php
   require '../auth.php';
   
   mb_language("uni");
   mb_internal_encoding("utf-8"); // Changing internal code
   mb_http_input("auto");
   mb_http_output("utf-8");

   // Connect
   $link = mysql_connect($url,$user,$pass) or die("Failed to connect");
   mysql_query(mysql_real_escape_string("SET NAMES utf8"),$link); // Query set to UTF8
   // Select database
   $sdb = mysql_select_db($db,$link) or die("Database doesn't exist!");

   // Figure out sort order
   if ($_GET['sid'] == "") {
   die("Song does not exist.");
   }

   // Query

   $sid = $_GET['sid'];
   settype($sid, "integer");
   $sql = mysql_real_escape_string("SELECT * FROM `song_master` WHERE title_id = $sid");
   $result = mysql_query($sql, $link) or die("Query failed");

   $item = mysql_fetch_array($result, MYSQL_NUM);
   
   if (!$item) {
   die("Item does not exist");
   }
   ?>

<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>Hideki's Song List :: Detailed view for <?php echo("$item[1]") ?> by <?php echo("$item[2]") ?> (EDIT MODE)</title>
  <style type="text/css">
    table, td, th { border: 1px #2b2b2b solid; }
    a { text-decoration: none; }
  </style>
</head>
<body>
  <form name="updater" action="view-submit.php" method="POST">
    <h1>Detailed view for <?php echo("$item[1]") ?> by <?php echo("$item[2]") ?> (EDIT MODE)</h1>
    
    <div style="color: #FF0000">WARNING: You are in the edit mode. Be very careful!</div>

    <?php include 'editmenu.php' ?>
    
    <?php
       printf("Registered Song ID: %s",$item[0]);
       ?>
    <h2>Song information</h2>
    <ul>
      <li>Title: <input type="text" name="title" size="60" value="<?php echo("$item[1]")?>"></li>
      <li>Artist: <input type="text" name="artist" size="60" value="<?php echo("$item[2]")?>"></li>
      <li>Source: <input type="text" name="origin" size="60" value="<?php echo("$item[3]")?>"></li>
    </ul>
    
    <h2>Karaoke</h2>
    <ul>
      <li>Joysound Wii: <input type="text" name="joysound_wii" size="20" value="<?php echo("$item[4]")?>"></li>
      <li>Redkaraoke: <input type="text" name="redkaraoke" size="60" value="<?php echo("$item[5]")?>"></li>
    </ul>



    <h2>Misc Functions</h2>
    <ul>
      <li>Highlight: 

    <?php 
       if($item[6] == 1)
       {
       echo("<input type=\"checkbox\" name=\"highlight[]\" value=\"Yes\" checked></li>");
       }
       else
       {
       echo("<input type=\"checkbox\" name=\"highlight[]\" value=\"Yes\"></li>");
       }
       ?>	
    </ul>
    <input type="hidden" name="sid" value="<?php echo("$item[0]"); ?>">
    <input type="submit" value="Update the record" />

    <?php include '../footer.php'; ?>
  </form>
</boby>
</html>

<?php
   mysql_close($link) or die("Something went wrong disconnecting.");
   ?>
