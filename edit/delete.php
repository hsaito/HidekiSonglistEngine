<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>Hideki's Song List :: Delete Entry</title>
  <style type="text/css">
    table, td, th { border: 1px #2b2b2b solid; }
    a { text-decoration: none; }
  </style>
</head>
<body>
  <form name="updater" action="delete-submit.php" method="POST">
    <h1>Delete Entry</h1>
    
    <div style="color: #FF0000">WARNING: You are in the edit mode. Be very careful!</div>

    <?php include 'editmenu.php'; ?>
    
    <h2>Song Information</h2>
    <ul>
      <li>SID to Delete: <input type="text" name="deleting_sid" size="60"></li>
      <li>Title of the entry: <input type="text" name="deleting_title" size="60"></li>
    </ul>
    
    <h2>Verification</h2>
    Read and check these:
    <ul>
      <li>Are you sure? <input type="checkbox" name="verify[]" value="Yes1"></li>
      <li>Are you really sure? <input type="checkbox" name="verify[]" value="Yes2"></li> 
      <li>Are you really really sure? <input type="checkbox" name="verify[]" value="Yes3"></li> 		  
    </ul>
    <input type="submit" value="Confirm Delete" />

    <?php include '../footer.php' ?>
  </form>
</boby>
</html>
