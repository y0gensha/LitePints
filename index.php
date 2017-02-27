<?php

require_once 'include/util.php';

$taps = array();

$db = new SQLite3('db/db.db');
$r = $db->query("select * from taps order by number");
while ($tap = $r->fetchArray(SQLITE3_ASSOC)) {
  $taps[$tap['number']] = $tap;
}
$numberOfTaps = sizeof($taps);
?>
<html>
<head>
  <title>Tap List</title>
  <meta http-equiv="refresh" content="300">
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<table class="mainTable">
<tr>
 <?php for($i=1; $i<=$numberOfTaps; $i++) { ?>
 <td><span class="tapcircle"><?php echo $i; ?></span></td>
 <?php } ?>
</tr><tr>
 <?php for($i=1; $i<=$numberOfTaps; $i++) { $val = (isset($taps[$i])) ? $taps[$i]['name'] : "Empty"; ?>
 <td><h2><?php echo $val; ?></h2></td>
 <?php } ?>
</tr><tr>
 <?php for($i=1; $i<=$numberOfTaps; $i++) { $val = (isset($taps[$i])) ? $taps[$i]['style'] : "--"; ?>
 <td><?php echo $val; ?></td>
 <?php } ?>
</tr><tr>
 <?php for($i=1; $i<=$numberOfTaps; $i++) { $val = ($taps[$i]['brewDate'] !="") ? "Brewed ".$taps[$i]['brewDate'] : "--"; ?>
 <td><span><?php echo $val; ?></span></td>
 <?php } ?>
</tr><tr>
 <?php for($i=1; $i<=$numberOfTaps; $i++) { 
         $srmRgb = isset($taps[$i]['srm']) != "" ? srmToRgb($taps[$i]['srm']) : "220,220,220";
         $container = ($taps[$i]['container']) ? $taps[$i]['container'] : "standardpint&empty=yes";
  ?>
 <td>
   <img src="img/containerSvg.php?container=<?php echo $container; ?>&rgb=<?php echo $srmRgb; ?>" />
 </td>
 <?php } ?>
</tr><tr>
 <?php for ($i=1;$i<=$numberOfTaps; $i++) { ?>
 <td><?php echo $taps[$i]['og'] . " - " . $taps[$i]['fg']; ?></td>
 <?php } ?>
</tr><tr>
 <?php for ($i=1;$i<=$numberOfTaps; $i++) { ?>
 <td><?php echo $taps[$i]['srm'] . " SRM"; ?></td>
 <?php } ?>
</tr><tr>
 <?php for($i=1; $i<=$numberOfTaps; $i++) { $servingSize = (isset($taps[$i]['servingSizeValue'])) ? $taps[$i]['servingSizeValue']." ".$taps[$i]['servingSizeUnits'] : "&infin;"; ?>
 <td><span><?php echo $servingSize; ?></span></td>
 <?php } ?>
</tr><tr>
 <?php for($i=1; $i<=$numberOfTaps; $i++) {
   $abv = (isset($taps[$i])) ? number_format((($taps[$i]['og']-$taps[$i]['fg'])*131),1,'.',',') : "0";
   $unitsEth = (isset($taps[$i])) ? calcUnitsEth($taps[$i]) : "0";
 ?>
 <td><?php echo "$abv% ABV<br>$unitsEth units"; ?></span></td>
 <?php } ?>
</tr><tr>
 <?php for($i=1; $i<=$numberOfTaps; $i++) {
   $cal = (isset($taps[$i]['og'])) ? calcKcal($taps[$i])." kcal" : "Zero!";
 ?>
 <td><span><?php echo "$cal"; ?></span></td>
 <?php } ?>
</tr><tr>
 <?php for($i=1; $i<=$numberOfTaps; $i++) {
         $ibu = (isset($taps[$i])) ? $taps[$i]['ibu'] : "0";
         $height = ($taps[$i]['ibu'] > 100) ? 100 : $taps[$i]['ibu']*100/60;
         $buGu = ($taps[$i]['og'] > 1) ? number_format((($taps[$i]['ibu'])/(($taps[$i]['og']-1)*1000)), 2, '.', '') : "0.00";
 ?>
 <td><?php echo "$ibu IBU"; ?></td>
 <?php } ?>
</tr>
<tr>
 <?php for($i=1; $i<=$numberOfTaps; $i++) { if (isset($taps[$i])) { $val = $taps[$i]['notes']; } else { $o=array(); exec("/usr/games/fortune -an 200",$o); $val = join("\n",$o); } ?>
 <td><?php echo $val; ?></td>
 <?php } ?>
</tr>
</table><!-- main table -->
</body>
</html>

