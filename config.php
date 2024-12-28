<?php
	@session_start();
	$conn= mysqli_connect("localhost:3307","root","","web_dscontext") or die("Lỗi kết nối");
	
	mysqli_set_charset($conn, "utf8");
?>