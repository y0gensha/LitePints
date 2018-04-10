<?php

# from RaspberryPints
$srmToRgb = array("252,252,243" ,"243,249,147" ,"248,247,83" ,"246,245,19" ,"236,230,26" ,"224,208,27" ,"213,188,38" ,"201,167,50" ,"191,146,59" ,"190,140,58" ,"191,129,58" ,"190,124,55" ,"191,113,56" ,"188,103,51" ,"178,96,51" ,"165,89,54" ,"152,83,54" ,"141,76,50" ,"124,69,45" ,"107,58,30" ,"93,52,26" ,"78,42,12" ,"74,39,39" ,"54,31,27" ,"38,23,22" ,"38,23,22" ,"25,16,15" ,"25,16,15" ,"18,13,12" ,"16,11,10" ,"16,11,10" ,"14,9,8" ,"15,11,8" ,"12,9,7" ,"8,7,7" ,"8,7,7" ,"7,6,6" ,"4,5,4" ,"4,5,4" ,"3,4,3" ,"3,4,3");
# end from RaspberryPints

function srmToRgb($srm) {
  global $srmToRgb;
  return $srmToRgb[round($srm,0,PHP_ROUND_HALF_UP)];
}

function calcKcal($beer) {
  /* these are from  the homberewer's association and are for a 12 fl. oz. serving */
  $calfromalc = (1881.22 * ($beer['fg'] * ($beer['og'] - $beer['fg'])))/(1.775 - $beer['og']);
  $calfromcarbs = 3550.0 * $beer['fg'] * ((0.1808 * $beer['og']) + (0.8192 * $beer['fg']) - 1.0004);

  $totalKcal = $calfromalc + $calfromcarbs;
  if ($beer['servingSizeUnits'] == 'ml') {
    $scale = $beer['servingSizeValue'] / 12 / 29.5735;
  } elseif ($beer['servingSizeUnits'] == 'fl. oz.') {
    $scale = $beer['servingSizeValue'] / 12;
  } else {
    $scale = 0;
  }

  return number_format($totalKcal*$scale);
}

function calcAbv($beer) {
  return number_format((($beer['og']-$beer['fg'])*131),1,'.',',');
}

function calcUnitsEth($beer) { /* one unit is 10 ml of ethanol */
  $abv = calcAbv($beer);

  if ($beer['servingSizeUnits'] == 'ml') {
    $scale = 0.1;
  } elseif ($beer['servingSizeUnits'] == 'fl. oz.') {
    $scale = 29.5735*0.1;
  } else {
    $scale = 0;
  }

  return number_format($beer['servingSizeValue']*$abv/100*$scale ,1,'.',',');
}

function calcCarbs($beer) {
  /* these are from  the homberewer's association and are for a 12 fl. oz. serving */
  $calfromcarbs = 3550.0 * $beer['fg'] * ((0.1808 * $beer['og']) + (0.8192 * $beer['fg']) - 1.0004);

  if ($beer['servingSizeUnits'] == 'ml') {
    $scale = $beer['servingSizeValue'] / 12 / 29.5735;
  } elseif ($beer['servingSizeUnits'] == 'fl. oz.') {
    $scale = $beer['servingSizeValue'] / 12;
  } else {
    return 0;
  }

  /* Assume 4 Kcal per gram */
  return number_format($calfromcarbs*$scale/4 ,1,'.',',');
}

?>

