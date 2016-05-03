<?php
require 'auth.php';

mb_language("uni");
mb_internal_encoding("utf-8"); // Changing internal code
mb_http_input("auto");
mb_http_output("utf-8");

header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Content-type: text/xml; charset=UTF-8');

// Connect
$link = mysql_connect($url,$user,$pass) or die("Failed to connect");
mysql_query(mysql_real_escape_string("SET NAMES utf8"),$link); // Query set to UTF8
// Select database
$sdb = mysql_select_db($db,$link) or die("Database doesn't exist!");

$sql = mysql_real_escape_string("SELECT * FROM `song_master` ORDER BY `title_id` ASC");
$result = mysql_query($sql, $link) or die("Query failed");
$num_entries = mysql_num_rows($result);

$xmlDoc = new SimpleXMLElement('<urlset/>');
$xmlDoc->addAttribute("xmlns","http://www.sitemaps.org/schemas/sitemap/0.9");

$staticurls = array("index.php","about.html","faq.html","search.html","aboutview.html");

for($i = 0; $i < count($staticurls); $i++) {
  $child = $xmlDoc->addChild("url");
  $child->addChild('loc',sprintf("http://songlist.hclippr.com/%s",$staticurls[$i]));
}
	
while($entry_row = mysql_fetch_array($result, MYSQL_NUM)) {
  $child = $xmlDoc->addChild("url");
  $child->addChild('loc', sprintf("http://songlist.hclippr.com/view.php?sid=%s",$entry_row[0]));
}
   
print($xmlDoc->asXML());

mysql_close($link) or die("Something went wrong disconnecting.");
?>

