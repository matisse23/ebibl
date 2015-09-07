<?php

include ("bd.php");




$add=trim($_POST['add']);
$rednum=($_POST['rednum']);
$red=trim($_POST['red']);
$delnum=($_POST['delnum']);

if (empty($add) and empty($rednum) and empty($red) and empty($delnum))
{	
	exit ("<br><center><font size='4' color='red'>¬се пол¤ пустые.</font></center>
					<html><head><meta http-equiv='Refresh' content='1; URL=page_99.php'></head></html>");
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


if (!empty($add))
{
	$result1 = mysql_query("SELECT * FROM $from WHERE $per='$add' ") or die(mysql_error());
	if(mysql_num_rows($result1)) 
	{//одинаковые записи
		exit ("<br><center><font size='4' color='red'>“ака¤ запись уже существует.</font></center>
					<html><head><meta http-equiv='Refresh' content='1; URL=page_99.php'></head></html>");
	}
	else
	{
		
	
	$result2=mysql_query ("INSERT INTO $from ($per) VALUES ('$add')") or die(mysql_error());
	if($result2=='TRUE')
	 {	
		exit ("<br><center><font size='4' color='red'>«апись успешно добавлена.</font></center>
					<html><head><meta http-equiv='Refresh' content='1; URL=page_99.php'></head></html>");
	 }
	
	}
}




if (!empty($delnum))
{
	$result1 = mysql_query("SELECT * FROM $from WHERE $id='$delnum' ") or die(mysql_error());
	if(!mysql_num_rows($result1)) 
	{//существование номера
		exit ("<br><center><font size='4' color='red'>¬веденный номер неверный.</font></center>
				<html><head><meta http-equiv='Refresh' content='1; URL=page_99.php'></head></html>");	
	}
	else
	{
		$result2=mysql_query("DELETE FROM $from WHERE $id = '$delnum' ") or die(mysql_error());
			exit ("<br><center><font size='4' color='red'>«апись успешно удалена.</font></center>
					<html><head><meta http-equiv='Refresh' content='1; URL=page_99.php'></head></html>");

	}
}

if ( (empty($rednum) or empty($red)) & (empty($rednum) or empty($red)) )
{
	//если есть одно поле,то и второе должно быть
	exit ("<br><center><font size='4' color='red'>Ќе все пол¤ дл¤ редактировани¤ заполнены.</font></center>
					<html><head><meta http-equiv='Refresh' content='1; URL=page_99.php'></head></html>");
}
					
else
{ 
	$result1 = mysql_query("SELECT * FROM $from WHERE $id='$rednum' ") or die(mysql_error());
	if(!mysql_num_rows($result1)) 
	{//существование
		exit ("<br><center><font size='4' color='red'>¬веденный номер неверный.</font></center>
				<html><head><meta http-equiv='Refresh' content='1; URL=page_99.php'></head></html>");	
	}

	$result2 = mysql_query("SELECT * FROM $from WHERE $per='$red' ") or die(mysql_error());
	if(mysql_num_rows($result2)) 
	{//одинаковые записи
		exit ("<br><center><font size='4' color='red'>“ака¤ запись уже существует.</font></center>
					<html><head><meta http-equiv='Refresh' content='1; URL=page_99.php'></head></html>");
	}
	else
	{	

		$result=mysql_query ("UPDATE $from SET $per='$red' WHERE $id='$rednum'")  or die(mysql_error());

		exit ("<br><center><font size='4' color='red'>«апись успешно изменена.</font></center>
					<html><head><meta http-equiv='Refresh' content='1; URL=page_99.php'></head></html>");


	}
}	
           			
?>
