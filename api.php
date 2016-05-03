<?php
require 'auth.php';
   
mb_language("uni");
mb_internal_encoding("utf-8"); // Changing internal code
mb_http_input("auto");
mb_http_output("utf-8");

header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Content-type: application/json; charset=UTF-8');

// Connect
$link = mysql_connect($url,$user,$pass) or die("Failed to connect");
mysql_query(mysql_real_escape_string("SET NAMES utf8"),$link); // Query set to UTF8
// Select database
$sdb = mysql_select_db($db,$link) or die("Database doesn't exist!");

// TODO: 
// Rewrite this with the PHP JSON encoding library instead of self-implemented one.
// Remove Redkaraoke and replace it with something that works. (Considering WebIntent no longer works.)

// Figure out sort order
if ($_GET['s'] == "") {
  // Go with 1 if none
  $_GET['s'] = 1;
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
   
if($_GET['sid'] == "")
  {
    // Query
    $sql = mysql_real_escape_string("SELECT * FROM `song_master` ORDER BY `{$sort}` ASC");
    $result = mysql_query($sql, $link) or die("Query failed");
    $num_entries = mysql_num_rows($result);
   
    
    if($_GET['callback'] == "")
    {
      echo("{");
    }
    else
    {
      printf("%s({",$_GET['callback']);
    }     
 
    printf("\"name\":\"mainlist\",",$num_entries);
    printf("\"length\":%s,",$num_entries);
    echo("\"item\":[");
    $i = 0;
    while($entry_row = mysql_fetch_array($result, MYSQL_NUM)) {
      echo("{");
      printf("\"songId\":%s,",$entry_row[0]);
      printf("\"songTitle\":\"%s\",",$entry_row[1]);
      printf("\"songArtist\":\"%s\",",$entry_row[2]);
      printf("\"songReference\":\"%s\",",$entry_row[3]);
      echo("\"karaoke\":{");
      printf("\"vnd_com_joysound_wii\":\"%s\",",$entry_row[4]);
      printf("\"vnd_com_redkaraoke\":\"%s\"",$entry_row[5]);
      echo("}");
      if($num_entries == $i + 1)
	{
	  echo("}");
	}
      else{
	echo("},");
      }
      $i = $i+1;
    }
    echo("]");

    if($_GET['callback'] == "")
    {
      echo("}");
    }
    else
    {
      printf("})");
    }     
  }
elseif($_GET['sid'] != "")
  {
    $sid = $_GET['sid'];
    settype($sid, "integer");
    $sql = mysql_real_escape_string("SELECT * FROM `song_master` WHERE title_id = $sid");
    $result = mysql_query($sql, $link) or die("Query failed");
    $entry_row = mysql_fetch_array($result, MYSQL_NUM);

    if($_GET['callback'] == "")
    {
      echo("{");
    }
    else
    {
      printf("%s({",$_GET['callback']);
    }     
    printf("\"songId\":%s,",$entry_row[0]);
    printf("\"songTitle\":\"%s\",",$entry_row[1]);
    printf("\"songArtist\":\"%s\",",$entry_row[2]);
    printf("\"songReference\":\"%s\",",$entry_row[3]);
    echo("\"karaoke\":{");
    printf("\"vnd_com_joysound_wii\":\"%s\",",$entry_row[4]);
    printf("\"vnd_com_redkaraoke\":\"%s\"",$entry_row[5]);
    echo("}");
   
    if($_GET['callback'] == "")
    {
      echo("}");
    }
    else
    {
      printf("})");
    }     
  }


mysql_close($link) or die("Something went wrong disconnecting.");
?>

