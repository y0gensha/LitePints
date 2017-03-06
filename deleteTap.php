<html>
<body>
<?php
$db = new SQLite3('db/db.db');

if (isset($_GET['number'])) {
  $tapNo = $_GET['number'];
  $r = $db->prepare("delete from taps where number=:number");
  $s->bindParam(':number', $tapNo);
  $r = $s->execute();
  if ($r) {
    header("Location: showTaps.php");
  } else {
    echo "error deleting!";
  }
}
