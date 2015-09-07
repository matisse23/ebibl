<?php

include ("bd.php");




$add=trim($_POST['add']);
$rednum=($_POST['rednum']);
$red=trim($_POST['red']);
$delnum=($_POST['delnum']);

if (empty($add) and empty($rednum) and empty($red) and empty($delnum))
{	
	exit("<br>Вы не заполнили поля.<br><a href='page_99.php'>Вернуться назад</a>");
}


//$from=0;
if ($_POST['spisok']==1)
{	
	$from='authors';
	//echo  $from;
	$per='name';
	$id='id_aut';
	
}
if ($_POST['spisok']==2)
{
	$from='books';
	$per='title';
	$id='id_bks';

}

//чек одинаковые записи
if (!empty($add))
{
	
	$result=mysql_query ("INSERT INTO $from ($per) VALUES ('$add')") or die(mysql_error());
	if($result=='TRUE')
	{
		echo "Запись успешно добавлена.<br><a href='page_99.php'>Вернуться назад</a>";	
	}
}


if (!empty($rednum) and !empty($red))
{
	
	$result=mysql_query ("UPDATE $from SET $per='$red' WHERE $id='$rednum'")  or die(mysql_error());
	if($result=='TRUE')
	{
		echo "Запись успешно изменена.<br><a href='page_99.php'>Вернуться назад</a>";
	}
}

if (!empty($delnum))
{
	
	$result2=mysql_query ("DELETE FROM $from WHERE $id = '$delnum' ") or die(mysql_error());
	if(mysql_affected_rows($result2)==1)
	{
		echo "Запись успешно удалена.<br><a href='page_99.php'>Вернуться назад</a>";
	}
	else
	{
		echo "Введенные данные не верны.<br><a href='page_99.php'>Вернуться назад</a>";
	}
}
                
				
?>
