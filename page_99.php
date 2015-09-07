<?php

include ("bd.php");

?>
 
 <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<HTML> 
 <HEAD> 
 <meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
 <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>

 <link rel="stylesheet" type="text/css" />
 <TITLE></TITLE> 
 <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed&subset=cyrillic,latin' rel='stylesheet' type='text/css'>


 <style type="text/css">
  html,body,input{font-family: 'Roboto Condensed', sans-serif;font-size:17px;}
  p.text{font-family: 'Roboto Condensed', sans-serif; font-size:20px;;}
  input{font-family: 'Roboto Condensed', sans-serif;font-size:14px;}
  

   a { 
    text-decoration: none; /* Отменяем подчеркивание у ссылки */
   }
</style> 


</HEAD> 
<BODY>

<div align="center" style="to" >
<form action="" method="POST" style="margin:0;padding:0">
<button type="submit" name="aut" value="aut">Авторы</button>
<button type="submit" name="bks" value="bks">Книги</button>

</form>
</div>

<?php 
if (isset($_POST['aut']))
{ 
	$tbl='authors';
	$clmn='name';
	$th='ФИО';
	
	
	$result = mysql_query("SELECT * FROM $tbl ") or die(mysql_error());
	if(!mysql_num_rows($result))
	{ //чек если табл пуста
		exit ("<br><center><font size='4' color='red'>В таблице нет строк.</font></center>
					<html><head><meta http-equiv='Refresh' content='1; URL=page_99.php'></head></html>");
	}
	else
	{
echo "<center>";
 echo "<table class='simple-little-table'  style=' border-spacing: 20px 11px;'>";
  echo "<tr>";
		echo "<th align=center>Номер</th>";
        echo "<th align=center>$th</th>";
  echo "</tr>";

while ($row = mysql_fetch_array($result))
{ 
  echo "<tr>";
		echo "<td align='center'>".$row['id_aut']."</td>";
        echo "<td align='left'>".$row[$clmn]."</td>";
        echo "<td align='left'>".$pr."</td>";
  echo "</tr>";
} 
 echo "</table>";
echo "</center>";
	}
}

if (isset($_POST['bks']))
{ 
	$tbl='books';
	$clmn='title';
	$th='название';
	
	
	$result = mysql_query("SELECT * FROM $tbl ") or die(mysql_error());
	if(!mysql_num_rows($result))
	{ //чек если табл пуста
		exit ("<br><center><font size='4' color='red'>В таблице нет строк.</font></center>
					<html><head><meta http-equiv='Refresh' content='1; URL=page_99.php'></head></html>");
	}
	else
	{
echo "<center>";
 echo "<table class='simple-little-table'  style=' border-spacing: 20px 11px;'>";
  echo "<tr>";
		echo "<th align=center>Номер</th>";
        echo "<th align=center>$th</th>";
  echo "</tr>";

while ($row = mysql_fetch_array($result))
{ 
  echo "<tr>";
		echo "<td align='center'>".$row['id_bks']."</td>";
        echo "<td align='left'>".$row[$clmn]."</td>";
        echo "<td align='left'>".$pr."</td>";
  echo "</tr>";
} 
 echo "</table>";
echo "</center>";
	}
}	
?>


<div class="view-source">

  <a href="#">Управление списком</a>

 <div class="hide">

<form action="contspisok.php" method="post">
 Выберите список
<select name="spisok" required>
<option></option>
  <option value="1">Авторы</option>
  <option value="2">Книги</option>
</select>



<p>
	<label>Добавить запись:<br></label>
    <input name="add"  type="text" placeholder="ФИО/Название"  		size="15" maxlength="15">
</p>

<p>	
	<label>Редактировать запись:<br></label>
	<input name="rednum" type="number" placeholder="Номер" 		size="15" maxlength="15">
    <input name="red"	type="text" 	placeholder="ФИО/Название" 	size="15" maxlength="15">
</p>

<p>	
	<label>Удалить запись:<br></label>
    <input name="delnum" type="number" placeholder="Номер" 		size="15" maxlength="15">
</p>

<p>
<input type="submit" name="submit"  value="Подтвердить">
</p></form>


 
  </div>

</div>




</center>

 

<script>

$(function(){

    $('.view-source .hide').hide();

    $a = $('.view-source a');

    $a.on('click', function(event) {

      event.preventDefault();

      $a.not(this).next().slideUp(500);

      $(this).next().slideToggle(500);

    });

});

</script>

 </Body> 
</HTML> 






</div>
</p>
</div>
