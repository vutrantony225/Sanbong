<?php
	@session_start();
	$conn= mysqli_connect("localhost","root","","web_dscontext") or die("Lỗi kết nối");
	
	mysqli_set_charset($conn, "utf8");
?>