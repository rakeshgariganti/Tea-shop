<?php
mysql_connect('localhost','root','');
mysql_select_db('rak');
$sql="delete from tea where id=".mysql_real_escape_string($_GET['id']);
mysql_query($sql);
echo 'success';
?>
