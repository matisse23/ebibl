<?php
session_start();
if (empty($_SESSION['login']) or empty($_SESSION['password'])) 
{
xit ("Доступ на эту страницу разрешен только зарегистрированным пользователям. Если вы зарегистрированы, то войдите на сайт под своим логином и паролем<br><a href='index2.php'>Главная страница</a>");
}



unset($_SESSION['password']);
unset($_SESSION['login']); 
unset($_SESSION['id']);
unset($_SESSION['vixod']);
setcookie("auto", "", time()+9999999);
echo "<SCRIPT>parent.frames.BodyFrame.document.location.href='welcome.php'</SCRIPT>";
exit("<html><head><meta http-equiv='Refresh' content='0; URL=index2.php'></head></html>");

?>
