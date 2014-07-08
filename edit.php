<?php
mysql_connect('localhost','root','');
mysql_select_db('rak');
$sql="select * from tea where id=".mysql_real_escape_string($_GET['id']);
$r=mysql_fetch_assoc(mysql_query($sql));
if(isset($_POST['id']))
{
	$sql1="update tea set lat='".mysql_real_escape_string($_POST['lat'])."',lng='".mysql_real_escape_string($_POST['lng'])."',info='".mysql_real_escape_string($_POST['info'])."' where id=".$_POST['id'];
	mysql_query($sql1) or die(mysql_error());
	echo '<br><br><br><br><center>Successfully updated :)<center>';
	sleep(1);
	echo "<script>setTimeout(function(){window.location.href='/'},1000);</script>";

}
?>
<br><br><br>
<center>
<form action="" method="post">
<input type="hidden" name="id"  value=<?php echo "'".$_GET['id']."'";?>/>
Latitude:<input type="text" name="lat" value=<?php echo "'".$r['lat']."'";?> /><br>
Longitude:<input type="text" name="lng" value=<?php echo "'".$r['lng']."'";?> /><br>
description:<br><textarea name='info' cols=70 rows=5><?php echo $r['info']; ?></textarea><br>
<input type="submit">
</form>

</center>
