<?
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");


$link = mysqli_connect('localhost:8889', 'root', 'root', 'yeti');
mysqli_set_charset($link, 'utf8');

if ($link == false) {
  header('Location: templates/error.php');
  exit();
}
