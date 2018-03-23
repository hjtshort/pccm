<?php
	$localhost="localhost";
	$username="root";
	$password="";
	$database="pccm";
	$conn=mysql_connect($localhost,$username,$password) or die("Không kết nối đên WebServer.");
	mysql_select_db($database,$conn) or die("Không tìm thấy Database.");
?>
