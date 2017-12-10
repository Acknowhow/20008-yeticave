<?php
require 'mysql_helper.php';

date_default_timezone_set('Europe/Moscow');

function convertTimeStamp($timeStamp){
// Elapsed timestamp
  $timeLapseStamp = strtotime('now') - $timeStamp;
// Elapsed time in hours
  $timeLapseHours = round($timeLapseStamp / 3600, 2);

  if ($timeLapseHours < 1) {
    return date('i минут назад', $timeStamp);

  } else if ($timeLapseHours > 24) {
    return date('d-m-y в H:i', $timeStamp);

  } else {
    return date('H часов назад', $timeStamp);
  }
}

function include_template($templatePath, $templateData){
  if (!file_exists($templatePath)) {
    return '';
  }
  if ($templateData) {
    extract($templateData);
  }
  ob_start();
  require_once $templatePath;
  $tpl = ob_get_contents();

  ob_clean();
  return $tpl;
}

function getDateFormat($date, $format = 'Y-m-d'){
  $_date = DateTime::createFromFormat($format, $date);

  $_date && $_date->format($format) == $date ?
    $_date = '' : $_date = 'error_date';

  return $_date;
}

function validateDate($date){
  $now = strtotime('now');

  $_date = getDateFormat($date);
  if (empty($_date)) {
    $end = strtotime($date);

    $min = round(($end - $now) / 3600, 2);

    $is_day = $min > 24 ? '' :
      'Срок размещения лота должен быть больше одного дня';

    return $is_day;
  }
  return $_date;
}

function get_integer($val){
  $_val = $val + 0;
  if (is_int($_val)) {
    return $_val;
  }
  return 0;
}

function get_numeric($val){
  if (is_numeric($val)) {
    return $val + 0;

  }
  return 0;
}

function validateLotRate($lotRate){
  $_lotRate = $lotRate;

  $is_numeric = get_numeric($_lotRate);
  $is_positive = $_lotRate > 0;

  if (empty($_lotRate)) {
    return 'Введите начальную цену';
  }
  if (!$is_numeric) {
    return 'Введите числовое значение';

  } elseif (!$is_positive) {
    return 'Введите число больше нуля';
  }
  return '';
}

function validateLotStep($lotStep){
  $_lotStep = $lotStep;

  $is_integer = get_integer($_lotStep);
  $is_positive = $_lotStep > 0;

  if (empty($_lotStep)) {
    return 'Введите шаг ставки';
  }
  if (!$is_integer) {
    return 'Введите целое число';

  } elseif (!$is_positive) {
    return 'Введите число больше нуля';
  }
  return '';
}

function validateUpload($array, $fileType, $fileSize){
  $_result = array_filter(array_values($array), function ($value) use ($fileType) {

    return $value == $fileType;
  }, ARRAY_FILTER_USE_KEY);

  if (empty($_result)) {
    return 'Пожалуйста, выберите файл правильного формата';
  } elseif ($fileSize > 200000) {
    return 'Максимальный размер файла: 200Кб';
  }
  return '';
}

function validateEmail($email)
{
  $_result = null;
  if (empty($_result = filter_var($email, FILTER_VALIDATE_EMAIL))) {
    $_result = 'Пожалуйста, укажите правильный формат email';

  } else {
    $_result = '';
  }
  return $_result;
}

function searchUserByEmail($email, $users, $register = false)
{
  $_result = null;
  foreach ($users as $user) {
    if ($user['email'] == $email) {
      $_result = $user;

      if ($register === true) {
        $_result = 'Указанный вами email уже зарегистрирован';
      }
      break;
    }
    $_result = 'Вы указали неверный пароль или email';

    if ($register === true) {
      $_result = '';
    }
  }
  return $_result;
}

function validateUser($email, $users, $password){
  $is_user = null;
  $user = searchUserByEmail($email, $users);

  if (is_string($user)) {
    $is_user = $user;

  } elseif (is_array($user) && ($is_user = password_verify($password, $user['password']))) {
    $is_user = $user;

  } elseif (is_array($user) && empty($is_user = password_verify($password, $user['password']))) {
    $is_user = 'Пароль неверный';
  }
  return $is_user;
}

function validatePassword($password){
  $_result = [];

  if(strlen($password) < 11) {
    return 'Пожалуйста, укажите не меньше 11 символов в вашем пароле';

  }
  elseif(strlen($password) >= 11 && strlen($password) <= 72) {
    $_result[] = password_hash($password, PASSWORD_DEFAULT);
    return $_result;

  }

  return 'Длина пароля должна быть не больше 72 символов';
}

// MySQL functions
// Select data function

function select_data($link, $sql, $data){
  $arr = [];
  $stmt = db_get_prepare_stmt($link, $sql, $data);

  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);

  if(!$result){
    mysqli_close($link);

    header('Location: templates/error.php');
    exit();

  }
  while($row = mysqli_fetch_assoc($result)){
    $arr[] = $row;
  };
  return $arr;
}

// Combines associated array
// Expects 3 args: associated array(source), simple array(target), columnName
function makeAssocArray($sourceArray, $targetArray, $columnName){
  $i = 0;
  $_array = [];
  $_name = $columnName;

  // Make required number of columnNames
  while ($i < count($targetArray)) {
    $_array[][$_name] = $_name;
    $i++;
  }
  foreach($_array as $key => $value){
    $_array[$key][$_name] = $targetArray[$key];
  }
  $targetArray = $_array;

  $targetArray_column = array_column($targetArray, 'name');
  $sourceArray_column = array_column($sourceArray, 'name');

  $targetArray = array_combine($targetArray_column, $sourceArray_column);
  return $targetArray;

}

// Inserts data
function insert_data($link, $table, $arr){
  $columns = implode(", ",array_keys($arr));
//  $values = implode("', '",array_values($arr));

  $sql = "INSERT into $table ($columns) VALUES (?)";
  $stmt = db_get_prepare_stmt($link, $sql, $arr); // Prepare query
  $result = mysqli_stmt_execute($stmt);

  if(!$result){
    mysqli_close($link);
    $error = mysqli_connect_error();

    print include_template('templates/404.php',[
      'container' => $container,
      'error' => $error
    ]);
  }
  return mysqli_insert_id($link);
}
