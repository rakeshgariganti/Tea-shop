<?php
mysql_connect('localhost','root','');
mysql_select_db('rak');
$sql="insert into tea(lat,lng,info) values('".mysql_real_escape_string($_POST['lng'])."','".mysql_real_escape_string($_POST['lng'])."','".mysql_real_escape_string($_POST['info'])."')";
mysql_query($sql) or die(mysql_error());
echo 'success';
?>
