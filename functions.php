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

function validateDate($date, $format = 'Y-m-d') {
  $_date = DateTime::createFromFormat($format, $date);

  $_date && $_date->format($format) == $date ?
    $_date = '' : $_date = 'error-date';

  return $_date;
}

function validateNumericValue($lotValue) {
  $_lotValue = intval($lotValue);

  $is_int = is_int($_lotValue);
  $is_positive = $_lotValue > 0;

  $is_prudent = $_lotValue <= 10000000;
  if(!$is_int) {
    return 'error-integer';

  } elseif (!$is_positive) {
    return 'error-negative';

  } elseif (!$is_prudent) {
    return 'error-value';
  }

  return '';
}


//if (is_string(validateLotRate($a))) {
//  $error_messages['lot-rate'] = validateLotRate($a);
//}
//
//$extracted = extract($errors);
//var_dump($lot_rate);


