<html>
<body>
<?php
$db = new SQLite3('db/db.db');

if (isset($_GET['number'])) {
  $tapNo = $_GET['number'];
  $r=$db->query("update taps set 
                       name='',
                       style='',
                       brewDate='',
                       og=0,
                       fg=0,
                       srm=0,
                       ibu=0,
                       container='',
                       servingSizeValue=0,
                       servingSizeUnits=''
                      where number=".$_GET['number']);
  if ($r) {
    header("Location: showTaps.php");
  } else {
    echo "error updating";
  }
}

echo "error, must specify tap number";
