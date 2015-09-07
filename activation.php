<?php
include ("bd.php");

mysql_query ("DELETE FROM users WHERE activation='0' AND UNIX_TIMESTAMP() - UNIX_TIMESTAMP(date) > 3600");



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


if (isset($_GET['code'])) {$code =$_GET['code']; } 
else
{ exit("Вы зашли на страницу без кода подтверждения!");} 

if (isset($_GET['login'])) {$login=$_GET['login']; } 
else
{ exit("Вы зашли на страницу без логина!");} 



$result = mysql_query("SELECT id FROM users WHERE login='$login'",$db);
$myrow = mysql_fetch_array($result); 

$result23 = mysql_query("SELECT id FROM users WHERE login='$login' and activation='1'",$db); 

$activation = md5($myrow['id']).md5($login);
if ($activation == $code) 
{
 if(mysql_num_rows($result23))	
  {echo "Ошибка: Регистрация уже подтверждена! <a href='index.php'>Главная страница</a>";}
 else
	{
		mysql_query("UPDATE users SET activation='1' WHERE login='$login'",$db);
		echo "Ваш регистрация подтверждена! Теперь вы можете зайти на сайт под своим логином! <a href='index.php'>Главная страница</a>";
	}
}	
else 
{echo "Ошибка! Вы не прошли активацию! <a href='index.php'>Главная страница</a>";

}

?>
</div>
</body>
</html>