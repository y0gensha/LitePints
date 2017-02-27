<?php header("Content-type: image/svg+xml"); ?>
<?xml version="1.0" encoding="UTF-8" standalone="no"?>

<?php

/* this just feels wrong */
$rgb = explode(',',$_GET['rgb']);
$r = $rgb[0];
if ($r<60) { $foamRgb = "159,129,112"; }
elseif ($r<190) { $foamRgb = "255,250,205"; }
else { $foamRgb = "255,255,255"; }

?>

<svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0px" y="0px" viewBox="0 0 256 256" style="enable-background:new 0 0 256 256;" xml:space="preserve">
<style type="text/css"><![CDATA[
  #container { fill: #ffffff;
           opacity: 0.3;
  }
  #outline { fill: none;
           stroke: #ffffff;
           stroke-opacity: 0.8;
           stroke-width: 3;
  }
  #liquid { fill: rgb(<?php echo $_GET['rgb'] ?>);
            <?php if(isset($_GET['empty'])) { echo "opacity: 0.0;"; }?>
            stroke: #ffffff;
            stroke-opacity: 1;
            stroke-width: 2;
  }
  #foam { fill: rgb(<?php echo $foamRgb; ?>); opacity: 1; }
]]></style>
<?php readfile("svg_paths/".$_GET['container'].".paths"); ?>
</svg>
