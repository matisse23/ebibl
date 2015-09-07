<?php
session_start();

if (isset($_POST['login'])) { $login = $_POST['login']; if ($login == '') { unset($login);} } 
if (isset($_POST['password'])) { $password=$_POST['password']; if ($password =='') { unset($password);} }


?>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
<link href='http://fonts.googleapis.com/css?family=Roboto+Condensed&subset=cyrillic,latin' rel='stylesheet' type='text/css'>
 <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
	<style type="text/css">

  body {background-color:#123456;
  font-size:17px;}
  </style>

</head>
<body>
<div style="position: absolute; top: 100px; left: 24px">
<?php
if (empty($login) or empty($password)) 
{
exit ("Вы ввели не всю информацию, вернитесь назад и заполните все поля!<br><a href='index2.php'>Вернуться назад</a>");
}

$login = stripslashes($login);
$login = htmlspecialchars($login);

$password = stripslashes($password);
$password = htmlspecialchars($password);



$login = trim($login);
$password = trim($password);


include ("bd.php");

$ip=getenv("HTTP_X_FORWARDED_FOR");
if (empty($ip) || $ip=='unknown') { $ip=getenv("REMOTE_ADDR"); }

mysql_query ("DELETE FROM oshibka WHERE UNIX_TIMESTAMP() - UNIX_TIMESTAMP(date) > 900");

$result = mysql_query("SELECT col FROM oshibka WHERE ip='$ip'",$db);
$myrow = mysql_fetch_array($result);

if ($myrow['col'] > 2) {

exit("Вы набрали логин или пароль неверно 3 раза. Подождите 15 минут до следующей попытки.<br><a href='index2.php'>Вернуться назад</a>");
}


$password = md5($password);
$password = strrev($password);
$password = $password."b3p6f";


$result = mysql_query("SELECT * FROM users WHERE login='$login' AND password='$password' AND activation='1'",$db); 
$myrow = mysql_fetch_array($result);
if (empty($myrow['id']))
{


$select = mysql_query ("SELECT ip FROM oshibka WHERE ip='$ip'");
$tmp = mysql_fetch_row ($select);
if ($ip == $tmp[0]) {

$result52 = mysql_query("SELECT col FROM oshibka WHERE ip='$ip'",$db);
$myrow52 = mysql_fetch_array($result52);

$col = $myrow52[0] + 1; 
mysql_query ("UPDATE oshibka SET col=$col,date=NOW() WHERE ip='$ip'");
}

else {
mysql_query ("INSERT INTO oshibka (ip,date,col) VALUES ('$ip',NOW(),'1')");
}


exit ("Извините, введённый вами логин или пароль неверный.<br><a href='index2.php'>Вернуться назад</a>");
}
else {

          $_SESSION['password']=$myrow['password']; 
		  $_SESSION['login']=$myrow['login']; 
          $_SESSION['id']=$myrow['id'];
		  

if (isset($_POST['save'])){

setcookie("login", $_POST["login"], time()+9999999);
setcookie("password", $_POST["password"], time()+9999999);}
}	
	  
echo "<html><head><meta http-equiv='Refresh' content='0; URL=index2.php'></head></html>";

?>
</div>
</body>
</html>
