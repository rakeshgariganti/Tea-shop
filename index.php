<!DOCTYPE html>
<html>
<head>
<style>
html,body{
	width:100%;
	height:100%;
	margin:0;
	padding:0;
	font-family:verdana;
}
.map-info {
    width:200px;
    height:50px;
}
</style>
<script src="jquery.min.js"></script>
<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDY0kkJiTPVd2U7aTOAwhc9ySH6oHxOIYM&sensor=false">
</script>
<script>
$(document).ready(function ($) {
	$('#addt').submit(function(){
	

		var flatx=document.getElementById('addlat').value;
		var flngx=document.getElementById('addlng').value;
		var finfox=document.getElementById('adddes').value;

		if(flatx==null || flatx=="" || flngx==null || flngx=="" || finfox=="" || finfox==null)
		{
			alert("Some fields are empty :(");
			return false;
		}
	
		$.post("add.php",{lat:flatx,lng:flngx,info:finfox},
		function(result){
	
				if(result=="success"){
					alert('successfully added');
					setTimeout(function(){window.location.href='/'},1000);
				}
				else{
					alert('something went wrong');
				}
		});
		return false;
	});
});

var map;
<?php 
	$fp=fopen('locations.txt',"r");
	$loc=fgets($fp);
	$dat=explode(",",$loc);
	echo "var locationx=new google.maps.LatLng(".$dat[1].",".$dat[2].");";
	fclose($fp);
?>


function editnode(lat,lng,num){
	setTimeout(function(){window.location.href='edit.php?id='+num},10);
}
function deletenode(lat,lng,mar){
	$.get("delete.php",{id:mar},
		function(result){
				if(result=="success"){
					alert("deleted");
					setTimeout(function(){window.location.href='/'},1000);
				}
				else{
					alert("something went wrong..");				}
		});
	
}
function initialize()
{
var mapvars = {
  center:locationx,
  zoom:8,
  mapTypeId:google.maps.MapTypeId.ROADMAP
  };
map=new google.maps.Map(document.getElementById("map"),mapvars);
<?php 
	mysql_connect('localhost','root','');
	mysql_select_db('rak');
	$q=mysql_query("select * from tea");
	while($r=mysql_fetch_assoc($q)){
		
		$info="<div class='map-info'>".$r['info']."<br><input type='button' value='edit' onclick='editnode(".$r['lat'].",".$r['lng'].",".$r['id'].");'><input type='button' value='delete'  onclick='deletenode(".$r['lat'].",".$r['lng'].",".$r['id'].");'></div>";
		echo "var marker".$r['id']."=new google.maps.Marker({position:new google.maps.LatLng(".$r['lat'].",".$r['lng'].")});\nmarker".$r['id'].".setMap(map);var infoWindow".$r['id']." = new google.maps.InfoWindow({content:\"".$info."\"});infoWindow".$r['id'].".open(map, marker".$r['id'].");\n";
	}
?>
	


}
google.maps.event.addDomListener(window, 'load', initialize);
</script>
</head>

<body>
<div id="menu" style="position:fixed;z-index:1;top:13%;left:7%;background:rgba(255,255,255,0.9);width:350px;height:200px;"><br>
<span>Add Tea Shop</span><br><br>
<div id="add" style="">
<form id="addt">
<input style="width:170px;" type="text" id="addlat" name="addlat" value="Latitude" /><input value="Langitude" style="width:170px;" type="text" id="addlng" name="addlng" />
<textarea style="width:340px;" id="adddes" cols=10 rows=3 name="adddes">descryption</textarea>
<input type="submit" value="add" style="position:fixed;"/>
</form>
</div>
</div>
<div id="map" style="width:100%;height:100%;"></div>
</body>
</html>
