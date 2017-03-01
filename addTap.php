<html>
<body>
<?php
$db = new SQLite3('db/db.db');

if (isset($_GET['number'])) {
  $tapNo = $_GET['number'];
  $r=$db->query("insert into taps (number) values ($tapNo)");
  if ($r) {
    header("Location: editTap.php?number=$tapNo");
  } else {
    echo "error adding!";
  }
}
