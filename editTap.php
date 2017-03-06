<html>
<head>
  <title>Edit Tap</title>
  <meta http-equiv="refresh" content="300">
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<?php
$db = new SQLite3('db/db.db');

if (isset($_POST['number'])) {
  $tapNo = $_POST['number'];
  $s = $db->prepare("update taps set 
                       name=:name, style=:style, brewDate=:brewDate, og=:og,
                       fg=:fg, srm=:srm, ibu=:ibu, container=:container,
                       servingSizeValue=:servingSizeValue,
                       servingSizeUnits=:servingSizeUnits, notes=:notes
                     where number=:number");

  $s->bindParam(':number', $tapNo);
  $s->bindParam(':name', $_POST['name']);
  $s->bindParam(':style', $_POST['style']);
  $s->bindParam(':brewDate', $_POST['brewDate']);
  $s->bindParam(':og', $_POST['og']);
  $s->bindParam(':fg', $_POST['fg']);
  $s->bindParam(':srm', $_POST['srm']);
  $s->bindParam(':ibu', $_POST['ibu']);
  $s->bindParam(':container', $_POST['container']);
  $s->bindParam(':servingSizeValue', $_POST['servingSizeValue']);
  $s->bindParam(':servingSizeUnits', $_POST['servingSizeUnits']);
  $s->bindParam(':notes', $_POST['notes']);
 
  $r = $s->execute();

  if ($r) {
    echo "updated!";
  } else {
    echo "error updating!";
  }
}

$tapNo = $tapNo ? $tapNo : $_GET['number'];
$s = $db->prepare("select * from taps where number = :number");
$s->bindParam(':number', $tapNo);
$r = $s->execute();
$tap = $r->fetchArray(SQLITE3_ASSOC);
?>

<a class="button" href="showTaps.php">Back to tap list</a>
<form method="POST" action="editTap.php">
<table class="formTable">
 <tr><th>Number:</th><td><?php echo $tapNo; ?></td></tr>
 <tr><th>Name:</th><td><input typ="text" name="name" value="<?php echo $tap['name']; ?>" /></td></tr>
 <tr><th>Style:</th><td><input typ="text" name="style" value="<?php echo $tap['style']; ?>" /></td></tr>
 <tr><th>Brew Date:</th><td><input typ="text" name="brewDate" value="<?php echo $tap['brewDate']; ?>" /></td></tr>
 <tr><th>OG:</th><td><input typ="text" name="og" value="<?php echo $tap['og']; ?>" /></td></tr>
 <tr><th>FG:</th><td><input typ="text" name="fg" value="<?php echo $tap['fg']; ?>" /></td></tr>
 <tr><th>SRM:</th><td><input typ="text" name="srm" value="<?php echo $tap['srm']; ?>" /></td></tr>
 <tr><th>IBU:</th><td><input typ="text" name="ibu" value="<?php echo $tap['ibu']; ?>" /></td></tr>
 <tr>
  <th>Container:<?php echo $tap['container']; ?></th>
  <td>
   <select name="container">
    <option value="chalice" <?php echo ($tap['container'] == "chalice" ? "selected" : ""); ?>>Chalice</option>
    <option value="nonic" <?php echo ($tap['container'] == "nonic" ? "selected" : ""); ?>>Nonic Pint Glass</option>
    <option value="pilsner" <?php echo ($tap['container'] == "pilsner" ? "selected" : ""); ?>>Pilsner Glass</option>
    <option value="snifter" <?php echo ($tap['container'] == "snifter" ? "selected" : ""); ?>>Snifter</option>
    <option value="standardpint" <?php echo ($tap['container'] == "standardpint" ? "selected" : ""); ?>>Stanard Pint Glass</option>
    <option value="stange" <?php echo ($tap['container'] == "stange" ? "selected" : ""); ?>>Stange</option>
    <option value="stein" <?php echo ($tap['container'] == "stein" ? "selected" : ""); ?>>Stein</option>
    <option value="tulip" <?php echo ($tap['container'] == "tulip" ? "selected" : ""); ?>>Tulip Glass</option>
    <option value="weizenglass" <?php echo ($tap['container'] == "weizenglass" ? "selected" : ""); ?>>Weizen Glass</option>
    <option value="willibecher" <?php echo ($tap['container'] == "willibecher" ? "selected" : ""); ?>>Willi Becher</option>
    <option value="wineglass" <?php echo ($tap['container'] == "wineglass" ? "selected" : ""); ?>>Wine Glass</option>
   </select>
  </td>
 </tr><tr>
  <th>Serving Size:</th>
  <td>
   <input typ="text" name="servingSizeValue" size="5" value="<?php echo $tap['servingSizeValue']; ?>" />
   <select name="servingSizeUnits">
    <option value="fl. oz." <?php echo ($tap['servingSizeUnits'] == "fl. oz." ? "selected" : ""); ?>>fl. oz.</option>
    <option value="ml" <?php echo ($tap['servingSizeUnits'] == "ml" ? "selected" : ""); ?>>ml</option>
  </td>
 </tr><tr>
  <th>Notes:</th><td><textarea maxlength="400" name="notes" cols="40" rows="10"><?php echo $tap['notes']; ?></textarea></td>
 </tr>
</table>
<input type="hidden" name="number" value="<?php echo $tapNo; ?>" />
<input type="submit" value="Update" />
</form>
</body>
</html>
