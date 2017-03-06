<html>
<body>
<?php
$db = new SQLite3('db/db.db');

if (isset($_GET['number'])) {
  $tapNo = $_GET['number'];
  $s=$db->prepare("insert into taps (number) values (:number)");
  $s->bindParam(':number', $tapNo);
  if ($r) {
    header("Location: editTap.php?number=$tapNo");
  } else {
    echo "error adding!";
  }
}
