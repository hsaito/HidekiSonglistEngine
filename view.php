<?php
require_once 'auth.php';
require_once 'util.php';
   
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
  <title>Hideki's Song List :: Detailed view for <?php echo("$item[1]") ?> by <?php echo("$item[2]") ?></title>
  <style type="text/css">
    table, td, th { border: 1px #2b2b2b solid; }
    a { text-decoration: none; }
  </style>

  <script type="text/javascript" src="http://webintents.org/webintents.min.js"></script>
  <script type="text/javascript" src="http://webintents.org/webintents-prefix.js"></script>

<script type="text/javascript">
  ishare = function() {
  var intent = new Intent("http://webintents.org/share", "text/uri-list", location.href);
  var onSuccess = function(data) { /* woot */ };
  var onError = function(data) { /* boooo */ };

  window.navigator.startActivity(intent, onSuccess, onError);
  }
</script>

<script type="text/javascript">
  idiscover = function() {
  var intent = new Intent("http://webintents.org/discover", "text/songinfo",  <?php printf
										       ("\"{\\\"songTitle\\\": \\\"%s\\\", \\\"songArtist\\\": \\\"%s\\\", \\\"songReference\\\": \\\"%s\\\", \\\"karaoke\\\": { \\\"vnd_com_joysound_wii\\\": \\\"%s\\\", \\\"vnd_com_redkaraoke\\\": \\\"%s\\\" }}\"",$item[1],$item[2],$item[3], $item[4], $item[5]); ?>);
  var onSuccess = function(data) { /* woot */ };
  var onError = function(data) { /* boooo */ };

  window.navigator.startActivity(intent, onSuccess, onError);
  };
</script>

<?php include 'header-script.php'; ?>

<script type="text/javascript">
var songTemp = {
  "type": "http://schemas.google.com/AddActivity",
  "target": {
    "url": "https://developers.google.com/+/plugins/snippet/examples/thing"
  }
};

formPayload = function () {
songTemp.target.url = "<?php print selfURL(); ?>";
return songTemp;
}

</script>

</head>
<body itemscope itemtype="http://schema.org/Thing">
<h1>Detailed view of <?php echo("$item[1]") ?> by <?php echo("$item[2]") ?></h1>
Song display for:
<div itemprop="name"><?php echo("$item[1]") ?> by <?php echo("$item[2]") ?></div>
    <?php include 'toplink.php'; ?>
    <?php
printf("Registered Song ID: %s",$item[0]);
?>
<h2>Song information</h2>
<ul>
<?php 
printf("<li>Title: %s</li>",$item[1]);
printf("<li>Artist: %s</li>",$item[2]);
printf("<li>Source: %s</li>",$item[3]);
?>
</ul>
  
<h2>Karaoke</h2>
<ul>
<?php
printf("<li>Joysound Wii: %s</li>",$item[4]);
printf("<li>Redkaraoke: %s</li>",$item[5]);
?>
</ul>

<h2>External Features<sup><a href="aboutview.html">[What is this?]</a></sup></h2>
  <ul>
  <li><a href="javascript:idiscover()">Discover</a></li>
  <li><a href="javascript:ishare()">Share</a></li>
  </ul>
 
  <?php
  if(isset ($_COOKIE["google-oauth2-token"]))
  {
  printf("<h3>Google+ Singing Notification</h3>\nUnder development: May not work\n");
  printf("<ul><li><a href=\"javascript:writeMoment(formPayload())\">I'm singing this</a></li></ul>");
  }
  ?>

  <?php printf("Registered: %s",$item[7]);?>
  <?php include 'footer.php'; ?>

  <?php
  mysql_close($link) or die("Something went wrong disconnecting.");
?>
