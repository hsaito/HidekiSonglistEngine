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
   if ($_GET['s'] == "") {
   // Go with 1 if none
    $_GET['s'] = 2;
}
switch ($_GET['s']) {
   case 1:
   $sort = "title_id";
   break;
   case 2:
   $sort = "title";
   break;
   case 3:
   $sort = "artist";
   break;
   case 4:
   $sort = "origin";
   break;
   case 5:
   $sort = "joysound_wii";
   break;
   case 6:
   $sort = "redkaraoke";
   break;
}

   // Query
   $sql = mysql_real_escape_string("SELECT * FROM `song_master` ORDER BY `{$sort}` ASC");
   $result = mysql_query($sql, $link) or die("Query failed");

   $num_entries = mysql_num_rows($result);
   
   ?>

<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>Hideki's Song List (EDIT MODE)</title>
  <style type="text/css">
    table, td, th { border: 1px #2b2b2b solid; }
    a { text-decoration: none; }
  </style>
</head>
<body>
  <h1>Hideki's Song List (EDIT MODE)</h1>

<?php include 'editmenu.php'; ?>

  Number of entries: <?php echo($num_entries) ?>
  <table style="empty-cells: show;">
    <tr><th><a href="?s=2">Title</a></th><th><a href="?s=3">Artist</a></th><th><a href="?s=4">Source</a></th><th><a href="?s=5">Joysound Wii</a></th><th><a href="?s=6">Redkaraoke</a></th></tr>
    <?php
       while ($entry_row = mysql_fetch_array($result, MYSQL_NUM)) {
       if($entry_row[6] == 1)
       {
       printf("<tr style=\"background-color: #FEE0C6;\"><td><a href=\"view.php?sid=%s\">%s</a></td><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>",$entry_row[0], $entry_row[1], $entry_row[2], $entry_row[3], $entry_row[4], $entry_row[5]);
       }
       else
       {
       printf("<tr><td><a href=\"view.php?sid=%s\">%s</a></td><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>",$entry_row[0], $entry_row[1], $entry_row[2], $entry_row[3], $entry_row[4], $entry_row[5]);
       }
       }
     ?>
  </table>
<?php include '../footer.php'; ?>
</boby>
</html>

<?php
   mysql_close($link) or die("Something went wrong disconnecting.");
   ?>
