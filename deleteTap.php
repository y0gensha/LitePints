<html>
<body>
<?php
$db = new SQLite3('db/db.db');

if (isset($_GET['number'])) {
  $tapNo = $_GET['number'];
  $r=$db->query("delete from taps where number=$tapNo");
  if ($r) {
    header("Location: showTaps.php");
  } else {
    echo "error deleting!";
  }
}
