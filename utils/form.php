<?php
function validateDate($date, $format = 'Y-m-d') {
  $_date = DateTime::createFromFormat($format, $date);

  $_date && $_date->format($format) == $date ?
    $_date = '' : $_date = 'error_date';

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