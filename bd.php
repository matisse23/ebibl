<?php
$db = mysql_connect ("localhost","t90847r4_ebibl","123456");
mysql_select_db ("t90847r4_ebibl",$db);
mysql_set_charset("cp1251",$db);
mysql_query("SET TIME_ZONE='+03:00'");
?>