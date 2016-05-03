<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>Hideki's Song List :: New Song Entry</title>
  <style type="text/css">
    table, td, th { border: 1px #2b2b2b solid; }
    a { text-decoration: none; }
  </style>
</head>
<body>
  <form name="updater" action="new-submit.php" method="POST">
    <h1>New Song Entry</h1>
    
    <div style="color: #FF0000">WARNING: You are in the edit mode. Be very careful!</div>

    <?php include 'editmenu.php'; ?>    

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
      <li>Highlight: <input type="checkbox" name="highlight[]" value="Yes"</li>
	      
    </ul>
    <input type="submit" value="Update the record" />

    <?php include '../footer.php' ?>    
  </form>
</boby>
</html>
