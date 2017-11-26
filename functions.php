<?php
date_default_timezone_set('Europe/Moscow');
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
function getDateFormat($date, $format = 'Y-m-d') {
  $_date = DateTime::createFromFormat($format, $date);

  $_date && $_date->format($format) == $date ?
    $_date = '' : $_date = 'error_date';

  return $_date;
}

function validateDate($date) {
  $now = strtotime('now');

  $_date = getDateFormat($date);
  if (empty($_date)) {
    $end = strtotime($date);

    $min = round(($end - $now)/3600, 2);

    $is_day = $min > 24 ? '' :
      'Срок размещения должен быть больше одного дня';

    return $is_day;
  }
  return $_date;
}

function get_integer($val) {
  $_val = $val + 0;
  if(is_int($_val)) {
    return $_val;
  }
  return 0;
}

function get_numeric($val) {
  if (is_numeric($val)) {
    return $val + 0;
  }
  return 0;
}

function validateLotRate($lotRate) {
  $_lotRate = $lotRate;

  $is_numeric = get_numeric($_lotRate);
  $is_positive = $_lotRate > 0;

  if(empty($_lotRate)) {
    return 'Введите начальную цену';
  }
  if(!$is_numeric) {
    return 'Введите числовое значение';

  } elseif (!$is_positive) {
    return 'Введите число больше нуля';
  }
  return '';
}

function validateLotStep($lotStep) {
  $_lotStep = $lotStep;

  $is_integer = get_integer($_lotStep);
  $is_positive = $_lotStep > 0;

  if(empty($_lotStep)) {
    return 'Введите шаг ставки';
  }
  if(!$is_integer) {
    return 'Введите целое число';

  } elseif (!$is_positive) {
    return 'Введите число больше нуля';
  }
  return '';
}




