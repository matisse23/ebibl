<?php
if (isset($_POST['login'])) { $login = $_POST['login']; if ($login == '') { unset($login);} } 

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
if (isset($login)) { 
	
	include ("bd.php");
	
	$result = mysql_query("SELECT id FROM users WHERE login='$login' AND activation='1'",$db);
	$myrow = mysql_fetch_array($result);
	if (empty($myrow['id']) or $myrow['id']=='') {

		exit ("Пользователя с таким  логином не существует.<br><a href='index2.php'>Главная страница</a>");
		}
	$datenow = date('YmdHis');
	$new_password = md5($datenow);
	$new_password = substr($new_password, 2, 6);	
	
$new_password_sh = strrev(md5($new_password))."b3p6f";
mysql_query("UPDATE users SET password='$new_password_sh' WHERE login='$login'",$db);

	
	echo "<html><head><meta http-equiv='Refresh' content='10; URL=index2.php'></head><body>Мы сгенерировали для Вас пароль, теперь Вы сможете войти на сайт, используя его. <br><br>  Пароль: <font color='#5CACEE'>$new_password</font> <br><br>Вы будете перемещены через 10 сек.<br> Если не хотите ждать, то <a href='index2.php'>нажмите сюда.</a></body></html>";
	}

else {

?>
</div>
</body>
</html>
<?php
echo '
<html>
<head>
<title>Забыли пароль?</title>
 <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
  <style type="text/css">
    body {background-color:#123456;}
  html,body{font-family: "Roboto Condensed", sans-serif;font-size:16px;}
  .field{font-size:16px;
  height:20px;
width:132;}
  </style>
</head>
<body>

<form action="#"  method="post">
<div style="position: absolute; top: 100px; left: 24px">
Введите Ваш логин:
<br> 
<br>
<div style="position: absolute;  left: 5px">
<input type="text" class="field" name="login" maxlength="15" required="required">
</div>
</div>
<div style="position: absolute; top: 185px;  left: 29px">
<input type="submit" name="submit" class="btn btn-large btn-primary" value="Отправить">

<br><br><a href="index2.php">Вернуться назад</a>
</div>
</form>

</body>
</html>';
}

?>
</div>
</body>
</html>