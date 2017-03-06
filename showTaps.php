<html>
<head>
  <title>Manage Tap List</title>
  <meta http-equiv="refresh" content="300">
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<?php
$taps = array();

$db = new SQLite3('db/db.db');

$r = $db->query("select count(*) from taps");
$row = $r->fetchArray(SQLITE3_ASSOC);
$tapCount = $row['count(*)'];

$r = $db->query("select * from taps order by number");
?>
<table class="tapList">
 <tr><th>Number</th><th>Name</th><th>Style</th><th>Brew Date</th><th>OG</th><th>FG</th><th>SRM</th><th>IBU</th><th>Container</th><th>Serving Size</th></tr>
 <?php while ($tap = $r->fetchArray(SQLITE3_ASSOC)) { ?>
 <tr>
  <td><?php echo $tap['number']; ?></td>
  <td><?php echo $tap['name']; ?></td>
  <td><?php echo $tap['style']; ?></td>
  <td><?php echo $tap['brewDate']; ?></td>
  <td><?php echo $tap['og']; ?></td>
  <td><?php echo $tap['fg']; ?></td>
  <td><?php echo $tap['srm']; ?></td>
  <td><?php echo $tap['ibu']; ?></td>
  <td><?php echo $tap['container']; ?></td>
  <td><?php echo $tap['servingSizeValue']." ".$tap['servingSizeUnits']; ?></td>
  <td>
   <a class="button" href="editTap.php?number=<?php echo $tap['number']; ?>">Edit</a>
   <a class="button" href="emptyTap.php?number=<?php echo $tap['number']; ?>">Empty</a>
   <?php if ($tap['number'] == $tapCount) { ?>
   <a class="button" href="deleteTap.php?number=<?php echo $tap['number']; ?>">Delete</a>
   <?php } ?>
  </td>
 </tr>
 <?php } ?>
  <tr><td><a class="button" href="addTap.php?number=<?php echo ($tapCount+1); ?>">New Tap</a></td></tr>
</table>
<iframe class="preview" src="index.php"></iframe>
</body>
</html>

