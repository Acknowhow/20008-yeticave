<?php
function convertTimeStamp($timeStamp) {

// Elapsed timestamp
$timeLapseStamp = floor(strtotime('now') - $timeStamp);
// Elapsed time in hours
$timeLapseHours = $timeLapseStamp/3600;


if($timeLapseHours < 1) {
  return date('i минут назад', $timeStamp);

} else if ($timeLapseHours > 24) {
  return date('d-m-y в H:i', $timeStamp);

} else {
  return date('H часов назад', $timeStamp);
}

}