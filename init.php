<?
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

$link = mysqli_connect('localhost:8889', 'root', 'root', 'yeti');
  if ($link == false) {
    header('Location: templates/error.php');
    exit();
}
else {
  $sql = 'SELECT * FROM bets';
  $result = mysqli_query($link, $sql);
}