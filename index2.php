<?php
include ("bd.php");
session_start();




if (isset($_COOKIE['auto']) and isset($_COOKIE['login']) and isset($_COOKIE['password']))
{
	if ($_COOKIE['auto'] == 'yes') { 
		  $_SESSION['password']=strrev(md5($_COOKIE['password']))."b3p6f"; 
		  $_SESSION['login']=$_COOKIE['login'];
		  $_SESSION['id']=$_COOKIE['id'];
		}	
	}

if (!empty($_SESSION['login']) and !empty($_SESSION['password']))
{

$login = $_SESSION['login'];
$password = $_SESSION['password'];
$result = mysql_query("SELECT id FROM users WHERE login='$login' AND password='$password'",$db); 
$myrow = mysql_fetch_array($result);

}
?>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
<title>Авторизация</title>
<link href='http://fonts.googleapis.com/css?family=Roboto+Condensed&subset=cyrillic,latin' rel='stylesheet' type='text/css'>

<link href="who-is-online/styles.css" rel="stylesheet" type="text/css"  />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js"></script>
<script type="text/javascript" src="who-is-online/widget.js"></script>

 <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
<style>
body {background-color:#123456;}
html,body,a,label,input {font-family: 'Roboto Condensed', sans-serif;font-size:18px;}
a { 
    text-decoration: none; /* Отменяем подчеркивание у ссылки */
   } 

   .23 { 
    text-decoration: yes; /* Отменяем подчеркивание у ссылки */
   } 
  .enter,.reg{font-size:15px;}
  .field{font-size:16px;
  height:20px;
width:132;}


 </style>  
</head>
<body>



<?php
if (!isset($myrow['id']) or $myrow['id']=='') {
print <<<HERE
<div style="position: absolute; top: 100px; left: 14px">
<div id="page" >
<div class="contain">
<h2 class="form-signin-heading" style="color:#fff;">Вход на сайт</h2>

<form   action="testreg.php" method="post">
<!-- testreg.php - это адрес обработчика. То есть, после нажатия на кнопку "Войти", данные из полей отправятся на страничку testreg.php методом "post"  -->
  <p>
   
    <input name="login" class="field" type="text" placeholder="Логин" required="required" size="15" maxlength="15"
HERE;

	
if (isset($_COOKIE['login'])) 
{

echo ' value="'.$_COOKIE['login'].'">';
}


print <<<HERE
  </p>
<!-- В текстовое поле (name="login" type="text") пользователь вводит свой логин -->  
  <p>
    
    <input name="password" class="field" type="password" placeholder="Пароль" required="required" size="15" maxlength="15"
HERE;

	
if (isset($_COOKIE['password']))
{
echo ' value="'.$_COOKIE['password'].'">';
}

	
print <<<HERE
  </p>
 
  <p>
    <input name="save" type="checkbox" value='1'> Запомнить меня
  </p>

<p>
<input type="submit" class="btn btn-large btn-primary" name="submit" value="Войти">

<br>
<br>

<a href="reg.php?ref=$e"><input class="btn btn-large btn-primary" type="button" value="Зарегистрироваться"></a>
</p></form>



            <a href="send_pass.php">Забыли    пароль?</a>

<br>
<br>
Вы вошли на сайт, как гость<br>
<br>
<br>
 </div>
</div>
</div>
HERE;
}

else
{
print <<<HERE

<div style="position: absolute; top: 100px; left: 24px;">
Вы вошли на сайт, как <font color="#5CACEE"> $_SESSION[login] </font> 
<br>
<br>
<br>
<a href='body.php?cli=1' class="btn btn-large btn-primary" target="BodyFrame" style="position: absolute; left: 25px;">В управление</a>
</div>

<div style="position: relative; top: 200px; left: 72px;">
<a  href='exit.php' class="btn btn-large btn-primary">выход</a>
</div>
HERE;

}

?>

</body>
</html>