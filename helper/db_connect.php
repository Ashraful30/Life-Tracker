<?php
	$conn=mysqli_connect("localhost","root","")or die("Connection to Server failed");
	$db=mysqli_select_db($conn,"life_tracker")or die("Connection to Database failed");
?>