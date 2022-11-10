<?php
	
	$servername ="localhost";
	$username="root";
	$password="";
	$my_db = "mytarget";
	
	 // create connection 
	 $db = new mysqli($servername,$username,$password,$my_db);
	 
	 // check connection 
	 
	 if(!$db){
		die("connection failed: ".mysqli_connect_error()); 
	 }
	 //echo "connected successfully"; 

 
?>