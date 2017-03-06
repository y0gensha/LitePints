<html>
<head>
  <title>Tap List</title>
  <meta http-equiv="refresh" content="300">
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<?php
$db = new SQLite3('db/db.db');

if (isset($_GET['number'])) {
  $tapNo = $_GET['number'];
  $s=$db->prepare("update taps set 
                       name='',
                       style='',
                       brewDate='',
                       og=0,
                       fg=0,
                       srm=0,
                       ibu=0,
                       container='',
                       servingSizeValue=0,
                       servingSizeUnits='',
                       notes=''
                      where number=:number");
  $s->bindParam(':number', $tapNo);
  $r = $s->execute();
  if ($r) {
    header("Location: showTaps.php");
  } else {
    echo "error updating";
  }
}

echo "error, must specify tap number";
?>
</body>
</html>
