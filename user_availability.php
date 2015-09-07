<?php
include ("bd.php");
$user_name= $_POST['user_name']; 
$login = mysql_query ("SELECT * FROM users WHERE login = '$user_name'"); 
if (mysql_num_rows($login)) 
{ //юзер недоступен 
echo "no"; 
} else 
{ //доступен 
echo "yes"; 
} 

?>