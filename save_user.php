<?php
if (isset($_POST['username'])) { $login = $_POST['username']; if ($login == '') { unset($login);} } 
if (isset($_POST['password'])) { $password=$_POST['password']; if ($password =='') { unset($password);} }

if (isset($_POST['code'])) { $code = $_POST['code']; if ($code == '') { unset($code);} } 
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
if (empty($login) or empty($password) or empty($code) ) 
{
exit ("Вы ввели не всю информацию, вернитесь назад и заполните все поля!<br><a href='reg.php'>Вернуться назад</a>"); 

}


function generate_code() 
{
                
    $hours = date("H");        
    $minuts = substr(date("H"), 0 , 1);
    $mouns = date("m");                
    $year_day = date("z"); 

    $str = $hours . $minuts . $mouns . $year_day; 
    $str = md5(md5($str)); 
	$str = strrev($str);
	$str = substr($str, 3, 6); 
	

    $array_mix = preg_split('//', $str, -1, PREG_SPLIT_NO_EMPTY);
    srand ((float)microtime()*1000000);
    shuffle ($array_mix);
    return implode("", $array_mix);
}

function chec_code($code) 
{
    $code = trim($code);

    $array_mix = preg_split ('//', generate_code(), -1, PREG_SPLIT_NO_EMPTY);
    $m_code = preg_split ('//', $code, -1, PREG_SPLIT_NO_EMPTY);

    $result = array_intersect ($array_mix, $m_code);
if (strlen(generate_code())!=strlen($code))
{
    return FALSE;
}
if (sizeof($result) == sizeof($array_mix))
{
    return TRUE;
}
else
{
    return FALSE;
}
}


if (!chec_code($_POST['code']))
{
exit ("Вы ввели неверно код с картинки.<br><a href='reg.php'>Вернуться назад</a>"); 
}

$login = stripslashes($login);
$login = htmlspecialchars($login);

$password = stripslashes($password);
$password = htmlspecialchars($password);
$password_m=$password;




$login = trim($login);
$password = trim($password);



if (strlen($login) < 3 or strlen($login) > 15) {
exit ("Логин должен быть от 3<br> до 15 символов.<br><a href='reg.php'>Вернуться назад</a>");
}
if (strlen($password) < 3 or strlen($password) > 15) {
exit ("Пароль должен быть от 3<br> до 15 символов.<br><a href='reg.php'>Вернуться назад</a>");
}



$password = md5($password);

$password = strrev($password);

$password = $password."b3p6f";

include ("bd.php");


$result = mysql_query("SELECT id FROM users WHERE login='$login'",$db);
$myrow = mysql_fetch_array($result);
if (!empty($myrow['id'])) {
exit ("Извините, введённый вами логин уже зарегистрирован.<br>Введите другой логин.<br><a href='reg.php'>Вернуться назад</a>");
}



$result = mysql_query("SELECT id FROM users WHERE password='$password'",$db);
$myrow = mysql_fetch_array($result);
if (!empty($myrow['id'])) {
exit ("Извините, введённый вами пароль уже зарегистрирован.<br>Введите другой пароль.<br><a href='reg.php'>Вернуться назад</a>");
}





$result2 = mysql_query ("INSERT INTO users (login,password,date) VALUES('$login','$password',NOW())");

if ($result2=='TRUE')
{

$result3 = mysql_query ("SELECT id FROM users WHERE login='$login'",$db);
$myrow3 = mysql_fetch_array($result3);
$activation = md5($myrow3['id']).md5($login);
	
echo "Для подтверждения регистрации перейдите по <a href='http://t90847r4.bget.ru/activation.php?login=".$login."&code=".$activation."' target='_blank'>ссылке</a>.<br> Внимание! Ссылка действительна 1 час.<br><a href='index2.php'>Главная страница</a>"; 
}

else {
exit ("<br>Ошибка! Вы не зарегистрированы.<br><a href='reg.php'>Вернуться назад</a>"); 

     }
?>
</div>
</body>
</html>