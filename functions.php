<?php
function convertTimeStamp($timeStamp) {

// Elapsed timestamp
$timeLapseStamp = strtotime('now') - $timeStamp;
// Elapsed time in hours
$timeLapseHours = round($timeLapseStamp/3600, 2);


if($timeLapseHours < 1) {
  return date('i минут назад', $timeStamp);

} else if ($timeLapseHours > 24) {
  return date('d-m-y в H:i', $timeStamp);

} else {
  return date('H часов назад', $timeStamp);
}

}

function include_template($templatePath, $templateData){
  if(!file_exists($templatePath)) {
    return '';
  }
  if($templateData) {
    extract($templateData);
  }
  ob_start();
  require_once $templatePath;
  $tpl = ob_get_contents();
  ob_clean();
  return $tpl;
}

