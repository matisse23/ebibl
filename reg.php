<?php
include ("bd.php");
?>

<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=windows-1251">

<title>Регистрация</title>
<link href='http://fonts.googleapis.com/css?family=Roboto+Condensed&subset=cyrillic,latin' rel='stylesheet' type='text/css'>
 <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
<script src="jquery.js" type="text/javascript" language="javascript"></script>
<script language="javascript">

$(document).ready(function()
{
	$("#username").blur(function()
	{
		$("#msgbox").removeClass().addClass('messagebox').text('check').fadeIn("slow");
		$.post("user_availability.php",{ user_name:$(this).val() } ,function(data)
        {
		  if(data=='no') 
		  {
			 
		  	$("#msgbox").fadeTo(200,0.1,function() 
			{ 
			  $(this).html('no').addClass('messageboxerror').fadeTo(900,1);

			  //$('#button').click(function(){
			  //$(this).hide();})
			  
			  //$("#UpdateButton").attr('disabled', 'disabled');
			  
				/* $( function() {
            $('form').submit(function() {
                return false;
				});
			});
			
			$('#searchInput').submit(function(){
			$('.class="btn btn-large btn-primary"').prop('disabled', true);
			 });
			
			*/

			
			});		
          }
		  else
		  {

		  	$("#msgbox").fadeTo(200,0.1,function()  
			{ 
			  $(this).html('yes').addClass('messageboxok').fadeTo(900,1);	
			  /*$( function() {
            $('form').submit(function() {
                return true;
				});
			});
			
			$("#UpdateButton").removeAttr("disabled");
			
			$('#searchInput').submit(function(){
			$('.class="btn btn-large btn-primary"').prop('disabled', false);
			 });
			*/
			
			
			
			
			
			});
		  }
				
        });
 
	});
});
</script>
<style type="text/css">

  body {background-color:#123456;}
html,body,a,label,input {font-family: 'Roboto Condensed', sans-serif;font-size:18px;}

  
  .field{font-size:16px;
  height:20px;
width:132;}


.top {
margin-bottom: 15px;
}
.messagebox{
	position:absolute;
	width:100px;
	margin-left:30px;
	border:1px solid #c93;
	background:#ffc;
	padding:3px;
}
.messageboxok{
	position:absolute;
	width:auto;
	margin-left:30px;
	border:1px solid #349534;
	background:#C9FFCA;
	padding:3px;
	font-weight:bold;
	color:#008000;
	
}
.messageboxerror{
	position:absolute;
	width:auto;
	margin-left:30px;
	border:1px solid #CC0000;
	background:#F7CBCA;
	padding:3px;
	font-weight:bold;
	color:#CC0000;
}
#shest { 
  -moz-appearance: textfield;
}
#shest::-webkit-inner-spin-button { 
  display: none;
}
</style>

</head>
<body>
<h2 style="position: absolute;  left: 24px">Регистрация</h2>
<div style="position: absolute; top: 100px; left: 24px">
<form  action="save_user.php" method="post">
 <p>
    <label>Ваш логин:<br></label>
   <input name="username" class="field" type="text" id="username" required="required" placeholder="от 3 до 15 символов" maxlength="15" />
   <span id="msgbox" style="display:none"></span>
  </p>


  
 <p>
    <label>Ваш пароль:<br></label>
    <input name="password" class="field"  type="password" required="required" placeholder="от 3 до 15 символов"  maxlength="15">
  </p>

 


          <p>Введите    код с картинки:<br>          
<p><img    src="my_codegen.php" id="captcha"></p>
			
			<a href="#" onclick="document.getElementById('captcha').src='my_codegen.php?'+Math.random()">Обновить</a><br><br>
            <input    type="text"  class="field"  name="code" required="required">
          
<p><br>
<input type="submit" name="submit" class="btn btn-large btn-primary"  value="Зарегистрироваться">

 
</p></form>
<a href="index2.php?">Вернуться назад</a><br><br>
</div>
</body>
</html>